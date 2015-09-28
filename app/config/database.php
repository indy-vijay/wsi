<?php 
use Illuminate\Database\Capsule\Manager as Capsule;
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

