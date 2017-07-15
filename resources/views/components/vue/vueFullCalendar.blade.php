@push('css')
{!! Html::style('plugins/fullcalendar/fullcalendar.min.css') !!}
@endpush

{{-- FullCalendar JS Require: jquery.js, moment.js --}}
{!! Html::script('plugins/fullcalendar/moment.min.js') !!}
{!! Html::script('plugins/fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('plugins/fullcalendar/locale/es.js') !!}

<script>

Vue.component('fullcalendar', {
    props: ['events'],
    template: `<div ref='fullcalendar'></div>`,
    mounted: function () {
        var vm = this;

        $(vm.$refs.fullcalendar).fullCalendar({
            header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
            //locale: 'es',
            editable: true,
            eventLimit: true,
            droppable : true, // this allows things to be dropped onto the calendar !!!
            /*dayClick: function() {
                alert('a day has been clicked!');
                //vm.$emit('input', $(this).val());
            },*/

            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start           = date;
                copiedEventObject.allDay          = allDay;
                copiedEventObject.backgroundColor = $(this).css('background-color');
                copiedEventObject.borderColor     = $(this).css('border-color');

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" 
                //(http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $(vm.$refs.fullcalendar).fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

                //vm.$emit('input', $(this).val());
            }
        });

        //Add Vue inital Events to calendar
        $(vm.$refs.fullcalendar).fullCalendar('addEventSource', this.events)
    },
    watch: {
        events: function (value) {
            // update value
            var vm = this;
            $(vm.$refs.fullcalendar).fullCalendar('addEventSource', value)
        }
    }
});

</script>   