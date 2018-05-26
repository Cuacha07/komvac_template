<!-- Jquery 3.2.1 -->
{!! Html::script('plugins/jquery/jquery-3.2.1.min.js') !!}

<!-- Bootstrap 3.3.7 -->
{!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}

<!-- AdminLTE App.js -->
{!! Html::script('plugins/adminLte/app.min.js') !!}

<!-- SlimScroll -->
{!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}

<!-- SweetAlert2 -->
{!! Html::script('plugins/sweetalert2/sweetalert2.min.js') !!}

<!-- Vue 2 & Vue-Resource -->
{!! Html::script('plugins/vue/vue.js') !!}
{!! Html::script('plugins/vue-resource/vue-resource.min.js') !!}

{{-- Vue Bus Component --}}
<script>var bus = new Vue();</script>

<script>
    // Add slimscroll
$('.sidebar').slimScroll({
    height: ($(window).height() - $('.sidebar').height()) + 'px',
    color : 'rgba(0,0,0,0.2)',
    size  : '3px'
});
</script>

{{-- Stack Scripts --}}
@stack('scripts')