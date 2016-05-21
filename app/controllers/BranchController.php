<?php 
class BranchController extends \BaseController{
	public function index(){
		$branches = Branch::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'branches' => $branches,
		];
		return View::make('branch.index',$data);
	}
	public function show($public_id){
		$branch = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$type = BranchType::where('id',$branch->branch_type_id)->first();
		$data = [
			'branch' => $branch,
			'type'	=> $type->name,
		];
		return View::make('branch.show',$data);
	}	public function create(){
		$types = BranchType::get();
		$data = [
			'types' => $types
		];
		return View::make('branch.create',$data);
	}
	public function store(){
		$branch = new Branch();
		$branch->enterprice_id = Auth::user()->enterprice_id;
		$branch->branch_type_id = Input::get('branch_type');
		$branch->name = Input::get('name');
		$branch->address = Input::get('address');
		$branch->city = Input::get('city');
		$branch->state = Input::get('state');
		$branch->zone = Input::get('zone');
		$branch->phone = Input::get('phone');
		$branch->number = Input::get('number');
		$branch->process_number = Input::get('process_number');
		$branch->authorization_number = Input::get('authorization_number');
		$date_send = Input::get('deadline');
		$date_send = explode('/',$date_send);
		$branch->deadline = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];		
		$branch->economic_activity = Input::get('activity');
		$branch->legend = Input::get('legend');
		$branch->dosage_key = Input::get('dosage_key');
		$branch->invoice_counter = 0;
		$doc = BranchType::where('id',$branch->branch_type_id)->first();
		$branch->document = $doc->template;
		$branch->save();
		$validation = $branch->isValid();
		if($validation==""){
			Session::flash('title','Creacion de sucursal');
			Session::flash('text','Se cre&oacute; la sucursal '.$branch->name.' correctamente..');
			return Redirect::to('sucursales');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('sucursal');
		}	
	}
	public function edit($public_id){
		$branch = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$types = BranchType::get();
		$data = [
			'branch' => $branch,
			'types' => $types,			
		];
		return View::make('branch.edit',$data);
	}
	public function update($public_id){
		$branch = Branch::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$branch->branch_type_id = Input::get('branch_type');
		$branch->name = Input::get('name');
		$branch->address = Input::get('address');
		$branch->city = Input::get('city');
		$branch->state = Input::get('state');
		$branch->zone = Input::get('zone');
		$branch->phone = Input::get('phone');
		$branch->number = Input::get('number');
		$branch->process_number = Input::get('process_number');
		$branch->authorization_number = Input::get('authorization_number');
		$date_send = Input::get('deadline');
		$date_send = explode('/',$date_send);
		$branch->deadline = $date_send[2].'-'.$date_send[1].'-'.$date_send[0];		
		$branch->economic_activity = Input::get('activity');
		$branch->legend = Input::get('legend');
		$branch->dosage_key = Input::get('dosage_key');
		$branch->invoice_counter = 0;
		$doc = BranchType::where('id',$branch->branch_type_id)->first();
		$branch->document = $doc->template;
		$branch->save();
		return Redirect::to('sucursales');
	}
	public function delete($public_id){
		
	}
	public function test(){
		return View::make('branch.test');
	}
	public function testResult(){		
			$authorization = trim(Input::get('autorization'));
            $number = trim(Input::get('number'));
            $nit = trim(Input::get('nit'));            
            $fecha = trim(Input::get('date'));
            $fecha=  explode("/",$fecha);            
            $date=$fecha[2].$fecha[1].$fecha[0];           
            $amount = str_replace(',','.',Input::get('amount'));
            $key = trim(Input::get('dosage_key'));            
            $tool = new Tool();
            $codigoControl = $tool->generateControlCode($number,$nit,$date,$amount,$authorization,$key);
            return $codigoControl;
	}
}
?>