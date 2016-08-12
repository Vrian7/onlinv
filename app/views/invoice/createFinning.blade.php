@extends('header')
@section('body')
{{ HTML::style('vendor/select2/select2.min.css') }}
<style type="text/css">
 table thead th, table thead td {
  padding: 10px 18px;
  border-bottom: 1px solid #111;
}
.modal.vista .modal-dialog { width: 75%; }
.centertext{
        text-align:center;
      }
      .derecha{
        text-align:right;
      }
</style>
<div class="inner">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">Nueva Factura</h3>
    </div>
  </div>  
  <div class="col-lg-12">
    <div class="panel box dark">
      <header>
        <div class="icons"><i class="icon-home"></i></div>
        <h5>Emitir Factura</h5>
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
                </li>
                <li>
                    <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                        <i class="icon-chevron-up"></i>
                    </a>
                </li> -->
            </ul>
        </div>
      </header>         
      <div id="div-1" class="accordion-body collapse in body">
        <form class="form-horizontal" method="POST" id="main_form" action="{{asset('factura')}}">                  
          <div class="form-group col-lg-4">
              <label>Cliente</label>
              <!-- <select id="client" name="client" onchange="addValuesClient(this)" class="form-control js-data-example-ajax">
              </select> -->
              <div class="form-group input-group">
                <input type="text" name="client_nit" class="form-control" placeholder="0" id="client_nit" />
              <span class="input-group-btn">
              <a class="btn btn-default" id="search_client" type="button">
              <i class="icon-search"></i>
              </a>
              </span>
              </div>
              <div id="divrazon">
              <p class="razon_text"><strong>Sin Nombre</strong> <a><i class="icon-pencil"></i></a></p> 
              </div>              
              <!-- <p >Ingrese el NIT o CI del clieadsfadfnte.</p>  -->
          </div>
          <div class="form-group col-lg-4">
          <!-- <label>Cliente</label>
            <input type="text" name="client" class="form-control" id="client" /> -->
          </div>
          <div class="form-group col-lg-4">
          <label>Fecha de emisi&oacute;n</label>
          <div class="form-group input-group">
              
              <input type="text" name="date" readonly class="form-control" data-date-format="dd/mm/yyyy" id="date" /> 
              <span class="input-group-btn">
              <a class="btn btn-default" type="button" id='icondate'>
              <i class="icon-calendar"></i>
              </a>
              </span>
              </div>                
          </div>  
          <p></p>
        <input id="client" type="hidden" name="client" value="{{$nit}}" >
        <input id="nombre" type="hidden" name="nombre" >
        <input id="nit" placeholder="NIT"  type="hidden" name="nit" value="0">
        <input id="razon"  placeholder="Razón Social" type="hidden" name="razon" value="Sin Nombre">
        <input id="total_send" type="hidden" name="total" >
        <input id="descuento_send" type="hidden" name="descuento_send" >
        <input id="subtotal_send" type="hidden" name="subtotal" >                   
        
          <table id="tableb" cellpadding="0" cellspacing="0" class="col-lg-12"> 
            <tbody>            
              <tr>
                <th class="col-lg-1">C&oacute;digo</th>
                <th class="col-lg-7">Concepto</th>
                <th class="col-lg-1">Costo Unitario</th>
                <th class="col-lg-1">Cantidad</th>
                <th class="col-lg-1">Subtotal</th>
                <th class="col-lg-1" style="display:none;"></th>          
              </tr>
              <tr class="new_row" id="new_row1">
                <td><input id="code1" readonly class="code form-control" name="productos[0][code]"></td>
                <td><input id="notes1" class="form-control notes" disabled name="productos[0][name]"></td>    
                <td><input class="form-control cost centertext number_field" disabled id="cost1" name="productos[0][price]"></td>
                <td><input class="form-control qty centertext number_field" disabled id="qty1" name="productos[0][quantity]"></td>
                <td><input class="form-control derecha" disabled value='0' id="subtotal1"></td>
                <td>
                  <div for="inputError">
                    <span class="killit" id="killit1" style="color:green" >&nbsp;<i class="icon-ok-sign"></i></span>
                  </div>
                </td>
              </tr>                
              </tbody>
            </table>
            <br>    
            <div class="col-lg-8">
              <div class="form-group input-group">
                <input type="text" name="code_product" class="form-control" placeholder="Ingrese c&oacute;digo de producto" id="searchCodeProduct" />
              <span class="input-group-btn">
              <a class="btn btn-default" id="search_single_product" type="button">
              <i class="icon-plus"></i>
              </a>
              </span>
              </div>
            </div>                
            <div class="col-lg-2">
              <label>Total</label>
              <br>
              <div class=""><label>Desc.</label>
              BS<input class="uniform" type="radio" name="desc" id="descbol" value="1" checked="checked" />
              % <input class="uniform" type="radio" name="desc"id="descper" value="2"/>
              </div>
              <br>
              <h4><label>Total a pagar</label></h4>
            </div>
            <div class="col-lg-1 derecha">
              <label id="subtotal" >0</label>
            <br>
            <input class="form-control derecha" name="discount" value='0' id="discount">        
            <!-- <label id="descuento_box">0</label> -->
            <br>
            <h4><label id="total">0</label></h4>
            </div>

            <div class="col-lg-1"></div>                        
            <div class="col-lg-12">

            <div class="col-lg-3"></div>
            <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('facturas')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
            <div class="col-lg-2"> <a type="button" class="btn btn-info" id="preview_btn"><i class="icon-eye-open"></i> Previsualizar</a></div>
            <div class="col-lg-2"><button class="btn btn-success" type="submit"><i class="icon-save icon-white"></i> Emitir</button></div> 
            <div class="col-lg-3"></div>            
            </div>
          </form>
        </div><!-- div body-->
      </div> <!-- div pannel-->
    </div> <!-- first div-->
  </div> <!-- Class iner-->

   <div class="modal vista fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Vista Previa Factura</h4>
          </div>
          <div class="modal-body col-lg-12">
          <iframe id="invoice_frame" type="text/html" frameborder="1" width="100%" height="800"></iframe>        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </div>
      </div>
     </div>
  </div>
  <div class="modal fade" id="select_client" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Selecione Cliente</h4>
          </div>
          <div id ="many_clients" class="modal-body col-lg-12">                  
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </div> -->
      </div>
     </div>
  </div>
{{ HTML::script('vendor/select2/select2.full.min.js') }}

