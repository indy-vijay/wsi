<?php
namespace Controller;
use \Customers;
use \Address;
use \Communication;

class Register extends \SlimController\SlimController
{
    protected $request;
    protected $response;
    public function indexAction()
    {
    	$_SESSION['token'] = uniqid();
    	// var_dump(\Customers::where('contact_id',9)->get()->toArray());
       $this->render('customer/register', array(
           'token' => $_SESSION['token']
        ));
    }

    public function submitAction()
    {
    	$req = $this->app->request();
    	
    	if($req->isPost() && isset($_SESSION['token']) && $req->post('token') == $_SESSION['token'] ){

    		unset($_SESSION['token']);//prevent page refresh 
    
    		$contact_id = Customers::createCustomer($req); //create new customer    		    	
            Address::createAddress($req,$contact_id);
            Communication::createCommunication($req,$contact_id);

    		$this->render('customer/register_success', array(
         			 //  'someVar' => date('c')
       		 ));
    	}
    	else{
    		$this->render('invalid');
    	}
    }
    
}