@extends('cms.master')

@section('content')

    <section class="content-header">
        <h1>Dashboard</h1>
		<h1 style="float: right;">{{ CMSHelpers::getDate() }}</h1>
    </section>

    <section class="content">

        @lang('cms.welcome') {{ Auth::guard('cms')->user()->name }}

        <br><br>
        <div class="container-fluid">

	    	<div class="row">
	    		<div class="col-md-4">
	    			@include('cms.widgets.disk')
	    		</div>
	    		<div class="col-md-4">
                    @include('cms.widgets.memory')
	    		</div>
	    		<div class="col-md-4">
                    @include('cms.widgets.users')
	    		</div>						
	    	</div>

		</div>

    </section>
@endsection