<?php

namespace App\Controllers;

use App\Views\Providers\TemplateEngineProvider;

class TestController
{
    private $tpl;

    public function __construct()
    {
        $this->tpl = TemplateEngineProvider::getInstance();
    }

    public function test()
    {
        return 'hello from controller';
    }

    public function index($parameter = '')
    {
        return $this->tpl->render('index');
    }

    public function testWorld()
    {
        return 'hello test world';
    }
}
