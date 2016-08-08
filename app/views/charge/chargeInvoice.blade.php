@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Generar cobro de factura</h3>
        </div>
    </div>
<form class="form-horizontal" method="POST" action="{{asset('cobro')}}">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-file-alt"></i></div>
            <h5>Datos del cobro</h5>
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
                    <label for="text1" class="control-label col-lg-4">Cliente</label>
                    <div class="col-lg-8">
                        <select data-placeholder="cliente" name="client" class="form-control chzn-select chzn-rtl" tabindex="9">                            
                                <option value="{{$invoice->client_id}}">{{$invoice->client_name.' : '.$invoice->client_nit}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Factura</label>
                    <div class="col-lg-8">
                        <select data-placeholder="factura" name="invoice" class="form-control chzn-select chzn-rtl" tabindex="9">
                                <option value="{{$invoice->id}}">FACTURA: {{$invoice->number}} TOTAL: {{$invoice->net_amount}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Tipo</label>
                    <div class="col-lg-8">
                        <select data-placeholder="Tipo de pago" name="payment_type" class="form-control chzn-select chzn-rtl" tabindex="9">
                            @foreach($payment_types as $payment_type)
                                <option value="{{$payment_type->id}}">{{$payment_type->name}}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Pag&oacute;</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$invoice->client_name}}" placeholder="Nombre de la persona que realiz&oacute; el pago" name="paid_for" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Monto</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$invoice->debt}}" placeholder="Monto del pago efectuado" name="amount" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Fecha</label>
                    <div class="col-lg-8">
                        <input type="text" name="date" class="form-control" placeholder="Fecha del cobro" data-date-format="dd/mm/yyyy" id="date" />
                    </div>
                </div>
                     
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Descripci&oacute;n</label>
                    <div class="col-lg-8">
                        <input type="text"  placeholder="detalle del pago" name="description" class="form-control" />
                    </div>
                </div>  
        </div>

        
    </div>
</div>
<div class="col-lg-12">
	<div class="col-lg-3"></div>
	<div class="col-lg-2"><a class="btn btn-primary" href="{{asset('cobros')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
	<div class="col-lg-2"></div>
	<div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Guardar</a></div>
</div>
</form>
</div>
<script type="text/javascript">
    $("#date").datepicker();
</script>
@stop