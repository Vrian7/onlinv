@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Clientes </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Cliente: {{$client->business_name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n B&aacute;sica</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Raz&oacute;n Social: </label> {{$client->business_name}}
                       <small>Dato para facuturar
                        </small>
                        <i class="icon-group"></i> <label>NIT: </label> {{$client->nit}}
                       <small>N&uacute;mero de identificaci&oacute;n tributaria
                        </small>
                    </blockquote>
                    <h4>Informaci&oacute;n del cliente</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Nombre del cliente: </label> {{$client->name}}
                       <small>Dato para identificar al cliente
                        </small>
                        <i class="icon-group"></i> <label>Direcci&oacute;n: </label> {{$client->address}}
                       <small>Ubicaci&oacute;n
                        </small>
                        <i class="icon-group"></i> <label>Tel&eacute;fono / Celular: </label> {{$client->phone}}
                       <small>Dato telef&oacute;nico
                        </small>
                        <i class="icon-group"></i> <label>Correo electr&oacute;nico: </label> {{$client->mail}}
                       <small>Correo 
                        </small>
                        <i class="icon-group"></i> <label>Datos Adicionales: </label> {{$client->description}}
                       <small>Dato cliente
                        </small>
                        <i class="icon-group"></i> <label>Contacto: </label> {{$client->contact_data}}
                       <small>Dato para comunicar a la empresa
                        </small>
                    </blockquote>
                </div>
                <div class="col-lg-6"> 
                @if(isset($custom->field1))
                <h4>Informaci&oacute;n Personalizada</h4>
                    <blockquote>                        
                        @if($custom->field1!="")
                        <i class="icon-group"></i> <label>{{$custom->field1}}: </label> {{$client->extra1}}
                        <small>Dato personalizado
                        </small>
                        @endif
                        @if($custom->field2!="")
                        <i class="icon-group"></i> <label>{{$custom->field2}}: </label> {{$client->extra2}}
                        <small>Dato personalizado
                        </small>
                        @endif
                        @if($custom->field3!="")
                        <i class="icon-group"></i> <label>{{$custom->field3}}: </label> {{$client->extra3}}
                        <small>Dato personalizado
                        </small>
                        @endif
                        @if($custom->field4!="")
                        <i class="icon-group"></i> <label>{{$custom->field4}}: </label> {{$client->extra4}}
                        <small>Dato personalizado
                        </small>
                        @endif
                        @if($custom->field5!="")
                        <i class="icon-group"></i> <label>{{$custom->field5}}: </label> {{$client->extra5}}
                        <small>Dato personalizado
                        </small>
                        @endif
                    </blockquote>
                    @endif
                </div>
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('clientes')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('cliente/editar/'.$client->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop