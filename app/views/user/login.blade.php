@extends("layout")
@section("content")
{{ Form::open(array('url'=>'user/login', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Login</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    
 	{{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Username'))}} <p></p>
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }} <p></p>
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop