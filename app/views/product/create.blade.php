@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Crear Nuevo Producto</h3>
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
                        <input type="text"  placeholder="Ingrese un c&oacute;digo para identificar a su producto" name='code' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Nombre o denominaci&oacute;n del producto</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Ingrese un nombre para el producto" name="name" class="form-control" />
                    </div>
                </div>                
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Precio nominal del producto</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Ingrese un precio nominal" name="price" class="form-control" />
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
                    <label for="text1" class="control-label col-lg-4">Descripci&oacute;n adicional</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Descripci&oacute;n adicional para identificarlo." name="description" class="form-control" />
                    </div>
                </div>      
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Categor&iacute;a</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Categorizacion de productos" id="category" name="category" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Unidad</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Unidad del producto" name="unit" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Marca</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Marca del producto" name="brand" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>                
            @if(isset($custom->field1))
                @if($custom->field1)
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">{{$custom->field1}}</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Campo personalizado." name="field1" class="form-control" />
                    </div>
                </div> 
                @endif
                @if($custom->field2)
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">{{$custom->field2}}</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Campo personalizado." name="field2" class="form-control" />
                    </div>
                </div> 
                @endif
                @if($custom->field3)
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">{{$custom->field3}}</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Campo personalizado." name="field3" class="form-control" />
                    </div>
                </div> 
                @endif
                @if($custom->field4)
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">{{$custom->field4}}</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Campo personalizado." name="field4" class="form-control" />
                    </div>
                </div> 
                @endif
                @if($custom->field5)
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">{{$custom->field5}}</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Campo personalizado." name="field5" class="form-control" />
                    </div>
                </div> 
                @endif
            @endif
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
<script type="text/javascript">
    customs = {{$customs}};        
    $('#category').change(function(){        
        cleanAdditional();                
        customs.forEach(function(custom) {                        
            if($("#category").val() == custom.category_id){                
                if(custom.field1!=null)
                    addAdditional(custom.field1,1);
                if(custom.field2!=null)
                    addAdditional(custom.field2,2);
                if(custom.field3!=null)
                    addAdditional(custom.field3,3);
                if(custom.field4!=null)
                    addAdditional(custom.field4,4);
                if(custom.field5!=null)
                    addAdditional(custom.field5,5);
            }            
        });        
    });    
    
    function addAdditional(field,num){
        div = '<div id=\'extra'+num+'\' class=\'form-group\'>'
        label = '<label for=\"text1\" class=\"control-label col-lg-4\">'+field+'</label>';
        div2 = '<div class=\"col-lg-8\">';
        input = '<input type=\"text\"  placeholder=\"Campo personalizado.\" name=\"field'+num+'\" class=\"form-control\" />'
        findiv = "</div></div>";
        $('#div-2').append(div+label+div2+input+findiv);        
    }
    function cleanAdditional(){
        $('#extra1').remove();   
        $('#extra2').remove();   
        $('#extra3').remove();   
        $('#extra4').remove();   
        $('#extra5').remove();   
    }
</script>
@stop
