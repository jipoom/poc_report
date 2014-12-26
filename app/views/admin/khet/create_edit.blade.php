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
                        <label class="control-label" for="category">ชื่อเขต</label>
						{{ Form::text('khet',Input::old('khet', isset($khetId) ? Khet::find($khetId)->name : null) , array('class'=>'form-control', 'placeholder'=>'ชื่อเขต'))}} </p>
						{{{ $errors->first('khet', ':message') }}}
						  
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
