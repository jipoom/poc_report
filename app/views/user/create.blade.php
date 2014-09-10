@extends("layout")
@section("content")
{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Create a new user</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    
 	{{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Username'))}} <p></p>
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }} <p></p>
    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }} <p></p>
	ตำแหน่ง: {{ Form::select('location', $locations) }} <p></p>
	
    {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop