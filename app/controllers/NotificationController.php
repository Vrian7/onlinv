<?php 
class NotificationController extends \BaseController{
	public function index(){
        $notifications = Notification::join('levels','levels.id','=','notifications.level_id')
			->where('notifications.enterprice_id',Auth::user()->enterprice_id)
			->select('notifications.title','notifications.public_id','notifications.date','notifications.time','notifications.message','levels.description','levels.name')
			->orderBy('notifications.id','desc')->get();		
//		$number = Notification::where()->count();

		$data = [
			'notifications' => $notifications,
		];
		return View::make('notification.index',$data);
	}
	public function show($public_id){
		$notification = Notification::join('levels','levels.id','=','notifications.level_id')
			->where('notifications.enterprice_id',Auth::user()->enterprice_id)->where('notifications.public_id',$public_id)
			->select('notifications.title','notifications.public_id','notifications.date','notifications.time','notifications.message','levels.description','levels.name')
			->orderBy('notifications.id','desc')->first();
		$data = [
			'notification' => $notification,
		];		
		return View::make('notification.show',$data);
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