<script type="text/javascript">
/*** DATE ***/
$("#date").datepicker({
  minDate: {{$min_date}},
  maxDate: '+0D',
}).datepicker("setDate", {{$today}});

$('#date').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
$("#icondate").click(function(){
    $("#date").datepicker('show');    
});
/*** END DATE***/
select_clients=[];
ind_act = 1;
$("#search_client").click(function(){
  nit = $("#client_nit").val();
  $.ajax({
        type: 'GET',
        url:'{{ URL::to('obtener_clientes') }}',
        data: 'nit='+nit,
        beforeSend: function(){ 
          console.log("Starting send data ");
        },
        success: function(result)
        {        
          if(result.length == 0)
            {
              $(".razon_text").remove();  
              $("#divrazon").append('<input id=\"razon_new\" type=\"text\" name=\"razon_text\" placeholder=\"Ingrese nueva razon social\" class=\" razon_text form-control\" />');
              $("#client").val(0);
            }
          if(result.length == 1){
            result.forEach(function(res) {                      
              $(".razon_text").remove();
              $("#divrazon").append('<p class="razon_text"><strong>'+res.business_name+'</strong> <a><i class=\"icon-pencil\"></i></a></p> ');
              if(res.description==null){ res.description = '';}
              $("#divrazon").append('<p class=\"razon_text\">'+res.name+': '+res.description+'</p>');
              $("#razon").val(res.business_name);
              $("#client").val(res.id);
              $("#nit").val(res.nit);                      
            });
          }
          if(result.length > 1){
            $("#select_client").modal('show');  
            select_clients = result;
            $(".many_clients").remove();
            result.forEach(function(res) {        
              $("#many_clients").append('<a class=\"many_clients\" data-dismiss=\"modal\">'+res.name+'</a><br>');
            });
            
          }
        }
    });
//$("#select_client").modal('show');  
});
$("#client_nit").change(function(){
  $("#nit").val($(this).val());
});
$(document).on("change",'#razon_new',function(){
  $("#razon").val($(this).val());
});
/*** ENDDATE ***/
/*** PREVIEW ***/
//$("#select_client").modal('show');  
$('#preview_btn').click(function(){
  var datos = $('#main_form').serialize();
    $('#invoice_frame').attr('src', '{{asset("factura/nuevo/previsualizar?'+datos+'")}}' );
    $('#preview').modal('show');  
});
/*$(".razon_text").click(function(){
  $(".razon_text").remove();

  $("#divrazon").append('<input type=\"text\" name=\"razon_text\" placeholder=\"Ingrese nueva razon social\" class=\"form-control\" />');
  
});*/
$(document).on("click",'.icon-pencil',function(){
$(".razon_text").remove();
  $("#divrazon").append('<input id=\"razon_new\" type=\"text\" name=\"razon_text\" placeholder=\"Ingrese nueva razon social\" class=\" razon_text form-control\" />');
});
$(document).on("click",'.many_clients',function(){    
  $("#nombre").val($(this).text());
  $(".razon_text").remove();
  select_clients.forEach(function(cli){  
    if(cli.name == $("#nombre").val()){
      $("#divrazon").append('<p class=\"razon_text\"><strong>'+cli.business_name+'</strong> <a><i class=\"icon-pencil\"></i></a></p> ');
      $("#divrazon").append('<p class=\"razon_text\">'+cli.name+': '+cli.description+'</p>');
      $("#razon").val(cli.business_name);
      $("#client").val(cli.id);
      $("#nit").val(cli.nit);                 
    }     
  });
});
/*** ENDPREVIEW***/
$(".select2").select2();
    //$("#brian").select2();
    $('#tabs').tab();
    //**********VALIDACION DE DESCUENTO
    $("#discount").keyup(function(){
        number = $("#discount").val();
        if(isNaN(number)){
            $("#discount").val(number.substr(0,number.length-1));
        }
        else{
            if($("#descper").prop('checked'))
                if(number>=100)
                    $("#discount").val(99);
            else
                console.log("descuento"+number);
        }
    });
    //********************
{{--
//$("#desc").bootstrapSwitch();

$("#desc").on('switchChange.bootstrapSwitch',function(e, data){
    calculateAllTotal( $("#desc").prop('checked'));
    if($("#desc").prop('checked'))
        $("#desc").siblings(".bootstrap-switch-label").text("{{$moneda}}");
    else
        $("#desc").siblings(".bootstrap-switch-label").text("%");
    

});--}}

