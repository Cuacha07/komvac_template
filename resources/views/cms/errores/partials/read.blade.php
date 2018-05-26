<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"> Error Completo</h3>
        <div class="box-tools pull-right">
            <a class="btn bg-navy btn-sm" @click="closeRead"><i class="fa fa-chevron-left"></i> @lang('cms.back')</a>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">

        {{--
        "context" => "local"
        "level" => "error"
        "level_class" => "danger"
        "level_img" => "exclamation-triangle"
        "date" => "2018-05-10 10:08:29"
        "text" => "ErrorException: Accessing static property App\Http\Controllers\TestsController::$log_levels as non static"
        "in_file" => " in /var/www/metropolimxV2/app/Http/Controllers/TestsController.php:104",
        "stack": ....
        --}}

        <div class="table-responsive"> 
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr><td class="chido">context</td><td>@{{error.context}}</td></tr>
                    <tr><td class="chido">level</td><td>@{{error.level}}</td></tr>
                    <tr><td class="chido">level_class</td><td>@{{error.level_class}}</td></tr>
                    <tr><td class="chido">level_img</td><td>@{{error.level_img}}</td></tr>
                    <tr><td class="chido">date</td><td>@{{error.date}}</td></tr>
                    <tr><td class="chido">text</td><td>@{{error.text}}</td></tr>
                    <tr><td class="chido">in_file</td><td>@{{error.in_file}}</td></tr>
                    <tr><td class="chido">archivo</td><td>@{{error.archivo}}</td></tr>
                    <tr><td class="chido">stack</td><td>@{{error.stack}}</td></tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
