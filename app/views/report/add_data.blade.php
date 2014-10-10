@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")
{{ Form::open(array('url'=>'report/add', 'class'=>'form-signup', 'id'=>'infoForm')) }}
<p>วิธีการจู่โจม
{{ Form::select('method', ['1', '2', '3']) }}</p>
<p>วันที่ทำการจู่โจม: <input type="text" id="found_date" name="date" readonly="true"value="{{isset($date) ? $date : date('d-M-Y')}}"> </p>
<p>{{ Form::radio('isFound', 'yes','',array('id'=>'found')) }} พบ  {{ Form::radio('isFound', 'no', 'true',array('id'=>'not_found')) }}  ไม่พบ</p>
<div id='showButton' style="display: none">
<input type="button" onclick="needMoreDetail()" value="เพิ่มบันทึก">
</div>
	<div id='detail' style="display: none">
	<table border="1" style="width:100%">
		<tr>
			<td>
				<p>{{ Form::radio('before', 'yes') }} สกัดกั้นก่อนเข้าเรือนจำ  {{ Form::radio('before', 'no', 'true') }}  พบภายในเรือนจำ</p>
				<p>สิ่งของต้องห้าม: {{ Form::select('item', Item::getAllItemArray()) }} {{Form::text('qty')}} หน่วย </p>
				<p>บริเวณที่พบ: {{Form::text('area')}}  </p>
				<input type="button" onclick="save()" value="บันทึก">
			</td>
				
		</tr>
	</table>
	</div>
{{ Form::close() }}
	<div id="data">
	{{ Form::open(array('url'=>'report/confirm', 'class'=>'form-signup', 'id'=>'confirmForm')) }}	
	@if(count($unconfirmInsideReport)>0)
	พบภายในเรือนจำ
	<table border="1" style="width:100%">
		<tr>			
				<td>
					สิ่งของต้องห้าม
				</td>
				<td>
					วันที่
				</td>
				<td>
					จำนวน 
				</td>
				<td>
					Action 
				</td>		
			</tr>
		@foreach($unconfirmInsideReport as $value)
			<tr>			
				<td>
					{{Item::find($value->item_id)->name}}
				</td>	
				<td>
					{{$value->found_date}}
				</td>
				<td>
					{{$value->qty}} {{Item::find($value->item_id)->unit}}
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id), 'Remove')}}
				</td>
					
			</tr>
		@endforeach
	</table>
	@endif
	
	@if(count($unconfirmOutsideReport)>0)
	สกัดกั้นก่อนเข้าเรือนจำ
	<table border="1" style="width:100%">
		<tr>			
				<td>
					สิ่งของต้องห้าม
				</td>
				<td>
					วันที่
				</td>
				<td>
					จำนวน 
				</td>	
				<td>
					Action 
				</td>
				
			</tr>
		@foreach($unconfirmOutsideReport as $value)
			<tr>			
				<td>
					{{Item::find($value->item_id)->name}}
				</td>
				<td>
					{{$value->found_date}}
				</td>
				<td>
					{{$value->qty}} {{Item::find($value->item_id)->unit}}
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id), 'Remove')}}
				</td>
				
			</tr>
		@endforeach
	</table>
	@endif
	@if(count($unconfirmNotfound)>0)
	ไม่พบ
	<table border="1" style="width:100%">
		<tr>			
				<td>
					สิ่งของต้องห้าม
				</td>
				<td>
					วันที่
				</td>
				<td>
					จำนวน 
				</td>	
				<td>
					Action 
				</td>
			</tr>
		@foreach($unconfirmNotfound as $value)
			<tr>			
				<td>
					{{Item::find($value->item_id)->name}}
				</td>
				<td>
					{{$value->found_date}}
				</td>	
				<td>
					{{$value->qty}} {{Item::find($value->item_id)->unit}}
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id), 'Remove')}}
				</td>
			</tr>
		@endforeach
	</table>
	@endif
	
	{{ Form::close() }}
	<input type="button" onclick="save()" value="ยืนยัน">
	</div>
@stop
@section('scripts')
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
 		<script>
		  function needMoreDetail() {
		    if($('#found').is(':checked')){
            	$("#insert").hide();
                $("#detail").show();
            }
            else if($('#not_found').is(':checked')){
                //add to array process ajx
                $("#detail").hide();
                document.getElementById("infoForm").submit();
            }
		    
		  }
		  function save() {
		   	document.getElementById("infoForm").submit(); 
		  }
		  $(document).ready(function(){
            $('#not_found').click(function(){
            if($('#not_found').attr("value")=="no"){
                //$("#insert").show();
                $("#showButton").hide();
                $("#detail").hide();
            }
            });
            
            $('#found').click(function(){
            if($('#found').attr("value")=="yes"){
               // $("#insert").show();
                $("#showButton").show();
                //$("#detail").show();
            }
            });
            
            
		  });
		  $(function() {
		    $("#found_date").datepicker({ dateFormat: 'dd-M-yy' });
		  });

		  </script>
@stop