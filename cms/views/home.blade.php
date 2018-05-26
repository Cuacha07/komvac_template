@extends('CMS::master')

@section('content')

	<?php 
		use Carbon\Carbon;
		setlocale(LC_TIME, config('app.locale'));
		$fecha = utf8_encode(Carbon::now()->formatLocalized('%A %d %B %Y'));
		$hora  = Carbon::now()->toTimeString();
	?>

    <section class="content-header">
        <h1>
            Dashboard
        </h1>

		<h1 style="float: right;">{{ ucfirst($fecha) }} {{ $hora }}</h1>
    </section>
    <section class="content">

        {!! Alert::render() !!}
        @lang('CMS::core.welcome') {{ Auth::user()->name }} 

        <br><br>
        <div class="container-fluid">

	    	<div class="row">
	    		<div class="col-md-4">
	    			@include('CMS::widgets.disk')
	    		</div>
	    		<div class="col-md-4">
                    @include('CMS::widgets.memory')
	    		</div>
	    		<div class="col-md-4">
                    @include('CMS::widgets.users')
	    		</div>						
	    	</div>

	    	<div class="row">
    			<div class="col-md-12">
					@include('CMS::widgets.citas')
    			</div>
	    	</div>

	    	<div class="row">
    			<div class="col-md-12">
					@include('CMS::widgets.pacientes')
    			</div>
	    	</div>

		</div>


    </section>
@endsection