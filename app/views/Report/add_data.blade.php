@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

{{ Form::open(array('url'=>'report/add', 'class'=>'form-signup', 'id'=>'infoForm')) }}
<p>วิธีการจู่โจม
{{ Form::select('method', Method::getArray()) }}</p>
<p>วันที่ทำการจู่โจม: <input type="text" id="found_date" name="date" onchange="getUnconfirmedData()" readonly="true"value="{{isset($date) ? $date : date('d-m-Y')}}"> </p>
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
	
	{{ Form::open(array('url'=>'report/confirm', 'class'=>'form-signup', 'id'=>'confirmForm')) }}	
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

	<!-- ./ csrf token -->
	<div id="data">

	</div>
	{{ Form::close() }}
	<input type="button" onclick="confirmForm()" value="ยืนยัน">
	
@stop
@section('scripts')
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
 		<script>
		function getUnconfirmedData(){
			var date = $("#found_date").val();

					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("data").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "{{{ URL::to('report/unconfirmedData') }}}/" + date, true);
			xmlhttp.send();
			
		}	 
			
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
                date = $('#found_date').val();
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
                date = $('#found_date').val();
                $('#confirmForm').append('<input type="hidden" name="date" value="'+date+'"/>');
                document.getElementById("confirmForm").submit(); 
            }
		   
		  }
		  function save() {
		  		date = $('#found_date').val();
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
            getUnconfirmedData();
            
		  });
		  $(function() {
		    $("#found_date").datepicker({ dateFormat: 'dd-mm-yy',isBuddhist: true });
		  });

		  </script>
@stop