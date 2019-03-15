<script>
    export default {
        props: ['old'],

        data() {
            return {
                provinces: [],
                districts: [],
                churches: [],
                areas: [],
                cells: [],

                provinceId: null,
                districtId: null,
                churchId: null,
                areaId: null,
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
                this.areas = null
                this.cells = null

                this.districtId = null
                this.churchId = null
                this.areaId = null
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
                this.areas = null
                this.cells = null

                this.churchId = null
                this.areaId = null
                this.cellId = null

                if (districtId) {
                    this.districtId = districtId

                    axios.get(`/church-structure/districts/${districtId}/churches`).then(({data}) => {
                        this.churches = data
                    })
                }
            },

            getAreas(churchId) {
                this.areas = null
                this.cells = null

                this.areaId = null
                this.cellId = null

                if (churchId) {
                    this.churchId = churchId

                    axios.get(`/church-structure/churches/${churchId}/areas`).then(({data}) => {
                        this.areas = data
                    })
                }
            },

            getCells(areaId) {
                this.cells = null
                this.cellId = null

                if (areaId) {
                    this.areaId = areaId

                    axios.get(`/church-structure/areas/${areaId}/cells`).then(({data}) => {
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
                this.getAreas(this.old.church_id),
                this.getCells(this.old.area_id),
            ]).then(() => {
                this.cellId = this.old.cell_id
            })
        }
    }
</script>
