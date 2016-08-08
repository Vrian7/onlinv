@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Marcas </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Marca: {{$brand->name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n</h4>
                    <blockquote>
                       <i class="icon-archive"></i> <label>Nombre: </label> {{$brand->name}}
                       <small>Nombre
                        </small>
                        <i class="icon-truck"></i> <label>Manofacturador: </label> {{$brand->manofacturer}}
                       <small>Manofacturador de la marca
                        </small>
                        <i class="icon-user"></i> <label>Proveedor: </label> {{$brand->provider}}
                       <small>Nombre del proveedor
                        </small>
                        <i class="icon-plus"></i> <label>Descripci&oacute;n: </label> {{$brand->description}}
                       <small>Detalle de la marca
                        </small>
                        
                    </blockquote>                    
                </div>                
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('marcas')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('marca/editar/'.$brand->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop
