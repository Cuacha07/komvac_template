{{-- Requerimentos: vueModal, vueFilterSearch, vueHelperFunctions, vuePagination --}}
<script>
Vue.component('pacientemodal', {
    props: ['value'],
    template: `
    <div>
        <input type="text" class="form-control" v-model="paciente" @click="openModal" readonly v-show="!loadingInput">

        <div class="text-center"><i v-show="loadingInput" class="fa fa-spinner fa-spin fa-2x"></i></div>

        <modal v-if="modalPacientes" @close="modalPacientes = false">
            <div slot="head">Agregar Paciente</div>
            <div slot="body">
                
                <filtersearch :selected="tipo" :options="tipos" @updatefilters="updateFilters"></filtersearch>

                <div class="text-center"><i v-show="loadingPacientes" class="fa fa-spinner fa-spin fa-5x"></i></div>

                <div class="table-responsive" v-show="!loadingPacientes">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="paciente in pacientes">
                                <td><img :src="public_url+paciente.foto" class="img-rounded" style="width:32px; height:32px;"></td>
                                <td>@{{ paciente.nombre }}</td>
                                <td>@{{ paciente.apellidos }}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-info" @click="agregado(paciente.id, paciente.nombre, paciente.apellidos)">
                                    <i class="fa fa-plus-circle"></i> Agregar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <pagination @setpage="getData" :param="pagination"></pagination>
            </div>
        </modal>

    </div>
    `,
    data: function () {
        return {
            paciente: null,
            modalPacientes: false,
            pacientes: null,
            loadingPacientes: false,
            dataRoute: "{{route('admin.pacientes.get_modal')}}",
            public_url: "{{ URL::to('/') }}/",
            pagination: null,
            loadingInput: false,

            //Filter
            busqueda: '',
            tipo: 'nombre',
            tipos:[
                { text: 'Nombre', value:'nombre' },
                { text: 'Apellidos', value:'apellidos' }
            ],
        }
    },
    watch: {
        value: function (value, oldValue) {

            console.log("Value: "+ value+ " - oldValue: "+oldValue);

            if(value == '' || value == null) {
                this.paciente = '';
            } else {
                this.getPacienteData(value);
            }
        }
    },
    methods: {
        openModal: function () {
            this.modalPacientes = true;
            this.getData(this.dataRoute);
        },

        getData: function (url) {
            this.loadingPacientes = true;
            var filter = { busqueda: this.busqueda, tipo: this.tipo };
            var resource = this.$resource(url);
            resource.get(filter).then(function (response) {
                this.pagination = response.data;
                this.pacientes = response.data.data;
                this.loadingPacientes = false;
            });
        },

        updateFilters: function (data) {
            this.busqueda = data.busqueda;
            this.tipo = data.tipo;
            this.getData(this.dataRoute);
        },

        agregado: function (id, nombre, apellidos) {
            this.paciente = nombre + " " + apellidos;
            this.$emit('input', id);
            this.modalPacientes = false;
        },

        getPacienteData: function (idPaciente) {
            this.loadingInput = true;
            var resource = this.$resource("{{route('admin.pacientes.get_modal_id')}}");
            resource.get({ id: idPaciente }).then(function (response) {
                this.paciente = response.data.nombre + " " + response.data.apellidos;
                this.loadingInput = false;
            });
        }
    }
});
</script>   