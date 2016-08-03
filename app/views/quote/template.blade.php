@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Cotizaci&oacute;n </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Cotizaci&oacute;n: {{$number}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-success btn-sm btn-grad" href="{{asset('cobro/factura/'.$public_id)}}">Cobrar</a>
                    </div>
                </header>
            <div class="panel-body col-lg-12">
               <iframe id="theFrame" type="text/html" src="{{asset('factura/estandar/'.$public_id)}}"  frameborder="1" width="100%" height="1180"></iframe>               
            </div>
<form class="form-horizontal" method="POST" id="form" action="{{asset('factura/editar/'.$public_id)}}">
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <input type="hidden" value="0" name="action" id="action">
    <div class="col-lg-3 input-group">
        <input type="text" name="name" placeholder="Nombre" class="form-control" />
        <input type="text" name="mail" placeholder="Correo" class="form-control" />
        <span class="input-group-btn">
            <button id="mail_s" class="btn btn-primary" type="button">
                Enviar
            </button>
        </span>
    </div>
    <div class="col-lg-3 input-group">
        <input type="text" id="cancel" placeholder="Motivo" class="form-control" />
        <span class="input-group-btn">
            <button id="cancel_s" class="btn btn-danger" type="button">
                Anular
            </button>
        </span>
    </div>
    <div class="col-lg-3 input-group">
        <input type="text" id="copy" placeholder="Para" class="form-control" />
        <span class="input-group-btn">
            <button id="copy_s" class="btn btn-default" type="button">
                Copia
            </button>
        </span>
    </div>
    
</div>
</form>
        </div>
    </div>
</div>
</div>
    {{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   
<script type="text/javascript">
    $("#mail_s").click(function(){
        $('#action').val('1');
        $('#form').submit();
    });
    $("#copy_s").click(function(){
        $('#action').val('2');
        $('#form').submit();
    });
    $("#cancel_s").click(function(){
        $('#action').val('3');
        $('#form').submit();
    });
</script>
@stop