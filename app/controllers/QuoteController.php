<?php 
class QuoteController extends \BaseController{
	public function index(){
		$quotes = Quote::where('enterprice_id',Auth::user()->enterprice_id)->where('branch_id',Auth::user()->branch_id)->get();
		$data = [
			'quotes' => $quotes,
		];
		return View::make('quote.index',$data);		
	}
	public function show($public_id){
		$quote = Quote::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$products = QuoteDetail::where('quote_id',$quote->id)->get();
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$data = [
			'quote' => $quote,
			'products' => $products,
			'logo' => $ent->logo,
		//	'tracing' => $invoice->getTracing(),
		];
		return View::make('quote.show',$data);
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
		return View::make('quote.create',$data);
	}
	public function store(){
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

		//$client->debt = $client->debt+Input::get('total');
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$central = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('number',0)->first();
		$tool = new Tool();
		$invoice = new Quote();
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
		$invoice->discount = Input::get('descuento_send');
		$invoice->exchange = 6.96;
		$invoice->net_amount_dollar = 0;
		$date_send = Input::get('date');
		$date_send = explode('/',$date_send);
		$invoice->date = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];
		$invoice->notes = Input::get('notes');
		$invoice->validate = Input::get('validate');
		//$invoice->legend = $branch->legend;
		///$invoice->especification = "";
		//$invoice->number = $branch->getInvoiceNumber($branch->id);
		$quote = Quote::where('enterprice_id',Auth::user()->enterprice_id)->orderBy('id','DESC')->first();
		$invoice->number = 1;
		$fecha = trim(Input::get('date'));
        $fecha=  explode("/",$fecha);            
        $date=$fecha[2].$fecha[1].$fecha[0];           
		//$invoice->control_code =$tool->generateControlCode($invoice->number,$invoice->nit,$date,$invoice->net_amount,$invoice->authorization_number,$invoice->dosage_key);
		$invoice->save();	
		//$invoice->setTracing(1,Auth::user()->name,'hola');
		foreach (Input::get('productos') as $key => $producto) {
			if($producto['code']!=""){
			$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('code',$producto['code'])->first();						
			$detail = new QuoteDetail();			
			$detail->enterprice_id = Auth::user()->enterprice_id;
			$detail->quote_id = $invoice->id;			
			$detail->product_id = $product->id;
			$detail->code = $producto['code'];
			$detail->name = $producto['name'];
			$detail->price = $producto['price'];
			$detail->quantity = $producto['quantity'];				
			$detail->save();
			}
		}		
		$inv = Quote::where('id',$invoice->id)->first();
		$data = [
			'public_id' => $inv->public_id,
			'number' => $inv->number,
			'invoice' => $invoice,
		];
		return View::make('quote.template',$data);
	}
	public function edit($public_id){

	}
	public function update($public_id){

	}
	public function delete($public_id){
		
	}
	public function previewInvoice(){
		$client = Client::where('id',Input::get('client'))->first();	
		$branch = Branch::where('id',Auth::user()->branch_id)->first();
		$central = Branch::where('id',Auth::user()->branch_id)->where('number',0)->first();
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
		//$invoice->matriz_address = $central->address;
		$invoice->city = $branch->city;
		$invoice->country = "no";//$branch->country;
		$invoice->deadline = $branch->deadline;
		$invoice->net_amount = Input::get('total');
		$invoice->total_amount = Input::get('subtotal');
		$invoice->taxable_amount = Input::get('total');
		$invoice->tax_amount = $invoice->taxable_amount * 0.13;
		$invoice->ice_amount = 0;
		$invoice->excent_amount = 0;
		$invoice->notes = Input::get('notes');
		$invoice->validate = Input::get('validate');
		$invoice->discount = Input::get('descuento_send');
		$invoice->exchange = 6.96;
		$invoice->net_amount_dollar = 0;
		$date_send = Input::get('date');
		$date_send = explode('/',$date_send);
		$invoice->date = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];
		//$invoice->notes = "";
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
		return View::make('invoice.view3',$data);	
		if($invoice->branch_type_id == 1 )
			return View::make('invoice.view2',$data);	
		else
			return View::make('invoice.view',$data);	
	}
}
?>