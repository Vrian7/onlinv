@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Sucursales / Dosificaciones</h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Listado de Sucursales/Dosificaciones</h5>
                    <div class="toolbar">
                        <a class="btn btn-success btn-sm btn-grad" href="{{asset('sucursal')}}">Nuevo</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="sucursales-datatable">
                        <thead>
                            <tr>
                                <th class="col-md-1">Id</th>
                                <th class="col-md-3">Nombre</th>
                                <th class="col-md-3">Actividad</th>
                                <th class="col-md-2">Ciudad</th>
                                <th class="col-md-2">Vence</th>
                                <th class="col-md-1">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $branches as $branch)
                            <tr class="odd gradeX">
                                <td>{{ $branch->public_id }}</td>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->economic_activity }}</td>
                                <td class="center">{{ $branch->city }}</td>
                                <td class="center">{{ $branch->deadline }}</td>
                                <td class="center">
                                    <a class="btn btn-primary btn-xs" href="{{asset('sucursal/'.$branch->public_id)}}">
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
             $('#sucursales-datatable').dataTable({
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