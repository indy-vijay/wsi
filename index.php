<?php 
require 'vendor/autoload.php';
 use Slim\Slim;
 use Slim\Views\Twig as Twig;

$app = new Slim(
				  array(
				  		'view' => new Twig,
				  		'mode' => 'development',
				  		'debug' => true
				  	)
				);

$view = $app->view();
$view->setTemplatesDirectory('app/views/');
// $view->parserExtensions = array(new \Slim\Views\TwigExtension());
$view = $app->view()->getEnvironment();
$view->addGlobal('httpBasePath', BASE_URL);
$view->addGlobal('includePath', INC_PATH);
$app->get('/register/', function () use ($app){

    // echo "Hello, " . $name;
	$app->render('register.html');
});
$app->run();