$(document).on('keyup','.number_field',function(){
  number = $(this).val();
  console.log(number);
  cad = number.split('.'); 
  if(typeof cad[1]==='undefined') 
    cad[1]="";
  if(isNaN(number) || cad[1].length>2){
      $(this).val(number.substr(0,number.length-1));
  }  
});

$("#descbol").change(function(){
  console.log($("#descbol").prop('checked')+"JAELIN!!!");
    calculateAllTotal( $("#descbol").prop('checked'));
});
$("#descper").change(function(){
  console.log($("#descbol").prop('checked')+"JAELIN!!!");

    calculateAllTotal( $("#descbol").prop('checked'));
});
//$("#model_invoice").change(function(){
//    console.log("jasfsasdjk");
////    if($("#model_invoice").prop('checked')){
////        console.log("yes");
////     $("#printer_type").val("1");
////    }
////    else
////    {
////        console.log("no");
////
////        $("#printer_type").val("0");
////    }
//});
function fillInvoice(){
    return "dato=1";
}
//$('#preview').click(function(e) {
//        if(parseInt($("#total").text())==0)            {
//            alert("Su descuento es mayor a su monto");
//            e.preventDefault();
//            //return false;
//        }
//        return true; // return false to cancel form action
//    });
//$('#switch').bootstrapToggle();
function preview()
{
    if(parseInt($("#total").text())==0)            {
            alert("Su descuento es mayor o igual a su monto");
}
else{
    var datos = $('#formulario').serialize();
    $('#theFrame2').attr('src', '{{asset("previsualizacion/factura?'+datos+'")}}' );
    $('#preview').modal('show');}

}
/*********************SECCION PARA EL MANEJO DINAMICO DE LOS CLIENTES************************/


$('#killit1').css('cursor', 'pointer');
$("#cost1").val('').prop('disabled', true);
$("#qty1").val('').prop('disabled', true);
$("#notes1").val('').prop('disabled', true);
$('#discount').val("0");
$("#due_date").val('');
$("#public_notes").val('');
$("#terms").val('');
$('#subtotal1').val('').prop('disabled', true);
$('#notes1').val('');
$('#nota').val('');
//$(document).css('cursor','.notes');

// function verr(){

// }
$("#client").change(function(){
  if($("#client").val()+"" == "null")
    $("#sub_boton").prop('disabled', false);
  else
    $("#sub_boton").prop('disabled', true);
});

function sendMail()
{
  $("#mail").val("1");
}
$("#email").click(function(){
  $("#mail").val("1");
});
/****Inicializacion de variables globales para la factura****/
var products = {{ $products }};
var selected_products=[];
var total = 0;
var subtotal = 0;
var id_products = 1;
var changing_code = false;
var changing_note = false;



// $(".code").select2();
// $(".notes1").select2();
//addProducts(1);
var productos = {{ $products }};
console.log(productos[0]);

$selectObject = $("#selectableproducts").select2({
  placeholder: "Buscar producto/servicio por  código o descripción",
  allowClear: true,
  language: "es",  
  width: 'resolve',
});

$("#selectableproducts").change(function(){  
  indice = $("#selectableproducts").val();
  if(!(typeof productos[indice] === "undefined")){
  console.log(productos[indice]['product_key']+"<<<<<<llll"+indice+"<-");
  addProducts(id_products,indice);  
  calculateAllTotal();
  id_products++;
  console.log(">>>>>>");
}
//else {console.log("adfasdf");}
});

