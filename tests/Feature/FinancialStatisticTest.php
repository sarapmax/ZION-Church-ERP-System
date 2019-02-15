<?php

namespace Tests\Feature;

use App\Enums\AdministrativeStatus;
use App\Enums\ChurchBankAccount;
use App\Enums\OfferingType;
use App\Enums\SpiritualStatus;
use App\Models\Offering;
use App\Models\ServiceRound;
use BenSampo\Enum\Rules\EnumKey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinancialStatisticTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_financial_officer_can_see_total_offering_amount_of_each_name()
    {
        $this->withoutExceptionHandling();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $financialOfficer = auth()->user();

        $serviceRound = $financialOfficer->serviceRounds()->save(factory(ServiceRound::class)->make());

        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::TITHE, 'amount' => 50000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::BUILDING, 'amount' => 10000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::LAND, 'amount' => 500000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::MISSION, 'amount' => 200000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::CAMP, 'amount' => 100000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::CELL, 'amount' => 1000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::BLESSING, 'amount' => 2000]));
        $financialOfficer->offerings()->save(factory(Offering::class)->make(['service_round_id' => $serviceRound->id, 'type' => OfferingType::OTHER, 'amount' => 3000]));

        $expectedChurchBankAccountsResult = [
            ['name' => 'TITHE_ACCOUNT', 'total_offering_amount' => 50000],
            ['name' => 'BUILDING_ACCOUNT', 'total_offering_amount' => 10000],
            ['name' => 'LAND_ACCOUNT', 'total_offering_amount' => 500000],
            ['name' => 'MISSION_ACCOUNT', 'total_offering_amount' => 200000],
            ['name' => 'CAMP_ACCOUNT', 'total_offering_amount' => 100000],
            ['name' => 'MANAGEMENT_ACCOUNT', 'total_offering_amount' => 6000],
        ];

        $this->get(route('finance.service-round.show', $serviceRound))->assertViewHas('churchBankAccounts', function($churchBankAccounts) use ($expectedChurchBankAccountsResult) {
            return $expectedChurchBankAccountsResult == $churchBankAccounts;
        });
    }
}
