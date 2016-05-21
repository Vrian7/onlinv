@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Cobros </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Cobro: {{$client_name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Anular</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Clinte: </label> {{$client_name}}
                       <small>Nombre del cliente
                        </small>
                        <i class="icon-group"></i> <label>Factura: </label> {{$number}}
                       <small>N&uacute;mero de la factura pagada
                        </small>
                        <i class="icon-group"></i> <label>Pagado por: </label> {{$charge->paid_for}}
                       <small>Persona que pag&oacute; la factura
                        </small>
                         <i class="icon-group"></i> <label>Monto: </label> {{$charge->amount}}
                       <small>Monto que se pcobr&oacute;
                        </small>
                         <i class="icon-group"></i> <label>Fecha: </label> {{$charge->date}}
                       <small>Fecha del cobro
                        </small>
                        <i class="icon-group"></i> <label>M&eacute;todo de pago: </label> {{$type}}
                       <small>Forma de pago
                        </small>
                        <i class="icon-group"></i> <label>Descripci&oacute;n: </label> {{$charge->description}}
                       <small>Detalle del cobro
                        </small>
                        
                    </blockquote>                    
                </div>                
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('cobros')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('cobro/editar/'.$charge->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop