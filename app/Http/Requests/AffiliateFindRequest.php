<?php

namespace App\Http\Requests;

use App\Exceptions\InvalidAffiliateJsonException;
use App\Models\GpsCoordinate;
use App\Resources\AffiliateResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

/**
 * @property-read string contact_records
 * @property-read string office_latitude
 * @property-read string office_longitude
 * @property-read string range
 */
class AffiliateFindRequest extends FormRequest
{
    public function rules()
    {
        return [
            'contact_records' => 'required|string',
            'office_latitude' => 'required|numeric|min:-90|max:90',
            'office_longitude' => 'required|numeric|min:-180|max:180',
            'range' => 'required|integer|min:0|max:100000',
        ];
    }

    private function getContactRecords(): array
    {
        return explode(PHP_EOL, $this->get('contact_records'));
    }

    public function getAffiliates(): Collection
    {
        $affiliates = collect();
        $resource = AffiliateResource::make();
        foreach ($this->getContactRecords() as $contactRecord) {
            try {
                $affiliates->push($resource->transform($contactRecord));
            } catch (InvalidAffiliateJsonException $e) {
                throw ValidationException::withMessages([
                    'contact_records' => $e->getMessage(),
                ]);
            }
        }

        return $affiliates;
    }

    public function getOfficeLocation(): GpsCoordinate
    {
        return new GpsCoordinate($this->office_latitude, $this->office_longitude);
    }
}
