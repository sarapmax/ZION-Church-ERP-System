<geolocation inline-template :old="{{ json_encode($old) }}" :name="{{ json_encode($name) }}" :errors="{{ $errors }}">
    <div>
        <div class="form-group">
            <label :for="inputName.provinceId" class="required">จังหวัด </label>
            <select :id="inputName.provinceId"
                    class="form-control"
                    :class="{ 'is-invalid': error.province }"
                    :name="inputName.provinceId"
                    v-model="province_id"
                    @change="getDistricts()">
                <option :value="null">-- Select --</option>
                <option v-for="province in provinces" :value="province.id" v-text="province.name"></option>
            </select>

            <span v-if="error.province" class="invalid-feedback" role="alert">
                <strong v-text="error.province"></strong>
            </span>
        </div>

        <div class="form-group">
            <label :for="inputName.districtId" class="required">อำเภอ/เขต </label>
            @if(!in_array("subDistrict", $excepts))
                <select :id="inputName.districtId"
                        class="form-control"
                        :class="{ 'is-invalid': error.district }"
                        :name="inputName.districtId"
                        v-model="district_id"
                @change="getSubDistricts()">
                <option :value="null">-- Select --</option>
                <option v-for="district in districts" :value="district.id" v-text="district.name"></option>
                </select>
            @else
                <select :id="inputName.districtId"
                        class="form-control"
                        :class="{ 'is-invalid': error.district }"
                        :name="inputName.districtId"
                        v-model="district_id"
                        @change="getChurches()">
                    <option :value="null">-- Select --</option>
                    <option v-for="district in districts" :value="district.id" v-text="district.name"></option>
                </select>
            @endif

            <span v-if="error.district" class="invalid-feedback" role="alert">
                <strong v-text="error.district"></strong>
            </span>
        </div>

        @if(!in_array("church", $excepts))
        <div class="form-group">
            <label for="church_id" class="required">คริสตจักร </label>
            <select id="church_id"
                    class="form-control{{ $errors->has('church_id') ? ' is-invalid' : '' }}"
                    :class="{ 'is-invalid': error.province }"
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
                <label for="cell_id" class="required">กลุ่มแคร์ </label>
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

        @if(!in_array("subDistrict", $excepts))
            <div class="form-group">
                <label :for="inputName.subDistrictId" class="required">ตำบล/แขวง </label>
                <select :id="inputName.subDistrictId"
                        class="form-control"
                        :class="{ 'is-invalid': error.subDistrict }"
                        :name="inputName.subDistrictId"
                        v-model="sub_district_id"
                        @change="getPostcode()">
                    <option :value="null">-- Select --</option>
                    <option v-for="subDistrict in subDistricts" :value="subDistrict.id" v-text="subDistrict.name"></option>
                </select>

                <span v-if="error.subDistrict" class="invalid-feedback" role="alert">
                    <strong v-text="error.subDistrict"></strong>
                </span>
            </div>

            <div class="form-group">
                <label :for="inputName.postcode" class="required">รหัสไปรษณีย์ </label>
                <input :id="inputName.postcode" type="text"
                       class="form-control"
                       :class="{ 'is-invalid': error.postcode }"
                       :name="inputName.postcode"
                       v-model="postcode">
                <div class="help-block form-text text-muted form-control-feedback">
                    รหัสไปรษณีย์ 5 หลัก
                </div>

                <span v-if="error.postcode" class="invalid-feedback" role="alert">
                    <strong v-text="error.postcode"></strong>
                </span>
            </div>
        @endif
    </div>
</geolocation>
