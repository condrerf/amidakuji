<?php
namespace MyVendor\Amidakuji\Line;

use MyVendor\Amidakuji\Coordinate;

/**
 * 線
 */
class Line
{
    /** 始点座標 */
    private $initialCoordinate;

    /** 終点座標 */
    private $terminalCoordinate;

    /** 長さ */
    private $length;

    /**
     * コンストラクタ
     *
     * @param Coordinate $initialCoordinate  始点座標
     * @param Coordinate $terminalCoordinate 終点座標
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Coordinate $initialCoordinate, Coordinate $terminalCoordinate)
    {
        if ($initialCoordinate->equals($terminalCoordinate)) {
            throw new \InvalidArgumentException('initialCoordinate and terminalCoordinate are same coordinate.');
        }

        // 座標が-1以下の場合は不可
        $initialX = $initialCoordinate->getX();
        $initialY = $initialCoordinate->getY();
        if ($initialX <= -1 || $initialY <= -1) {
            throw new \InvalidArgumentException('initialCoordinate is invalid.');
        }
        $terminalX = $terminalCoordinate->getX();
        $terminalY = $terminalCoordinate->getY();
        if ($terminalX <= -1 || $terminalY <= -1) {
            throw new \InvalidArgumentException('terminalCoordinate is invalid.');
        }

        // 始点の方が大きい場合は逆にする
        if ($initialCoordinate->compareTo($terminalCoordinate) == 1) {
            $temp = $initialCoordinate;
            $initialCoordinate = $terminalCoordinate;
            $terminalCoordinate = $temp;
        }

        // 長さを求める
        $xLength = abs($terminalX - $initialX);
        $yLength = abs($terminalY - $initialY);
        $length = intval(sqrt(pow($xLength, 2) + pow($yLength, 2)));

        $this->initialCoordinate = $initialCoordinate;
        $this->terminalCoordinate = $terminalCoordinate;
        $this->length = $length;
    }

    /**
     * 始点座標を返す
     *
     * @return Coordinate 始点座標
     */
    public function getInitialCoordinate()
    {
        return $this->initialCoordinate;
    }

    /**
     * 終点座標を返す
     *
     * @return Coordinate 終点座標
     */
    public function getTerminalCoordinate()
    {
        return $this->terminalCoordinate;
    }

    /**
     * 長さを返す
     *
     * @return int 長さ
     */
    public function getLength()
    {
        return $this->length;
    }
}
