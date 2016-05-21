@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Facuras </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Factura: {{$invoice->number}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-success btn-sm btn-grad" href="{{asset('cobro/factura/'.$invoice->public_id)}}">Cobrar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Emisi&oacute;n</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Raz&oacute;n Social: </label> {{$invoice->client_name}}
                       <small>Cliente
                        </small>
                        <i class="icon-group"></i> <label>NIT: </label> {{$invoice->client_nit}}
                       <small>NIT del ciente
                        </small>
                        <i class="icon-group"></i> <label>Fecha: </label> {{$invoice->date}}
                       <small>Fecha de la emisi&oacute;n
                        </small>
                        <i class="icon-group"></i> <label>C&oacute;digo de control: </label> {{$invoice->control_code}}
                       <small>Fecha de la emisi&oacute;n
                        </small>
                        <i class="icon-group"></i> <label>Subtotal: </label> {{$invoice->total_amount}}
                       <small>Subtotal
                        </small>
                        <i class="icon-group"></i> <label>Descuento: </label> {{$invoice->discount}}
                       <small>Descuento
                        </small>
                        <i class="icon-group"></i> <label>Total: </label> {{$invoice->net_amount}}
                       <small>Importe total
                        </small>
                    </blockquote>                    
                </div>
                <div class="col-lg-6"> 
                    <h4>Sucursal</h4>
                    <blockquote>                    
                        <i class="icon-group"></i> <label>NIT: </label> {{$invoice->nit}}
                        <small>Nit de la empresa
                        </small>
                        <i class="icon-group"></i> <label>N&uacute;mero de autorizaci&oacute;n: </label> {{$invoice->authorization_number}}
                        <small>N&uacute;mero de la sucursal
                        </small>
                        <i class="icon-group"></i> <label>Direcci&oacute;n: </label> {{$invoice->address}}
                        <small>Ubicacion de la sucursal
                        </small>
                        <i class="icon-group"></i> <label>Tel&eacute;fono: </label> {{$invoice->phone}}
                        <small>Contacto de la sucursal
                        </small>
                        <i class="icon-group"></i> <label>Cuidad: </label> {{$invoice->city.' - '.$invoice->country}}
                        <small>Ciudad
                        </small>
                        <i class="icon-group"></i> <label>Leyenda: </label> {{$invoice->legend}}
                        <small>Ley 423
                        </small>
                    </blockquote>                    
                </div>
                <div class="col-lg-12">
                    <h4>Detalle</h4>
                    <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>C&oacute;digo</th>
                                            <th>Detalle</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        @foreach($products as $product)
                                        <tr>
                                            <td class="text-center">{{$product->code}}</td>
                                            <td class="text-center">{{$product->name}}</td>
                                            <td class="text-right">{{$product->quantity}}</td>
                                            <td class="text-right">{{$product->price}}</td>
                                            <td class="text-right">{{$product->quantity*$product->price}}</td>
                                            </tr>                                        
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
               <hr>
               <div class="col-lg-6">
                   <h4>Seguimiento</h4>
                   <div class="panel-group" id="accordion">
                        @foreach($tracing as $key => $trace)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">{{$trace->title}}</a>
                                        </h4>
                                    </div>
                                    @if($key == 0)
                                        <div id="collapse{{$key}}" class="panel-collapse collapse in">
                                    @else
                                        <div id="collapse{{$key}}" class="panel-collapse collapse collapsed">
                                    @endif
                                        <div class="panel-body">
                                        {{$trace->note}}<br><strong>FECHA-HORA:</strong> {{$trace->date}}                                            
                                        </div>
                                    </div>
                                </div>                                
                        @endforeach
                    </div>                        
               </div>
               <div class="col-lg-6"></div>
               <hr>
            </div>
<form class="form-horizontal" method="POST" id="form" action="{{asset('factura/editar/'.$invoice->public_id)}}">
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
        <input type="text" id="cancel" name="cancel" placeholder="Motivo" class="form-control" />
        <span class="input-group-btn">
            <button id="cancel_s"  class="btn btn-danger" type="button">
                Anular
            </button>
        </span>
    </div>
    <div class="col-lg-3 input-group">
        <input type="text" id="copy" name="copy" placeholder="Para" class="form-control" />
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