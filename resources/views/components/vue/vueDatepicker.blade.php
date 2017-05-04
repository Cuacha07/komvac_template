@push('css')
{!! Html::style('css/datepicker/bootstrap-datepicker3.css') !!}
@endpush

{{-- Bootstrap Datepicker --}}
{!! Html::script('js/bootstrap-datepicker.min.js') !!}
{!! Html::script('js/bootstrap-datepicker.es.min.js') !!}

<script>

Vue.component('datepicker', {
    props: ['value'],
    template: `<input ref='input' type="text" class="form-control pull-right">`,
    mounted: function () {
        var vm = this;

        $(this.$refs.input).datepicker({
            todayBtn: true,
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            language: 'es'
        }).on('change', function (ev, args) {
            if (!(args && "ignore" in args)) {
                vm.$emit('input', $(this).val());
            }
        });
        
        Vue.nextTick(() => {
            $(this.$refs.input).val(this.value).trigger('change', { ignore: true });
        });
    },
    watch: {
        value: function (value, oldValue) {
            // update value
            $(this.$refs.input).val(this.value).trigger('change', { ignore: true });
        }
    }
});

</script>   