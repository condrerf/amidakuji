<?php
namespace MyVendor\Amidakuji\Line;

use MyVendor\Amidakuji\Coordinate;

/**
 * 縦線
 */
class VerticalLine extends Line
{
    /**
     * コンストラクタ
     *
     * @param int $x      X座標
     * @param int $length 長さ
     */
    public function __construct($x, $length)
    {
        if (!is_int($x)) {
            throw new \InvalidArgumentException('x is not integer.');
        }
        if (!is_int($length)) {
            throw new \InvalidArgumentException('length is not integer.');
        }

        $initialCoordinate = new Coordinate($x, 0);
        $terminalCoordinate = new Coordinate($x, $length);
        parent::__construct($initialCoordinate, $terminalCoordinate);
    }

    /**
     * X座標を返す
     *
     * @return int X座標
     */
    public function getX()
    {
        return $this->getInitialCoordinate()->getX();
    }
}
