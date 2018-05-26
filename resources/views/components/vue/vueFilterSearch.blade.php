{{-- Requerimientos: Bootstrap 3, Vue.js 2, VueHelperFunctions.blade.php -> Lodash.js, Laravel 5.3 --}}

<script>
Vue.component('filtersearch', {
    props: ['selected', 'options'],
    template: `
    <div class="row">
        <div class="col-md-4">

            <div class="form-group">
                <label for="busqueda">Busqueda</label>
                <input label="Busqueda" name="busqueda" type="text" class="form-control" v-model="busqueda" placeholder="{{trans('cms.search_bar')}}">
            </div>

        </div>
        <div class="col-md-4">

            <label for="tipo">Por</label>                        
            <select id="tipo" name="tipo" class="form-control" v-model="tipo" @change="filterSearch_tipo">
                <option v-for="o in options" :value="o.value">@{{ o.text }}</option>
            </select>

        </div>
    </div>
    `,
    mounted: function () {
        this.tipo = this.selected;
    },
    data: function () {
        return {
            tipo: '',
            busqueda: ''
        }
    },
    watch: {
        busqueda: function () {
            this.filterSearch();
        }
    },
    methods: {
        //Filter Search
        filterSearch: _.debounce(function () {
            this.$emit("updatefilters", { busqueda: this.busqueda, tipo: this.tipo });
        }, 500),

        filterSearch_tipo: _.debounce(function () {
            if(this.busqueda == '') { return; }
            this.$emit("updatefilters", { busqueda: this.busqueda, tipo: this.tipo });
        }, 500)
    }
});
</script>