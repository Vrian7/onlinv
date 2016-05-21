@extends('header')
{{ HTML::style('vendor/bcore/css/bootstrap-fileupload.min.css') }}
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Crear Nuevo Usuario</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('usuario')}}" enctype="multipart/form-data">
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
                        <input type="text"  placeholder="Nombre real del usuario" name='name' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre de usuario</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="nombre para ingresar al sistema" name="username" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Contrase&ntilde;a</label>
                    <div class="col-lg-8">
                        <input type="password"  placeholder="contrase&ntilde;a para ingresar al sistema" name="password" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Tel&eacute;fono/Celualar</label>
                    <div class="col-lg-8">
                        <input placeholder="N&uacute;mero de contacto" name="phone" class="form-control" />
                    </div>
                </div>                
               <div class="form-group">
                        <label class="control-label col-lg-4">Avatar o Foto</label>
                        <div class="col-lg-8">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-file btn-success"><span class="fileupload-new">Seleccionar imagen</span><span class="fileupload-exists">Cambiar</span><input type="file" name="avatar" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                </div>
                            </div>
                        </div>
                </div>                
                            
        </div>

        
    </div>
</div>
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
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sucursal</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Sucursal en la que trabaja" name="branch" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>           
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Habilitado</label>
                    <div class="col-lg-8">
                        <input type="checkbox" name="enabled" class="form-control" />
                    </div>
                </div>  
        </div>
    </div>
    <hr>       
</div>
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