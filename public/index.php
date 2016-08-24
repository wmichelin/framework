<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Application\Application;
use App\Router\Router;

$app = new Application(new Router());
$app->start();
