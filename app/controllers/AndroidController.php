<?php
class AndroidController extends \BaseController{
	public function loggin(){		
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();		
		$user = User::where('id',Auth::user()->id)->first();
		$branch = Branch::where('id',$user->branch_id)->first();				
		$products = Product::where("enterprice_id",$ent->id)->get();
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
			'products' => $products,
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
				'result' => '0',
				'status' => '0',
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
	public function storeInvoice(){

		$invoice = new Invoice();
		if(Input::get('client')==0){
			$client = new Client();
			$client->enterprice_id = Auth::user()->enterprice_id;			
			$client->business_name = Input::get('name');
			$client->name = Input::get('name');
			$client->nit = Input::get('nit');
			$client->save();
		}
		else{
			$client = Client::where('id',Input::get('client'))->first();
			$client->business_name = Input::get('name');		
			$client->nit = Input::get('nit');
			$client->save();
		}

		$client->debt = $client->debt + Input::get('total');
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$central = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('number',0)->first();
		$tool = new Tool();
		$date = date('Y-m-d');
		$invoice->enterprice_id = Auth::user()->enterprice_id;
		$invoice->branch_id = Auth::user()->branch_id;
		$invoice->branch_type_id = $branch->branch_type_id;
		$invoice->user_id = Auth::user()->id;
		$invoice->client_id = $client->id;
		$invoice->invoice_status_ids = 1;
		$invoice->nit = $client->nit;
		$invoice->client_name = $client->business_name;
		$invoice->client_nit = $client->nit;
		$invoice->authorization_number = $branch->authorization_number;
		$invoice->dosage_key = $branch->dosage_key;
		$invoice->matriz_address = $central->address;
		$invoice->city = $branch->city;
		$invoice->country = "no";//$branch->country;
		$invoice->deadline = $branch->deadline;
		$invoice->net_amount = Input::get('total');
		$invoice->debt = Input::get('total');
		$invoice->total_amount = Input::get('subtotal');
		$invoice->taxable_amount = Input::get('total');
		$invoice->tax_amount = $invoice->taxable_amount * 0.13;
		$invoice->ice_amount = 0;
		$invoice->excent_amount = 0;
		$invoice->discount = $invoice->total_amount - $invoice->net_amount;
		$invoice->exchange = 6.96;
		$invoice->net_amount_dollar = 0;
		//$date_send = Input::get('date');
		//$date_send = explode('/',$date_send);
		$invoice->date = $date; //$date_send[2].'-'.$date_send[1].'-'.$date_send[0];
		$invoice->notes = "";
		$invoice->legend = $branch->legend;
		$invoice->number = $branch->getInvoiceNumber($branch->id);
		//$fecha = date('d/m/Y');//trim(Input::get('date'));
        //$fecha=  explode("/",$fecha);
        //$date=$fecha[2].$fecha[1].$fecha[0];           
		//$date = date('d/m/Y');
		$date = date('Ymd');
//		return $invoice->number." - ".$invoice->nit." - ".$date." - ".$invoice->net_amount." - ".$invoice->authorization_number." - ".$invoice->dosage_key;
//		return 0;
		$invoice->control_code =$tool->generateControlCode($invoice->number,$invoice->nit,$date,$invoice->net_amount,$invoice->authorization_number,$invoice->dosage_key);
		//print_r($invoice);
		//return;	
		$invoice->save();
		$invoice->setTracing(1,Auth::user()->name,'hola');
		foreach (Input::get('products') as $key => $producto) {
			if($producto['code']!=""){
			$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('code',$producto['code'])->first();
			$inventory = Inventory::where('enterprice_id',Auth::user()->enterprice_id)->where('branch_id',$invoice->branch_id)->where('product_id',$product->id)->first();
			if($inventory){
			$inventory->stock = $inventory->stock-$producto['quantity'];			
			$inventory->sold = $inventory->sold + $producto['quantity'];
			$inventory->save(); 
			}
			$detail = new InvoiceDetail();			
			$detail->enterprice_id = Auth::user()->enterprice_id;
			$detail->invoice_id = $invoice->id;			
			$detail->product_id = $product->id;
			$detail->code = $producto['code'];
			$detail->name = $producto['name'];
			$detail->price = $producto['price'];
			$detail->quantity = $producto['quantity'];						
			$detail->save();
			}
		}				
		$importe = number_format((float)$invoice->net_amount, 2, '.', '');
		$num = explode(".", $importe);
		if(!isset($num[1]))
    	$num[1]="00";
		$literal = $tool->to_string($num[0] ).substr($num[1],0,2);
		$date = date('d/m/Y');
		$hour = date('h:i:s');
		$data = [
			'id' => $invoice->id,
			'literal' => $literal,
			'enterprice_id' => Auth::user()->enterprice_id,
			'number' => $invoice->number,
			'control_code' => $invoice->control_code,
			'date' => $date,
			'hour' => $hour,
		];
		return Response::json($data);
	}

	public function storeQuote(){

		$invoice = new Quote();
		if(Input::get('client')==0){
			$client = new Client();
			$client->enterprice_id = Auth::user()->enterprice_id;			
			$client->business_name = Input::get('name');
			$client->name = Input::get('name');
			$client->nit = Input::get('nit');
			$client->save();
		}
		else{
			$client = Client::where('id',Input::get('client'))->first();
			$client->business_name = Input::get('name');		
			$client->nit = Input::get('nit');
			$client->save();
		}

		//$client->debt = $client->debt + Input::get('total');
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$central = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('number',0)->first();
		$tool = new Tool();
		$date = date('Y-m-d');
		$invoice->enterprice_id = Auth::user()->enterprice_id;
		$invoice->branch_id = Auth::user()->branch_id;
		//$invoice->branch_type_id = $branch->branch_type_id;
		$invoice->user_id = Auth::user()->id;
		$invoice->client_id = $client->id;
		//$invoice->invoice_status_ids = 1;
		$invoice->nit = $client->nit;
		$invoice->client_name = $client->business_name;
		$invoice->client_nit = $client->nit;
		//$invoice->authorization_number = $branch->authorization_number;
		//$invoice->dosage_key = $branch->dosage_key;
		//$invoice->matriz_address = $central->address;
		$invoice->city = $branch->city;
		$invoice->country = "no";//$branch->country;
		$invoice->deadline = $branch->deadline;
		$invoice->net_amount = Input::get('total');
		$invoice->debt = Input::get('total');
		$invoice->total_amount = Input::get('subtotal');
		//$invoice->taxable_amount = Input::get('total');
		//$invoice->tax_amount = $invoice->taxable_amount * 0.13;
		$invoice->ice_amount = 0;
		//$invoice->excent_amount = 0;
		$invoice->discount = $invoice->total_amount - $invoice->net_amount;
		$invoice->exchange = 6.96;
		$invoice->net_amount_dollar = 0;
		//$date_send = Input::get('date');
		//$date_send = explode('/',$date_send);
		$invoice->date = $date; //$date_send[2].'-'.$date_send[1].'-'.$date_send[0];
		$invoice->notes = "";
		$invoice->legend = $branch->legend;
		$invoice->number = $branch->getInvoiceNumber($branch->id);
		//$fecha = date('d/m/Y');//trim(Input::get('date'));
        //$fecha=  explode("/",$fecha);
        //$date=$fecha[2].$fecha[1].$fecha[0];           
		//$date = date('d/m/Y');
		$date = date('Ymd');
//		return $invoice->number." - ".$invoice->nit." - ".$date." - ".$invoice->net_amount." - ".$invoice->authorization_number." - ".$invoice->dosage_key;
//		return 0;
		//$invoice->control_code =$tool->generateControlCode($invoice->number,$invoice->nit,$date,$invoice->net_amount,$invoice->authorization_number,$invoice->dosage_key);
		//print_r($invoice);
		//return;	
		$invoice->save();
		//$invoice->setTracing(1,Auth::user()->name,'hola');
		foreach (Input::get('products') as $key => $producto) {
			if($producto['code']!=""){
			$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('code',$producto['code'])->first();
			$inventory = Inventory::where('enterprice_id',Auth::user()->enterprice_id)->where('branch_id',$invoice->branch_id)->where('product_id',$product->id)->first();
			if($inventory){
			$inventory->stock = $inventory->stock-$producto['quantity'];			
			$inventory->sold = $inventory->sold + $producto['quantity'];
			$inventory->save(); 
			}
			$detail = new InvoiceDetail();			
			$detail->enterprice_id = Auth::user()->enterprice_id;
			$detail->invoice_id = $invoice->id;			
			$detail->product_id = $product->id;
			$detail->code = $producto['code'];
			$detail->name = $producto['name'];
			$detail->price = $producto['price'];
			$detail->quantity = $producto['quantity'];						
			$detail->save();
			}
		}				
		$importe = number_format((float)$invoice->net_amount, 2, '.', '');
		$num = explode(".", $importe);
		if(!isset($num[1]))
    	$num[1]="00";
		$literal = $tool->to_string($num[0] ).substr($num[1],0,2);
		$date = date('d/m/Y');
		$hour = date('h:i:s');
		$data = [
			'id' => $invoice->id,
			'literal' => $literal,
			'enterprice_id' => Auth::user()->enterprice_id,
			'number' => $invoice->number,
			'control_code' => $invoice->control_code,
			'date' => $date,
			'hour' => $hour,
		];
		return Response::json($data);
	}
}
?>