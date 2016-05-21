@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Creaci&oacute;n de campos adicionales</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('campos_producto')}}">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Campos adicionales</h5>
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
                    <label for="text1" class="control-label col-lg-4">Categor&iacute;a</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Categorizacion de productos" name="category" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>            
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre Campo 1</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre del campo adicional" name='field1' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre Campo 2</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre del campo adicional" name='field2' class="form-control" />
                    </div>
                </div>            
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre Campo 3</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre del campo adicional" name='field3' class="form-control" />
                    </div>
                </div>                    
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre Campo 4</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre del campo adicional" name='field4' class="form-control" />
                    </div>
                </div>            
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre Campo 5</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre del campo adicional" name='field5' class="form-control" />
                    </div>
                </div>                      
        </div>        
    </div>
</div>
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('campos_clientes')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>
@stop