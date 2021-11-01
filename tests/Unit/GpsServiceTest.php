<?php

namespace Tests\Unit;

use App\Models\GpsCoordinate;
use App\Services\GpsService;
use PHPUnit\Framework\TestCase;

class GpsServiceTest extends TestCase
{
    public function gpsCoordinatesDistance():array
    {
        return [
            [[0,10], [50,100], 10018.754],
            [[53.3340285,-6.2535495], [53.3340285,-6.2535495], 0],
            [[53.3340285,-6.2535495], [52.986375,-6.043701], 41.157],
            [[53.3340285,-6.2535495], [51.92893,-10.27699], 313.561],
            [[53.3340285,52.3191841], [52.986375,-8.5072391], 3934.082],
        ];
    }

    /**
     * @dataProvider gpsCoordinatesDistance
     */
    public function test_gps_coordinate_can_be_created(array $coordinates1, array $coordinates2, float $expectedKmDistance)
    {
        [$lat1, $lng1] = $coordinates1;
        [$lat2, $lng2] = $coordinates2;
        $coordinate1 = new GpsCoordinate($lat1, $lng1);
        $coordinate2 = new GpsCoordinate($lat2, $lng2);
        $this->assertEqualsWithDelta($expectedKmDistance, GpsService::make()->getDistanceInKiloMeters($coordinate1, $coordinate2), 0.001);
        $this->assertEqualsWithDelta($expectedKmDistance*1000, GpsService::make()->getDistanceInMeters($coordinate1, $coordinate2), 1);
    }
}
