@extends("layout")
@section("content")
	<div class="welcome">
		<p></p>
		{{ HTML::link(URL::to('user/create'), 'Create users')}}<p></p>

		{{ HTML::link(URL::to('report/poc'), 'MAP POC')}}<p></p>
		{{ HTML::link(URL::to('report/stand_alone'), 'Stand Alone POC')}}
	</div>
@stop
