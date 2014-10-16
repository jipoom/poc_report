@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

{{ Form::open(array('url'=>'report/add', 'class'=>'form-signup', 'id'=>'infoForm')) }}
<p>วันที่ทำการจู่โจม: <input type="text" id="found_date" name="date" onchange="getUnconfirmedData()" readonly="true"value="{{Input::old('date',(isset($date))? $date : date('d-m').'-'.$buddhistYear)}}"> </p>

<p>วิธีการจู่โจม
{{ Form::select('method', Method::getArray()) }}</p>

<p>{{ Form::radio('isFound', 'yes','',array('id'=>'found')) }} พบ  {{ Form::radio('isFound', 'no', '',array('id'=>'not_found')) }}  ไม่พบ  {{{ $errors->first('isFound', ':message') }}}</p>
<div id='showButton' style="display: none">
<input type="button" onclick="needMoreDetail()" value="เพิ่มบันทึก">
</div>
	<div id='detail' style="display: none">
	<table border="1" style="width:100%">
		<tr>
			<td>
				<p>{{ Form::radio('before', '1','',array('id'=>'before')) }} สกัดกั้นก่อนเข้าเรือนจำ  {{ Form::radio('before', '2', '',array('id'=>'after')) }}  พบภายในเรือนจำ</p>
				<p>สิ่งของต้องห้าม: {{ Form::select('item', Item::getAllItemArray(),"",array('id'=>'item')) }} {{Form::text('qty','',array('id'=>'qty'))}} <label id ="unit"> เม็ด</label>  
				 {{$errors->first('qty', ':message')}}</p>
				<p>บริเวณที่พบ: {{Form::text('area','',array('id'=>'area'))}}  </p>
				<p>เจ้าของ: {{Form::text('owner','',array('id'=>'owner'))}}  </p>
				<input type="button" onclick="save()" value="บันทึก">
			</td>
				
		</tr>
	</table>
	</div>
{{ Form::close() }}
	


	
	<div id="data">

	</div>
	
	
	
@stop
@section('scripts')

 		<script>
 		// Get unconfirmed data
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
		  // bring up detail form	
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
		  // ยืนยัน
		  function confirmForm() {
		  	if($('#not_found').is(':checked')){
                //checkIfExist bofore proceeding
                date = $('#found_date').val();
                itemId = 0;
                itemName = 'ไม่พบ';
                foundAt =  0;
                area = '';
                itemOwner = '';
                // Update DB
				if(checkIfRecordExist(date,itemId,itemName,foundAt,area,itemOwner) == true){
					document.getElementById("infoForm").submit();
				}
            }
            else{
				 //chage is_confirmed to 1

				 date = $('#found_date').val();
	             $('#confirmForm').append('<input type="hidden" name="date" value="'+date+'"/>');
	             document.getElementById("confirmForm").submit();  
            }
		   
		  }
		  //บันทึกแต่ยังไม่ ยืนยัน
		  function save() {
		  		date = $('#found_date').val();
                itemId = $('#item').val();
                itemName =  $('#item').attr("name");
                area =  $('#area').val();
                itemOwner = $('#owner').val();
                
  			 	// Check if user has selected foundAt
                if($('#before').is(':checked')){
	            	isPassed = true;
	            	foundAt = $('#before').attr("value");
	            }
	            else if($('#after').is(':checked')){
	            	isPassed = true;
	            	foundAt = $('#after').attr("value");
	            }
	            else{
	            	isPassed = false;
				 	alert('กรุณาเลือก สถานที่พบเจอสิ่งของต้องห้าม')
				} 
		  		//if above conditions hold
		  		if(isPassed == true)
		  		{
			  		if(testQty() == true)
			  		{
				  		//check if a record exists bofore proceeding
				  		
				  		if(checkIfRecordExist(date,itemId,itemName,foundAt,area,itemOwner) == true){
							document.getElementById("infoForm").submit();
						}
					}
					else
					{
						alert('กรุณากรอกปริมาณสิ่งของต้องห้ามให้ถูกต้อง')
					}
				}  
		  }
		  // Validate qty value
		  function testQty(){
		  	var str = $('#qty').val();;
			var patt = /^(([0-9]+[.][0-9]+)|[0-9]+)$/;
			return patt.test(str);
		  }
		  function checkIfRecordExist(date,itemId,itemName,foundAt,area,itemOwner){
		     	var result = $.ajax({
		          url: "{{URL::to('report/exist/')}}",
		          data : { date : date , itemId : itemId, foundAt:foundAt, area:area, itemOwner:itemOwner},
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
            
            // Default confirm(notfound) hide
			$("#confirmButton2").hide();   		
			
			   
            //กดไม่พบ
            $('#not_found').click(function(){
            if($('#not_found').attr("value")=="no"){
                $("#confirmButton2").show();
                $("#confirmButton1").hide();
                $("#showButton").hide();
                $("#detail").hide();
            }
            });
            //กดพบ
            $('#found').click(function(){
            if($('#found').attr("value")=="yes"){
               // $("#insert").show();
                $("#confirmButton2").hide(); 
                $("#confirmButton1").show();  
                $("#showButton").show();
                //$("#detail").show();
            }
            });
            getUnconfirmedData();
            
		  });
		  // If users select a prohibited item then display the right unit
		  $(function(){
			   $('#item').change(function(e) {
			   		var itemId = $("#item").val();

					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("unit").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "{{{ URL::to('report/getunit') }}}/" + itemId, true);
			xmlhttp.send();
			
			
			   });
			   
			});
				
		  /*$(function() {
		    $("#found_date").datepicker({ dateFormat: 'dd-mm-yy',isBuddhist: true });
		  });*/
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/'
        + (d.getMonth() + 1) + '/'
        + (d.getFullYear() + 543);

				// Datepicker
		    $("#found_date").datepicker({ dateFormat: 'dd-mm-yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});

		  </script>
@stop