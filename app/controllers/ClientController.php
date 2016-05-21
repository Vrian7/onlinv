<?php 
class ClientController extends \BaseController{
	public function index(){
		$clients = Client::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data=[
			'clients' => $clients,
		];
		return View::make('client.index',$data);
	}
	public function show($public_id){
		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$data = [
			'client' => $client,
		];
		return View::make('client.show',$data);
	}
	public function create(){				
		return View::make('client.create');
	}
	public function store(){
		$client = new Client();
		$client->enterprice_id = Auth::user()->enterprice_id;
		$client->name = Input::get('name');
		$client->business_name = Input::get('business_name');
		$client->nit = Input::get('nit');
		$client->address = Input::get('address');
		$client->phone = Input::get('phone');
		$client->mail = Input::get('mail');
		$client->description = Input::get('description');
		$client->debt = 0;
		$client->flow = 0;
		$client->contact_data = Input::get('contact_data');				
		$validation = $client->isValid();
		if($validation==""){
			Session::flash('title','Creacion de cliente');
			Session::flash('text','Se cre&oacute; el cliente '.$client->name.' correctamente..');
			return Redirect::to('clientes');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('cliente');
		}		
	}
	public function edit($public_id){		
		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$data=[
			'client' => $client,
		];
		return View::make('client.edit',$data);	
	}
	public function update($public_id){
		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$client->name = Input::get('name');
		$client->business_name = Input::get('business_name');
		$client->nit = Input::get('nit');
		$client->address = Input::get('address');
		$client->phone = Input::get('phone');
		$client->mail = Input::get('mail');
		$client->description = Input::get('description');		
		$client->contact_data = Input::get('contact_data');		
		$client->save();
		return Redirect::to('clientes');
	}
	public function delete($public_id){

	}
	public function findByString(){
	$string = Input::get('name');
  /*$clients = Client::where('account_id','=', Auth::user()->account_id)->where('name','like',$cadena."%")->select('id','name','nit','business_name','public_id')->get();
        $total =0;
        foreach($clients as $key => $value) {
         $total++;
        }*/
  		//if($total==0)
   		$clients = Client::where('nit','like',$string."%")->where('enterprice_id','=', Auth::user()->enterprice_id)->select('id','name','nit','business_name','public_id')->get();
  		return Response::json($clients);  
	}
}
?>
