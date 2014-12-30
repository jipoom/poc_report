<?php 
			$inspectNotDistinct = $inspect->get(array('location_id','khet_id'));
			$otherNotDistinct = $other->get(array('location_id','khet_id'));
			$drugAndItemNotDistinct = $drugAndItem->get(array('location_id','khet_id'));
			$notFoundNotDistinct  = $notFound->get(array('location_id','khet_id'));
			$inspect = $inspect->distinct()->get(array('location_id','khet_id'));
			$other = $other->distinct()->get(array('location_id','khet_id'));
			$drugAndItem = $drugAndItem->distinct()->get(array('location_id','khet_id'));
			$notFound = $notFound->distinct()->get(array('location_id','khet_id'));
			
?>
@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

@stop
@section("content")
{{ Form::open(array('url'=>'report/dashboard', 'class'=>'form-signup', 'id'=>'infoForm')) }}
<p>
ตั้งแต่: <input type="text" id="startDate" name="startDate" readonly="true"value="{{Input::old('startDate',(isset($startDate))? $startDate : date('d-m').'-'.$buddhistYear)}}"> 	
ถึง: <input type="text" id="endDate" name="endDate" readonly="true"value="{{Input::old('endDate',(isset($endDate))? $endDate : date('d-m').'-'.$buddhistYear)}}"> 	
{{ Form::submit('ดูสถิติ') }}
</p>

{{ Form::close() }}
<h3 align="center">สรุปรายงานการจู่โจมตรวจค้นประจำวันที่  {{$startDate}} ถึง {{$endDate}}</h3>
<table cellpadding="10" style="position: absolute; margin: 15px 0 0 45px; font-size: 13.5px;">
	<tr>
		<th><img src="{{asset('assets/images/po.png')}}" width="60px" style="position: relative;"></th>
		<th> มีการจู่โจมตรวจค้นทั้งสิ้น&nbsp;</th>
		<th> {{count($inspectNotDistinct)}}</th>
		<th> &nbsp;ครั้ง  จำนวน &nbsp;</th>
		<th> {{count($inspect)}}</th>
		<th> &nbsp;เรือนจำ</th>
	</tr>
	<tr>
		<td><img src="{{asset('assets/images/cr5.png')}}" width="60px" style="position: relative;"></td>
		<th> ตรวจค้นเเล้วไม่พบ&nbsp;</th>
		<th> {{count($notFoundNotDistinct)}}</th>
		<th> &nbsp;ครั้ง  จำนวน &nbsp;</th>
		<th> {{count($notFound)}}</th>
		<th> &nbsp;เรือนจำ</th>
	</tr>
	<tr>
		<td><img src="{{asset('assets/images/cr3.png')}}" width="60px" style="position: relative;"></td>
		<th> พบสารเสพติด/มือถือ/ซิมการ์ด  &nbsp;</th>
		<th> {{count($drugAndItemNotDistinct)}}</th>
		<th> &nbsp;ครั้ง  จำนวน &nbsp;</th>
		<th> {{count($drugAndItem)}}</th>
		<th> &nbsp;เรือนจำ</th>
	</tr>
	<tr>
		<td><img src="{{asset('assets/images/cr4.png')}}" width="60px" style="position: relative;"></td>
		<th> พบสิ่งต้องห้ามอื่นๆ&nbsp;</th>
		<th> {{count($otherNotDistinct)}}</th>
		<th> &nbsp;ครั้ง  จำนวน &nbsp;</th>
		<th> {{count($other)}}</th>
		<th> &nbsp;เรือนจำ</th>
	</tr>
	
</table>
<div id="all2" style="float: right; height: 300px; width: 450px; padding: 0"></div>

<div id="all" style=""></div>
<br />
<table frame="box" style="margin: 0px auto; border-width: 1px; border-coler:gray; font-size: 13px;">
		<tr>
		<th><div id="c10" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t10" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 10)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div>
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 10)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 10)
					<?php $check = true;?>	
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c1" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t1" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 1)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div>
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 1)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 1)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>

	</tr>

	<tr>
		<th><div id="c2" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t2" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 2)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div>
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 2)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 2)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c3" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t3" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?> 
			@foreach($notFound as $t)
				@if($t->khet_id == 3)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div> 
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 3)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 3)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c4" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t4" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 4)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div> 
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 4)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 4)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c5" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t5" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div>  
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 5)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div>
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 5)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 5)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c6" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t6" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div>  
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 6)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div>
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 6)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 6)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c7" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t7" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 7)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div> 
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 7)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 7)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c8" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t8" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 8)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div>
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 8)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div> 
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 8)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
	<tr>
		<th><div id="c9" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t9" style="width: 600px; right: 0px">
			<div style="font-size: 14px; color: #44ff44;"><u>ตรวจค้นแล้ว ไม่พบ :</u></div> 
			<?php $check = false;?>
			@foreach($notFound as $t)
				@if($t->khet_id == 9)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #111111"><u>พบสารเสพติด/มือถือ/ซิมการ์ด: </u></div> 
			<?php $check = false;?>
			@foreach($drugAndItem as $t)
				@if($t->khet_id == 9)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
			<br>
			<div style="font-size: 14px; color: #434fff;"><u>พบสิ่งของต้องห้ามอื่นๆ: </u></div>
			<?php $check = false;?>
			@foreach($other as $t)
				@if($t->khet_id == 9)
					<?php $check = true;?>
					{{Location::find($t->location_id)->name}},
				@endif
			@endforeach
			@if(!$check)
				-
			@endif
		</div></th>
	</tr>
