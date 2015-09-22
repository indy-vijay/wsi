<?php 
require 'vendor/autoload.php';
use Slim\Slim;
use Slim\Views\Twig as Twig;
use Illuminate\Database\Capsule\Manager as Capsule;





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

//DB stuff
$capsule = new Capsule;
$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => '127.0.0.1',
	'database'  => 'wsi',
	'username'  => 'root',
	'password'  => '',
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci'
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
// Customers::create([
// 					'first_name' => 'Indy',
// 					'last_name'  => 'Test',
// 					'company_name' => '2hats'
// ]);
echo "done";
die;

die;
var_dump($capsule);die;

$app->get('/register/', function () use ($app){

    // echo "Hello, " . $name;
	$app->render('register.html');
});
$app->run();