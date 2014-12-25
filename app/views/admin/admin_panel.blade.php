@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")
{{ Form::open(array('url'=>'report/admin', 'class'=>'form-signup', 'id'=>'infoForm')) }}
<h4>แก้ไขข้อมูล</h4>
วันที่ทำการจู่โจม: <input type="text" id="found_date" name="date" readonly="true"value="{{Input::old('date',(isset($date))? $date : date('d-m').'-'.$buddhistYear)}}"> 
<br /><br />
ระบุเขต: {{ Form::select('khet_id', Khet::getArrayNotAll(),Input::old('khet_id',(isset($khetId))? $khetId : 0),array('id'=>'khet_id')) }}
<br /><br />
<div id='location'>
</div>
<br />
{{ Form::submit() }}
{{ Form::close() }}

@if(isset($isUserRequest))
	@if($isUserRequest)
		{{ Form::open(array('url'=>'report/admin/add', 'class'=>'form-signup', 'id'=>'updateReportForm')) }}
		<input type="hidden" name="date" value="{{Input::old('date',(isset($date))? $date : date('d-m').'-'.$buddhistYear)}}"> 
		<input type="hidden" name="location_id" value="{{Input::old('location_id',(isset($location_id))? $location_id : 0)}}"> 
		<input type="hidden" name="khetId" value="{{Input::old('khetId',(isset($khetId))? $khetId : 0)}}"> 
		<br />
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
			<section class="container" style="width: 90%;">
	<!-- 
	<input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
	-->
	@if(isset($unconfirmInsideReport))
	@if(count($unconfirmInsideReport)>0)
	<h4 style="background-color: #efefef; text-align: center">พบภายในเรือนจำ</h4>
	
	<table class="order-table table" border="1px" bordercolor="#cfcfcf">
		<thead>
			<tr>			
				<th style="width: 36%">
					สิ่งของต้องห้าม
				</th>
				
				<th style="width: 7%">
					จำนวน 
				</th>
				<th style="width: 13%">
					ผู้ครอบครอง
				</th>	
				<th style="width: 18%">
					บริเวณที่พบ 
				</th>
				<th style="width: 14%">
					วิธีการ 
				</th>
				<th style="width: 12%">
					ต้องการลบ?
				</th>
			</tr>
			</thead>
		<tbody>
		@foreach($unconfirmInsideReport as $value)
			<tr>			
				<td>
					@if($value->item_id==Item::where('name','=','อื่นๆ')->first()->id)
						{{$value->other_item}}
					@else
						{{Item::find($value->item_id)->name}}
					@endif
				</td>	
				
				<td>
					{{$value->qty}} {{Item::find($value->item_id)->unit}}
				</td>	
				<td>
					@if($value->item_owner!='')
						{{$value->item_owner}}
					@else
						ไม่พบ
					@endif
				</td>
				<td>
					@if($value->area_id == 37 || $value->area_id == 38)
						{{$value->other_area}}
					@else
						{{Area::find($value->area_id)->name}}
					@endif
				</td>	
				<td>
					@if($value->method_id==1)
						{{Method::find($value->method_id)->name}}  
					@else
						{{Method::find($value->method_id)->name}} {{SpecialMethod::find($value->special_method_id)->name}}  
					@endif
					
				</td>			
				<td>
					{{ HTML::link(URL::to('report/admin/delete/'.$value->id.'/'.$value->found_date.'/'.$value->location_id.'/'.$value->khet_id), 'Remove')}}
				</td>
					
			</tr>
		@endforeach
		</tbody>
	</table>
	@endif
	@endif
	</section>
	<section class="container" style="width: 90%;">
	@if(isset($unconfirmOutsideReport))
	@if(count($unconfirmOutsideReport)>0)
	<h4 style="background-color: #efefef; text-align: center">สกัดกั้นก่อนเข้าเรือนจำ</h4>
	<table class="order-table table" border="1px" bordercolor="#cfcfcf">
		<thead>
		<tr>			
				<th style="width: 36%">
					สิ่งของต้องห้าม
				</th>
				
				<th style="width: 7%">
					จำนวน 
				</th>
				<th style="width: 13%">
					ผู้ครอบครอง
				</th>	
				<th style="width: 18%">
					บริเวณที่พบ 
				</th>
				<th style="width: 14%">
					วิธีการ 
				</th>
				<th style="width: 12%">
					ต้องการลบ?
				</th>
				
			</tr>
			</thead>
		<tbody>
		@foreach($unconfirmOutsideReport as $value)
			<tr>			
				<td>
					@if($value->item_id==Item::where('name','=','อื่นๆ')->first()->id)
						{{$value->other_item}}
					@else
						{{Item::find($value->item_id)->name}}
					@endif
				</td>
				<td>
					{{$value->qty}} {{Item::find($value->item_id)->unit}}
				</td>
				<td>
					@if($value->item_owner!='')
						{{$value->item_owner}}
					@else
						ไม่พบ
					@endif
						
				</td>
				
				<td>
					@if($value->area_id == 37 || $value->area_id == 38)
						{{$value->other_area}}
					@else
						{{Area::find($value->area_id)->name}}
					@endif
					
				</td>
				<td>
					@if($value->method_id==1)
						{{Method::find($value->method_id)->name}}  
					@else
						{{Method::find($value->method_id)->name}} {{SpecialMethod::find($value->special_method_id)->name}}  
					@endif
				</td>
				<td>
					{{ HTML::link(URL::to('report/admin/delete/'.$value->id.'/'.$value->found_date.'/'.$value->location_id.'/'.$value->khet_id), 'Remove')}}
				</td>
				
			</tr>
		@endforeach
		</tbody>
	</table>
	@endif
	@endif
	</section>
	@if(isset($unconfirmNotfound))
		@if(count($unconfirmNotfound)>0)
		<h4 style="background-color: #efefef; text-align: center">ไม่พบ</h4>
		<table class="order-table table" border="1px" bordercolor="#cfcfcf">
			<thead>
			<tr>			
					<th style="width: 36%">
						สิ่งของต้องห้าม
					</th>
					
					<th style="width: 7%">
						จำนวน 
					</th>
					<th style="width: 13%">
						ผู้ครอบครอง
					</th>	
					<th style="width: 18%">
						บริเวณที่พบ 
					</th>
					<th style="width: 14%">
						วิธีการ 
					</th>
					<th style="width: 12%">
						ต้องการลบ?
					</th>
					
				</tr>
				</thead>
			<tbody>
			@foreach($unconfirmNotfound as $value)
				<tr>			
					<td>
						-
					</td>
					<td>
						-
					</td>
					<td>
						-
							
					</td>
					
					<td>
						-
						
					</td>
					<td>
						-
					</td>
					<td>
						{{ HTML::link(URL::to('report/admin/delete/'.$value->id.'/'.$value->found_date.'/'.$value->location_id.'/'.$value->khet_id), 'Remove')}}
					</td>
					
				</tr>
			@endforeach
			</tbody>
		</table>
		@endif
		</section>
	@endif
	@if(count($unconfirmInsideReport)+count($unconfirmOutsideReport) > 0)
    	{{ Form::open(array('url'=>'report/admin/confirm', 'class'=>'form-signup', 'id'=>'confirmForm')) }}
    	<div id="note_area1" style="width: 500px">

	    	หมายเหตุ <font size="2px"> ( กรอกข้อมูลที่จำเป็นเท่านั้น )</font> 
	    	{{ Form::textarea('note1', isset($noteContent) ? $noteContent : null, array('class'=>'form-control','id'=>'note1','rows'=> '3', 'cols' => '5', 'maxlength' =>'200' ))}} 
			<br />
			<b>Step 4: &nbsp; &nbsp; </b><input type="button" class="btn btn-success" id ="confirmButton1" onclick="confirmForm()" value="ยืนยัน"> <font color="#FF4444" size="2px">กรุณาตรวจทานความถูกต้องของข้อมูลก่อนกดยืนยัน</font>
		
		</div>
		{{form::close()}}
	@endif
	<!-- this button is showned when not_found is selected and hidden when found is selected-->
	<div id = "note_area2" style="display: none; width: 500px">
		<br />
		หมายเหตุ  <font size="2px"> ( กรอกข้อมูลที่จำเป็นเท่านั้น )</font>  
		{{ Form::textarea('note2', isset($noteContent) ? $noteContent : null, array('class'=>'form-control','id'=>'note2','rows'=> '3', 'cols' => '5', 'maxlength' =>'200' ))}} 
		<br />
		<b>Step 4: &nbsp; &nbsp; </b><input type="button" class="btn btn-success" id ="confirmButton2"  onclick="confirmForm()" value="ยืนยัน"> <font color="#FF4444" size="2px">กรุณาตรวจทานความถูกต้องของข้อมูลก่อนกดยืนยัน</font>
	
	</div>
	@endif
