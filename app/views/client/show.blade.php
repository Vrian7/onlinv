@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Clientes </h2>
        </div>
    </div>
    <hr/>
    <!-- <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Cliente: {{$client->business_name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">

               <hr>
            </div>
        </div>
    </div>
</div> -->
<div class="row col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Cliente: {{$client->name}}</h5> 
            <div class="toolbar">
                <ul class="nav">                    
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                            <i class="icon-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </header> 
        <div id="div-1" class="accordion-body collapse in body">        
            <div class="col-lg-6">
                <h4>Informaci&oacute;n B&aacute;sica</h4>
                <blockquote>
                    <i class="icon-briefcase"></i> <label>Raz&oacute;n Social: </label> {{$client->business_name}}
                    <small>Dato para facturar
                    </small>
                    <i class="icon-archive"></i> <label>NIT: </label> {{$client->nit}}
                    <small>N&uacute;mero de identificaci&oacute;n tributaria
                    </small>
                </blockquote>
                <h4>Informaci&oacute;n del cliente</h4>
                <blockquote>
                   <i class="icon-user"></i> <label>Nombre del cliente: </label> {{$client->name}}
                   <small>Dato para identificar al cliente
                    </small>
                    <i class="icon-map-marker"></i> <label>Direcci&oacute;n: </label> {{$client->address}}
                   <small>Ubicaci&oacute;n
                    </small>
                    <i class="icon-phone"></i> <label>Tel&eacute;fono / Celular: </label> {{$client->phone}}
                   <small>Dato telef&oacute;nico
                    </small>
                    <i class="icon-mail-forward"></i> <label>Correo electr&oacute;nico: </label> {{$client->mail}}
                   <small>Correo 
                    </small>
                    <i class="icon-plus"></i> <label>Datos Adicionales: </label> {{$client->description}}
                   <small>Dato cliente
                    </small>
                    <i class="icon-user"></i> <label>Contacto: </label> {{$client->contact_data}}
                   <small>Dato para comunicar a la empresa
                    </small>
                </blockquote>
            </div>
            <div class="col-lg-6"> 
            <h4>Movimiento Econ&oacute;mico</h4>
                <blockquote>
                    <i class="icon-money"></i> <label>Total Movimiento: </label> {{$client->flow}}
                    <small>Total de movimiento del cliente
                    </small>
                    <i class="icon-money"></i> <label>Acumulado: </label> {{$client->flow}}
                    <small>Monto acumulado con pagos previos
                    </small>
                    <i class="icon-money"></i> <label>Adeudado: </label> {{$client->debt}}
                    <small>Total de deudas a la fecha
                    </small>
                </blockquote>
            @if(isset($custom->field1))
            <h4>Informaci&oacute;n Personalizada</h4>
                <blockquote>                        
                    @if($custom->field1!="")
                    <i class="icon-group"></i> <label>{{$custom->field1}}: </label> {{$client->extra1}}
                    <small>Dato personalizado
                    </small>
                    @endif
                    @if($custom->field2!="")
                    <i class="icon-group"></i> <label>{{$custom->field2}}: </label> {{$client->extra2}}
                    <small>Dato personalizado
                    </small>
                    @endif
                    @if($custom->field3!="")
                    <i class="icon-group"></i> <label>{{$custom->field3}}: </label> {{$client->extra3}}
                    <small>Dato personalizado
                    </small>
                    @endif
                    @if($custom->field4!="")
                    <i class="icon-group"></i> <label>{{$custom->field4}}: </label> {{$client->extra4}}
                    <small>Dato personalizado
                    </small>
                    @endif
                    @if($custom->field5!="")
                    <i class="icon-group"></i> <label>{{$custom->field5}}: </label> {{$client->extra5}}
                    <small>Dato personalizado
                    </small>
                    @endif
                </blockquote>
                @endif
            </div>
        </div>    
    </div>
</div>

<div class="row col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Facturas</h5> 
            <div class="toolbar">
                <ul class="nav">                    
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-2">
                            <i class="icon-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </header> 
        <div id="div-2" class="accordion-body collapse collapsed body">
            <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="invoices-datatable">
                        <thead>
                            <tr>
                                <th class="col-md-1">Nro</th>
                                <th class="col-md-3">Raz&oacute;n</th>
                                <th class="col-md-3">Monto</th>
                                <th class="col-md-2">Fecha</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-1">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $invoices as $invoice)
                            <tr class="odd gradeX">
                                <td>{{ $invoice->number }}</td>
                                <td>{{ $invoice->client_name }}</td>                                
                                <td align="right">{{ number_format($invoice->net_amount,2,'.',',') }}</td>
                                <td class="center">{{ $invoice->date }}</td>
                                <td class="center">{{--- $statuses[$invoice->invoice_status_ids] ---}}</td>
                                <td class="center">
                                    <a class="btn btn-primary btn-xs" href="{{asset('factura/'.$invoice->public_id)}}">
                                        <i class="icon-eye-open"></i> Ver
                                    </a>
                                </td>
                            </tr>                        
                            @endforeach                                
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
<div class="row col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Pagos</h5> 
            <div class="toolbar">
                <ul class="nav">                    
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-3">
                            <i class="icon-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </header> 
        <div id="div-3" class="accordion-body collapse collapsed body">
                <table class="table table-striped table-bordered table-hover" id="cobros-datatable">
                    <thead>
                        <tr>
                            <th class="col-md-1">Id</th>
                            <th class="col-md-3">Cliente</th>
                            <th class="col-md-3">Factura</th>
                            <th class="col-md-2">Monto</th>
                            <th class="col-md-2">Fecha</th>
                            <th class="col-md-1">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $charges as $charge)
                        <tr class="odd gradeX">
                            <td>{{ $charge->public_id }}</td>
                            <td>{{ $charge->client_name }}</td>
                            <td>{{ $charge->number }}</td>
                            <td class="center">{{ $charge->amount }}</td>
                            <td class="center">{{ $charge->date }}</td>
                            <td class="center">
                                <a class="btn btn-primary btn-xs" href="{{asset('cobro/'.$charge->public_id)}}">
                                    <i class="icon-eye-open"></i> Ver
                                </a>
                            </td>
                        </tr>                        
                        @endforeach                                
                    </tbody>
                </table>
            </div>
        
    </div>
</div>
<div class="row col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Cotizaciones</h5> 
            <div class="toolbar">
                <ul class="nav">                    
                    <li>
                        <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-4">
                            <i class="icon-chevron-up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </header> 
        <div id="div-4" class="accordion-body collapse collapsed body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="invoices-datatable">
                    <thead>
                        <tr>
                            <th class="col-md-1">Nro</th>
                            <th class="col-md-3">Raz&oacute;n</th>
                            <th class="col-md-3">Monto</th>
                            <th class="col-md-2">Fecha</th>
                            <th class="col-md-2">Estado</th>
                            <th class="col-md-1">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                        <tr class="odd gradeX">
                            <td>{{ $quote->number }}</td>
                            <td>{{ $quote->client_name }}</td>
                            <td align="right">{{ number_format($quote->net_amount,2,'.',',') }}</td>
                            <td class="center">{{ $quote->date }}</td>
                            <td class="center">{{$quote->public_id}}</td>
                            <td class="center">
                                <a class="btn btn-primary btn-xs" href="{{asset('cotizacion/'.$quote->public_id)}}">
                                    <i class="icon-eye-open"></i> Ver
                                </a>
                            </td>
                        </tr>                        
                        @endforeach                                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
    <div class="col-lg-12">
        <div class="col-lg-3"></div>
        <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('clientes')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('cliente/editar/'.$client->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
    </div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop
