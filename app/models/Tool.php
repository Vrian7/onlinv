<?php 
class Tool
{
	/*** STARTING GENERATION CONTROL CODE***/
	
   public function generateControlCode($nroFactura_e, $nit_ci_e, $fecha_e, $monto_e, $nroAutorizacion_e, $llavedosif){
        $llave=trim($llavedosif);
        $nroAutorizacion=trim($nroAutorizacion_e);
        $nit_ci=trim($nit_ci_e);
        $fecha=trim($fecha_e);//formato aceptado AAAAMMDD
        $monto=trim($monto_e);
        $nroFactura=trim($nroFactura_e);
        //generando el codigo de control
        $codigo=$this->generarCodigo($nroFactura, $nit_ci, $fecha, $monto, $llave, $nroAutorizacion);
        return $codigo;
    }

    private function getInvierteCadena($cadena) {
        $j = strlen($cadena) - 1;
        $cadenaInv = "";
        for ($i = 0; strlen($cadena) > $i; $i++) {
            $cadenaInv = $cadenaInv . $cadena[$j];
            $j--;
        }
        return $cadenaInv;
    }

    private function getVerhoeff($cifra) {

        $mul = array(
            array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
            array(1, 2, 3, 4, 0, 6, 7, 8, 9, 5),
            array(2, 3, 4, 0, 1, 7, 8, 9, 5, 6),
            array(3, 4, 0, 1, 2, 8, 9, 5, 6, 7),
            array(4, 0, 1, 2, 3, 9, 5, 6, 7, 8),
            array(5, 9, 8, 7, 6, 0, 4, 3, 2, 1),
            array(6, 5, 9, 8, 7, 1, 0, 4, 3, 2),
            array(7, 6, 5, 9, 8, 2, 1, 0, 4, 3),
            array(8, 7, 6, 5, 9, 3, 2, 1, 0, 4),
            array(9, 8, 7, 6, 5, 4, 3, 2, 1, 0),
        );
        $per = array(array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
            array(1, 5, 7, 6, 2, 8, 3, 0, 9, 4),
            array(5, 8, 0, 3, 7, 9, 6, 1, 4, 2),
            array(8, 9, 1, 6, 0, 4, 3, 5, 2, 7),
            array(9, 4, 5, 3, 1, 2, 6, 8, 7, 0),
            array(4, 2, 8, 6, 5, 7, 3, 9, 0, 1),
            array(2, 7, 9, 3, 8, 0, 6, 4, 1, 5),
            array(7, 0, 4, 6, 9, 1, 3, 2, 5, 8),);

        $inv = array(0, 4, 3, 2, 1, 5, 6, 7, 8, 9);

        $check = 0;

        $cadena = $cifra;

        $getInvierteCadena = 'getInvierteCadena';
        
        $numeroInvertido = $this->$getInvierteCadena($cadena);

        for ($i = 0; strlen($numeroInvertido) > $i; $i++) {

            $check = $mul[$check][$per[($i + 1) % 8][$numeroInvertido[$i]]];
        }

        return $inv[$check];
    }

    private function rellenaCero($valor) {
        if (strlen($valor) < 2) {
            $valor = "0" . $valor;
        }
        return $valor;
    }

    private function cifrarMensajeRC4($mensaje, $key) {
        $state = array();

        $x = 0;
        $y = 0;
        $index1 = 0;
        $index2 = 0;
        $mensajeCifrado = "";

        for ($i = 0; 256 > $i; $i++) {
            $state[$i] = $i;
        }

        for ($i = 0; 256 > $i; $i++) {
            $index2 = (ord($key[$index1]) + $state[$i] + $index2) % 256;

            $aux = $state[$i];
            $state[$i] = $state[$index2];
            $state[$index2] = $aux;
            $index1 = ($index1 + 1) % strlen($key);
        }

        for ($i = 0; strlen($mensaje) > $i; $i++) {
            $x = ($x + 1) % 256;
            $y = ($state[$x] + $y) % 256;
            $aux = $state[$x];
            $state[$x] = $state[$y];
            $state[$y] = $aux;
            $NMen = ord($mensaje[$i]) ^ $state[($state[$x] + $state[$y]) % 256];

            $rellenaCero = 'rellenaCero';
            $mensajeCifrado = $mensajeCifrado . "-" . $this->$rellenaCero(dechex($NMen));
        }

        return strtoupper(substr($mensajeCifrado, 1, strlen($mensajeCifrado) - 1));
    }

