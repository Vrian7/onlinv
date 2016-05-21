@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Asignar Nuevo Inventario</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('inventario')}}">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Datos</h5>
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
                    <label for="text1" class="control-label col-lg-4">Producto</label>
                    <div class="col-lg-8">
                         <select data-placeholder="Producto" name="product" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sucursal</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Sucursal" name="branch" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Existencia</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Cantidad del producto" name="stock" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Promedio</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Ingrese la cantidad promedio que tiene el producto" name="average" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">M&iacute;nimo</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Se lanza una alerta cuando el producto llege a esta cantidad" name="minimum" class="form-control" />
                    </div>
                </div>                
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Descripci&oacute;n</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Descripci&oacute;n del inventario" name="description" class="form-control" />
                    </div>
                </div>                

        </div>

        
    </div>
</div>
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('inventarios')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>
@stop