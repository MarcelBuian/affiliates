<?php

namespace Tests\Unit;

use App\Exceptions\InvalidAffiliateJsonException;
use App\Models\Affiliate;
use App\Models\GpsCoordinate;
use App\Resources\AffiliateResource;
use PHPUnit\Framework\TestCase;

class AffiliateResourceTest extends TestCase
{
    public function test_affiliate_resource_creates_a_new_affiliate_object()
    {
        $affiliateJson = '{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}';
        $affiliate = AffiliateResource::make()->transform($affiliateJson);
        $this->assertInstanceOf(Affiliate::class, $affiliate);
        $this->assertSame(52.986375, $affiliate->getGpsCoordinate()->getLatitude());
        $this->assertSame(-6.043701, $affiliate->getGpsCoordinate()->getLongitude());
        $this->assertSame(12, $affiliate->getId());
        $this->assertSame("Yosef Giles", $affiliate->getName());
    }

    public function test_affiliate_resource_bad_json()
    {
        $affiliateJson = '{{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}';
        $this->expectException(InvalidAffiliateJsonException::class);
        $this->expectExceptionMessage("Cannot parse the affiliate. Invalid JSON row: $affiliateJson");
        AffiliateResource::make()->transform($affiliateJson);
    }

    public function test_affiliate_resource_missing_name()
    {
        $affiliateJson = '{"latitude": "52.986375", "affiliate_id": 12, "longitude": "-6.043701"}';
        $this->expectException(InvalidAffiliateJsonException::class);
        $this->expectExceptionMessage("Missing property key 'name' from the affiliate JSON: $affiliateJson");
        AffiliateResource::make()->transform($affiliateJson);
    }

    public function test_affiliate_resource_missing_latitude()
    {
        $affiliateJson = '{"name": "John", "affiliate_id": 12, "longitude": "-6.043701"}';
        $this->expectException(InvalidAffiliateJsonException::class);
        $this->expectExceptionMessage("Missing property key 'latitude' from the affiliate JSON: $affiliateJson");
        AffiliateResource::make()->transform($affiliateJson);
    }

    public function test_affiliate_resource_invalid_latitude()
    {
        $affiliateJson = '{"latitude": "152.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}';
        $this->expectException(InvalidAffiliateJsonException::class);
        $this->expectExceptionMessage("Latitude should be a number between -90 and 90.");
        AffiliateResource::make()->transform($affiliateJson);
    }

    public function test_affiliate_resource_invalid_longitude_not_number()
    {
        $affiliateJson = '{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "a-6.043701"}';
        $this->expectException(InvalidAffiliateJsonException::class);
        $this->expectExceptionMessage("Cannot parse the affiliate. Invalid properties type: $affiliateJson");
        AffiliateResource::make()->transform($affiliateJson);
    }
}