function addProducts(id_act,indice)
{
  console.log("entra a esta opcion");
  prod_to_add=[];
  //products.forEach(function(prod) {
    
      //  prod_to_add.push(prod['notes']);
    //    $("#code"+id_act).select2({data: [{id: prod['product_key'], text: prod['product_key']}]});      
  //});
  completeItem(id_act,indice);  
  $("#selectableproducts").val('').trigger('change');
  $("#new_row"+id_act).show();  
  $(".select2-selection__rendered").attr("title","");
  /*$( "#notes"+id_act).autocomplete({
        minLength: 0,
        source: prod_to_add,
      select: function(event, ui) {
        completeItem(id_act,ui.item.value);
   },
   change: function(event, ui)
   {
    try
    {
        if(event.originalEvent.type != "menuselected")
        {
            console.log("menuselected");
        }
    }
    catch(err){
        console.log("Fucking error");
    }
   }
  });*/
/*
  $.ui.autocomplete.filter = function (array, term) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
        return $.grep(array, function (value) {
            return matcher.test(value.label || value.value || value);
        });
    };*/
}
function addProduct(product_gotten){
    $("#code"+ind_act).val(product_gotten['code']).trigger("change");
    $("#notes"+ind_act).val(product_gotten['name']).prop('disabled', false);
    $("#cost"+ind_act).val(product_gotten['price']).prop('disabled', false);
    $("#qty"+ind_act).val(1).prop('disabled', false);
    $("#subtotal"+ind_act).val(parseFloat(product_gotten['price']).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));    
    $("#new_row"+ind_act).show();
    $(".select2-selection__rendered").attr("title","");    
    ind_act ++;
}
function matchStart (term, text) {
  if (text.toUpperCase().indexOf(term.toUpperCase()) == 0) {
    return true;
  }

  return false;
}
/*$.fn.select2.amd.require(['select2/compat/matcher'], function (oldMatcher) {
  $(".code").select2({
    matcher: oldMatcher(matchStart)
  })
});*/

/*$(".code").select2({
  placeholder: "Código"
});*/
//$(".notes").select2({
//  placeholder: "Concepto",
//
//  //minimumInputLength: 3,
//});
$(document).on('focus', '.select2', function() {
    $(this).siblings('select').select2('open');
});
$("#search_single_product").click(function(){
  //console.log("adfasdf");
  //console.log($("#searchCodeProduct").val());    
  code = $("#searchCodeProduct").val();
  $.ajax({
        type: 'GET',
        url:'{{ URL::to('searchProduct') }}',
        data: 'code='+code,
        beforeSend: function(){
          console.log("Inicia ajax client register ");
        },
        success: function(result)
        {
          console.log(result);      
          //$('#tableb').append(addNewRow());
          //id_products++;
          id_products++;
          $('#tableb').append(addNewRow());
          $('#killit'+ind_act).css('cursor', 'pointer');
          addProduct(result);          
          calculateAllTotal();
          //addProduct();
        }
  });
});
    /***buscado de clientes por ajax***/
/*$("#client").select2({
  ajax: {
    Type: 'POST',
    url: "{{ URL::to('buscar_cliente') }}",
    data: function (params) {
      return {
        name: params.term, // search term
        page: params.page
      };
  },
    processResults: function (data, page) {
    act_clients = data;
      return {
        results: $.map(data, function (item) {
                return {
                    text: item.nit+" - "+item.name,
                    title: item.business_name,
                    id: item.id//account_id
                }
            })
      };
    },
    cache: true
    },
  escapeMarkup: function (markup) { return markup; },
  minimumInputLength: 1,
  placeholder: "NIT o Razon Social",
  allowClear: true,
  language: "es",
});*/

//$('#client').select2('data', {id:103, label:'ENABLED_FROM_JS'});    
    /*****AGREGA VALORES RAZON Y NIT****/
    function addValuesClient(dato){
      $(".contact_add").hide();
    id_client_selected = $(dato).val();
    act_clients.forEach(function(cli) {
      if(id_client_selected == cli['id'])
      {
        $("#nombre").val(cli['name']);
        $("#razon").val(cli['business_name']).show();
        $("#nit").val(cli["nit"]).show();
        agregarContactos(cli['id']);

      }
    });

    $("#sub_boton").prop('disabled', false);  
    }
    function emptyRows(){
    cont = 0;
    $( ".new_row" ).each(function( index ) {
      act_id = this.id.substring(7);
      valor = $("#code"+act_id).val();
      if(valor == "")
        cont++;
    });
    return cont;
    }

  function saveNewClient()
  {
    user = $("#newuser").val();
    nit = $("#newnit").val();
    razon = $("#newrazon").val();
    id =null;

    $.ajax({
          type: 'POST',
          url:'{{ URL::to('clientes') }}',
          data: 'business_name='+razon+'&nit='+nit+'&name='+user+'&json=1',
          beforeSend: function(){
            console.log("Inicia ajax client register ");
          },
          success: function(result)
          {
            console.log(result);
            console.log(result['nit']);
            $('#nit').val(result['nit']);
            $('#nombre').val(result['name']);
            $('#razon').val(result['business_name']);            
            $("#client_id2").val(result['id']);
            $("#sub_boton").prop('disabled', false);
          }
      });

    $("#client").select2({
        ajax: {
          Type: 'POST',
          url: "{{ URL::to('obtenercliente') }}",
          data: function (params) {
            return {
              name: params.term, // search term
              page: params.page
            };
        },
          processResults: function (data, page) {
          act_clients = data;
            return {
              results: $.map(data, function (item) {
                      return {
                          text: item.nit+" - "+item.name,
                          title: item.business_name,
                          id: item.id//account_id
                      }
                  })
            };
          },
          cache: true
          },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
        placeholder: "NIT o Nombre",
        allowClear: true,
        initSelection : function (element, callback) {
          console.log('resiviendo valores');

        var data = {id: id, text: nit+' - '+user};

        callback(data);

        }});
    addValuesClient($("#client :selected"));      

  }

