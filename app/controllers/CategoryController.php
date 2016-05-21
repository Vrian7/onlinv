<?php 
class CategoryController extends \BaseController{
	public function index(){
		$categories = Category::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'categories' => $categories,
		];
		return View::make('category.index',$data);
	}
	public function show($public_id){
		$category = Category::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$data = [
			'category' => $category,
		];
		return View::make('category.show',$data);
	}
	public function create(){
		return View::make('category.create');
	}
	public function store(){
		$cate = new Category();
		$cate->enterprice_id = Auth::user()->enterprice_id;
		$cate->name = Input::get('name');
		$cate->description = Input::get('description');
		$validation = $cate->isValid();
		if($validation==""){
			$cate->save();
			Session::flash('title','Creacion de categor&iacute;a');
			Session::flash('text','Se cre&oacute; la categor&iacute;a '.$cate->name.' correctamente..');
			return Redirect::to('categorias');
		}
		else
		{
			Session::flash('title','Se encontraron estos errores');
			Session::flash('text',$validation);
			return Redirect::to('categoria');
		}		
	}
	public function edit($public_id){
		$category = Category::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$data = [
			'category' => $category,
		];
		return View::make('category.edit',$data);
	}
	public function update($public_id){
		$cate = Category::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();		
		$cate->name = Input::get('name');
		$cate->description = Input::get('description');
		$cate->save();
		return Redirect::to('categorias');
	}
	public function delete($public_id){
		
	}
}
?>