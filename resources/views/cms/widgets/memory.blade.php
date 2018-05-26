<?php

    # Memory Limit equal or higher than 64M?
    $memory_limit = ini_get('memory_limit');
    if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
        if ($matches[2] == 'M') {
            $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
        } else if ($matches[2] == 'K') {
            $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
        }
    }

    $ok = ($memory_limit >= 640 * 1024 * 1024); // at least 64M?
                
    $mem = memory_get_usage(true);
    $disk_progress = round(($mem*100)/$memory_limit, 2);

?>

<div class="info-box bg-green">
    <span class="info-box-icon"><i class="fa fa-tachometer fa-1x"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Memoria Usada del Servidor</span>
        <span class="info-box-number"><b>{{formatBytes(memory_get_usage(true))}}</b>/{{formatBytes($memory_limit)}}</span>

        <div class="progress">
        <div class="progress-bar" style="width: {{$disk_progress}}%"></div>
        </div>
            <span class="progress-description">
            Current PHP reserved memory limit
            </span>
    </div>

</div>

	