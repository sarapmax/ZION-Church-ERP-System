<?php

function setGeolocationOldData(
    $region_id = null,
    $province_id = null,
    $district_id = null,
    $church_id = null,
    $sub_district_id = null,
    $cell_id = null
    ) {
    return [
        'region_id' => old('region_id', $region_id),
        'province_id' => old('province_id', $province_id),
        'district_id' => old('district_id', $district_id),
        'church_id' => old('church_id', $church_id),
        'sub_district_id' => old('region_id', $sub_district_id),
        'cell_id' => old('church_id', $cell_id),
    ];
}
