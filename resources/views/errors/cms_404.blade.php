@extends('cms.auth.master')

@section('content')

    <section class="content">

        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
        
            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Lo sentimos, No existe la página.</h3>
        
                <p>
                    No podemos encontrar la página que esta buscando. Mientras debería <a href="{{route('admin.home')}}">regresar al dashboard</a> o 
                    <a href="{{url('/')}}">regresar a la página principala</a>.
                </p>
        
                <form class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar ...">
        
                    <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                    </button>
                    </div>
                </div>
                <!-- /.input-group -->
                </form>
            </div>
            <!-- /.error-content -->
        </div>

    </section>
@endsection
