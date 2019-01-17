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
            getDistricts() {
                this.districts = null
                this.subDistricts = null

                this.districtId = null
                this.subDistrictId = null
                this.postcode = null

                if (this.provinceId) {
                    return axios.get(`/geolocation-data/provinces/${this.provinceId}/districts`).then(({data}) => {
                        this.districts = data
                    })
                }
            },

            getSubDistricts() {
                this.subDistricts = null
                this.subDistrictId = null
                this.postcode = null

                if (this.districtId) {
                    return axios.get(`/geolocation-data/districts/${this.districtId}/sub-districts`).then(({data}) => {
                        this.subDistricts = data
                    })
                }


            },

            getPostcode() {
                this.postcode = null

                if (this.subDistrictId) {
                    return axios.get(`/geolocation-data/sub-districts/${this.subDistrictId}/postcode`).then(({data}) => {
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

            axios.get('/geolocation-data/provinces').then(({data}) => {
                this.provinces = data
            })

            this.setError()

            this.provinceId = this.old.province_id

            this.getDistricts().then(() => {
                this.districtId = this.old.district_id

                this.getSubDistricts().then(() => {
                    this.subDistrictId = this.old.sub_district_id

                    this.getPostcode()
                })
            })
        }
    }
</script>
