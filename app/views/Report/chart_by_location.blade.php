@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

{{ Form::open(array('url'=>'report/bylocation', 'class'=>'form-signup', 'id'=>'infoForm')) }}

<br />
<b>Step 1: &nbsp; &nbsp; </b>ตั้งแต่: <input type="text" id="startDate" name="startDate" readonly="true"value="{{Input::old('startDate',(isset($startDate))? $startDate : date('d-m').'-'.$buddhistYear)}}"> 	
ถึง: <input type="text" id="endDate" name="endDate" readonly="true"value="{{Input::old('endDate',(isset($endDate))? $endDate : date('d-m').'-'.$buddhistYear)}}"> 	
<br /><br />
<b>Step 2: &nbsp; &nbsp; </b>ระบุเขต: {{ Form::select('khet_id', Khet::getArrayCustomFirstRecord('ทั่วประเทศ'),Input::old('khet_id',(isset($khet_id))? $khet_id : 0),array('id'=>'khet_id')) }}
<br /><br />
<b>Step 3: &nbsp; &nbsp; </b>เลือกสิ่งของต้องห้าม: {{ Form::select('item_id', Item::getArrayNotAll(),Input::old('item_id',(isset($item_id))? $item_id : 0),array('id'=>'item','style' => 'width:200px')) }}
@if ($message = Session::get('error'))
 @if(is_array($message))
    @foreach ($message as $m)
    	<font color="red"> *{{ $m }}</font>
    @endforeach
 @else
    <font color="red"> *{{ $message }}</font>
 @endif
@endif
<br />
<br />
{{ Form::submit('ดูรายงาน') }}
{{ Form::close() }}

<div id='bylocation_chart'>
	
</div>

@stop
@section('scripts')

<script src="{{asset('assets/js/highcharts.js')}}"></script>
<script src="{{asset('assets/js/modules/exporting.js')}}"></script> 		
<script>

$(document).ready(function() {
  combinationAll();
});
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
			
	function combinationAll() {
	var options = {
		chart: {
	                    renderTo: 'bylocation_chart',
	                    type: 'column',
	                    plotBackgroundColor: null,
	                    plotBorderWidth: null,
	                    plotShadow: false
	                },
		title: {
			text: 'การจู่โจมตรวจค้น <?php if($khet_id==0){ echo "ทั่วประเทศ";} else{ echo 'ประจำ'.Khet::find($khet_id)->name;} echo " ระหว่างวันที่ ".str_replace("-","/",$startDate)." - ".str_replace("-","/",$endDate)?> พบ {{Item::find($item_id)->name}} {{$foundTotal}} {{Item::find($item_id)->unit}}'
		},
		subtitle: {
		    text: 'สกัดกั้นก่อนเข้าเรือนจำ {{$foundBefore}} {{Item::find($item_id)->unit}} พบภายในเรือนจำ {{$foundAfter}} {{Item::find($item_id)->unit}}'
		},
		xAxis: {
			categories: [],
			labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
		},
		yAxis:{
			title:{text: 'จำนวน({{Item::find($item_id)->unit}})'}
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y} {{Item::find($item_id)->unit}}</b>'
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
            	stacking: 'normal',
                dataLabels: {
                    enabled: false
                }
            }
        },
		exporting : {
			url: "{{asset('assets/exporting-server/php/php-batik/index.php')}}"
		},
		credits: {
		enabled: false
		},
		series: [{}]
	}
	 $.getJSON("{{URL::to('report/getByLocationData')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}"+"/"+"{{$khet_id}}"+"/"+"{{$item_id}}", function(json) {
                options.xAxis.categories = json[0]['data'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                chart = new Highcharts.Chart(options);
     });
		
	}
</script>	 
@stop