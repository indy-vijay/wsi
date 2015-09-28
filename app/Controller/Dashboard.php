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
    	$contact_id = Login::isLoggedIn();

    	if(!$contact_id || ! $contact_id > 0){

    		$this->render('invalid');

    	}
    	else{

    		$this->render('dashboard/home');
    	}
    }
}

?>