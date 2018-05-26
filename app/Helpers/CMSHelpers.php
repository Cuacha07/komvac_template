<?php

namespace App\Helpers;

use Carbon\Carbon;
use Route;
use Lang;
use App\CMSUser;
use App\Models\CMS\CMSConfiguration;

class CMSHelpers {

    // Helper para Cambiar el skin del CMS (Sin Uso)
    public static function cms_body_class()
    {
        $configuration = CMSConfiguration::first();
        
        // Skin
        $class = 'skin-' . $configuration->template_skin;

        // layout options
        $class .= ' ' . $configuration->template_layout_options;
        
        return $class;
    }

    public static function getConfigurationData()
    {
        return CMSConfiguration::first();
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
        $fecha = Carbon::now()->formatLocalized('%A %d %B %Y');
        $hora  = Carbon::now()->toTimeString();
        return ucfirst($fecha) ." ". $hora;
    }

    public static function getUserCount()
    {
        return CMSUser::all()->count();
    }

    public static function shortDate($date)
    {
        setlocale(LC_TIME, config('app.locale'));
        $fecha = Carbon::createFromFormat('Y-m-d', substr($date, 0, 10))->formatLocalized('%d %B %Y');
        return ucfirst($fecha);
    }

    public static function getWeekDates()
    {
        $startOfWeek = Carbon::today()->startOfWeek();
        $endOfWeek = Carbon::today()->endOfWeek();

        $start_day = $startOfWeek->day;
        $start_month = $startOfWeek->month;

        $end_day = $endOfWeek->day;
        $end_month = $endOfWeek->month;

        $month_español = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        return $month_español[$start_month - 1]." ".$start_day." - ".$month_español[$end_month - 1]." ".$end_day;
    }

}
?>


