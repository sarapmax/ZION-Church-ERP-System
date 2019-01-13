<?php

function setGeolocationOldData(
    $province_id = null,
    $district_id = null,
    $church_id = null,
    $cell_id = null,
    $sub_district_id = null
    ) {
    return [
        'province_id' => old('province_id', $province_id),
        'district_id' => old('district_id', $district_id),
        'church_id' => old('church_id', $church_id),
        'cell_id' => old('church_id', $cell_id),
        'sub_district_id' => old('region_id', $sub_district_id),
    ];
}
