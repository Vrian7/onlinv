@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Cotizaciones </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Listado de Cotizaciones</h5>
                    <div class="toolbar">
                        <a class="btn btn-success btn-sm btn-grad" href="{{asset('cotizacion')}}">Nuevo</a>
                    </div>
                </header>
            <div class="panel-body">
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
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   
<script type="text/javascript">    
         $(document).ready(function () {
             $('#invoices-datatable').dataTable({
                "bLengthChange": false,
                "pageLength": 100,  
                 "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
  
             });
         });
</script>
@stop