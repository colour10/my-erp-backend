<?php

namespace Test;

/**
 * 简单测试用例，仅仅用来测试
 * Class SimpleTest
 * @package Test
 */
class SimpleTest extends \UnitTestCase
{
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);
        return $stack;
    }


    /**
     * @depends testEmpty
     * @param array $stack
     * @return array
     */
    public function testPush(array $stack)
    {
        array_push($stack, 'push');
        $this->assertEquals('push', $stack[count($stack) - 1]);
        $this->assertNotEmpty($stack);
        return $stack;
    }

    /**
     * @depends testPush
     * @param array $stack
     */
    public function testPop(array $stack)
    {
        $this->assertEquals('push', array_pop($stack));
        $this->assertEmpty($stack);
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }


    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     * @param $a
     * @param $b
     */
    public function testConsumer($a, $b)
    {
        $this->assertSame('first', $a);
        $this->assertSame('second', $b);
    }

    /**
     * 期望输出测试
     */
    public function testExpectFoo()
    {
        $this->expectOutputString('foo');
        print 'foo';
    }

}