@endif
	

	
@stop
@section('scripts')

 		
<script>

	 $( document ).ready(function() {
	  // Handler for .ready() called.
	  	$( "#edit_btn" ).hide();
	  	$( "#khet_id" ).change(function() {
		   	loadLocation($( "#khet_id" ).val(),'{{$location_id}}');
		   	if($("#khet_id").val()!=0){
	   	    	$( "#edit_btn" ).show();
	    	}
			else{
				$( "#edit_btn" ).hide();
			}
		});
	    if($("#khet_id").val()!=0){
	   	    loadLocation($( "#khet_id" ).val(),'{{$location_id}}');   
	    }
	    
	 });
	 
	 function loadLocation(khetId,locationId){
	 	if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("location").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "{{{ URL::to('report/admin/loadLocation') }}}/"+khetId+"/"+locationId, false);
				xmlhttp.send();
	 }
	 $(function () {
			
			$("#found_date").datepicker({
			    dateFormat: 'dd-mm-yy',
			    maxDate: 0, // to disable past dates (skip if not needed)			 	
			    isBuddhist: true,
			    dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
			    dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
			    monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
			    monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']  
			});
			
			
			});
			
			

</script>






<script>
 		// Get unconfirmed data
		function getUnconfirmedData(){
			var date = $("#found_date").val();
			var locationId = $("#location_id").val();
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
					xmlhttp.open("GET", "{{{ URL::to('report/admin/unconfirmedData') }}}/" + date+"/"+locationId, false);
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
                locationId = $('#location_id').val();
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
				if(checkIfRecordExist(date,itemId,itemName,foundAt,area,areaOther,itemOwner,itemOther,methodId,specialId,locationId) == true){
					note = $('#note2').val();
	             	$('#updateReportForm').append('<input type="hidden" name="note" value="'+note+'"/>');
					document.getElementById("updateReportForm").submit();
				}
            }
            else{
				 //chage is_confirmed to 1

				 date = $('#found_date').val();
				 location_id = $('#location_id').val();
	             $('#confirmForm').append('<input type="hidden" name="date" value="'+date+'"/>');
	             $('#confirmForm').append('<input type="hidden" name="location_id" value="'+location_id+'"/>');
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
						  		//if(checkIfRecordExist(date,itemId,itemName,foundAt,area,areaOther,itemOwner,itemOther,methodId,specialId) == true){
									
									document.getElementById("updateReportForm").submit();
								//}
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
		  
		  function checkIfRecordExist(date,itemId,itemName,foundAt,area,areaOther,itemOwner,itemOther,methodId,specialId,locationId){
		     	var result = $.ajax({
		          url: "{{URL::to('report/admin/exist/')}}",
		          data : { date : date , itemId : itemId, foundAt:foundAt, area:area, itemOwner:itemOwner,itemOther:itemOther,areaOther:areaOther,methodId:methodId,specialId:specialId,locationId:locationId},
		          dataType:"text",
		          async: false
		          }).responseText;
		      	if(result=="0")
		      		
		      		return true;
		      	else
		      		return confirm("แน่ใจนะ");
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
                $("#confirmButton2").show();  
                $("#note_area2").show();
                $("#note_area1").hide();
                $("#note2").show(); 
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
                $("#confirmButton2").hide();  
                $("#note2").hide(); 
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