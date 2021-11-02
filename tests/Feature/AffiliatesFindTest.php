<?php

namespace Tests\Feature;

use App\Http\Controllers\AffiliatesController;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AffiliatesFindTest extends TestCase
{
    public function test_affiliates_find_empty_body()
    {
        $response = $this->postJson(route('affiliates.find'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'contact_records',
            'office_latitude',
            'office_longitude',
            'range',
        ]);
    }

    private function getDefaultParams()
    {
        return [
            'contact_records' => File::get(public_path(AffiliatesController::DEFAULT_RECORDS_URL)),
            'office_latitude' => AffiliatesController::DEFAULT_OFFICE_LATITUDE,
            'office_longitude' => AffiliatesController::DEFAULT_OFFICE_LONGITUDE,
            'range' => AffiliatesController::DEFAULT_RANGE_KM,
        ];
    }

    public function test_affiliates_find_success_default()
    {
        $response = $this->postJson(route('affiliates.find'), $this->getDefaultParams());

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Found 16 from 32 affiliates in a range of 100 KM from 53.3340285, -6.2535495');
    }

    public function test_affiliates_find_success_with_range_50_km()
    {
        $params = $this->getDefaultParams();
        $params['range'] = 50;
        $response = $this->postJson(route('affiliates.find'), $params);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Found 8 from 32 affiliates in a range of 50 KM from 53.3340285, -6.2535495');
    }
}