/*******************FECHAS Y DESCUENTOS*************************/
///$("#invoice_date").datepicker(/*"update", new Date()*/);
//$("#invoice_date").datepicker({  endDate: '+2d' });
    //$("#dp3").bootstrapDP();
last_invoice_date = {{$last_invoice_date}};
last_invoice_date = '-'+last_invoice_date+'D';
//console.log("-->>>><"+last_invoice_date);
$( "#invoice_date" ).datepicker({ minDate: last_invoice_date, maxDate: "+0D" }).datepicker({ dateFormat: 'dd-mm-yy' }).datepicker("setDate", new Date());
$("#due_date").datepicker();
$('#invoice_date').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
$('#due_date').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
$(".emision_icon").click(function(){
    $("#invoice_date").datepicker('show');
});
$(".vencimiento_icon").click(function(){
    $("#due_date").datepicker('show');
});

/*********************MANEJO DE LA TABLA DE PRODUCTOS Y SERVICIOS DE FACTURAICON******************************/
/***Obtencion de valores ****/

function getProductsKey(){
  var keys = [];
  products.forEach(function(prod){
      keys.push(prod['product_key']);
  });
  return keys;
}
function getProductsName(){
  var names=[];
  products.forEach(function(prod){
      names.push(prod['notes']);
  });
  return names;
}

  // $(function() {
  //    availableTags = getProductsName();
  //   $( "#notes1" ).autocomplete({
  //     minLength: 0,
  //     source: availableTags
  //   });
  // });

// $.ui.autocomplete.filter = function (array, term) {
//         var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
//         return $.grep(array, function (value) {
//             return matcher.test(value.label || value.value || value);
//         });
//     };

// $(document).on('click','.notes', function(){
//   $("#"+this.id).autocomplete( "search", "" );
// });
$(document).on('mouseover','.new_row',function(){
  val = this.id.substring(7);
  console.log("asdfadf "+val);
  $("#killit"+val).children().removeClass("icon-ok-sign");
  $("#killit"+val).children().addClass('icon-remove-sign');
  $("#killit"+val).css('color','red').show();
  //$("#killit"+val).css('color','green');
});
$(document).on('mouseout','.new_row',function(){
  val = this.id.substring(7);
  $("#killit"+val).css('color','green');
  $("#killit"+val).children().removeClass('icon-remove-sign');
  $("#killit"+val).children().addClass("icon-ok-sign");
  
  //$("#killit"+val).hide();
});


