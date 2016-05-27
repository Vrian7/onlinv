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
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data = [
			'client' => $client,
			'custom' => $custom,
		];
		return View::make('client.show',$data);
	}
	public function create(){				
		$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data = [			
			'custom' => $custom,
		];
		return View::make('client.create',$data);
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
		if(Input::get('field1'))
			$client->extra1 = Input::get('field1');
		if(Input::get('field2'))
			$client->extra2 = Input::get('field2');
		if(Input::get('field3'))
			$client->extra3 = Input::get('field3');
		if(Input::get('field4'))
			$client->extra4 = Input::get('field4');
		if(Input::get('field5'))
			$client->extra5 = Input::get('field5');
		$validation = $client->isValid();
		if($validation==""){
			$client->save();
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
		$custom = CustomCLient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data=[
			'client' => $client,
			'custom' => $custom,
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
		if(Input::get('field1'))
			$client->extra1 = Input::get('field1');
		if(Input::get('field2'))
			$client->extra2 = Input::get('field2');
		if(Input::get('field3'))
			$client->extra3 = Input::get('field3');
		if(Input::get('field4'))
			$client->extra4 = Input::get('field4');
		if(Input::get('field5'))
			$client->extra5 = Input::get('field5');
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
