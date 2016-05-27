<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialDatabase extends Migration {

	/**
	 * Run the migrations.
	 * @Vrian7
	 * @return void
	 */
	public function up()
	{
		/*Schema::create('',function($table){

		});*/
		Schema::create('currencies',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('symbol');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('levels',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('invoice_statuses',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('enterprice_types',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('initials');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('enterprices',function($table){
			$table->increments('id');
			$table->unsignedInteger('currency_id')->index()->default(1);
			$table->unsignedInteger('enterprice_type_id')->index();
			$table->string('name');
			$table->string('mail');
			$table->string('domain')->unique();
			$table->string('nit');
			$table->string('owner')->nullable();			
			$table->string('logo')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('currency_id')->references('id')->on('currencies');			
			//extralabels
			//$table->string('client_extra1');
			//$table->string('client_extra2');
			//$table->string('client_extra3');
			//$table->string('client_extra4');
			//$table->string('client_extra5');
		});
		Schema::create('custom_clients',function($table){
			$table->increments('id');			
			$table->unsignedInteger('enterprice_id')->index();			
			$table->string('field1')->nullable();
			$table->string('field2')->nullable();
			$table->string('field3')->nullable();
			$table->string('field4')->nullable();
			$table->string('field5')->nullable();					
			$table->timestamps();
			$table->softDeletes();			
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});	
		Schema::create('rols',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('permissions')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('branch_types',function($table){						
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->mediumText('template')->nullable();
			$table->timestamps();
			$table->softDeletes();			
		});
		Schema::create('branches',function($table){
			$table->increments('id');
			$table->unsignedInteger('branch_type_id')->index();
			$table->unsignedInteger('enterprice_id')->index();			
			$table->boolean('central_house')->default(0);
			$table->string('name');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('zone');
			$table->string('phone');
			$table->unsignedInteger('number');
			$table->string('process_number');
			$table->string('authorization_number');
			$table->date('deadline');
			$table->string('document');
			$table->string('economic_activity');
			$table->string('legend');
			$table->string('dosage_key');
			$table->string('invoice_extra_fields');			
			$table->unsignedInteger('invoice_counter')->default('1');
			$table->unsignedInteger('public_id');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('branch_type_id')->references('id')->on('branch_types');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('users',function($table){
			$table->increments('id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('rol_id')->index();
			$table->unsignedInteger('branch_id')->nullable();
			$table->string('name');
			$table->string('username');
			$table->string('password');
			$table->string('phone');
			$table->string('avatar');
			$table->string('remember_token');
			$table->unsignedInteger('public_id');
			$table->boolean('enabled')->default(1);
			$table->boolean('logged')->default(false);
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
			$table->foreign('rol_id')->references('id')->on('rols');
		});
		Schema::create('logs',function($table){
			$table->increments('id');
			$table->unsignedInteger('user_id')->index();
			$table->unsignedInteger('enterprice_id')->index();
			$table->string('type');
			$table->string('action');
			$table->string('ip');
			$table->unsignedInteger('public_id');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});	
		Schema::create('units',function($table){
			$table->increments('id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('public_id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('symbol');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('brands',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('manofacturer')->nullable();
			$table->string('provider')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('categories',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->string('name');
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('price_types',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->string('name');
			$table->string('description')->nullable();			
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});

		Schema::create('prices',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('unit_id')->index();
			$table->unsignedInteger('brand_id')->index();
			$table->string('name');
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('products',function($table){
			$table->increments('id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('unit_id')->index();
			$table->unsignedInteger('brand_id')->index();
			$table->unsignedInteger('category_id')->index();
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('code');			
			$table->double('price')->default(0);
			$table->unsignedInteger('public_id');
			$table->string('extra1')->nullable();
			$table->string('extra2')->nullable();
			$table->string('extra3')->nullable();
			$table->string('extra4')->nullable();
			$table->string('extra5')->nullable();
			$table->timestamps();
			$table->softDeletes();			
			$table->foreign('category_id')->references('id')->on('categories');
			$table->foreign('brand_id')->references('id')->on('brands');
			$table->foreign('unit_id')->references('id')->on('units');			
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('custom_products',function($table){
			$table->increments('id');						
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('category_id')->index();			
			$table->unsignedInteger('enterprice_id')->index();
			$table->string('field1')->nullable();
			$table->string('field2')->nullable();
			$table->string('field3')->nullable();
			$table->string('field4')->nullable();
			$table->string('field5')->nullable();					
			$table->timestamps();
			$table->softDeletes();						
			$table->foreign('category_id')->references('id')->on('categories');			
		});	
		Schema::create('inventories',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('branch_id')->index();
			$table->unsignedInteger('product_id')->index();
			$table->decimal('stock', 13, 2)->default(0);
			$table->decimal('average', 13, 2)->default(0);
			$table->decimal('minimum', 13, 2)->default(0);
			$table->decimal('sold', 13, 2)->default(0);
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('product_id')->references('id')->on('products');
			$table->foreign('branch_id')->references('id')->on('branches');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('clients',function($table){
			$table->increments('id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('public_id');
			$table->string('name');
			$table->string('business_name');
			$table->string('nit');
			$table->string('address')->nullable();
			$table->string('phone')->nullable();
			$table->string('mail')->nullable();
			$table->string('description')->nullable();
			$table->string('symbol');
			$table->double('debt')->default(0);
			$table->double('flow');
			$table->string('contact_data');
			$table->string('extra1');
			$table->string('extra2');
			$table->string('extra3');
			$table->string('extra4');
			$table->string('extra5');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('invoices',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();

			/*** INDEX of related tables***/
			$table->unsignedInteger('branch_id');
			$table->unsignedInteger('user_id');			
			$table->unsignedInteger('client_id');
			$table->unsignedInteger('branch_type_id');	
			$table->string('invoice_status_ids');		
			/*** Addional account data***/
			$table->string('nit');
			$table->string('authorization_number');
			$table->string('matriz_address');
			$table->string('dosage_key');
			$table->string('city');
			$table->string('country');
			$table->date('deadline');
			/*** Aditional client data***/
			$table->string('client_name');
			$table->string('client_nit');
			//$table->

			/*** numerical data***/
			$table->double('net_amount');
			$table->double('total_amount');
			$table->double('taxable_amount');
			$table->float('tax_amount');
			$table->float('ice_amount');
			$table->double('excent_amount');
			$table->float('discount');
			$table->float('exchange');
			$table->double('net_amount_dollar');
			$table->double('debt');
			//$table-> seuq esiente que poco a pococ todo se va a al migrationsauq

			/*** Invoice Data***/
			$table->unsignedInteger('number');
			$table->date('date');			
			$table->unsignedInteger('notes');
			$table->string('control_code');
			$table->string('legend');			
			//$table->string('');
			$table->string('tracing')->nullable();
			//nit,nombre usuario, nombre o rqazon social, direccion, codigo sucursal, codigo tipo factura,nombrecomprador,dui,indentificador comprador,
			//debito fiscal, importeneto, importe total, importe ice, importe exento, descuento total, codigo cde control, num de autorizacion,
			//numero de factura, actividad economica, fecha emision, numerio de linea, detalle de la compra, precio unitario, canidad m unidad ede medidam, preciototal
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('branch_id')->references('id')->on('branches');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('branch_type_id')->references('id')->on('branch_types');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('invoice_details',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('invoice_id')->index();
			$table->unsignedInteger('product_id')->index();		
			$table->string('name');
			$table->string('code');
			$table->double('price');
			$table->float('quantity');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('product_id')->references('id')->on('products');
			$table->foreign('invoice_id')->references('id')->on('invoices');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('payment_types',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('charges',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('invoice_id')->index();
			$table->unsignedInteger('client_id')->index();
			$table->unsignedInteger('payment_type_id')->index();
			$table->string('paid_for')->nullable();
			$table->double('amount')->default(0);
			$table->date('date');
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('invoice_id')->references('id')->on('invoices');
			$table->foreign('client_id')->references('id')->on('clients');
			$table->foreign('payment_type_id')->references('id')->on('payment_types');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('alerts',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('level_id')->index();
			$table->string('title');
			$table->string('message');
			$table->string('description')->nullable();
			$table->date('date');
			$table->time('time');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('level_id')->references('id')->on('levels');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		Schema::create('notifications',function($table){
			$table->increments('id');
			$table->unsignedInteger('public_id');
			$table->unsignedInteger('enterprice_id')->index();
			$table->unsignedInteger('level_id')->index();
			$table->string('title');
			$table->string('message');
			$table->string('description')->nullable();
			$table->date('date');
			$table->time('time');
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('level_id')->references('id')->on('levels');
			$table->foreign('enterprice_id')->references('id')->on('enterprices');
		});
		/*** CREATING TRIGERS***/
		DB::unprepared('
			CREATE TRIGGER alerts_before_insert BEFORE INSERT ON `alerts` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM alerts WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER notifications_before_insert BEFORE INSERT ON `notifications` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM notifications WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER branches_before_insert BEFORE INSERT ON `branches` FOR EACH ROW 
			BEGIN
			    SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM branches WHERE enterprice_id = NEW.enterprice_id );
			END
		');		
		DB::unprepared('
			CREATE TRIGGER brands_before_insert BEFORE INSERT ON `brands` FOR EACH ROW 
			BEGIN
				SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM brands WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER categories_before_insert BEFORE INSERT ON `categories` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM categories WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER charges_before_insert BEFORE INSERT ON `charges` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM charges WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER clients_before_insert BEFORE INSERT ON `clients` FOR EACH ROW 
			BEGIN
			    SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM clients WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER custom_products_before_insert BEFORE INSERT ON `custom_products` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM custom_products WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER inventories_before_insert BEFORE INSERT ON `inventories` FOR EACH ROW 
			BEGIN
				SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM inventories WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER invoices_before_insert BEFORE INSERT ON `invoices` FOR EACH ROW 
			BEGIN
				SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM invoices WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER invoice_details_before_insert BEFORE INSERT ON `invoice_details` FOR EACH ROW 
			BEGIN
				SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM invoice_details WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER products_before_insert BEFORE INSERT ON `products` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM products WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER units_before_insert BEFORE INSERT ON `units` FOR EACH ROW 
			BEGIN
    			SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM units WHERE enterprice_id = NEW.enterprice_id );
			END
		');
		DB::unprepared('
			CREATE TRIGGER users_before_insert BEFORE INSERT ON `users` FOR EACH ROW 
			BEGIN
			    SET NEW.public_id = (SELECT COALESCE (MAX(public_id),0) + 1 FROM users WHERE enterprice_id = NEW.enterprice_id );
			END
		');	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
