<?php 
class ProductController extends \BaseController{
	public function index(){
		$products = Product::where('enterprice_id',Auth::user()->enterprice_id)->take(100)->skip(100)->get();
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
		$custom = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->where('category_id',$product->category_id)->first();
		$data = [
			'product' => $product,			
			'category' => $category->name,
			'unit' => $unit->name,
			'brand' => $brand->name,
			'custom' => $custom,
		];
		return View::make('product.show',$data);
	}
	public function create(){
		$cate = Category::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$cat = Category::where('enterprice_id',Auth::user()->enterprice_id)->first();
		$uni = Unit::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$bran = Brand::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$customs = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->select('category_id','field1','field2','field3','field4','field5')->get();
		$custom = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->where('category_id',$cat->id)->select('category_id','field1','field2','field3','field4','field5')->first();
		$data=[
			'categories' => $cate,
			'units' => $uni,
			'brands' => $bran,
			'customs' => $customs,
			'custom' => $custom,
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
		if(Input::get('field1'))
			$product->extra1 = Input::get('field1');
		if(Input::get('field2'))
			$product->extra2 = Input::get('field2');
		if(Input::get('field3'))
			$product->extra3 = Input::get('field3');
		if(Input::get('field4'))
			$product->extra4 = Input::get('field4');
		if(Input::get('field5'))
			$product->extra5 = Input::get('field5');
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
		$customs = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->select('category_id','field1','field2','field3','field4','field5')->get();
		$custom = CustomProduct::where('enterprice_id',Auth::user()->enterprice_id)->where('category_id',$product->category_id)->select('category_id','field1','field2','field3','field4','field5')->first();
		$data = [
			'product' => $product,
			'categories' => $cate,
			'units' => $uni,
			'brands' => $bran,
			'customs' => $customs,
			'custom' => $custom,
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
		if(Input::get('field1'))
			$product->extra1 = Input::get('field1');
		if(Input::get('field2'))
			$product->extra2 = Input::get('field2');
		if(Input::get('field3'))
			$product->extra3 = Input::get('field3');
		if(Input::get('field4'))
			$product->extra4 = Input::get('field4');
		if(Input::get('field5'))
			$product->extra5 = Input::get('field5');
		$product->save();
		return Redirect::to('productos');
	}
	public function delete($public_id){
		
	}
public function getExcel(){
	return View::make('product.import');
}
	public function excel(){
		$dir = "files/excel/";
        $fecha = base64_encode("excel".date('d/m/Y-H:m:i'));
        $file_name = $fecha;
        //return $file_name;
     
        
        
        $file = Input::file('excel');
        $destinationPath = 'files/excel/';
        // If the uploads fail due to file system, you can try doing public_path().'/uploads'
        $filename = "import.csv";//$file_name;//str_random(12);
        //$filename = $file->getClientOriginalName();
        //$extension =$file->getClientOriginalExtension();
        $upload_success = Input::file('excel')->move($destinationPath, $filename);
		Excel::load('files/excel/import.csv', function($reader) {
 
     		foreach ($reader->get() as $prueba) {     			
                foreach($prueba as $pru){                    
					$prod = explode(';',$pru);                    
                	$product = new Product();
					$product->enterprice_id = Auth::user()->enterprice_id;
					$product->unit_id = 2;
					$product->category_id = 2;
					$product->brand_id = 2;
					$product->name = $prod[1];
					$product->code = $prod[0];
					$product->price = $prod[2];
					$product->extra1 = $prod[3];

					$product->description = "";		
					$product->save();
                }                
      		}
		});
	}

	public function searchProduct(){
		$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->where('code',Input::get('code'))->first();
		return Response::json($product);
	}

public function busqueda ($code="", $nombre="", $precio="", $descripcion="", $pagina=""){
		if(Input::get('codigo')){
			$code = Input::get('codigo');
			$codesql = "'code','like', '".$code."%'";
		}
		if(Input::get('nombre')){
			$nombre = Input::get('nombre');
		}
		if(Input::get('precio')){
			$precio = Input::get('precio');
		}
		if(Input::get('descripcion')){
			$descripcion = Input::get('descripcion');
		}

		// dd($pagina);
		$cantidadMostrar = 100;
		//valores para paginacion
		if(Input::get('pagina')){
			$pagina = (int)(Input::get('pagina')) - 1;
			// dd($pagina);
		}else {
			$pagina = 0;
		}
		$next_pag = $pagina * $cantidadMostrar;
		$total_registros = Product::where('enterprice_id',Auth::user()->enterprice_id)
								->select('id', 'code', 'name', 'price', 'description', 'public_id')
								->where('code','like', $code.'%')
								->where('name','like', $nombre.'%')
								->where('price','like', $precio.'%')
								->where('description','like', $descripcion.'%')
								->count();
		$pagDec = $total_registros/$cantidadMostrar;
		$pagInt = (int)($total_registros/$cantidadMostrar);

		if($pagDec > 0.01){
			$total_paginas = $pagInt + 1 ;
		}else {
			$total_paginas = $pagInt;
		}
		if(($pagina+1) < $total_paginas){
			$siguiente = $pagina+1;
		}else {
			$siguiente = $pagina;
		}

		//fin valores de paginacion

		$products = Product::where('enterprice_id',Auth::user()->enterprice_id)
								->select('id', 'code', 'name', 'price', 'description', 'public_id')
								->where('code','like', $code.'%')
								->where('name','like', $nombre.'%')
								->where('price','like', $precio.'%')
								->where('description','like', $descripcion.'%')
								->orderBy('code', 'desc')
								->skip($next_pag)
								->take($cantidadMostrar)
	    					// ->simplePaginate(30);
								->get();
		$data = [
			'products' => $products,
			'actual' => $pagina + 1,
			'siguiente' => $siguiente + 1,
			'total_registros' => $total_registros,
			'total_paginas' => $total_paginas,
		];
		return Response::json($data);
	}
}
?>