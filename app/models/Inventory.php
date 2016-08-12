<?php
class Inventory extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";
		/*$vbranch_id=Inventory::where('enterprice_id','=',Auth::user()->enterprice_id)->where('branch_id','=',$this->branch_id)->first();
		if($vbranch_id)
		if($this->branch_name =="")	
			$error .= "Debe seleccionar una sucursal.<br>";*/
		if($this->stock == "")
			$error .= "Debe introducir la existencia del producto.<br>";
		else
			if(!is_numeric($this->stock))
				$error .= "Debe de introducir un dato numerico en existencia.<br>";
		if($this->average == "")
			$error .= "Debe introducir el promedio del producto.<br>";
		else
			if(!is_numeric($this->average))
				$error .= "Debe de introducir un dato numerico en promedio.<br>";
		if($this->minimum == "")
			$error .= "Debe introducir el minimo del producto.<br>";
		else
			if(!is_numeric($this->minimum))
				$error .= "Debe de introducir un dato numerico en minimo.";	
		return $error;


	}
}
?>