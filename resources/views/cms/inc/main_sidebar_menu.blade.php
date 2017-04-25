<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header text-uppercase">@lang('cms.primary_menu_title')</li>
            {!! CMSHelpers::makeLinkForSidebarMenu('users.index', trans('cms.users'), 'fa fa-users') !!}
            @include('cms.inc.items_menu_lateral')
        </ul>
    </section>
</aside>