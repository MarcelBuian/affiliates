<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AffiliatesShowPageTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
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
                // ->press('Find affiliates')
            ;
        });
    }
}
