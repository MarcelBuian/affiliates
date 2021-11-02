<?php

namespace Tests\Unit;

use App\Models\Affiliate;
use App\Models\GpsCoordinate;
use PHPUnit\Framework\TestCase;

class AffiliateTest extends TestCase
{
    public function test_affiliate_can_be_created()
    {
        [$lat, $lng] = [52.986375, -6.043701];
        $id = 100;
        $name = "Yosef Giles";
        $coordinate = new GpsCoordinate($lat, $lng);
        $affiliate = new Affiliate($id, $name, $coordinate);
        $this->assertSame($lat, $affiliate->getGpsCoordinate()->getLatitude());
        $this->assertSame($lng, $affiliate->getGpsCoordinate()->getLongitude());
        $this->assertSame($id, $affiliate->getId());
        $this->assertSame($name, $affiliate->getName());
    }
}
