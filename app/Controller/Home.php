<?php

namespace Controller;
class Home
{
    protected $request;
    protected $response;
    public function indexAction()
    {
        echo "This is the home page";
    }
    public static function helloAction()
    {
        echo "Hello,";
    }
    public function setApp($app)
    {
        $this->app = $app;
    }
    public function setRequest($request)
    {
        $this->request = $request;
    }
    public function setResponse($response)
    {
        $this->response = $response;
    }
}