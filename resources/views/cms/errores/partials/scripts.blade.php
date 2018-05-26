<!-- Vue Components & Mixins -->
@include('components.vue.vuePagination')
@include('components.vue.vueHelperFunctions')
@include('components.vue.vueNotifications')
<!-- Vue Components & Mixins -->

<script>
//Laravel's Token
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

var app = new Vue ({
    mounted: function () {
        this.getErrores();
    },

    el: "#app",

    mixins: [helperFunctions, notifications],

    data: {
        loading: false,
        errores: null,
        error: {
            'context': '',
            'level': '',
            'level_class': '',
            'level_img': '',
            'date': '',
            'text': '',
            'in_file': '',
            'archivo': '',
            'stack': ''
        },
        panelIndex: true,
        panelRead: false
    },

    methods: {
        getErrores: function () {
            this.loading = true;
            var resource = this.$resource("{{route('admin.errores.get')}}");
            resource.get({}).then(function (response) {
                this.errores = response.data;
                this.loading = false;
            });
        },

        openRead: function (index) {

            this.error = {
                'context': this.errores[index].context,
                'level': this.errores[index].level,
                'level_class': this.errores[index].level_class,
                'level_img': this.errores[index].level_img,
                'date': this.errores[index].date,
                'text': this.errores[index].text,
                'in_file': this.errores[index].in_file,
                'archivo': this.errores[index].archivo,
                'stack': this.errores[index].stack
            };

            this.panelIndex = false;
            this.panelRead = true;
        },

        closeRead: function () {
            this.error = {
                'context': '',
                'level': '',
                'level_class': '',
                'level_img': '',
                'date': '',
                'text': '',
                'in_file': '',
                'archivo': '',
                'stack': ''
            };
            this.panelIndex = true;
            this.panelRead = false;
        }
    }
});
</script>