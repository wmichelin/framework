<?php

namespace App\Tests\DependencyInjection;

use App\DependencyInjection\IocContainer;
use PHPUnit\Framework\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function testHelloWorld()
    {
        $ioc = new IocContainer();
        $ioc->register(Bar::class, Foo::class);
        $this->assertEquals($ioc->invoke([$this, 'fooFunction']), 'doing foo');
    }

    public function fooFunction(Bar $myObj)
    {
        return $myObj->doFoo();
    }
}

class Foo implements Bar
{
    public function doFoo()
    {
        return 'doing foo';
    }
}

interface Bar
{
    public function doFoo();
}
