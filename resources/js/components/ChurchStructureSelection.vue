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
            getProvinces() {
                axios.get('/church-structure/provinces').then(({data}) => {
                    this.provinces = data
                })
            },

            getDistricts(provinceId) {
                this.districts = null
                this.churches = null
                this.cells = null

                this.districtId = null
                this.churchId = null
                this.cellId = null

                if (provinceId) {
                    this.provinceId = provinceId

                    axios.get(`/church-structure/provinces/${provinceId}/districts`).then(({data}) => {
                        this.districts = data
                    })
                }
            },

            getChurches(districtId) {
                this.churches = null
                this.cells = null

                this.churchId = null
                this.cellId = null

                if (districtId) {
                    this.districtId = districtId

                    axios.get(`/church-structure/districts/${districtId}/churches`).then(({data}) => {
                        this.churches = data
                    })
                }
            },

            getCells(churchId) {
                this.cells = null
                this.cellId = null

                if (churchId) {
                    this.churchId = churchId

                    axios.get(`/church-structure/churches/${churchId}/cells`).then(({data}) => {
                        this.cells = data
                    })
                }
            }
        },

        created() {
            axios.all([
                this.getProvinces(),
                this.getDistricts(this.old.province_id),
                this.getChurches(this.old.district_id),
                this.getCells(this.old.church_id),
            ]).then(() => {
                this.cellId = this.old.cell_id
            })
        }
    }
</script>
