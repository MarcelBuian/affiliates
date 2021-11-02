<?php

namespace App\Resources;

use App\Exceptions\InvalidAffiliateJsonException;
use App\Models\Affiliate;
use App\Models\GpsCoordinate;
use OutOfRangeException;
use TypeError;

class AffiliateResource
{
    public static function make(): self
    {
        return app()->make(self::class);
    }

    /**
     * @throws InvalidAffiliateJsonException
     */
    public function transform(string $affiliateJsonString): Affiliate
    {
        if (!$affiliateJson = json_decode($affiliateJsonString, true)) {
            throw InvalidAffiliateJsonException::invalidJson($affiliateJsonString);
        }
        foreach (['latitude', 'affiliate_id', 'name', 'longitude'] as $propertyKey) {
            if (is_null($affiliateJson[$propertyKey] ?? null)) {
                throw InvalidAffiliateJsonException::missingProperty($propertyKey, $affiliateJsonString);
            }
        }

        try {
            $gpsCoordinate = new GpsCoordinate($affiliateJson['latitude'], $affiliateJson['longitude']);
            $affiliate = new Affiliate($affiliateJson['affiliate_id'], $affiliateJson['name'], $gpsCoordinate);
        } catch (OutOfRangeException $exception) {
            throw new InvalidAffiliateJsonException($exception->getMessage(), 0, $exception);
        } catch (TypeError $exception) {
            throw InvalidAffiliateJsonException::invalidPropertiesType($affiliateJsonString);
        }

        return $affiliate;
    }
}
