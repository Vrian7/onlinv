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
$pdf->SetAuthor('roy');
$pdf->SetTitle('Factura');
$pdf->SetSubject('Primera Factura');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set margins
$pdf->SetMargins(14, 20, 14);
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
$nit = $invoice->nit;
$nfac = $invoice->number;
$nauto = $invoice->authorization_number;
$sfc = "1";

// add a page
$pdf->AddPage('P', 'LETTER');
//contenido del recuadro
$html = '
    <table border="0" width="180">
    <tr>
        <td width="75" style="font-size:8px">NIT:</td>
        <td align="left" style="font-size:10px">:&nbsp;'.$nit.'</td>
    </tr>
    <tr>
        <td style="font-size:8px">AUTORIZACI&Oacute;N N&ordm;</td>
        <td align="left" style="font-size:10px">:&nbsp;'.$nauto.'</td>
    </tr>
    <tr>
        <td style="font-size:8px">FACTURA N&ordm;</td>
        <td align="left" style="font-size:10px">:&nbsp;'.$nfac.'</td>
    </tr>
    <tr><td></td></tr>
    </table>
';
//imprime el contenido de la variable html
$pdf->writeHTMLCell($w=0, $h=0, $x='140', $y='13', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//dibuja un rectangulo
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(138, 11, 63, 18, 2, '1111', null);
$imgdata = asset('uploads/logos/'.$logo);//base64_decode($invoice->logo);
//$pdf->Image('@'.$imgdata, '26', '6', '34', '30', '', '', 'T', false, 500, '', false, false, 0, false, false, false);
$pdf->Image($imgdata, '16', '10', '66', '20', '', '', 'T', false, 500, '', false, false, 0, false, false, false);

///title
$anchoDivFac = 480;
if($invoice->type_third==0)
{
    $factura = "FACTURA";
    $tercero ="";
}
else{
    $factura = "FACTURA POR TERCEROS";
    $tercero = $matriz->name;
    $anchoDivFac = 520;
}

$titleFactura='<table border="0">
<tr>
<td width="480" align="center"><font color="#333333">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$factura.'</font></td>
</tr>
</table>';
$pdf->SetFont('helvetica', 'B' , 22);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='19', $titleFactura, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$pdf->SetFont('helvetica', 'B' , 9);

// $sinCreditoFiscal = "SIN DERECHO A CR&Eacute;DITO FISCAL";
//$sinCreditoFiscalHtml='<table border="0">
//<tr>
//<td width="500" align="center"><font color="#333333">&nbsp;&nbsp;&nbsp;&nbsp;'.$sinCreditoFiscal.'</font></td>
//</tr>
//</table>';
//$pdf->SetFont('helvetica', 'B' , 13);
//$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='38', $sinCreditoFiscalHtml, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$pdf->SetFont('helvetica', 'B' , 11);








//nombre de la empresa
$business = $invoice->account_name;
$unipersonal = $invoice->account_uniper;
$pdf->SetFont('helvetica', 'B', 10, false);
// $NombreEmpresa = '
//     <p style="line-height: 150%">
//         <font color="#333333">
//             '.$business.'
//         </font>
//     </p>';
//$NombreEmpresa = ' <table border="0">
//  <tr>
 //   <td width="250" align="center"><font color="#333333">'.$business.'</font></td>
//  </tr>
//</table>
//';
//$pdf->writeHTMLCell($w=0, $h=0, $x='45', $y='10', $NombreEmpresa, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$pdf->SetFont('helvetica', 'B', 8, false);
if($unipersonal!="")
    $pdf->writeHTMLCell($w=0, $h=0, $x='15', $y='36', 'De: '.$unipersonal, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$pdf->writeHTMLCell($w=0, $h=0, $x='15', $y='1', $tercero, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
/*if($copia==1)
    $original = "COPIA";
else
$original = "ORIGINAL";*/
$original = $type;
$original = "ORIGINAL";
$pdf->SetFont('helvetica', 'B', 12);
    $original = '
        <p style="line-height: 150% ">
            '.$original.'
        </p>';
$pdf->writeHTMLCell($w=0, $h=0, $x='155', $y='29', $original, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

//datos de la empresa
// $casa = $matriz->name;
$casa = "CASA MATRIZ";
$dir_casa = $branch->address.', '.$branch->zone;//"dreccion casa matriz";//$matriz->address2."  ".$matriz->address1;
$tel_casa = $branch->phone;//$matriz->work_phone;
$city_casa = $branch->city.', Bolivia';//"la paz bolivia ";//$matriz->city." - Bolivia";
//if($matriz->city == $invoice->city && $invoice->branch_id != $matriz->id)
  //  $city_casa ="";
//else
$city_casa = '<tr>
        <td width="150">'.$city_casa.'</td>
        </tr>';
$pdf->SetFont('helvetica', '', 8);

if(true)//$invoice->branch_id == $matriz->id || $branch->number_branch == 0)
{
    $datoEmpresa = '
    <table border = "0">
        <tr style="line-height:1">
        <td width="150"><b>'.$casa.'</b></td>
        </tr>
        <tr style="line-height:1">
        <td width="150">'.$dir_casa.' </td>
        </tr>
        <tr style="line-height:1">
        <td width="150">Telfs: '.$tel_casa.'</td>
        </tr>
        '.$city_casa.'
    </table>
    ';
}
else{
    $sucursal = $invoice->branch_name;
    $direccion = $invoice->address1." - ".$invoice->address2;
    $ciudad = $invoice->city." - Bolivia";
    $telefonos =$invoice->phone;
    $datoEmpresa = '
    <table border = "0">
        <tr style="line-height:0.9">
        <td width="270"><b><font size="7">'.$casa.'</font></b></td>
        </tr>
        <tr style="line-height:0.9">
        <td width="270"><font size="7">'.$dir_casa.'</font></td>
        </tr>
        <tr style="line-height:0.9">
        <td width="270"><font size="7">Telfs: '.$tel_casa.'</font></td>
        </tr>
        <font size="7">'.$city_casa.'</font>
        <tr style="line-height:0.9">
        <td width="270"><b><font size="7">'.$sucursal.'</font></b></td>
        </tr>
        <tr style="line-height:0.9">
        <td width="270"><font size="7">'.$direccion.'</font></td>
        </tr>
        <tr style="line-height:0.9">
        <td width="270"><font size="7">Telfs: '.$telefonos.'</font></td>
        </tr>
        <tr style="line-height:0.9">
        <td width="270"><font size="7">'.$ciudad.'</font></td>
        </tr>
    </table>
    ';
}

$pdf->writeHTMLCell($w=0, $h=0, $x='15', $y='31', $datoEmpresa, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//actividad económica
$actividad=$invoice->economic_activity;
$pdf->SetFont('helvetica', '', 10);
$actividadEmpresa = '
    <table>
        <tr>
            <td align="center">'.$actividad.'</td>
        </tr>
    </table>';

$pdf->writeHTMLCell($w=0, $h=0, $x='135', $y='36', $actividadEmpresa, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//TABLA datos del cliente

$pdf->SetFont('helvetica', '', 11);

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



$fecha= $invoice->state.", ".$fecha;
$senor = $invoice->client_name;
$nit = $invoice->client_nit;

$datosCliente = '
<table cellpadding="2" border="0">
    <tr>
        <td width="300"><b>&nbsp;Lugar y fecha :</b>'.$fecha.'</td>
        <td width="230" align="right"><b>NIT/CI :</b>'.$nit.'</td>
    </tr>
    <tr>
        <td colspan="2"><b>&nbsp;Se&ntilde;or(es):</b> '.$senor .'</td>
    </tr>

</table>
';
//$datosCliente="asdf";

$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='50', $datosCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

//dibuja rectangulo datos del cliente
$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(15, 50, 187, 14, 1, '1111', null);
$textTitulos = '
<table border="0.2" cellpadding="3" cellspacing="0">
    <thead>
        <tr>
          <td width="60" align="center" bgcolor="#E6DFDF"><font size="9"><b>CANTIDAD</b></font></td>
          <td width="50" align="center" bgcolor="#E6DFDF"><font size="9"><b>LÍNEA</b></font></td>
          <td width="50" align="center" bgcolor="#E6DFDF"><font size="9"><b>UNIDAD</b></font></td>
          <td width="60" align="center" bgcolor="#E6DFDF"><font size="9"><b>CÓDIGO</b></font></td>
          <td width="170" align="center" bgcolor="#E6DFDF"><font size="9"><b>DETALLE</b></font></td>
           <td width="60" align="center" bgcolor="#E6DFDF"><font size="9"><b>PRECIO</b></font></td>
           <td width="80" align="center" bgcolor="#E6DFDF"><font size="9"><b>SUBTOTAL</b></font></td>
        </tr>
    </thead>
</table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '67', $textTitulos, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//
$ini = 0;
$final = "";
$resto = $ini;
//for ($i=0;$i<=10;$i++)
//{
foreach ($products as $key => $product){
        $unidad = Product::where('id', $product->product_id)->select('unit_id', 'brand_id')->first();
        $brand = Brand::where('id', $unidad->brand_id)->first();
        $unit = Unit::where('id', $unidad->unit_id)->first();
        $textContenido ='
        <table border="0.2" cellpadding="3" cellspacing="0">
        <tr>
        <td width="60" align="center"><font size="9">'.$product->quantity.'</font></td>
        <td width="50" align="center"><font size="9">'.$brand->name.'</font></td>
        <td width="50"><font size="9">'.$unit->name.'</font></td>
        <td width="60" align="center"><font size="9 ">'.$product->code.'</font></td>
        <td width="170"><font size="9">'.$product->name.'</font></td>
        <td width="60" align="right"><font size="9">'.$product->price.'</font></td>
        <td width="80" align="right"><font size="9"> '.number_format((float)($product->price*$product->quantity), 2, '.', ',').'</font></td>
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
$total = number_format((float)$invoice->net_amount, 2, '.', ',');
$fiscal=number_format((float)$invoice->taxable_amount, 2, '.', '');
$ice="0";
$totalConv = number_format((float)$invoice->net_amount, 2, '.', '');
$totalBs = number_format((float)$totalConv * $invoice->exchange, 2, '.', ',');

//require_once(app_path().'/includes/numberToString.php');
//$nts = new numberToString();
$importe = number_format((float)$invoice->net_amount*$invoice->exchange, 2, '.', '');
$num = explode(".", $importe);
if(!isset($num[1]))
    $num[1]="00";

//$literal= $nts->to_word($num[0]).substr($num[1],0,2);
$tool = new Tool();
$literal = $tool->to_string($num[0]).substr($num[1],0,2);

$textSub = '<table border="0.2" cellpadding="3" cellspacing="0">
            <tr>
                <td width="450" align="right"><b>SUBTOTAL Su$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                <td  width="80" align="right"><b>'.$subtotal.'</b></td>
            </tr>
          </table>';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $textSub, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$textDesc = '<table border="0.2" cellpadding="3" cellspacing="0">
                <tr>
                <td width="450"  align="right"><b>DESCUENTO Su$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                <td width="80" align="right"><b>'.$descuento.'</b></td>
            </tr>
            </table>';

if ($descuento > 0)
  $pdf->writeHTMLCell($w=0, $h=0, '', '', $textDesc, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$pdf->SetFont('helvetica', '', 11);
        $texPie .='
        <table border="0.2" cellpadding="3" cellspacing="0">
            <tr>
                <td width="450"  align="right"><b>TOTAL Su$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                <td width="80" align="right"><b>'.$total.'</b></td>
            </tr>
            <tr>
                <td width="450"  align="right"><b>TOTAL Bs. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                <td width="80" align="right"><b>'.$totalBs.'</b></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:9px"><b>Son: </b>'.$literal.'/100 BOLIVIANOS.</td>
            </tr>
        </table>
        ';
        if ($pdf->GetY() >= '210.6375' ){

            $pdf->AddPage('P', 'LETTER');
        }

$pdf->writeHTMLCell($w=0, $h=0, '', '', $texPie, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$leyenda = '<table  cellpadding="3" cellspacing="0">
                  <tr><td style="line-height: 50%"> </td></tr>
                  <tr>
                        <td width="440" bgcolor="#F2F2F2" style="font-size:7px;">
                            EL MONTO EN BOLIVIANOS DE ESTA FACTURA EQUIVALE SOLO A EFECTOS DE CRÉDITO FISCAL IVA
                        </td>
                  </tr>
                  <tr>
                        <td width="440" bgcolor="#F2F2F2" style="font-size:7px;">
                            (RND NO 10.0016.07) US.     169.34 AL CAMBIO DE BS. 6.96 POR US$ 1.00 EL MISMO QUE DEBERA SER CANCELADO EN DOLARES ESTADOUNIDENSES O EN EQUIVALENTE EN MONEDA NACIONAL AL TIPO DE CAMBIO VIGENTE EN EL MOMENTO DE PAGO

                        </td>
                  </tr>
                  <tr>
                        <td width="440" bgcolor="#F2F2F2" style="font-size:7px;">
                            DESCUENTO DISCRESIONAL
                        </td>
                  </tr>
                  <tr>
                        <td width="440" bgcolor="#F2F2F2" style="font-size:7px; line-height: 50%;">
                            SEGUN ACUERDO CLIENTE
                        </td>
                  </tr>
              </table>';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $leyenda, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//nota al cliente
$restoQr = 40;
$line=60;
if (!empty($invoice->public_notes)){
$nota = $invoice->public_notes;
$notaCliente = '

        <table style="padding:0px 0px 0px 5px" border="0">
        <tr>
            <td style="line-height: '.$line.'%"> </td>
        </tr>
        <tr>
            <td width="88" align="right" style="font-size:9px;"><b>Nota al Cliente:</b></td>
            <td width="352" align="left" bgcolor="#F2F2F2" style="font-size:9px; border-left: 1px solid #000;">'.$nota.'</td>
        </tr>
        </table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $notaCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$restoQr=$restoQr+10;
$line=100;
}
if (!empty($invoice->terms)){
$nota = $invoice->public_notes;
$terminos = $invoice->terms;
$termCliente = '
        <table style="padding:0px 0px 0px 5px">
        <tr><td style="line-height: '.$line.'%"> </td></tr>
        <tr>
            <td width="88" align="right" style="font-size:9px"><b>Términos de Facturación: </b></td>
            <td width="352" align="left" bgcolor="#F2F2F2" style="font-size:9px; border-left: 1px solid #000; ">'.$terminos.'</td>
        </tr>
        </table>
';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $termCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$restoQr=$restoQr+11;
$line=50;
}

$control_code = $invoice->control_code;
$fecha_limite = date("d/m/Y", strtotime($invoice->deadline));
$fecha_limite = \DateTime::createFromFormat('Y-m-d',$invoice->deadline);
if($fecha_limite== null)
    $fecha_limite = $invoice->deadline;
else
    $fecha_limite = $fecha_limite->format('d/m/Y');

$law_gen="ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY";

$law=$invoice->legend;
$datosFactura = '
<table border="0" style="line-height: 160%">
    <tr><td style="line-height: '.$line.'%"> </td></tr>
    <tr>
        <td width="230" align="left"><b>C&Oacute;DIGO DE CONTROL :&nbsp;&nbsp;'.$control_code.'</b></td>
        <td width="210" align="left"><b>Fecha L&iacute;mite de Emisi&oacute;n : &nbsp;'.$fecha_limite.' </b></td>
    </tr>
    <tr>
        <td width="450" align="center" style="font-size:7px"><b>"'.$law_gen.'"</b></td>
    </tr>
    <tr>
        <td width="450" align="center" style="font-size:7px">"'.$law.'"</td>
    </tr>
</table>
';
if ($pdf->GetY() >= '226.6375' ){
        $pdf->AddPage('P', 'LETTER');
        if(!empty($nota) && !empty($terminos)){
            $restoQr = $restoQr - 18;
        }
    }

$subtotal = number_format((float)$invoice->importe_total, 2, '.', '');
$descuento= number_format((float)($invoice->importe_total-$invoice->importe_neto), 2, '.', '');
$total = number_format((float)$invoice->importe_neto, 2, '.', '');
$pdf->writeHTMLCell($w=0, $h=0, '', '', $datosFactura, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$date_qr = date("d/m/Y", strtotime($invoice->date));
$date_qr = \DateTime::createFromFormat('Y-m-d',$invoice->date);
if($date_qr== null)
    $date_qr = $invoice->date;
else
    $date_qr = $date_qr->format('d/m/Y');

if($descuento == '0.00')
    $descuento = 0;
$datosqr = $invoice->nit.'|'.$invoice->number.'|'.$invoice->authorization_number.'|'.$date_qr.'|'.$total.'|'.$fiscal.'|'.$invoice->control_code.'|'.$invoice->client_nit.'|'.$ice.'|0|0|'.$descuento;
$pdf->write2DBarcode($datosqr, 'QRCODE,M', '175',
$pdf->GetY()-$restoQr, 25, 25, '', 'N');

//Close and output PDF document
$pdf->Output('factura.pdf', 'I');

die;
?>