    private function obtenerBase64($numero) {
        $diccionario = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+/";
        $cociente = 1;

        $palabra = "";

        while ($cociente > 0) {
            $cociente = (int) ($numero / 64);
            $resto = $numero % 64;
            $palabra = $diccionario[$resto] . $palabra;
            $numero = $cociente;
        }

        return $palabra;
    }

    private function generarCodigo($nroFactura, $nit, $fechaTransaccion, $montoTransaccion, $llave, $nroAutoriza) {
        $getVerhoeff = 'getVerhoeff';

        $i_montoTransaccion = round($montoTransaccion);

        $s_nroFactura = 0;
        $s_nit = 0;
        $s_fechaTransaccion = 0;
        $s_montoTransaccion = 0;

        $s_nroFactura = $nroFactura . $this->$getVerhoeff($nroFactura . "") . $this->$getVerhoeff($nroFactura . $this->$getVerhoeff($nroFactura . ""));
        
        $s_nit = $nit . $this->$getVerhoeff($nit . "") . $this->$getVerhoeff($nit . $this->$getVerhoeff($nit . ""));
        
        $s_fechaTransaccion = $fechaTransaccion . $this->$getVerhoeff($fechaTransaccion . "") . $this->$getVerhoeff($fechaTransaccion . $this->$getVerhoeff($fechaTransaccion . ""));

        $s_montoTransaccion = $i_montoTransaccion . $this->$getVerhoeff($i_montoTransaccion . "") . $this->$getVerhoeff($i_montoTransaccion . $this->$getVerhoeff($i_montoTransaccion . ""));
        

        $suma = $s_nroFactura + $s_nit + $s_fechaTransaccion + $s_montoTransaccion;        

        $digitos5[0] = $this->$getVerhoeff($suma . "");
        $digitos5[1] = $this->$getVerhoeff($suma . $digitos5[0] . "");
        $digitos5[2] = $this->$getVerhoeff($suma . $digitos5[0] . $digitos5[1] . "");
        $digitos5[3] = $this->$getVerhoeff($suma . $digitos5[0] . $digitos5[1] . $digitos5[2] . "");
        $digitos5[4] = $this->$getVerhoeff($suma . $digitos5[0] . $digitos5[1] . $digitos5[2] . $digitos5[3] . "");

        $digitos51 = array();
        for ($i = 0; count($digitos5) > $i; $i++) {

            $digitos51[$i] = $digitos5[$i] + 1;
        }        

        $s_nroAutoriza = $nroAutoriza . substr($llave, 0, $digitos51[0]);
        
        $s_nroFactura = $s_nroFactura . substr($llave, $digitos51[0], $digitos51[1]);

        $s_nit = $s_nit . substr($llave, $digitos51[0] + $digitos51[1], $digitos51[2]);
        
        $s_fechaTransaccion = $s_fechaTransaccion . substr($llave, $digitos51[0] + $digitos51[1] + $digitos51[2], $digitos51[3]);
        $s_fechaTransaccion = str_replace(' ', '+', $s_fechaTransaccion);        
        $s_montoTransaccion = $s_montoTransaccion . substr($llave, $digitos51[0] + $digitos51[1] + $digitos51[2] + $digitos51[3], $digitos51[4]);
        

        $concatenada = $s_nroAutoriza . $s_nroFactura . $s_nit . $s_fechaTransaccion . $s_montoTransaccion;
        
        $cifrarMensajeRC4 = 'cifrarMensajeRC4';
        $llave = str_replace(' ', '+', $llave);

        $digitos5 = $digitos5[0] . $digitos5[1] . $digitos5[2] . $digitos5[3] . $digitos5[4];    
        $cad = $this->$cifrarMensajeRC4($concatenada . "", $llave . $digitos5 . "");
        
        $cad = str_replace('-', '', $cad);       
        $index1 = 0;
        $index2 = 1;
        $index3 = 2;
        $index4 = 3;
        $index5 = 4;
        $sum1 = 0;
        $sum2 = 0;
        $sum3 = 0;
        $sum4 = 0;
        $sum5 = 0;

        for ($i = 0; strlen($cad) > $i; $i++) {
            if ($index1 == $i) {
                $sum1 = $sum1 + ord($cad[$index1]);
                $index1 = $index1 + 5;
            }

            if ($index2 == $i) {
                $sum2 = $sum2 + ord($cad[$index2]);
                $index2 = $index2 + 5;
            }

            if ($index3 == $i) {
                $sum3 = $sum3 + ord($cad[$index3]);
                $index3 = $index3 + 5;
            }

            if ($index4 == $i) {
                $sum4 = $sum4 + ord($cad[$index4]);
                $index4 = $index4 + 5;
            }

            if ($index5 == $i) {
                $sum5 = $sum5 + ord($cad[$index5]);
                $index5 = $index5 + 5;
            }
        }

        $st = $sum1 + $sum2 + $sum3 + $sum4 + $sum5;

        $sum1 = (int) (($st * $sum1) / $digitos51[0]);

        $sum2 = (int) (($st * $sum2) / $digitos51[1]);

        $sum3 = (int) (($st * $sum3) / $digitos51[2]);

        $sum4 = (int) (($st * $sum4) / $digitos51[3]);

        $sum5 = (int) (($st * $sum5) / $digitos51[4]);

        $sumST = $sum1 + $sum2 + $sum3 + $sum4 + $sum5;

        $obtenerBase64 = 'obtenerBase64';

        $base64 = $this->$obtenerBase64($sumST . "");

        $codigo = $this->$cifrarMensajeRC4($base64, $llave . $digitos5);

        return $codigo;
    }

