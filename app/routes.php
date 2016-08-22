<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('index.dashboard');
});*/
//Route::get('factura/cliente/{enterprice}/{public_id}','InvoiceController@showClient');
//Route::group(array('domain'=>'{enterprice}.demo.factufacil.online'),function(){
Route::group(array('domain'=>'{enterprice}.factufacil.bo'),function(){
//Route::group(array('domain'=>'{enterprice}.factufacil.online'),function(){
	/*** USER CONTROLLER ***/
	//Route::get('ingresar','UserController@login');

	

	Route::get('ingresar',function($enterprice){
		$ent = Enterprice::where('domain',$enterprice)->first();		
		$data = [
			'logo' => isset($ent->logo)?$ent->logo:'asdf',
			'domain' => $enterprice
		];
		return View::make('index.login',$data);			
	});
	Route::get('/',function($enterprice){
		if($enterprice == "crear")
			return Redirect::to('registrar');
		else
			return Redirect::to('ingresar');
	});
	Route::post('ingresar','UserController@enter');
	Route::get('salir','UserController@logout');
	/*** ENTERPRICECONTROLLER ***/
	Route::get('registrar','EnterpriceController@register');

	Route::post('registrar','EnterpriceController@store');	
	Route::get('inicio', function()
	{
		$invoice = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->count();
		$amount = Invoice::where('enterprice_id',Auth::user()->enterprice_id)->sum('net_amount');
		$client = Client::where('enterprice_id',Auth::user()->enterprice_id)->count();
		$product = Product::where('enterprice_id',Auth::user()->enterprice_id)->count();
		$branch = Branch::where('enterprice_id',Auth::user()->enterprice_id)->count();

		$data = [
			'invoice' => $invoice,
			'amount' => $amount,
			'client' => $client,
			'product' => $product,
			'branch' => $branch,
		];
		return View::make('index.dashboard',$data);
	});

});

