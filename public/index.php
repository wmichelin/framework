<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Router\Router;
use App\Request\RequestFactory;
use App\Application\Application;

$app = new Application(new Router(), (new RequestFactory())->createFromRequest($_SERVER));
echo $app->start();
