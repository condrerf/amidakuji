<?php
namespace MyVendor\Amidakuji;

/**
 * 座標
 */
class Coordinate
{
    /** X座標 */
    private $x;

    /** Y座標 */
    private $y;

    /**
     * コンストラクタ
     *
     * @param int $x X座標
     * @param int $y Y座標
     */
    public function __construct($x, $y)
    {
        if (!is_int($x)) {
            throw new \InvalidArgumentException('x is not integer.');
        }
        if (!is_int($y)) {
            throw new \InvalidArgumentException('y is not integer.');
        }

        $this->x = $x;
        $this->y = $y;
    }

    /**
     * X座標を返す
     *
     * @return int X座標
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Y座標を返す
     *
     * @return int Y座標
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * 指定されたXY座標が自身と同一であるかどうかを返す
     *
     * @param int $x X座標
     * @param int $y Y座標
     *
     * @return bool true:同一 false:異なる
     */
    public function isSameCoordinate($x, $y)
    {
        return ($x === $this->x && $y === $this->y);
    }

    /**
     * 指定された座標が自身と同一であるかどうかを返す
     *
     * @param Coordinate $coordinate 座標
     *
     * @return bool true:同一 false:異なる
     */
    public function equals(Coordinate $coordinate)
    {
        return $this->isSameCoordinate($coordinate->getX(), $coordinate->getY());
    }

    /**
     * 指定された座標と自身を比較する
     *
     * @param Coordinate $coordinate 座標
     *
     * @return int|bool 自身の方が大きい:1 同一:0 自身の方が小さい:-1 比較失敗:false
     */
    public function compareTo(Coordinate $coordinate)
    {
        if ($this->equals($coordinate)) {
            return 0;
        }

        $x = $coordinate->getX();
        $y = $coordinate->getY();

        // X座標が相手の方が小さい
        if ($x < $this->x) {
            return 1;
        }

        // X座標が同じで、Y座標が相手の方が小さい
        if ($x == $this->x && $y < $this->y) {
            return 1;
        }

        return -1;
    }
}
