<?php
class Branch extends Eloquent
{
	protected $softDelete = true;
	public function getInvoiceNumber($id){
		DB::beginTransaction();
		$branch = DB::table('branches')->where('id',$id)->lockForUpdate()->first();
		$number = $branch->invoice_counter+1;
		DB::table('branches')->where('id',$id)->update(array('invoice_counter'=>$number));
		DB::commit();
		return $number;
	}
	public function isValid(){
		$error = "";
		if($this->name =="")
			$error .= "Debe introducir el nombre de la sucursal.<br>";
		if($this->activity == "")
			$error .= "Debe introducir la actividad de la sucursal.<br>";
		if($this->address =="")
			$error .= "Debe introducir la direcci&oacute;n de la sucursal.<br>";
		if($this->zone == "")
			$error .= "Debe introducir la zona de la sucursal.<br>";
		if($this->city == "")
			$error .= "Debe introducir la ciudad de la sucursal.<br>";
		if($this->state == "")
			$error .= "Debe introducir el municipio de la sucursal.<br>";
		if(!is_numeric($this->phone))
			$error .= "Debe introducir el n&uacute;mero de tel&eacute;fono.<br>";
		if(!is_numeric($this->process_number))
			$error .= "Debe introducir el n&uacute;mero de tramite.<br>";
		if(!is_numeric($this->authorization_number))
			$error .= "Debe introducir el n&uacute;mero de autorizaci&oacute;n.<br>";
		if(!is_numeric($this->number))
			$error .= "Debe introducir el n&uacute;mero de sucursal.<br>";
		if($this->dosage_key == "")
			$error .= "Debe introducir la llave de dosificaci&oacute;n.<br>";
		if($this->dosage_key == "")
			$error .= "Debe introducir la ley";
		return $error;
	}
}
?>