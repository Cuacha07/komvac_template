@extends('cms.master')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-cogs"></i> Configuración </h1>
    </section>

    <section class="content" id="app" v-cloak>

        <div class="box box-primary">
            <div class="box-body"></div>
        </div>
        
        <div class="row">
            <div class="col-md-6">

                {{-- Correo de Contacto --}}
                <div class="box box-success">

                    <div class="box-header">
                        <h3 class="box-title">Correo de Contacto</h3>
                        <div class="box-tools pull-right">
                            <a href="#" class="btn bg-navy btn-xs" @click="setCorreoContacto()">
                                <i class="fa fa-floppy-o"></i> Actualizar
                            </a>
                        </div>
                    </div>
        
                    <div class="box-body">

                        {{-- Form Errros --}}
                        <formerrors :errorsbag="erroresCorreo"></formerrors>
                        
                        {{-- correo --}}
                        <div class="form-group" v-show="!loadingConctaco">
                            <label>Correo del Destinatario</label>
                            <input type="text" class="form-control" 
                            placeholder="doradopaz@hotmail.com" v-model="correo_destinatario"
                            :class="formError(erroresCorreo, 'correo', 'inputError')">
                        </div>

                        <span class="label label-warning">Correo al que se le mandara la información del formulario de Contacto.</span>

                        <!-- VueLoading icon -->
                        <div class="text-center"><i v-show="loadingConctaco" class="fa fa-spinner fa-spin fa-5x"></i></div>
                    </div>

                </div>
                {{-- Correo de Contacto --}}

            </div>

            <div class="col-md-6">
               
                {{-- Modo Mantenimiento --}}
                <div class="box box-warning">

                    <div class="box-header">
                        <h3 class="box-title">Modo Mantenimiento</h3>
                        <div class="box-tools pull-right">
                            <a href="#" class="btn bg-navy btn-xs" @click="setMantenimiento()">
                                <i class="fa fa-floppy-o"></i> Actualizar
                            </a>
                        </div>
                    </div>

                    <div class="box-body">
                        
                        {{-- habilitado --}}
                        <div class="form-group" v-show="!loadingMantenimiento">
                            <label>Habilitado</label>
                            <select class="form-control" v-model="modo_mantenimiento">
                                <option value="0">Activado</option>
                                <option value="1">Desactivado</option>
                            </select>
                        </div>

                        <span class="label label-danger">Bloqueara el sitio hasta que se desactive el modo mantenimiento.</span>

                        <!-- VueLoading icon -->
                        <div class="text-center"><i v-show="loadingMantenimiento" class="fa fa-spinner fa-spin fa-5x"></i></div>
                    </div>

                </div>
                {{-- Modo Mantenimiento --}}

            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">

                 {{-- Background --}}
                 <div class="box box-info">

                    <div class="box-header">
                        <h3 class="box-title">Fondo del Login</h3>
                        <div class="box-tools pull-right">
                            <a href="#" class="btn bg-navy btn-xs" @click="setBackground()">
                                <i class="fa fa-floppy-o"></i> Actualizar
                            </a>
                        </div>
                    </div>

                    <div class="box-body" style="text-align: center;">
                        
                        {{-- background --}}
                        <imageupload v-model="background_image" v-show="!loadingBackground"></imageupload> <br>

                        <span class="label label-warning" v-show="!loadingBackground">La resoulción recomendada de la imagen (1920 x 1080).</span>

                        <!-- VueLoading icon -->
                        <div class="text-center"><i v-show="loadingBackground" class="fa fa-spinner fa-spin fa-5x"></i></div>
                    </div>

                </div>
                {{-- Background --}}

            </div>
            <div class="col-md-6">

                {{-- Tema del CMS --}}
                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title">Temas del CMS</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.configuraciones.index')}}" class="btn bg-orange btn-xs">
                            <i class="fa fa-refresh"></i> Reiniciar Página</a>
                            <a href="#" class="btn bg-navy btn-xs" @click="setTema()">
                            <i class="fa fa-floppy-o"></i> Actualizar</a>
                        </div>
                    </div>

                    <div class="box-body">
                        
                        {{-- color cabecera --}}
                        <div class="form-group" v-show="!loadingTema">
                            <label>Color de Cabecera</label>
                            <select class="form-control" v-model="tema.template_skin">
                                <option value="blue">Blue</option>
                                <option value="black">White</option>
                                <option value="purple">Purple</option>
                                <option value="yellow">Yellow</option>
                                <option value="red">Red</option>
                                <option value="green">Green</option>
                            </select>
                        </div>

                        {{-- diseño --}}
                        <div class="form-group" v-show="!loadingTema">
                            <label>Diseño</label>
                            <select class="form-control" v-model="tema.template_layout_options">
                                <option value="fixed">fixed (Default)</option>
                                <option value="sidebar-collapse">sidebar-collapse</option>
                                <option value="sidebar-mini">sidebar-mini</option>
                                <option value="sidebar-collapse sidebar-mini">sidebar-collapse sidebar-mini</option>
                            </select>
                        </div>

                        <span class="label label-info">Debe reiniciar la página para que note el cambio.</span>

                        <!-- VueLoading icon -->
                        <div class="text-center"><i v-show="loadingTema" class="fa fa-spinner fa-spin fa-5x"></i></div>
                    </div>

                </div>
                {{-- Modo Mantenimiento --}}

            </div>
        </div>

    </section>
@endsection

@push('scripts')
    @include('cms.configuraciones.partials.scripts')
@endpush