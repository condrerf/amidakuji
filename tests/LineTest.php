<?php

namespace MyVendor\Amidakuji;

use MyVendor\Amidakuji\Coordinate;
use MyVendor\Amidakuji\Line\Line;

/**
 * Lineクラスのテストクラス
 */
class LineTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        // 座標が同じ
        try {
            $line = new Line(new Coordinate(1, 2), new Coordinate(1, 2));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('initialCoordinate and terminalCoordinate are same coordinate.', $e->getMessage());
        }

        // 座標が-1以下の要素がある
        try {
            $line = new Line(new Coordinate(-1, 2), new Coordinate(3, 4));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('initialCoordinate is invalid.', $e->getMessage());
        }
        try {
            $line = new Line(new Coordinate(1, -1), new Coordinate(3, 4));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('initialCoordinate is invalid.', $e->getMessage());
        }
        try {
            $line = new Line(new Coordinate(1, 2), new Coordinate(-1, 4));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('terminalCoordinate is invalid.', $e->getMessage());
        }
        try {
            $line = new Line(new Coordinate(1, 2), new Coordinate(3, -1));
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('terminalCoordinate is invalid.', $e->getMessage());
        }
    }

    /**
     * @depends testException
     */
    public function testNew()
    {
        $line = new Line(new Coordinate(1, 2), new Coordinate(3, 4));
        $this->assertInstanceOf('\MyVendor\Amidakuji\Line\Line', $line);

        return $line;
    }

    public function testGetInitialCoordinate()
    {
        $coordinate = new Coordinate(2, 2);
        $coordinate11 = new Coordinate(1, 1);
        $coordinate12 = new Coordinate(1, 2);
        $coordinate13 = new Coordinate(1, 3);
        $coordinate21 = new Coordinate(2, 1);
        $coordinate23 = new Coordinate(2, 3);
        $coordinate31 = new Coordinate(3, 1);
        $coordinate32 = new Coordinate(3, 2);
        $coordinate33 = new Coordinate(3, 3);

        // 始点と終点が逆転
        $this->assertEquals((new Line($coordinate, $coordinate11))->getInitialCoordinate(), $coordinate11);
        $this->assertEquals((new Line($coordinate, $coordinate12))->getInitialCoordinate(), $coordinate12);
        $this->assertEquals((new Line($coordinate, $coordinate13))->getInitialCoordinate(), $coordinate13);
        $this->assertEquals((new Line($coordinate, $coordinate21))->getInitialCoordinate(), $coordinate21);

        // 正常
        $this->assertEquals((new Line($coordinate, $coordinate23))->getInitialCoordinate(), $coordinate);
        $this->assertEquals((new Line($coordinate, $coordinate31))->getInitialCoordinate(), $coordinate);
        $this->assertEquals((new Line($coordinate, $coordinate32))->getInitialCoordinate(), $coordinate);
        $this->assertEquals((new Line($coordinate, $coordinate33))->getInitialCoordinate(), $coordinate);
    }

    public function testGetTerminalCoordinate()
    {
        $coordinate = new Coordinate(2, 2);
        $coordinate11 = new Coordinate(1, 1);
        $coordinate12 = new Coordinate(1, 2);
        $coordinate13 = new Coordinate(1, 3);
        $coordinate21 = new Coordinate(2, 1);
        $coordinate23 = new Coordinate(2, 3);
        $coordinate31 = new Coordinate(3, 1);
        $coordinate32 = new Coordinate(3, 2);
        $coordinate33 = new Coordinate(3, 3);

        // 正常
        $this->assertEquals((new Line($coordinate, $coordinate11))->getTerminalCoordinate(), $coordinate);
        $this->assertEquals((new Line($coordinate, $coordinate12))->getTerminalCoordinate(), $coordinate);
        $this->assertEquals((new Line($coordinate, $coordinate13))->getTerminalCoordinate(), $coordinate);
        $this->assertEquals((new Line($coordinate, $coordinate21))->getTerminalCoordinate(), $coordinate);

        // 始点と終点が逆転
        $this->assertEquals((new Line($coordinate, $coordinate23))->getTerminalCoordinate(), $coordinate23);
        $this->assertEquals((new Line($coordinate, $coordinate31))->getTerminalCoordinate(), $coordinate31);
        $this->assertEquals((new Line($coordinate, $coordinate32))->getTerminalCoordinate(), $coordinate32);
        $this->assertEquals((new Line($coordinate, $coordinate33))->getTerminalCoordinate(), $coordinate33);
    }

    public function testGetLength()
    {
        // 水平
        $this->assertEquals((new Line(new Coordinate(1, 1), new Coordinate(2, 1)))->getLength(), 1);
        $this->assertEquals((new Line(new Coordinate(1, 1), new Coordinate(3, 1)))->getLength(), 2);

        // 垂直
        $this->assertEquals((new Line(new Coordinate(1, 1), new Coordinate(1, 2)))->getLength(), 1);
        $this->assertEquals((new Line(new Coordinate(1, 1), new Coordinate(1, 3)))->getLength(), 2);

        // 斜め
        $this->assertEquals((new Line(new Coordinate(1, 1), new Coordinate(2, 2)))->getLength(), 1);
        $this->assertEquals((new Line(new Coordinate(1, 1), new Coordinate(3, 3)))->getLength(), 2);
    }
}
