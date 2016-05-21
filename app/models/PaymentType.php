<?php
class PaymentType extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";
		return $error;
	}
}
?>