function calculateTotal()
{
  sum = 0;
  // //se optimiza solo tomando los valores de subtotal
  $( ".cost" ).each(function( index ) {
  valor = $("#"+this.id).val();
  ind= this.id.substring(4);
  canti = $("#qty"+ind).val();
  console.log(ind);
  if(valor){
    valor = canti * valor;
    sum = parseFloat(valor)+sum;
  }

  });
  //sum = parseFloat($("#subtotal").text());
  console.log(sum);
  dis= $("#discount").val();
  dis = (parseFloat(dis)*sum)/100;

  sum = sum - dis;
  //$("#descuento_box").val(dis.toFixed(2));
  $("#total").text(sum.toFixed(2));
  $("#total_send").val(sum);

}
function calculateSubTotal()
{
    sum = 0;
  $( ".cost" ).each(function( index ) {
  valor = $("#"+this.id).val();
  ind= this.id.substring(4);
  canti = $("#qty"+ind).val();
  console.log(ind);
  if(valor){
    valor = canti * valor;
    sum = parseFloat(valor)+sum;
  }
  });

  $("#subtotal").text(parseFloat(sum).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
  $("#subtotal_send").val(sum);
}
function calculateAllTotal(){
    sum = 0;
  $( ".cost" ).each(function( index ) {
    valor = $("#"+this.id).val();
    ind= this.id.substring(4);
    canti = $("#qty"+ind).val();

    if(valor && canti){
      console.log("calculando el total");
      valor = canti * valor;
      valor = parseFloat(valor).toFixed(2);

      sum = parseFloat(valor)+sum;
    }
  });
  $("#subtotal").text(parseFloat(sum).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
  $("#subtotal_send").val(sum);
  dis= $("#discount").val();
  if($("#descper").prop('checked'))
    dis = (parseFloat(dis)*sum)/100;
    else
        dis=parseFloat(dis);
  sum = sum - dis;
  //$("#descuento_box").val(dis.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
  $("#descuento_send").val(dis);
  if(sum<0)sum=0;
  //n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
  $("#total").text(sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
  $("#total_send").val(sum);
}

function addContactToSend2(id,name,mail,ind_con,tel){
  div ="<div class='form-group .contact_add'>";// "<div class='col-lg-12' id='sendcontacts'>";
  ide = "<input type='hidden' id='contact_id' value='"+id+"' name='contactos["+ind_con+"][id]'>";
  nombre = "<input  disabled id='contact_name' value='"+name+"'name='contactos["+ind_con+"][name]'>";
  correo = "<input   disabled id='contact_mail' value='"+mail+"'name='contactos["+ind_con+"][cmail]'>";
  tel = "<input   disabled id='contact_tel' value='"+tel+"'name='contactos["+ind_con+"][tel]'>";
  //send = "<input  type='checkbox' name='contactos["+ind_con+"][checked]'>";
  findiv = "</div>";
  $("#contactos_client").append(div+ide+nombre+correo+tel+findiv);
}

function addContactToSend(id,name,mail,ind_con,tel){
  div ="<div class='form-group contact_add'>";// "<div class='col-lg-12' id='sendcontacts'>";
  ide = "";//<input type='hidden' id='contact_id' value='"+id+"' name='contactos["+ind_con+"][id]'>";
  if(name != " "){
  nombre = "<div class='col-lg-1'></div><label><i class='fa fa-user'></i>&nbsp;<b>"+name+"</b></label><br>";
  }
  else{
    nombre = "<div class='col-lg-1'></div><label><i class='fa fa-user'></i>&nbsp;<b>Sin Nombre</b></label><br>";
  }
  if(mail != null){
    correo = "<div class='col-lg-1'></div><i class='fa fa-envelope'></i>&nbsp;<a  href='mailto:"+mail+"'>"+mail+"</a><br>";
  }
  else {
    correo = "<div class='col-lg-1'></div><i class='fa fa-envelope'></i>&nbsp;Sin Correo</a><br>";
  }
  if(tel != null){
  tel = "<div class='col-lg-1'></div><i class='fa fa-phone'></i>&nbsp;<a href='tel:"+tel+"'>"+tel+"</a><br>";
  }
  else {
    tel = "<div class='col-lg-1'></div><i class='fa fa-phone'></i>&nbsp;Sin Telefono</a><br>";
  }
  //correo = "<input   disabled id='contact_mail' value='"+mail+"'name='contactos["+ind_con+"][cmail]'>";
  //tel = "<input   disabled id='contact_tel' value='"+tel+"'name='contactos["+ind_con+"][tel]'>";
  //send = "<input  type='checkbox' name='contactos["+ind_con+"][checked]'>";
  findiv = "</div><hr class='contact_add'>";
  $("#contactos_client").append(div+ide+nombre+correo+tel+findiv);
  $(".ui-tooltip").hide();
}
function addClientNote(note){
  div ="<div class='form-group contact_add'>";// "<div class='col-lg-12' id='sendcontacts'>";
  nombre = "<div class='col-lg-1'></div><label>&nbsp;<b>"+note+"</b></label><br>";
  findiv = "</div><hr class='contact_add'>";
  $("#contactos_client").append(div+nombre+findiv);
  $(".ui-tooltip").hide();
}

// $(document).on("autocompleteclose",'.notes',function(event,ui){
//   code = $("#"+this.id).val();
//   console.log(code);
//   updateRowName(code,this.id.substring(5));

//   $('#tableb').append(addNewRow());

//   addProducts(id_products);

// $("#code"+id_products).select2({
//   placeholder: "Código"
// });
// $("#notes"+id_products).select2({
//   placeholder: "Concepto"
// });

//     //var productKey = "#product_key"+(idProducts);
//     //addProducts(idProducts);
//     $('.killit').css('cursor', 'pointer');
//     id_products++;
// });


$(document).on("change",'.code',function(){

  if(changing_note)
  {
    changing_note = false;
    return 0;
  }
  code = $("#"+this.id).val();
  ind_act = this.id.substring(4);

  changing_code = true;  
  //calculateAllTotal();
   $.when($.ajax(calculateAllTotal())).then(function () {

    if(emptyRows()<1){
  $('#tableb').append(addNewRow());
  $('#killit'+id_products).css('cursor', 'pointer');
  addProducts(id_products);

  $("#code"+id_products).select2({
    placeholder: "Código"
  });
  id_products++;
  }
    });
});
$("#sub_boton").mouseover(function(){
  cli=$("#client").val();
  val = 1;
  if(cli==""){
    $("#sub_boton").prop('disabled', false);
    return 0;
  }
  num =0;

  $(".new_row").each(function( index ) {
    act = this.id.substring(7);
    code = $("#code"+act).val();
    num++;
  });
  if(num == 1)
  {
    console.log("solo1");
    if(code == "")
      $("#sub_boton").prop('disabled', true);
    else
      $("#sub_boton").prop('disabled', false);
  }
  else
    $("#sub_boton").prop('disabled', false);
});
function completeItem(ind_act,index){
    
      $("#code"+ind_act).val(productos[index]['code']).trigger("change");
      $("#notes"+ind_act).val(productos[index]['name']).prop('disabled', false);
      $("#cost"+ind_act).val(productos[index]['price']).prop('disabled', false);
      $("#qty"+ind_act).val(1).prop('disabled', false);
      $("#subtotal"+ind_act).val(parseFloat(productos[index]['price']).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
}
function completeSimpleItem(){

}


/**agergado de nuevos productos y servicios**/
  $("#save_product").click(function(){
    product_key = $("#code_new").val();
    item = $("#notes_new").val();
    cost = $("#cost_new").val();
    category = $("#category_id").val();
    unidad = $("#unit_new").val();
    $.ajax({
          type: 'POST',
          url:'{{ URL::to('productos') }}',
          data: 'product_key='+product_key+'&notes='+item+'&cost='+cost+'&category_id='+category+'&json=1&unidad='+unidad,
          beforeSend: function(){
            console.log("Inicia ajax with ");
          },
          success: function(result)
          {
          
            if(result=="0") {
              

            addNewProduct(product_key,item,cost);
            $("#selectableproducts").select2({data: [{id:product_key, text: product_key+" - "+item}]});            
            }
            else
                error(result);
          }
      });


    console.log(product_key+item+cost+category+unidad);
  });
  function error(errata){
    var x = errata;
    var r = /\\u([\d\w]{4})/gi;
    x = x.replace(r, function (match, grp) {
    return String.fromCharCode(parseInt(grp, 16)); } );
    x = unescape(x);
    $("#errorp").empty();
    $("#errorp").append("<p>"+x+"</p>");
    $("#modalError").modal("show");
  }
  function utf8_decode(str_data) {
  //  discuss at: http://phpjs.org/functions/utf8_decode/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  //    input by: Aman Gupta
  //    input by: Brett Zamir (http://brett-zamir.me)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Norman "zEh" Fuchs
  // bugfixed by: hitwork
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: kirilloid
  //   example 1: utf8_decode('Kevin van Zonneveld');
  //   returns 1: 'Kevin van Zonneveld'

  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0,
    c4 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 <= 191) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 <= 223) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else if (c1 <= 239) {
      // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      c4 = str_data.charCodeAt(i + 3);
      c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
      c1 -= 0x10000;
      tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF));
      tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
      i += 4;
    }
  }

  return tmp_arr.join('');
}

  function agregarContactos(id){
    $.ajax({
          type: 'POST',
          url:'{{ URL::to('getClientContacts') }}',
          data: 'id='+id,
          beforeSend: function(){
            console.log("Inicia ajax with ");
          },
          success: function(result)
          {

            console.log(result);
            ind_con = 0;
            contactos = result['contact'];
            contactos.forEach(function(res){
              addContactToSend(res['id'],res['first_name']+" "+res['last_name'],res['email'],ind_con,res['phone']) ;
              ind_con++;
            });
            addClientNote(result['note']);

          }
      });
  }

  $("#save_service").click(function(){
    product_key = $("#code_news").val();
    item = $("#notes_news").val();
    cost = $("#cost_news").val();
    category = $("#categoy_news").val();
    $.ajax({
          type: 'POST',
          url:'{{ URL::to('productos') }}',
          data: 'product_key='+product_key+'&notes='+item+'&cost='+cost+'&category_id=1&json=2',
          beforeSend: function(){
            console.log("Inicia ajax with ");
          },
          success: function(result)
          {
            console.log(result);
            if(result=="0") {
            addNewProduct(product_key,item,cost);
            prod_to_add.push(item);
            $(".new_row").each(function( index ) {
              act = this.id.substring(7);
              //valor = $("#"+this.id).val();
              //$("#notes"+act).select2({data: [{id:product_key, text: item}]});
              //$( "#notes"+act ).autocomplete('option', 'source', prod_to_add);
              //$("#code"+act).select2({data: [{id:product_key, text: product_key}]});
              $("#code"+act).select2({data: [{id:product_key, text: product_key}]});
            });
            }
            else
                error(result);
          }
      });
  });
