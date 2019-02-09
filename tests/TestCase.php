<?php

namespace Tests;

use App\Models\Member;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in by assigning spiritual status and administrative statuses
     *
     * @param $spiritualStatus
     * @param $administrativeStatuses
     */
    public function signInAs($spiritualStatus, $administrativeStatuses) {
        $memer = factory(Member::class)->create([
            'spiritual_status' => $spiritualStatus
        ]);

        foreach ($administrativeStatuses as $administrativeStatus) {
            $memer->AdministrativeStatuses()->create([
                'status' => $administrativeStatus
            ]);
        }

        $this->actingAs($memer->fresh());
    }
}
