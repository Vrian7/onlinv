@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Usuarios </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Usuario: {{$user->name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Datos de Usuario</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Nombre Completo: </label> {{$user->name}}
                       <small>Nombre real del usuario
                        </small>
                        <i class="icon-group"></i> <label>Nombre del usuario: </label> {{$user->username}}
                       <small>Nombre para ingresar al sistema
                        </small>
                        <i class="icon-group"></i> <label>Tel&eacute;fono/Celular: </label> {{$user->phone}}
                       <small>Dato de contacto con el usuario
                        </small>                        
                        <i class="icon-group"></i> <label>Foto o Avatar: </label>
                        <img class="media-object img-thumbnail user-img" alt="Usuario" src="{{asset('uploads/users/'.$user->avatar)}}"  height="100" width="100"/>
                       <small>Usuario
                        </small>
                    </blockquote>                    
                </div>
                <div class="col-lg-6"> 
                <h4>Rol</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Rol: </label> {{$rol}}
                       <small>Rol del usuario
                        </small>
                        <i class="icon-group"></i> <label>Sucursal: </label> {{$branch}}
                       <small>Sucursal
                        </small>
                        <i class="icon-group"></i> <label>Habilitado: </label> {{$enabled}}
                       <small>Habilitado
                        </small>                        
                    </blockquote>
                </div>               
            </div>
            <hr>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('usuarios')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('usuario/editar/'.$user->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop