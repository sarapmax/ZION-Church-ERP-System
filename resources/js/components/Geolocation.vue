<script>
    export default {
        props: ['old'],

        data() {
            return {
                provinces: null,
                districts: null,
                churches: null,
                cells: null,

                province_id: null,
                district_id: null,
                church_id: null,
                cell_id: null,
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
                    return axios.get(`/districts/${this.province_id}/sub-districts`).then(({data}) => {
                        this.districts = data

                        this.district_id = null
                        this.church_id = null
                        this.cell = null
                    })
                }

                this.districts = null
                this.churches = null
                this.cells = null

                this.district_id = null
                this.church_id = null
                this.cell_id = null

            },

            getChurches() {
                if (this.district_id) {
                    return axios.get(`/churches/${this.district_id}/cells`).then(({data}) => {
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
                    return axios.get(`/cells/${this.church_id}`).then(({data}) => {
                        this.cells = data

                        console.log(this.cells)

                        this.cell_id = null
                    })
                }

                this.cells = null
                this.cell_id = null
            }
        },

        created() {
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
          })

        }
    }
</script>
