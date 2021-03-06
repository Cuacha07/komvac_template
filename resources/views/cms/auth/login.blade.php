@extends('cms.auth.master')

@section('content')
    <div class="login-box" id="appname" v-cloak>

        <transition name="fade">
        <div class="login-logo" v-show="appNameAnimate">
            <a href="#"><b>{{ config('cms.app_name') }}</b> CMS</a> 
        </div>
        </transition>

        <transition name="fade">
        <div class="login-box-body" v-show="appNameAnimate2">
            <p class="login-box-msg">{{ trans('cms.login_instructions') }}</p>

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


            {!! Form::open(['route' => 'admin.login', 'method' => 'post']) !!}
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> @lang('cms.remember_me')
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('cms.sign_in')</button>
                    </div><!-- /.col -->
                </div>
            {!! Form::close() !!}

            <a href="{{ route('admin.recover-password') }}">@lang('cms.i_forgot_my_password')</a><br>

        </div>
        </transition>

    </div>
@endsection

@push('scripts')
<script>
    var loginapp = new Vue({
        mounted: function () {
            window.onload = this.animateAppName();
        },
        el: '#appname',
        data: {
            appNameAnimate: false,
            appNameAnimate2: false
        },
        methods: {
            animateAppName: function () {
                this.appNameAnimate = true;
                this.appNameAnimate2 = true;
            }
        }
    });
</script>
@endpush