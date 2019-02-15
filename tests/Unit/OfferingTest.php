<?php

namespace Tests\Unit;

use App\Enums\AdministrativeStatus;
use App\Enums\OfferingType;
use App\Enums\SpiritualStatus;
use App\Models\Member;
use App\Models\Offering;
use App\Models\ServiceRound;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfferingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function it_has_types()
    {
        $offeringTypes = [
            'TITHE' => 1,
            'BUILDING' => 2,
            'LAND' => 3,
            'CELL' => 4,
            'MISSION' => 5,
            'BLESSING' => 6,
            'CAMP' => 7,
            'OTHER' => 8
        ];

        $this->assertEquals($offeringTypes, OfferingType::toArray());
    }

    /** @test */
    public function it_belongs_to_service_round()
    {
        $financialOfficer = factory(Member::class)->create([
            'spiritual_status' => AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $offeringRecord = $financialOfficer->offerings()->create(factory(Offering::class)->raw());

        $this->assertInstanceOf(ServiceRound::class, $offeringRecord->serviceRound);
    }

    /** @test */
    public function it_belongs_to_member()
    {
        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $financialOfficer = auth()->user();

        $offeringRecord = $financialOfficer->offerings()->create(factory(Offering::class)->raw());

        $this->assertInstanceOf(Member::class, $offeringRecord->member);
    }
}
