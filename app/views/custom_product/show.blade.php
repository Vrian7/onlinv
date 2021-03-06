@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Campos adicionales</h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Campos adicionales de Productos</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Categor&iacute;a: </label> {{$custom->name}}
                       <small>nombre de la categoria
                        </small>
                        <i class="icon-group"></i> <label>Campo 1: </label> {{$custom->field1}}
                       <small>Etiqueta del campo adicional 1
                        </small>                  
                        <i class="icon-group"></i> <label>Campo 2: </label> {{$custom->field2}}
                       <small>Etiqueta del campo adicional 2
                        </small>                  
                        <i class="icon-group"></i> <label>Campo 3: </label> {{$custom->field3}}
                       <small>Etiqueta del campo adicional 3
                        </small>                  
                        <i class="icon-group"></i> <label>Campo 4: </label> {{$custom->field4}}
                       <small>Etiqueta del campo adicional 4
                        </small>                  
                        <i class="icon-group"></i> <label>Campo 5: </label> {{$custom->field5}}
                       <small>Etiqueta del campo adicional 5
                        </small>                            
                    </blockquote>                    
                </div>                
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('campos_productos')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
        <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('campos_producto/editar/'.$custom->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop