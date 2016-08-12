<?php
class Client extends Eloquent
{
	protected $softDelete = true;	
	public function isValid(){
		$error = "";
		if($this->business_name == "")
			$error .= "Debe introducir una raz&oacute;n social.<br>";		
		if($this->nit == "")
			$error .= "Debe introducir un nit<br>";
		else
			if(!is_numeric($this->nit))
			$error .= "El nit solo debe contener digitos";
		return $error;		
	}
}
?>