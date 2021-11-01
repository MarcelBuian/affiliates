<?php

namespace App\Services;

use App\Models\GpsCoordinate;

class GpsService
{
    const RADIUS_METERS = 6378137;

    public static function make(): self
    {
        return app()->make(self::class);
    }

    public function getDistanceInRadians(GpsCoordinate $gpsCoordinate1, GpsCoordinate $gpsCoordinate2): float
    {
        $lat1 = $gpsCoordinate1->getLatitude();
        $lat2 = $gpsCoordinate2->getLatitude();
        $lng1 = $gpsCoordinate1->getLongitude();
        $lng2 = $gpsCoordinate2->getLongitude();
        $x = M_PI / 180;
        $lat1 *= $x;
        $lng1 *= $x;
        $lat2 *= $x;
        $lng2 *= $x;

        return 2 * asin(sqrt(
            pow(sin(($lat1 - $lat2) / 2), 2)
                + cos($lat1) * cos($lat2) * pow(sin(($lng1 - $lng2) / 2),
            2
            )
        ));
    }

    public function getDistanceInMeters(GpsCoordinate $gpsCoordinate1, GpsCoordinate $gpsCoordinate2): float
    {
        return $this->getDistanceInRadians($gpsCoordinate1, $gpsCoordinate2) * self::RADIUS_METERS;
    }

    public function getDistanceInKiloMeters(GpsCoordinate $gpsCoordinate1, GpsCoordinate $gpsCoordinate2): float
    {
        return $this->getDistanceInMeters($gpsCoordinate1, $gpsCoordinate2) / 1000;
    }
}
