<?php
namespace MyVendor\Amidakuji\Line;

use MyVendor\Amidakuji\Coordinate;

/**
 * 横線
 */
class TransverseLine extends Line
{
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
        parent::__construct($initialCoordinate, $terminalCoordinate);

        // 横の長さが1でない場合は不可
        $initialX = $this->getInitialCoordinate()->getX();
        $terminalX = $this->getTerminalCoordinate()->getX();
        $xLength = abs($terminalX - $initialX);
        if ($xLength != 1) {
            throw new \InvalidArgumentException('length of x is not 1.');
        }
    }
}
