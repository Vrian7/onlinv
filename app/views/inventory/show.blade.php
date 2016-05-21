@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Inventarios </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Iventario: {{$inventory->public_id}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Producto: </label> {{$inventory->product}}
                       <small>nombre
                        </small>
                        <i class="icon-group"></i> <label>Sucursal: </label> {{$inventory->branch}}
                       <small>Manofacturador de la marca
                        </small>
                        <i class="icon-group"></i> <label>Existencia: </label> {{$inventory->stock}}
                       <small>Nombre del proveedor
                        </small>
                         <i class="icon-group"></i> <label>Vendidos: </label> {{$inventory->sold}}
                       <small>Cantidad de productos vendidos
                        </small>
                        <i class="icon-group"></i> <label>Descripci&oacute;n: </label> {{$inventory->description}}
                       <small>Detalle de la marca
                        </small>
                        <i class="icon-group"></i> <label>Promedio: </label> {{$inventory->average}}
                       <small>Cantidad normal en inventarios
                        </small>
                        <i class="icon-group"></i> <label>Cantidad m&iacute;nima: </label> {{$inventory->minimum}}
                       <small>Al llegar a esta cantidad se lanza la alerta
                        </small>
                    </blockquote>                    
                </div>                
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('inventarios')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('inventario/editar/'.$inventory->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop