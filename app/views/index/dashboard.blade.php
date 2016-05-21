@extends('header')
@section('body')
<div class="inner col-lg-12">
	
		<div class="row">
            <div class="col-lg-12">
                <h1> Resumen </h1>
            </div>
        </div>
	
	<hr>
    <!--BLOCK SECTION -->
	 <div class="row">
	    
	        <div style="text-align: center;">
	           <div class="col-md-2">
	            <a class="quick-btn" href="#">
	                <i class="icon-check icon-2x"></i>
	                <span> Facturas</span>
	                <span class="label label-danger">{{$invoice}}</span>
	            </a>
	            </div>
	            <div class="col-md-2">
	            <a class="quick-btn" href="#">
	                <i class="icon-envelope icon-2x"></i>
	                <span>Notificaciones</span>
	                <span class="label label-success">4</span>
	            </a>
	            </div>
	            <div class="col-md-2">
	            <a class="quick-btn" href="#">
	                <i class="icon-signal icon-2x"></i>
	                <span>Montos</span>
	                <span class="label label-warning">{{$amount}}</span>
	            </a>
	            </div>
	            <div class="col-md-2">
	            <a class="quick-btn" href="#">
	                <i class="icon-external-link icon-2x"></i>
	                <span>Clientes</span>
	                <span class="label btn-metis-2">{{$client}}</span>
	            </a>
	            </div>
	            <div class="col-md-2">
	            <a class="quick-btn" href="#">
	                <i class="icon-lemon icon-2x"></i>
	                <span>Productos</span>
	                <span class="label btn-metis-4">{{$product}}</span>
	            </a>
	            </div>
	            <div class="col-md-2">
	            <a class="quick-btn" href="#">
	                <i class="icon-bolt icon-2x"></i>
	                <span>Sucursales</span>
	                <span class="label label-default">{{$branch}}</span>
	            </a>	            
	            </div>	   
	                    
	        </div>
	    	
	</div>
</div>
    <!--END BLOCK SECTION -->


@stop