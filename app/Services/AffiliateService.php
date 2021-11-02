<?php

namespace App\Services;

use App\Models\Affiliate;

class AffiliateService
{
    /** @var int */
    private $radiusInKm;

    public function __construct(int $radiusInKm)
    {
        $this->radiusInKm = $radiusInKm;
    }

    public function areInRadius(Affiliate $affiliate1, Affiliate $affiliate2): bool
    {
        $loc1 = $affiliate1->getGpsCoordinate();
        $loc2 = $affiliate2->getGpsCoordinate();

        return GpsLocationService::make()->getDistanceInKiloMeters($loc1, $loc2) <= $this->radiusInKm;
    }
}
