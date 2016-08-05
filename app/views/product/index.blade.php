@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Productos </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Listado de Productos</h5>
                    <div class="toolbar">
                        <a class="btn btn-success btn-sm btn-grad" href="{{asset('producto')}}">Nuevo</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="productos-datatable">
                        <thead>
                          <tr>
                              <td><input type="text" placeholder="C&oacute;digo" class="busqueda" value="2" id="BusquedaCodigo"></td>
                              <td><input type="text" placeholder="Nombre" class="busqueda" id="BusquedaNombre"></td>
                              <td><input type="text" placeholder="Precio" class="busqueda" id="BusquedaPrecio"></td>
                              <td><input type="text" placeholder="Descripci&oacute;n" class="busqueda" id="BusquedaDescripcion"></td>
                              <td>&nbsp;</td>
                          </tr>
                            <tr>
                                <th class="col-md-1">C&oacute;digo</th>
                                <th class="col-md-3">Nombre</th>
                                <th class="col-md-3">Precio</th>
                                <th class="col-md-2">Descripci&oacute;n</th>
                                <th class="col-md-1">Ver</th>
                            </tr>
                        </thead>BusquedaCodigo
                        <tbody>
                            @foreach( $products as $product)
                            <tr class="odd gradeX ParentPro">
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td class="center">{{ $product->description }}</td>
                                <td class="center">
                                    <a class="btn btn-primary btn-xs" href="{{asset('producto/'.$product->public_id)}}">
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

$('.busqueda').keyup(function(){
  var codigo = "";
  codigo = $('#BusquedaCodigo').val();
  nombre = $('#BusquedaNombre').val();
  precio = $('#BusquedaPrecio').val();
  descripcion = $('#BusquedaDescripcion').val();
  $.ajax({
    type: 'GET',
    url: '{{ URL::to("productos/busqueda")}}',
    data: 'codigo='+codigo+'&nombre='+nombre+'&precio='+precio+'&descripcion='+descripcion,
    beforeSend: function(){
      console.log("Inicia ajax con ");
    },
    success: function(data){
      $('.ParentPro').remove();
      var d = "";
      console.log(data);

      for (i=0; i< data["data"].length; i++)
      {
        codigo = "<td>"+data["data"][i].code+"</td>";
        nombre = "<td>"+data["data"][i].name+"</td>";
        precio = "<td>"+data["data"][i].price+"</td>";
        descripcion = "<td>"+data["data"][i].description+"</td>";
        id = data["data"][i].id;
        indice = "<td><a class='btn btn-primary btn-xs' href='../producto/"+data["data"][i].id+"'><i class='icon-eye-open'></i> Ver</a></td>";
        $('#productos-datatable').append("<tr class='odd gradeX ParentPro' >"+codigo+nombre+precio+descripcion+indice+"</tr>");
      }
      $('#productos-datatable').dataTable();

    }
  })
});

//      $(document).ready(function () {
//          $('#productos-datatable').dataTable({
//             "bLengthChange": false,
//             "pageLength": 100,
//              "language": {
//     "sProcessing":    "Procesando...",
//     "sLengthMenu":    "Mostrar _MENU_ registros",
//     "sZeroRecords":   "No se encontraron resultados",
//     "sEmptyTable":    "Ningún dato disponible en esta tabla",
//     "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//     "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
//     "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
//     "sInfoPostFix":   "",
//     "sSearch":        "Buscar:",
//     "sUrl":           "",
//     "sInfoThousands":  ",",
//     "sLoadingRecords": "Cargando...",
//     "oPaginate": {
//         "sFirst":    "Primero",
//         "sLast":    "Último",
//         "sNext":    "Siguiente",
//         "sPrevious": "Anterior"
//     },
//     "oAria": {
//         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//     }
// }
//
//          });
//      });


</script>
@stop
