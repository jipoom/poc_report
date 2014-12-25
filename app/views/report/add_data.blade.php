@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

{{ Form::open(array('url'=>'report/add', 'class'=>'form-signup', 'id'=>'infoForm')) }}

<br />
<b>Step 1: &nbsp; &nbsp; </b>วันที่ทำการจู่โจม: <input type="text" id="found_date" name="date" onchange="getUnconfirmedData()" readonly="true"value="{{Input::old('date',(isset($date))? $date : date('d-m').'-'.$buddhistYear)}}"> 
<br /><br />
<b>Step 2: &nbsp; &nbsp; </b>วิธีการจู่โจม {{ Form::select('method', Method::getArray(),"", array('id' => 'method')) }}{{ Form::select('special_method', SpecialMethod::all()->lists('name','id'),"",array('id'=>'special_method','style'=>'display: none')) }}
<br /><br />
<b>Step 3: &nbsp; &nbsp; </b>{{ Form::radio('isFound', 'yes','',array('id'=>'found')) }} พบสิ่งของต้องห้าม  &nbsp; &nbsp; {{ Form::radio('isFound', 'no', '',array('id'=>'not_found')) }}  ไม่พบสิ่งของต้องห้าม  {{{ $errors->first('isFound', ':message') }}}
<br />

	<div id='detail' style="display: none">
	<table border="1" style="width:100%">
		<tr>
			<td style="padding: 20px">
				<p>{{ Form::radio('before', '1','',array('id'=>'before')) }} สกัดกั้นก่อนเข้าเรือนจำ  {{ Form::radio('before', '2', '',array('id'=>'after')) }}  พบภายในเรือนจำ</p>
				<p><div id='area_found'>
				</div>
				{{Form::text('other_area','',array('id'=>'other_area','placeholder'=>'โปรดระบุ', 'style'=>'display: none','maxlength' =>'50'))}}</p>
				<p>สิ่งของต้องห้าม: {{ Form::select('item', Item::getAllItemArray(),"",array('id'=>'item','style' => 'width:200px')) }} {{Form::text('other','',array('id'=>'other','placeholder'=>'โปรดระบุ', 'style'=>'display: none','maxlength' =>'50'))}}{{Form::text('qty','',array('id'=>'qty','placeholder'=>'จำนวน'))}} <label id ="unit"> เม็ด</label>  
				 {{$errors->first('qty', ':message')}}</p>
				
				<p>{{ Form::radio('hasOwner', 'no', '',array('id'=>'noOwner')) }} ไม่พบผู้ครอบครอง  {{ Form::radio('hasOwner', 'yes','',array('id'=>'hasOwner')) }} พบผู้ครอบครอง          
				
				<div id='owner_area' style="display: none">
					ชื่อผู้ครอบครอง: {{Form::text('owner','',array('id'=>'owner','maxlength' =>'50'))}}  
				</div>
				</p>
				<input type="button" class="btn btn-primary" onclick="save()" value="เพิ่มรายการ">
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
		function getData(){
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
                itemOther = '';
                areaOther = '';
                specialId = '';
                methodId = '';
                // Update DB
				if(checkIfRecordExist(date,itemId,itemName,foundAt,area,areaOther,itemOwner,itemOther,methodId,specialId) == true){
					note = $('#note2').val();
	             	$('#infoForm').append('<input type="hidden" name="note" value="'+note+'"/>');
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
                itemOther = $('#other').val();
                areaOther = $('#other_area').val();
                methodId = $('#method').val();
                specialId = $('#special_method').val();
  			 	// Check if user has selected foundAt
                if($('#before').is(':checked')){
	            	isPassed1 = true;
	            	foundAt = $('#before').attr("value");
	            }
	            else if($('#after').is(':checked')){
	            	isPassed1 = true;
	            	foundAt = $('#after').attr("value");
	            }
	            else{
	            	isPassed1 = false;
				 	alert('กรุณาเลือก สถานที่พบเจอสิ่งของต้องห้าม')
				}
				if($('#hasOwner').is(':checked')){
	            	isPassed2 = true;
	            } 
	            else if($('#noOwner').is(':checked')){
	            	isPassed2 = true;
	            }
	            else {
	            	isPassed2 = false;
	            	alert('กรุณาเลือกว่าสิ่งของต้องห้ามมีผู้ครอบครองหรือไม่')
	            }
		  		//if above conditions hold
		  		if(isPassed1 == true && isPassed2 == true)
		  		{
			  		if(testQty() == true)
			  		{
				  		//check if a record exists bofore proceeding
				  		if(testOther() == true){
					  		if(testOtherArea()==true)
					  		{
						  		if(checkIfRecordExist(date,itemId,itemName,foundAt,area,areaOther,itemOwner,itemOther,methodId,specialId) == true){
									
									document.getElementById("infoForm").submit();
								}
							}
							else
							{
								alert('กรุณากรอกบริเวณที่พบสิ่งของต้องห้ามให้ถูกต้อง')
							}
						}
						else
						{
							alert('กรุณากรอกชนิดสิ่งของต้องห้ามให้ถูกต้อง')
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
		  function testOther(){
		  	var str = $('#other').val();;
			var patt = /^[a-zA-Zก-๙]*$/;
			return patt.test(str);
		  }
		   function testOtherArea(){
		  	var str = $('#other_area').val();;
			var patt = /^[a-zA-Zก-๙]*$/;
			return patt.test(str);
		  }
		  
		  function checkIfRecordExist(date,itemId,itemName,foundAt,area,areaOther,itemOwner,itemOther,methodId,specialId){
		     	var result = $.ajax({
		          url: "{{URL::to('report/exist/')}}",
		          data : { date : date , itemId : itemId, foundAt:foundAt, area:area, itemOwner:itemOwner,itemOther:itemOther,areaOther:areaOther,methodId:methodId,specialId:specialId},
		          dataType:"text",
		          async: false
		          }).responseText;
		      	if(result=="0")
		      		return true;
		      	else
		      		return alert("ไม่สามารถกรอกข้อมูลได้ เนื่องจากข้อมูลได้ถูกบันทึกเรียบร้อยแล้ว");
		  }
		  
		  
		  
		  $(document).ready(function(){
            
            if($('#found').is(':checked')){
            	 //$("#showButton").show();
            	 $("#detail").show();
            }
            
            function loadAreaOptions(found_at_id){
					
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("area_found").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "{{{ URL::to('report/area_option') }}}/"+found_at_id, true);
				xmlhttp.send();
            }
            
            // Default confirm(notfound) hide
			$("#confirmButton2").hide();   		
			$("#note2").hide();   		
			   
            //กดไม่พบ
            $('#not_found').click(function(){
            if($('#not_found').attr("value")=="no"){
                //$("#confirmButton2").show();
                
                $("#note_area2").show();
                $("#note_area1").hide();
                //$("#note1").hide();   
                //$("#confirmButton1").hide();
               // $("#showButton").hide();
                $("#detail").hide();
            }
            });
            //กดพบ
            $('#found').click(function(){
            if($('#found').attr("value")=="yes"){
               // $("#insert").show();
               // $("#note1").show();  
               // $("#confirmButton2").hide(); 
               // $("#confirmButton1").show(); 
                $("#insert").hide();
                $("#detail").show(); 
                $("#note_area2").hide();
                $("#note_area1").show();
               // $("#showButton").show();
                //$("#detail").show();
            }
            });
            
             //กดไม่พบ
            $('#hasOwner').click(function(){
            if($('#hasOwner').attr("value")=="yes"){
                $("#owner").val('');
                $("#owner_area").show();
            }
            });
            //กดพบ
            $('#noOwner').click(function(){
            if($('#noOwner').attr("value")=="no"){
               // $("#insert").show();
                $("#owner_area").hide(); 

                //$("#detail").show();
            }
            });
            
            $('#before').click(function(){
            if($('#before').attr("value")=="1"){
                //load preentering options
                $("#other_area").hide(); 
                loadAreaOptions(1);    
            }
            });
            //กดพบ
            $('#after').click(function(){
            if($('#after').attr("value")=="2"){
                //load postentering options
                $("#other_area").hide(); 
                loadAreaOptions(2);
            }
            });
            
            getData();
            
		  });
		  
		  function checkItemOther(itemId){
		  	var result = $.ajax({
		          url: "{{URL::to('report/item/need_other')}}",
		          data : { itemId : itemId},
		          dataType:"text",
		          async: false
		          }).responseText;
		      	if(result=="1")
		      	{
		      		$("#other").val('');
					$("#other").show(); 
				}
				else
		      		$("#other").hide();
		      		// enable textbox
		      	
		  }
		  
		   $(function(){
			   $('#method').change(function(e) {
			   
			   	 var methodId = $("#method").val();
				 				
				 var result = $.ajax({
		          url: "{{URL::to('report/method/')}}"+"/"+methodId,
		          dataType:"text",
		          async: false
		          }).responseText;
		      	if(result=="0")
		      	{
		      		$('#special_method').hide();
		      	}
		      	else
		      		$('#special_method').show();
			
			
			   });
			   
			});
		  
		   function checkAreaOther(areaId){
		  	var result = $.ajax({
		          url: "{{URL::to('report/area/need_other')}}",
		          data : { areaId : areaId},
		          dataType:"text",
		          async: false
		          }).responseText;
		      	if(result=="1")
		      	{
					$("#other_area").val('');
					$("#other_area").show(); 
				}
				else
		      		$("#other_area").hide();
		      		// enable textbox
		      	
		  }
		  
		  // If users select a prohibited item then display the right unit
		  $(function(){
			   $('#item').change(function(e) {
			   		var itemId = $("#item").val();
					checkItemOther(itemId);

					
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
		    $("#found_date").datepicker({ dateFormat: 'dd-mm-yy', isBuddhist: true, maxDate:0, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			 
			});

		  </script>
@stop