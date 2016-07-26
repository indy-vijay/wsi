<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

//exec("convert -resize 100x140 price.png -layers flatten anil.jpg ");die;

define('BASE_DIR', __DIR__);

require 'vendor/autoload.php';
require 'helpers.php';

use SlimController\SlimController;
use Slim\Views\Twig as Twig;

// use Rfd\ImageMagick\ImageMagick;
// use Rfd\ImageMagick\CLI\OperationFactory;
// use Rfd\ImageMagick\Image\File;
// use Rfd\ImageMagick\Options\CommonOptions;
// $im = new ImageMagick(new Rfd\ImageMagick\CLI\OperationFactory\OperationFactory());
// die;
// init app
$app = new \SlimController\Slim(array(
    'view' => new Twig,
    'templates.path' => 'app/views/',
    'controller.class_prefix' => '\\Controller',
    'controller.method_suffix' => 'Action',
    'controller.template_suffix' => 'php',
));


$view = $app->view();
$view = $app->view()->getEnvironment();
$view->addGlobal('httpBasePath', BASE_URL);
$view->addGlobal('includePath', INC_PATH);
$view->addGlobal('remoteURL', REMOTE_URL);
$view->addGlobal('customIncludePath', CUSTOM_INC_PATH);
$view->addGlobal('artworkThumbPath', ARTWORK_THUMB_REL_PATH);

$app->addRoutes(unserialize(CUSTOM_ROUTES));
$app->run();
