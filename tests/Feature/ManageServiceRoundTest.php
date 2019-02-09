<?php

namespace Tests\Feature;

use App\Enums\AdministrativeStatusEnum;
use App\Enums\SpiritualStatusEnum;
use App\Models\Member;
use App\Models\ServiceRound;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageServiceRoundTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp() {
        parent::setUp();

        $this->signInAs(SpiritualStatusEnum::CELL_LEADER, [
            AdministrativeStatusEnum::FINANCIAL_OFFICER
        ]);
    }

    /** @test */
    public function only_member_who_has_financial_officer_status_can_manage_service_rounds()
    {
        $this->assertTrue(Gate::allows('manage-church-finance'));

        $this->signInAs(SpiritualStatusEnum::CELL_LEADER, [
            AdministrativeStatusEnum::MEMBER
        ]);

        $this->assertTrue(Gate::denies('manage-church-finance'));
    }

    /** @test */
    public function a_financial_officer_can_view_all_service_rounds()
    {
        $this->get(route('finance.service-round.index'))->assertStatus(200);

        auth()->user()->serviceRounds()->save(factory(ServiceRound::class)
            ->make(['date' => '1995-10-10']));

        $anotherFinancialOfficer = factory(Member::class)->create();
        $anotherFinancialOfficer->serviceRounds()->save(factory(ServiceRound::class)
            ->make(['date' => '1995-04-03']));

        $this->get(route('finance.service-round.index'))->assertSee('1995-10-10');
        $this->get(route('finance.service-round.index'))->assertSee('1995-04-03');
    }
    
    /** @test */
    public function a_financial_officer_can_create_a_service_round()
    {
        $this->get(route('finance.service-round.create'))->assertStatus(200);

        $attributes = [
            'date' => $this->faker->date('Y-m-d H:i:s'),
            'financial_witnesses' => 'John Doe, Jan Doe, Michael'
        ];

        $response = $this->post(route('finance.service-round.store'), $attributes);

        $serviceRound = ServiceRound::where($attributes)->first();

        $response->assertRedirect(route('finance.service-round.show', $serviceRound));

        $this->get(route('finance.service-round.show', $serviceRound))
            ->assertSee(defaultDateFormat(Carbon::parse($attributes['date'])))
            ->assertSee($attributes['financial_witnesses']);

        $this->assertDatabaseHas('service_rounds', $attributes);
    }

    /** @test */
    public function a_financial_officer_can_update_a_service_round()
    {
        $serviceRound = factory(ServiceRound::class)->create();

        $this->get(route('finance.service-round.edit', $serviceRound))->assertStatus(200);

        $attributes = [
            'date' => $this->faker->date('Y-m-d H:i:s'),
            'financial_witnesses' => 'John Doe, Jan Doe, Michael'
        ];

        $this->put(route('finance.service-round.update', $serviceRound), $attributes)
            ->assertRedirect(route('finance.service-round.show', $serviceRound));

        $this->get(route('finance.service-round.show', $serviceRound))
            ->assertSee(defaultDateFormat(Carbon::parse($attributes['date'])))
            ->assertSee($attributes['financial_witnesses']);

        $this->assertDatabaseHas('service_rounds', $attributes);
    }

    /** @test */
    public function a_finance_officer_can_softly_delete_a_service_round()
    {
        $serviceRound = factory(ServiceRound::class)->create();

        $this->delete(route('finance.service-round.destroy', $serviceRound))
            ->assertStatus(302);

        $this->assertSoftDeleted('service_rounds', $serviceRound->fresh()->toArray());
    }
    
    /** @test */
    public function a_service_round_requires_a_date()
    {
        $attributes = factory(ServiceRound::class)->raw(['date' => '']);

        $this->post(route('finance.service-round.store'), $attributes)->assertSessionHasErrors('date');
    }
}
