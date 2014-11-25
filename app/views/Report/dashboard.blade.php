@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

@stop
@section("content")

<h3 align="center">สรุปการรายงานการจู่โจมตรวจค้นประจำวันที่ 9 ตุลาคม 2557 </h3>
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
	$('#all').highcharts({
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
	exporting : {
	url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
	},
	credits: {
	enabled: false
	},
	series: [{
	type: 'column',
	name: 'ไม่พบ',
	data: [3, 2, 1, 3, 4, 0, 2, 3, 7, 6],
	dataLabels: {
	enabled: true
	}
	}, {
	type: 'column',
	name: 'พบสารเสพติด',
	data: [2, 3, 5, 7, 6, 5, 2, 2, 9, 6],
	dataLabels: {
	enabled: true
	}
	}, {
	type: 'column',
	name: 'พบสิ่งของต้องห้าม',
	data: [4, 3, 3, 9, 0, 4, 5, 6, 1, 3],
	dataLabels: {
	enabled: true
	}
	}, {
	type: 'pie',
	name: 'รวมทั้งประเทศ',
	data: [{
	name: 'ไม่พบ',
	y: 13,
	color: Highcharts.getOptions().colors[0] // John's color
	}, {
	name: 'พบสารเสพติด',
	y: 23,
	color: Highcharts.getOptions().colors[1] // John's color
	}, {
	name: 'พบสิ่งของต้องห้าม',
	y: 19,
	color: Highcharts.getOptions().colors[2] // Joe's color
	}],
	center: [60, 0],
	size: 100,
	showInLegend: false,
	dataLabels: {
	enabled: false
	}
	}]
	});
	
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
	data: [
	['เขต 1',   19],
	['เขต 2',       8],
	['เขต 3',    20],
	['เขต 4',     2],
	['เขต 5',   7],
	['เขต 6',   29],
	['เขต 7',       18],
	['เขต 8',    2],
	['เขต 9',     12],
	['เขตอิสระ',   17]
	]
	}]
	});
	
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
