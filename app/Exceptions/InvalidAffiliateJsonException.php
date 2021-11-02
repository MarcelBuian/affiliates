<?php

namespace App\Exceptions;

use Exception;

class InvalidAffiliateJsonException extends Exception
{
    public static function invalidJson(string $rawJson): self
    {
        return new static('Cannot parse the affiliate. Invalid JSON row: '.$rawJson);
    }

    public static function invalidPropertiesType(string $rawJson): self
    {
        return new static('Cannot parse the affiliate. Invalid properties type: '.$rawJson);
    }

    public static function missingProperty(string $propertyKey, string $rawJson): self
    {
        return new static("Missing property key '$propertyKey' from the affiliate JSON: $rawJson");
    }
}
