<?php
class Unit extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";
		if($this->name == ""){
			$error = $error . "Ingrese nombre de unidad.<br>";
		}
		if($this->symbol == "")
			$error = $error . "Ingrese un símbolo para la unidad.<br>";		
		return $error;
	}
}
?>