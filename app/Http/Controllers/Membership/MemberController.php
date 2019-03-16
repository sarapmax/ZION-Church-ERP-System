<?php

namespace App\Http\Controllers\Membership;

use App\Enums\AddressType;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $member = Member::with(['cell', 'cell.area', 'cell.area.church']);

        if ($request->search_keyword != null) {
            $member->where('first_name', 'LIKE', '%' . $request->search_keyword . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->search_keyword . '%')
                ->orWhere('nickname', 'LIKE', '%' . $request->search_keyword . '%')
                ->orWhere('code', 'LIKE', '%' . $request->search_keyword . '%');
        }

        if ($request->province_id != null) {
            $member->whereHas('cell.area.church.district.province', function($query) use($request) {
                $query->whereId($request->province_id);
            });
        }

        if ($request->district_id != null) {
            $member->whereHas('cell.area.church.district', function($query) use($request) {
                $query->whereId($request->district_id);
            });
        }

        if ($request->church_id != null) {
            $member->whereHas('cell.area.church', function($query) use($request) {
                $query->whereId($request->church_id);
            });
        }

        if ($request->area_id != null) {
            $member->whereHas('cell.area', function($query) use($request) {
                $query->whereId($request->area_id);
            });
        }

        if ($request->cell_id != null) {
            $member->whereHas('cell', function($query) use($request) {
                $query->whereId($request->cell_id);
            });
        }

        if ($request->shepard_id != null) {
            $member->whereShepardId($request->shepard_id);
        }

        if ($request->spiritual_status != null) {
            $member->whereSpiritualStatus($request->spiritual_status);
        }

        $members = $member->orderBy('cell_id')->orderBy('spiritual_status', 'desc')->paginate(20);

        return view('membership.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MemberRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $member = new Member;

        $input = [
            'shepard_id' => $request->shepard_id,
            'cell_id' => $request->cell_id,
            'email' => $request->email,
            'spiritual_status' => $request->spiritual_status,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'idcard' => $request->idcard,
            'race' => $request->race,
            'nationality' => $request->nationality,
            'mobile_number' => $request->mobile_number,
            'facebook' => $request->facebook,
            'line' => $request->line,
        ];

        // Save profile image.
        if ($request->has('profile_image')) {
            $profileImageName = $member->uploadProfileImage($request->file('profile_image'));

            $input['profile_image'] = $profileImageName;
        }

        $member = $member->create($input);

        // Create user's mariage.
        $member->mariage()->create([
            'status' => $request->marital_status,
            'spouse_name' => $request->spoouse_name,
            'spouse_nickname' => $request->spouse_nickname,
            'spouse_birthday' => $request->spouse_birthday,
            'spouse_christian' => $request->has('spouse_christian')
        ]);

        // Create user's addresses.
        $member->addresses()->create([
            'sub_district_id' => $request->original_address_sub_district_id,
            'type' => AddressType::ORIGINAL,
            'detail' => $request->original_address_detail,
            'postcode' => $request->original_address_postcode
        ]);

        // If the address is not the same.
        if (!$request->has('same_address')) {
            $member->addresses()->create([
                'sub_district_id' => $request->current_address_sub_district_id,
                'type' => AddressType::CURRENT,
                'detail' => $request->current_address_detail,
                'postcode' => $request->current_address_postcode
            ]);
        }

        // Create user's emergency contact
        $member->emergencyContact()->create([
            'name' => $request->emergency_name,
            'nickname' => $request->emergency_nickname,
            'age' => $request->emergency_age,
            'relationship' => $request->emergency_relationship,
            'mobile_number' => $request->emergency_mobile_number
        ]);

        // Create user's emergency contact address
        $member->emergencyContact->address()->create([
            'sub_district_id' => $request->emergency_address_sub_district_id,
            'type' => AddressType::EMERGENCY,
            'detail' => $request->emergency_address_detail,
            'postcode' => $request->emergency_address_postcode
        ]);

        return redirect()->route('membership.member.show', $member)->with('success', 'เพิ่มข้อมูลสมาชิกเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Member $member)
    {
        return view('membership.member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Member $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('membership.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MemberRequest|Request $request
     * @param Member $member
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(MemberRequest $request, Member $member)
    {
        $input = [
            'shepard_id' => $request->shepard_id,
            'cell_id' => $request->cell_id,
            'email' => $request->email,
            'spiritual_status' => $request->spiritual_status,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'idcard' => $request->idcard,
            'race' => $request->race,
            'nationality' => $request->nationality,
            'mobile_number' => $request->mobile_number,
            'facebook' => $request->facebook,
            'line' => $request->line,
        ];

        // Save profile image.
        if ($request->has('profile_image')) {
            $profileImageName = $member->uploadProfileImage($request->file('profile_image'));

            File::delete('profile-images/' . $member->profile_image);

            $input['profile_image'] = $profileImageName;
        }

        $member->update($input);

        // Update user's mariage.
        $member->mariage()->update([
            'status' => $request->marital_status,
            'spouse_name' => $request->spoouse_name,
            'spouse_nickname' => $request->spouse_nickname,
            'spouse_birthday' => $request->spouse_birthday,
            'spouse_christian' => $request->has('spouse_christian')
        ]);

        // Update user's addresses.
        foreach($member->addresses as $address) {
            if ($address->type == AddressType::ORIGINAL) {
                $address->update([
                    'sub_district_id' => $request->original_address_sub_district_id,
                    'detail' => $request->original_address_detail,
                    'postcode' => $request->original_address_postcode
                ]);
            }
        }

        // If a user didn't have the current address and wants to add more.
        if (!$request->has('same_address') && $member->addresses->count() != 2) {
            $member->addresses()->create([
                'sub_district_id' => $request->current_address_sub_district_id,
                'type' => AddressType::CURRENT,
                'detail' => $request->current_address_detail,
                'postcode' => $request->current_address_postcode
            ]);
        // If a user have the current address and wants to delete it.
        } else if($request->has('same_address') && $member->addresses->count() == 2){
            foreach($member->addresses as $address) {
                if ($address->type == AddressType::CURRENT) {
                    $address->delete();
                }
            }
        // If a user just wants to update the current address.
        } else {
            foreach($member->addresses as $address) {
                if ($address->type == AddressType::CURRENT) {
                    $address->update([
                        'sub_district_id' => $request->current_address_sub_district_id,
                        'detail' => $request->current_address_detail,
                        'postcode' => $request->current_address_postcode
                    ]);
                }
            }
        }

        // Create user's emergency contact
        $member->emergencyContact()->update([
            'name' => $request->emergency_name,
            'nickname' => $request->emergency_nickname,
            'age' => $request->emergency_age,
            'relationship' => $request->emergency_relationship,
            'mobile_number' => $request->emergency_mobile_number
        ]);

        // Create user's emergency contact address
        $member->emergencyContact->address()->update([
            'sub_district_id' => $request->emergency_address_sub_district_id,
            'type' => AddressType::EMERGENCY,
            'detail' => $request->emergency_address_detail,
            'postcode' => $request->emergency_address_postcode
        ]);

        return redirect()->route('membership.member.show', $member)->with('success', 'แก้ไขข้อมูลสมาชิกเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('membership.member.index')->with('success', 'ลบข้อมูลสมาชิกเรียบร้อยแล้ว');
    }
}
