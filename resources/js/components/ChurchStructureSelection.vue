<script>
    export default {
        props: ['old'],

        data() {
            return {
                provinces: [],
                districts: [],
                churches: [],
                cells: [],

                provinceId: null,
                districtId: null,
                churchId: null,
                cellId: null
            }
        },

        methods: {
            getDistricts() {
                this.districts = null
                this.churches = null
                this.cells = null

                this.districtId = null
                this.churchId = null
                this.cellId = null

                if(this.provinceId) {
                    return axios.get(`/church-structure/provinces/${this.provinceId}/districts`).then(({data}) => {
                        this.districts = data
                    })
                }
            },

            getChurches() {
                this.churches = null
                this.cells = null

                this.churchId = null
                this.cellId = null

                if(this.districtId) {
                    return axios.get(`/church-structure/districts/${this.districtId}/churches`).then(({data}) => {
                        this.churches = data
                    })
                }
            },

            getCells() {
                this.cells = null
                this.cellId = null

                if (this.churchId)  {
                    return axios.get(`/church-structure/churches/${this.churchId}/cells`).then(({data}) => {
                        this.cells = data
                    })
                }
            }
        },

        created() {
            axios.get('/church-structure/provinces').then(({data}) => {
                this.provinces = data
            })

            this.provinceId = this.old.province_id

            this.getDistricts().then(() => {
                this.districtId = this.old.district_id

                this.getChurches().then(() => {
                    this.churchId = this.old.church_id

                    this.getCells().then(() => {
                        this.cellId = this.old.cell_id
                    })
                })
            })
        }
    }
</script>
