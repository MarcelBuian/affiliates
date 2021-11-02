<?php

namespace Tests\Unit;

use App\Models\Affiliate;
use App\Models\GpsCoordinate;
use App\Services\AffiliateService;
use PHPUnit\Framework\TestCase;

class AffiliatesServiceTest extends TestCase
{
    public function gpsCoordinatesDistance():array
    {
        return [
            // distance = 10018.754 km
            [[0,10], [50,100], 10018, false],
            // distance = 10018.754 km
            [[0,10], [50,100], 10019, true],
            // distance = 0 km
            [[53.3340285,-6.2535495], [53.3340285,-6.2535495], 0, true],
            // distance = 0 km
            [[53.3340285,-6.2535495], [53.3340285,-6.2535495], 1, true],
            // distance = 41.157 km
            [[53.3340285,-6.2535495], [52.986375,-6.043701], 41, false],
            // distance = 41.157 km
            [[53.3340285,-6.2535495], [52.986375,-6.043701], 42, true],
            // distance = 313.561 km
            [[53.3340285,-6.2535495], [51.92893,-10.27699], 313, false],
            // distance = 313.561 km
            [[53.3340285,-6.2535495], [51.92893,-10.27699], 314, true],
            // distance = 3934.082 km
            [[53.3340285,52.3191841], [52.986375,-8.5072391], 3934, false],
            // distance = 3934.082 km
            [[53.3340285,52.3191841], [52.986375,-8.5072391], 3935, true],
        ];
    }

    /**
     * @dataProvider gpsCoordinatesDistance
     */
    public function test_affiliates_service_calculate_in_radius(array $coordinates1, array $coordinates2, int $kmRadius, bool $expectedInRadius)
    {
        [$lat1, $lng1] = $coordinates1;
        [$lat2, $lng2] = $coordinates2;
        $coordinate1 = new GpsCoordinate($lat1, $lng1);
        $coordinate2 = new GpsCoordinate($lat2, $lng2);
        $affiliate1 = new Affiliate(1, 'test1', $coordinate1);
        $affiliate2 = new Affiliate(2, 'test2', $coordinate2);

        $service = new AffiliateService($kmRadius);
        $this->assertSame($expectedInRadius, $service->areInRadius($affiliate1, $affiliate2));
        $this->assertSame($expectedInRadius, $service->areInRadius($affiliate2, $affiliate1));
    }
}
