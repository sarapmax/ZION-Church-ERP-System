@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('createMember') }}
@endsection

@section('content')
<div class="header mt-3">
    <div class="header-body">
        <h1 class="header-title">เพิ่มข้อมูลสมาชิก</h1>
    </div>
</div>
<user-form inline-template :old-same-address="{{ json_encode(old('same_address')) }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('membership.member.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{--Church detail fields--}}
                        <fieldset>
                            <legend>
                                <span>ข้อมูลคริสตจักร</span>
                            </legend>

                            @include('components.selections.church-structure', [
                                'old' => [
                                    'province_id' => old('province_id'),
                                    'district_id' => old('district_id'),
                                    'church_id' => old('church_id'),
                                    'area_id' => old('area_id'),
                                    'cell_id' => old('cell_id'),
                                    'shepard_id' => old('shepard_id'),
                                ],
                                'excepts' => []
                            ])

                            <div class="form-group">
                                <label for="spiritual_status" class="required">สถานะผู้เชื่อ </label>
                                <select id="spiritual_status" class="form-control{{ $errors->has('spiritual_status') ? ' is-invalid' : '' }}" name="spiritual_status">
                                    <option value="">-- Select --</option>
                                    @foreach(SpiritualStatus::toArray() as $key => $value)
                                        <option value="{{ $value }}" @if(old('spiritual_status') == $value) selected @endif>{{ __('spiritual-status.' . $key) }}</option>
                                    @endforeach
                                </select>
                                <small class="help-block text-muted">
                                    หากไม่แน่ใจ กรุณาถามพี่เลี้ยงของท่าน
                                </small>

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
                                       value="{{ old('first_name') }}" required>

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
                                       value="{{ old('last_name') }}" required>

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
                                       value="{{ old('nickname') }}" required>

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
                                    <option value="male" @if(old('gender') == 'male') selected @endif>ชาย</option>
                                    <option value="female" @if(old('gender') == 'female') selected @endif>หญิง</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="profile_image">รูปโปรไฟล์ </label>
                                <input id="profile_image" type="file"
                                       class="form-control{{ $errors->has('profile_image') ? ' is-invalid' : '' }}"
                                       name="profile_image">

                                @if ($errors->has('profile_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="required">วันเกิด </label>
                                <input id="birthday"
                                       type="date"
                                       class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                       name="birthday"
                                       value="{{ old('birthday') }}"
                                       required>

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
                                       value="{{ old('idcard') }}" required>
                                <small class="help-block text-muted">
                                    เลขบัตรประจำตัวประชาชน 13 หลัก - ข้อมูลสำคัญ กรุณาตรวจสอบข้อมูลให้ถูกต้อง
                                </small>

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
                                       value="{{ old('race') }}" required>

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
                                       value="{{ old('nationality') }}" required>

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
                                       value="{{ old('email') }}">

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
                                       value="{{ old('mobile_number') }}" required>
                                <small class="help-block text-muted">
                                    เบอร์โทรศัพท์มือถือ 10 หลัก ไม่ต้องมีเคลื่องหมายหรือเว้นวรรค
                                </small>

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
                                       value="{{ old('facebook') }}">
                                <small class="help-block text-muted">
                                    กรุณากรอกเป็นชื่อ Facebook หรือ URL
                                </small>

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
                                       value="{{ old('line') }}">
                                <small class="help-block text-muted">
                                    กรุณากรอกเป็น Line ID
                                </small>

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

                            @include('partials.forms.address', [
                                'name' => 'original_address',
                                'old' => [
                                    'province_id' => old('original_address_province_id'),
                                    'district_id' => old('original_address_district_id'),
                                    'sub_district_id' => old('original_address_sub_district_id'),
                                    'detail' => old('original_address_detail')
                                ]
                            ])
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
                                @include('partials.forms.address', [
                                    'name' => 'current_address',
                                    'old' => [
                                        'province_id' => old('current_address_province_id'),
                                        'district_id' => old('current_address_district_id'),
                                        'sub_district_id' => old('current_address_sub_district_id'),
                                        'detail' => old('current_address_detail')
                                    ]
                                ])
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
                                    @foreach(MariageStatus::toArray() as $key => $value)
                                        <option value="{{ $value }}" @if(old('marital_status') == $value) selected @endif>{{ __('mariage-status.' . $key) }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('marital_status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('marital_status') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="spoouse_name">ชื่อ - สกุล คู่สมรส </label>
                                <input id="spoouse_name" type="text"
                                       class="form-control{{ $errors->has('spoouse_name') ? ' is-invalid' : '' }}"
                                       name="spoouse_name"
                                       value="{{ old('spoouse_name') }}">

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
                                       value="{{ old('spouse_nickname') }}">

                                @if ($errors->has('spouse_nickname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('spouse_nickname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="spouse_birthday">วันเกิดคู่สมรถ </label>
                                <input id="spouse_birthday"
                                       type="date"
                                       class="form-control{{ $errors->has('spouse_birthday') ? ' is-invalid' : '' }}"
                                       name="spouse_birthday"
                                       value="{{ old('spouse_birthday') }}">

                                @if ($errors->has('spouse_birthday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('spouse_birthday') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-check-label">
                                    <input type="checkbox" name="spouse_christian" value="yes" @if(old('spouse_christian')) checked @endif> เป็นคริสเตียน
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
                                <label for="emergency_name" class="required">ชื่อ - สกุล </label>
                                <input id="emergency_name" type="text"
                                       class="form-control{{ $errors->has('emergency_name') ? ' is-invalid' : '' }}"
                                       name="emergency_name"
                                       value="{{ old('emergency_name') }}" required>

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
                                       value="{{ old('emergency_nickname') }}">

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
                                       value="{{ old('emergency_age') }}">

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
                                       value="{{ old('emergency_relationship') }}" required>

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
                                       value="{{ old('emergency_mobile_number') }}" required>
                                <small class="help-block text-muted">
                                    เบอร์โทรศัพท์มือถือ 10 หลัก ไม่ต้องมีเคลื่องหมายหรือเว้นวรรค
                                </small>

                                @if ($errors->has('emergency_mobile_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('emergency_mobile_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @include('partials.forms.address', [
                                'name' => 'emergency_address',
                                'old' => [
                                    'province_id' => old('emergency_address_province_id'),
                                    'district_id' => old('emergency_address_district_id'),
                                    'sub_district_id' => old('emergency_address_sub_district_id'),
                                    'detail' => old('emergency_address_detail')
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
