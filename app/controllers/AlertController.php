<?php 
class AlertController extends \BaseController{
	public function index(){
        $alerts = Alert::join('levels','levels.id','=','alerts.level_id')
			->where('alerts.enterprice_id',Auth::user()->enterprice_id)
			->select('alerts.title','alerts.public_id','alerts.date','alerts.time','alerts.message','levels.description','levels.name')
			->orderBy('alerts.id','desc')->get();
		$data = [
			'alerts' => $alerts,
		];
		return View::make('alert.index',$data);
	}
	public function show($public_id){
		$alert = Alert::join('levels','levels.id','=','alerts.level_id')
			->where('alerts.enterprice_id',Auth::user()->enterprice_id)->where('alerts.public_id',$public_id)
			->select('alerts.title','alerts.public_id','alerts.date','alerts.time','alerts.message','levels.description','levels.name')
			->orderBy('alerts.id','desc')->first();
		$data = [
			'alert' => $alert,
		];		
		return View::make('alert.show',$data);
	}
	public function create(){

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