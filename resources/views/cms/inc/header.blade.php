<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{ Config::get('cms.app_name') }}</b> CMS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ Config::get('cms.app_name') }}</b> CMS</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">@lang('cms.toggle-navigation')</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Messages -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                </li>

                <!-- Notifications -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        {!! Html::image(Auth::guard('cms')->user()->avatar, "User Image", ['class' => 'user-image']) !!}
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::guard('cms')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            {!! Html::image(Auth::guard('cms')->user()->avatar, "User Image", ['class' => 'img-circle']) !!}
                            <p>{{ Auth::guard('cms')->user()->name }} - {{ Auth::guard('cms')->user()->type }}</p>
                            <small>@lang('cms.user_since') {{ CMSHelpers::shortDate(Auth::guard('cms')->user()->created_at) }}</small>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('admin.users.update-my-password') }}" class="btn btn-default btn-block btn-flat">
                                <span class="fa fa-lock"></span> @lang('cms.update_my_password')
                            </a>
                            <a href="{{ route('admin.logout') }}" class="btn btn-default btn-block btn-flat">
                                <span class="fa fa-sign-out"></span> @lang('cms.logout')
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>

        </div>
    </nav>
</header>