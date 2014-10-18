<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title> @section('title')
			POC
			@show </title>
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/jquery.simple-dtpicker.css')}}" />
		@yield('styles')
	</head>
    <body>
        <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
				
						
						<div class ="pull-right" >
							
							@if(Auth::check())
								{{Auth::user()->location->fullname}}
							@endif	
				
						</div>
						
						
					
        	<div class="container">		
        		<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li{{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
							@if(Auth::check())
								<!-- check อธิบดี-->
								@if(Auth::user()->location->id == 0)
								    <li><a href="{{{ URL::to('report/overall') }}}"><span class="glyphicon glyphicon-book"></span> รายงานการจู่โจมตรวจค้นทั้งหมด</a></li>
						            <li><a href="{{{ URL::to('report/byitems') }}}"><span class="glyphicon glyphicon-book"></span> รายงานการจู่โจมตรวจค้นแยกตามประเภทสิ่งของต้องห้าม</a></li>
						            <li><a href="{{{ URL::to('report/map') }}}"><span class="glyphicon glyphicon-book"></span> ภาพรวมการจู่โจมตรวจค้น</a></li>
						        <!-- check ศปส-->
						        @elseif(Auth::user()->location->id == 1)
									  <li><a href="{{{ URL::to('report/view') }}}"><span class="glyphicon glyphicon-book"></span> ดูรายงาน</a></li>
								@else
						        	<li><a href="{{{ URL::to('report/add') }}}"><span class="glyphicon glyphicon-book"></span> เพิ่มรายงาน การจู่โจมตรวจค้น</a></li>
						            <li><a href="{{{ URL::to('report/view') }}}"><span class="glyphicon glyphicon-book"></span> ดูรายงาน</a></li>
						       
						        @endif
						     @endif    
							</li>
						</ul>
						<ul class="nav navbar-nav pull-right">
							@if(Auth::check())
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
        <script src="{{asset('assets/js/jquery.simple-dtpicker.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.js')}}"></script> <!--1.11.1-->
        
        	
        @yield('scripts')
    </body>
</html>