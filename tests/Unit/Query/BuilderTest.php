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

    public function testWhereWithoutValue()
    {
        $this->builder->where('test', 'test');

        $wheres = $this->builder->getWheres();

        $this->assertEquals("WHERE test = 'test'", $wheres[0]->build());
    }

    public function testWhereWithValue()
    {
        $this->builder->where('test', '=', 'test');

        $wheres = $this->builder->getWheres();

        $this->assertEquals("WHERE test = 'test'", $wheres[0]->build());
    }

    public function testWhereInvalidOperator()
    {
        $this->setExpectedException('Stevebauman\Wmi\Exceptions\Query\InvalidOperatorException');

        $this->builder->where('test', 'invalid', 'test');
    }

    public function testOrWhereWithValue()
    {
        $this->builder->orWhere('test', '=', 'test');

        $wheres = $this->builder->getOrWheres();

        $this->assertEquals(" OR WHERE test = 'test'", $wheres[0]->build());
    }

    public function testAndWhereWithValue()
    {
        $this->builder->andWhere('test', '=', 'test');

        $wheres = $this->builder->getAndWheres();

        $this->assertEquals(" AND WHERE test = 'test'", $wheres[0]->build());
    }

    public function testFrom()
    {
        $this->builder->from('Test');

        $this->assertEquals('FROM Test', $this->builder->getFrom()->build());
    }

    public function testGetWithoutFromStatementFailure()
    {
        $this->setExpectedException('Stevebauman\Wmi\Exceptions\Query\InvalidFromStatement');

        $this->builder->get();
    }

    public function testWithinWithInteger()
    {
        $this->builder->within(10);

        $this->assertEquals(' WITHIN 10', $this->builder->getWithin()->build());
    }

    public function testWithinWithString()
    {
        $this->builder->within('100');

        $this->assertEquals(' WITHIN 100', $this->builder->getWithin()->build());
    }
}
