@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

{{ Form::open(array('url'=>'report/add', 'class'=>'form-signup', 'id'=>'infoForm')) }}
<p>วิธีการจู่โจม
{{ Form::select('method', Method::getArray()) }}</p>
<p>วันที่ทำการจู่โจม: <input type="text" id="found_date" name="date" readonly="true"value="{{isset($date) ? $date : date('d-M-Y')}}"> </p>
<p>{{ Form::radio('isFound', 'yes','',array('id'=>'found')) }} พบ  {{ Form::radio('isFound', 'no', '',array('id'=>'not_found')) }}  ไม่พบ</p>
<div id='showButton' style="display: none">
<input type="button" onclick="needMoreDetail()" value="เพิ่มบันทึก">
</div>
	<div id='detail' style="display: none">
	<table border="1" style="width:100%">
		<tr>
			<td>
				<p>{{ Form::radio('before', '1','',array('id'=>'before')) }} สกัดกั้นก่อนเข้าเรือนจำ  {{ Form::radio('before', '2', 'true',array('id'=>'after')) }}  พบภายในเรือนจำ</p>
				<p>สิ่งของต้องห้าม: {{ Form::select('item', Item::getAllItemArray(),null,array('id'=>'item')) }} {{Form::text('qty')}} หน่วย  
				{{$errors->first('qty', ':message')}}</p>
				<p>บริเวณที่พบ: {{Form::text('area','',array('id'=>'area'))}}  </p>
				<input type="button" onclick="save()" value="บันทึก">
			</td>
				
		</tr>
	</table>
	</div>
{{ Form::close() }}
	<div id="data">
	{{ Form::open(array('url'=>'report/confirm', 'class'=>'form-signup', 'id'=>'confirmForm')) }}	
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<input type="hidden" name="date" value="{{isset($date) ? $date : date('d-M-Y')}}" />
	<!-- ./ csrf token -->
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
					บริเวณที่พบ 
				</td>
				<td>
					วิธีการ 
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
					{{$value->area_found}}
				</td>	
				<td>
					{{Method::find($value->method_id)->name}}  
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
					บริเวณที่พบ 
				</td>
				<td>
					วิธีการ 
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
					{{$value->area_found}}
				</td>
				<td>
						{{Method::find($value->method_id)->name}}  
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
					บริเวณที่พบ 
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
					{{$value->area_found}}
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id), 'Remove')}}
				</td>
			</tr>
		@endforeach
	</table>
	@endif
	
	{{ Form::close() }}
	<input type="button" onclick="confirmForm()" value="ยืนยัน">
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
		  function confirmForm() {
		  	if($('#not_found').is(':checked')){
                //checkIfExist bofore proceeding
                date = $('#found_date').attr("value");
                itemId = 0;
                itemName = 'ไม่พบ';
                foundAt =  0;
                area = '';
                // Update DB
				if(checkIfRecordExist(date,itemId,itemName,foundAt,area) == true){
					document.getElementById("infoForm").submit();
				}
            }
            else {
            	//$("#insert").hide();
                //$("#detail").show();
                document.getElementById("confirmForm").submit(); 
            }
		   
		  }
		  function save() {
		  		date = $('#found_date').attr("value");
                itemId = $('#item').val();
                itemName =  $('#item').attr("name");
                area =  $('#area').val();
  
                if($('#before').is(':checked')){
	            	foundAt = $('#before').attr("value");
	            }
	            if($('#after').is(':checked')){
	            	foundAt = $('#after').attr("value");
	            } 
		  		//checkIfExist bofore proceeding
		  		if(checkIfRecordExist(date,itemId,itemName,foundAt,area) == true){
					document.getElementById("infoForm").submit();
				}	   
		  }
		  function checkIfRecordExist(date,itemId,itemName,foundAt){
		     	var result = $.ajax({
		          url: "{{URL::to('report/exist/')}}",
		          data : { date : date , itemId : itemId, foundAt:foundAt, area:area },
		          dataType:"text",
		          async: false
		          }).responseText;
		      	if(result=="0")
		      		return true;
		      	else
		      		return confirm("ข้อมูลได้ถูกใส่ลงในฐานข้อมูลแล้ว ท่านต้องการจะอัพเดทหรือไม่");
		  }
		  $(document).ready(function(){
            if($('#found').is(':checked')){
            	 $("#showButton").show();
            	 $("#detail").show();
            }
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