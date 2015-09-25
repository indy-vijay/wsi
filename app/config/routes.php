<?php
use SlimController\SlimController;
use Slim\Views\Twig as Twig;
// $app = new Slim(
// 				  array(
// 				  		'view' => new Twig,
// 				  		'mode' => 'development',
// 				  		'debug' => true
// 				  	)
// 				);
// $app->get('/login', 'User\AuthController:login')->name('login');
// init app

$app = New \SlimController\Slim(array(
    //'templates.path'             => APP_PATH . '/templates',
    'controller.class_prefix'    => '\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php',
));
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