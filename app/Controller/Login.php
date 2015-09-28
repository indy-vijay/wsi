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
                $this->loginAction($contact_id[0]['contact_id']);
                $this->app->redirect('/dashboard');
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

    public function forgotAction()
    {
        $req                  = $this->app->request();
        $showSuccessMessage   = false;
        $showErrorMessage     = false;
        $submitted            = false;

        if($req->isPost()){ //form has been submitted

          if(! Session::validateSubmission($req)){
            $this->render('invalid');
            exit();
          }

          if(Communication::checkEmailExists($req->post('email'))){
            //send email
            $showSuccessMessage = true;
          }
          else 
            $showErrorMessage = true;

          $submitted = true;
        }
        
        $this->render('customer/forgot', array(
                  'showSuccessMessage' => $showSuccessMessage,
                  'showErrorMessage' => $showErrorMessage,
                  'token'   => Session::setToken()                 
         ));
     
    }

    public static function loginAction($contact_id)
    {
        //this should be extended in the future
        $_SESSION['contact_id'] = $contact_id;
    }

    public static function isLoggedIn()
    {
       return (isset($_SESSION['contact_id'])) ? $_SESSION['contact_id'] : false;
    }

    public static function logoutAction()
    {
        unset( $_SESSION['contact_id']);
    }


    
}