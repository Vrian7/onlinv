<?php 
class QuoteController extends \BaseController{
	public function index(){

	}
	public function show($public_id){

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
        $today = date('d-m-Y');        
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

	}
	public function edit($public_id){

	}
	public function update($public_id){

	}
	public function delete($public_id){
		
	}
}
?>