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
    		 $contact_id = Customers::insertGetId(
    							array( 
    										'first_name'   => $req->post('first_name'),
    										'last_name'    => $req->post('last_name'),
    										'company_name' => $req->post('company_name'),

    										)
    	                       );
    		
    		Customers::where('contact_id', $contact_id)
            		->update(array('username' => $contact_id));

            Address::create(
            					array(
            								'contact_id' => $contact_id,
            								'address_1'  => $req->post('address_1'),
            								'city'       => $req->post('city'),
            								'zip'        => $req->post('zip'),
            								'state'      => $req->post('state'),
            								'type'       => $req->post('B'),
            						)
            				);

            Communication::create(
            					array(
            								'contact_id' => $contact_id,
            								'email'      => $req->post('email'),
            								'home_phone' => $req->post('home_phone'),
            								'mobile'     => $req->post('mobile'),
            								'fax'        => $req->post('fax'),

            						)
            			    );
    		$this->render('customer/register_success', array(
         			 //  'someVar' => date('c')
       		 ));
    	}
    	else{
    		$this->render('invalid');
    	}
    }
    
}