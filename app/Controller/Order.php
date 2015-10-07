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
					
					if(copy($artworkUploaded, getcwd() . ARTWORK_UPLOAD_PATH . $newFileName)){

						
						$artwork_id = Artworks::createArtwork($contact_id, $design_name, $artworkUploaded,$preview_image);

					}
					else{
						//Log the file copy error
					}
				}
				else{
					 //Log the file not found error
				}
				//create order lines
				$rowCount = count($req->post('desc'));

				$insertRows = array();
				for($i=0; $i < $rowCount; $i++){
			
					$insertRows[] = array(
											'desc'  	    => $req->post('desc')[$i],
											'brand'			=> $req->post('brand')[$i],
											'style' 	    => $req->post('style')[$i],
											// 'color'         => $req->post('color')[$i],
											'color'         => 'Black',
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
											'total_pieces'  => 20,											
											'artwork_id'    => $artwork_id 

									);
				}
			
				OrderLine::insert($insertRows);
					
			}

			if ( count($_FILES) == 1 && isset( $_FILES['artwork']) ){

				if($_FILES['artwork']['error'] != 0){
					//log the error
				}
				else{

					$fileTmpPath = $_FILES['artwork']['tmp_name'];
					$fileName    = uniqid() . $_FILES['artwork']['name'] ;
					$fileNameWithPath = getcwd() . ARTWORK_UPLOAD_PATH . "temp\\".$fileName;
					move_uploaded_file( $fileTmpPath, $fileNameWithPath);

				}
			}

			$this->render('order/create-2',array(
				'token'   => Session::setToken(),
				'categoryType' => $category_type,
				'categoryName' => $orderCategories[$category_type],
				'fileNameWithPath' => $fileNameWithPath
			));

		}
		 
	}

	public function createReOrderAction()
	{
		echo "create";
	}

}