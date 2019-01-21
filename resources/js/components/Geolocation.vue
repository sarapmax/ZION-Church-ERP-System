<script>
    export default {
        props: ['old', 'name', 'errors'],

        data() {
            return {
                provinces: null,
                districts: null,
                subDistricts: null,

                provinceId: null,
                districtId: null,
                subDistrictId: null,
                postcode: null,

                inputName: {
                    provinceId: null,
                    districtId: null,
                    subDistrictId: null,
                    postcode: null
                },

                error: {
                    province: null,
                    district: null,
                    subDistrict: null,
                    postcode: null
                }
            }
        },

        methods: {
            getProvinces() {
                axios.get('/geolocation-data/provinces').then(({data}) => {
                    this.provinces = data
                })
            },

            getDistricts(provinceId) {
                this.districts = null
                this.subDistricts = null

                this.districtId = null
                this.subDistrictId = null
                this.postcode = null

                if (provinceId) {
                    this.provinceId = provinceId

                    return axios.get(`/geolocation-data/provinces/${provinceId}/districts`).then(({data}) => {
                        this.districts = data
                    })
                }
            },

            getSubDistricts(districtId) {
                this.subDistricts = null
                this.subDistrictId = null
                this.postcode = null

                if (districtId) {
                    this.districtId = districtId

                    return axios.get(`/geolocation-data/districts/${districtId}/sub-districts`).then(({data}) => {
                        this.subDistricts = data
                    })
                }
            },

            getPostcode(subDistrictId) {
                this.postcode = null

                if (subDistrictId) {
                    this.subDistrictId = subDistrictId

                    return axios.get(`/geolocation-data/sub-districts/${subDistrictId}/postcode`).then(({data}) => {
                        this.postcode = data.code
                    })
                }
            },

            setError() {
                $.each(this.errors, (key, value) => {
                    switch (key) {
                        case this.inputName.provinceId:
                            this.error.province = value[0]
                            break;
                        case this.inputName.districtId:
                            this.error.district = value[0]
                            break;
                        case this.inputName.subDistrictId:
                            this.error.subDistrict = value[0]
                            break;
                        case this.inputName.postcode:
                            this.error.postcode = value[0]
                            break;
                    }
                })
            }
        },

        created() {
            this.inputName.provinceId = this.name.province_id || 'province_id'
            this.inputName.districtId = this.name.district_id || 'district_id'
            this.inputName.subDistrictId = this.name.sub_district_id || 'sub_district_id'
            this.inputName.postcode = this.name.postcode

            axios.all([
                this.getProvinces(),
                this.getDistricts(this.old.province_id),
                this.getSubDistricts(this.old.district_id),
                this.getPostcode(this.old.sub_district_id),
            ])

            this.setError()
        }
    }
</script>
