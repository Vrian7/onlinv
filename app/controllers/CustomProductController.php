<?php 
class CustomProductController extends \BaseController{
	public function index(){		
		$customs = CustomProduct::join('categories','categories.id','=','custom_products.category_id')
					->where('custom_products.enterprice_id',Auth::user()->enterprice_id)
					->select('custom_products.*','categories.name')
					->get();
		$data = [
			'customs' => $customs,			
		];
		return View::make('custom_product.index',$data);
	}
	public function show($public_id){
		$custom = CustomProduct::join('categories','categories.id','=','custom_products.category_id')
					->where('custom_products.enterprice_id',Auth::user()->enterprice_id)->where('custom_products.public_id',$public_id)
					->select('custom_products.*','categories.name')
					->first();
		$data = [
			'custom' => $custom,			
		];
		return View::make('custom_product.show',$data);
	}
	public function create(){		
		$categories = Category::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'categories' => $categories,
		];
		return View::make('custom_product.create',$data);
	}
	public function store(){
		$custom = new CustomProduct();
		$custom->category_id = Input::get('category'); 
		$custom->enterprice_id = Auth::user()->enterprice_id;
		if(Input::get('field1')!="")
			$custom->field1 = Input::get('field1');
		if(Input::get('field2')!="")
			$custom->field2 = Input::get('field2');
		if(Input::get('field3')!="")
			$custom->field3 = Input::get('field3');
		if(Input::get('field4')!="")
			$custom->field4 = Input::get('field4');
		if(Input::get('field5')!="")
			$custom->field5 = Input::get('field5');
		$validation = $custom->isValid();
		if($validation==""){
			$custom->save();
			Session::flash('title','Creacion de campos adicionales');
			Session::flash('text','Se crearon los campos adicionales correctamente..');
			return Redirect::to('campos_productos');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('campos_producto');
		}		
	}
	public function edit($public_id){
		$custom = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$categories = Category::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'custom'	=> $custom,
			'categories' => $categories,
		];
		return View::make('custom_product.edit',$data);
	}
	public function update($public_id){
		$custom = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->first();		
		if(Input::get('field1')!="")
			$custom->field1 = Input::get('field1');
		if(Input::get('field2')!="")
			$custom->field1 = Input::get('field2');
		if(Input::get('field3')!="")
			$custom->field1 = Input::get('field3');
		if(Input::get('field4')!="")
			$custom->field1 = Input::get('field4');
		if(Input::get('field5')!="")
			$custom->field1 = Input::get('field5');
		$validation = $custom->isValid();
		if($validation==""){
			$custom->save();
			Session::flash('title','Edici&oacute;n de campos adicionales');
			Session::flash('text','Se modificaron los campos correctamente..');
			return Redirect::to('campos_productos');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('campos_producto');
		}
	}
	public function delete($public_id){
		
	}
}
?>