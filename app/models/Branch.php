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
		return $error;
	}
}
?>