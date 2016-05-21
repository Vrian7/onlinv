<?php 
class ProductController extends \BaseController{
	public function index(){
		$products = Product::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'products' => $products,
		];
		return View::make('product.index',$data);
	}
	public function show($public_id){
		$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$category = Category::where('id',$product->category_id)->first();
		$unit = Unit::where('id',$product->unit_id)->first();
		$brand = Brand::where('id',$product->brand_id)->first();
		$data = [
			'product' => $product,			
			'category' => $category->name,
			'unit' => $unit->name,
			'brand' => $brand->name,
		];
		return View::make('product.show',$data);
	}
	public function create(){
		$cate = Category::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$uni = Unit::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$bran = Brand::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data=[
			'categories' => $cate,
			'units' => $uni,
			'brands' => $bran,
		];
		return View::make('product.create',$data);
	}
	public function store(){
		$product = new Product();
		$product->enterprice_id = Auth::user()->enterprice_id;
		$product->unit_id = Input::get('unit');
		$product->category_id = Input::get('category');
		$product->brand_id = Input::get('brand');
		$product->name = Input::get('name');
		$product->code = Input::get('code');
		$product->price = Input::get('price');
		$product->description = Input::get('description');
		$validation = $product->isValid();
		if($validation==""){
			$product->save();
			Session::flash('title','Creacion de producto');
			Session::flash('text','Se cre&oacute; el producto '. $product->name.' correctamente..');
			return Redirect::to('productos');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('producto');
		}

	}
	public function edit($public_id){
		$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$cate = Category::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$uni = Unit::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$bran = Brand::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'product' => $product,
			'categories' => $cate,
			'units' => $uni,
			'brands' => $bran,
		];
		return View::make('product.edit',$data);
	}
	public function update($public_id){
		$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$product->unit_id = Input::get('unit');
		$product->category_id = Input::get('category');
		$product->brand_id = Input::get('brand');
		$product->name = Input::get('name');
		$product->code = Input::get('code');
		$product->price = Input::get('price');
		$product->description = Input::get('description');
		$product->save();
		return Redirect::to('productos');
	}
	public function delete($public_id){
		
	}
}
?>