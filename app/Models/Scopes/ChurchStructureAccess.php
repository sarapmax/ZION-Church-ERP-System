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
            $cellLeaderAccessible = [
                SpiritualStatus::NEW_COMER,
                SpiritualStatus::NEW_BELIEVER,
                SpiritualStatus::REGULAR_BELIEVER,
                SpiritualStatus::CHURCH_MEMBER,
                SpiritualStatus::SHEPHERD,
                SpiritualStatus::CELL_LEADER
            ];

            $areaLeaderAccessible = array_merge($cellLeaderAccessible, [SpiritualStatus::AREA_LEADER]);
            $churchLeaderAccessible = array_merge($areaLeaderAccessible, [SpiritualStatus::CHURCH_LEADER]);
            $districtLeaderAccessible = array_merge($churchLeaderAccessible, [SpiritualStatus::DISTRICT_LEADER]);
            $provinceLeaderAccessible = array_merge($districtLeaderAccessible, [SpiritualStatus::PROVINCE_LEADER]);
            $regionLeaderAccessible = array_merge($provinceLeaderAccessible, [SpiritualStatus::REGION_LEADER]);

            switch ($user->spiritual_status) {
                case SpiritualStatus::CELL_LEADER:
                    $builder->whereHas('cell', function($cell) use ($user) {
                        $cell->whereId($user->cell_id);
                    })->whereIn('spiritual_status', $cellLeaderAccessible);
                    break;
                case SpiritualStatus::AREA_LEADER:
                    $builder->whereHas('cell.area', function($area) use ($user) {
                        $area->whereId($user->cell->area_id);
                    })->whereIn('spiritual_status', $areaLeaderAccessible);
                    break;
                case SpiritualStatus::CHURCH_LEADER:
                    $builder->whereHas('cell.area.church', function($church) use ($user) {
                        $church->whereId($user->cell->area->church_id);
                    })->whereIn('spiritual_status', $churchLeaderAccessible);
                    break;
                case SpiritualStatus::DISTRICT_LEADER:
                    $builder->whereHas('cell.area.church.district', function($district) use ($user) {
                        $district->whereId($user->cell->area->church->district_id);
                    })->whereIn('spiritual_status', $districtLeaderAccessible);
                    break;
                case SpiritualStatus::PROVINCE_LEADER:
                    $builder->whereHas('cell.area.church.district.province', function($province) use ($user) {
                        $province->whereId($user->cell->area->church->district->province_id);
                    })->whereIn('spiritual_status', $provinceLeaderAccessible);
                    break;
                case SpiritualStatus::REGION_LEADER:
                    $builder->whereHas('cell.area.church.district.province.region', function($region) use ($user) {
                        $region->whereId($user->cell->area->church->district->province->region_id);
                    })->whereIn('spiritual_status', $regionLeaderAccessible);
                    break;
                case  SpiritualStatus::PASTOR
                :break;
            }
        }
    }
}
