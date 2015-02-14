@extends("modal_layout")

{{-- Content --}}
@section('content')
	
	<!--<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	</ul>-->
	{{-- Edit Category Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($khetId)){{ URL::to('report/admin/khet/' . $khetId . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

	
	
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('khet') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="category">ชื่อย่อเรือนจำ</label><font color="red">&nbsp;&nbsp;{{{ $errors->first('location_name', ':message') }}}</font>
						{{ Form::text('location_name',Input::old('location_name', isset($locationId) ? Location::find($locationId)->name : null) , array('class'=>'form-control', 'placeholder'=>'ชื่อย่อเรือนจำ'))}} </p>
						
						
						<label class="control-label" for="category">ชื่อเต็มเรือนจำ</label><font color="red">&nbsp;&nbsp;{{{ $errors->first('location_fullname', ':message') }}}</font>
						{{ Form::text('location_fullname',Input::old('location_fullname', isset($locationId) ? Location::find($locationId)->fullname : null) , array('class'=>'form-control', 'placeholder'=>'ชื่อเต็มเรือนจำ'))}} </p>
						
						
						<label class="control-label" for="category">ระบุเขต</label>
						{{ Form::select('khet_id', Khet::getArrayNotAll(),Input::old('khet_id',(isset($locationId))? Location::find($locationId)->khet_id : 0),array('id'=>'khet_id')) }} <font color="red">&nbsp;&nbsp;{{{ $errors->first('khet_id', ':message') }}}</font></p>
						
						
						<label class="control-label" for="category">username</label><font color="red">&nbsp;&nbsp;{{{ $errors->first('username', ':message') }}}</font>
						@if(isset($locationId))
							{{ Form::text('username',Input::old('username', User::where('location_id','=',$locationId)->first()->username) , array('class'=>'form-control', 'placeholder'=>'ชื่อเต็มเรือนจำ','readonly'=>'true'))}} </p>
							
						@else
							{{ Form::text('username',Input::old('username', null) , array('class'=>'form-control', 'placeholder'=>'ชื่อเต็มเรือนจำ'))}} </p>
							
						@endif
						<label class="control-label" for="category">รหัสผ่าน</label><font color="red">&nbsp;&nbsp;{{{ $errors->first('password', ':message') }}}</font>
						<input class="form-control" placeholder="รหัสผ่าน" type="password" name="password" id="password"></p>
						
						
						<label class="control-label" for="category">ยืนยันรหัสผ่าน</label><font color="red">&nbsp;&nbsp;@if ($message = Session::get('password'))
 @if(is_array($message))
    @foreach ($message as $m)
    	<font color="red"> *{{ $m }}</font>
    @endforeach
 @else
    <font color="red"> *{{ $message }}</font>
 @endif
@endif</font>
						<input class="form-control" placeholder="ยืนยันรหัสผ่าน" type="password" name="password_confirm" id="password_confirm"> </p>
						
												  
					</div>
				</div>
				<!-- ./ post title -->

			</div>
			<!-- ./ general tab -->

			

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success submit">Update</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
