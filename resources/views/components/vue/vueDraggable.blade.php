@push('css')
{!! Html::style('plugins/jquery-ui/jquery-ui.min.css') !!}
@endpush

{{-- Bootstrap Datepicker --}}
{!! Html::script('plugins/jquery-ui/jquery-ui.min.js') !!}

<script>
Vue.component('draggable', {
    props: ['text', 'classes'],
    template: `<div ref="dragEvent" :class="classes" v-html="text"></div>`,
    mounted: function () {
        var vm = this;

        var eventObject = {
          title: vm.text // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(vm.$refs.dragEvent).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(vm.$refs.dragEvent).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });
    }
});
</script>   