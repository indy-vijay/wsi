<?php
namespace Controller;
use \Customers;
use \Address;
use \Communication;
use States;

class Register extends \SlimController\SlimController
{
    protected $request;
    protected $response;
    public function indexAction()
    {
       	// var_dump(\Customers::where('contact_id',9)->get()->toArray());
       $states = States::all()->toArray();

       $this->render('customer/register', array(
           'token' => Session::setToken(),
           'REMOTE_URL' => REMOTE_URL ,
           'states' => $states
        ));
    }

    public function submitAction()
    {
    	$req = $this->app->request();
    	
    	if(Session::validateSubmission($req)){
    
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