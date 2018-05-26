@push('css')
<style>
.inputError {
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
    props: ['errorsbag'],
    template: `
        <div class="alert alert-danger" v-if="errors">
            <h4><i class="icon fa fa-ban"></i> {{trans('cms.errors_title')}}</h4>
            <ul style="text-transform:capitalize;"><li v-for="msg in errors">@{{ msg[0] }}</li></ul>
        </div>
    `,
    data: function () {
        return {
            errors: null,
        }
    },
    watch: {
        errorsbag: function () {
            if(this.errorsbag != null) {
                if(Object.prototype.toString.call(this.errorsbag) !== '[object String]' ) {
                    this.errors = this.errorsbag; //Server Errors Big Strings
                }
            } else { this.errors = this.errorsbag; }
        }
    }
});
</script>   