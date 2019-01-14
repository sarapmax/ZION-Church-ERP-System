<script>
    export default {
        props: ['old', 'name', 'errors'],

        data() {
            return {
                provinces: null,
                districts: null,
                churches: null,
                cells: null,
                subDistricts: null,

                province_id: null,
                district_id: null,
                church_id: null,
                cell_id: null,
                sub_district_id: null,
                postcode: null,

                inputName: {
                    provinceId: null,
                    districtId: null,
                    subDistrictId: null,
                    postcode: null
                },

                error: {
                    province: null,
                    pistrict: null,
                    subDistrict: null,
                    postcode: null
                }
            }
        },

        methods: {
            getProvinces() {
                return axios.get('/provinces').then(({data}) => {
                    this.provinces = data
                })
            },

            getDistricts() {
                if (this.province_id) {
                    return axios.get(`/provinces/${this.province_id}/districts`).then(({data}) => {
                        this.districts = data

                        this.district_id = null
                        this.church_id = null
                        this.cell_id = null
                        this.sub_district_id = null
                        this.postcode = null
                    })
                }

                this.districts = null
                this.churches = null
                this.cells = null
                this.subDistricts = null

                this.district_id = null
                this.church_id = null
                this.cell_id = null
                this.sub_district_id = null
                this.postcode = null

            },

            getChurches() {
                if (this.district_id) {
                    return axios.get(`/districts/${this.district_id}/churches`).then(({data}) => {
                        this.churches = data

                        this.church_id = null
                        this.cell_id = null
                    })
                }

                this.churches = null
                this.church_id = null

                this.cells = null
                this.cell_id = null
            },

            getCells() {
                if (this.church_id) {
                    return axios.get(`/churches/${this.church_id}/cells`).then(({data}) => {
                        this.cells = data

                        this.cell_id = null
                    })
                }

                this.cells = null
                this.cell_id = null
            },

            getSubDistricts() {
                if (this.district_id) {
                    return axios.get(`/districts/${this.district_id}/sub-districts`).then(({data}) => {
                        this.subDistricts = data

                        this.sub_district_id = null
                        this.postcode = null
                    })
                }

                this.subDistricts = null
                this.sub_district_id = null

                this.postcode = null
            },

            getPostcode() {
                if (this.sub_district_id) {
                    return axios.get(`/sub-districts/${this.sub_district_id}/postcode`).then(({data}) => {
                        this.postcode = data.code
                    })
                }

                this.postcode = null
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

            this.setError()

            console.log(this.error)

            this.getProvinces()

            this.province_id = this.old.province_id

            this.getDistricts().then(() => {
                this.district_id = this.old.district_id

                this.getChurches().then(() => {
                    this.church_id = this.old.church_id

                    this.getCells().then(() => {
                        this.cell_id = this.old.cell_id
                    })
                })

                this.getSubDistricts().then(() => {
                    this.sub_district_id = this.old.sub_district_id

                    this.getPostcode()
                })
            })


        }
    }
</script>
