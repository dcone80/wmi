<?php

namespace Stevebauman\Wmi\Tests;

use Stevebauman\Wmi\Wmi;

class WmiTest extends TestCase
{
    public function test_connect()
    {
        $com = $this->getMockBuilder(\stdClass::class)
            ->setMethods(['ConnectServer'])
            ->getMock();

        $com->expects($this->once())->method('ConnectServer')->with(
            'localhost',
            'namespace',
            'username',
            'password'
        );

        $wmi = new Wmi('localhost', 'username', 'password', $com);

        $wmi->connect('namespace');
    }
}
