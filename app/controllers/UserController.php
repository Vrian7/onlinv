<?php 

class UserController extends \BaseController{
	public function index(){
		$users = User::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$roles = Rol::get();
		$branchs = Branch::where('enterprice_id',Auth::user()->enterprice_id)->get();  
		$rols=[];
		foreach ($roles as $key => $rol) {
			$rols[$rol->id] = $rol->name;
		}		
		$branches = [];
		foreach ($branchs as $key => $branch) {
			$branches[$branch->id] = $branch->name;
		}		
		$data = [
			'users' => $users,
			'rols'	=> $rols,
			'branches' => $branches,
		];
		return View::make('user.index',$data);
	}
	public function show($public_id){
		$user = User::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$branch = Branch::where('id',$user->branch_id)->first();
		$rol = Rol::where('id',$user->rol_id)->first();
		$data = [
			'user' => $user,
			'branch' => isset($branch->name)?$branch->name:"TODAS",
			'rol' => $rol->name,
			'enabled' => $user->enabled==0?'NO':'SI',
		]; 
		return View::make('user.show',$data);
	}
	public function create(){
		$rols = Rol::where('id','!=',1)->get();
		$branches = Branch::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'rols' => $rols,
			'branches' => $branches,
		];
		return View::make('user.create',$data);
	}
	public function store(){
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$file = Input::file('logo');
		$destinationPath = 'uploads/users';
		$user = new User();
		$user->enterprice_id = Auth::user()->enterprice_id;
		$user->rol_id = Input::get('rol');
		$user->branch_id = Input::get('branch');		
		$user->name = Input::get('name');
		$user->username = $ent->domain.".".Input::get('username');
		$user->password = Hash::make(Input::get('password'));		
		$user->phone = Input::get('phone');
		if(!empty(Input::file('avatar'))){
			$filename = "user-D".date("dmYHis").'.u'.$user->username.'.'.Input::file('avatar')->getClientOriginalExtension();	
			Input::file('avatar')->move($destinationPath, $filename);		
			$user->avatar = $filename;
		}
		if(Input::get('enabled')!="")
			$user->enabled = 1;
		else
			$user->enabled = 0;
		$validation = $user->isValid();
		if($validation==""){
			$user->save();
			Session::flash('title','Creacion de usuario');
			Session::flash('text','Se cre&oacute; el usuario '.$user->username.' correctamente..');
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
		$user = User::where('enterprice_id',Auth::user()->enterprice_id)->where('public_id',$public_id)->first();
		$rols = Rol::where('id','!=',1)->get();
		$branches = Branch::where('enterprice_id',Auth::user()->enterprice_id)->get();
		$data = [
			'user' => $user,
			'rols' => $rols,
			'branches' => $branches,
		];
		return View::make('user.edit',$data);
	}
	public function update($public_id){
		$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
		$file = Input::file('logo');
		$destinationPath = 'uploads/users';
		$user = User::where('enterprice_id',$ent->id)->where('public_id',$public_id)->first();		
		$user->rol_id = Input::get('rol');
		$user->branch_id = Input::get('branch');		
		$user->name = Input::get('name');
		$user->username = $ent->domain.".".Input::get('username');
		$user->password = Hash::make(Input::get('password'));		
		$user->phone = Input::get('phone');
		if(!empty(Input::file('avatar'))){
			$filename = "user-D".date("dmYHis").'.u'.$user->username.'.'.Input::file('avatar')->getClientOriginalExtension();	
			Input::file('avatar')->move($destinationPath, $filename);		
			$user->avatar = $filename;
		}	
		if(Input::get('enabled')!="")
			$user->enabled = 1;
		else
			$user->enabled = 0;
		$user->save();
		return Redirect::to('usuarios');
	}
	public function delete($public_id){
		
	}
	public function login(){		
		return View::make('index.login');		
	}

	public function enter(){
		$user = Input::get('domain').'.'.Input::get('username');
		$password = Input::get('password');
		//return $password;
		if (Auth::attempt(array('username' => $user, 'password' => $password)))
		{
			$ent = Enterprice::where('id',Auth::user()->enterprice_id)->first();
			Session::put('enterprice',$ent->name);
    		return Redirect::intended('inicio');
		}
		return Redirect::intended('ingresar');
		return 0;
	}

	public function logout(){		
		if(Auth::check()){
			Auth::logout();			
		}		

		return Redirect::to('ingresar');

	}
}
?>