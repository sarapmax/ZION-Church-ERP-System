@include('components.selection.geolocation', [
    'name' => [
        'province_id' => $name . '_province_id',
        'district_id' => $name . '_district_id',
        'sub_district_id' => $name . '_sub_district_id',
        'postcode' => $name . '_postcode'
    ],
    'old' => [
        'province_id' => old($name . '_province_id'),
        'district_id' => old($name . '_district_id'),
        'sub_district_id' => old($name . '_sub_district_id'),
    ],
    'excepts' => []
])

<div class="form-group">
    <label for="{{ $name }}_detail" class="required">รายละเอียดที่อยู่ </label>
    <textarea id="{{ $name }}_detail"
              class="form-control{{ $errors->has($name . '_detail') ? ' is-invalid' : '' }}"
              name="{{ $name }}_detail"
              rows="4"
              placeholder="120/52-53 ซอยบางศรีเมือง 6/7 หมู่บ้านธนภัทร 5">{{ old($name . '_detail') }}</textarea>

    @if ($errors->has($name . '_detail'))
        <span class="invalid-feedback" role="alert">
           <strong>{{ $errors->first($name . '_detail') }}</strong>
       </span>
    @endif
</div>
