<?php

namespace App\Models;

use App\Enums\AdministrativeStatus;
use App\Enums\SpiritualStatus;
use App\Models\Scopes\ChurchStructureAccess;
use App\Models\Supports\UserMemberShare;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\ImageManagerStatic;

class Member extends User
{
    use SoftDeletes, UserMemberShare;

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
        'shepard_id',
        'cell_id',
        'email',
        'spiritual_status',
        'name_prefix',
        'first_name',
        'last_name',
        'nickname',
        'gender',
        'profile_image',
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

        static::addGlobalScope(new ChurchStructureAccess());

        // Format the member id to always start from 6 digits.
        static::created(function ($member) {
            $memberCode = sprintf("%06s", sprintf("%06s", $member->id));

            $member->code = $memberCode;
            $member->password = bcrypt($memberCode);
            $member->save();

            $member->administrativeStatuses()->create([
                'status' => AdministrativeStatus::MEMBER
            ]);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shepard() {
        return $this->belongsTo(Member::class, 'shepard_id');
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
     * Upload member profile image.
     *
     * @param $profileImage
     * @return string
     */
    public function uploadProfileImage($profileImage)
    {
        $profileImageName = time().'.'.$profileImage->getClientOriginalExtension();

        $profileImage = ImageManagerStatic::make($profileImage->getRealPath());
        $profileImage->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $profileImage->save(public_path('profile-images') . '/' . $profileImageName);

        return $profileImageName;
    }
}
