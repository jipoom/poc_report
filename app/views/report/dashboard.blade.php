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
<h3 align="center">สรุปการรายงานการจู่โจมตรวจค้นประจำวันที่  {{$startDate}} ถึง {{$endDate}}</h3>
<table cellpadding="10" style="position: absolute; margin: 15px 0 0 45px;">
	<tr>
		<th><img src="{{asset('assets/images/po.png')}}" width="60px" style="position: relative;"></th>
		<th> มีการจู่โจมตรวจค้นทั้งสิ้น</th>
		<th> 80</th>
		<th> เรือนจำ</th>
	</tr>
	<tr>
		<td><img src="{{asset('assets/images/cr3.png')}}" width="60px" style="position: relative;"></td>
		<th> พบยาเสพติด / มือถือ/ ซิมการ์ด</th>
		<th> 30</th>
		<th> เรือนจำ</th>
	</tr>
	<tr>
		<td><img src="{{asset('assets/images/cr4.png')}}" width="60px" style="position: relative;"></td>
		<th> พบสิ่งต้องห้ามอื่นๆ</th>
		<th> 15</th>
		<th> เรือนจำ</th>
	</tr>
</table>
<div id="all2" style="float: right; height: 300px; width: 450px; padding: 0"></div>

<div id="all" style=""></div>
<br />
<table frame="box" style="margin: 0px auto; border-width: 1px; border-coler:gray">
	<tr>
		<th><div id="c1" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t1" style="width: 600px; right: 0px">
			ตรวจค้นแล้ว ไม่พบ : รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
			<br>
			พบยาเสพติด/มือถือ/ซิมการ์ด: รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
			<br>
			พบสิ่งของต้องห้ามอื่นๆ: รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
		</div></th>

	</tr>

	<tr>
		<th><div id="c2" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t2" style="width: 600px; right: 0px">
			ตรวจค้นแล้ว ไม่พบ : รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
			<br>
			พบยาเสพติด/มือถือ/ซิมการ์ด: รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
			<br>
			พบสิ่งของต้องห้ามอื่นๆ: รจก.ระยอง, รจพ.ระยอง , ทสญ.กลา
		</div></th>
	</tr>
	<tr>
		<th><div id="c3" style="width: 400px; height: 250px"></div></th>
		<th>
		<div id="t3" style="width: 600px; right: 0px">
			ตรวจค้นแล้ว ไม่พบ : รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
			<br>
			พบยาเสพติด/มือถือ/ซิมการ์ด: รจก.ระยอง, รจพ.ระยอง , ทสญ.กลาง
			<br>
			พบสิ่งของต้องห้ามอื่นๆ: รจก.ระยอง, รจพ.ระยอง , ทสญ.กลา
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
});
function pieAll (data) {
	$('#all2').highcharts({
	chart: {
	plotBackgroundColor: null,
	plotBorderWidth: 1,//null,
	plotShadow: false
	},
	title: {
	text: 'สรุปการจู่โจมตรวจค้นทั้งประเทศ (ประเภทยาเสพติด)'
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
		labels: {
			items: [{
			html: 'กราฟสรุปผลการจู่โจมตรวจค้นรวมทั้งประเทศ',
			style: {
				left: '140px',
				top: '-18px',
				color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
				}
			}]
		},
		 plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                }
            },
            pie: {
            	center: [60, 0],
				size: 100,
				showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }
        },
		exporting : {
			url: 'http://localhost/report_demo/exporting-server/php/php-batik/index.php'
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

$(function () {

	
	
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
	data: [
	['พบสิ่งของต้องห้าม',   12],
	['พบสารเสพติด',       3],
	['ไม่พบ', 4],
	]
	}]
	});
	
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
	data: [
	['พบสิ่งของต้องห้าม',   8],
	['พบสารเสพติด',       10],
	['ไม่พบ', 4],
	]
	}]
	});
	
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
	data: [
	['พบสิ่งของต้องห้าม',   2],
	['พบสารเสพติด',       10],
	['ไม่พบ', 7],
	]
	}]
	});

});

</script>
@stop
@stop
