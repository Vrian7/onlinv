<?php
class Client extends Eloquent
{
	protected $softDelete = true;	
	public function isValid(){
		$error = "";
		if($this->business_name == "")
			$error .= "Debe introducir una razon social<br>";		
		if($this->nit == "")
			$error .= "Debe introducir un nit<br>";
		if(!is_numeric($this->nit))
			$error .= "El nit solo debe contener digitos";
		return $error;		
	}
}
?>