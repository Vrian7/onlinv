<?php 
class CustomClientController extends \BaseController{
	public function index(){
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data = [
			'custom' => $custom,
		];
		return View::make('custom_client.index',$data);
	}
	public function show($public_id){

	}
	public function create(){
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data = [
			'custom' => $custom,
		];
		return View::make('custom_client.create',$data);
	}
	public function store(){
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$custom->enterprice_id = Auth::user()->enterprice_id;
		if(Input::get('field1')!="")
			$custom->field1 = Input::get('field1');
		if(Input::get('field2')!="")
			$custom->field2 = Input::get('field2');
		if(Input::get('field3')!="")
			$custom->field3 = Input::get('field3');
		if(Input::get('field4')!="")
			$custom->field4 = Input::get('field4');
		if(Input::get('field5')!="")
			$custom->field5 = Input::get('field5');
		$validation = $custom->isValid();
		if($validation==""){
			$custom->save();
			Session::flash('title','Creacion de campos adicionales');
			Session::flash('text','Se crearon los campos correctamente..');
			return Redirect::to('campos_clientes');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('campos_cliente');
		}		
	}
	public function edit($public_id){
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data = [
			'custom' => $custom,
		];
		return View::make('custom_client.edit',$data);
	}
	public function update($public_id){
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		if(Input::get('field1')!="")
			$custom->field1 = Input::get('field1');
		if(Input::get('field2')!="")
			$custom->field2 = Input::get('field2');
		if(Input::get('field3')!="")
			$custom->field3 = Input::get('field3');
		if(Input::get('field4')!="")
			$custom->field4 = Input::get('field4');
		if(Input::get('field5')!="")
			$custom->field5 = Input::get('field5');
		$validation = $custom->isValid();
		if($validation==""){
			$custom->save();
			Session::flash('title','Edici&oacute;n de campos adicionales');
			Session::flash('text','Se modificaron los campos correctamente..');
			return Redirect::to('campos_clientes');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('campos_cliente');
		}
	}
	public function delete($public_id){
		
	}
}
?>