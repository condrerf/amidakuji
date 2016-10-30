<?php
namespace MyVendor\Amidakuji;

/**
 * ユニット
 */
class Unit
{
    /** 座標 */
    private $coordinate;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->coordinate = new Coordinate(0, 0);
    }

    /**
     * 指定された座標に移動させる
     *
     * @param Coordinate $coordinate 座標
     */
    public function moveTo(Coordinate $coordinate)
    {
        $this->coordinate = $coordinate;
    }

    /**
     * 座標を返す
     *
     * @return Coordinate 座標
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * X座標を返す
     *
     * @return int X座標
     */
    public function getX()
    {
        return $this->coordinate->getX();
    }

    /**
     * Y座標を返す
     *
     * @return int Y座標
     */
    public function getY()
    {
        return $this->coordinate->getY();
    }
}
