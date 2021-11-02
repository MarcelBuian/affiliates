<?php

namespace Tests\Feature;

use Tests\TestCase;

class AffiliatesShowTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_affiliates_show()
    {
        $response = $this->get(route('affiliates.show'));

        $response->assertStatus(200);
    }
}
