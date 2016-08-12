<?php
class Brand extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";
		if($this->name =="")
			$error .= "Ingrese el nombre de la marca.<br>";
		else{
			$vname=Unit::where('enterprice_id','=',Auth::user()->enterprice_id)->where('name','=',$this->name)->first();
			if($vname)
				$error .= "Ingrese un nombre de marca distinto.<br>";
		}
		if($this->manofacturer =="")
			$error .= "Ingrese el nombre del manofacturador.<br>";
		if($this->provider =="")
			$error .= "Ingrese el nombre del proveedor.<br>";
		return $error;
	}
}
?>