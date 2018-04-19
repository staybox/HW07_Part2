<?php
require("vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(['driver' => 'mysql', 'host' => 'localhost', 'database' => 'dz7', 'username' => 'root', 'password' => '', 'charset' => 'utf8', 'collation' => 'utf8_unicode_ci', 'prefix' => '',]);


$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
