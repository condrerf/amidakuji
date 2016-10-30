<?php

namespace MyVendor\Amidakuji;

use MyVendor\Amidakuji\Line\TransverseLine;
use MyVendor\Amidakuji\Line\VerticalLine;

class FieldTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        // 整数でない
        try {
            $field = new Field('1', '2', '3');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineLength is not integer.', $e->getMessage());
        }
        try {
            $field = new Field('1', 2, 3);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineLength is not integer.', $e->getMessage());
        }
        try {
            $field = new Field(1, '2', 3);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineCount is not integer.', $e->getMessage());
        }
        try {
            $field = new Field(1, 2, '3');
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('transverseLineCount is not integer.', $e->getMessage());
        }

        // 有効範囲外の要素がある
        try {
            $field = new Field(
                Field::VERTICAL_LINE_LENGTH_MIN - 1,
                Field::VERTICAL_LINE_COUNT_MIN,
                Field::TRANSVERSE_LINE_COUNT_MIN
            );
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineLength is out of range.', $e->getMessage());
        }
        try {
            $field = new Field(
                Field::VERTICAL_LINE_LENGTH_MAX + 1,
                Field::VERTICAL_LINE_COUNT_MIN,
                Field::TRANSVERSE_LINE_COUNT_MIN
            );
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineLength is out of range.', $e->getMessage());
        }
        try {
            $field = new Field(
                Field::VERTICAL_LINE_LENGTH_MIN,
                Field::VERTICAL_LINE_COUNT_MIN - 1,
                Field::TRANSVERSE_LINE_COUNT_MIN
            );
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineCount is out of range.', $e->getMessage());
        }
        try {
            $field = new Field(
                Field::VERTICAL_LINE_LENGTH_MIN,
                Field::VERTICAL_LINE_COUNT_MAX + 1,
                Field::TRANSVERSE_LINE_COUNT_MIN
            );
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('verticalLineCount is out of range.', $e->getMessage());
        }
        try {
            $field = new Field(
                Field::VERTICAL_LINE_LENGTH_MIN,
                Field::VERTICAL_LINE_COUNT_MIN,
                Field::TRANSVERSE_LINE_COUNT_MIN - 1
            );
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('transverseLineCount is out of range.', $e->getMessage());
        }
        try {
            $field = new Field(
                Field::VERTICAL_LINE_LENGTH_MIN,
                Field::VERTICAL_LINE_COUNT_MIN,
                Field::TRANSVERSE_LINE_COUNT_MAX + 1
            );
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('transverseLineCount is out of range.', $e->getMessage());
        }
    }

    /**
     * @depends testException
     */
    public function testNew()
    {
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);

        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $this->assertInstanceOf('\MyVendor\Amidakuji\Field', $field);
    }

    /**
     * @depends testNew
     */
    public function testAddVerticalLine()
    {
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );

        // 長さがフィールドの高さと一致しない
        $line = new VerticalLine(Field::VERTICAL_LINE_LENGTH_MIN, Field::VERTICAL_LINE_LENGTH_MIN + 1);
        $this->assertFalse($field->addVerticalLine($line));

        // 既に同じX座標に線が設定
        $line = new VerticalLine(Field::VERTICAL_LINE_LENGTH_MIN - 1, Field::VERTICAL_LINE_LENGTH_MIN);
        $this->assertFalse($field->addVerticalLine($line));

        // 線を追加
        $line = new VerticalLine(Field::VERTICAL_LINE_LENGTH_MIN, Field::VERTICAL_LINE_LENGTH_MIN);
        $this->assertTrue($field->addVerticalLine($line));
        $line = new VerticalLine(Field::VERTICAL_LINE_LENGTH_MAX, Field::VERTICAL_LINE_LENGTH_MIN);
        $this->assertTrue($field->addVerticalLine($line));
        $line = new VerticalLine(Field::VERTICAL_LINE_LENGTH_MAX + 1, Field::VERTICAL_LINE_LENGTH_MIN);
        $this->assertTrue($field->addVerticalLine($line));

        // 設定可能な最大数まで線を追加
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );
        $line = new VerticalLine(Field::VERTICAL_LINE_COUNT_MAX + 1, Field::VERTICAL_LINE_LENGTH_MIN);
        $this->assertFalse($field->addVerticalLine($line));
    }

    /**
     * @depends testNew
     * @depends testAddVerticalLine
     */
    public function testAddTransverseLine()
    {
        // 有効範囲外(X)
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $line = new TransverseLine(
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX, 1),
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX + 1, 1)
        );
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX - 1, 1),
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX, 1)
        );
        $this->assertFalse($field->addTransverseLine($line));

        // 有効範囲外(Y)
        $line = new TransverseLine(
            new Coordinate(1, Field::VERTICAL_LINE_LENGTH_MAX - 1),
            new Coordinate(2, Field::VERTICAL_LINE_LENGTH_MAX)
        );
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(
            new Coordinate(1, Field::VERTICAL_LINE_LENGTH_MAX),
            new Coordinate(2, Field::VERTICAL_LINE_LENGTH_MAX - 1)
        );
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(
            new Coordinate(1, Field::VERTICAL_LINE_LENGTH_MAX),
            new Coordinate(2, Field::VERTICAL_LINE_LENGTH_MAX)
        );
        $this->assertFalse($field->addTransverseLine($line));

        // 有効範囲内
        $line = new TransverseLine(
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX - 2, 1),
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX - 1, 1)
        );
        $this->assertTrue($field->addTransverseLine($line));
        $line = new TransverseLine(
            new Coordinate(1, Field::VERTICAL_LINE_LENGTH_MAX - 1),
            new Coordinate(2, Field::VERTICAL_LINE_LENGTH_MAX - 1)
        );
        $this->assertTrue($field->addTransverseLine($line));

        // 始点/終点のいずれかの位置に縦線が設定されていない
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $line = new VerticalLine(Field::VERTICAL_LINE_COUNT_MAX, Field::VERTICAL_LINE_LENGTH_MIN);
        $this->assertTrue($field->addVerticalLine($line));
        $line = new TransverseLine(
            new Coordinate(Field::VERTICAL_LINE_COUNT_MIN - 1, 1),
            new Coordinate(Field::VERTICAL_LINE_COUNT_MIN, 1)
        );
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX - 1, 1),
            new Coordinate(Field::VERTICAL_LINE_COUNT_MAX, 1)
        );
        $this->assertFalse($field->addTransverseLine($line));

        // 始点・終点のいずれかが、これまでに追加した線に重なっている
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $line = new TransverseLine(new Coordinate(1, 1), new Coordinate(2, 1));
        $this->assertTrue($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(1, 1), new Coordinate(2, 2));
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(1, 2), new Coordinate(2, 1));
        $this->assertFalse($field->addTransverseLine($line));

        // これまでに追加した線と交差している
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $line = new TransverseLine(new Coordinate(1, 2), new Coordinate(2, 2));
        $this->assertTrue($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(1, 1), new Coordinate(2, 3));
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(1, 3), new Coordinate(2, 1));
        $this->assertFalse($field->addTransverseLine($line));

        // 左右の横線のいずれかと重なっている
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MAX,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $line = new TransverseLine(new Coordinate(1, 1), new Coordinate(2, 1));
        $this->assertTrue($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(3, 1), new Coordinate(4, 1));
        $this->assertTrue($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(2, 1), new Coordinate(3, 2));
        $this->assertFalse($field->addTransverseLine($line));
        $line = new TransverseLine(new Coordinate(3, 2), new Coordinate(4, 1));
        $this->assertFalse($field->addTransverseLine($line));

        // 設定可能な最大数まで線を追加
        $count = 10;
        $field = new Field(Field::VERTICAL_LINE_LENGTH_MAX, Field::VERTICAL_LINE_COUNT_MAX, $count);
        $x = 0;
        for ($y = 1; $y <= $count; $y++) {
            $line = new TransverseLine(new Coordinate($x, $y), new Coordinate($x + 1, $y));
            $this->assertTrue($field->addTransverseLine($line));
        }
        $y++;
        $line = new TransverseLine(new Coordinate($x, $y), new Coordinate($x + 1, $y));
        $this->assertFalse($field->addTransverseLine($line));
    }

    /**
     * @depends testAddVerticalLine
     */
    public function testGetWidth()
    {
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MIN,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MIN
        );
        $this->assertEquals($field->getWidth(), Field::VERTICAL_LINE_COUNT_MIN - 1);

        $field->addVerticalLine(new VerticalLine(Field::VERTICAL_LINE_COUNT_MIN, Field::VERTICAL_LINE_LENGTH_MIN));
        $this->assertEquals($field->getWidth(), Field::VERTICAL_LINE_COUNT_MIN);

        $field->addVerticalLine(new VerticalLine(Field::VERTICAL_LINE_COUNT_MAX, Field::VERTICAL_LINE_LENGTH_MIN));
        $this->assertEquals($field->getWidth(), Field::VERTICAL_LINE_COUNT_MAX);
    }

    /**
     * @depends testNew
     */
    public function testGetHeight()
    {
        $length = Field::VERTICAL_LINE_LENGTH_MIN;
        $field = new Field($length, Field::VERTICAL_LINE_COUNT_MIN, Field::TRANSVERSE_LINE_COUNT_MIN);
        $this->assertEquals($field->getHeight(), $length);

        $length = Field::VERTICAL_LINE_LENGTH_MIN + 1;
        $field = new Field($length, Field::VERTICAL_LINE_COUNT_MIN, Field::TRANSVERSE_LINE_COUNT_MIN);
        $this->assertEquals($field->getHeight(), $length);

        $length = Field::VERTICAL_LINE_LENGTH_MAX;
        $field = new Field($length, Field::VERTICAL_LINE_COUNT_MIN, Field::TRANSVERSE_LINE_COUNT_MIN);
        $this->assertEquals($field->getHeight(), $length);
    }

    /**
     * @depends testNew
     * @depends testAddTransverseLine
     */
    public function testStart()
    {
        $field = new Field(
            Field::VERTICAL_LINE_LENGTH_MAX,
            Field::VERTICAL_LINE_COUNT_MIN,
            Field::TRANSVERSE_LINE_COUNT_MAX
        );
        $unit = new Unit();

        // xが整数でない
        $this->assertFalse($field->start($unit, null));
        $this->assertFalse($field->start($unit, 'a'));
        $this->assertFalse($field->start($unit, '1'));
        $this->assertFalse($field->start($unit, 1.1));

        // 指定したxに縦線が設定されていない
        $this->assertFalse($field->start($unit, Field::VERTICAL_LINE_COUNT_MIN));

        // 有効
        $count = 10;
        $x = 0;
        for ($y = 1; $y <= $count; $y++) {
            $line = new TransverseLine(new Coordinate($x, $y), new Coordinate($x + 1, $y));
            $this->assertTrue($field->addTransverseLine($line));
        }
        $this->assertTrue($field->start($unit, 1));
    }
}
