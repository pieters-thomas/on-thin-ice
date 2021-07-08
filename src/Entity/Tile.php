<?php

namespace App\Entity;

class Tile
{
    private int $id;
    private int $xCoordinate;
    private int $yCoordinate;
    private int $zCoordinate;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return int
     */
    public function getXCoordinate(): int
    {
        return $this->xCoordinate;
    }

    /**
     * @param int $xCoordinate
     */
    public function setXCoordinate(int $xCoordinate): void
    {
        $this->xCoordinate = $xCoordinate;
    }

    /**
     * @return int
     */
    public function getYCoordinate(): int
    {
        return $this->yCoordinate;
    }

    /**
     * @param int $yCoordinate
     */
    public function setYCoordinate(int $yCoordinate): void
    {
        $this->yCoordinate = $yCoordinate;
    }

    /**
     * @return int
     */
    public function getZCoordinate(): int
    {
        return $this->zCoordinate;
    }

    /**
     * @param int $zCoordinate
     */
    public function setZCoordinate(int $zCoordinate): void
    {
        $this->zCoordinate = $zCoordinate;
    }


}
