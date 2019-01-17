@extends('layouts.master')

@section('content')
    <user-form inline-template :old-same-address="{{ json_encode(old('same_address', $user->same_address)) }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="element-wrapper">
                    <h5 class="element-header">
                        แก้ไขข้อมูลสมาชิก
                    </h5>
                    <div class="element-box">
                        <form action="{{ route('membership.user.update', $user) }}" method="POST">
                            @csrf

                            {{ method_field('PUT') }}

                            {{--Church detail fields--}}
                            <fieldset>
                                <legend>
                                    <span>ข้อมูลคริสตจักร</span>
                                </legend>

                                @include('components.selection.church-structure', [
                                    'old' => [
                                        'province_id' => old('province_id', $user->cell->church->district->province->id),
                                        'district_id' => old('district_id', $user->cell->church->district->id),
                                        'church_id' => old('church_id', $user->cell->church->id),
                                        'cell_id' => old('cell_id', $user->cell_id)
                                    ],
                                    'excepts' => []
                                ])

                                <div class="form-group">
                                    <label for="spiritual_status" class="required">สถานะผู้เชื่อ </label>
                                    <select id="spiritual_status" class="form-control{{ $errors->has('spiritual_status') ? ' is-invalid' : '' }}" name="spiritual_status">
                                        <option value="">-- Select --</option>
                                        @foreach(SpiritualStatus::constants() as $key => $value)
                                            <option value="{{ $value }}" @if(old('spiritual_status', $user->spiritual_status) == $value) selected @endif>{{ __('spiritual-status.' . $key) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block form-text text-muted form-control-feedback">
                                        หากไม่แน่ใจ กรุณาถามพี่เลี้ยงของท่าน
                                    </div>

                                    @if ($errors->has('spiritual_status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('spiritual_status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </fieldset>

                            {{--Persoanl detail fields--}}
                            <fieldset>
                                <legend>
                                    <span>ข้อมูลส่วนตัว</span>
                                </legend>

                                <div class="form-group">
                                    <label for="first_name" class="required">ชื่อ </label>
                                    <input id="first_name" type="text"
                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           name="first_name"
                                           value="{{ old('first_name', $user->first_name) }}" required>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="last_name" class="required">นามสกุล </label>
                                    <input id="last_name" type="text"
                                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           name="last_name"
                                           value="{{ old('last_name', $user->last_name) }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="nickname" class="required">ชื่อเล่น </label>
                                    <input id="nickname" type="text"
                                           class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}"
                                           name="nickname"
                                           value="{{ old('nickname', $user->nickname) }}" required>

                                    @if ($errors->has('nickname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nickname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="required">เพศ </label>
                                    <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required>
                                        <option value="">-- Select --</option>
                                        <option value="male" @if(old('gender', $user->gender) == 'male') selected @endif>ชาย</option>
                                        <option value="female" @if(old('gender', $user->gender) == 'female') selected @endif>หญิง</option>
                                    </select>

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="birthday" class="required">วันเกิด </label>
                                    <input id="birthday" type="text"
                                           class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                           name="birthday"
                                           value="{{ old('birthday', $user->birthday) }}" required>

                                    @if ($errors->has('birthday'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birthday') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="idcard" class="required">เลขบัตรประจำตัวประชาชน </label>
                                    <input id="idcard" type="text"
                                           class="form-control{{ $errors->has('idcard') ? ' is-invalid' : '' }}"
                                           name="idcard"
                                           value="{{ old('idcard', $user->idcard) }}" required>
                                    <div class="help-block form-text text-muted form-control-feedback">
                                        เลขบัตรประจำตัวประชาชน 13 หลัก - ข้อมูลสำคัญ กรุณาตรวจสอบข้อมูลให้ถูกต้อง
                                    </div>

                                    @if ($errors->has('idcard'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('idcard') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="race" class="required">เชื้อขาติ </label>
                                    <input id="race" type="text"
                                           class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}" name="race"
                                           value="{{ old('race', $user->race) }}" required>

                                    @if ($errors->has('race'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('race') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="nationality" class="required">สัญชาติ </label>
                                    <input id="nationality" type="text"
                                           class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}"
                                           name="nationality"
                                           value="{{ old('nationality', $user->nationality) }}" required>

                                    @if ($errors->has('nationality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </fieldset>

                            {{--Contact fields--}}
                            <fieldset>
                                <legend>
                                    <span>ข้อมูลการติดต่อ</span>
                                </legend>

                                <div class="form-group">
                                    <label for="email">Email </label>
                                    <input id="email" type="text"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                           value="{{ old('email', $user->email) }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="mobile_number" class="required">เบอร์โทรศัพท์มือถือ </label>
                                    <input id="mobile_number" type="text"
                                           class="form-control{{ $errors->has('mobile_number') ? ' is-invalid' : '' }}"
                                           name="mobile_number"
                                           value="{{ old('mobile_number', $user->mobile_number) }}" required>
                                    <div class="help-block form-text text-muted form-control-feedback">
                                        เบอร์โทรศัพท์มือถือ 10 หลัก ไม่ต้องมีเคลื่องหมายหรือเว้นวรรค
                                    </div>

                                    @if ($errors->has('mobile_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="facebook">Facebook </label>
                                    <input id="facebook" type="text"
                                           class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                                           name="facebook"
                                           value="{{ old('facebook', $user->facebook) }}">
                                    <div class="help-block form-text text-muted form-control-feedback">
                                        กรุณากรอกเป็นชื่อ Facebook หรือ URL
                                    </div>

                                    @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="line">Line ID</label>
                                    <input id="line" type="text"
                                           class="form-control{{ $errors->has('line') ? ' is-invalid' : '' }}" name="line"
                                           value="{{ old('line', $user->line) }}">
                                    <div class="help-block form-text text-muted form-control-feedback">
                                        กรุณากรอกเป็น Line ID
                                    </div>

                                    @if ($errors->has('line'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('line') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </fieldset>

                            {{--Current Address fields--}}
                            <fieldset>
                                <legend>
                                    <span>ที่อยู่ตามทะเบียนบ้าน</span>
                                </legend>

                                @foreach($user->addresses as $address)
                                    @if($address->type == AddressType::ORIGINAL)
                                        @include('partials.forms.address', [
                                            'name' => 'original_address',
                                            'old' => [
                                                'province_id' => old('original_address_province_id', $address->subDistrict->district->province->id),
                                                'district_id' => old('original_address_district_id', $address->subDistrict->district->id),
                                                'sub_district_id' => old('original_address_sub_district_id', $address->sub_district_id),
                                                'detail' => old('original_address_detail', $address->detail)
                                            ]
                                        ])
                                    @endif
                                @endforeach
                            </fieldset>

                            {{--Original Address fields--}}
                            <fieldset>
                                <legend>
                                    <span>ที่อยู่ปัจจุบันที่สามารถติดต่อได้</span>
                                </legend>

                                <div class="form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="same_address" v-model="sameAddress" value="yes"> เหมือนที่อยู่ตามทะเบียนบ้าน
                                    </label>

                                    @if ($errors->has('same_address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('same_address') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div v-show="!sameAddress">
                                    @foreach($user->addresses as $address)
                                        @if($address->type == AddressType::CURRENT)
                                            @include('partials.forms.address', [
                                                'name' => 'current_address',
                                                'old' => [
                                                    'province_id' => old('current_address_province_id', $address->subDistrict->district->province->id),
                                                    'district_id' => old('current_address_district_id', $address->subDistrict->district->id),
                                                    'sub_district_id' => old('current_address_sub_district_id', $address->sub_district_id),
                                                    'detail' => old('current_address_detail', $address->detail)
                                                ]
                                            ])
                                        @endif
                                    @endforeach

                                    @if($user->same_address)
                                        @include('partials.forms.address', [
                                            'name' => 'current_address',
                                            'old' => [
                                                'province_id' => old('current_address_province_id'),
                                                'district_id' => old('current_address_district_id'),
                                                'sub_district_id' => old('current_address_sub_district_id'),
                                                'detail' => old('current_address_detail')
                                            ]
                                        ])
                                    @endif
                                </div>
                            </fieldset>

                            {{--Mariage detail fields--}}
                            <fieldset>
                                <legend>
                                    <span>สถานภาพ</span>
                                </legend>

                                <div class="form-group">
                                    <label for="marital_status" class="required">สถานภาพ </label>
                                    <select id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}" name="marital_status" required>
                                        <option value="">-- Select --</option>
                                        @foreach(MariageStatus::constants() as $key => $value)
                                            <option value="{{ $value }}" @if(old('marital_status', $user->mariage->status) == $value) selected @endif>{{ __('mariage-status.' . $key) }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('marital_status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="spoouse_name">ชื่อคู่สมรส </label>
                                    <input id="spoouse_name" type="text"
                                           class="form-control{{ $errors->has('spoouse_name') ? ' is-invalid' : '' }}"
                                           name="spoouse_name"
                                           value="{{ old('spoouse_name', $user->mariage->spouse_name) }}">

                                    @if ($errors->has('spoouse_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('spoouse_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="spouse_nickname">ชื่อเล่นคู่สมรถ </label>
                                    <input id="spouse_nickname" type="text"
                                           class="form-control{{ $errors->has('spouse_nickname') ? ' is-invalid' : '' }}"
                                           name="spouse_nickname"
                                           value="{{ old('spouse_nickname', $user->mariage->spouse_nickname) }}">

                                    @if ($errors->has('spouse_nickname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('spouse_nickname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="spouse_birthday">วันเกิดคู่สมรถ </label>
                                    <input id="spouse_birthday" type="text"
                                           class="form-control{{ $errors->has('spouse_birthday') ? ' is-invalid' : '' }}"
                                           name="spouse_birthday"
                                           value="{{ old('spouse_birthday', $user->mariage->spouse_birthday) }}">

                                    @if ($errors->has('spouse_birthday'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('spouse_birthday') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="spouse_christian" value="yes" @if(old('spouse_christian', $user->mariage->spouse_christian)) checked @endif> เป็นคริสเตียน
                                    </label>

                                    @if ($errors->has('spouse_christian'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('spouse_christian') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </fieldset>

                            {{--Emergency detail fields--}}
                            <fieldset>
                                <legend>
                                    <span>บุคคลที่สามารถติดต่อได้ในกรณีฉุกเฉิน</span>
                                </legend>

                                <div class="form-group">
                                    <label for="emergency_name" class="required">ชื่อ </label>
                                    <input id="emergency_name" type="text"
                                           class="form-control{{ $errors->has('emergency_name') ? ' is-invalid' : '' }}"
                                           name="emergency_name"
                                           value="{{ old('emergency_name', $user->emergencyContact->name) }}" required>

                                    @if ($errors->has('emergency_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emergency_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="emergency_nickname">ชื่อเล่น </label>
                                    <input id="emergency_nickname" type="text"
                                           class="form-control{{ $errors->has('emergency_nickname') ? ' is-invalid' : '' }}"
                                           name="emergency_nickname"
                                           value="{{ old('emergency_nickname', $user->emergencyContact->nickname) }}">

                                    @if ($errors->has('emergency_nickname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emergency_nickname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="emergency_age">อายุ </label>
                                    <input id="emergency_age" type="number"
                                           class="form-control{{ $errors->has('emergency_age') ? ' is-invalid' : '' }}"
                                           name="emergency_age"
                                           value="{{ old('emergency_age', $user->emergencyContact->age) }}">

                                    @if ($errors->has('emergency_age'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emergency_age') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="emergency_relationship" class="required">ความสัมพันธ์ </label>
                                    <input id="emergency_relationship" type="text"
                                           class="form-control{{ $errors->has('emergency_relationship') ? ' is-invalid' : '' }}"
                                           name="emergency_relationship"
                                           value="{{ old('emergency_relationship', $user->emergencyContact->relationship) }}" required>

                                    @if ($errors->has('emergency_relationship'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emergency_relationship') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="emergency_mobile_number" class="required">เบอร์โทรศัพท์มือถือ </label>
                                    <input id="emergency_mobile_number" type="text"
                                           class="form-control{{ $errors->has('emergency_mobile_number') ? ' is-invalid' : '' }}"
                                           name="emergency_mobile_number"
                                           value="{{ old('emergency_mobile_number', $user->emergencyContact->mobile_number) }}" required>
                                    <div class="help-block form-text text-muted form-control-feedback">
                                        เบอร์โทรศัพท์มือถือ 10 หลัก ไม่ต้องมีเคลื่องหมายหรือเว้นวรรค
                                    </div>

                                    @if ($errors->has('emergency_mobile_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('emergency_mobile_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                @include('partials.forms.address', [
                                    'name' => 'emergency_address',
                                    'old' => [
                                        'province_id' => old('emergency_address_province_id', $user->emergencyContact->address->subDistrict->district->province->id),
                                        'district_id' => old('emergency_address_district_id', $user->emergencyContact->address->subDistrict->district->id),
                                        'sub_district_id' => old('emergency_address_sub_district_id', $user->emergencyContact->address->sub_district_id),
                                        'detail' => old('emergency_address_detail', $user->emergencyContact->address->detail)
                                    ]
                                ])
                            </fieldset>

                            <hr/>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </user-form>
@endsection