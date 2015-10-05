<?php 
session_start();
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
$view->addGlobal('customIncludePath', CUSTOM_INC_PATH);

	
$app->addRoutes(unserialize(CUSTOM_ROUTES));
$app->run();