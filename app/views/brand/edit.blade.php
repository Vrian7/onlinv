@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Editar Marca</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('marca/editar/'.$brand->public_id)}}">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Datos B&aacute;sicos</h5>
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
                    <label for="text1" class="control-label col-lg-4">Nombre</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$brand->name}}" placeholder="Ingrese el nombre de la marca" name='name' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Manofacturador</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$brand->manofacturer}}" placeholder="Manofacturador" name="manofacturer" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Proveedor</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$brand->privider}}" placeholder="Proveedor de la marca" name="provider" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Descripci&oacute;n</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$brand->description}}" placeholder="Descripci&oacute;n adicional de la marca" name="description" class="form-control" />
                    </div>
                </div>                
                
        </div>

        
    </div>
</div>
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('marcas')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>
@stop