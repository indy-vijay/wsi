<?php 
namespace Controller;
use \Customers;
use \Address;
use \Communication;
use \Orders;
use \OrderLine;
use \States;
use \Artworks as ArtworksModel;
use \Artworksplacements as ArtworksplacementsModel;
use \OrderArtworks;
use \Brands;
use \Styles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Order extends \SlimController\SlimController
{
	

	public function createOrderAction()
	{
		$orderCategories =  Parameters::getParameters('orderCategory');

		$this->render('order/create', array(
	           'orderCategories' => $orderCategories
	    ));
	
	}



	public function createOrderStepTwoAction($category_type = "SP" )
	{
		Session::setToken();

		$req 				   = $this->app->request();
		$category_type         = strtoupper($category_type);
		$fileNameWithPath      = '';
		$id      = 1;
		$orderCategories =  Parameters::getParameters('orderCategory');
		$orderCategoryPlacement =  Parameters::getOrderCategoryPlacement($category_type);
		$contact_id = Login::isLoggedIn();
		if(! array_key_exists($category_type, $orderCategories) || !($contact_id > 0))
			return $this->render('invalid');
		$files['artworks'] = Artwork::uploadTempArtwork($req); //move artwork file to temp directory

		$styles 		   = Brands::categoryBrands($category_type)->first()->styles; //get styles for the first brand
		$colors            = Styles::find($styles->first()->id)->colors;

		$this->render('order/create-2',array(
			'token'  		   			=> Session::getToken(),
			'categoryType'     			=> $category_type,
			'categoryName'     			=> $orderCategories[$category_type],
			'fileNameWithPath' 			=> $files['artworks']['url'],
			'thumbImagePath'   			=> Artwork::getThumbPathForFile($fileNameWithPath),
			'placement' 	   			=> $files['artworks']['placement'],
			'orderCategoryPlacement' 	=> $orderCategoryPlacement,
			'brands'                    => Brands::categoryBrands($category_type)->get()->toArray(),	
			'styles'					=> $styles->toArray(),
			'colors'					=> $colors->toArray()
		));
	}

public function createOrderStepTwoSubmitAction()
	{
		$req 				   = $this->app->request();
		$contact_id 		   = Login::isLoggedIn();
		$artwork_id   		   = 0;
		$order_id  			   = 0;
 		if(!$this->step2Validation($req)) return false;
		$order_id = Orders::createOrder($req,$contact_id);
		$artwork_id_array = Artwork::createArtwork($req,$order_id);
		foreach ($artwork_id_array as $artwork_id) {
		//create relationship between artworks and order
			OrderArtworks::create([
								'order_id' => $order_id,
								'artwork_id' => $artwork_id
							]);
			}
		//create order lines
		$insertRows = $this->getOrderLines($req, $order_id);				
		OrderLine::insert($insertRows);
		unset($insertRows);

		Session::setPendingOrder($order_id);
		$this->app->redirect(BASE_URL . 'confirm-order');
				
	}


	public function step2Validation($req)
	{

		if( NULL !== $req->post('order_placed') &&  $req->post('order_placed') == 1 && Session::validateSubmission($req) &&  Login::isLoggedIn() > 0)
		//if( NULL !== $req->post('order_placed') &&  $req->post('order_placed') == 1 &&  Login::isLoggedIn() > 0)			
		{	
			return true;
		}
		return false;
	}

	public function confirmOrderAction()
	{
		//ADD SECURITY TO MAKE SURE THE LAST PAGE IS ORDER CREATE STEP 2
				
		$req = $this->app->request();
    	$contact_id = Login::isLoggedIn();
    	$order_id = Session::getPendingOrder();
  	
    	if(!$contact_id || ! $contact_id > 0 || ! $order_id > 0){

    		$this->render('invalid');

    	}
    	else{
			
			$order = Orders::getOrder($order_id,$contact_id);
			
			if( count($order) == 1 ){
				$order = $order[0];
				$category_code = $order['category'];
				$order['category']      =  Parameters::getParameters('orderCategory')[$order['category']]; //Get the text for order category
				$order['delivery_type'] = Parameters::getParameters('deliveryType')[$order['delivery_type']];
				

			}

			$order_lines = OrderLine::getOrderLines($order_id);          
            $address = Address::getAddressForContactId($contact_id);
            $communication = Communication::getCommunicationForContactId($contact_id);
            $customer = Customers::getCustomer($contact_id);  
            $states = States::all()->toArray();
        }

        $token = Session::setToken();
		
		$this->render('order/confirm', compact('address','communication','customer','order','order_lines','states','token','category_code'));
	}

	public function orderDetailAction($order_id)
	{
		$contact_id = Login::isLoggedIn();
		$req 	    = $this->app->request();
		$isValidReq = false;
		$artworks   = false;
		
		if( $contact_id > 0 && isset($order_id) && $order_id > 0 ){
		
			$order = Orders::getOrder($order_id,$contact_id);
			//SELECT * FROM `order_artworks` join artworks on artworks.artwork_id = order_artworks.artwork_id WHERE order_artworks.order_id = 143
			$order_artworks = Orders::artworks($order_id);
	
			if( count($order) == 1){
			
				$order = $order[0];
				$category_code          = $order['category'];
				$order['category']      = Parameters::getParameters('orderCategory')[$order['category']]; //Get the text for order category
				$order['delivery_type'] = Parameters::getParameters('deliveryType')[$order['delivery_type']];
				$order_lines 			= OrderLine::getOrderLines($order_id);    
				$isValidReq 			= true;
				$thumb_path 	        = ARTWORK_THUMB_PATH;



				$this->render('order/detail',compact('order','order_lines','category_code','order_artworks','thumb_path'));
			}
    	}

    	if(! $isValidReq )
    		$this->render('invalid');
    	
	}

	public function confirmFinalAction()
	{
		$contact_id = Login::isLoggedIn();
		$req = $this->app->request();
		if(!$contact_id || ! $contact_id > 0  || !Session::getPendingOrder() ){

    		$this->render('invalid');

    	}
    	else{

    		Session::unsetPendingOrder();
			$this->render('order/confirm-final');
		}
	}

	public function createReOrderAction()
	{
		$contact_id = Login::isLoggedIn();
		$req = $this->app->request();
		
		if(!$contact_id || ! ($contact_id > 0) ){

			$this->render('invalid');
			return false;
		}


		
		$customerOrders   = Orders::getOrdersForCustomer($contact_id);
   		 // $orderStatuses = Parameters::getParameters('orderStatus');
		$token = Session::setToken();

   		$this->render('order/reorder-create',compact('customerOrders','token'));
		
		
	}

	public function createReOrderStepTwoAction($order_id)
	{
		$contact_id = Login::isLoggedIn();
		$req = $this->app->request();
		$isValidReq = false;
		
		if( $contact_id > 0 && isset($order_id) && $order_id > 0 ){
			$order = Orders::getOrder($order_id,$contact_id);
			if( count($order) == 1){
				$files['artworks'] = Artwork::uploadTempArtwork($req); //move artwork file to temp directory
				if(!$req->isPost())
				{
					$order_artworks              = Orders::artworks($order_id);
					$order_artworks_placements   = Orders::artwork_placement($order_id);
					
					foreach ($order_artworks as $file) {
						$files['artworks']['url'][] = $file->file_path;
						}

					foreach ($order_artworks_placements as $file) {
						$files['artworks']['placement'][] = $file->artwork_placement;
						}

				}
				$order = $order[0];
				//$category_type = $order['category'];
				//$delivery_type_name = Parameters::getParameters('deliveryType')[$order['delivery_type']];
				//$orderCategoryPlacement = Parameters::getOrderCategoryPlacement($category_type);
				
				$this->render('order/reorder-create2',array(
				'token'  		   			=> Session::setToken(),
				'categoryType'     			=> $order['category'],
				'categoryName'				=> Parameters::getParameters('orderCategory')[$order['category']],
				'order_lines'				=> OrderLine::getOrderLines($order_id),
				'deliveryType'				=> $order['delivery_type'],	
				'inHandsDate'				=> $order['in_hands_date'],
				'fileNameWithPath' 			=> $files['artworks']['url'],
				//'thumbImagePath'   			=> Artwork::getThumbPathForFile($fileNameWithPath),
				'placement' 	   			=> $files['artworks']['placement'],
				'orderCategoryPlacement' 	=> Parameters::getOrderCategoryPlacement($order['category']),	
				));

			}

    	}

    	if(! $isValidReq )
    		$this->render('invalid');
	}

	public function submitReorderAction()
	{
		$contact_id = Login::isLoggedIn();
		$req = $this->app->request();
		$artwork_id = 0;

		if( NULL !== $req->post('order_placed') &&  $req->post('order_placed') == 1 && Session::validateSubmission($req) && $contact_id > 0){
			
			//create order
			$order_id = Orders::createOrder($req,$contact_id);

			//create artwork
			$files['artworkUploaded'] = $req->post('fileNameWithPath');
			$files['placement'] = $req->post('placementUploaded');
			foreach ($files['artworkUploaded'] as $num => $artworkUploaded) {
				# code...
			
			if( strlen($artworkUploaded) > 0 && file_exists($artworkUploaded) ){
				//move the file	
				$design_name   = basename($artworkUploaded);
				$preview_image = $artworkUploaded; //dummy, remove this with proper info
				$newFileName   = basename($artworkUploaded);

				if(copy($artworkUploaded,  ARTWORK_UPLOAD_PATH . $newFileName)){

					
					$artwork_id = ArtworksModel::createArtwork($contact_id, $design_name, $artworkUploaded,$preview_image);
					$artwork_id_array[] =$artwork_id;
					$placement_id_array[] = ArtworksplacementsModel::createArtworkPlacement($order_id,$artwork_id,$files['placement'][$num]);
				}
				else{
					//Log the file copy error
					// echo "Error copying " . $artworkUploaded . " to " . ARTWORK_UPLOAD_PATH . $newFileName;
				}
			}
		
			else{
				 //Log the file not found error
				 // echo "File not found " .  $artworkUploaded ;die;
			}
		}
	
			foreach ($artwork_id_array as $artwork_id) {
				//create relationship between artworks and order
				OrderArtworks::create([
								'order_id' => $order_id,
								'artwork_id' => $artwork_id
							]);
				}

			//create order lines
			$insertRows = $this->getOrderLines($req, $order_id);				
			OrderLine::insert($insertRows);
			unset($insertRows);

			Session::setPendingOrder($order_id);
			$this->app->redirect(BASE_URL . 'order-final');
				
		}
		else{
			$this->render('invalid');
		}

			
	}

	public function previousOrdersAction()
	{
		$req = $this->app->request();
    	$contact_id = Login::isLoggedIn();

    	if(!$contact_id || ! $contact_id > 0){

    		$this->render('invalid');

    	}
    	else{

    		$customerOrders = Orders::getOrdersForCustomer($contact_id);
            // $orderStatuses  = Parameters::getParameters('orderStatus');
   			
    		$this->render('order/previous',compact('customerOrders'));
    	}
	}

	

	public function getOrderLines($req, $order_id)
	{
		$rowCount = count($req->post('desc'));

		$insertRows = array();
		for($i=0; $i < $rowCount; $i++){

			$total_pieces = $this->getTotalPieces($i);

			$insertRows[] = array(
									'desc'  	    => $req->post('desc')[$i],
									'brand'			=> $req->post('brand')[$i],
									'style' 	    => $req->post('style')[$i],
									'color'         => $req->post('color')[$i],
									'order_id'      => $order_id,							
									'color'         => $req->post('color')[$i],
									'qty_youth_xs'  => $req->post('qty_youth_xs')[$i],
									'qty_youth_s'   => $req->post('qty_youth_s')[$i],
									'qty_youth_m'   => $req->post('qty_youth_m')[$i],
									'qty_youth_l'   => $req->post('qty_youth_l')[$i],
									'qty_youth_xl'  => $req->post('qty_youth_xl')[$i],
									'qty_adult_xs'  => $req->post('qty_adult_xs')[$i],
									'qty_adult_s'   => $req->post('qty_adult_s')[$i],
									'qty_adult_m'   => $req->post('qty_adult_m')[$i],
									'qty_adult_l'   => $req->post('qty_adult_l')[$i],
									'qty_adult_xl'  => $req->post('qty_adult_xl')[$i],
									'qty_adult_2xl' => $req->post('qty_adult_2xl')[$i],
									'qty_adult_3xl' => $req->post('qty_adult_3xl')[$i],
									'qty_adult_4xl' => $req->post('qty_adult_4xl')[$i],
									'qty_adult_5xl' => $req->post('qty_adult_5xl')[$i],
									'qty_adult_6xl' => $req->post('qty_adult_6xl')[$i],
									'total_pieces'  => $total_pieces 

							);
		}

		return $insertRows;
	}

	public function getTotalPieces($i)
	{
		$req = $this->app->request();
		if(isset($req->post('total_pieces')[$i] ))
			return $req->post('total_pieces')[$i] ;
	
		return $req->post('qty_youth_xs')[$i] + $req->post('qty_youth_s')[$i] + $req->post('qty_youth_m')[$i] + $req->post('qty_youth_l')[$i] + $req->post('qty_youth_xl')[$i] + $req->post('qty_adult_xs')[$i] + $req->post('qty_adult_s')[$i] + $req->post('qty_adult_m')[$i] + $req->post('qty_adult_l')[$i] + $req->post('qty_adult_xl')[$i] + $req->post('qty_adult_2xl')[$i] + $req->post('qty_adult_3xl')[$i] + $req->post('qty_adult_4xl')[$i] + $req->post('qty_adult_5xl')[$i] + $req->post('qty_adult_6xl')[$i];
		
	}

	

}