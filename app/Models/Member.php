<?php

namespace App\Models;

use App\Enums\AdministrativeStatusEnum;
use App\Enums\SpiritualStatusEnum;
use App\Models\Scopes\UserDataAccess;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cell_id',
        'email',
        'spiritual_status',
        'first_name',
        'last_name',
        'nickname',
        'gender',
        'birthday',
        'idcard',
        'race',
        'nationality',
        'mobile_number',
        'facebook',
        'line',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'birthday'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

//        static::addGlobalScope(new memberDataAccess());
        // Format the member id to always start from 6 digits.
        static::created(function ($member) {
            $memberCode = sprintf("%06s", sprintf("%06s", $member->id));

            $member->code = $memberCode;
            $member->password = bcrypt($memberCode);
            $member->administrative_status = AdministrativeStatusEnum::MEMBER;

            $member->save();
        });
    }


    /**
     * Concatenate first name and last name together
     *
     * @return string
     */
    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get member's spiritual status;
     *
     * @return SpiritualStatusEnum
     * @internal param $attribute
     */
    public function getSpiritualStatusNameAttribute() {
        return (new SpiritualStatusEnum($this->spiritual_status))->getKey();
    }

    /**
     * Relate member's addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses() {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Relate to member's emergency contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function emergencyContact() {
        return $this->hasOne(EmergencyContact::class);
    }


    /**
     * Relate to member's marigae imformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mariage() {
        return $this->hasOne(Mariage::class);
    }

    /**
     * Relate to member's cell.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cell() {
        return $this->belongsTo(Cell::class);
    }


    /**
     * Check whether a member has the same address or not.
     *
     * @return bool
     */
    public function getSameAddressAttribute() {
        return $this->addresses->count() == 1;
    }

    /**
     * Get member's age.
     *
     * @return int
     */
    public function getAgeAttribute() {
        return Carbon::parse($this->birthday)->age;
    }

    /**
     * @param $query
     */
    public function scopeChurchStructureAccess($query) {
        // Only if the administrative status of member is "member" is applied for this accession.
        if (auth()->member()->administrative_status == AdministrativeStatusEnum::MEMBER) {
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

            switch (auth()->member()->spiritual_status) {
                case SpiritualStatusEnum::CELL_LEADER:
                    $query->whereHas('cell', function($cell) {
                        $cell->whereId(auth()->member()->cell_id);
                    })->whereIn('spiritual_status', $cellLeaderAccessable);
                    break;
                case SpiritualStatusEnum::CHURCH_LEADER:
                    $query->whereHas('cell.church', function($church) {
                        $church->whereId(auth()->member()->cell->church->id);
                    })->whereIn('spiritual_status', $churchLeaderAccessable);
                    break;
                case SpiritualStatusEnum::DISTRICT_LEADER:
                    $query->whereHas('cell.church.district', function($church) {
                        $church->whereId(auth()->member()->cell->church->district->id);
                    })->whereIn('spiritual_status', $districtLeaderAccessable);
                    break;
                case SpiritualStatusEnum::PROVINCE_LEADER:
                    $query->whereHas('cell.church.district.province', function($church) {
                        $church->whereId(auth()->member()->cell->church->district->province->id);
                    })->whereIn('spiritual_status', $provinceLeaderAccessable);
                    break;
                case  SpiritualStatusEnum::PASTOR
                :break;
            }
        }
    }
}
