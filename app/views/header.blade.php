<!--
	created by Brian Barrera ©Vrian7
	Copyright: all right reserved 
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>@yield('title','Factufacil')</title>
		<link href="{{ asset('favicon.gif') }}" rel="icon" type="image/x-icon">
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- GLOBAL STYLES -->
		{{ HTML::style('vendor/bcore/plugins/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('vendor/bcore/css/main.css') }}
		{{ HTML::style('vendor/bcore/css/theme.css') }}
		{{ HTML::style('vendor/bcore/css/MoneAdmin.css') }}		
		{{ HTML::style('vendor/bcore/plugins/Font-Awesome/css/font-awesome.css') }}
		{{ HTML::style('vendor/bcore/plugins/dataTables/dataTables.bootstrap.css') }}
		{{ HTML::style('vendor/bcore/plugins/chosen/chosen.min.css') }}
		{{ HTML::style('vendor/bcore/plugins/datepicker/css/datepicker.css') }}
		{{ HTML::style('vendor/bcore/plugins/gritter/css/jquery.gritter.css') }}
		{{ HTML::style('vendor/custom/customdatepicker.css') }}
		<!--END GLOBAL STYLES -->
		<!-- PAGE LEVEL STYLES -->
		{{-- HTML::style('vendor/bcore/css/layout2.css') --}}
		{{-- HTML::style('vendor/bcore/plugins/flot/examples/examples.css') --}}
		{{-- HTML::style('vendor/bcore/plugins/timeline/timeline.css') --}}

		
		<!-- END PAGE LEVEL  STYLES -->

		{{ HTML::script('vendor/bcore/plugins/jquery-2.0.3.min.js') }}
		{{ HTML::script('vendor/bcore/plugins/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('vendor/bcore/js/login.js') }}
		{{ HTML::script('vendor/bcore/plugins/chosen/chosen.jquery.min.js') }}
		{{ HTML::script('vendor/bcore/plugins/datepicker/js/bootstrap-datepicker.js') }}	
		{{ HTML::script('vendor/bcore/plugins/gritter/js/jquery.gritter.js') }}
		{{-- HTML::script('vendor/bcore/js/moreNoti.js') --}}  				
		{{ HTML::script('vendor/bcore/js/jquery-ui.min.js') }}
		{{ HTML::script('vendor/custom/customdatepicker.js') }}
		
		@yield('head')
	</head>
	<body class="padTop53 ">
		<div id="wrap" >
			<!-- HEADER SECTION -->
	        <div id="top">

	            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
	                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
	                    <i class="icon-align-justify"></i>
	                </a>
	                <!-- LOGO SECTION -->
	                <header class="navbar-header">

	                    <a href="{{asset('/inicio')}}" class="navbar-brand">
	                    <img src="{{asset('vendor/bcore/img/logo_factufacil.png')}}" alt="" height="40" />
	                        </a>
	                </header>
	                <!-- END LOGO SECTION -->
	                <ul class="nav navbar-top-links navbar-right">
	                	<?php
	                	
	                    	$alertc = Alert::where('enterprice_id',Auth::user()->enterprice_id)->where('read',0)->count();
	                   		$notic = Notification::where('enterprice_id',Auth::user()->enterprice_id)->where('read',0)->count();
	                		$notifications = Notification::join('levels','levels.id','=','notifications.level_id')
								->where('notifications.enterprice_id',Auth::user()->enterprice_id)->where('read',0)
								->select('notifications.title','notifications.public_id','notifications.date','notifications.time','notifications.message','levels.description','levels.name')
								->orderBy('level_id','desc')->orderBy('date','desc')->get();
						?>
	                    <!-- MESSAGES SECTION -->
	                    <li class="dropdown">
	                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                            <span class="label label-success">{{$notic}}</span>    <i class="icon-envelope-alt"></i>&nbsp; <i class="icon-chevron-down"></i>
	                        </a>

	                        <ul class="dropdown-menu dropdown-messages">
	                         @foreach($notifications as $notification)
	                            <li>
	                                <a href="{{asset('notificacion/'.$notification->public_id)}}">
	                                    <div>
	                                       <strong>{{$notification->title}}</strong>
	                                        <span class="pull-right text-muted">
	                                            <em>{{$notification->date}}</em>
	                                        </span>
	                                    </div>
	                                    <div>{{$notification->message}}
	                                        <br />
	                                        <span class="label {{$notification->description}}">{{$notification->name}}</span> 
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                      	@endforeach	                            
	                            <li>
	                                <a class="text-center" href="{{asset('notificaciones')}}">
	                                    <strong>Ver mas notificaciones</strong>
	                                    <i class="icon-angle-right"></i>
	                                </a>
	                            </li>
	                        </ul>

	                    </li>
	                    <!--END MESSAGES SECTION -->	                    
	                    <!--TASK SECTION -->
	                    <li class="dropdown">
	                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                            <span class="label label-danger">{{$alertc}}</span>   <i class="icon-warning-sign"></i>&nbsp; <i class="icon-chevron-down"></i>
	                        </a>
	                       <ul class="dropdown-menu dropdown-messages">
	                       	<?php 	                       		
	                       		$alerts = Alert::join('levels','levels.id','=','alerts.level_id')
								->where('alerts.enterprice_id',Auth::user()->enterprice_id)->where('alerts.read',0)
								->select('alerts.title','alerts.public_id','alerts.date','alerts.time','alerts.message','levels.description','levels.name')
								->orderBy('level_id','desc')->orderBy('date','desc')->get();
	                       	?>
	                       	@foreach($alerts as $alert)
	                            <li>
	                                <a href="{{asset('alerta/'.$alert->public_id)}}">
	                                    <div>
	                                       <strong>{{$alert->title}}</strong>
	                                        <span class="pull-right text-muted">
	                                            <em>{{$alert->date}}</em>
	                                        </span>
	                                    </div>
	                                    <div>{{$alert->message}}
	                                        <br />
	                                        <span class="label {{$alert->description}}">{{$alert->name}}</span> 

	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                      	@endforeach	                        
	                            <li>
	                                <a class="text-center" href="{{asset('alertas')}}">
	                                    <strong>Ver todas las alertas</strong>
	                                    <i class="icon-angle-right"></i>
	                                </a>
	                            </li>
	                        </ul>


	                    </li>
	                    <!--END TASK SECTION -->

	                    <!--ALERTS SECTION -->
<!-- 	                    <li class="chat-panel dropdown">
	                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                            <span class="label label-info">8</span>   <i class="icon-comments"></i>&nbsp; <i class="icon-chevron-down"></i>
	                        </a>

	                        <ul class="dropdown-menu dropdown-alerts">

	                            <li>
	                                <a href="#">
	                                    <div>
	                                        <i class="icon-comment" ></i> New Comment
	                                    <span class="pull-right text-muted small"> 4 minutes ago</span>
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                            <li>
	                                <a href="#">
	                                    <div>
	                                        <i class="icon-twitter info"></i> 3 New Follower
	                                    <span class="pull-right text-muted small"> 9 minutes ago</span>
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                            <li>
	                                <a href="#">
	                                    <div>
	                                        <i class="icon-envelope"></i> Message Sent
	                                    <span class="pull-right text-muted small" > 20 minutes ago</span>
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                            <li>
	                                <a href="#">
	                                    <div>
	                                        <i class="icon-tasks"></i> New Task
	                                    <span class="pull-right text-muted small"> 1 Hour ago</span>
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                            <li>
	                                <a href="#">
	                                    <div>
	                                        <i class="icon-upload"></i> Server Rebooted
	                                    <span class="pull-right text-muted small"> 2 Hour ago</span>
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="divider"></li>
	                            <li>
	                                <a class="text-center" href="#">
	                                    <strong>See All Alerts</strong>
	                                    <i class="icon-angle-right"></i>
	                                </a>
	                            </li>
	                        </ul>

	                    </li> -->
	                    <!-- END ALERTS SECTION -->

	                    <!--ADMIN SETTINGS SECTIONS -->

	                    <li class="dropdown">
	                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
	                        </a>

	                        <ul class="dropdown-menu dropdown-user">
	                            <li><a href="{{asset('usuario/editar/'.Auth::user()->public_id)}}"><i class="icon-user"></i> Perfil de usuario </a>
	                            </li>
	                            <li><a href="#"><i class="icon-gear"></i> Cuenta</a>
	                            </li>
	                            <li class="divider"></li>
	                            <li><a href="{{asset('salir')}}"><i class="icon-signout"></i> Salir </a>
	                            </li>
	                        </ul>
	                    </li>
	                    <!--END ADMIN SETTINGS -->
	                </ul>
	            </nav>
	        </div>
	        <!-- END HEADER SECTION -->

		    <!-- MENU SECTION -->
	       <div id="left" >
	            <div class="media user-media well-small">
	                <a class="user-link" href="#">
	                    <img class="media-object img-thumbnail user-img" alt="Fotograf&iacute;a de usuario" src="{{asset('uploads/users/'.Auth::user()->avatar)}}"  height="100" width="100"/>
	                </a>
	                <br />
	                <div class="media-body">
	                    <h5 class="media-heading"> {{Auth::user()->name}}</h5>
	                    <ul class="list-unstyled user-info">	                        
	                        <li>
	                             <!--<a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a>--> {{Session::get('enterprice')}}
	                        </li>
	                       
	                    </ul>
	                </div>
	                <br />
	            </div>

	            <ul id="menu" class="collapse">

	                
	                <li class="panel active">
	                    <a href="{{asset('inicio')}}" >
	                        <i class="icon-desktop"></i> Resumen		   	                      
	                    </a>                   
	                </li>
	                <li><a href="{{asset('clientes')}}"><i class="icon-group"></i> Clientes </a></li>



	                <li class="panel ">
	                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
	                        <i class="icon-tasks"> </i> Inventario
		   
	                        <span class="pull-right">
	                          <i class="icon-angle-left"></i>
	                        </span>
	                       &nbsp; <span class="label label-default">6</span>&nbsp;
	                    </a>
	                    <ul class="collapse" id="component-nav">	                       
	                        <li class=""><a href="{{asset('productos')}}"><i class="icon-angle-right"></i> Productos </a></li>
	                         <li class=""><a href="{{asset('categorias')}}"><i class="icon-angle-right"></i> Categorias	 </a></li>
	                        <li class=""><a href="{{asset('unidades')}}"><i class="icon-angle-right"></i> Unidades </a></li>
	                        <li class=""><a href="{{asset('marcas')}}"><i class="icon-angle-right"></i> Marcas </a></li>
	                        <li class=""><a href="{{asset('inventarios')}}"><i class="icon-angle-right"></i> Asignaci&oacute;n </a></li>
	                        <li class=""><a href="{{asset('campos_productos')}}"><i class="icon-angle-right"></i> Campos Adicionales </a></li>
	                    </ul>
	                </li>
	                <li class="panel ">
	                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
	                        <i class="icon-shopping-cart"></i> Ventas
		   
	                        <span class="pull-right">
	                            <i class="icon-angle-left"></i>
	                        </span>	
	                          &nbsp; <span class="label label-success">3</span>&nbsp;
	                    </a>
	                    <ul class="collapse" id="form-nav">
	                        <li class=""><a href="{{asset('facturas')}}"><i class="icon-angle-right"></i> Facturas </a></li>
	                        <li class=""><a href="{{asset('cobros')}}"><i class="icon-angle-right"></i> Cobros </a></li>
	                        <li class=""><a href="{{asset('cotizaciones')}}"><i class="icon-angle-right"></i> Cotizaci&oacute;n </a></li>
	                    </ul>
	                </li>

	                <li class="panel">
	                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#pagesr-nav">
	                        <i class="icon-building"></i> Dosificaci&oacute;n
		   
	                        <span class="pull-right">
	                            <i class="icon-angle-left"></i>
	                        </span>
	                          &nbsp; <span class="label label-info">3</span>&nbsp;
	                    </a>
	                    <ul class="collapse" id="pagesr-nav">
	                        <li><a href="{{asset('sucursales')}}"><i class="icon-angle-right"></i> Sucursales </a></li>
	                        <li><a href="{{asset('examen')}}"><i class="icon-angle-right"></i> Examen SFV </a></li>
	                        <li><a href="{{asset('libro/ventas')}}"><i class="icon-angle-right"></i> Libro de ventas </a></li>
	                    </ul>
	                </li>	                
	                <li class="panel ">
	                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#config-nav">
	                        <i class="icon-tasks"> </i> Configuraci&oacute;n
		   
	                        <span class="pull-right">
	                          <i class="icon-angle-left"></i>
	                        </span>
	                       &nbsp; <span class="label label-default">2</span>&nbsp;
	                    </a>
	                    <ul class="collapse" id="config-nav">
	                       
	                        <li class=""><a href="{{asset('usuarios')}}"><i class="icon-angle-right"></i> Usuarios </a></li>
	                         <li class=""><a href="{{asset('campos_clientes')}}"><i class="icon-angle-right"></i> Campos adicionales</a></li>
	                    </ul>
	                </li>
	                <li><a href="{{asset('salir')}}"><i class="icon-signout"></i> Salir del sistema </a></li>

	            </ul>

	        </div>
	        <!--END MENU SECTION -->	        
	        <div id="content">
	        	@yield('body')
	        </div>
	        
		</div>
		

		<div id="footer">
        <p>&copy;  RUSYSVE &nbsp;2016 &nbsp;</p>
    	</div>
		
		
	</body>
</html>
@if(Session::get('title'))
<script type="text/javascript">
    function notification(){
        ti = '{{Session::get('title')}}';
        te = '{{Session::get('text')}}';
        $.gritter.add({            
            title: ti,            
            text: te,            
            sticky: false,            
            time: ''
        });
    }
    notification();
</script>
@endif
