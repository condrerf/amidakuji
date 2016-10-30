<?php

namespace MyVendor\Amidakuji;

class AmidakujiTest extends \PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $directory = dirname(__DIR__) . '\\data\\';

        // null
        try {
            $amidakuji = new Amidakuji(null);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $this->assertSame('fileName is not string.', $e->getMessage());
        }

        // ファイルが存在しない
        $fileName = 'dummy';
        try {
            $amidakuji = new Amidakuji($fileName);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $filePath = "{$directory}{$fileName}";
            $this->assertSame("{$filePath} does not exist.", $e->getMessage());
        }

        // ファイルが空
        $fileName = 'error_empty.dat';
        try {
            $amidakuji = new Amidakuji($fileName);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $filePath = "{$directory}{$fileName}";
            $this->assertSame("{$filePath} is invaild format file.", $e->getMessage());
        }

        // 正常でないデータ
        $fileName = 'error_one_row.dat';
        try {
            $amidakuji = new Amidakuji($fileName);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $filePath = "{$directory}{$fileName}";
            $this->assertSame("{$filePath} is invaild format file.", $e->getMessage());
        }
        $fileName = 'error_not_3_columns.dat';
        try {
            $amidakuji = new Amidakuji($fileName);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $filePath = "{$directory}{$fileName}";
            $this->assertSame("{$filePath} line 2 21 is invaild.", $e->getMessage());
        }
        $fileName = 'error_include_character.dat';
        try {
            $amidakuji = new Amidakuji($fileName);
            $this->fail(__FUNCTION__ . 'failed');
        } catch (\Exception $e) {
            $filePath = "{$directory}{$fileName}";
            $this->assertSame("{$filePath} line 2 a is not integer.", $e->getMessage());
        }
    }

    /**
     * @depends testException
     */
    public function testNew()
    {
        $amidakuji = new Amidakuji('example1.dat');
        $this->assertInstanceOf('\MyVendor\Amidakuji\Amidakuji', $amidakuji);

        return $amidakuji;
    }

    /**
     * @depends testNew
     */
    public function testStart(Amidakuji $amidakuji)
    {
        // null
        $this->assertFalse($amidakuji->start(null));

        // 自然数でない
        $this->assertFalse($amidakuji->start('a'));
        $this->assertFalse($amidakuji->start(1.1));

        // 動作確認
        $this->assertEquals($amidakuji->start(0), false);
        $this->assertEquals($amidakuji->start(1), 3);
        $this->assertEquals($amidakuji->start(2), 2);
        $this->assertEquals($amidakuji->start(3), 1);
        $this->assertEquals($amidakuji->start(4), 4);
        $this->assertEquals($amidakuji->start(5), false);
    }

    /**
     * @depends testNew
     */
    public function testFindStartNumber(Amidakuji $amidakuji)
    {
        // null
        $this->assertFalse($amidakuji->findStartNumber(null));

        // 自然数でない
        $this->assertFalse($amidakuji->findStartNumber('a'));
        $this->assertFalse($amidakuji->findStartNumber(1.1));

        // 動作確認
        $this->assertEquals($amidakuji->findStartNumber(0), false);
        $this->assertEquals($amidakuji->findStartNumber(1), 3);
        $this->assertEquals($amidakuji->findStartNumber(2), 2);
        $this->assertEquals($amidakuji->findStartNumber(3), 1);
        $this->assertEquals($amidakuji->findStartNumber(4), 4);
        $this->assertEquals($amidakuji->findStartNumber(5), false);
    }
}
