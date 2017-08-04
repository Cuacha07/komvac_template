@push('css')
{!! Html::style('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') !!}
@endpush

{{-- Bootstrap Datepicker --}}
{!! Html::script('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}
{!! Html::script('plugins/bootstrap-datepicker/bootstrap-datepicker.es.min.js') !!}

<script>

Vue.component('datepicker', {
    props: ['value'],
    template: `
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input ref='dateinput' type="text" class="form-control pull-right">
            <div class="input-group-addon" v-if="dateShow != ''">@{{dateText(dateShow)}}</div>
        </div>
    `,
    mounted: function () {
        var vm = this;

        $(this.$refs.dateinput).datepicker({
            todayBtn: true,
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            language: 'es'
        }).on('change', function (ev, args) {
            if (!(args && "ignore" in args)) {
                vm.$emit('input', $(this).val());
                vm.$emit('change', $(this).val());
            }
        });
        
        Vue.nextTick(() => {
            $(this.$refs.dateinput).val(this.value).trigger('change', { ignore: true });
        });

        this.dateShow = this.value;
    },
    data: function () {
        return {
            dateShow: '',
        }
    },
    watch: {
        value: function (value, oldValue) {
            // update value
            $(this.$refs.dateinput).val(this.value).trigger('change', { ignore: true });
            this.dateShow = value;
        }
    },
    methods: {
        dateText: function (fecha) {
            if(fecha == null){return "";}
            var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var diasSemana = new Array("Domingo", "Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
            var f = new Date(fecha.replace(/-/g,"/")); //Fix UTC "-" to Local "/"
            return diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
        }
    }
});

</script>   