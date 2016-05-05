<?php
namespace Controller;

use \Address;
use \Artworks as ArtworksModel;
use \Artworksplacements as ArtworksplacementsModel;
use \Desc;
use \Brands;
use \Colors;
use \Communication;
use \Customers;
use \OrderArtworks;
use \OrderLine;
use \Orders;
use \States;
use \Styles;

class Order extends \SlimController\SlimController
{

    public function createOrderAction()
    {
        $orderCategories = Parameters::getParameters('orderCategory');

        $this->render('order/create', array(
            'orderCategories' => $orderCategories,
        ));

    }

    public function createOrderStepTwoAction($category_type = "SP")
    {
        Session::setToken();
        $req = $this->app->request();
        $category_type = strtoupper($category_type);
        $fileNameWithPath = '';
        $id = 1;
        $orderCategories = Parameters::getParameters('orderCategory');
        $orderCategoryPlacement = Parameters::getOrderCategoryPlacement($category_type);
        $contact_id = Login::isLoggedIn();
        if (!array_key_exists($category_type, $orderCategories) || !($contact_id > 0)) {
            return $this->render('invalid');
        }

        $files['artworks'] = Artwork::uploadTempArtwork($req); //move artwork file to temp directory
        $desc   = Desc::all();
        $styles = Brands::categoryBrands($category_type)->first()->styles; //get styles for the first brand
        $colors = Styles::find($styles->first()->id)->colors;

        $this->render('order/create-2', array(
            'token' => Session::getToken(),
            'categoryType' => $category_type,
            'categoryName' => $orderCategories[$category_type],
            'fileNames' => $files['artworks']['design_name'],
            'thumbImagePath' => Artwork::getThumbPathForFile($fileNameWithPath),
            'placements' => $files['artworks']['placement'],
            'placementPosition' => Parameters::getParameters('placementPosition'),
            'orderCategoryPlacement' => $orderCategoryPlacement,
            'deliveryType' => Parameters::getParameters('deliveryType'),
            'desc'   => $desc->toArray(),
            //Edited on 05-05-2016 By Indy.
            // 'brands' => Brands::categoryBrands($category_type)->get()->toArray(),
            'brands' => $desc->first()->brands->toArray(),
            'styles' => $styles->toArray(),
            'colors' => $colors->toArray(),
        ));
    }

