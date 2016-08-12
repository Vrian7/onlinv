<?php
class Unit extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";		
		if($this->name == ""){
			$error .= "Ingrese nombre de unidad.<br>";						
		}
		else{
			$vname = Unit::where('enterprice_id','=',Auth::user()->enterprice_id)->where('name','=',$this->name)->first();
			if($vname)
				$error .= "Debe introducir un nombre distinto.<br>";
		}
		if($this->symbol == ""){
			$error = $error . "Ingrese un símbolo para la unidad.<br>";
		}
		else{
			$vsymbol = Unit::where('enterprice_id','=',Auth::user()->enterprice_id)->where('symbol','=',$this->symbol)->first();
			if($vsymbol)
				$error .= "Debe introducir un s&iacute;mbolo distinto."; 
		}
		return $error;
	}
}
?>