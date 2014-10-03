@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")
{{ Form::open(array('url'=>'report/create', 'class'=>'form-signup')) }}
    <h4 class="form-signup-heading">เพิ่มรายงาน{{$location}}</h2>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <p>วันที่ทำการจู่โจมตรวจค้น: {{ Form::text('found_date',"", array('id'=>'found_date'))}} </p>
    <p>{{ Form::radio('isFound', 'yes') }} พบ  {{ Form::radio('isFound', 'no') }}  ไม่พบ</p>
    
    <table border="1" style="width:100%">
	  <tr>
	    <th class="col-md-4">สกัดกั้นก่อนเข้าเรือนจำ</th>
	    <th class="col-md-4">พบภายในเรือนจำ</th> 
	  </tr>
	  <tr>
	    <td class="col-md-4"> <?php 
        	 $i=0; 
        	 ?>
			 @foreach(Item::all() as $temp)
				{{ Form::checkbox('check_outside[]', $temp->id, null, array('class'=>'input-block-level'))}}
				{{ $temp->name}}
				{{ Form::text('item_outside[]', null, array('class'=>'input-block-level pull-right', 'placeholder'=>$temp->unit))}} <p></p>
				<P>	 
				<?php $i++;?>
			@endforeach </td>
	    <td class="col-md-4">
	    	<?php 
	    	$i=0; 
        	 ?>
			 @foreach(Item::all() as $temp)
				{{ Form::checkbox('check_inside[]', $temp->id, null, array('class'=>'input-block-level'))}}
				{{ $temp->name}}
				{{ Form::text('item_inside[]', null, array('class'=>'input-block-level pull-right', 'placeholder'=>$temp->unit))}} <p></p>
				<P>	 
				<?php $i++;?>
			@endforeach </td>
	    </td> 
	  </tr>
	</table>
	<p></p>
 	{{ Form::textarea('note', null, array('class'=>'form-control', 'placeholder'=>'หมายเหตุ'))}} <p></p>


    {{ Form::submit('Submit', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
@stop
@section('scripts')
 		 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
 		<script>
		  $(function() {
		    $("#found_date").datepicker({ dateFormat: 'dd-M-yy' });
		  });
		  </script>
@stop
