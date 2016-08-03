<?php
class Alert extends Eloquent
{
	protected $softDelete = true;
	public function isValid(){
		$error = "";
		return $error;
	}
	public function add($title,$message,$level,$description){
		$this->enterprice_id = 	Auth::user()->enterprice_id;
		$this->title = $title;
		$this->message = $message;
		$this->level_id = $level;
		$this->message = $message;
		$this->description = $description;
		$this->date = date('Y-m-d');
		$this->time = date('hh:mm:ii');
		$this->read = 0;
		$this->save();
	}
}
?>