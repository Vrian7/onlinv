@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Inventarios </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Listado de Asignaci&oacute;n de inventarios</h5>
                    <div class="toolbar">
                        <a class="btn btn-success btn-sm btn-grad" href="{{asset('inventario')}}">Nuevo</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="inventories-datatable">
                        <thead>
                            <tr>
                                <th class="col-md-1">Id</th>
                                <th class="col-md-3">Producto</th>
                                <th class="col-md-3">Sucursal</th>
                                <th class="col-md-2">Existancia</th>                                
                                <th class="col-md-1">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $inventories as $inventory)
                            <tr class="odd gradeX">
                                <td>{{ $inventory->public_id }}</td>
                                <td>{{ $inventory->product }}</td>
                                <td>{{ $inventory->branch }}</td>
                                <td class="center">
                                    <div class="progress progress-striped active">
                                        @if($inventory->stock > $inventory->average)                                        
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                        @endif               
                                        @if($inventory->stock<=$inventory->average && $inventory->stock > $inventory->minimum)
                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$inventory->stock*100/$inventory->average}}%;">
                                        @endif                                        
                                        @if($inventory->stock<=$inventory->minimum)
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$inventory->stock*100/$inventory->average}}%;">
                                        @endif                                                                 
                                        {{$inventory->stock}}
                                    </div>
                                    
                                </td>                                
                                <td class="center">
                                    <a class="btn btn-primary btn-xs" href="{{asset('inventario/'.$inventory->public_id)}}">
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
             $('#inventories-datatable').dataTable({
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