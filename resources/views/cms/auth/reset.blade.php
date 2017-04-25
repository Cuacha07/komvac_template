@extends('cms.auth.master')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#">{{ config('cms.app_name') }}</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('cms.recover-password') }}</p>

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

            {!! Form::open(['route' => 'admin.reset-password', 'method' => 'post']) !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('cms.reset_password')</button>
                    </div><!-- /.col -->
                </div>
            {!! Form::close() !!}

            <a href="{{ route('admin.login') }}">@lang('cms.back_to_login')</a><br>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection