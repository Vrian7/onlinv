@extends('header')
@section('body')
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Sucursales </h2>
        </div>
    </div>
    <hr />
    <div class="row">
    <div class="col-lg-12">
        <div class="box primary">            
            <header>
                    <div class="icons"><i class="icon-group"></i></div>
                    <h5>Sucursal: {{$branch->name}}</h5>
                    <div class="toolbar">
                        <a class="btn btn-danger btn-sm btn-grad" href="">Eliminar</a>
                    </div>
                </header>
            <div class="panel-body">
                <div class="col-lg-6">           
                    <h4>Informaci&oacute;n de la Sucursal</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>Nombre: </label> {{$branch->name}}
                       <small>Nombre para reconocer a la sucursal
                        </small>
                        <i class="icon-group"></i> <label>Tipo: </label> {{$type}}
                       <small>
                        </small>
                        <i class="icon-group"></i> <label>Actividad Econ&oacute;mica: </label> {{$branch->economic_activity}}
                       <small>Actidad que realisa la sucursal
                        </small>
                        <i class="icon-group"></i> <label>Direcci&oacute;n: </label> {{$branch->address}}
                       <small>Direcci&oacute;n oficil de la emrpesa
                        </small>
                        <i class="icon-group"></i> <label>Zona: </label> {{$branch->zone}}
                       <small>Zona
                        </small>
                        <i class="icon-group"></i> <label>Ciudad: </label> {{$branch->city}}
                       <small>Ciudad
                        </small>
                        <i class="icon-group"></i> <label>Municipio: </label> {{$branch->state}}
                       <small>Municipio
                        </small>
                        <i class="icon-group"></i> <label>Tel&eacute;fono: </label> {{$branch->phone}}
                       <small>
                        </small>
                    </blockquote>
                    
                </div>
                <div class="col-lg-6"> 
                <h4>Informaci&oacute;n de la sucrrsal</h4>
                    <blockquote>
                       <i class="icon-group"></i> <label>N&uacute;mero de tr&aacute;mite: </label> {{$branch->process_number}}
                       <small>De la presente dosificaci&oacute;n
                        </small>
                        <i class="icon-group"></i> <label>N&uacute;mero de autorizaci&oacute;n: </label> {{$branch->authorization_number}}
                       <small>Numero
                        </small>
                        <i class="icon-group"></i> <label>N&uacute;mero de Sucursal: </label> {{$branch->number}}
                       <small>Brindada por impuestos
                        </small>
                        <i class="icon-group"></i> <label>Fecha l&iacute;mite de emisi&oacute;n: </label> {{$branch->deadline}}
                       <small>Fecha de caducaci&oacute;n de la presente dosificaci&oacute;n
                        </small>
                        <i class="icon-group"></i> <label>Llave de dosificaci&oacute;n: </label> {{$branch->dosage_key}}
                       <small>Llave
                        </small>
                        <i class="icon-group"></i> <label>Leyenda seg&uacute;n LEY Nº453: </label> {{$branch->legend}}
                       <small>Leyenda brindada por impuestos
                        </small>
                    </blockquote>
                </div>
               <hr>
            </div>
<div class="col-lg-12">
    <div class="col-lg-3"></div>
    <div class="col-lg-2"><a class="btn btn-warning" href="{{asset('sucursales')}}"><i class="icon-ban-circle icon-white"></i> Cancelar</a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"><a class="btn btn-primary" href="{{asset('sucursal/editar/'.$branch->public_id)}}"><i class="icon-pencil icon-white"></i> Editar</a></div>
</div>
        </div>
    </div>
</div>
</div>
{{ HTML::script('vendor/bcore/plugins/dataTables/jquery.dataTables.js') }}   
    {{ HTML::script('vendor/bcore/plugins/dataTables/dataTables.bootstrap.js') }}   

@stop