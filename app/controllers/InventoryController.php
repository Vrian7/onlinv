<?php 
class InventoryController extends \BaseController{
	public function index(){		
		$inventories = Inventory::join('products','products.id','=','inventories.product_id')
					->join('branches','branches.id','=','inventories.branch_id')
					->where('inventories.enterprice_id',Auth::user()->enterprice_id)
					->select('inventories.public_id','products.name AS product','branches.name AS branch','inventories.stock','inventories.average','inventories.minimum')
					->get();					
		$data = [
			'inventories' => $inventories,
		];

		return View::make('inventory.index',$data);
	}
	public function show($public_id){		
		$inventory = Inventory::join('products','products.id','=','inventories.product_id')
					->join('branches','branches.id','=','inventories.branch_id')
					->where('inventories.enterprice_id',Auth::user()->enterprice_id)->where('inventories.public_id',$public_id)
					->select('inventories.public_id','inventories.description','products.name AS product','branches.name AS branch','inventories.stock','inventories.average','inventories.minimum','inventories.sold')
					->first();		
		$data = [
			'inventory' => $inventory,
		];
		return View::make('inventory.show',$data);					
	}
	public function create(){
		$products = Product::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$branches = Branch::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'products' => $products,
			'branches' => $branches,
		];
		return View::make('inventory.create',$data);
	}
	public function store(){
		$inventory = new Inventory();
		$inventory->enterprice_id = Auth::user()->enterprice_id;
		$inventory->product_id = Input::get('product');
		$inventory->branch_id = Input::get('branch');
		$inventory->stock = Input::get('stock');
		$inventory->average = Input::get('average');
		$inventory->minimum = Input::get('minimum');		
		$inventory->description = Input::get('description');
		$validation = $inventory->isValid();
		if($validation==""){
			$inventory->save();
			Session::flash('title','Creacion de inventario');
			Session::flash('text','Se cre&oacute; el inventario correctamente..');
			return Redirect::to('inventarios');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('inventario');
		}
	}
	public function edit($public_id){
		$inventory = Inventory::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$products = Product::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$branches = Branch::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'inventory' => $inventory,
			'products' => $products,
			'branches' => $branches,
		];
		return View::make('inventory.edit',$data);	
	}
	public function update($public_id){
		$inventory = Inventory::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$inventory->product_id = Input::get('product');
		$inventory->branch_id = Input::get('branch');
		$inventory->stock = Input::get('stock');
		$inventory->average = Input::get('average');
		$inventory->minimum = Input::get('minimum');		
		$inventory->description = Input::get('description');
		$inventory->save();
		return Redirect::to('inventarios');
	}
	public function delete($public_id){
		
	}
}
?>