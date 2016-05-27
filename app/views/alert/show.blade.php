@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Alerta </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Alerta: {{$alert->name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>T&iacute;tulo: </label> {{$alert->title}}
                       <small>Encabezado de la alerta
                        </small>
                        <i class="icon-group"></i> <label>Mensaje: </label> {{$alert->message}}
                       <small>Mensaje
                        </small>
                        <i class="icon-group"></i> <label>Importancia: </label> {{$alert->name}}
                       <small>Grado de importancia del mensaje
                        </small>
                        <i class="icon-group"></i> <label>Fecha: </label> {{$alert->date}}
                       <small>Fecha de la alerta
                        </small>
                        <i class="icon-group"></i> <label>HOra: </label> {{$alert->time}}
                       <small>Hora de la alerta
                        </small>                            
                    </blockquote>                    
                </div>                
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('alertas')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
        <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('alerta/editar/'.$alert->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop