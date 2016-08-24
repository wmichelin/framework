<?php

use PHPUnit\Framework\TestCase;

use App\Controllers\TestController;

class TestControllerTest extends TestCase
{
    public function testHelloWorld()
    {
        $this->assertEquals((new TestController())->helloWorld(), "hello world");
    }

    
}
