<?php 
class InvoiceController extends \BaseController{
	public function index(){
		/*$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$data = [
			'link' => "hola.com",
			'enterprice' => $ent->name,
		];
		return View::make('mail.invoice',$data);
		return;*/
		$invoices = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('branch_id',Auth::user()->branch_id)->orderBy('public_id','desc')->get();
		$statuses = InvoiceStatus::get();
		//$statusvar = [];
		foreach ($statuses as $key => $status) {
			$statusvar[$status->id] = $status->name;
		}
		//print_r($statusvar);
		//return;		
		$data = [
			'invoices' => $invoices,
			'statuses' => $statusvar,
		];
		return View::make('invoice.index',$data);
	}
	public function show($public_id){
		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$products = InvoiceDetail::where('invoice_id',$invoice->id)->get();
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$data = [
			'invoice' => $invoice,			
			'products' => $products,
			'logo' => $ent->logo,
			'tracing' => $invoice->getTracing(),
		];
		return View::make('invoice.show',$data);
	}
	public function showStandard($public_id){
		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$products = InvoiceDetail::where('invoice_id',$invoice->id)->get();
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$branch = Branch::where('id',$invoice->branch_id)->first();
		$data = [
			'invoice' => $invoice,			
			'products' => $products,
			'logo' => $ent->logo,
			'type' => 'ORIGINAL',
			'branch' => $branch
		];
		return View::make('invoice.view3',$data);	
		if($invoice->branch_type_id == 1 )
			return View::make('invoice.view2',$data);	
		else
			return View::make('invoice.view',$data);	
	}
	public function showClient($enterprice_id,$public_id){
		$invoice = Invoice::where('enterprice_id',$enterprice_id)->where('public_id',$public_id)->first();
		$products = InvoiceDetail::where('invoice_id',$invoice->id)->get();
		$ent = Enterprice::where('id',$enterprice_id)->first();
		$branch = Branch::where('id',$invoice->branch_id)->first();
		$data = [
			'invoice' => $invoice,			
			'products' => $products,
			'logo' => $ent->logo,
			'type' => 'ORIGINAL',
			'branch' => $branch,
		];
		if($invoice->branch_type_id == 1 )
			return View::make('invoice.view2',$data);	
		else
			return View::make('invoice.view',$data);	
	}
	public function showCopy($public_id){
		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$products = InvoiceDetail::where('invoice_id',$invoice->id)->get();
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$branch = Branch::where('id',$invoice->branch_id)->first();
		$data = [
			'invoice' => $invoice,
			'products' => $products,
			'logo' => $ent->logo,
			'type' => 'Copia para: '.Input::get('copy'),
			'branch' => $branch,
			'number' => $invoice->number,
			'public_id' => $invoice->public_id,
		];	
		return View::make('invoice.view3',$data);		
		if($invoice->branch_type_id == 1)
			return View::make('invoice.view2',$data);	
		else
			return View::make('invoice.view',$data);	
	}
	public function create(){
		$products = Product::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->where('nit',0)->where('business_name','Sin Nombre')->where('name','Sin Nombre')->first();
		$today = date("Y-m-d");

		$today_time = strtotime($today);
		$last_invoice= Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('branch_id',Auth::user()->branch_id)->max('date');
		//return $last_invoice;
        $last_date=  strtotime($last_invoice);
        $secs = $today_time - $last_date;
        $days = $secs / 86400;
        $days--;
        $today = date('d/m/Y');

		if(!$client)
			$nit = 0;
		else
			$nit = $client->id;
		$data = [
			'products' => $products,
			'last_invoice_date' => 5,
			'nit' => $nit,
			'today' => $today,
			'min_date' => '"-'.$days.'D"',
		];
		return View::make('invoice.createFinning',$data);
		return View::make('invoice.create',$data);
	}
	public function store(){		
		/*echo Input::get('client').' '.Input::get('razon').' '.Input::get('nit');
		return 0;*/
		if(Input::get('client')==0){
			$client = new Client();
			$client->enterprice_id = Auth::user()->enterprice_id;			
			$client->business_name = Input::get('razon');
			$client->name = Input::get('razon');
			$client->nit = Input::get('nit');
			$client->save();
		}
		else{
			$client = Client::where('id',Input::get('client'))->first();
			$client->business_name = Input::get('razon');		
			$client->nit = Input::get('nit');
			$client->save();
		}

		$client->debt = $client->debt+Input::get('total');
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$central = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('number',0)->first();
		$tool = new Tool();
		$invoice = new Invoice();
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
		$invoice->discount = Input::get('descuento_send');
		$invoice->exchange = 6.96;
		$invoice->net_amount_dollar = 0;
		$date_send = Input::get('date');
		$date_send = explode('/',$date_send);
		$invoice->date = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];
		$invoice->notes = "";
		$invoice->legend = $branch->legend;
		///$invoice->especification = "";
		$invoice->number = $branch->getInvoiceNumber($branch->id);
		$fecha = trim(Input::get('date'));
        $fecha=  explode("/",$fecha);            
        $date=$fecha[2].$fecha[1].$fecha[0];           
		$invoice->control_code =$tool->generateControlCode($invoice->number,$invoice->nit,$date,$invoice->net_amount,$invoice->authorization_number,$invoice->dosage_key);
		$invoice->save();	
		$invoice->setTracing(1,Auth::user()->name,'hola');
		foreach (Input::get('productos') as $key => $producto) {
			if($producto['code']!=""){
			$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('code',$producto['code'])->first();			
			$inventory = Inventory::where('enterprice_id',Auth::user()->enterprice_id)->where('branch_id',$invoice->branch_id)->where('product_id',$product->id)->first();
			if($inventory){
			$inventory->stock = $inventory->stock-$producto['quantity'];			
			$inventory->sold = $inventory->sold + $producto['quantity'];
			if($inventory->stock <= $inventory->minimum)
			{
				$alert = new Alert();
				$alert->add('Producto por acabarse','Se esta agotando el producto: '.$product->name.'.',4,'El producto : '.$product->code.': '.$product->name.' solo cuenta con : '.$inventory->stock.' unidades.');
			}				
			if($inventory->stock > $inventory->average)
			{
				$alert = new Alert();
				$alert->add('Producto exedente','Se tiene un excedente del producto: '.$product->name.'.',4,'El producto : '.$product->code.': '.$product->name.' excede con: '.$inventory->stock.' unidades.');
			}				
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
		$inv = Invoice::where('id',$invoice->id)->first();
		$data = [
			'public_id' => $inv->public_id,
			'number' => $inv->number,
		];
		// if($invoice->branch_type_id == 1)
		// 	return View::make('invoice.view2',$data);	
		// else
		// 	return View::make('invoice.view',$data);	
		return View::make('invoice.showStandard',$data);
	}
	public function edit($public_id){

		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		//print_r($invoice->getTracing());
		//return ;
		$invoice->setTracing(1,'Juancito pinto2','hola');
		return ;
	}
	public function update($public_id){
		//MAIL
		if(Input::get('action')==1){
			$this->sendInvoice($public_id,Input::get('name'),Input::get('mail'));			
			return Redirect::to('facturas');	
		}
		//COPY
		if(Input::get('action')==2){
			$inv = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
			$data = [
				'public_id' => $inv->public_id,
				'number' => $inv->number,
				'copy' => Input::get('copy'),
			];
			$alert = new Alert();
			$alert->add('Generacion de copia','Se genero una copia de la factura '.$inv->number.'.',2,'factura generada por: '.Auth::user()->name.' con destino a: '.Input::get('cancel'));
			return View::make('invoice.showCopy',$data);			
		}
		//CANCEL
		if(Input::get('action')==3){			
			$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
					
			$invoice->invoice_status_ids = "2";
			Session::flash('title','Factura Anulada');
			Session::flash('text','Se anuló la factura: '.$invoice->number.' debido a: '.Input::get('cancel'));
			$invoice->save();
			$invoice->setTracing(2,Auth::user()->name,Input::get('cancel'));
			$alert = new Alert();
			$alert->add('Factura anulada','La factura '.$invoice->number.' ha sido anulada',4,'factura anulada por: '.Auth::user()->name.' por '.Input::get('cancel'));
			return Redirect::to('facturas');	
		}		
	}
	public function delete($public_id){
		
	}
	public function previewInvoice(){
		$client = Client::where('id',Input::get('client'))->first();	
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$central = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('number',0)->first();
		//$tool = new Tool();
		$invoice = new Invoice();
		//$invoice->enterprice_id = Auth::user()->enterprice_id;
		$invoice->branch_id = Auth::user()->branch_id;
		$invoice->branch_type_id = $branch->branch_type_id;
		$invoice->user_id = Auth::user()->id;
		$invoice->client_id = Input::get('client');
		$invoice->invoice_status_ids = 1;
		$invoice->nit = Input::get('nit');
		$invoice->client_name = Input::get('razon');
		$invoice->client_nit = Input::get('nit');
		$invoice->authorization_number = $branch->authorization_number;
		$invoice->dosage_key = $branch->dosage_key;
		$invoice->matriz_address = $central->address;
		$invoice->city = $branch->city;
		$invoice->country = "no";//$branch->country;
		$invoice->deadline = $branch->deadline;
		$invoice->net_amount = Input::get('total');
		$invoice->total_amount = Input::get('subtotal');
		$invoice->taxable_amount = Input::get('total');
		$invoice->tax_amount = $invoice->taxable_amount * 0.13;
		$invoice->ice_amount = 0;
		$invoice->excent_amount = 0;
		$invoice->discount = Input::get('descuento_send');
		$invoice->exchange = 6.96;
		$invoice->net_amount_dollar = 0;
		$date_send = Input::get('date');
		$date_send = explode('/',$date_send);
		$invoice->date = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];
		$invoice->notes = "";
		$invoice->legend = $branch->legend;
		$invoice->especification = "";
		$invoice->number = 0;//$branch->getInvoiceNumber($branch->id);
		$fecha = trim(Input::get('date'));
        $fecha=  explode("/",$fecha);            
        $date=$fecha[2].$fecha[1].$fecha[0];           
		$invoice->control_code = "XX-XX-XX-XX";//$tool->generateControlCode($invoice->number,$invoice->nit,$date,$invoice->net_amount,$invoice->authorization_number,$invoice->dosage_key);
		//$invoice->save();
		$products =array();
		foreach (Input::get('productos') as $key => $producto) {
			if($producto['code']!=""){
			$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('code',$producto['code'])->first();			
			$detail = new InvoiceDetail();			
			//$detail->enterprice_id = Auth::user()->enterprice_id;
			//$detail->invoice_id = $invoice->id;			
			$detail->product_id = $product->id;
			$detail->code = $producto['code'];
			$detail->name = $producto['name'];
			$detail->price = $producto['price'];
			$detail->quantity = $producto['quantity'];			
			array_push($products, $detail);
			}
		}		
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$branch = Branch::where('id',$invoice->branch_id)->first();
		$data = [
			'invoice' => $invoice,
			'type'	=> 'Previsualizaci&oacute;n',
			'products' => $products,
			'logo' => $ent->logo,
			'branch' => $branch,
		];
		return View::make('invoice.view4',$data);
		if($invoice->branch_type_id == 1 )
			return View::make('invoice.view2',$data);	
		else
			return View::make('invoice.view',$data);	
	}

	/*** ADITIONAL FUNCIONS ***/
	private function sendInvoice($public_id,$name,$mail){
		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$data = [
			'link' => 'megamaquinaria.factufacil.bo/factura/cliente/'.$invoice->enterprice_id.'/'.$invoice->public_id,
			'invoice' => $invoice,
			'branch' => $branch,		
			'enterprice' => $ent->name,
		];

		$data_message = [
			'name' => $name,
			'mail' => $mail,
			'enterprice' => $ent->name,
		];		

		Mail::send('mail.invoice', $data, function($message) use ($data_message){
			$message->to($data_message['mail'], $data_message['name']);			
			$message->from('info@rusysve.com','FACTUFACIL');
			$message->subject('Factura: '.$data_message['enterprice']);
		});
		Session::flash('title','Envio de email');
		Session::flash('text','Se envio correctamene la factura: '.$invoice->number.' a: '.$name.' al correo: '.$mail);
	}
}
?>