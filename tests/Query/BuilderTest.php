<?php

namespace Stevebauman\Wmi\Tests\Query;

use Mockery;
use Stevebauman\Wmi\Query\Builder;
use Stevebauman\Wmi\Query\Grammar;
use Stevebauman\Wmi\Tests\TestCase;
use Stevebauman\Wmi\ConnectionInterface;

class BuilderTest extends TestCase
{
    public function test_new_instance()
    {
        $this->assertInstanceOf(Builder::class, $this->newBuilder()->newInstance());
    }

    public function test_from()
    {
        $query = $this->newBuilder()->from('class')->getQuery();

        $this->assertEquals('select * from class', $query);
    }

    /**
     * @expectedException \Stevebauman\Wmi\Query\InvalidFromStatementException
     */
    public function test_invalid_from_statement()
    {
        $this->newBuilder()->get();
    }

    public function test_select_none()
    {
        $query = $this->newBuilder()->select(null)->from('class')->getQuery();

        $this->assertEquals('select * from class', $query);
    }

    public function test_select_string()
    {
        $query = $this->newBuilder()->select('test')->from('class')->getQuery();

        $this->assertEquals('select test from class', $query);
    }

    public function test_select_array()
    {
        $query = $this->newBuilder()->select(['one', 'two'])->from('class')->getQuery();

        $this->assertEquals('select one, two from class', $query);
    }

    public function test_where()
    {
        $query = $this->newBuilder()->where('field', '=', 'value')->from('class')->getQuery();

        $this->assertEquals("select * from class where field = 'value'", $query);
    }

    protected function newBuilder($connection = null, $grammar = null)
    {
        $connection = $connection ?: Mockery::mock(ConnectionInterface::class);

        $grammar = $grammar ?: new Grammar();

        return new Builder($connection, $grammar);
    }
}
