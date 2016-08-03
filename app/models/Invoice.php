<?php
class Invoice extends Eloquent
{
	protected $softDelete = true;
	/*** OPTOINS ACTIONS
	1.- CAST
	 END OPTIONS***/
	public function setTracing($action,$user,$reason){
		$title = "FACTURA EMITIDA";
		
		$json = json_decode($this->tracing);
		$new = array();
		//if($json!=null)		
		
		$obj = [];
		$obj['date'] = date('d-m-Y H:i:s');
		switch ($action) {
			case 1:
				$obj['title'] = "FACTURA EMITIDA";				
				$obj['note'] = "El usuario <strong> ".$user." </strong> emitio la actual factura.";
				break;
			case 2:
				$obj['title'] = "FACTURA ANULADA";				
				$obj['note'] = "El usuario <strong> ".$user." </strong> anul&oacute; esta factura Por: .".$reason;
				break;
			case 3:
				$obj['title'] = "FACTURA ENVIADA";				
				$obj['note'] = "El usuario <strong> ".$user." </strong> envi&oacute; esta factira a: .".$reason;
				break;
			case 4:
				$obj['title'] = "FACTURA COPIA";				
				$obj['note'] = "El usuario <strong> ".$user." </strong> emiti&oacute; una copia para: .".$reason;
				break;
			case 5:
				$obj['title'] = "PAGO PARCIAL";				
				$obj['note'] = "El usuario <strong> ".$user." </strong> cobr&oacute;: .".$reason.' de esta factura';
				break;
			case 6:
				$obj['title'] = "PAGO COMPLETO";				
				$obj['note'] = "El usuario <strong> ".$user." </strong> complet&oacute; el cobro de esta facura con el monto de:".$reason;
				break;
			default:
				# code...
				break;
		}
		array_push($new, $obj);
		if($json != '')
		foreach ($json as $key => $value) {
			array_push($new, $value);
		}
		$this->tracing = json_encode($new);

		$this->save();

		//print_r(json_encode($new));
		return;
	}

	public function getTracing(){
		return json_decode($this->tracing);
	}
	public function isValid(){	
		$error = "";
		return $error;
	}
}
?>