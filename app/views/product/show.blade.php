@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Productos </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Producto: {{$product->name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n B&aacute;sica</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>C&oacute;digo del producto: </label> {{$product->code}}
                       <small>Dato para identifacr al producto
                        </small>
                        <i class="icon-group"></i> <label>Nombre: </label> {{$product->name}}
                       <small>Nombre o Descripci&oacute;n del producto
                        </small>
                        <i class="icon-group"></i> <label>Precio: </label> {{$product->price}}
                       <small>Precio general o nominal
                        </small>
                    </blockquote>
                    
                </div>
                <div class="col-lg-6"> 
                <h4>Informaci&oacute;n Adicional</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Descripci&oacute;n: </label> {{$product->description}}
                       <small>Datos adicionales dle producto
                        </small>
                        <i class="icon-group"></i> <label>Categor&iacute;a: </label> <span class="label label-primary">{{$category}}</span>                       <small>Categorizaci&oacute;n del producto
                        </small>
                        <i class="icon-group"></i> <label>Unidad: </label> <span class="label label-primary">{{$unit}}</span>
                       <small>Unidad de medida del producto
                        </small>
                        <i class="icon-group"></i> <label>Marca: </label>&nbsp;<span class="label label-primary">{{$brand}}</span>
                       <small>Marca del producto
                        </small>                        
                    </blockquote>
                </div>
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('productos')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('producto/editar/'.$product->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop