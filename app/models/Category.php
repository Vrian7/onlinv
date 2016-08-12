<?php
class Category extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";
		if($this->name == "")
			$error .= "Debe introducir el nombre de la categor&iacute;a.";
		return $error;
	}
}
?>