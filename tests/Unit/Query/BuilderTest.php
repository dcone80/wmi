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
        $this->builder->select(null);

        $this->assertInstanceOf('Stevebauman\Wmi\Query\Expressions\Select', $this->builder->getSelect());
        $this->assertEquals('SELECT *', $this->builder->getSelect()->build());
    }

    public function testSelectString()
    {
        $this->builder->select('Test');

        $this->assertEquals('SELECT Test', $this->builder->getSelect()->build());
    }

    public function testSelectArray()
    {
        $this->builder->select(['Test', 'Test']);

        $this->assertEquals('SELECT Test, Test', $this->builder->getSelect()->build());
    }
}
