<geolocation inline-template :old="{{ json_encode($old) }}">
    <div>
        <div class="form-group">
            <label for="region_id">ภูมิภาค </label>
            <select id="region_id"
                    class="form-control{{ $errors->has('region_id') ? ' is-invalid' : '' }}"
                    name="region_id"
                    v-model="region_id"
                    @change="getProvinces()">
            <option :value="null">-- Select --</option>
            <option v-for="region in regions" :value="region.id" v-text="region.name"></option>
            </select>

            @if ($errors->has('region_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('region_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="province_id">จังหวัด </label>
            <select id="province_id"
                    class="form-control{{ $errors->has('province_id') ? ' is-invalid' : '' }}"
                    name="province_id"
                    v-model="province_id"
                    @change="getDistricts()">
                <option :value="null">-- Select --</option>
                <option v-for="province in provinces" :value="province.id" v-text="province.name"></option>
            </select>

            @if ($errors->has('province_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('province_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="district_id">อำเภอ </label>
            <select id="district_id"
                    class="form-control{{ $errors->has('district_id') ? ' is-invalid' : '' }}"
                    name="district_id"
                    v-model="district_id"
                    @change="getChurches()">
                <option :value="null">-- Select --</option>
                <option v-for="district in districts" :value="district.id" v-text="district.name"></option>
            </select>

            @if ($errors->has('district_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('district_id') }}</strong>
                </span>
            @endif
        </div>

        @if(!in_array("church", $excepts))
        <div class="form-group">
            <label for="church_id">คริสตจักร </label>
            <select id="church_id"
                    class="form-control{{ $errors->has('church_id') ? ' is-invalid' : '' }}"
                    name="church_id"
                    v-model="church_id">
                <option :value="null">-- Select --</option>
                <option v-for="church in churches" :value="church.id" v-text="church.name"></option>
            </select>

            @if ($errors->has('church_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('church_id') }}</strong>
                </span>
            @endif
        </div>
        @endif
    </div>
</geolocation>
