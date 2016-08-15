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
                              <td><input type="text" placeholder="C&oacute;digo" class="busqueda" id="BusquedaCodigo"></td>
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
                        </thead>
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
                    <div class="mostrar"></div>
                    <center>
                    <div class="pagination">
                      <ul class="pagination">
                        <li class="primero">
                          <button class="btn btn-primary next" value="1">1</button>
                          <button class="btn btn-default next" value="1" disabled>...</button>
                            <button class="btn btn-default next" value="2"> >> </button>
                        </li>
                        <li class="siguiente"></li>
                        </li>
                      </ul>
                   </div>
                 </center>
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
  pagina = 0;

  $.ajax({
    type: 'GET',
    url: '{{ URL::to("productos/busqueda")}}',
    data: 'codigo='+codigo+'&nombre='+nombre+'&precio='+precio+'&descripcion='+descripcion+'&pagina='+pagina,
    beforeSend: function(){
      console.log("Inicia ajax con ");
    },
    success: function(data){
      $('.ParentPro').remove();
      var d = "";
      console.log(data);
      // console.log(data["products"][0].name);
      paginate(data);
      for (i=0; i< data["products"].length; i++)
      {
        codigo = "<td>"+data["products"][i].code+"</td>";
        nombre = "<td>"+data["products"][i].name+"</td>";
        precio = "<td>"+data["products"][i].price+"</td>";
        descripcion = "<td>"+data["products"][i].description+"</td>";
        id = data["products"][i].id;
        indice = "<td><a class='btn btn-primary btn-xs' href='../producto/"+data["products"][i].public_id+"'><i class='icon-eye-open'></i> Ver</a></td>";
        $('#productos-datatable').append("<tr class='odd gradeX ParentPro' >"+codigo+nombre+precio+descripcion+indice+"</tr>");
      }
      // $('#productos-datatable').dataTable();

    }
  })
});
//probando si funciona  paginador
$(document).on("click", ".next", function(){
  val = $(this).val();
  // alert(val);
  var codigo = "";
  codigo = $('#BusquedaCodigo').val();
  nombre = $('#BusquedaNombre').val();
  precio = $('#BusquedaPrecio').val();
  descripcion = $('#BusquedaDescripcion').val();
  pagina = val;

  $.ajax({
    type: 'GET',
    url: '{{ URL::to("productos/busqueda")}}',
    data: 'codigo='+codigo+'&nombre='+nombre+'&precio='+precio+'&descripcion='+descripcion+'&pagina='+pagina,
    beforeSend: function(){
      console.log("Inicia ajax con ");
    },
    success: function(data){
      $('.ParentPro').remove();
      var d = "";
      console.log(data);
      // console.log(data["products"][0].name);
      paginate(data);
      for (i=0; i< data["products"].length; i++)
      {
        codigo = "<td>"+data["products"][i].code+"</td>";
        nombre = "<td>"+data["products"][i].name+"</td>";
        precio = "<td>"+data["products"][i].price+"</td>";
        descripcion = "<td>"+data["products"][i].description+"</td>";
        id = data["products"][i].id;
        indice = "<td><a class='btn btn-primary btn-xs' href='../producto/"+data["products"][i].public_id+"'><i class='icon-eye-open'></i> Ver</a></td>";
        $('#productos-datatable').append("<tr class='odd gradeX ParentPro' >"+codigo+nombre+precio+descripcion+indice+"</tr>");
      }
      // $('#productos-datatable').dataTable();

    }
  })
});
// fin prueba

function paginate(data){
  $('.actual').remove();
  $('.next').remove();
  $('.ver').remove();
  act = data.actual - 1;
  $('.primero').append("<button class=\"btn btn-default next\" value="+act+"> << </button>");
  if(data.actual != 1 ){
      $('.primero').append("<button class=\"btn btn-default next\" disabled> ... </button>");
  }

  $('.primero').append("<button class=\"btn btn-primary next\" value="+act+">"+data.actual+"</button>");

  if( data.actual != data.total_paginas){
      $('.siguiente').append("<button class=\"btn btn-default next\" value="+data.siguiente+">"+data.siguiente+"</button>");
      $('.siguiente').append("<button class=\"btn btn-default next\" disabled> ... </button>");
  }
  $('.siguiente').append("<button class=\"btn btn-default next\" value="+data.siguiente+"> >> </button>");
  $('.mostrar').append("<p class=\"ver\">Total : <b>"+data.total_registros+"</b> encontrados</p>");
}

</script>
@stop