<!DOCTYPE html5>
<html>
<head>
<title></title>  
    <style type="text/css"></style>  
</head>
<body>
  <p>
    <h3>FACTURA COMPUTARIZADA "FACTUFACIL"</h3>
    <h3>{{$enterprice.': '.Auth::user()->name}}</h3>
    Estimado cliente: <br>
    Le enviamos la factura:<br>
    Ra&oacute;n Social:<strong>{{$invoice->client_name}}</strong><br>
    NIT:<strong>{{$invoice->client_nit}}</strong><br>
    N&uacute;mero de factura:<strong>{{$invoice->number}}</strong><br>
    Monto:<strong>{{$invoice->net_amount}}</strong><br>
    <hr>
    Para poder ver la factura haga click en <strong><a href="{{ $link }}">FACTURA</a></strong>     
          <br>
  </p>
  <hr>
      <strong>{{$enterprice.': '.Auth::user()->name}}</strong><br>
       Sucursal: <strong>{{$branch->name}}</strong><br>
       Direcci&oacute;n: <strong>{{$branch->address}}</strong><br>
       Telefono: <strong>{{$branch->phone}}</strong><br>
  <center>SISTEMA DE FACUTACI&Oacute;N BRINDADO POR <a href="www.rusysve.com">FACTUFACIL</a>, simplificamos tu vida</center>
</body>
</html>

