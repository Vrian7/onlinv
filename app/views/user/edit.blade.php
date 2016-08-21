@extends('header')
{{ HTML::style('vendor/bcore/css/bootstrap-fileupload.min.css') }}
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Editar Usuario: {{$user->name}}</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('usuario/editar/'.$user->public_id)}}" enctype="multipart/form-data">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Datos Usuario</h5>
            <div class="toolbar">
                <ul class="nav">
                    <!-- <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-th-large"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Demo Link</a></li>
                            <li><a href="#">Demo Link</a></li>
                            <li><a href="#">Demo Link</a></li>
                        </ul>
                    </li> -->
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                            <i class="icon-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        
        <div id="div-1" class="accordion-body collapse in body">
            

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre completo</label>

                    <div class="col-lg-8">
                        <input type="text" value="{{$user->name}}" placeholder="Nombre real del usuario" name='name' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre de usuario</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$user->username}}" placeholder="nombre para ingresar al sistema" name="username" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Contrase&ntilde;a</label>
                    <div class="col-lg-8">
                        <input type="password" value="**********" placeholder="contrase&ntilde;a para ingresar al sistema" name="password" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Tel&eacute;fono/Celualar</label>
                    <div class="col-lg-8">
                        <input value="{{$user->phone}}" placeholder="N&uacute;mero de contacto" name="phone" class="form-control" />
                    </div>
                </div>                
               <div class="form-group">
                        <label class="control-label col-lg-4">Avatar o Foto</label>
                        <div class="col-lg-8">
                            <div class="fileupload fileupload-exists" data-provides="fileupload">
                                <!-- <div class="fileupload-exists thumbnail" style="width: 200px; height: 150px;"><img src="{{asset('uploads/users/'.$user->avatar)}}" alt="" /></div> -->
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"><img src="{{asset('uploads/users/'.$user->avatar)}}" alt="" /></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Elejir imagen</span><span class="fileupload-exists">Cambiar</span><input type="file" name="avatar" value="{{asset('uploads/users/'.$user->avatar)}}" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Elimnar</a>
                                </div>
                            </div>
                        </div>
                </div>                
                            
        </div>

        
    </div>
</div>
@if($user->rol_id!=1)
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-plus-sign"></i></div>
            <h5>Rol</h5>
            <div class="toolbar">
                <ul class="nav">
                    <!-- <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-th-large"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Demo Link</a></li>
                            <li><a href="#">Demo Link</a></li>
                            <li><a href="#">Demo Link</a></li>
                        </ul>
                    </li> -->
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-2">
                            <i class="icon-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        <div id="div-2" class="accordion-body collapse in body">            
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Rol</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Rol de usuario" name="rol" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($rols as $rol)
                                @if($rol->id == $user->rol_id)
                                    <option value="{{$rol->id}}" selected>{{$rol->name}}</option>
                                @else
                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                @endif
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sucursal</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Sucursal en la que trabaja" name="branch" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($branches as $branch)
                                @if($branch->id == $user->branch_id)
                                    <option value="{{$branch->id}}" selected>{{$branch->name}}</option>
                                @else
                                    <option value="{{$branch->id}}">{{$branch->name}}</option>  
                                @endif
                            @endforeach                        
                        </select>
                    </div>
                </div>           
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Habilitado</label>
                    <div class="col-lg-8">
                        @if($user->enabled==1)
                            <input type="checkbox" name="enabled" class="form-control" checked />
                        @else
                            <input type="checkbox" name="enabled" class="form-control" />
                        @endif
                    </div>
                </div>  
        </div>
    </div>
    <hr>       
</div>
@endif
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('usuarios')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>
        {{ HTML::script('vendor/bcore/plugins/jasny/js/bootstrap-fileupload.js') }}
@stop