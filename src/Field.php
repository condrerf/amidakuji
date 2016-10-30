<?php
namespace MyVendor\Amidakuji;

use MyVendor\Amidakuji\Line\TransverseLine;
use MyVendor\Amidakuji\Line\VerticalLine;

/**
 * フィールド
 */
class Field
{
    /** 縦線の長さの最小値 */
    const VERTICAL_LINE_LENGTH_MIN = 2;

    /** 縦線の長さの最大値 */
    const VERTICAL_LINE_LENGTH_MAX = 10000;

    /** 縦線の本数の最小値 */
    const VERTICAL_LINE_COUNT_MIN = 2;

    /** 縦線の本数の最大値 */
    const VERTICAL_LINE_COUNT_MAX = 1000;

    /** 横線の本数の最小値 */
    const TRANSVERSE_LINE_COUNT_MIN = 0;

    /** 横線の本数の最大値 */
    const TRANSVERSE_LINE_COUNT_MAX = 10000;

    /** 幅 */
    private $width;

    /** 高さ */
    private $height;

    /** 縦線 */
    private $verticalLineArray;

    /** 横線(X座標別) */
    private $transverseLineArray;

    /** 移動先座標(XY座標別) */
    private $destinationCoordinateArray;

    /** 横線の設定可能本数 */
    private $maxTransverseLineCount;

    /** 横線の本数 */
    private $transverseLineCount;

    /**
     * コンストラクタ
     *
     * @param int $verticalLineLength  縦線の長さ
     * @param int $verticalLineCount   縦線の本数
     * @param int $transverseLineCount 横線の本数
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($verticalLineLength, $verticalLineCount, $transverseLineCount)
    {
        // 引数の確認
        $this->constructArgumentsTypeCheck($verticalLineLength, $verticalLineCount, $transverseLineCount);
        $this->constructArgumentsRangeCheck($verticalLineLength, $verticalLineCount, $transverseLineCount);

        // 初期化
        $this->width = 0;
        $this->height = $verticalLineLength;
        $this->verticalLineArray = [];
        $this->transverseLineArray = [];
        $this->destinationCoordinateArray = [];
        $this->maxTransverseLineCount = $transverseLineCount;
        $this->transverseLineCount = 0;

        // 縦線を追加
        for ($x = 0; $x < $verticalLineCount; $x++) {
            $line = new VerticalLine($x, $verticalLineLength);
            $this->addVerticalLine($line);
        }
    }

    /**
     * コンストラクタ引数の型確認
     *
     * @param int $verticalLineLength  縦線の長さ
     * @param int $verticalLineCount   縦線の本数
     * @param int $transverseLineCount 横線の本数
     *
     * @throws \InvalidArgumentException
     */
    private function constructArgumentsTypeCheck($verticalLineLength, $verticalLineCount, $transverseLineCount)
    {
        if (!is_int($verticalLineLength)) {
            throw new \InvalidArgumentException('verticalLineLength is not integer.');
        }
        if (!is_int($verticalLineCount)) {
            throw new \InvalidArgumentException('verticalLineCount is not integer.');
        }
        if (!is_int($transverseLineCount)) {
            throw new \InvalidArgumentException('transverseLineCount is not integer.');
        }
    }

    /**
     * コンストラクタ引数の範囲確認
     *
     * @param int $verticalLineLength  縦線の長さ
     * @param int $verticalLineCount   縦線の本数
     * @param int $transverseLineCount 横線の本数
     *
     * @throws \InvalidArgumentException
     */
    private function constructArgumentsRangeCheck($verticalLineLength, $verticalLineCount, $transverseLineCount)
    {
        if ($verticalLineLength < self::VERTICAL_LINE_LENGTH_MIN ||
            $verticalLineLength > self::VERTICAL_LINE_LENGTH_MAX) {
            throw new \InvalidArgumentException('verticalLineLength is out of range.');
        }
        if ($verticalLineCount < self::VERTICAL_LINE_COUNT_MIN ||
            $verticalLineCount > self::VERTICAL_LINE_COUNT_MAX) {
            throw new \InvalidArgumentException('verticalLineCount is out of range.');
        }
        if ($transverseLineCount < self::TRANSVERSE_LINE_COUNT_MIN ||
            $transverseLineCount > self::TRANSVERSE_LINE_COUNT_MAX) {
            throw new \InvalidArgumentException('transverseLineCount is out of range.');
        }
    }

    /**
     * フィールドの幅を返す
     *
     * @return int 幅
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * フィールドの高さを返す
     *
     * @return int 高さ
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * 指定された縦線を追加する
     *
     * @param VerticalLine $line 縦線
     *
     * @return bool true:追加成功 false:追加失敗
     */
    public function addVerticalLine(VerticalLine $line)
    {
        // 設定された縦線の本数が上限に達している
        $verticalLineArray = $this->verticalLineArray;
        if (count($verticalLineArray) >= self::VERTICAL_LINE_COUNT_MAX) {
            return false;
        }

        // 長さがフィールドの高さと異なる
        if ($line->getLength() !== $this->height) {
            return false;
        }

        // 同じX座標に縦線が設定されている
        $x = $line->getX();
        if (array_key_exists($x, $verticalLineArray)) {
            return false;
        }

        // 追加
        $verticalLineArray[$x] = $line;
        $this->verticalLineArray = $verticalLineArray;

        // 幅を更新
        if ($x > $this->width) {
            $this->width = $x;
        }

        return true;
    }

    /**
     * 指定された横線を追加する
     *
     * @param TransverseLine $line 横線
     *
     * @return bool true:追加成功 false:追加失敗
     */
    public function addTransverseLine(TransverseLine $line)
    {
        // 設定された横線の本数が上限に達している
        if ($this->transverseLineCount >= $this->maxTransverseLineCount) {
            return false;
        }

        // 始点と終点の座標を取得
        $initialCoordinate = $line->getInitialCoordinate();
        $terminalCoordinate = $line->getTerminalCoordinate();
        $initialX = $initialCoordinate->getX();
        $initialY = $initialCoordinate->getY();
        $terminalX = $terminalCoordinate->getX();
        $terminalY = $terminalCoordinate->getY();

        // 座標が範囲外
        if (!$this->isInRange($line)) {
            return false;
        }

        // 始点/終点のいずれかの位置に縦線が設定されていない
        $verticalLineArray = $this->verticalLineArray;
        if (!array_key_exists($initialX, $verticalLineArray) || !array_key_exists($terminalX, $verticalLineArray)) {
            return false;
        }

        // 横線を追加しようとした場合、これまでに追加した横線の中で重なる横線が存在する
        if ($this->hasOverlappedTransverseLine($line)) {
            return false;
        }

        // 左右の横線のいずれかと重なっているかどうか
        if ($this->hasTransverseLine($initialCoordinate) || $this->hasTransverseLine($terminalCoordinate)) {
            return false;
        }

        // 横線を追加
        $transverseLineArray = [];
        if (array_key_exists($initialX, $this->transverseLineArray)) {
            $transverseLineArray = $this->transverseLineArray[$initialX];
        }
        $transverseLineArray[] = $line;
        $this->transverseLineArray[$initialX] = $transverseLineArray;
        $this->transverseLineCount++;

        // 横線の移動先を格納
        $this->destinationCoordinateArray[$initialX][$initialY] = $terminalCoordinate;
        $this->destinationCoordinateArray[$terminalX][$terminalY] = $initialCoordinate;

        return true;
    }

    /**
     * 指定された横線の座標が、自身のフィールドに追加するにあたって範囲内にあるかどうかを返す
     *
     * @param TransverseLine $line 横線
     *
     * @return bool true:範囲内 false:範囲外
     */
    private function isInRange(TransverseLine $line)
    {
        $initialCoordinate = $line->getInitialCoordinate();
        $terminalCoordinate = $line->getTerminalCoordinate();

        // 始点のX座標が範囲外
        $initialX = $initialCoordinate->getX();
        if ($initialX < 0 || $initialX >= $this->width) {
            return false;
        }

// 終点のX座標 = (始点のX座標 + 1)のため、終点のX座標が範囲外の場合は始点のX座標も範囲外であり、
// 終点のX座標の確認は不要
//         // 終点のX座標が範囲外
//         $terminalX = $terminalCoordinate->getX();
//         if ($terminalX <= 0 || $terminalX > $this->width) {
//             return false;
//         }

        // 始点のY座標が範囲外
        $initialY = $initialCoordinate->getY();
        if ($initialY < 1 || $initialY >= $this->height) {
            return false;
        }

        // 終点のY座標が範囲外
        $terminalY = $terminalCoordinate->getY();
        if ($terminalY < 1 || $terminalY >= $this->height) {
            return false;
        }

        return true;
    }

    /**
     * 指定された横線を追加する場合、重なる横線が存在するかどうかを返す
     *
     * @param TransverseLine $line 横線
     *
     * @return bool true:存在する false:存在しない
     */
    private function hasOverlappedTransverseLine(TransverseLine $line)
    {
        $initialCoordinate = $line->getInitialCoordinate();
        $terminalCoordinate = $line->getTerminalCoordinate();

        // 追加しようとするX座標に、これまで追加した横線が存在しない
        $initialX = $initialCoordinate->getX();
        if (!array_key_exists($initialX, $this->transverseLineArray)) {
            return false;
        }

        // 追加しようとするX座標に、これまでに追加した横線を参照
        $transverseLineArray = $this->transverseLineArray[$initialX];
        foreach ($transverseLineArray as $lineCompare) {
            $initialCoordinateCompare = $lineCompare->getInitialCoordinate();
            $terminalCoordinateCompare = $lineCompare->getTerminalCoordinate();
            $initialCompareValue = $initialCoordinateCompare->compareTo($initialCoordinate);
            $terminalCompareValue = $terminalCoordinateCompare->compareTo($terminalCoordinate);

            // 始点・終点のいずれかが重なっている
            if ($initialCompareValue == 0 || $terminalCompareValue == 0) {
                return true;
            }

            // 交差している
            if ($initialCompareValue != $terminalCompareValue) {
                return true;
            }
        }

        return false;
    }

    /**
     * 指定された座標に横線が引かれているかどうかを返す
     *
     * @param Coordinate $coordinate 座標
     *
     * @return bool true:引かれている false:引かれていない
     */
    private function hasTransverseLine(Coordinate $coordinate)
    {
        $x = $coordinate->getX();
        $y = $coordinate->getY();

        return isset($this->destinationCoordinateArray[$x][$y]);
    }

    /**
     * 指定されたユニットを、xの位置から移動を開始する
     *
     * @param Unit $unit ユニット
     * @param int  $x    X座標
     *
     * @return bool true:移動成功 false:移動失敗
     */
    public function start(Unit &$unit, $x)
    {
        if (!is_int($x)) {
            return false;
        }

        // 指定されたX座標に縦線が設定されていない
        if (!array_key_exists($x, $this->verticalLineArray)) {
            return false;
        }

        // 開始地点に移動
        $unit->moveTo(new Coordinate($x, 0));

        // 終了地点に到達するまで繰り返す
        $destinationCoordinateArray = $this->destinationCoordinateArray;
        while ($unit->getY() != $this->height) {
            // 次の移動先を取得
            $nextX = $unit->getX();
            $nextY = $unit->getY() + 1;
            $nextCoordinate = new Coordinate($nextX, $nextY);

            // 次の移動地点に横線が引かれている場合は、その横線の反対側を移動先とする
            if (isset($destinationCoordinateArray[$nextX][$nextY])) {
                $nextCoordinate = $destinationCoordinateArray[$nextX][$nextY];
            }

            // 次の移動先に移動
            $unit->moveTo($nextCoordinate);
        }

        return true;
    }
}
