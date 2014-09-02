<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Google Charts Tutorial</title>
<style>
#map_wrapper {
    height: 600px;
    width: 600px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>

var map;

function initialize() {	
  var mapOptions = { center: new google.maps.LatLng(13.727896, 100.524123), 
                     zoom: 5,
                     mapTypeId: google.maps.MapTypeId.ROADMAP };
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  
  //lat and long from users (using ajax to get php array)
  // http://stackoverflow.com/questions/6395720/get-data-from-php-array-ajax-jquery
  var arraylng = {{$lat}}
  var arraylat = {{$long}}
  var arrayID = {{$id}}
  var arrayLocation = {{$location}}
  var arrayThreatToday = {{$threatToday}}
  var arrayThreatMax = {{$threatMax}}
  var markers = [];

  var infowindow = new google.maps.InfoWindow();

  for (var i = 0; i < arraylng.length; i++) {
    if(arrayThreatToday[i] == 0)
    {
	    var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(arraylng[i], arraylat[i]),
	      icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
	      map: map
	    });
    }
    else
    {
    	var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(arraylng[i], arraylat[i]),
	      map: map
	    });
    }
	
    makeInfoWindowEvent(map, infowindow, arrayLocation[i],arrayID[i],arrayThreatMax[i], marker);
    
    markers.push(marker);
  }
}

function makeInfoWindowEvent(map, infowindow, locaionName,locationID, max,marker) {
  google.maps.event.addListener(marker, 'click', function() {
	 drawChartFromPHP(marker, infowindow, locaionName, locationID,max);
  });
}
      
function drawChartFromPHP(marker, infowindow, location,id,max) {
      var jsonData = $.ajax({
          url: "{{URL::to('report/getData')}}"+"/"+id,
          dataType:"json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
	 
	  var view = new google.visualization.DataView(data);
	    view.setColumns([0, {
	        type: 'number',
	        label: 'Value',
	        calc: function (dt, row) {
	            var value = dt.getValue(row, 1);
	            // Check if data set is super diff
	            if(value < max/12)
	            	return {v: max/12, f: dt.getFormattedValue(row, 1)};
	            else
	            	return value;
	        }
	    },{ calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);	
	    
	    //The commented below is stacked column 	
	   /*var data2 = google.visualization.arrayToDataTable([
        ['Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        ['2010', 10, 24, 20, 32, 18, 5, ''],
        ['2020', 16, 22, 23, 30, 16, 9, ''],
        ['2030', 28, 19, 29, 30, 12, 13, '']
      ]);*/
	  var options = {'title':'ภาพรวมการจู่โจม ณ '+ location,
                       'width':400,
                       'height':300,
                       'isStacked': true
                       };	
      // Instantiate and draw our chart, passing in some options.
      
      var node = document.createElement('div'),
    	 chart = new google.visualization.ColumnChart(node);
	    google.visualization.events.addListener(chart, 'ready', function () {
	      node.innerHTML = '<img src="' + chart.getImageURI() + '">';
	    });
	      
      chart.draw(view, options);
      infowindow.setContent(node);
      infowindow.open(marker.getMap(),marker);
    }
google.load('visualization', '1.0', {'packages':['corechart']});
google.maps.event.addDomListener(window, 'load', initialize);
</script>
 </head>
 
<body>
<!-- CHECK ELEMENT ID also UPDATE CSS -->
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>
{{ HTML::link(URL::to('report/export'), 'export')}}

 
    </body>
</html>
