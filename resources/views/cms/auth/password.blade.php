@extends('cms.auth.master')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>{{ config('cms.app_name') }}</b> CMS</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('cms.i_forgot_my_password') }}</p>

            {{-- Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <h4><i class="icon fa fa-ban"></i> @lang('cms.errors_title')</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- Errors --}}

            @if(Session::has('status'))
                <div class="alert alert-success" role="alert">
                    <p>@lang('cms.pass_reset_email_send')</p>
                </div>
            @endif

            {!! Form::open(['route' => 'admin.recover-password', 'method' => 'post']) !!}
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('cms.reset')</button>
                    </div><!-- /.col -->
                </div>
            {!! Form::close() !!}
            
            <a href="{{ route('admin.login') }}">@lang('cms.back_to_login')</a><br>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection