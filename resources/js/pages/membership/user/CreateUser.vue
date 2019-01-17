<script>
    export default {
        props: ['old'],

        data() {
            return {
                sameAddress: false
            }
        },

        created() {
            if(this.old.same_address) {
                this.sameAddress = true
            }
        }
    }
</script>
