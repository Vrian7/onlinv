<?php 
class DataSeeder extends Seeder
{
	public function run(){
		Currency::create(array(
			'name' => 'Bolivianos',
			'symbol' => 'Bs'
		));
		Currency::create(array(
			'name' => 'Dolares',
			'symbol' => '$us'
		));
		InvoiceStatus::create(array(
			'name' => 'Emitido',
			'description' => 'Factura emitida correctamente'
		));
		InvoiceStatus::create(array(
			'name' => 'Anulado',
			'description' => 'Factura Anulada'
		));
		PaymentType::create(array(
			'name' => 'Efectivo',
			'description' => 'efectivo'
		));
		PaymentType::create(array(
			'name' => 'Tranferencia Bancaria',
			'description' => 'transferencia'
		));
		PaymentType::create(array(
			'name' => 'deposito bancario',
			'description' => 'deposito'
		));
		PaymentType::create(array(
			'name' => 'Trajera de credito',
			'description' => 'trajeta'
		));
		Rol::create(array(
			'name' => 'Super Administrador',
			'permissions' => '1'
		));
		Rol::create(array(
			'name' => 'Administrador',
			'permissions' => '2'
		));
		Rol::create(array(
			'name' => 'Facturador',
			'permissions' => '3'
		));
		BranchType::create(array(
			'name' => 'Productos',
			'description' => 'venta de productws',
			'template' => 'Products template'
		));
		BranchType::create(array(
			'name' => 'Servicios',
			'description' => 'VEntas de serviceios',
			'template' => 'servicios templeta'
		));
		BranchType::create(array(
			'name' => 'Alquileres',
			'description' => 'Renta de inmuebles',
			'template' => 'template de alkileres'
		));
	}
}
?>