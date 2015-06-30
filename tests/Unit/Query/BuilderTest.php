<?php

namespace Stevebauman\Wmi\Tests\Unit\Query;

use Mockery;
use Stevebauman\Wmi\Query\Builder;
use Stevebauman\Wmi\Tests\Unit\UnitTestCase;

class BuilderTest extends UnitTestCase
{
    /**
     * @var Builder
     */
    protected $builder;

    protected function setUp()
    {
        $mockConnection = Mockery::mock('Stevebauman\Wmi\ConnectionInterface');

        $this->builder = new Builder($mockConnection);
    }

    public function testSelectWildCard()
    {
        $this->builder->select('*');

        $this->assertInstanceOf('Stevebauman\Wmi\Query\Expressions\Select', $this->builder->getSelect());
        $this->assertEquals('SELECT *', $this->builder->getSelect()->build());
    }
}
