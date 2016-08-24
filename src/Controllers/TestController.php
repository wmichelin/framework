<?php

namespace App\Controllers;

use App\Views\Providers\TemplateEngineProvider;

class TestController
{
    public function test()
    {
        return 'hello from controller';
    }

    public function index($parameter = '')
    {
        $templateEngine = TemplateEngineProvider::getInstance();

        return $templateEngine->render('index');
    }

    public function testWorld()
    {
        return 'hello test world';
    }
}
