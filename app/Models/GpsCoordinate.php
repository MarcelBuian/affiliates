<?php

namespace App\Models;

use OutOfRangeException;

class GpsCoordinate
{
    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    private function validateLatitude(float $latitude): void
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new OutOfRangeException('Latitude should be a number between -90 and 90');
        }
    }

    private function validateLongitude(float $longitude): void
    {
        if ($longitude < -180 || $longitude > 180) {
            throw new OutOfRangeException('Longitude should be a number between -180 and 180');
        }
    }

    public function __construct(float $latitude, float $longitude)
    {
        $this->validateLatitude($latitude);
        $this->validateLongitude($longitude);
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
