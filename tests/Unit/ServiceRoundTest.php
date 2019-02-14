<?php

namespace Tests\Unit;

use App\Enums\AdministrativeStatus;
use App\Enums\SpiritualStatus;
use App\Models\Member;
use App\Models\ServiceRound;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceRoundTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);
    }

    /** @test */
    public function it_has_creator()
    {
        $serviceRound = factory(ServiceRound::class)->create();

        $this->assertInstanceOf(Member::class, $serviceRound->creator);
    }

    /** @test */
    public function it_has_a_week_of_year()
    {
        $serviceRound = factory(ServiceRound::class)->create();

        $weekOfYear =  Carbon::parse($serviceRound->date)->weekOfYear . '/' . Carbon::parse($serviceRound->date)->year;

        $this->assertEquals($weekOfYear, $serviceRound->weekOfYear);
    }
}
