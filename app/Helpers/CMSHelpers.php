<?php

namespace App\Helpers;

use Carbon\Carbon;
use Route;
use Lang;
use App\CMSUser;

class CMSHelpers {

    public static function cms_body_class()
    {
        // Skin
        $class = 'skin-' . config('cms.template_skin');

        // layout options
        $class .= ' ' . implode(' ', config('cms.template_layout_options'));
        return $class;
    }

    public static function getUserTypesList()
    {
        $user_types = config('cms.user_types');
        $result = [];

        foreach($user_types as $type)
        {
            if(Lang::has('cms.user_types.' . $type)) {
                $result[$type] = trans('cms.user_types.' . $type);
            } else {
                $result[$type] = ucwords($type);
            }
        }
        return $result;
    }

    public static function makeLinkForSidebarMenu($route_name, $text, $icon)
    {
        $current_route_name = Route::current()->getName();
        $class  = '';
        $prefix = explode('.', $current_route_name);
        array_pop($prefix);
        $prefix = implode('.', $prefix);

        if($route_name == $current_route_name or $prefix . '.index' == $route_name)
        {
            $class = 'active';
        }

        return view('cms.inc.link_sidebar_menu', compact ('route_name', 'text', 'icon', 'class'));
    }

    public static function getDate()
    {
        setlocale(LC_TIME, config('app.locale'));
        $fecha = utf8_encode(Carbon::now()->formatLocalized('%A %d %B %Y'));
        $hora  = Carbon::now()->toTimeString();
        return ucfirst($fecha) . $hora;
    }

    public static function getUserCount()
    {
        return CMSUser::all()->count();
    }
}
?>




