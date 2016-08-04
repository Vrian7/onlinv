<!DOCTYPE html>
@extends('layout')

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
      <meta charset="UTF-8" />
    <title>Factufacil | Error 403</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />         
  <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

     <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="assets/css/error.css" />
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" />   
   {{ HTML::style('vendor/bcore/css/error.css') }}
   {{ HTML::style('vendor/bcore/plugins/Font-Awesome/css/font-awesome.css') }}
</head>
     <!-- END HEAD -->
     <!-- BEGIN BODY -->
<body  >
      <!-- PAGE CONTENT --> 
  <div class="container">
        <div class="col-lg-8 col-lg-offset-2 text-center">
	  <div class="logo">
	    <h1>Restringido !</h1>
          </div>
          <p class="lead text-muted">Alto, no tiene acceso a este lugar.</p>
          <div class="clearfix"></div>
                <div class="col-lg-6 col-lg-offset-3">
                    <form action="index.html">
                    
                    <div class="input-group">
		      <input type="text" placeholder="Buscar ..." class="form-control" />
		      <span class="input-group-btn">
			<button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
		      </span>
		    </div>
		    
                    </form>
                </div>
            <div class="clearfix"></div>
            <br />
                <div class="col-lg-6  col-lg-offset-3">
		  <div class="btn-group btn-group-justified">
		      <a href="{{asset('/inicio')}}" class="btn btn-primary">Retornar al sistema</a>
                      <a href="{{asset('salir')}}" class="btn btn-danger">Salir</a>
		  </div>
                        
                </div>
        </div>
                
                
        </div>
      <!-- END PAGE CONTENT --> 


</body>
     <!-- END BODY -->
</html>
