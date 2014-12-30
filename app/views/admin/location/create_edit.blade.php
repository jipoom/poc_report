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
                        <label class="control-label" for="category">ชื่อย่อเรือนจำ</label>
						{{ Form::text('location_name',Input::old('location_name', isset($locationId) ? Location::find($locationId)->name : null) , array('class'=>'form-control', 'placeholder'=>'ชื่อย่อเรือนจำ'))}} </p>
						{{{ $errors->first('location_name', ':message') }}}
						
						<label class="control-label" for="category">ชื่อเต็มเรือนจำ</label>
						{{ Form::text('location_fullname',Input::old('location_fullname', isset($locationId) ? Location::find($locationId)->fullname : null) , array('class'=>'form-control', 'placeholder'=>'ชื่อเต็มเรือนจำ'))}} </p>
						{{{ $errors->first('location_fullname', ':message') }}}
						
						<label class="control-label" for="category">ระบุเขต</label>
						{{ Form::select('khet_id', Khet::getArrayNotAll(),Input::old('khet_id',(isset($locationId))? Location::find($locationId)->khet_id : 0),array('id'=>'khet_id')) }} </p>
						{{{ $errors->first('khet_id', ':message') }}}
						
						<label class="control-label" for="category">username</label>
						@if(isset($locationId))
							{{ Form::text('username',Input::old('username', User::where('location_id','=',$locationId)->first()->username) , array('class'=>'form-control', 'placeholder'=>'ชื่อเต็มเรือนจำ','readonly'=>'true'))}} </p>
							{{{ $errors->first('username', ':message') }}}
						@else
							{{ Form::text('username',Input::old('username', null) , array('class'=>'form-control', 'placeholder'=>'ชื่อเต็มเรือนจำ'))}} </p>
							{{{ $errors->first('username', ':message') }}}
						@endif
						<label class="control-label" for="category">password</label>
						<input class="form-control" placeholder="รหัสผ่าน" type="password" name="password" id="password"></p>
						{{{ $errors->first('password', ':message') }}}
						
						<label class="control-label" for="category">ยืนยัน password</label>
						<input class="form-control" placeholder="ยืนยันรหัสผ่าน" type="password" name="password_confirm" id="password_confirm"> </p>
						{{{ $errors->first('password_confirm', ':message') }}}
												  
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
