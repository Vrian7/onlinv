
<?php 
class ChargeController extends \BaseController{
	public function index(){
		$charges = Charge::join('invoices','invoices.id','=','charges.invoice_id')
					->where('charges.enterprice_id',Auth::user()->enterprice_id)
					->select('charges.public_id','charges.amount','charges.date','invoices.client_name','invoices.number')
					->get();

		$data = [
			'charges' => $charges,
		];
		return View::make('charge.index',$data);
	}
	public function show($public_id){
		$charge = Charge::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$invoice = Invoice::where('id',$charge->invoice_id)->select('client_name','number')->first();
		$type = PaymentType::where('id',$charge->payment_type_id)->first();
		$data = [
			'charge' => $charge,
			'client_name' => $invoice->client_name,
			'number' => $invoice->number,
			'type' => $type->name,
		];
		return View::make('charge.show',$data);
	}
	public function create(){		
		return Redirect::to('facturas');
		$payment_types = PaymentTYpe::get();
		$data = [
			'payment_types' => $payment_types,
		];
		return View::make('charge.create',$data);
	}
	public function store(){
		$charge = new Charge();
		$charge->enterprice_id = Auth::user()->enterprice_id;
		$charge->invoice_id = Input::get('invoice');
		$charge->client_id = Input::get('client');
		$charge->payment_type_id = Input::get('payment_type');
		$charge->paid_for = Input::get('paid_for');
		$charge->amount = Input::get('amount');
		$date_send = Input::get('date');
		$date_send = explode('/',$date_send);
		$charge->date = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];		
		$charge->description = Input::get('description');		
		$validation = $charge->isValid();
		if($validation==""){			
			$charge->save();
			$invoice = Invoice::where('id',$charge->invoice_id)->first();
			$invoice->debt = $invoice->debt-$charge->amount;
			$invoice->save();
			$client = Client::where('id',$charge->client_id)->first();
			$client->debt = $client->debt-$charge->amount;
			Session::flash('title','Cobro');
			Session::flash('text','Se regisr&oacute; el cobro de la factura exit&oacute;samente..');
			return Redirect::to('cobros');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('cobro');
		}
		return Redirect::to('cobros');
	}
	public function edit($public_id){
		$charge = Charge::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$invoice = Invoice::where('id',$charge->invoice_id)->first();		
		$payment_types = PaymentTYpe::get();
		$data = [
			'charge' => $charge,
			'payment_types' => $payment_types,
			'invoice' => $invoice,
		];
		return View::make('charge.edit',$data);	
	}
	public function update($public_id){
		$charge = Charge::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$charge->payment_type_id = Input::get('payment_type');
		$charge->paid_for = Input::get('paid_for');
		$ant = $charge->amount;
		$charge->amount = Input::get('amount');		
		$date_send = Input::get('date');
		$date_send = explode('/',$date_send);
		$charge->date = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];		
		$charge->description = Input::get('description');
		$charge->save();
		$invoice = Invoice::where('id',$charge->invoice_id)->first();
		$invoice->debt = $invoice->debt-$charge->amount+$ant;
		$invoice->save();
		$client = Client::where('id',$charge->client_id)->first();
		$client->debt = $client->debt-$charge->amount+$ant;
		$client->save();
		return Redirect::to('cobros');
	}
	public function delete($public_id){
		
	}
	public function chargeInvoice($public_id){
		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$payment_types = PaymentTYpe::get();
		$data = [
			'payment_types' => $payment_types,
			'invoice' => $invoice,
		];
		return View::make('charge.chargeInvoice',$data);	
	}
}
?>