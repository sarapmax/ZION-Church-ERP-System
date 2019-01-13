<script>
    export default {
        props: ['old'],

        data() {
            return {
                regions: null,
                provinces: null,
                districts: null,
                churches: null,

                region_id: null,
                province_id: null,
                district_id: null,
                church_id: null
            }
        },

        methods: {
            getRegions() {
                return axios.get('/regions').then(({data}) => {
                    this.regions = data
                })
            },

            getProvinces() {
                if (this.region_id) {
                    return axios.get(`/provinces/${this.region_id}/districts`).then(({data}) => {
                        this.provinces = data

                        this.province_id = null
                        this.district_id = null
                        this.church_id = null
                    })
                }

                this.provinces = null
                this.districts = null
                this.churches = null
                this.province_id = null
                this.district_id = null
                this.church_id = null
            },

            getDistricts() {
                if (this.province_id) {
                    return axios.get(`/districts/${this.province_id}/sub-districts`).then(({data}) => {
                        this.districts = data

                        this.district_id = null
                        this.church_id = null
                    })
                }

                this.districts = null
                this.district_id = null
                this.churches = null
                this.church_id = null
            },

            getChurches() {
                if (this.district_id) {
                    return axios.get(`/churches/${this.district_id}/cells`).then(({data}) => {
                        this.churches = data

                        this.church_id = null
                    })
                }

                this.churches = null
                this.church_id = null
            }
        },

        created() {
            this.getRegions()

            this.region_id = this.old.region_id

            this.getProvinces().then(() => {
                this.province_id = this.old.province_id

                this.getDistricts().then(() => {
                    this.district_id = this.old.district_id

                    this.getChurches().then(() => {
                        this.church_id = this.old.church_id
                    })
              })
            })

        }
    }
</script>
