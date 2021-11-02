<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\GpsCoordinate;

class AffiliateService
{
    /** @var int */
    private $radiusInKm;

    public function __construct(int $radiusInKm)
    {
        $this->radiusInKm = $radiusInKm;
    }

    public function isInRadius(Affiliate $affiliate, GpsCoordinate $gpsCoordinate): bool
    {
        $loc1 = $affiliate->getGpsCoordinate();

        return GpsLocationService::make()->getDistanceInKiloMeters($loc1, $gpsCoordinate) <= $this->radiusInKm;
    }
}
