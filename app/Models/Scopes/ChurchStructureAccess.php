<?php

namespace App\Models\Scopes;

use App\Enums\AdministrativeStatus;
use App\Enums\SpiritualStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ChurchStructureAccess implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();

        //Only if a user has only "MEMBER" status is applied for this accession.
        if (in_array(AdministrativeStatus::MEMBER, $user->administrativeStatuses->pluck('status')->toArray())
            && $user->administrativeStatuses->count() == 1
        ) {
            $cellLeaderAccessable = [
                SpiritualStatus::NEW_COMER,
                SpiritualStatus::NEW_BELIEVER,
                SpiritualStatus::REGULAR_BELIEVER,
                SpiritualStatus::CHURCH_MEMBER,
                SpiritualStatus::SHEPHERD,
                SpiritualStatus::CELL_LEADER
            ];

            $churchLeaderAccessable = array_merge($cellLeaderAccessable, [SpiritualStatus::CHURCH_LEADER]);

            $districtLeaderAccessable = array_merge($churchLeaderAccessable, [SpiritualStatus::DISTRICT_LEADER]);

            $provinceLeaderAccessable = array_merge($districtLeaderAccessable, [SpiritualStatus::PROVINCE_LEADER]);

            switch ($user->spiritual_status) {
                case SpiritualStatus::CELL_LEADER:
                    $builder->whereHas('cell', function($cell) use ($user) {
                        $cell->whereId($user->cell_id);
                    })->whereIn('spiritual_status', $cellLeaderAccessable);
                    break;
                case SpiritualStatus::CHURCH_LEADER:
                    $builder->whereHas('cell.church', function($church) use ($user) {
                        $church->whereId($user->cell->church->id);
                    })->whereIn('spiritual_status', $churchLeaderAccessable);
                    break;
                case SpiritualStatus::DISTRICT_LEADER:
                    $builder->whereHas('cell.church.district', function($church) use ($user) {
                        $church->whereId($user->cell->church->district->id);
                    })->whereIn('spiritual_status', $districtLeaderAccessable);
                    break;
                case SpiritualStatus::PROVINCE_LEADER:
                    $builder->whereHas('cell.church.district.province', function($church) use ($user) {
                        $church->whereId($user->cell->church->district->province->id);
                    })->whereIn('spiritual_status', $provinceLeaderAccessable);
                    break;
                case  SpiritualStatus::PASTOR
                :break;
            }
        }
    }
}
