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
        <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
				
				<div class="container">			
						<div class ="pull-right" >
							<h3 style="color: #000000">
							@if(Auth::check())
								{{Auth::user()->location->fullname}}
							@endif
							</h3>
						</div>
						
				</div>		
					
        	<div class="container">		
        		<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							@if(Auth::check())
								<!-- check อธิบดี-->
								@if(Auth::user()->role_id == 2)
									 <li{{ (Request::is('report/dashboard*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/dashboard') }}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
									 <li{{ (Request::is('report/view_all*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/view_all') }}}"><span class="glyphicon glyphicon-briefcase"></span> ดูรายงาน</a></li>
									 <li{{ (Request::is('report/bylocation*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/bylocation') }}}"><span class="glyphicon glyphicon-globe"></span> ดูกราฟตามสถานที่</a></li>
									 <li{{ (Request::is('report/bydate*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/bydate') }}}"><span class="glyphicon glyphicon-stats"></span> ดูกราฟตามเวลา</a></li>
									    
								<!-- check ศปส-->
						        @elseif(Auth::user()->role_id == 1)
						      		  <li{{ (Request::is('report/dashboard*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/dashboard') }}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
									  <li{{ (Request::is('report/view_all*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/view_all') }}}"><span class="glyphicon glyphicon-briefcase"></span> ดูรายงาน</a></li>
									  <li{{ (Request::is('report/bylocation*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/bylocation') }}}"><span class="glyphicon glyphicon-globe"></span> ดูกราฟตามสถานที่</a></li>
									  <li{{ (Request::is('report/bydate*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/bydate') }}}"><span class="glyphicon glyphicon-stats"></span> ดูกราฟตามเวลา</a></li>
								<!-- รจ ธรรมดา -->
								@elseif(Auth::user()->role_id == 3)
						        	<li{{ (Request::is('report/add*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/add') }}}"><span class="glyphicon glyphicon-pencil"></span> เพิ่มรายงาน การจู่โจมตรวจค้น</a></li>
						            <li{{ (Request::is('report/view*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/view') }}}"><span class="glyphicon glyphicon-briefcase"></span> ดูรายงาน</a></li>
						       
						        @endif
						     @endif    
							</li>
						</ul>
						<ul class="nav navbar-nav pull-right">

							@if(Auth::check())
								@if(Auth::user()->role_id == 1)
									<li{{ (Request::is('report/admin_panel*') ? ' class="active"' : '') }}><a href="{{{ URL::to('report/admin_panel') }}}"><span class="glyphicon glyphicon-bookmark"></span> Admin Panel</a></li>  
								@endif
					          	<li><a href="{{{ URL::to('user/logout') }}}"><span class="glyphicon glyphicon-share"></span> Log out</a></li>
					        @else						      
					        	 <li{{ (Request::is('user/login*') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}"><span class="glyphicon glyphicon-user"></span> Login</a></li>
					        	
					        @endif		
						</ul>
				</div>		
        	</div>
        </div>
		<div class="container">
	
	        @if(Session::has('message'))
	            <p class="alert">{{ Session::get('message') }}</p>
	        @endif
    	</div>
    	<div class="container">
        	@yield('content')
        </div>
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
        
        	
        @yield('scripts')
    </body>
</html>