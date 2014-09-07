<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title> @section('title')
			POC
			@show </title>
		@yield('styles')
	</head>
    <body>
        <h1>POC Report</h1>
		<div class="container">
		@if(Auth::check())
           Logged in as {{Auth::user()->description}}
           {{ HTML::link(URL::to('/'), 'กลับหน้าหลัก')}}
		{{ HTML::link(URL::to('user/logout'), 'Log out')}}
         
        @else
        	Welcome
        	{{ HTML::link(URL::to('/'), 'กลับหน้าหลัก')}}
        	{{ HTML::link(URL::to('user/login'), 'Login')}}
        @endif

        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    	</div>
        @yield('content')
        @yield('scripts')
    </body>
</html>