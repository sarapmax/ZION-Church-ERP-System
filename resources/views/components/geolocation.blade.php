<geolocation inline-template :old="{{ json_encode($old) }}">
    <div>
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
                    v-model="church_id"
                    @change="getCells()">
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

        @if(!in_array("cell", $excepts))
            <div class="form-group">
                <label for="cell_id">กลุ่มแคร์ </label>
                <select id="cell_id"
                        class="form-control{{ $errors->has('cell_id') ? ' is-invalid' : '' }}"
                        name="cell_id"
                        v-model="cell_id">
                <option :value="null">-- Select --</option>
                <option v-for="cell in cells" :value="cell.id" v-text="cell.name"></option>
                </select>

                @if ($errors->has('cell_id'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cell_id') }}</strong>
                </span>
                @endif
            </div>
        @endif
    </div>
</geolocation>
