<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title> @section('title')
			รายงานการจู่โจมตรวจค้น
			@show </title>
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/jquery.simple-dtpicker.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/wysihtml5/prettify.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/wysihtml5/bootstrap-wysihtml5.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/datatables-bootstrap.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/colorbox.css')}}">
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css">
		
		
		
		@yield('styles')
	</head>
    <body>
       
		<!-- Container -->
	<div class="container">


		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
		<!-- ./ Footer -->

	</div>
	<!-- ./ container -->
        <script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-1.4.4.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui-1.8.10.offset.datepicker.min.js')}}"></script>
        <!--<script src="{{asset('assets/js/jquery-ui.js')}}"></script> 1.11.1-->
        
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
		<script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
		<script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
		<script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
		<script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
		<script src="{{asset('assets/js/prettify.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.close_popup').click(function() {
					parent.oTable.fnReloadAjax();
					parent.jQuery.fn.colorbox.close();
					return false;
				});
				$('#deleteForm').submit(function(event) {
					var form = $(this);
					$.ajax({
						type : form.attr('method'),
						url : form.attr('action'),
						data : form.serialize()
					}).done(function() {
						parent.jQuery.colorbox.close();
						parent.oTable.fnReloadAjax();
					}).fail(function() {
					});
					event.preventDefault();
				});
			});
		
		</script>
		<script>
		function reload()
		{
			parent.oTable.fnReloadAjax();
		}
        </script>	
        @yield('scripts')
    </body>
</html>