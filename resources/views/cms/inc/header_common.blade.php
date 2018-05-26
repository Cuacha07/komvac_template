<!-- CSS Resources -->
<!-- Bootstrap 3.3.7 -->
{!! Html::style('plugins/bootstrap/css/bootstrap.min.css') !!}

<!-- Font Awesome 4 -->
{!! Html::style('plugins/font-awesome/css/font-awesome.min.css') !!}

<!-- AdminLTE CSS -->
{!! Html::style('plugins/adminLte/AdminLTE.min.css') !!}
{!! Html::style('plugins/adminLte/skins/skin-'.$configuration->template_skin.'.min.css') !!}

<!-- SweetAlert2 -->
{!! Html::style('plugins/sweetalert2/sweetalert2.min.css') !!}

<!-- Own CMS Style -->
{!! Html::style('css/cms.css') !!}

{{-- Stack for CSS --}}
@stack('css')