<?php

namespace App\Http\Controllers\Membership;

use App\Address;
use App\Enums\AddressTypeEnum;
use App\Enums\SubmissionTypeEnum;
use App\Http\Requests\UserRequest;
use App\Mariage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('cell', 'cell.church')->get();

        return view('membership.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
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
        ]);

        // Create user's marige.
        $user->mariage()->create([
            'status' => $request->marital_status,
            'spouse_name' => $request->spoouse_name,
            'spouse_nickname' => $request->spouse_nickname,
            'spouse_birthday' => $request->spouse_birthday,
            'spouse_christian' => $request->has('spouse_christian')
        ]);

        // Create user's addresses.
        $user->addresses()->create([
            'sub_district_id' => $request->original_address_sub_district_id,
            'type' => AddressTypeEnum::ORIGINAL,
            'detail' => $request->original_address_detail,
            'postcode' => $request->original_address_postcode
        ]);

        // If the address is not the same.
        if (!$request->has('same_address')) {
            $user->addresses()->create([
                'sub_district_id' => $request->current_address_sub_district_id,
                'type' => AddressTypeEnum::CURRENT,
                'detail' => $request->current_address_detail,
                'postcode' => $request->current_address_postcode
            ]);
        }

        // Create user's emergency contact
        $user->emergencyContact()->create([
            'name' => $request->emergency_name,
            'nickname' => $request->emergency_nickname,
            'age' => $request->emergency_age,
            'relationship' => $request->emergency_relationship,
            'mobile_number' => $request->emergency_mobile_number
        ]);

        // Create user's emergency contact address
        $user->emergencyContact->address()->create([
            'sub_district_id' => $request->emergency_address_sub_district_id,
            'type' => AddressTypeEnum::EMERGENCY,
            'detail' => $request->emergency_address_detail,
            'postcode' => $request->emergency_address_postcode
        ]);

        return redirect()->route('membership.user.index')->with('success', 'เพิ่มสมาชิกเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('membership.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update([
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
        ]);

        // Update user's marige.
        $user->mariage()->update([
            'status' => $request->marital_status,
            'spouse_name' => $request->spoouse_name,
            'spouse_nickname' => $request->spouse_nickname,
            'spouse_birthday' => $request->spouse_birthday,
            'spouse_christian' => $request->has('spouse_christian')
        ]);

        // Update user's addresses.
        foreach($user->addresses() as $address) {
            if ($address->type == AddressTypeEnum::ORIGINAL) {
                $address->update([
                    'sub_district_id' => $request->original_address_sub_district_id,
                    'detail' => $request->original_address_detail,
                    'postcode' => $request->original_address_postcode
                ]);
            }
        }

        // If a user didn't have the current address and wants to add more.
        if (!$request->has('same_address') && $user->addresses->count() != 2) {
            $user->addresses()->create([
                'sub_district_id' => $request->current_address_sub_district_id,
                'type' => AddressTypeEnum::CURRENT,
                'detail' => $request->current_address_detail,
                'postcode' => $request->current_address_postcode
            ]);
        // If a user have the current address and wants to delete it.
        } else if($request->has('same_address') && $user->addresses->count() == 2){
            foreach($user->addresses as $address) {
                if ($address->type == AddressTypeEnum::CURRENT) {
                    $address->delete();
                }
            }
        // If a user just wants to update the current address.
        } else {
            foreach($user->addresses as $address) {
                if ($address->type == AddressTypeEnum::CURRENT) {
                    $address->update([
                        'sub_district_id' => $request->current_address_sub_district_id,
                        'detail' => $request->current_address_detail,
                        'postcode' => $request->current_address_postcode
                    ]);
                }
            }
        }

        // Create user's emergency contact
        $user->emergencyContact()->update([
            'name' => $request->emergency_name,
            'nickname' => $request->emergency_nickname,
            'age' => $request->emergency_age,
            'relationship' => $request->emergency_relationship,
            'mobile_number' => $request->emergency_mobile_number
        ]);

        // Create user's emergency contact address
        $user->emergencyContact->address()->update([
            'sub_district_id' => $request->emergency_address_sub_district_id,
            'type' => AddressTypeEnum::EMERGENCY,
            'detail' => $request->emergency_address_detail,
            'postcode' => $request->emergency_address_postcode
        ]);

        return redirect()->route('membership.user.index')->with('success', 'แก้สมาชิกเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
