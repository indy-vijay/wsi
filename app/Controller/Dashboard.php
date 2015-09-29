<?php 
namespace Controller;
use \Customers;
use \Address;
use \Communication;

class Dashboard extends \SlimController\SlimController
{

    protected $request;
    protected $response;

    public function indexAction()
    {
        $req = $this->app->request();
    	$contact_id = Login::isLoggedIn();

    	if(!$contact_id || ! $contact_id > 0){

    		$this->render('invalid');

    	}
    	else{
                 
            $address = Address::getAddressForContactId($contact_id);
            $communication = Communication::getCommunicationForContactId($contact_id);
            $customer = Customers::getCustomer($contact_id);  

            if(count($address) > 0 )
                $address = $address[0];

            if(count($communication) > 0 )
                $communication = $communication[0];

            if(count($customer) > 0 )
                $customer = $customer[0];

                    // echo "<pre>";
                    //              print_r($address);
                    //                      echo "<pre>";
                    //                      print_r($communication);
                    //                              echo "<pre>";
                    //                              print_r($customer);
                    //                              die;
                    //                      die;
                    //              die;             

    		$this->render('dashboard/home',compact('address','communication','customer'));
    	}
    }
}

?>