</table>
@section('scripts')
<script src="{{asset('assets/js/highcharts.js')}}"></script>
<script src="{{asset('assets/js/modules/exporting.js')}}"></script>
<script type="text/javascript">
 $(function () {
			$("#startDate").datepicker({
			    dateFormat: 'dd-mm-yy',
			    maxDate: 0, // to disable past dates (skip if not needed)			 	
			    isBuddhist: true,
			    dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
			    dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
			    monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
			    monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
			    onClose: function(selectedDate) {
			        // Set the minDate of 'to' as the selectedDate of 'from'
			       // alert(new Date('01-02-10'));
			      $("#endDate").datepicker("option", "maxDate", 0);
			      $("#endDate").datepicker("option", "minDate", selectedDate);
			      $("#endDate").datepicker("option", "isBuddhist", true);
			      $("#endDate").datepicker("option", "dateFormat", 'dd-mm-yy');
			      $("#endDate").datepicker("option", "dayNames", ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์']);
			      $("#endDate").datepicker("option", "dayNamesMin", ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.']);
			      $("#endDate").datepicker("option", "monthNames", ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม']);
			      $("#endDate").datepicker("option", "monthNamesShort", ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']);
			    			    			      
			    }
			});
			
			$("#endDate").datepicker({ dateFormat: 'dd-mm-yy', isBuddhist: true, maxDate:0, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              	dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
             	 monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
             	 monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			});


$(document).ready(function() {
 $.ajax({
    url: "{{URL::to('report/getPieAllData')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        pieAll(data);
    }
  });
  combinationAll();
  
   $.ajax({
    url: "{{URL::to('report/Khet10Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet10(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet01Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet01(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet02Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet02(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet03Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet03(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet04Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet04(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet05Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet05(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet06Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet06(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet07Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet07(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet08Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet08(data);
    }
  });
   $.ajax({
    url: "{{URL::to('report/Khet09Data')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}",
    type: 'GET',
    async: true,
    dataType: "json",
    success: function (data) {
        khet09(data);
    }
  });
});

function khet10 (data) {
	$('#c10').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขตอิสระ'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
	
	
}
function khet01 (data) {
	$('#c1').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 1'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
	
}
function khet02 (data) {
	$('#c2').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 2'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}
function khet03 (data) {
	
	$('#c3').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 3'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});

}
function khet04 (data) {
	$('#c4').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 4'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}
function khet05 (data) {
	$('#c5').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 5'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}
function khet06 (data) {
	$('#c6').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 6'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}
function khet07 (data) {
	$('#c7').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 7'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}
function khet08 (data) {
	$('#c8').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 8'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}
function khet09 (data) {
	$('#c9').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: null,
	plotShadow: false
	},
	title: {
	text: 'เขต 9'
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: false
	},
	showInLegend: true
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'pie',
	name: 'ทั้งหมด',
	innerSize: '50%',
	data: data
	}]
	});
}

function pieAll (data) {
	$('#all2').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: 1,//null,
	plotShadow: false
	},
	title: {
	text: 'สรุปการจู่โจมตรวจค้นทั้งประเทศ (สารเสพติด/มือถือ/ซิมการ์ด)',
	style: {
         fontSize: '13.5px',
         fontWeight: 'bold'
      		
      }
	},
	tooltip: {
	pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
	},
	credits: {
	enabled: false
	},
	
	plotOptions: {
	pie: {
	allowPointSelect: true,
	cursor: 'pointer',
	dataLabels: {
	enabled: true,
	format: '<b>{point.name}</b>: พบ {point.y} เรือนจำ',
	style: {
	color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	}
	}
	}
	},
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	series: [{
	type: 'pie',
	name: 'จำนวนเรือนจำที่พบ',
	data: data
	}]
	});
}

function combinationAll() {
	var options = {
		chart: {
	                    renderTo: 'all',
	                    plotBackgroundColor: null,
	                    plotBorderWidth: null,
	                    plotShadow: false
	                },
		title: {
			text: 'กราฟสรุปผลการจู่โจมตรวจค้น'
		},
		xAxis: {
			categories: ['เขตอิสระ','เขต 1', 'เขต 2', 'เขต 3', 'เขต 4', 'เขต 5','เขต 6', 'เขต 7', 'เขต 8', 'เขต 9']
		},
		yAxis:{
			title:{text: 'จำนวน(เรือนจำ)'}
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y} เรือนจำ</b>'
		},
		/*labels: {
			items: [{
			html: 'กราฟสรุปผลการจู่โจมตรวจค้นรวมทั้งประเทศ',
			style: {
				left: '140px',
				top: '-18px',
				color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
				}
			}]
		},*/
		 plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                }
            }
            //,
            //pie: {
            //	center: [60, 0],
			//	size: 100,
			//	showInLegend: false,
            //    dataLabels: {
            //        enabled: false
            //    }
            //}
        },
		exporting : {
			url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
		},
		credits: {
		enabled: false
		},
		series: [{}]
	}
	 $.getJSON("{{URL::to('report/getCombinationAllData')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}", function(json) {
                options.series = json;
                chart = new Highcharts.Chart(options);
            });
		
}


</script>
@stop
@stop
