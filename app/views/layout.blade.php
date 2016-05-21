<!--
	created by Brian Barrera ©Vrian7
	Copyright: all right reserved 
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>@yield('title','Factucom')</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		{{ HTML::style('vendor/bcore/plugins/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('vendor/bcore/css/login.css') }}
		{{ HTML::style('vendor/bcore/plugins/magic/magic.css') }}		
		{{ HTML::style('vendor/bcore/css/bootstrap-fileupload.min.css') }}		
		{{ HTML::style('vendor/bcore/css/jquery.min.css') }}
		{{ HTML::style('vendor/bcore/plugins/gritter/css/jquery.gritter.css') }}

		@yield('head')
	</head>
	<body>
		@yield('body')
		{{ HTML::script('vendor/bcore/plugins/jquery-2.0.3.min.js') }}
		{{ HTML::script('vendor/bcore/plugins/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('vendor/bcore/js/login.js') }}
		{{ HTML::script('vendor/bcore/plugins/modernizr-2.6.2-respond-1.1.0.min.js') }}
		{{ HTML::script('vendor/bcore/plugins/jquery-steps-master/lib/jquery.cookie-1.3.1.js') }}
		{{ HTML::script('vendor/bcore/plugins/jquery-steps-master/build/jquery.steps.js') }}
		{{ HTML::script('vendor/bcore/plugins/jasny/js/bootstrap-fileupload.js') }}
		{{ HTML::script('vendor/bcore/js/WizardInit.js') }}   
		{{-- HTML::script('vendor/bcore/js/jquery-ui.min.js') --}}   
		{{ HTML::script('vendor/bcore/plugins/gritter/js/jquery.gritter.js') }}
		{{-- HTML::script('vendor/bcore/js/moreNoti.js') --}}   

		<script type="text/javascript">
     $('a[href$="finish"]').click(function(){
        console.log("asdfadf");
     });
</script>
	</body>

</html>