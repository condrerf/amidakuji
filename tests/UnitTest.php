<?php

namespace MyVendor\Amidakuji;

/**
 * Unitクラスのテストクラス
 */
class UnitTest extends \PHPUnit_Framework_TestCase
{
    public function testNew()
    {
        $unit = new Unit();
        $this->assertInstanceOf('\MyVendor\Amidakuji\Unit', $unit);

        return $unit;
    }

    /**
     * @depends testNew
     */
    public function testMoveTo()
    {
        $coordinate = new Coordinate(1, 2);
        $unit = new Unit();
        $unit->moveTo($coordinate);
    }

    /**
     * @depends testNew
     */
    public function testGetCoordinate()
    {
        // 初期値は0, 0
        $unit = new Unit();
        $this->assertTrue($unit->getCoordinate()->equals(new Coordinate(0, 0)));

        $coordinate = new Coordinate(1, 2);
        $unit->moveTo($coordinate);
        $this->assertTrue($unit->getCoordinate()->equals($coordinate));
    }

    /**
     * @depends testNew
     */
    public function testGetX()
    {
        // 初期値は0
        $unit = new Unit();
        $this->assertEquals($unit->getX(), 0);

        $coordinate = new Coordinate(1, 2);
        $unit->moveTo($coordinate);
        $this->assertEquals($unit->getX(), 1);
    }

    /**
     * @depends testNew
     */
    public function testGetY()
    {
        // 初期値は0
        $unit = new Unit();
        $this->assertEquals($unit->getY(), 0);

        $coordinate = new Coordinate(1, 2);
        $unit->moveTo($coordinate);
        $this->assertEquals($unit->getY(), 2);
    }
}
