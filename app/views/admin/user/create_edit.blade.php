@extends("modal_layout")

{{-- Content --}}
@section('content')
	
	<!--<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	</ul>-->
	{{-- Edit Category Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($khetId)){{ URL::to('report/admin/user/' . $khetId . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

	
	
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('user') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="category">username</label>
						@if(isset($userId))
							{{ Form::text('username',Input::old('user', User::find($userId)->username) , array('class'=>'form-control', 'placeholder'=>'username','readonly'=>'true'))}} </p>
							{{{ $errors->first('khet', ':message') }}}
						@else
							{{ Form::text('username',Input::old('user', null) , array('class'=>'form-control', 'placeholder'=>'username'))}} </p>
							{{{ $errors->first('khet', ':message') }}}
						@endif
						
						<label class="control-label" for="category">password</label>
						<input class="form-control" placeholder="รหัสผ่าน" type="password" name="password" id="password"></p>
						{{{ $errors->first('password', ':message') }}}
						
						<label class="control-label" for="category">ยืนยัน password</label>
						<input class="form-control" placeholder="ยืนยันรหัสผ่าน" type="password" name="password_confirm" id="password_confirm"> </p>
						{{{ $errors->first('password_confirm', ':message') }}}
						
						<label class="control-label" for="category">Comment</label>
						@if(isset($userId))
							{{ Form::text('comment', Input::old('user', User::find($userId)->comment) , array('class'=>'form-control', 'placeholder'=>'Comment','readonly'=>'true'))}} </p>
							{{{ $errors->first('comment', ':message') }}}
						@else
							{{ Form::text('comment', Input::old('user', null)  , array('class'=>'form-control', 'placeholder'=>'Comment'))}} </p>
							{{{ $errors->first('comment', ':message') }}}
						@endif
						
						  
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
