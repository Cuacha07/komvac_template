<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('cms.app_name') }} CMS</title>
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    @php
        $configuration = CMSHelpers::getConfigurationData();

        // Skin & layout options
        $class = 'skin-'.$configuration->template_skin.' '.$configuration->template_layout_options;
    @endphp

    {{-- CSS & Stuff --}}
    @include('cms.inc.header_common')

</head>
<body class="{{$class}}">
    <div class="wrapper">

        {{-- Header --}}
        @include('cms.inc.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('cms.inc.main_sidebar_menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div><!-- /.content-wrapper -->

        {{-- Footer --}}
        @include('cms.inc.footer')

    </div><!-- ./wrapper -->

    {{-- JS & Stuff --}}
    @include('cms.inc.footer_common')

</body>
</html>