function addNewProduct(newkey,newnotes,newcost)
{
  var newp ={
  'cost' : newcost,
  'notes': newnotes,
  'product_key': newkey,
  'qty': 0
  };
  productos.push(newp);
  //availableTags = getProductsKey();
    // $( "#code1" ).autocomplete({
    //   minLength: 0,
    //   source: availableTags,
    // });
}

  $(document).on('click','.qty', function(){
    $("#"+this.id).select();
  });
  $("#discount").click(function(){
    $("#discount").select();
  });
  $("#discount").keyup(function(){
    calculateAllTotal();
    });
  $(document).on('click','.cost', function(){
    $("#"+this.id).select();
  });
  $(document).on('click','.killit',function(){
    act = this.id.substring(6);

    cont = 0;
    $(".new_row").each(function( index ) {
      cont++;
    });

    if(cont!=1 && $("#code"+act).val()!="" ){
    $("#new_row"+act).remove();

    // if(emp == 0 )
    //   addNewRow();
    calculateAllTotal();
  }
});


  $(document).on('keyup','.qty',function(){
    ind = this.id.substring(3);
    costo = $("#cost"+ind).val();
    if(costo=='')
        costo=0;
    costo = parseFloat(costo).toFixed(2);
    cantidad = $("#qty"+ind).val();
    if(cantidad=='')
        cantidad= 0;
    cantidad = parseFloat(cantidad).toFixed(2);

    total_val=$("#total").val();

    total_val = parseFloat(total_val).toFixed(2);

    subtotal_val = costo*cantidad;
    $("#subtotal"+ind).val(subtotal_val.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
    calculateAllTotal();
  });
  $(document).on('keyup','.cost',function(){
    ind = this.id.substring(4);
    costo = $("#cost"+ind).val();
    if(costo=='')
        costo=0;
    costo = parseFloat(costo).toFixed(2);
    cantidad = $("#qty"+ind).val();
    if(cantidad=='')
        cantidad= 0;
    cantidad = parseFloat(cantidad).toFixed(2);

    total_val=$("#total").val();
    total_val = parseFloat(total_val).toFixed(2);

    subtotal_val = costo*cantidad;
    $("#subtotal"+ind).val(subtotal_val.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
    $("#total").text((total+subtotal_val)+"");
    calculateAllTotal();
  });
/*
$("#code1").select2().on("select2-focus", function(e) {
          console.log("focus");
        });*/


function addNewRow(){
  tr=  "<tr class='new_row' hidden='hidden' id='new_row"+id_products+"'>";  
  tdcode="<td> <input id='code"+id_products+"' readonly class='form-control code' name=\"productos["+id_products+"][code]\"></td>";
  tdnotes= "<td><input id='notes"+id_products+"' class='form-control notes' name=\"productos["+id_products+"][name]\"></td>";
  tdcost = "<td><input disabled class='form-control cost centertext number_field' id='cost"+id_products+"' name=\"productos["+id_products+"][price]\""+"</td>";
  tdqty = "<td><input disabled class='form-control qty centertext number_field' id='qty"+id_products+"' name=\"productos["+id_products+"][quantity]\""+"</td>";
  tdsubtotal = "<td><input disabled class='form-control derecha' value='0' id='subtotal"+id_products+"'></td>";
  tdkill= "<td><div for='inputError'><span class='killit' style='color:green' id='killit"+id_products+"'>&nbsp;<i class='icon-ok-sign redlink'></i></span></div></td>";
  fintr="</tr>";
  return tr+tdcode+tdnotes+tdcost+tdqty+tdsubtotal+tdkill+fintr;
}

// $( "form" ).submit(function( event ) {
//   if ( $( "input:first" ).val() != "" ) {
//     $( "span" ).text( "Validado..." ).show();
//     return;
//   }

//   $( "span" ).text( "Ingrese Cliente!" ).show().fadeOut( 1000 );
//   event.preventDefault();
// });

$("form").submit(function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});

//this is to cancell submit on enter
$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});

function addFunctions(){
  //f1 = "function fun1(){console.log('this is the first addFunctions');}";

  eval("function fun1(){console.log('this is the first addFunctions');}");

}
var f = new Function('name', 'return alert("hello, " + name + "!");');
//f('erick');

$(document).ready(function(){
  $('a.back').click(function(){
    parent.history.back();
    return false;
  });
});

//
//function isValidDiscount(){
//    if(parseInt($("#total").text())==0)            {
//            alert("Verifique el descuento");
//            return false;
//        }
//        return true; // return false to cancel form action
//}


    $('#sub_boton').click(function(e) {
        if(parseInt($("#total").text())==0)            {
            alert("Su descuento es mayor o igual a su monto");
            e.preventDefault();
            //return false;
        }
        return true; // return false to cancel form action
    });



</script>

@stop
