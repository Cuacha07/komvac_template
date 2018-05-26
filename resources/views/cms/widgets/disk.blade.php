<?php

    function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        //$bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    } 

    //Vars
    $ds = disk_total_space("/");
    $df = disk_free_space("/");

    $disk_progress = round(($df*100)/$ds, 2);

    //5896 -> 100%
    //2521 -> 42.75%

    $free_space = $ds - $df;
?>

<div class="info-box bg-red">
    <span class="info-box-icon"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Espacio en Disco</span>
        <span class="info-box-number"><b>{{formatBytes($free_space)}}</b>/{{formatBytes($df)}} {{--/{{formatBytes($ds)}}--}}</span>

        <div class="progress">
        <div class="progress-bar" style="width: {{100-$disk_progress}}%"></div>
        </div>
            <span class="progress-description">
            Espacio Usado / Espacio Disponible / Capacidad en el Disco
            </span>
    </div>

</div>

	