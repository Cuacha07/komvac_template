{{-- dhtmlxCalendar CSS --}}
@push('css')
{!! Html::style('js/codebase/dhtmlxcalendar.css') !!}
@endpush

{{-- dhtmlxCalendar JS --}}
{!! Html::script('js/codebase/dhtmlxcalendar.js') !!}


<script>
//Es Language
dhtmlXCalendarObject.prototype.langData["es"] = {
    dateformat: "%d.%m.%Y",
    monthesFNames: [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ],
    monthesSNames: [
        "Ene", "Feb", "Mar", "Abr", "May", "Jun",
        "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
    ],
    daysFNames: [
        "Domingo", "Lunes", "Martes", "Miercoles",
        "Jueves", "Viernes", "Sabado"
    ],
    daysSNames: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    weekstart: 1,
    weekname: "s"
};

//Vue Component
Vue.component('calendar', {
    props: ['value'],
    template: `<div ref="calendario" style="position:relative;height:350px;"></div>`,
    data: function () {
        return {
            myCalendar: null
        }
    },
    mounted: function () {
        var vm = this;
        
        vm.myCalendar = new dhtmlXCalendarObject(vm.$refs.calendario);
        vm.myCalendar.setDate(new Date(this.value.replace(/-/g,"/")));
        vm.myCalendar.hideTime();
        vm.myCalendar.loadUserLanguage("es");
        //vm.myCalendar.disableDays("week", [7]);
        vm.myCalendar.show();

        vm.myCalendar.attachEvent("onClick", function(date) {
            ISOdate = date.toISOString().slice(0,10);
            vm.$emit('input', ISOdate); // Fire an event to let its parent know
            vm.$emit('change');
        });

    },
    watch: {
        value: function (value) {
            var vm = this;
            vm.myCalendar.setDate(new Date(value.replace(/-/g,"/"))); //Fix UTC "-" to Local "/"
        }
    },
    destroyed: function () {
        var vm = this;
        vm.myCalendar.unload();
    }
});
</script>