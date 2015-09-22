<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';

use SlimController\SlimController;
use Slim\Views\Twig as Twig;
// init app
$app = New \SlimController\Slim(array(
    'view' => new Twig,
    'templates.path'             =>   'app/views/',
    'controller.class_prefix'    => '\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php',
));
$view = $app->view();
$view = $app->view()->getEnvironment();
$view->addGlobal('httpBasePath', BASE_URL);
$view->addGlobal('includePath', INC_PATH);
// how to integrate the Slim middleware
$app->addRoutes(array(
    '/' => array('Home:index', function() {
            error_log("MIDDLEWARE FOR SINGLE ROUTE");
        },
        function() {
            error_log("ADDITIONAL MIDDLEWARE FOR SINGLE ROUTE");
        }
    ),
    '/hello/:name' => array('post' => array('Home:hello', function() {
            error_log("THIS ROUTE IS ONLY POST");
        }
    ))
), function() {
    error_log("APPENDED MIDDLEWARE FOR ALL ROUTES");
});
$app->addRoutes(array(
    '/register'            => 'Register:index'
));
$app->run();