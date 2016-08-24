<?php

use PHPUnit\Framework\TestCase;

use App\Request\Request;

class RequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new Request();
        $this->assertEmpty($request->getURI());
    }


}
