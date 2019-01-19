<?php

namespace App\Models\Scopes;

use App\Enums\AdministrativeStatusEnum;
use App\Enums\SpiritualStatusEnum;
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

        //Only if the administrative status of user is "USER" is applied for this accession.
        if ($user->administrative_status == AdministrativeStatusEnum::MEMBER) {
            $cellLeaderAccessable = [
                SpiritualStatusEnum::NEW_COMER,
                SpiritualStatusEnum::NEW_BELIEVER,
                SpiritualStatusEnum::REGULAR_BELIEVER,
                SpiritualStatusEnum::CHURCH_MEMBER,
                SpiritualStatusEnum::SHEPHERD,
                SpiritualStatusEnum::CELL_LEADER
            ];

            $churchLeaderAccessable = array_merge($cellLeaderAccessable, [SpiritualStatusEnum::CHURCH_LEADER]);

            $districtLeaderAccessable = array_merge($churchLeaderAccessable, [SpiritualStatusEnum::DISTRICT_LEADER]);

            $provinceLeaderAccessable = array_merge($districtLeaderAccessable, [SpiritualStatusEnum::PROVINCE_LEADER]);

            switch ($user->spiritual_status) {
                case SpiritualStatusEnum::CELL_LEADER:
                    $builder->whereHas('cell', function($cell) use ($user) {
                        $cell->whereId($user->cell_id);
                    })->whereIn('spiritual_status', $cellLeaderAccessable);
                    break;
                case SpiritualStatusEnum::CHURCH_LEADER:
                    $builder->whereHas('cell.church', function($church) use ($user) {
                        $church->whereId($user->cell->church->id);
                    })->whereIn('spiritual_status', $churchLeaderAccessable);
                    break;
                case SpiritualStatusEnum::DISTRICT_LEADER:
                    $builder->whereHas('cell.church.district', function($church) use ($user) {
                        $church->whereId($user->cell->church->district->id);
                    })->whereIn('spiritual_status', $districtLeaderAccessable);
                    break;
                case SpiritualStatusEnum::PROVINCE_LEADER:
                    $builder->whereHas('cell.church.district.province', function($church) use ($user) {
                        $church->whereId($user->cell->church->district->province->id);
                    })->whereIn('spiritual_status', $provinceLeaderAccessable);
                    break;
                case  SpiritualStatusEnum::PASTOR
                :break;
            }
        }
    }
}
