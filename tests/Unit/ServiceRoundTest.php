<?php

namespace Tests\Unit;

use App\Enums\AdministrativeStatus;
use App\Enums\ChurchBankAccount;
use App\Enums\OfferingType;
use App\Enums\SpiritualStatus;
use App\Models\Member;
use App\Models\Offering;
use App\Models\ServiceRound;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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

    /** @test */
    public function it_has_offering_records()
    {
        $serviceRound = factory(ServiceRound::class)->create();

        $this->assertInstanceOf(Collection::class, $serviceRound->offerings);
    }

    /** @test */
    public function it_has_church_bank_accounts()
    {
        $churchBankAccounts = [
            'TITHE_ACCOUNT' => [OfferingType::TITHE],
            'BUILDING_ACCOUNT' => [OfferingType::BUILDING],
            'LAND_ACCOUNT' => [OfferingType::LAND],
            'MISSION_ACCOUNT' => [OfferingType::MISSION],
            'CAMP_ACCOUNT' => [OfferingType::CAMP],
            'MANAGEMENT_ACCOUNT' => [OfferingType::CELL, OfferingType::BLESSING, OfferingType::OTHER]
        ];

        $this->assertEquals($churchBankAccounts, ChurchBankAccount::toArray());
    }

    /** @test */
    public function it_can_get_total_offering_amount_by_church_bank_account()
    {
        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $financialOfficer = auth()->user();

        $serviceRound = $financialOfficer->serviceRounds()->save(factory(ServiceRound::class)->make());

        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::TITHE, 'amount' => 50000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::TITHE, 'amount' => 120000]));

        $titheAccountTotalOfferingAmount = $serviceRound->getTotalOfferingAmountByChurchBankAccount(ChurchBankAccount::TITHE_ACCOUNT);
        $this->assertEquals(170000, $titheAccountTotalOfferingAmount);

        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::CELL, 'amount' => 10000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::BLESSING, 'amount' => 20000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::OTHER, 'amount' => 50000]));

        $buildingAccountTotalOfferingAmount = $serviceRound->getTotalOfferingAmountByChurchBankAccount(ChurchBankAccount::MANAGEMENT_ACCOUNT);
        $this->assertEquals(80000, $buildingAccountTotalOfferingAmount);
    }
}
