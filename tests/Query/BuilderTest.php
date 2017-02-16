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

    public function test_where_with_array()
    {
        $wheres = [
            'one' => 'value',
            'two' => 'value',
        ];

        $query = $this->newBuilder()
            ->where($wheres)
            ->from('class')
            ->getQuery();

        $this->assertEquals("select * from class where one = 'value' and two = 'value'", $query);
    }

    public function test_where_and()
    {
        $query = $this->newBuilder()
            ->where('one', '=', 'value')
            ->where('two', '=', 'value')
            ->from('class')
            ->getQuery();

        $this->assertEquals("select * from class where one = 'value' and two = 'value'", $query);
    }

    public function test_where_and_multiple()
    {
        $query = $this->newBuilder()
            ->where('one', '=', 'value')
            ->where('two', '=', 'value')
            ->where('three', '=', 'value')
            ->from('class')
            ->getQuery();

        $this->assertEquals(
            "select * from class where one = 'value' and two = 'value' and three = 'value'",
            $query
        );
    }

    public function test_or_where()
    {
        $query = $this->newBuilder()
            ->where('one', '=', 'value')
            ->orWhere('two', '=', 'value')
            ->from('class')
            ->getQuery();

        $this->assertEquals(
            "select * from class where one = 'value' or two = 'value'",
            $query
        );
    }

    public function test_or_where_multiple()
    {
        $query = $this->newBuilder()
            ->where('one', '=', 'value')
            ->orWhere('two', '=', 'value')
            ->orWhere('three', '=', 'value')
            ->from('class')
            ->getQuery();

        $this->assertEquals(
            "select * from class where one = 'value' or two = 'value' or three = 'value'",
            $query
        );
    }

    public function test_or_where_is_assumed_as_where()
    {
        $query = $this->newBuilder()
            ->orWhere('field', '=', 'value')
            ->from('class')
            ->getQuery();

        $this->assertEquals(
            "select * from class where field = 'value'",
            $query
        );

        $query = $this->newBuilder()
            ->orWhere('one', '=', 'value')
            ->orWhere('two', '=', 'value')
            ->from('class')
            ->getQuery();

        $this->assertEquals(
            "select * from class where one = 'value' or two = 'value'",
            $query
        );
    }

    /**
     * @expectedException \Stevebauman\Wmi\Query\InvalidOperatorException
     */
    public function test_where_invalid_operator()
    {
        $this->newBuilder()->where('field', 'invalid', 'value');
    }

    public function test_within()
    {
        $query = $this->newBuilder()
            ->from('class')
            ->within('500')
            ->getQuery();

        $this->assertEquals("select * from class within 500", $query);
    }

    public function test_where_between()
    {
        $query = $this->newBuilder()
            ->from('class')
            ->whereBetween('date', '2015', '2016')
            ->getQuery();

        $this->assertEquals("select * from class where date >= '2015' and date <= '2016'", $query);
    }

    public function test_or_where_between()
    {
        $query = $this->newBuilder()
            ->from('class')
            ->whereBetween('date', '2015', '2016')
            ->orWhereBetween('other', '2016', '2017')
            ->getQuery();

        $this->assertEquals("select * from class where date >= '2015' and date <= '2016' or other >= '2016' and other <= '2017'", $query);
    }

    protected function newBuilder($connection = null, $grammar = null)
    {
        $connection = $connection ?: Mockery::mock(ConnectionInterface::class);

        $grammar = $grammar ?: new Grammar();

        return new Builder($connection, $grammar);
    }
}
