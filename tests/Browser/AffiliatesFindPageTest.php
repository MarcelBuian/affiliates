<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AffiliatesFindPageTest extends DuskTestCase
{
    public function test_find_default_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Contact records')
                ->assertSee('{"latitude": "51.8856167", "affiliate_id": 2, "name": "Mohamed Bradshaw", "longitude": "-10.4240951"}
{"latitude": "52.3191841", "affiliate_id": 3, "name": "Rudi Palmer", "longitude": "-8.5072391"}')
                ->assertSee('GPS Office Latitude')
                ->assertSee('GPS Office Longitude')
                ->assertSee('Range (km)')
                ->assertButtonEnabled('Find affiliates')
                ->press('Find affiliates')
                ->assertSee('Found 16 from 32 affiliates in a range of 100 KM from 53.3340285, -6.2535495')
            ;
        });
    }

    public function test_find_invalid_range_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Contact records')
                ->assertSee('{"latitude": "51.8856167", "affiliate_id": 2, "name": "Mohamed Bradshaw", "longitude": "-10.4240951"}
{"latitude": "52.3191841", "affiliate_id": 3, "name": "Rudi Palmer", "longitude": "-8.5072391"}')
                ->assertSee('GPS Office Latitude')
                ->assertSee('GPS Office Longitude')
                ->assertSee('Range (km)')
                ->type('range', '')
                ->assertButtonEnabled('Find affiliates')
                ->press('Find affiliates')
                ->assertDontSee('Found')
                ->assertSee('The range field is required.')
            ;
        });
    }

    public function test_change_longitude_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Contact records')
                ->assertSee('{"latitude": "51.8856167", "affiliate_id": 2, "name": "Mohamed Bradshaw", "longitude": "-10.4240951"}
{"latitude": "52.3191841", "affiliate_id": 3, "name": "Rudi Palmer", "longitude": "-8.5072391"}')
                ->assertSee('GPS Office Latitude')
                ->assertSee('GPS Office Longitude')
                ->assertSee('Range (km)')
                ->type('office_longitude', '-5')
                ->assertButtonEnabled('Find affiliates')
                ->press('Find affiliates')
                ->assertSee('Found 6 from 32 affiliates in a range of 100 KM from 53.3340285, -5')
                ->assertSee('Inez Blair')
                ->assertSee('Sharna Marriott')
            ;
        });
    }


    public function test_find_affiliates_invalid_records()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('contact_records', 'L{"latitude": "53.3340285", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.2535495"}')
                ->assertButtonEnabled('Find affiliates')
                ->press('Find affiliates')
                ->assertDontSee('Found')
                ->assertSee('Cannot parse the affiliate. Invalid JSON row: ')
            ;
        });
    }



    // public function test_affiliates_contact_records_invalid_json()
    // {
    //     $params = $this->getDefaultParams();
    //     $params['contact_records'] = '{"latitude": "52.986375", "affiliate_id": 12, "namee": "Yosef Giles", "longitude": "-6.043701"}';
    //     $response = $this->postJson(route('affiliates.find'), $params);
    //
    //     $response->assertStatus(422);
    //     $response->assertJsonValidationErrors(['contact_records']);
    //
    // }
}