    /***  END GENERATION CONTROL CODE***/

    /*** START NUMBER TO STRING **/
    private $UNIDADES = [
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];
    private $DECENAS = [
        'VEINTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];
    private $CENTENAS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];
    private $MONEDAS = [
        ['country' => 'Colombia', 'currency' => 'COP', 'singular' => 'PESO COLOMBIANO', 'plural' => 'PESOS COLOMBIANOS', 'symbol', '$'],
        ['country' => 'Estados Unidos', 'currency' => 'USD', 'singular' => 'DÓLAR', 'plural' => 'DÓLARES', 'symbol', 'US$'],
        ['country' => 'Europa', 'currency' => 'EUR', 'singular' => 'EURO', 'plural' => 'EUROS', 'symbol', '€'],
        ['country' => 'México', 'currency' => 'MXN', 'singular' => 'PESO MEXICANO', 'plural' => 'PESOS MEXICANOS', 'symbol', '$'],
        ['country' => 'Perú', 'currency' => 'PEN', 'singular' => 'NUEVO SOL', 'plural' => 'NUEVOS SOLES', 'symbol', 'S/'],
        ['country' => 'Reino Unido', 'currency' => 'GBP', 'singular' => 'LIBRA', 'plural' => 'LIBRAS', 'symbol', '£']
    ];
    public function to_string($number, $miMoneda = null)
    {   
        if ($miMoneda !== null) {
            try {
                
                $moneda = array_filter($this->MONEDAS, function($m) use ($miMoneda) {
                    return ($m['currency'] == $miMoneda);
                });
                $moneda = array_values($moneda);
                if (count($moneda) <= 0) {
                    throw new Exception("Tipo de moneda inválido");
                    return;
                }
                if ($number < 2) {
                    $moneda = $moneda[0]['singular'];
                } else {
                    $moneda = $moneda[0]['plural'];
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }
        } else {
            $moneda = " ";
        }
        $converted = '';
        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', $this->convertGroup($millones));
            }
        }
        
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', $this->convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', $this->convertGroup($cientos));
            }
        }
        $converted .= $moneda;
        return $converted;
    }
    private function convertGroup($n)
    {
        $output = '';
        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = $this->CENTENAS[$n[0] - 1];   
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= $this->UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
            }
        }
      
        return $output;
    }
    /** END NUMBER TO STRING ***/
}
?>