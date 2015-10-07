<?php 
namespace Controller;
use \Customers;
use \Address;
use \Communication;
use \Orders;
use \OrderLine;
use \States;
use \Artworks;

class Order extends \SlimController\SlimController
{

	public function createOrderAction()
	{
		 $orderCategories =  Parameters::getParameters('orderCategory');
	
		if( $category_type = $this->app->request()->get('type')){

			$this->createOrderStepTwo($category_type,$orderCategories);

		}
		else{

			 $this->render('order/create', array(
	           'orderCategories' => $orderCategories
	        ));
		}
	}

	public function createOrderStepTwo($category_type,$orderCategories)
	{
		$req = $this->app->request();
		$category_type         = strtoupper($category_type);
		$fileNameWithPath      = '';
		$artwork_id   		   = 0;
		$order_id  			   = 0;

		if(! array_key_exists($category_type, $orderCategories )){

			$this->render('invalid');

		}
		else{
		
			$contact_id = Login::isLoggedIn();
			if( NULL !== $req->post('order_placed') &&  $req->post('order_placed') == 1 && Session::validateSubmission($req) && $contact_id > 0){
				
				//create order
				$order_id = Orders::createOrder($req,$contact_id);

				//create artwork
				$artworkUploaded = $req->post('fileNameWithPath');
				if( strlen($artworkUploaded) > 0 && file_exists($artworkUploaded) ){
					//move the file	
					$design_name   = basename($artworkUploaded);
					$preview_image = $artworkUploaded; //dummy, remove this with proper info
					$newFileName   = basename($artworkUploaded);

					if(copy($artworkUploaded,  ARTWORK_UPLOAD_PATH . $newFileName)){

						
						$artwork_id = Artworks::createArtwork($contact_id, $design_name, $artworkUploaded,$preview_image);

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
				//create order lines
				$insertRows = $this->getOrderLines($req, $order_id,$artwork_id);				
				OrderLine::insert($insertRows);
				unset($insertRows);

				Session::setPendingOrder($order_id);
				$this->app->redirect(BASE_URL . 'confirm-order');
					
			}

			$fileNameWithPath = $this->uploadTempArtwork(); //move artwork file to temp directory

			$this->render('order/create-2',array(
				'token'   => Session::setToken(),
				'categoryType' => $category_type,
				'categoryName' => $orderCategories[$category_type],
				'fileNameWithPath' => $fileNameWithPath
			));

		}
		 
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
				$order['category']      =  Parameters::getParameters('orderCategory')[$order['category']]; //Get the text for order category
				$order['delivery_type'] = Parameters::getParameters('deliveryType')[$order['delivery_type']];
			}

			$order_lines = OrderLine::getOrderLines($order_id);          
            $address = Address::getAddressForContactId($contact_id);
            $communication = Communication::getCommunicationForContactId($contact_id);
            $customer = Customers::getCustomer($contact_id);  
        }
		
		$this->render('order/confirm', compact('address','communication','customer','order','order_lines'));
	}

	public function uploadTempArtwork()
	{
		if ( count($_FILES) == 1 && isset( $_FILES['artwork']) ){

				if($_FILES['artwork']['error'] != 0){
					//log the error
				}
				else{

					$fileTmpPath = $_FILES['artwork']['tmp_name'];
					$fileName    = uniqid() . $_FILES['artwork']['name'] ;
					$fileNameWithPath = ARTWORK_UPLOAD_PATH_TEMP .$fileName;
					move_uploaded_file( $fileTmpPath, $fileNameWithPath);
					return $fileNameWithPath;
				}
			}
	}

	public function getOrderLines($req, $order_id,$artwork_id)
	{
		$rowCount = count($req->post('desc'));

		$insertRows = array();
		for($i=0; $i < $rowCount; $i++){

			$total_pieces = $req->post('qty_youth_xs')[$i] + $req->post('qty_youth_s')[$i] + $req->post('qty_youth_m')[$i] + $req->post('qty_youth_l')[$i] + $req->post('qty_youth_xl')[$i] + $req->post('qty_adult_xs')[$i] + $req->post('qty_adult_s')[$i] + $req->post('qty_adult_m')[$i] + $req->post('qty_adult_l')[$i] + $req->post('qty_adult_xl')[$i] + $req->post('qty_adult_2xl')[$i] + $req->post('qty_adult_3xl')[$i] + $req->post('qty_adult_4xl')[$i] + $req->post('qty_adult_5xl')[$i] + $req->post('qty_adult_6xl')[$i];
	
			$insertRows[] = array(
									'desc'  	    => $req->post('desc')[$i],
									'brand'			=> $req->post('brand')[$i],
									'style' 	    => $req->post('style')[$i],
									'color'         => $req->post('color')[$i],
									'order_id'      => $order_id,
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
									'total_pieces'  => $total_pieces,											
									'artwork_id'    => $artwork_id 

							);
		}

		return $insertRows;
	}

	public function createReOrderAction()
	{
		echo "create";
	}

}