@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Editar Producto: {{$product->name}}</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('producto')}}">
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
                    <label for="text1" class="control-label col-lg-4">C&oacute;digo del producto</label>

                    <div class="col-lg-8">
                        <input type="text" value="{{$product->code}}" placeholder="Ingrese un c&oacute;digo para identificar a su producto" name='code' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre o denominaci&oacute;n del producto</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$product->name}}"  placeholder="Ingrese un nombre para el producto" name="name" class="form-control" />
                    </div>
                </div>                
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Precio nominal del producto</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$product->price}}" placeholder="Ingrese un precio nominal" name="price" class="form-control" />
                    </div>
                </div>
        </div>

        
    </div>
</div>
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-plus-sign"></i></div>
            <h5>Datos Adicionales</h5>
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
        <div id="div-2" class="accordion-body collapse collapsed body">            
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Descripci&oacute;on adicional</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$product->description}}" placeholder="Descripci&oacute;n adicional para identificarlo." name="description" class="form-control" />
                    </div>
                </div>      
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Categor&iacute;a</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Categorizacion de productos" name="category" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Unidad</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Unidad del producto" name="unit" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($units as $unit)                            
                                @if($unit->id == $product->unit_id)
                                    <option value="{{$unit->id}}" selected>{{$unit->name}}</option>
                                @else
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endif
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Marca</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Marca del producto" name="brand" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($brands as $brand)
                                @if($brand->id == $product->brand_id)
                                    <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                @else
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endif
                            @endforeach                        
                        </select>
                    </div>
                </div>           
        </div>
    </div>
    <hr>       
</div>
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('productos')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>
{{ HTML::script('vendor/bcore/js/jquery-ui.min.js') }}
@stop