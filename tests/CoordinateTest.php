<?php

namespace MyVendor\Amidakuji;

/**
 * Coordinateクラスのテストクラス
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        try {
            $coordinate = new Coordinate(null, null);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(null, 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(1, null);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('y is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate('a', 'b');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate('a', 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(1, 'b');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('y is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate('1', '2');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate('1', 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(1, '2');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('y is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(1.1, 2.2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(1.1, 2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('x is not integer.', $e->getMessage());
        }
        try {
            $coordinate = new Coordinate(1, 2.2);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('y is not integer.', $e->getMessage());
        }
    }

    /**
     * @depends testException
     */
    public function testNew()
    {
        $coordinate = new Coordinate(1, 2);
        $this->assertInstanceOf('\MyVendor\Amidakuji\Coordinate', $coordinate);

        return $coordinate;
    }

    /**
     * @depends testNew
     */
    public function testGetX(Coordinate $coordinate)
    {
        $this->assertEquals($coordinate->getX(), 1);
    }

    /**
     * @depends testNew
     */
    public function testGetY(Coordinate $coordinate)
    {
        $this->assertEquals($coordinate->getY(), 2);
    }

    /**
     * @depends testNew
     */
    public function testIsSameCoordinate(Coordinate $coordinate)
    {
        $this->assertTrue($coordinate->isSameCoordinate(1, 2));
        $this->assertFalse($coordinate->isSameCoordinate(1, 1));
        $this->assertFalse($coordinate->isSameCoordinate(2, 2));
        $this->assertFalse($coordinate->isSameCoordinate(3, 4));
        $this->assertFalse($coordinate->isSameCoordinate('a', 'b'));
        $this->assertFalse($coordinate->isSameCoordinate(null, null));
    }

    /**
     * @depends testNew
     */
    public function testEquals(Coordinate $coordinate)
    {
        $coordinate11 = new Coordinate(1, 1);
        $coordinate12 = new Coordinate(1, 2);
        $coordinate22 = new Coordinate(2, 2);
        $coordinate34 = new Coordinate(3, 4);
        $this->assertTrue($coordinate->equals($coordinate12));
        $this->assertFalse($coordinate->equals($coordinate11));
        $this->assertFalse($coordinate->equals($coordinate22));
        $this->assertFalse($coordinate->equals($coordinate34));
    }

    /**
     * @depends testNew
     */
    public function testCompareTo(Coordinate $coordinate)
    {
        $coordinate01 = new Coordinate(0, 1);
        $coordinate02 = new Coordinate(0, 2);
        $coordinate03 = new Coordinate(0, 3);
        $coordinate11 = new Coordinate(1, 1);
        $coordinate12 = new Coordinate(1, 2);
        $coordinate13 = new Coordinate(1, 3);
        $coordinate21 = new Coordinate(2, 1);
        $coordinate22 = new Coordinate(2, 2);
        $coordinate23 = new Coordinate(2, 3);
        $this->assertEquals($coordinate->compareTo($coordinate01), 1);
        $this->assertEquals($coordinate->compareTo($coordinate02), 1);
        $this->assertEquals($coordinate->compareTo($coordinate03), 1);
        $this->assertEquals($coordinate->compareTo($coordinate11), 1);
        $this->assertEquals($coordinate->compareTo($coordinate12), 0);
        $this->assertEquals($coordinate->compareTo($coordinate13), -1);
        $this->assertEquals($coordinate->compareTo($coordinate21), -1);
        $this->assertEquals($coordinate->compareTo($coordinate22), -1);
        $this->assertEquals($coordinate->compareTo($coordinate23), -1);
    }
}
