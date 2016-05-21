@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Crear Nuevo Cliente</h3>
        </div>
    </div>    
<form class="form-horizontal" method="POST" action="{{asset('cliente')}}">
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
                    <label for="text1" class="control-label col-lg-4">Raz&oacute;n Social</label>

                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre a la cual se emitir&aacute; la factura" name='business_name' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">NIT</label>

                    <div class="col-lg-8">
                        <input type="text"  placeholder="NIT o CI" name="nit" class="form-control" />
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
                    <label for="text1" class="control-label col-lg-4">Nombre del clente</label>

                    <div class="col-lg-8">
                        <input type="text"  placeholder="Nombre real del ciente" name="name" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Direcci&oacute;n</label>

                    <div class="col-lg-8">
                        <input type="text"  placeholder="Direcci&oactue;n de la empresa" name="address" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Tel&eacute;fono/Celular</label>

                    <div class="col-lg-8">
                        <input type="text"  placeholder="Puede ingresar mas de uno." name="phone" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Correo electr&oacute;nico</label>

                    <div class="col-lg-8">
                        <input type="text"  placeholder="Correo v&aacute;lido." name="mail" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Datos Adicionales</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="Antecedentes del cliente" name="description" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Contacto</label>
                    <div class="col-lg-8">
                        <input type="text" placeholder="Puede ingresar nombre, celular, cargo, etc." name="contact_data" class="form-control" />
                    </div>
                </div>            
        </div>
    </div>
    <hr>       
</div>
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('clientes')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>    
@stop