@extends("layout")
@section('title')
Stand Alone
@stop
@section('styles')
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")
      <!--Divs for our charts -->
		
		 <form action="{{URL::to('report/hdashboard')}}" method="get">
		 <p>เลือกวันที่: <input type="text" id="datepicker" name="date" value="{{isset($date) ? $date : date('d-M-Y')}}">
		 <button type="submit">Submit</button></p>
		 </form>
		 <h3>รายงานสรุปผลประจำวันที่: {{$date}}</h3>
		 <div>
		 	<p>มีการตรวจค้นทั้งสิ้น {{$totalPrisonInspected}}</p>
		 	<p>พบยาเสพติด {{$totalDrugs}}</p>
		 	<p>พบสิ่งของต้องห้าม {{$totalItems}}</p>
		 </div>  
		 <div id="Khet10"></div>
		 <div id="Khet1"></div>
		 <div id="Khet2"></div>
		 <div id="Khet3"></div>
		 <div id="Khet4"></div>
		 <div id="Khet5"></div>
		 <div id="Khet6"></div>
		 <div id="Khet7"></div>
		 <div id="Khet8"></div>
		 <div id="Khet9"></div>

@section('scripts')
 <!-- load Google AJAX API -->
       
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script src="{{asset('assets/js/highcharts.js')}}"></script>
        <script>
        	$( document ).ready(
        	function initChart()
			{
				dashBoardChart(1);
				dashBoardChart(2);
				dashBoardChart(3);
				dashBoardChart(4);
				dashBoardChart(5);
				dashBoardChart(6);
				dashBoardChart(7);
				dashBoardChart(8);
				dashBoardChart(9);
				dashBoardChartK10(10);
				//cpuChart();
				//temperatureChart();
				//interfaceChart();
	
		});
		function dashBoardChart(khetId){
			var options = {
                chart: {
                    renderTo: 'Khet'+khetId,
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'เขต : '+khetId
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ this.y +' เรือนจำ';
                    }
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
                            color: '#000000',
                            connectorColor: '#000000',
                            style: {
		                        fontSize: '12px'
		                    },
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ this.y +' เรือนจำ';
                            }
                        }
                    }
                },
                colors: ['green','red', 'orange',],
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: []
                }]
            }
            
            
            $.getJSON("{{URL::to('report/getHDashBoardData')}}"+"/"+"{{$date}}"+"/"+khetId, function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });
		}
		
		function dashBoardChartK10(khetId){
			var options = {
                chart: {
                    renderTo: 'Khet'+khetId,
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'เขตพิเศษ'
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ this.y +' เรือนจำ';
                    }
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
                            color: '#000000',
                            connectorColor: '#000000',
                            style: {
		                        fontSize: '12px'
		                    },
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ this.y +' เรือนจำ';
                            }
                        }
                    }
                },
                colors: ['green','red', 'orange',],
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: []
                }]
            }
            
            $.getJSON("{{URL::to('report/getHDashBoardData')}}"+"/"+"{{$date}}"+"/"+khetId, function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
            });
		}
        </script>
         <script>
		  $(function() {
		    $("#datepicker").datepicker({ dateFormat: 'dd-M-yy' });;
		  });
		  </script>
@stop 
@stop