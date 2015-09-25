<?php
namespace Controller;
use \Customers;
use \Address;
use \Communication;

class Login extends \SlimController\SlimController
{
    protected $request;
    protected $response;

    public function indexAction()
    {

    	// var_dump(\Customers::where('contact_id',9)->get()->toArray());
       $this->render('customer/login', array(
           'token' => Session::setToken()
        ));
    }

    public function submitAction()
    {
    	$req = $this->app->request();
    	$message = 'Failed';

    	if(Session::validateSubmission($req)){
    
    		$contact_id = Customers::getCustomerLogin($req); 
       
            if(!empty($contact_id) && $contact_id[0]['contact_id'] > 0){
                $message = "Logged in successfully";
                $this->loginAction($contact_id[0]['contact_id']);
            }
            
            $this->render('customer/login', array(
                      'message' => $message,
                      'token'   => Session::setToken()
             ));
    		
    	}
    	else{
    		$this->render('invalid');
    	}
    }

    public static function loginAction($contact_id)
    {
        //this should be extended in the future
        $_SESSION['contact_id'] = $contact_id;
    }

    public static function isLoggedIn()
    {
       return ($_SESSION['contact_id'] > 0 ) ? true : false;
    }

    public static function logoutAction()
    {
        unset( $_SESSION['contact_id']);
    }
    
}