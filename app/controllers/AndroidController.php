<?php
class AndroidController extends \BaseController{
	public function loggin(){
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$user = User::where('id',Auth::user()->id)->first();
		$branch = Branch::where('id',$user->branch_id)->first();				
		$data = [
			'result' => 0,
			'id' => $ent->id,
			'name' => $ent->name,
			'branch_id' => $branch->id,
			'branch' => $branch->name,
			'owner' => $ent->owner,
			'address' => $branch->address,
			'phone' => $branch->phone,
			'city' => $branch->city,
			'country' => $branch->state,
			'title' => 'FACTURA',
			'nit' => $ent->nit,
			'authorization' => $branch->authorization_number,
			'dead_line' => $branch->deadline,
			'law' => $branch->legend,
			'activity' => $branch->economic_activity,
			'username' => $user->name,
		];
		return Response::json($data);
	}
	public function getClient($nit){
		//$nit = Input::get('nit');

		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->where('nit',$nit)->select('public_id','nit','business_name','name')->first();
		//$custom = CustomClient::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$data = [
			//'client' => $client,
		//	'custom' => $custom,
			'id' => $client->public_id,
			'business_name' => $client->business_name,
			'nit' => $client->nit,
			'name' => $client->name,
		];
		return Response::json($data);
	}
	public function storeClient(){
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
		// if(Input::get('field1'))
		// 	$client->extra1 = Input::get('field1');
		// if(Input::get('field2'))
		// 	$client->extra2 = Input::get('field2');
		// if(Input::get('field3'))
		// 	$client->extra3 = Input::get('field3');
		// if(Input::get('field4'))
		// 	$client->extra4 = Input::get('field4');
		// if(Input::get('field5'))
		// 	$client->extra5 = Input::get('field5');
		$validation = $client->isValid();
		if($validation==""){
			$client->save();
			$data = [
				'result' => 0,
				'status' => 0,
				'message' => 'Se guardo correctamente al cliente'
			];
			return Response::json($data);
		}
		else
		{
			$data = [
				'result' => 0,
				'status' => 0,
				'message' => $validation,
			];
			return Response::json($data);
		}		
	}
	public function updateClient($public_id){		
		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$client->business_name = Input::get('business_name');
		$client->nit = Input::get('nit');		
		$client->save();
		$data = [
			'restul' => '0'
		];
		return Response::json($data);
	}

}
?>