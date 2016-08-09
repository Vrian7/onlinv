<?php
class EnterpriceController extends \BaseController{
	public function register(){			
		return View::make('enterprice.create');
			
	}

	public function store(){
		//print_r(Input::all());

		$file = Input::file('logo');
		$destinationPath = 'uploads/logos';					
		$ent = new Enterprice();
		$ent->currency_id = Input::get('currency');
		$ent->enterprice_type_id = Input::get('enterprice_type');
		$ent->name = Input::get('name');
		$ent->mail = Input::get('mail');
		$ent->domain = Input::get('domain');
		$ent->owner = Input::get('owner');
		$ent->nit = Input::get('nit');
		$filename = "logo-D".date("dmYHis").'.D'.$ent->domain.'N'.$ent->nit.'.'.Input::file('logo')->getClientOriginalExtension();	
		Input::file('logo')->move($destinationPath, $filename);		
		$ent->logo = $filename;
		$ent->save();

		$user = new User();
		$user->enterprice_id = $ent->id;
		$user->rol_id = 1;
		$user->name = Input::get('user_name');
		$user->username = $ent->domain.".".Input::get('user_user');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		$unit = new Unit();
		$unit->enterprice_id = $ent->id;
		$unit->name = "Unidad";
		$unit->symbol = "U";
		$unit->save();

		$bran = new Brand();
		$bran->enterprice_id = $ent->id;
		$bran->name = "General";
		$bran->manofacturer = "Ninguno";
		$bran->provider = "No";
		$bran->save();

		$cat = new Category();
		$cat->enterprice_id = $ent->id;
		$cat->name = "General";
		$cat->save();

		return Redirect::to('ingresar');
	}
	public function salesBook(){
		return View::make('enterprice.salesBook');
	}
	public function getText(){
	    $date=Input::get('year').'-'.Input::get('month');
	    $output = fopen('php://output','w') or Utils::fatalError();
	    header('Content-Type:application/txt');
	    header('Content-Disposition:attachment;filename=LIBROVENTAS'.Input::get('year').Input::get('month').'.txt');	            
	    $invoices=Invoice::where('enterprice_id',Auth::user()->enterprice_id)->where('date','LIKE',$date.'%')->get();
	    
	    $p="|";	    
		$c = 1;
		$sw = true;

	    foreach ($invoices as $i){	        
	    	if($i->invoice_status_ids==2){
				$i->client_nit=0;
				$i->client_name="ANULADA";
				$i->total_amount="0.00";
				$i->net_amount="0.00";					
				$i->discount="0.00";
	            $status="A";
	        }
	        else $status="V";	     
	        $date = explode('-',$i->date);					
	        $date = $date[2].'/'.$date[1].'/'.$date[0];
	        $sw = false;
	        $debito=$i->net_amount*0.13;
	        $debito=number_format((float)$debito, 2, '.', '');
	        $datos = "1".$p.$c.$p.$date.$p.$i->number.$p.$i->authorization_number.$p.$status.$p.$i->client_nit.$p.$i->client_name.$p.$i->total_amount.$p.$i->ice_amount.$p.$i->excent_amount.$p."0.00".$p.$i->total_amount.$p.$i->discount.$p.$i->net_amount.$p.$debito.$p.$i->control_code."\r\n";
	        $c++;		        
	        fputs($output,$datos);	              
	       	$datos = null;
	    }	    
	    //return 0;
		if($sw)
	        fputs($output,"No se encontraron facturas en este periodo: ".Input::get('month').'/'.Input::get('year'));
	    fclose($output);
	    $alert = new Alert();
		$alert->add('Generación de LCV','Se generó libro de ventas'.'.',4,'Se generó el libro de ventas de la gestión : '.Input::get('month').'/'.Input::get('year'));
		exit;
	}
}
?>