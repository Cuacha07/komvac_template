<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">

        {{-- User Panel --}}
        <div class="user-panel">
            <div class="pull-left image">
                {!! Html::image(Auth::guard('cms')->user()->avatar, "User Image", ['class' => 'img-circle']) !!}
            </div>
            <div class="pull-left info">
                <p>{{ Auth::guard('cms')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        {{-- Search Bar --}}
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{trans('cms.search_bar')}}">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        {{-- Module's Links --}}
        <ul class="sidebar-menu">
            <li class="header text-uppercase">@lang('cms.primary_menu_title')</li>
            {!! CMSHelpers::makeLinkForSidebarMenu('admin.users.index', trans('cms.users'), 'fa fa-users') !!}
            @include('cms.inc.items_menu_lateral')
        </ul>

    </section>
</aside>