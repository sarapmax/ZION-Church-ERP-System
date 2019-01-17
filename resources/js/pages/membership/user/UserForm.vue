<script>
    export default {
        props: ['oldSameAddress'],

        data() {
          return {
              sameAddress: false
          }
        },

        created() {
            if (this.oldSameAddress) {
                this.sameAddress = true
            }
        }
    }
</script>
