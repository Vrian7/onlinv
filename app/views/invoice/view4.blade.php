<?php
class MYPDF extends TCPDF {
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8, false);
        $imgdata = "";

          $html = '<hr><table border="0">
            <tr>
            <td align="center">Sistema de Facturación Computarizada <b>www.factufacil.bo</b></td>
            </tr>
            <tr>
            <td width="578" align="center">Pág '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
            </tr>
            </table>';
        $this->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
        //$this->Image('@'.$imgdata, '7', '158', 4, 12, '', 'www.factufacil.bo', 'T', false, 300, '', false, false, 0, false, false, false);

    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Roy');
$pdf->SetTitle('Cotización');
$pdf->SetSubject('Montos Evaluados');
$pdf->SetKeywords('Cotizacion versión 1');

// set margins
$pdf->SetMargins(12, 20, 12);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// borra la linea de arriba en el area del header
$pdf->setPrintHeader(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set some language-dependent strings (optional)
if (@file_exists('/includes/tcpdf/examples/lang/spa.php')) {
    require_once('/includes/tcpdf/examples/lang/spa.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', 'B' , 12);
$numeroCotizacion = 1;
$style6 = array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'color' => array(0, 52, 104));
// add a page
$pdf->AddPage('P', 'LETTER');
//contenido del recuadro
$html = '
    <table border="0" width="120">
    <tr>
        <td style="font-size:18px" align="center" style="color:#003468;">COTIZACIÓN &nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td style="font-size:18px" align="center" style="color:#003468;">'.$numeroCotizacion.'</td>
    </tr>
    </table>
';
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(138, 21, 45, 18, 2, '1111', 'DF', $style6, array(178, 217, 255));
$pdf->writeHTMLCell($w=0, $h=0, $x='140', $y='23', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//borde cotizacion



//logo
$imgdata = asset('uploads/logos/'.$logo);//base64_decode($invoice->logo);
$pdf->Image($imgdata, '13', '15', '50', '15', '', '', 'T', false, 500, '', false, false, 0, false, false, false);

//direcciones y nombre de casa matriz
$pdf->SetFont('helvetica', 'B', 12);
$casa = "CASA MATRIZ";
$dir_casa = $branch->address.', '.$branch->zone;
$tel_casa = $branch->phone;
$city_casa = $branch->city.', Bolivia';
$city_casa = '<tr>
        <td width="150" style="color:#003468;">'.$city_casa.'</td>
        </tr>';
$pdf->SetFont('helvetica', '', 8);

$datoEmpresa = '
  <table border = "0">
      <tr style="line-height:1">
      <td width="150" style="color:#003468;"><b>'.$casa.'</b></td>
      </tr>
      <tr style="line-height:1">
      <td width="150" style="color:#003468;">'.$dir_casa.' </td>
      </tr>
      <tr style="line-height:1">
      <td width="150" style="color:#003468;">Telfs: '.$tel_casa.'</td>
      </tr>
      '.$city_casa.'
  </table>
  ';
$pdf->writeHTMLCell($w=0, $h=0, $x='12', $y='31', $datoEmpresa, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

//TABLA datos del cliente

$pdf->SetFont('helvetica', '', 8);

$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage);

//$date =date("d/m/Y", strtotime($invoice->invoice_date));
//$date = DateTime::createFromFormat("d/m/Y", $date);
//$fecha=strftime("%d de %B de %Y",$date->getTimestamp());

$date = DateTime::createFromFormat("d/m/Y", $invoice->date);
if($date== null){
    $date = DateTime::createFromFormat("Y-m-d", $invoice->date);
    $exp  =explode('-', $invoice->date);
    $fecha = strftime("%d de ".$meses[(int)$exp[1]]." de %Y",$date->getTimestamp());

}
else{
    $fecha = strftime("%d de Abril de %Y",$date->getTimestamp());
}


// datos del cliente, atencion, vendedor
$cliente = "MARCO OTALORA";
$codigo = 1;
$atencion = "";
$ciudad = "LA PAZ";
$vendedor = "HERNAN DEL RIO A.";
$marca = "CATERPILLAR";
$fechaCotizacion = "LA PAZ     3/8/2016";
$modelo = "140K";
$vigencia = "jueves, 18 de Agosto de 2016";
$serie = "SZL02254";
$cambio = 6.96;
$interno = "EXC-01";

$datosCliente = '
<table cellpadding="2" border="0">
    <tr>
        <td width="280" style="color:#003468;">&nbsp;CLIENTE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$cliente.'</b></td>
        <td width="180" style="color:#003468;">&nbsp;CODIGO &nbsp;&nbsp; :<b>&nbsp;'.$codigo.'</b></td>
        <td width="80" align="center" style="font-size:10px; color:#003468;"><b>T/C</b></td>
    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;ATENCIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$atencion .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;CIUDAD &nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$ciudad.'</b></td>
        <td width="80" align="center" style="font-size:10px; color:#003468;"><b>'.$cambio.'</b></td>
    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;VENDEDOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$vendedor .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;MARCA &nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$marca.'</b></td>

    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;FECHA COTIZACIÓN&nbsp; : <b>&nbsp;'.$fechaCotizacion .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;MODELO &nbsp;&nbsp;:<b>&nbsp;'.$modelo.'</b></td>
        <td width="80" align="center" style="color:#003468;">INTERNO</td>
    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;VIGENCIA HASTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$vigencia .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;SERIE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$serie.'</b></td>
        <td width="80" align="center" style="color:#003468;">'.$interno.'</td>
    </tr>
</table>
';
//dibuja rectangulo datos del cliente
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(13, 47, 190, 27, 2, '1111', 'DF', $style6, array(255,255,255));

//dibuja rectangulo t/c
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(176, 47, 27, 15, 2, '1111', 'DF', $style6, array(255, 255, 255));

$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='47', $datosCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$textTitulos = "";
$textTitulos .= '<p></p>
<table border="0.2" cellpadding="3" cellspacing="0">
    <thead>
        <tr>
         <td width="25" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Item</b></td>
         <td width="40" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Cantidad</b></td>
         <td width="35" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Línea</b></td>
         <td width="35" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Unidad de Manejo</b></td>
         <td width="110" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>NÚMERO DE PARTE</b></td>
         <td width="110" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>DESCRIPCIÓN</b></td>
         <td width="50" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Precio Unitario US$</b></td>
         <td width="70" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Total US$</b></td>
         <td width="63" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Entrega</b></td>
        </tr>
    </thead>
</table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '69', $textTitulos, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$ini = 0;
$final = "";
$resto = $ini;

//contenido de la cotizacion
$item = 1;
$cantidad = 4;
$linea = "CAT";
$unidadDeManejo = "Pza";
$numeroDeParte = "1M3780";
$descripcion = "BUSHING";
$precioUnitarioSus = "32.57";
$totalSus = "130,28";
$entrega = "35 DIAS";


foreach ($products as $key => $product){
        $textContenido ='
        <table border="0.2" cellpadding="3" cellspacing="0">
        <tr>
        <td width="25" align="center" style="color:#003468;">'.$item.'</td>
        <td width="40" align="center" style="color:#003468;">'.$product->quantity.'</td>
        <td width="35" align="center" style="color:#003468;">'.$linea.'</td>
        <td width="35" align="center" style="color:#003468;">'.'Pieza'.'</td>
        <td width="55" align="center" style="color:#003468;">'.$product->code.'</td>
        <td width="55" align="center" style="color:#003468;"></td>
        <td width="110" align="left" style="color:#003468;">'.$product->name.'</td>
        <td width="50" align="right" style="color:#003468;">'.$precioUnitarioSus.'</td>
        <td width="70" align="right" style="color:#003468;"><b>'.$totalSus.'</b></td>
        <td width="63" align="center" style="color:#003468;">'.$entrega.'</td>
        </tr>
         </table>
        ';
        $item++;
        $ini = $pdf->GetY(); //punto inicial antes de dibujar la siguiente fila

        if(($ini+$resto)>= 250.46944444444){

            $pdf->AddPage('P', 'LETTER');
            $pdf->writeHTMLCell($w=0, $h=0, '', '', $textContenido, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
        }
        else{
        $pdf->writeHTMLCell($w=0, $h=0, '', '', $textContenido, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
        $final = $pdf->GetY();  //punto hasta donde se dibujo la fila
        }
        $resto = $final-$ini; //diferencia entre $ini y $final para sacar el tamaño siguiente a dibujar
//}
}
$texPie = "";
$subtotal = number_format((float)$invoice->total_amount, 2, '.', ',');
$descuento= number_format((float)($invoice->discount), 2, '.', ',');
$total = number_format((float)$invoice->net_amount, 2, '', '');

$importe = number_format((float)$invoice->net_amount, 2, '.', '');
$num = explode(".", $importe);
if(!isset($num[1]))
    $num[1]="00";
$tool = new Tool();
$literal = $tool->to_string($num[0]).substr($num[1],0,2);

$totalBs = $total* $cambio;
$totalBs = number_format((float)$totalBs, 2, '.', ',');
$total = number_format((float)$invoice->net_amount, 2, '.', ',');
$pdf->SetFont('helvetica', '', 8);
        $texPie .='
        <table border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td width="245" style="color:#003468;"></td>
                <td width="110" style="color:#003468;"><b>TOTAL COTIZACION US$ </b></td>
                <td width="50" style="color:#003468;"></td>
                <td  width="70" align="right" style="color:#003468;"><b>'.$total.'</b></td>
            </tr>
            <tr>
                <td width="245" style="color:#003468;"></td>
                <td width="110" style="color:#003468;"><b>TOTAL COTIZACION Bs.</b></td>
                <td width="50" style="color:#003468;"></td>
                <td width="70" align="right" style="color:#003468;"><b>'.$totalBs.'</b></td>
            </tr>
        </table>
        ';
        if ($pdf->GetY() >= '210.6375' ){
            $pdf->AddPage('P', 'LETTER');
        }
$pdf->writeHTMLCell($w=0, $h=0, '', '', $texPie, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//terminos
$line=60;
//if (!empty($invoice->public_notes)){
//$nota = $invoice->public_notes;
$nota = $invoice->notes;
$nota = "50% al inicio de la orden de compra, saldo contra entrega.";
$notaCliente = '

        <table style="padding:0px 0px 0px 5px" border="0">
        <tr>
            <td style="line-height: '.$line.'%"> </td>
        </tr>
        <tr>
            <td width="88" align="right" style="font-size:9px; color:#003468;"><b>Nota al cliente:</b></td>
            <td width="250" align="left" bgcolor="#F2F2F2" style="font-size:9px; border-left: 1px solid #000; color:#003468;">'.$nota.'</td>
        </tr>
        </table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $notaCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$line=100;
$nota = $invoice->notes;
//$terminos = $invoice->terms;
$terminos = $invoice->validate;
$termCliente = '
        <table style="padding:0px 0px 0px 5px">
        <tr><td style="line-height: '.$line.'%"> </td></tr>
        <tr>
            <td width="88" align="right" style="font-size:9px; color:#003468;"><b>Validez: </b></td>
            <td width="250" align="left" bgcolor="#F2F2F2" style="font-size:9px; border-left: 1px solid #000; color:#003468;">'.$terminos.' dias a partir de la fecha</td>
        </tr>
        </table>
';
//$pdf->writeHTMLCell($w=0, $h=0, '', '', $termCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$pdf->Output('factura.pdf', 'I');
die;
?>
<?php
class MYPDF extends TCPDF {
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8, false);
        $imgdata = "";

          $html = '<hr><table border="0">
            <tr>
            <td align="center">Sistema de Facturación Computarizada <b>www.factufacil.bo</b></td>
            </tr>
            <tr>
            <td width="578" align="center">Pág '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
            </tr>
            </table>';
        $this->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
        //$this->Image('@'.$imgdata, '7', '158', 4, 12, '', 'www.factufacil.bo', 'T', false, 300, '', false, false, 0, false, false, false);

    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Roy');
$pdf->SetTitle('Cotización');
$pdf->SetSubject('Montos Evaluados');
$pdf->SetKeywords('Cotizacion versión 1');

// set margins
$pdf->SetMargins(12, 20, 12);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// borra la linea de arriba en el area del header
$pdf->setPrintHeader(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set some language-dependent strings (optional)
if (@file_exists('/includes/tcpdf/examples/lang/spa.php')) {
    require_once('/includes/tcpdf/examples/lang/spa.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', 'B' , 12);
$numeroCotizacion = 1;
$style6 = array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'color' => array(0, 52, 104));
// add a page
$pdf->AddPage('P', 'LETTER');
//contenido del recuadro
$html = '
    <table border="0" width="120">
    <tr>
        <td style="font-size:18px" style="color:#003468;">COTIZACIÓN</td>
    </tr>
    <tr>
        <td style="font-size:18px" align="center" style="color:#003468;">'.$numeroCotizacion.'</td>
    </tr>
    </table>
';
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(138, 21, 45, 18, 2, '1111', 'DF', $style6, array(178, 217, 255));
$pdf->writeHTMLCell($w=0, $h=0, $x='140', $y='23', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//borde cotizacion



//logo
$imgdata = asset('uploads/logos/'.$logo);//base64_decode($invoice->logo);
$pdf->Image('@'.$imgdata, '26', '6', '34', '30', '', '', 'T', false, 500, '', false, false, 0, false, false, false);

//direcciones y nombre de casa matriz
$pdf->SetFont('helvetica', 'B', 12);
$casa = "CASA MATRIZ";
$dir_casa = $branch->address.', '.$branch->zone;
$tel_casa = $branch->phone;
$city_casa = $branch->city.', Bolivia';
$city_casa = '<tr>
        <td width="150" style="color:#003468;">'.$city_casa.'</td>
        </tr>';
$pdf->SetFont('helvetica', '', 8);

$datoEmpresa = '
  <table border = "0">
      <tr style="line-height:1">
      <td width="150" style="color:#003468;"><b>'.$casa.'</b></td>
      </tr>
      <tr style="line-height:1">
      <td width="150" style="color:#003468;">'.$dir_casa.' </td>
      </tr>
      <tr style="line-height:1">
      <td width="150" style="color:#003468;">Telfs: '.$tel_casa.'</td>
      </tr>
      '.$city_casa.'
  </table>
  ';
$pdf->writeHTMLCell($w=0, $h=0, $x='12', $y='31', $datoEmpresa, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

//TABLA datos del cliente

$pdf->SetFont('helvetica', '', 8);

$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage);

//$date =date("d/m/Y", strtotime($invoice->invoice_date));
//$date = DateTime::createFromFormat("d/m/Y", $date);
//$fecha=strftime("%d de %B de %Y",$date->getTimestamp());

$date = DateTime::createFromFormat("d/m/Y", $invoice->date);
if($date== null){
    $date = DateTime::createFromFormat("Y-m-d", $invoice->date);
    $exp  =explode('-', $invoice->date);
    $fecha = strftime("%d de ".$meses[(int)$exp[1]]." de %Y",$date->getTimestamp());

}
else{
    $fecha = strftime("%d de Abril de %Y",$date->getTimestamp());
}


// datos del cliente, atencion, vendedor
$cliente = "MARCO OTALORA";
$codigo = 1;
$atencion = "";
$ciudad = "LA PAZ";
$vendedor = "HERNAN DEL RIO A.";
$marca = "CATERPILLAR";
$fechaCotizacion = "LA PAZ     3/8/2016";
$modelo = "140K";
$vigencia = "jueves, 18 de Agosto de 2016";
$serie = "SZL02254";
$cambio = 6.96;
$interno = "EXC-01";

$datosCliente = '
<table cellpadding="2" border="0">
    <tr>
        <td width="280" style="color:#003468;">&nbsp;CLIENTE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$cliente.'</b></td>
        <td width="180" style="color:#003468;">&nbsp;CODIGO &nbsp;&nbsp; :<b>&nbsp;'.$codigo.'</b></td>
        <td width="80" align="center" style="font-size:10px; color:#003468;"><b>T/C</b></td>
    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;ATENCIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$atencion .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;CIUDAD &nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$ciudad.'</b></td>
        <td width="80" align="center" style="font-size:10px; color:#003468;"><b>'.$cambio.'</b></td>
    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;VENDEDOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$vendedor .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;MARCA &nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$marca.'</b></td>

    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;FECHA COTIZACIÓN&nbsp; : <b>&nbsp;'.$fechaCotizacion .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;MODELO &nbsp;&nbsp;:<b>&nbsp;'.$modelo.'</b></td>
        <td width="80" align="center" style="color:#003468;">INTERNO</td>
    </tr>
    <tr>
        <td width="280" style="color:#003468;">&nbsp;VIGENCIA HASTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$vigencia .'</b></td>
        <td width="180" style="color:#003468;">&nbsp;SERIE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$serie.'</b></td>
        <td width="80" align="center" style="color:#003468;">'.$interno.'</td>
    </tr>
</table>
';
//dibuja rectangulo datos del cliente
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(13, 47, 190, 27, 2, '1111', 'DF', $style6, array(255,255,255));

//dibuja rectangulo t/c
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(176, 47, 27, 15, 2, '1111', 'DF', $style6, array(255, 255, 255));

$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='47', $datosCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$textTitulos = "";
$textTitulos .= '<p></p>
<table border="0.2" cellpadding="3" cellspacing="0">
    <thead>
        <tr>
         <td width="25" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Item</b></td>
         <td width="40" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Cantidad</b></td>
         <td width="35" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Línea</b></td>
         <td width="35" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Unidad de Manejo</b></td>
         <td width="110" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>NÚMERO DE PARTE</b></td>
         <td width="110" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>DESCRIPCIÓN</b></td>
         <td width="50" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Precio Unitario US$</b></td>
         <td width="70" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Total US$</b></td>
         <td width="63" align="center" style="font-size:7px; color:#003468;" bgcolor="#B2D9FF"><b>Entrega</b></td>
        </tr>
    </thead>
</table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '69', $textTitulos, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$ini = 0;
$final = "";
$resto = $ini;

//contenido de la cotizacion
$item = 1;
$cantidad = 4;
$linea = "CAT";
$unidadDeManejo = "Pza";
$numeroDeParte = "1M3780";
$descripcion = "BUSHING";
$precioUnitarioSus = "32.57";
$totalSus = "130,28";
$entrega = "35 DIAS";


foreach ($products as $key => $product){
        $textContenido ='
        <table border="0.2" cellpadding="3" cellspacing="0">
        <tr>
        <td width="25" align="center" style="color:#003468;">'.$item.'</td>
        <td width="40" align="center" style="color:#003468;">'.$cantidad.'</td>
        <td width="35" align="center" style="color:#003468;">'.$linea.'</td>
        <td width="35" align="center" style="color:#003468;">'.$unidadDeManejo.'</td>
        <td width="55" align="center" style="color:#003468;">'.$numeroDeParte.'</td>
        <td width="55" align="center" style="color:#003468;"></td>
        <td width="110" align="center" style="color:#003468;">'.$descripcion.'</td>
        <td width="50" align="right" style="color:#003468;">'.$precioUnitarioSus.'</td>
        <td width="70" align="right" style="color:#003468;"><b>'.$totalSus.'</b></td>
        <td width="63" align="center" style="color:#003468;">'.$entrega.'</td>
        </tr>
         </table>
        ';
        $ini = $pdf->GetY(); //punto inicial antes de dibujar la siguiente fila

        if(($ini+$resto)>= 250.46944444444){

            $pdf->AddPage('P', 'LETTER');
            $pdf->writeHTMLCell($w=0, $h=0, '', '', $textContenido, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
        }
        else{
        $pdf->writeHTMLCell($w=0, $h=0, '', '', $textContenido, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
        $final = $pdf->GetY();  //punto hasta donde se dibujo la fila
        }
        $resto = $final-$ini; //diferencia entre $ini y $final para sacar el tamaño siguiente a dibujar
//}
}
$texPie = "";
$subtotal = number_format((float)$invoice->total_amount, 2, '.', ',');
$descuento= number_format((float)($invoice->discount), 2, '.', ',');
$total = number_format((float)$invoice->net_amount, 2, '', '');

$importe = number_format((float)$invoice->net_amount, 2, '.', '');
$num = explode(".", $importe);
if(!isset($num[1]))
    $num[1]="00";
$tool = new Tool();
$literal = $tool->to_string($num[0]).substr($num[1],0,2);

$totalBs = $total* $cambio;
$pdf->SetFont('helvetica', '', 8);
        $texPie .='
        <table border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td width="245" style="color:#003468;"></td>
                <td width="110" style="color:#003468;"><b>TOTAL COTIZACION US$ </b></td>
                <td width="50" style="color:#003468;"></td>
                <td  width="70" align="right" style="color:#003468;"><b>'.$total.'</b></td>
            </tr>
            <tr>
                <td width="245" style="color:#003468;"></td>
                <td width="110" style="color:#003468;"><b>TOTAL COTIZACION Bs.</b></td>
                <td width="50" style="color:#003468;"></td>
                <td width="70" align="right" style="color:#003468;"><b>'.$totalBs.'</b></td>
            </tr>
        </table>
        ';
        if ($pdf->GetY() >= '210.6375' ){
            $pdf->AddPage('P', 'LETTER');
        }
$pdf->writeHTMLCell($w=0, $h=0, '', '', $texPie, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//terminos
$line=60;
//if (!empty($invoice->public_notes)){
//$nota = $invoice->public_notes;
$nota = $invoice->notes;
$nota = "50% al inicio de la orden de compra, saldo contra entrega.";
$notaCliente = '

        <table style="padding:0px 0px 0px 5px" border="0">
        <tr>
            <td style="line-height: '.$line.'%"> </td>
        </tr>
        <tr>
            <td width="88" align="right" style="font-size:9px; color:#003468;"><b>Nota al cliente:</b></td>
            <td width="250" align="left" bgcolor="#F2F2F2" style="font-size:9px; border-left: 1px solid #000; color:#003468;">'.$nota.'</td>
        </tr>
        </table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $notaCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$line=100;
$nota = $invoice->notes;
$notes = "SD";
//$terminos = $invoice->terms;
$terminos = $invoice->validate;
$termCliente = '
        <table style="padding:0px 0px 0px 5px">
        <tr><td style="line-height: '.$line.'%"> </td></tr>
        <tr>
            <td width="88" align="right" style="font-size:9px; color:#003468;"><b>Validez: </b></td>
            <td width="250" align="left" bgcolor="#F2F2F2" style="font-size:9px; border-left: 1px solid #000; color:#003468;">'.$terminos.' dias a partir de la fecha</td>
        </tr>
        </table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $termCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$pdf->Output('factura.pdf', 'I');
die;
?>