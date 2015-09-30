<?php 
namespace Controller;
use \Customers;
use \Address;
use \Communication;
use \Orders;

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
            $customerOrders = Orders::getOrdersForCustomer($contact_id);
            $orderStatuses = Parameters::getParameters('orderStatus');
   
    		$this->render('dashboard/home',compact('address','communication','customer','customerOrders','orderStatuses'));
    	}
    }

    public function updateInfoAction()
    {
        $req = $this->app->request();
        $contact_id = Login::isLoggedIn();

        if(!$contact_id || ! $contact_id > 0){

            $this->render('invalid');
        }
        else{

           

            if($req->isPost() && Session::validateSubmission($req)){
                $this->updateUser($req);
            }
            
            $token = Session::setToken();
            $address = Address::getAddressForContactId($contact_id);
            $communication = Communication::getCommunicationForContactId($contact_id);
            $customer = Customers::getCustomer($contact_id);  
       
            $this->render('dashboard/update_info',compact('address','communication','customer','token'));
        }
    }

    public function updateUser($req)
    {
        $contact_id = Login::isLoggedIn();
        Customers::updateCustomer($req,$contact_id);
        Communication::updateCommunication($req,$contact_id);
        Address::updateAddress($req,$contact_id);
    }
}

?>