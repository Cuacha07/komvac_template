<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('cms.app_name') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- CSS Resources -->
        <!-- Bootstrap 3.3.7 -->
        {!! Html::style('plugins/bootstrap/css/bootstrap.min.css') !!}

        <!-- Font Awesome 4 -->
        {!! Html::style('plugins/font-awesome/css/font-awesome.min.css') !!}

        <!-- AdminLTE CSS -->
        {!! Html::style('plugins/adminLte/AdminLTE.min.css') !!}
        {!! Html::style('plugins/adminLte/skins/skin-'.config('cms.template_skin').'.min.css') !!}

        <!-- ICheck CSS -->
        {!! Html::style('plugins/iCheck/square/blue.css') !!}

        {{-- Backgorund Image --}}
        @if(config('cms.login_background_url') != '')
        <style>
          .login-page, .register-page {
              background-image: url("{{ config('cms.login_background_url')}}");
          }
        </style>
        @endif

    </head>
    <body class="login-page">

        @yield('content')

        <!-- REQUIRED JS SCRIPTS -->
        <!-- Jquery 3.2.1 -->
        {!! Html::script('plugins/jquery/jquery-3.2.1.min.js') !!}

        <!-- Bootstrap 3.3.7 -->
        {!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}

        <!-- AdminLTE App.js -->
        {!! Html::script('plugins/adminLte/app.min.js') !!}

        <!-- ICheck JS -->
        {!! Html::script('plugins/iCheck/icheck.min.js') !!}

        <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
        </script>

    </body>
</html>