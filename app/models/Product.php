<?php
class Product extends Eloquent
{
	protected $softDelete = true;	
	public function isValid(){
		$error = "";
		$pcode = Product::where('enterprice_id','=',Auth::user()->enterprice_id)->where('code','=',$this->code)->first();
		if($pcode)
			$error .= "El c&oacute;digo ya existe.<br>";
		if($this->code == "")
			$error .= "Debe introducir un c&oacute;digo del producto.<br>";
		if($this->name == "")
			$error .= "Debe introducir un nombre para el producto.<br>";
		if(!is_numeric($this->price))
			$error .= "Debe introducir un valor numerico en precio nominal.";
		return $error;
	}
}
?>