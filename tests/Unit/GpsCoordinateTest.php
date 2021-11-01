<?php

namespace Tests\Unit;

use App\Models\GpsCoordinate;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;

class GpsCoordinateTest extends TestCase
{
    public function test_gps_coordinate_can_be_created()
    {
        $lat = '20.1234567';
        $long = '100.1234567';
        $gpsCoordinate = new GpsCoordinate($lat, $long);
        $this->assertSame(20.1234567, $gpsCoordinate->getLatitude());
        $this->assertSame(100.1234567, $gpsCoordinate->getLongitude());
    }

    public function test_gps_coordinate_should_have_valid_latitude()
    {
        $this->expectException(OutOfRangeException::class);
        $this->expectExceptionMessage('Latitude should be a number between -90 and 90');
        new GpsCoordinate(92, 0);
    }

    public function test_gps_coordinate_should_have_valid_longitude()
    {
        $this->expectException(OutOfRangeException::class);
        $this->expectExceptionMessage('Longitude should be a number between -180 and 180');
        new GpsCoordinate(-89, -182);
    }
}
