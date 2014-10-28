@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

<h4>แสดงรายงาน</h4>
{{ Form::open(array('url'=>'report/view', 'class'=>'form-signup', 'id'=>'infoForm')) }}
ตั้งแต่: <input type="text" id="startDate" name="startDate" readonly="true"value="{{Input::old('startDate',(isset($startDate))? $startDate : date('d-m').'-'.$buddhistYear)}}"> 	
ถึง: <input type="text" id="endDate" name="endDate" readonly="true"value="{{Input::old('endDate',(isset($endDate))? $endDate : date('d-m').'-'.$buddhistYear)}}"> 	
{{ Form::submit() }}
{{ Form::close() }}

<table class="table table-striped table-bordered" border="1">
			<thead>
				<tr>
					<th>เขต</th>
					<th>เรือนจำ/ทัณฑสถาน</th>
					<th>จำนวนครั้งที่มีการจู่โจมกรณีปกติ</th>
					<th>จำนวนครั้งที่มีการจู่โจมกรณีพิเศษ</th>
					<th>ไม่พบ</th>
					<th>พบ</th>
					<th>ย้าบ้า(เม็ด)</th>
					<th>ไอซ์(กรัม)</th>
					<th>เฮโรอีน(กรัม)</th>
					<th>กัญชา(กรัม)</th>
					<th>ยาเมา(เม็ด)</th>
					<th>ฝิ่น(กรัม)</th>
					<th>สุราหรือของมึนเมา</th>
					<th>อุปกรณ์สำหรับเล่นการพนัน</th>
					<th>เครื่องมืออันเป็นอุปกรณ์ในการหลบหนี</th>
					<th>อาวุธ เครื่องกระสุนปืน วัตถุระเบิด ดอกไม้เพลิง และสิ่งเทียมอาวุธปืน</th>
					<th>อาวุธดัดแปลง เหล็กแหลม</th>
					<th>ของเน่าเสีย หรือของมีพิษต่อร่างกาย</th>
					<th>น้ำมันเชื้อเพลิง</th>
					<th>สัตว์มีชีวิต</th>
					<th>เครื่องคอมพิวเตอร์</th>
					<th>โทรศัพท์มือถือ</th>
					<th>แบตเตอรี่</th>
					<th>ซิมการ์ด</th>
					<th>เมมโมรี่การ์ด</th>
					<th>หูฟัง/บลูธูท</th>
					<th>อุปกรณ์ชาร์จแบตเตอรี่</th>
					<th>วัตถุ เอกสารหรือสิ่งพิมพ์ซึ่งอาจก่อให้เกิดความไม่สงบเรียบร้อย หรือเสื่อมต่อศีลธรรมอันดีของประชาชน</th>
					<th>อื่นๆ</th>
				</tr>
				<tr>
					@foreach($table as $item)
						
						<td>
							@if($item == '0')
								-
							@else
								{{$item}}
							@endif	
							
							</td>
					@endforeach
				</tr>
			</thead>
		</table>

	
@stop
@section('scripts')
<script>
	 $(function () {
		    /*var d = new Date();
		    var toDay = d.getDate() + '/'
        + (d.getMonth() + 1) + '/'
        + (d.getFullYear() + 543);

				// Datepicker
		    $("#startDate").datepicker({ dateFormat: 'dd-mm-yy', isBuddhist: true, maxDate:0, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

				$("#endDate").datepicker({ dateFormat: 'dd-mm-yy', isBuddhist: true, maxDate:0, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              	dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
             	 monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
             	 monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			 */
			
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

</script>
@stop