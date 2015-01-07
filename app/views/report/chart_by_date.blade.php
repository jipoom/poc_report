@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

{{ Form::open(array('url'=>'report/bydate', 'class'=>'form-signup', 'id'=>'infoForm')) }}

<br />
<b>Step 1: &nbsp; &nbsp; </b>ตั้งแต่: <input type="text" id="startDate" name="startDate" readonly="true"value="{{Input::old('startDate',(isset($startDate))? $startDate : date('d-m').'-'.$buddhistYear)}}"> 	
ถึง: <input type="text" id="endDate" name="endDate" readonly="true"value="{{Input::old('endDate',(isset($endDate))? $endDate : date('d-m').'-'.$buddhistYear)}}"> 	
<br /><br />
<b>Step 2: &nbsp; &nbsp; </b>ระบุเขต: {{ Form::select('khet_id', Khet::getArrayCustomFirstRecord('ทั่วประเทศ'),Input::old('khet_id',(isset($khet_id))? $khet_id : 0),array('id'=>'khet_id')) }}
<br /><br />
<div id='location'>
<b>Step 3: &nbsp; &nbsp; </b>ทุกเรือนจำ</br></br>
</div>
<b>Step 4: &nbsp; &nbsp; </b>เลือกสิ่งของต้องห้าม: {{ Form::select('item_id', Item::getArrayNotAll(),Input::old('item_id',(isset($item_id))? $item_id : 0),array('id'=>'item','style' => 'width:200px')) }}
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
	   	    loadLocation($( "#khet_id" ).val(),'{{$location_id}}','all');   
	    }	
  combinationAll();
});

 function loadLocation(khetId,locationId,firstRecord){
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
				xmlhttp.open("GET", "{{{ URL::to('report/admin/report/loadLocation') }}}/"+khetId+"/"+locationId+"/"+firstRecord, false);
				xmlhttp.send();
	 }

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
			text: 'กราฟสรุปผลการจู่โจมตรวจค้น{{Item::find($item_id)->name}} <?php if($khet_id==0){ echo "ทั่วประเทศ";} else if($location_id==0){ echo Khet::find($khet_id)->name;} else { echo Location::find($location_id)->name;} echo " ตั้งแต่ ".$startDate." ถึง ".$endDate?>'
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
	 $.getJSON("{{URL::to('report/getByDateData')}}"+"/"+"{{$startDate}}"+"/"+"{{$endDate}}"+"/"+"{{$location_id}}"+"/"+"{{$khet_id}}"+"/"+"{{$item_id}}", function(json) {
                options.xAxis.categories = json[0]['data'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                options.series[2] = json[3];
                chart = new Highcharts.Chart(options);
     });
		
	}
</script>	 
@stop