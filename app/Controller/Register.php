<?php
namespace Controller;
class Register extends \SlimController\SlimController
{
    protected $request;
    protected $response;
    public function indexAction()
    {

    	// var_dump(\Customers::where('contact_id',9)->get()->toArray());
       $this->render('customer/register', array(
          //  'someVar' => date('c')
        ));
    }

    public function submitAction()
    {
    	$req = $this->app->request();

    	if($req->isPost() && $req->post('key') > 0){
    		 \Customers::create(
    							array( 
    										'first_name'=> $req->post('first_name'),
    										'last_name'=> $req->post('last_name'),

    										)
    	                       );
    		$this->render('customer/register_success', array(
         			 //  'someVar' => date('c')
       		 ));
    	}
    }
    
}