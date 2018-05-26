{{-- Mixins --}}
@include('components.vue.vueNotifications')
@include('components.vue.vueHelperFunctions')

{{-- Components --}}
@include('components.vue.vueFormErrors')
@include('components.vue.vueImageUpload')
@include('components.vue.vuePagination')
@include('components.vue.vueFilterSearch')
@include('components.vue.vueProgress')

<script>
//Laravel's Token
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

var app = new Vue ({

    mounted: function () {
        this.getData(this.dataRoute);
    },

    el: '#app',

    mixins: [helperFunctions, notifications],

    data: {
        users: null,
        user: { id: '', name: '', avatar: '', email: '', password: '', password_confirmation: '', 
                type: 'suadmin', blocket_at: '', created_at: ''},
        loading: false,
        loadingSave: false,
        loadingPassword: false,
        saveInAction: false,
        public_url: "{{ URL::to('/') }}/",
        pagination: null,
        saveButton: false,
        updateButton: false,
        userTypes: [
            {text:'Super Admin', value:'suadmin'},
            {text:'Admin', value:'admin'},
            {text:'Editor', value:'editor'}
        ],
        uploadProgress: null,

        //Panels
        panelIndex: true,
        panelInputs: false,

        //Routes
        dataRoute: "{{route('admin.users.get')}}",

        //Filter
        busqueda: '',
        tipo: 'name',
        tipos:[
            {text: '@lang("cms.name")', value:'name'},
            {text: '@lang("cms.email")', value:'email'},
            {text: '@lang("cms.type")', value:'type'},
            {text: '@lang("cms.user_since")', value:'created_at'}
        ],

        //Formulario errores
        errores: null
    },

    methods:{
        getData: function (url) {
            this.loading = true;
            var filter = { busqueda: this.busqueda, tipo: this.tipo };
            var resource = this.$resource(url);
            resource.get(filter).then(function (response) {
                this.pagination = response.data;
                this.users = response.data.data;
                this.loading = false;
            });
        },

        updateFilters: function (data) {
            this.busqueda = data.busqueda;
            this.tipo = data.tipo;
            this.getData(this.dataRoute);
        },

        openPanelInputs: function() {
            this.saveButton = true;
            this.panelIndex = false;
            this.panelInputs = true;
        },

        closePanelInputs: function () {
            this.user = { id: '', name: '', avatar: '', email: '', password: '', 
            password_confirmation: '', type: 'suadmin', blocket_at: '', created_at: ''};
            this.cleanErrors();
            this.panelInputs = false;
            this.panelIndex = true;
            this.saveButton = false;
            this.updateButton = false;
        },

        setData: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingSave = true;

            var form = new FormData();
            form.append('name', this.user.name);
            if(this.user.avatar != '') { form.append('avatar', this.user.avatar); }
            form.append('email', this.user.email);
            form.append('password', this.user.password);
            form.append('password_confirmation', this.user.password_confirmation);
            form.append('type', this.user.type);

            //Upload Progress Bar
            const progress = (e) => {
                if (e.lengthComputable) {
                    this.uploadProgress = Math.floor(e.loaded  / e.total * 100);
                }
            }

            var resource = this.$resource("{{route('admin.users.set')}}", {}, {}, { progress: progress });
            resource.save(form).then(function (response) {
                this.loadingSave = false;
                this.saveInAction = false;
                this.notification('fa fa-check-circle', 'OK!', "{{trans('cms.msg_user_created')}}", 'topCenter');
                this.cleanErrors();
                this.closePanelInputs();
                this.getData(this.dataRoute);
                this.uploadProgress = null;
            }, function (response) {
                this.loadingSave = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
                this.errores = response.data;
                this.uploadProgress = null;
            });
        },

        openUpdateInputPanel: function (idUser) {

            var index = this.findIndexByKeyValue(this.users, 'id', idUser);

            this.user = {
                id: this.users[index].id,
                name: this.users[index].name,
                email: this.users[index].email,
                type: this.users[index].type,
                avatar: this.users[index].avatar
            }

            this.updateButton = true;
            this.panelIndex = false;
            this.panelInputs = true;
        },

        updateData: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingSave = true;

            var form = new FormData();
            form.append('id', this.user.id);
            form.append('name', this.user.name);

            //Is File ?? o String ??
            if(this.user.avatar != '') {
                if(Object.prototype.toString.call(this.user.avatar) === '[object File]' ) {
                    form.append('avatar', this.user.avatar);
                }
            }

            form.append('email', this.user.email);
            form.append('type', this.user.type);

            //Upload Progress Bar
            const progress = (e) => {
                if (e.lengthComputable) {
                    this.uploadProgress = Math.floor(e.loaded  / e.total * 100);
                }
            }

            var resource = this.$resource("{{route('admin.users.update')}}", {}, {}, { progress: progress });
            resource.save(form).then(function (response) { 
                this.loadingSave = false;
                this.saveInAction = false;
                this.notification('fa fa-check-circle', 'OK!', "{{trans('cms.msg_user_updated')}}", 'topCenter');
                this.cleanErrors();
                this.closePanelInputs();
                this.getData(this.dataRoute);
                this.uploadProgress = null;
            }, function (response) {
                this.loadingSave = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
                this.errores = response.data;
                this.uploadProgress = null;
            });
        },

        updatePassword: function () {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loadingPassword = true;

            var form = new FormData();
            form.append('id', this.user.id);
            form.append('password', this.user.password);
            form.append('password_confirmation', this.user.password_confirmation);

            var resource = this.$resource("{{route('admin.users.password')}}");
            resource.save(form).then(function (response) { 
                this.loadingPassword = false;
                this.saveInAction = false;
                this.notification('fa fa-check-circle', 'OK!', "{{trans('cms.msg_password_updated')}}", 'topCenter');
                this.cleanErrors();
                this.user.password = ''; this.user.password_confirmation = '';
            }, function (response) {
                this.loadingPassword = false;
                this.saveInAction = false;
                this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.server_error')}}", 'topCenter');
                this.errores = response.data;
            });
        },

        deleteUser: function (idUser) {
            swal({
                title: '{{trans("cms.are_you_sure")}}',
                text: '{{trans("cms.wont_revert_this")}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{trans("cms.yes_delete_it")}}',
                cancelButtonText: '{{trans("cms.cancel")}}'
                }).then(function () {
                    var resource = this.$resource("{{route('admin.users.delete')}}");
                    resource.get({id:idUser}).then(function (response) {
                        
                        if(response.data == "Error you are the same.") {
                            this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.msg_you_cant_delete_yourself')}}", 'topCenter');
                        } else {
                            this.notification('fa fa-check-circle', 'OK!', "{{trans('cms.msg_user_deleted')}}", 'topCenter');
                            this.getData(this.dataRoute);
                        }

                    });
            }.bind(this)).catch(swal.noop);
        },

        blockUser: function (idUser, isBlocked) {
            if(this.saveInAction == true) { return; }
            this.saveInAction = true;
            this.loading = true;
            var resource = this.$resource("{{route('admin.users.block')}}");
            resource.get({id:idUser}).then(function (response) {
                this.saveInAction = false;

                if(response.data == "Error you are the same.") {
                    this.notification('fa fa-exclamation-triangle', 'Error', "{{trans('cms.msg_you_cant_block_yourself')}}", 'topCenter');
                } else {
                    if(isBlocked) {
                        this.notification('fa fa-check-circle', 'OK!', "{{trans('cms.msg_user_blocked')}}", 'topCenter');
                    } else {
                        this.notification('fa fa-check-circle', 'OK!', "{{trans('cms.msg_user_unblocked')}}", 'topCenter');
                    }
                    this.getData(this.dataRoute);
                }

                this.cleanErrors();
                this.loading = false;
            });
        },

        cleanErrors: function () {
            this.errores = null;
        }
    }
});
</script>