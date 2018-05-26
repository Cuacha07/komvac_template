@extends('cms.master')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-bomb"></i> Bitácora de Errores de Laravel </h1>
    </section>

    <section class="content" id="app" v-cloak>

        <div class="box box-primary" v-if="panelIndex">
            <div class="box-body">

                <!-- VueLoading icon -->
                <div class="text-center"><i v-show="loading" class="fa fa-spinner fa-spin fa-5x"></i></div>

                {{--
                "context" => "local"
                "level" => "error"
                "level_class" => "danger"
                "level_img" => "exclamation-triangle"
                "date" => "2018-05-10 10:08:29"
                "text" => "ErrorException: Accessing static property App\Http\Controllers\TestsController::$log_levels as non static"
                "in_file" => " in /var/www/metropolimxV2/app/Http/Controllers/TestsController.php:104"
                --}}
                
                <div class="table-responsive"> 
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Contexto</th>
                                <th>Fecha</th>
                                <th>Contenido</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(error, index) in errores">
                                <td :class="'text-'+error.level_class">
                                    <span :class="'fa fa-'+error.level_img"></span> &nbsp;@{{error.level}}
                                </td>
                                <td>@{{error.context}}</td>
                                <td>@{{dateString2(error.date)}} a las @{{error.date.substring(10)}}</td>
                                <td>
                                    <div>@{{error.text}}</div>
                                    <div style="color: darkmagenta;">@{{error.in_file}}</div>
                                    <div style="color: brown;">@{{error.archivo}}</div>
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-success" @click="openRead(index)"
                                    style="margin-bottom: 10px;"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                

            </div>
        </div>

        {{-- Panel Read --}}
        <div v-show="panelRead">
            @include('cms.errores.partials.read')
        </div>

    </section>
@endsection

@push('scripts')
    @include('cms.errores.partials.scripts')
@endpush

@push('css')
<style>
    .chido {
        width: 100px;
        vertical-align: sub !important;
        background-color: #989898;
    }
</style>
@endpush