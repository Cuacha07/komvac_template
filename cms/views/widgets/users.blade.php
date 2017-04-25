<?php
use Nhitrort90\CMS\Modules\Users\User as Cms_User;
$cms_users_count = Cms_User::all()->count();
?>

<div class="info-box bg-blue">
    <span class="info-box-icon"><i class="fa fa-users fa-1x fa-fw"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Usuarios</span>
        <span class="info-box-number"><b>{{$cms_users_count}}</b> - CMS</span>
    </div>

</div>