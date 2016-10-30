<?php

namespace MyVendor\Amidakuji;

use MyVendor\Amidakuji\Line\TransverseLine;

/**
 * TransverseLineクラスのテストクラス
 */
class TransverseLineTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        // 幅が1でない要素がある
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(1, 1));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(1, 2));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(1, 3));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(3, 1));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(3, 3));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(5, 1));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(5, 2));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
        try {
            $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(5, 3));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('length of x is not 1.', $e->getMessage());
        }
    }

    /**
     * @depends testException
     */
    public function testNew()
    {
        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(2, 1));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(2, 1));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(2, 2));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(2, 3));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(2, 4));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(2, 5));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(4, 1));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(4, 2));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(4, 3));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(4, 4));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);

        $line = new TransverseLine(new Coordinate(3, 3), new Coordinate(4, 5));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\TransverseLine', $line);
    }
}