Route::group(array('before' => 'auth'), function(){
	

	/*** ENTERPRICECONTROLLER ***/		
	Route::get('libro/ventas','EnterpriceController@salesBook');
	Route::post('libro/ventas','EnterpriceController@getText');

	/*** CLIENTCONTROLLER ***/
	Route::get('clientes','ClientController@index');
	Route::get('cliente','ClientController@create');
	Route::post('cliente','ClientController@store');
	Route::get('cliente/{public_id}','ClientController@show');
	Route::get('cliente/editar/{public_id}','ClientController@edit');
	Route::post('cliente/editar/{public_id}','ClientController@update');
	Route::get('cliente/eliminar/{public_id}','ClientController@delete');
	Route::get('buscar_cliente','ClientController@findByString');
	Route::get('obtener_clientes','ClientController@getClientsByNit');	
	
	Route::get('searchProduct','ProductController@searchProduct');
		Route::post('examen','BranchController@testResult');
Route::group(array('before'=>'admin'),function() {
	/*** PRODUCTCONTROLLER ***/
	Route::get('productos','ProductController@index');
	Route::get('producto','ProductController@create');
	Route::post('producto','ProductController@store');
	Route::get('producto/{public_id}','ProductController@show');
	Route::get('producto/editar/{public_id}','ProductController@edit');
	Route::post('producto/editar/{public_id}','ProductController@update');
	Route::get('producto/eliminar/{public_id}','ProductController@delete');


	/*** CATEGORYCONTROLLER ***/
	Route::get('categorias','CategoryController@index');
	Route::get('categoria','CategoryController@create');
	Route::post('categoria','CategoryController@store');
	Route::get('categoria/{public_id}','CategoryController@show');
	Route::get('categoria/editar/{public_id}','CategoryController@edit');
	Route::post('categoria/editar/{public_id}','CategoryController@update');
	Route::get('categoria/eliminar/{public_id}','CategoryController@delete');

	/*** BRANCHCONTROLLER ***/
	Route::get('sucursales','BranchController@index');
	Route::get('sucursal','BranchController@create');
	Route::post('sucursal','BranchController@store');
	Route::get('sucursal/{public_id}','BranchController@show');
	Route::get('sucursal/editar/{public_id}','BranchController@edit');
	Route::post('sucursal/editar/{public_id}','BranchController@update');
	Route::get('sucursal/eliminar/{public_id}','BranchController@delete');	
	Route::get('examen','BranchController@test');


	/*** UNITCONTROLLER ***/
	Route::get('unidades','UnitController@index');
	Route::get('unidad','UnitController@create');
	Route::post('unidad','UnitController@store');
	Route::get('unidad/{public_id}','UnitController@show');
	Route::get('unidad/editar/{public_id}','UnitController@edit');
	Route::post('unidad/editar/{public_id}','UnitController@update');
	Route::get('unidad/eliminar/{public_id}','UnitController@delete');

	/*** BRANDCONTROLLER ***/
	Route::get('marcas','BrandController@index');
	Route::get('marca','BrandController@create');
	Route::post('marca','BrandController@store');
	Route::get('marca/{public_id}','BrandController@show');
	Route::get('marca/editar/{public_id}','BrandController@edit');
	Route::post('marca/editar/{public_id}','BrandController@update');
	Route::get('marca/eliminar/{public_id}','BrandController@delete');


	/*** CUSTOMPRODUCTCONTROLLER ***/
	Route::get('campos_productos','CustomProductController@index');
	Route::get('campos_producto','CustomProductController@create');
	Route::post('campos_producto','CustomProductController@store');
	Route::get('campos_producto/{public_id}','CustomProductController@show');
	Route::get('campos_producto/editar/{public_id}','CustomProductController@edit');
	Route::post('campos_producto/editar/{public_id}','CustomProductController@update');
	Route::get('campos_producto/eliminar/{public_id}','CustomProductController@delete');

		/*** ALERTCONTROLLER ***/
	Route::get('alertas','AlertController@index');
	Route::get('alerta','AlertController@create');
	Route::post('alerta','AlertController@store');
	Route::get('alerta/{public_id}','AlertController@show');
	Route::get('alerta/editar/{public_id}','AlertController@edit');
	Route::post('alerta/editar/{public_id}','AlertController@update');
	Route::get('alerta/eliminar/{public_id}','AlertController@delete');

	/*** NOTIFICATIONCONTROLLER ***/
	Route::get('notificaciones','NotificationController@index');
	Route::get('notificacion','NotificationController@create');
	Route::post('notificacion','NotificationController@store');
	Route::get('notificacion/{public_id}','NotificationController@show');
	Route::get('notificacion/editar/{public_id}','NotificationController@edit');
	Route::post('notificacion/editar/{public_id}','NotificationController@update');
	Route::get('notificacion/eliminar/{public_id}','NotificationController@delete');

});
Route::get('productos/busqueda', 'ProductController@busqueda');
Route::group(array('before'=>'superadmin'),function() {
	/*** USERCONTROLLER ***/
	Route::get('usuarios','UserController@index');
	Route::get('usuario','UserController@create');
	Route::post('usuario','UserController@store');
	Route::get('usuario/{public_id}','UserController@show');
	Route::get('usuario/editar/{public_id}','UserController@edit');
	Route::post('usuario/editar/{public_id}','UserController@update');
	Route::get('usuario/eliminar/{public_id}','UserController@delete');			


});	
	/*** CUSTOMCLIENTCONTROLLER ***/
	Route::get('campos_clientes','CustomClientController@index');
	Route::get('campos_cliente','CustomClientController@create');
	Route::post('campos_cliente','CustomClientController@store');
	Route::get('campos_cliente/{public_id}','CustomClientController@show');
	Route::get('campos_cliente/editar/{public_id}','CustomClientController@edit');
	Route::post('campos_cliente/editar/{public_id}','CustomClientController@update');
	Route::get('campos_cliente/eliminar/{public_id}','CustomClientController@delete');

	/*** INVOICECONTROLLER ***/
	Route::get('facturas','InvoiceController@index');
	Route::get('factura','InvoiceController@create');
	Route::post('factura','InvoiceController@store');
	Route::get('factura/{public_id}','InvoiceController@show');
	Route::get('factura/editar/{public_id}','InvoiceController@edit');
	Route::post('factura/editar/{public_id}','InvoiceController@update');
	Route::get('factura/eliminar/{public_id}','InvoiceController@delete');	
	Route::get('factura/nuevo/previsualizar','InvoiceController@previewInvoice');
	Route::get('factura/nuevo/previsualizar2','QuoteController@previewInvoice');
	Route::get('factura/estandar/{public_id}','InvoiceController@showStandard');
	Route::get('factura/copia/{public_id}','InvoiceController@showCopy');
	

	/*** CHARGECONTROLLER ***/
	Route::get('cobros','ChargeController@index');
	Route::get('cobro','ChargeController@create');
	Route::post('cobro','ChargeController@store');
	Route::get('cobro/{public_id}','ChargeController@show');
	Route::get('cobro/editar/{public_id}','ChargeController@edit');
	Route::post('cobro/editar/{public_id}','ChargeController@update');
	Route::get('cobro/eliminar/{public_id}','ChargeController@delete');
	Route::get('cobro/factura/{public_id}','ChargeController@chargeInvoice');

	/*** INVENTORYCONTROLLER ***/
	Route::get('inventarios','InventoryController@index');
	Route::get('inventario','InventoryController@create');
	Route::post('inventario','InventoryController@store');
	Route::get('inventario/{public_id}','InventoryController@show');
	Route::get('inventario/editar/{public_id}','InventoryController@edit');
	Route::post('inventario/editar/{public_id}','InventoryController@update');
	Route::get('inventario/eliminar/{public_id}','InventoryController@delete');	


	/*** QUOTECONTROLLER ***/
	Route::get('cotizaciones','QuoteController@index');
	Route::get('cotizacion','QuoteController@create');
	Route::post('cotizacion','QuoteController@store');
	Route::get('cotizacion/{public_id}','QuoteController@show');
	Route::get('cotizacion/editar/{public_id}','QuoteController@edit');
	Route::post('cotizacion/editar/{public_id}','QuoteController@update');
	Route::get('cotizacion/eliminar/{public_id}','QuoteController@delete');
	Route::get('cotizacion/vercotizacion/{public_id}','QuoteController@showQuote');
	Route::get('cotizacion/nuevo/previsualizar','QuoteController@previewQuote');

	Route::get('excel','ProductController@getExcel');
	Route::post('excel','ProductController@excel');
});

Route::group(array('before' => 'auth.basic'), function(){
	Route::get('loggin','AndroidController@loggin');
	Route::post('client','AndroidController@storeClient');
	Route::get('client/{nit}','AndroidController@getClient');
	Route::post('client/edit/{public_id}','AndroidController@updateClient');
	Route::post('invoice','AndroidController@storeInvoice');
	Route::post('quote','AndroidController@storeQuote');
});
