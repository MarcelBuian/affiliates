<?php

namespace App\Models;

class Affiliate
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var GpsCoordinate */
    private $gpsCoordinate;

    public function __construct(int $id, string $name, GpsCoordinate $gpsCoordinate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->gpsCoordinate = $gpsCoordinate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGpsCoordinate(): GpsCoordinate
    {
        return $this->gpsCoordinate;
    }
}