    public function createOrderStepTwoSubmitAction()
    {
        $req = $this->app->request();
        $contact_id = Login::isLoggedIn();
        $artwork_id = 0;
        $order_id = 0;
        if (!$this->step2Validation($req)) {
            return false;
        }

        $order_id = Orders::createOrder($req, $contact_id,'A');
        $artwork_id_array = Artwork::createArtwork($req, $order_id);
        foreach ($artwork_id_array as $artwork_id) {
            //create relationship between artworks and order
            OrderArtworks::create([
                'order_id' => $order_id,
                'artwork_id' => $artwork_id,
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

        if (null !== $req->post('order_placed') && $req->post('order_placed') == 1 && Session::validateSubmission($req) && Login::isLoggedIn() > 0)
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

        if (!$contact_id || !$contact_id > 0 || !$order_id > 0) {

            $this->render('invalid');

        } else {
            
            $order = Orders::getOrder($order_id, $contact_id);

            if (count($order) == 1) {
                $order = $order[0];
                $category_code = $order['category'];
                $order['category'] = Parameters::getParameters('orderCategory')[$order['category']]; //Get the text for order category
                $order['delivery_type'] = Parameters::getParameters('deliveryType')[$order['delivery_type']];

            }

            $order_lines = OrderLine::getOrderLines($order_id);
            $address = Address::getAddressForContactId($contact_id);
            $communication = Communication::getCommunicationForContactId($contact_id);
            $customer = Customers::getCustomer($contact_id);
            $states = States::all()->toArray();
        }

        $token = Session::setToken();

        $this->render('order/confirm', compact('address', 'communication', 'customer', 'order', 'order_lines', 'states', 'token', 'category_code'));
    }

    public function orderDetailAction($order_id)
    {
        $contact_id = Login::isLoggedIn();
        $req = $this->app->request();
        $isValidReq = false;
        $artworks = false;

        if ($contact_id > 0 && isset($order_id) && $order_id > 0) {

            $order = Orders::getOrder($order_id, $contact_id);
            $order_artworks = Orders::artworks($order_id);

            if (count($order) != 1) 
                return $this->render('invalid');

            $files = $this->getOrderArtworks($order_id);

            $order = $order[0];
         
            $category_code = $order['category'];
            $order['category'] = Parameters::getParameters('orderCategory')[$order['category']]; //Get the text for order category
            $order['delivery_type'] = Parameters::getParameters('deliveryType')[$order['delivery_type']];
            $order_lines = OrderLine::getOrderLines($order_id);
            $thumb_path = ARTWORK_THUMB_PATH;
            $placementPosition = Parameters::getParameters('placementPosition');
            $fileNames  = $files['artworks']['design_name'];
            $placements = $files['artworks']['placement'];
            $this->render('order/detail', compact('order', 'order_lines', 'category_code', 'order_artworks','placements' , 'thumb_path','placementPosition','fileNames'));
            
        }


    }

    public function confirmFinalAction()
    {
        $contact_id = Login::isLoggedIn();
        $req = $this->app->request();
        if (!$contact_id || !$contact_id > 0 || !Session::getPendingOrder()) {

            $this->render('invalid');

        } else {
            Orders::setStatus(Session::getPendingOrder(),'QR');
            Session::unsetPendingOrder();
            $this->render('order/confirm-final');
        }
    }

    public function createReOrderAction()
    {
        $contact_id = Login::isLoggedIn();
        $req = $this->app->request();

        if (!$contact_id || !($contact_id > 0)) {

            $this->render('invalid');
            return false;
        }

        $customerOrders = Orders::getOrdersForCustomer($contact_id);
        // $orderStatuses = Parameters::getParameters('orderStatus');
        $token = Session::setToken();

        $this->render('order/reorder-create', compact('customerOrders', 'token'));

    }

    public function createReOrderStepTwoAction($order_id)
    {
        $contact_id = Login::isLoggedIn();
        $req = $this->app->request();
        $isValidReq = false;
        if ($contact_id > 0 && isset($order_id) && $order_id > 0) {
            $order = Orders::getOrder($order_id, $contact_id);
            if (count($order) == 1) {
                $files['artworks'] = Artwork::uploadTempArtwork($req); //move artwork file to temp directory
               
                 if (!$req->isPost()) {
                    $order_artworks = Orders::artworks($order_id);
                    $order_artworks_placements = Orders::artwork_placement($order_id);
            
                    foreach ($order_artworks as $file) {
                        $files['artworks']['design_name'][$file->artwork_id] = $file->design_name;
                    }

                    foreach ($order_artworks_placements as $file) {
                        $files['artworks']['placement'][$file->artwork_id] = $file->artwork_placement;
                    }

                }
           
                $order = $order[0];
                $category_type = $order['category'];
                $order_line_brand = OrderLine::getOrderLines($order_id);
              
                $desc = Desc::all();
                //Edited on 05-05-2016 By Indy.
                // $styles = Brands::categoryBrandsSelected($category_type, $order_line_brand[0]['brand'])->first()->styles;
                foreach($order_line_brand as $order_line){
                    $desc_id  = Desc::getIdByName($order_line['desc']);
                    $brand_id = Brands::getIdByName($order_line['brand']);
                    $style_id = Styles::getIdByName($order_line['style']);
                    $brands[] = Desc::find($desc_id[0]['id'])->brands;
                    $styles[] = Brands::find($brand_id[0]['id'])->styles;
                    $colors[] = Styles::find($style_id[0]['id'])->colors;

                }

             
                //Edited on 05-05-2016 By Indy.
                // $styles            = Brands::categoryBrands($category_type)->first()->styles;
                

                //$delivery_type_name = Parameters::getParameters('deliveryType')[$order['delivery_type']];
                
                //Used for hidden fields
                // $styles = Brands::categoryBrands($category_type)->first()->styles; //get styles for the first brand
                // $colors = Styles::find($styles->first()->id)->colors;
                $order_lines = OrderLine::getOrderLines($order_id);
                $orderCategoryPlacement = Parameters::getOrderCategoryPlacement($category_type);
                $this->render('order/reorder-create2', array(
                    'token' => Session::setToken(),
                    'order' => $order,
                    'categoryType' => $order['category'],
                    'categoryName' => Parameters::getParameters('orderCategory')[$order['category']],
                    'order_lines' => $order_lines,
                    'order_lines_count' => count($order_lines),
                    'orderDeliveryType' => $order['delivery_type'],
                    'deliveryType' => Parameters::getParameters('deliveryType'),
                    'inHandsDate' => $order['in_hands_date'],
                    'fileNames' => $files['artworks']['design_name'],
                    'desc'   => $desc->toArray(),
                    // 'brands' => Brands::categoryBrands($category_type)->get()->toArray(),
                    'brands' => $brands,
                    'styles' => $styles,
                    'colors' => $colors,
                    'notes'  => $order['order_notes'],
                    //'thumbImagePath'               => Artwork::getThumbPathForFile($fileNameWithPath),
                    'placements' => $files['artworks']['placement'],
                    'orderCategoryPlacement' => Parameters::getParameters('orderCategoryPlacement')[$order['category']],
                    'placementPosition' => Parameters::getParameters('placementPosition'),
                ));

            }

        }

        // if(! $isValidReq )
        //     $this->render('invalid');
    }

    public function submitReorderAction()
    {
        $contact_id = Login::isLoggedIn();
        $req = $this->app->request();
        $artwork_id = 0;

        if (null !== $req->post('order_placed') && $req->post('order_placed') == 1 && Session::validateSubmission($req) && $contact_id > 0) {

            //create order
            $order_id = Orders::createOrder($req, $contact_id);

            //create artwork
            $files['artworkUploaded'] = $req->post('fileNameWithPath');
            $files['placement'] = $req->post('placementUploaded');
         
            if (isset($files['artworkUploaded']) && count($files['artworkUploaded'] > 0)) {
                          
                foreach ($files['artworkUploaded'] as $num => $artworkUploaded) {
                    $artworkUploaded = ARTWORK_THUMB_BASE_PATH . $artworkUploaded;
                    if (strlen($artworkUploaded) > 0 && file_exists( $artworkUploaded)) {
                     
                        //move the file
                        $design_name = basename($artworkUploaded);
                        $preview_image = $artworkUploaded; //dummy, remove this with proper info
                        $newFileName = basename($artworkUploaded);

                        if (copy($artworkUploaded, ARTWORK_UPLOAD_PATH . $newFileName)) {

                            $artwork_id = ArtworksModel::createArtwork($contact_id, $design_name, $artworkUploaded, $preview_image);
                            $artwork_id_array[] = $artwork_id;
                            $placement_id_array[] = ArtworksplacementsModel::createArtworkPlacement($order_id, $artwork_id, $files['placement'][$num]);
                        } else {
                            //Log the file copy error
                            // echo "Error copying " . $artworkUploaded . " to " . ARTWORK_UPLOAD_PATH . $newFileName;
                        }
                    } else {
                        //Log the file not found error
                        // echo "File not found " .  $artworkUploaded ;die;
                    }
                }
                       
                foreach ($artwork_id_array as $artwork_id) {
                    //create relationship between artworks and order
                    OrderArtworks::create([
                        'order_id' => $order_id,
                        'artwork_id' => $artwork_id,
                    ]);
                }
            }
          
            //create order lines
            $insertRows = $this->getOrderLines($req, $order_id);
            OrderLine::insert($insertRows);
            unset($insertRows);

            Session::setPendingOrder($order_id);
            $this->app->redirect(BASE_URL . 'order-final');

        } else {
            $this->render('invalid');
        }

    }

    public function previousOrdersAction()
    {
        $req = $this->app->request();
        $contact_id = Login::isLoggedIn();

        if (!$contact_id || !$contact_id > 0) {

            $this->render('invalid');

        } else {

            $customerOrders = Orders::getOrdersForCustomer($contact_id);
            // $orderStatuses  = Parameters::getParameters('orderStatus');

            $this->render('order/previous', compact('customerOrders'));
        }
    }

    public function getOrderLines($req, $order_id)
    {
        $rowCount = count($req->post('desc'));

        $insertRows = array();
        for ($i = 0; $i < $rowCount; $i++) {
            
            $total_pieces = $this->getTotalPieces($i);

            $insertRows[] = array(
                'desc'  =>  Desc::name($req->post('desc')[$i]),
                'brand' => Brands::name($req->post('brand')[$i]),
                'style' => Styles::name($req->post('style')[$i]),
                'color' => Colors::name($req->post('color')[$i]),
                'order_id' => $order_id,
                // 'color'         => $req->post('color')[$i],
                'qty_youth_xs' => $req->post('qty_youth_xs')[$i],
                'qty_youth_s' => $req->post('qty_youth_s')[$i],
                'qty_youth_m' => $req->post('qty_youth_m')[$i],
                'qty_youth_l' => $req->post('qty_youth_l')[$i],
                'qty_youth_xl' => $req->post('qty_youth_xl')[$i],
                'qty_adult_xs' => $req->post('qty_adult_xs')[$i],
                'qty_adult_s' => $req->post('qty_adult_s')[$i],
                'qty_adult_m' => $req->post('qty_adult_m')[$i],
                'qty_adult_l' => $req->post('qty_adult_l')[$i],
                'qty_adult_xl' => $req->post('qty_adult_xl')[$i],
                'qty_adult_2xl' => $req->post('qty_adult_2xl')[$i],
                'qty_adult_3xl' => $req->post('qty_adult_3xl')[$i],
                'qty_adult_4xl' => $req->post('qty_adult_4xl')[$i],
                'qty_adult_5xl' => $req->post('qty_adult_5xl')[$i],
                'qty_adult_6xl' => $req->post('qty_adult_6xl')[$i],
                'total_pieces' => $total_pieces,

            );
        }

        return $insertRows;
    }

    public function getTotalPieces($i)
    {
        $req = $this->app->request();
        if (isset($req->post('total_pieces')[$i])) {
            return $req->post('total_pieces')[$i];
        }

        return $req->post('qty_youth_xs')[$i] + $req->post('qty_youth_s')[$i] + $req->post('qty_youth_m')[$i] + $req->post('qty_youth_l')[$i] + $req->post('qty_youth_xl')[$i] + $req->post('qty_adult_xs')[$i] + $req->post('qty_adult_s')[$i] + $req->post('qty_adult_m')[$i] + $req->post('qty_adult_l')[$i] + $req->post('qty_adult_xl')[$i] + $req->post('qty_adult_2xl')[$i] + $req->post('qty_adult_3xl')[$i] + $req->post('qty_adult_4xl')[$i] + $req->post('qty_adult_5xl')[$i] + $req->post('qty_adult_6xl')[$i];

    }

    public function getOrderArtworks($order_id)
    {
        $order_artworks = Orders::artworks($order_id);
        $order_artworks_placements = Orders::artwork_placement($order_id);
        $files = [];
        foreach ($order_artworks as $file) {
            $files['artworks']['design_name'][$file->artwork_id] = $file->design_name;
        }

        foreach ($order_artworks_placements as $file) {
            $files['artworks']['placement'][$file->artwork_id] = $file->artwork_placement;
        }

        if(count($files) == 0){
            $files['artworks']['design_name'] = [];
            $files['artworks']['placement']   = [];
        }

        return $files;
    }

}
