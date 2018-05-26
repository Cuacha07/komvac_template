<!-- Vue Components & Mixins -->
@include('components.vue.vuePagination')
@include('components.vue.vueHelperFunctions')
@include('components.vue.vueFormErrors')
@include('components.vue.vueNotifications')
@include('components.vue.vueImageUpload')
<!-- Vue Components & Mixins -->

<script>
//Laravel's Token
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

var app = new Vue ({
    mounted: function () {
        this.getCorreoContacto();
        this.getMantenimiento();
        this.getBackground();
        this.getTema();
    },

    el: "#app",

    mixins: [helperFunctions, notifications],

    data: {
        saveInAction: false,

        // Correo de Contacto
        correo_destinatario: '',
        loadingConctaco: false,
        erroresCorreo: null,

        // Modo Mantenimiento
        modo_mantenimiento: '',
        loadingMantenimiento: false,

        // Background Image
        background_image: '',
        loadingBackground: false,

        // Temas del CMS
        tema: { template_skin: '', template_layout_options: '' },
        loadingTema: false
        
    },

    methods: {
        getCorreoContacto: function () {
            this.loadingConctaco = true;
            var resource = this.$resource("{{route('admin.configuraciones.get_contacto')}}");
            resource.get({}).then(function (response) {
                this.correo_destinatario = response.data;
                this.loadingConctaco = false;
            });
        },

        setCorreoContacto: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingConctaco = true;
            this.erroresCorreo = null;

            var form = new FormData();
            form.append('correo', this.correo_destinatario);

            var resource = this.$resource("{{route('admin.configuraciones.set_contacto')}}");
            resource.save(form).then(function (response) {
                this.loadingConctaco = false;
                this.saveInAction = false;
                this.erroresCorreo = null;
                this.notification('fa fa-check-circle', 'OK!', 'Correo Actualizado!', 'topCenter');
            }, function (response) {
                this.loadingConctaco = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
                this.erroresCorreo = response.data;
            });
        },

        getMantenimiento: function () {
            this.loadingMantenimiento = true;
            var resource = this.$resource("{{route('admin.configuraciones.get_mantenimiento')}}");
            resource.get({}).then(function (response) {
                this.modo_mantenimiento = response.data;
                this.loadingMantenimiento = false;
            });
        },

        setMantenimiento: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingMantenimiento = true;

            var form = new FormData();
            form.append('mantenimiento', this.modo_mantenimiento);

            var resource = this.$resource("{{route('admin.configuraciones.set_mantenimiento')}}");
            resource.save(form).then(function (response) {
                this.loadingMantenimiento = false;
                this.saveInAction = false;
                this.notification('fa fa-check-circle', 'OK!', 'Modo Mantenimiento Actualizado!', 'topCenter');
                bus.$emit('modo-mantenimiento', this.modo_mantenimiento);
            }, function (response) {
                this.loadingMantenimiento = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
            });
        },

        getBackground: function () {
            this.loadingBackground = true;
            var resource = this.$resource("{{route('admin.configuraciones.get_backgroundlogin')}}");
            resource.get({}).then(function (response) {
                this.background_image = response.data;
                this.loadingBackground = false;
            });
        },

        setBackground: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingBackground = true;

            var form = new FormData();
            form.append('background', this.background_image);

            var resource = this.$resource("{{route('admin.configuraciones.set_backgroundlogin')}}");
            resource.save(form).then(function (response) {
                this.loadingBackground = false;
                this.saveInAction = false;
                this.notification('fa fa-check-circle', 'OK!', 'Fondo del Login Actualizado!', 'topCenter');
            }, function (response) {
                this.loadingBackground = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
            });
        },

        getTema: function () {
            this.loadingTema = true;
            var resource = this.$resource("{{route('admin.configuraciones.get_tema')}}");
            resource.get({}).then(function (response) {
                this.tema.template_skin = response.data.template_skin;
                this.tema.template_layout_options = response.data.template_layout_options;
                this.loadingTema = false;
            });
        },

        setTema: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingTema = true;

            var form = new FormData();
            form.append('template_skin', this.tema.template_skin);
            form.append('template_layout_options', this.tema.template_layout_options);

            var resource = this.$resource("{{route('admin.configuraciones.set_tema')}}");
            resource.save(form).then(function (response) {
                this.loadingTema = false;
                this.saveInAction = false;
                this.notification('fa fa-check-circle', 'OK!', 'Tema Actualizado!', 'topCenter');
            }, function (response) {
                this.loadingTema = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
            });
        }
    }
});
</script>