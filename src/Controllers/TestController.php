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

    public function index()
    {
        return "welcome";
    }

    public function fooBar($foo, $bar)
    {
        return $this->tpl->render('index', [
            'foo' => $foo,
            'bar' => $bar
        ]);
    }

    public function testWorld()
    {
        return 'hello test world';
    }

    public function helloWorld()
    {
        return 'hello world';
    }
}
