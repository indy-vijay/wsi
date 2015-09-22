<?php
namespace Controller;
class Register extends \SlimController\SlimController
{
    protected $request;
    protected $response;
    public function indexAction()
    {
       $this->render('customer/register', array(
          //  'someVar' => date('c')
        ));
    }
    
    
}