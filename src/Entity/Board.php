<?php

namespace App\Entity;

class Board
{
    private const HIGHEST_TILE_ID = 59;
    private const START_TILE_Y = 10;
    private const START_TILE_Z = 3;
    private const EVEN_ROW_LENGTH = 8;
    private const ODD_ROW_LENGTH = 8;
    /**
     * @var Tile[]
     */
    private array $tiles;

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->tiles = [];
        foreach (range(0,self::HIGHEST_TILE_ID) as $tile)
        {
            $this->tiles[] = new Tile;
        }

        $this->setId();
        $this->setX();
        $this->setY();
        $this->setZ();
    }

    private function setId(): void
    {
        $x = 0;
        foreach ($this->tiles as $tile)
        {
            $tile->setId($x++);
        }
    }

    public function setX(): void
    {
        $tile = 0;
        $row = 0;
        while ($tile < self::HIGHEST_TILE_ID)
        {
            foreach (range(1,self::EVEN_ROW_LENGTH) as $oddTile)
            {
                $this->tiles[$tile]->setXCoordinate($row);
                $tile++;
            }
            $row++;
            foreach (range(1,self::ODD_ROW_LENGTH) as $oddTile)
            {
                $this->tiles[$tile]->setXCoordinate($row);
                $tile++;
            }
            $row++;
        }
    }

    private function setY():void
    {
        $tile = self::HIGHEST_TILE_ID;
        $yStart = 0;

        while ($tile > 0)
        {
            $y = 0;
            foreach (range(1,self::ODD_ROW_LENGTH) as $oddTile)
            {
                $this->tiles[$tile]->setYCoordinate($yStart + $y);
                $y++;
                $tile--;
            }
            $y=0;
            foreach (range(1,self::EVEN_ROW_LENGTH) as $oddTile)
            {
                $this->tiles[$tile]->setYCoordinate($yStart + $y);
                $y++;
                $tile--;
            }
            $yStart++;
        }
    }

    public function setZ(): void
    {
        $tile = 0;
        $zStart = self::START_TILE_Z;
        while ($tile < self::HIGHEST_TILE_ID)
        {
            $z = 0;
            foreach (range(1,self::EVEN_ROW_LENGTH) as $oddTile)
            {
                $this->tiles[$tile]->setZCoordinate($zStart + $z);
                $z++;
                $tile++;
            }

            $z = 0;
            foreach (range(1,self::ODD_ROW_LENGTH) as $oddTile)
            {
                $this->tiles[$tile]->setZCoordinate($zStart + $z);
                $z++;
                $tile++;
            }
            $zStart--;
        }
    }
}
