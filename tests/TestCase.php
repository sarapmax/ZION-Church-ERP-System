<?php

namespace Tests;

use App\Models\Member;
use Closure;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\SQLiteBuilder;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Fluent;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

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
