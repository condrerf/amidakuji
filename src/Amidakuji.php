<?php
namespace MyVendor\Amidakuji;

use MyVendor\Amidakuji\Line\TransverseLine;

/**
 * あみだくじ
 */
class Amidakuji
{
    /** フィールド */
    private $field;

    /**
     * コンストラクタ
     *
     * @param string $fileName データファイル名
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct($fileName)
    {
        if (!is_string($fileName)) {
            throw new \InvalidArgumentException('fileName is not string.');
        }

        // ファイルを読み込み
        $filePath = dirname(__DIR__) . "\\data\\{$fileName}";
        $ssvArray = @file($filePath, FILE_IGNORE_NEW_LINES);
        if ($ssvArray === false) {
            throw new \InvalidArgumentException("{$filePath} does not exist.");
        }
        if (count($ssvArray) < 2) {
            throw new \Exception("{$filePath} is invaild format file.");
        }

        // ファイルの内容を展開してフィールドを生成
        $field = null;
        for ($i = 0; $i < count($ssvArray); $i++) {
            $lineNumber = $i + 1;

            // 空白で分割
            $ssv = trim($ssvArray[$i]);
            $stringArray = explode(' ', $ssv);
            if (count($stringArray) != 3) {
                throw new \Exception("{$filePath} line {$lineNumber} {$ssv} is invaild.");
            }

            // 値を取得
            foreach ($stringArray as $string) {
                if (!is_numeric($string)) {
                    throw new \Exception("{$filePath} line {$lineNumber} {$string} is not integer.");
                }
            }
            $number1 = intval($stringArray[0]);
            $number2 = intval($stringArray[1]);
            $number3 = intval($stringArray[2]);

            // 1行目はフィールドの設定値
            if ($i == 0) {
                $field = new Field($number1, $number2, $number3);
                continue;
            }

            // 2行目以降は横線の設定値
            $x = $number1 - 1;
            $initialCoordinate = new Coordinate($x, $number2);
            $terminalCoordinate = new Coordinate($x + 1, $number3);
            $line = new TransverseLine($initialCoordinate, $terminalCoordinate);
            $field->addTransverseLine($line);
        }
        $this->field = $field;
    }

    /**
     * 指定された番号であみだくじを開始し、終了時の番号を返す
     *
     * @param int $number 開始時の番号
     *
     * @return int|bool 実行成功:終了時の番号 実行失敗:false
     */
    public function start($number)
    {
        if (!is_int($number)) {
            return false;
        }

        $unit = new Unit();
        $x = $number - 1;
        $isSucceeded = $this->field->start($unit, $x);
        if ($isSucceeded) {
            return $unit->getX() + 1;
        }

        return false;
    }

    /**
     * あみだくじを実行し、指定された番号の縦線に最終的に到達する縦線の番号を返す
     *
     * @param int $goalNumber 求めたい縦線の番号
     *
     * @return int|bool 縦線の番号 求められなかった場合はfalse
     */
    public function findStartNumber($goalNumber)
    {
        if (!is_int($goalNumber)) {
            return false;
        }

        $lastNumber = $this->field->getWidth() + 1;
        for ($startNumber = 1; $startNumber <= $lastNumber; $startNumber++) {
            $result = $this->start($startNumber);
            if ($result === $goalNumber) {
                return $startNumber;
            }
        }

        return false;
    }
}
