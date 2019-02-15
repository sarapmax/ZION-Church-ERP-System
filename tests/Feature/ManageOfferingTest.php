<?php

namespace Tests\Feature;

use App\Enums\AdministrativeStatus;
use App\Enums\OfferingType;
use App\Enums\SpiritualStatus;
use App\Models\Member;
use App\Models\Offering;
use App\Models\ServiceRound;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageOfferingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function only_financial_officer_can_manage_offering_form()
    {
        $this->withoutExceptionHandling();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $this->get(route('finance.offering.index'))->assertStatus(200);
        $this->post(route('finance.offering.store'), factory(Offering::class)->raw())->assertStatus(302);
    }

    /** @test */
    public function a_member_who_is_not_a_financial_officer_cannot_manage_offering_form()
    {
        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::MEMBER,
            AdministrativeStatus::ADMIN
        ]);

        $this->get(route('finance.offering.index'))->assertStatus(403);
        $this->post(route('finance.offering.store'), factory(Offering::class)->raw())->assertStatus(403);
    }

    /** @test */
    public function a_financial_officer_can_briefly_view_offering_records()
    {
        $this->withoutExceptionHandling();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $financialOfficer = auth()->user();

        $financialOfficer->offerings()->createMany(factory(Offering::class, 20)->raw());

        $this->get(route('finance.offering.index'))
            ->assertViewHasAll(['serviceRounds', 'offeringRecords'])
            ->assertViewHas('serviceRounds', function($serviceRounds) {
                return $serviceRounds->count() == 10;
            })
            ->assertViewHas('offeringRecords', function($offeringRecords) {
                return $offeringRecords->count() == 8;
            });
    }

    /** @test */
    public function offering_form_may_get_service_round_form_query_string()
    {
        $this->withoutExceptionHandling();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $serviceRoundDate = factory(ServiceRound::class)->create()->date;

        $this->get(route('finance.offering.index', ['service_round_date' => defaultDateFormat($serviceRoundDate)]))
            ->assertViewHas('serviceRoundDate');
    }

    /** @test */
    public function a_financial_officer_can_add_an_offering_record()
    {
        $this->withoutExceptionHandling();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $attributes = [
            'service_round_id' => factory(ServiceRound::class)->create()->id,
            'member_id' => factory(Member::class)->create()->id,
            'type' => $this->faker->randomElement(OfferingType::getValues()),
            'amount' => 5000,
            'need_receipt' => true
        ];

        $this->post(route('finance.offering.store'), $attributes)->assertSessionHas('success');

        $this->assertDatabaseHas('offerings', $attributes);

        $this->get(route('finance.offering.index'))
            ->assertSee($attributes['service_round_id'])
            ->assertSee($attributes['member_id'])
            ->assertSee($attributes['type'])
            ->assertSee($attributes['need_receipt'])
            ->assertSee(number_format($attributes['amount']));
    }
    
    /** @test */
    public function a_offering_record_requires_a_valid_member_id()
    {
        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['member_id' => '']))
            ->assertSessionHasErrors('member_id');

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['member_id' => 999]))
            ->assertSessionHasErrors('member_id');
    }

    /** @test */
    public function a_offering_record_requires_a_valid_type()
    {
        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['type' => '']))
            ->assertSessionHasErrors('type');

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['type' => 999]))
            ->assertSessionHasErrors('type');
    }

    /** @test */
    public function a_offering_record_requires_a_valid_amount()
    {
        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['amount' => '']))
            ->assertSessionHasErrors('amount');

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['amount' => 'John Doe']))
            ->assertSessionHasErrors('amount');

        $this->post(route('finance.offering.store'), factory(Offering::class)->raw(['amount' => 999.99]))
            ->assertSessionHasErrors('amount');
    }

    /** @test */
    public function a_financial_officer_can_delete_an_offering_record()
    {
        $this->withoutExceptionHandling();

        $this->signInAs(SpiritualStatus::CELL_LEADER, [
            AdministrativeStatus::FINANCIAL_OFFICER
        ]);

        $financialOfficer = auth()->user();

        $offeringRecord = $financialOfficer->offerings()->create(factory(Offering::class)->raw());

        $this->assertDatabaseHas('offerings', $offeringRecord->toArray());

        $this->delete(route('finance.offering.destroy', $offeringRecord))
            ->assertStatus(302)
            ->assertSessionHas('success');;

        $this->assertDatabaseMissing('offerings', $offeringRecord->toArray());
    }
}
