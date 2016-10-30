<?php

namespace MyVendor\Amidakuji;

use MyVendor\Amidakuji\Line\VerticalLine;

/**
 * VerticalLineクラスのテストクラス
 */
class VerticalLineTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        // 整数でない要素がある
        try {
            $line = new VerticalLine(null, null);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(null, 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(1, null);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine('a', 'b');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine('a', 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(1, 'b');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine('1', '2');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine('1', 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(1, '2');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(1.1, 2.2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(1.1, 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $line = new VerticalLine(1, 2.2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length is not integer.', $e->getMessage());
        }
    }

    /**
     * @depends testException
     */
    public function testNew()
    {
        $line = new VerticalLine(1, 2);
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\VerticalLine', $line);

        return $line;
    }

    /**
     * @depends testNew
     */
    public function testGetX(VerticalLine $line)
    {
        $this->assertEquals($line->getX(), 1);
    }
}
