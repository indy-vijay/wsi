<?php

namespace Controller;
class Register extends \SlimController\SlimController
{
    protected $request;
    protected $response;
    public function indexAction()
    {
       $this->render('home/index', array(
            'someVar' => date('c')
        ));
    }
    
}