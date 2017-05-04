@push('css')
<style>
.inputErrorStyle {
    outline: 'none';
    border-color: red;
    -webkit-box-shadow: 0px 0px 17px 0px rgba(255, 0, 0, 1);
    -moz-box-shadow:    0px 0px 17px 0px rgba(255, 0, 0, 1);
    box-shadow:         0px 0px 17px 0px rgba(255, 0, 0, 1);
}
</style>
@endpush

<script>
Vue.component('formerrors', {
    props: ['errors', 'errorsBag'],
    template: `
        <div class="alert alert-danger" v-if="errorsBag">
            <h4><i class="icon fa fa-ban"></i> @lang('CMS::core.errors_title')</h4>
            <ul><li v-for="msg in errorsBag">@{{ msg[0] }}</li></ul>
        </div>
    `,
    watch: {
        errorsBag: function () {
            if(this.errorsBag != null) {
                for (error in this.errors) {
                    if(this.errorsBag.hasOwnProperty(error)) {
                        this.errors[error] = true;
                    } else {
                        this.errors[error] = false;
                    }
                }
            }
        }
    }
});
</script>   