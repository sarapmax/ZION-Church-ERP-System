<?php

namespace Tests\Unit;

use App\Enums\AdministrativeStatus;
use App\Enums\SpiritualStatus;
use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_member_can_have_many_administrative_statuses()
    {
        $member = factory(Member::class)->create();

        $member->administrativeStatuses()->createMany([
            ['status' => AdministrativeStatus::MEMBER],
            ['status' => AdministrativeStatus::ADMIN]
        ]);

        $this->assertDatabaseHas('administrative_statuses', [
            'status' => AdministrativeStatus::MEMBER
        ]);

        $this->assertDatabaseHas('administrative_statuses', [
            'status' => AdministrativeStatus::ADMIN
        ]);
    }

    /** @test */
    public function a_financial_officer_has_service_rounds()
    {
        $member = factory(Member::class)->create([
            'spiritual_status' => SpiritualStatus::CELL_LEADER
        ]);

        $member->AdministrativeStatuses()->create([
            'status' => AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $this->assertInstanceOf(Collection::class, $member->serviceRounds);
    }
}
