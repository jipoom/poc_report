@extends("layout")
@section("content")
	<div class="welcome">
		<p></p>
		{{ HTML::link(URL::to('report/dashboard'), 'Dashboard')}}<p></p>
		{{ HTML::link(URL::to('report/hdashboard'), 'HDashboard')}}<p></p>
		{{ HTML::link(URL::to('report/poc'), 'MAP POC')}}<p></p>
		{{ HTML::link(URL::to('report/stand_alone'), 'Stand Alone POC')}}
	</div>
@stop
