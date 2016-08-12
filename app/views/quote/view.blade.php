<?php
class MYPDF extends TCPDF {
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8, false);
        $imgdata = "";

          $html = '<hr><table border="0">
            <tr>
            <td align="center">Sistema de Cotizaciones brindado por: <b>www.factufacil.bo</b></td>
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
// add a page
$pdf->AddPage('P', 'LEGAL');
//contenido del recuadro
$html = '
    <table border="0" width="120">
    <tr>
        <td style="font-size:18px">COTIZACIÓN</td>
    </tr>
    <tr>
        <td style="font-size:18px" align="center">'.$numeroCotizacion.'</td>
    </tr>
    </table>
';
$pdf->writeHTMLCell($w=0, $h=0, $x='140', $y='23', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
//borde cotizacion
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(138, 21, 45, 18, 2, '1111', null);

//logo
$imgdata = asset('uploads/logos/'.$logo);//base64_decode($invoice->logo);
$pdf->Image($imgdata, '15', '9', '45', '20', '', '', 'T', false, 500, '', false, false, 0, false, false, false);

//direcciones y nombre de casa matriz
$pdf->SetFont('helvetica', 'B', 12);
$casa = "CASA MATRIZ";
$dir_casa = $branch->address.', '.$branch->zone;
$dir_casa = "Calle Rosendo Villalobos 1595, Miraflores";
$tel_casa = $branch->phone;
$tel_casa = "(+591) (2) 2129763";
$city_casa = $branch->city.', Bolivia';
$city_casa = '<tr>
        <td width="150">'.$city_casa.'</td>
        </tr>';
$pdf->SetFont('helvetica', '', 8);

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
        <td width="280">&nbsp;CLIENTE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$cliente.'</b></td>
        <td width="180">&nbsp;CODIGO &nbsp;&nbsp; :<b>&nbsp;'.$codigo.'</b></td>
        <td width="80" align="center" style="font-size:10px"><b>T/C</b></td>
    </tr>
    <tr>
        <td width="280">&nbsp;ATENCIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$atencion .'</b></td>
        <td width="180">&nbsp;CIUDAD &nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$ciudad.'</b></td>
        <td width="80" align="center" style="font-size:10px"><b>'.$cambio.'</b></td>
    </tr>
    <tr>
        <td width="280">&nbsp;VENDEDOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$vendedor .'</b></td>
        <td width="180">&nbsp;MARCA &nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$marca.'</b></td>

    </tr>
    <tr>
        <td width="280">&nbsp;FECHA COTIZACIÓN&nbsp; : <b>&nbsp;'.$fechaCotizacion .'</b></td>
        <td width="180">&nbsp;MODELO &nbsp;&nbsp;:<b>&nbsp;'.$modelo.'</b></td>
        <td width="80" align="center">INTERNO</td>
    </tr>
    <tr>
        <td width="280">&nbsp;VIGENCIA HASTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>&nbsp;'.$vigencia .'</b></td>
        <td width="180">&nbsp;SERIE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;'.$serie.'</b></td>
        <td width="80" align="center">'.$interno.'</td>
    </tr>
</table>
';

$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='47', $datosCliente, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

//dibuja rectangulo datos del cliente
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(13, 47, 190, 27, 1, null);
//dibuja rectangulo t/c
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->RoundedRect(176, 47, 27, 15, 1, null);

$textTitulos = "";
$textTitulos .= '<p></p>
<table border="0.2" cellpadding="3" cellspacing="0">
    <thead>
        <tr>
         <td width="25" align="center"><font size="7"><b>Item</b></font></td>
         <td width="40" align="center"><font size="7"><b>Cantidad</b></font></td>
         <td width="35" align="center"><font size="7"><b>Línea</b></font></td>
         <td width="35" align="center"><font size="7"><b>Unidad de Manejo</b></font></td>
         <td width="110" align="center"><font size="7"><b>NÚMERO DE PARTE</b></font></td>
         <td width="110" align="center"><font size="7"><b>DESCRIPCIÓN</b></font></td>
         <td width="50" align="center"><font size="7"><b>Precio Unitario US$</b></font></td>
         <td width="70" align="center"><font size="7"><b>Total US$</b></font></td>
         <td width="63" align="center"><font size="7"><b>Entrega</b></font></td>
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
        <td width="25" align="center"><font size="7">'.$item.'</font></td>
        <td width="40" align="center"><font size="7">'.$cantidad.'</font></td>
        <td width="35" align="center"><font size="7">'.$linea.'</font></td>
        <td width="35" align="center"><font size="7">'.$unidadDeManejo.'</font></td>
        <td width="110" align="center"><font size="7">'.$numeroDeParte.'</font></td>
        <td width="110" align="center"><font size="7">'.$descripcion.'</font></td>
        <td width="50" align="center"><font size="7">'.$precioUnitarioSus.'</font></td>
        <td width="70" align="center"><font size="7"><b>'.$totalSus.'</b></font></td>
        <td width="63" align="center"><font size="7">'.$entrega.'</font></td>
        </tr>
         </table>
        ';
        $ini = $pdf->GetY(); //punto inicial antes de dibujar la siguiente fila

        if(($ini+$resto)>= 250.46944444444){

            $pdf->AddPage('P', 'LEGAL');
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
                <td width="245"></td>
                <td width="110"><b>TOTAL COTIZACION US$ </b></td>
                <td width="50"></td>
                <td  width="70" align="right"><b>'.$total.'</b></td>
            </tr>
            <tr>
                <td width="245"></td>
                <td width="110"><b>TOTAL COTIZACION Bs.</b></td>
                <td width="50"></td>
                <td width="70" align="right"><b>'.$totalBs.'</b></td>
            </tr>
        </table>
        ';
        if ($pdf->GetY() >= '210.6375' ){
            $pdf->AddPage('P', 'LEGAL');
        }
$pdf->writeHTMLCell($w=0, $h=0, '', '', $texPie, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);

$formaPago = '<table>
              <tr>
                <td><b>Forma de pago :</b>&nbsp;&nbsp;&nbsp;&nbsp; 50% al colocal la orden de compra, saldo contra entrega.</td>
              </tr>
            </table>';
$pdf->writeHTMLCell($w=0, $h=0, '', '', $formaPago, $border=0, $ln=1, $fill=0, $reseth=true, $align='left', $autopadding=true);
$pdf->Output('factura.pdf', 'I');
die;
?>