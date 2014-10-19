{{ Form::open(array('url'=>'report/confirm', 'class'=>'form-signup', 'id'=>'confirmForm')) }}	
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<!-- ./ csrf token -->
	
	<!-- this button is showned when found is selected and hidden when not_found is selected-->
    
    @if(count($unconfirmInsideReport)+count($unconfirmOutsideReport) > 0)
    	<div id="note_area1" style="width: 500px">
    		<br />
	    	หมายเหตุ: {{ Form::textarea('note1', isset($noteContent) ? $noteContent : null, array('class'=>'form-control','id'=>'note1','rows'=> '3', 'cols' => '5', 'limit' =>'50' ))}} 
			<br />
			<input type="button" class="btn btn-success" id ="confirmButton1" onclick="confirmForm()" value="ยืนยัน">
		
		</div>
	@endif
	<!-- this button is showned when not_found is selected and hidden when found is selected-->
	<div id = "note_area2" style="display: none; width: 500px">
		<br />
		หมายเหตุ: {{ Form::textarea('note1', isset($noteContent) ? $noteContent : null, array('class'=>'form-control','id'=>'note1','rows'=> '3', 'cols' => '5', 'limit' =>'50' ))}} 
		<br />
		<input type="button" class="btn btn-success" id ="confirmButton2"  onclick="confirmForm()" value="ยืนยัน">
	
	</div>
	<hr />
	
	<section class="container" style="width: 90%;">
	<!-- 
	<input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
	-->
	@if(count($unconfirmInsideReport)>0)
	<h4 style="background-color: #efefef; text-align: center">พบภายในเรือนจำ</h4>
	
	<table class="order-table table" border="1px" bordercolor="#cfcfcf">
		<thead>
			<tr>			
				<th style="width: 38%">
					สิ่งของต้องห้าม
				</th>
				<th style="width: 7%">
					จำนวน 
				</th>
				<th style="width: 14%">
					ผู้ครอบครอง
				</th>	
				<th style="width: 25%">
					บริเวณที่พบ 
				</th>
				<th style="width: 10%">
					วิธีการ 
				</th>
				<th style="width: 6%">
					Action 
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
					{{Area::find($value->area_id)->name}}
				</td>	
				<td>
					{{Method::find($value->method_id)->name}}  
				</td>			
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id.'/'.$value->found_date), 'Remove')}}
				</td>
					
			</tr>
		@endforeach
		</tbody>
	</table>
	
	@endif
	</section>
	<section class="container" style="width: 90%;">
	@if(count($unconfirmOutsideReport)>0)
	<h4 style="background-color: #efefef; text-align: center">สกัดกั้นก่อนเข้าเรือนจำ</h4>
	<table class="order-table table" border="1px" bordercolor="#cfcfcf">
		<thead>
		<tr>			
				<th style="width: 38%">
					สิ่งของต้องห้าม
				</th>
				
				<th style="width: 7%">
					จำนวน 
				</th>
				<th style="width: 14%">
					ผู้ครอบครอง
				</th>	
				<th style="width: 25%">
					บริเวณที่พบ 
				</th>
				<th style="width: 10%">
					วิธีการ 
				</th>
				<th style="width: 6%">
					Action 
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
					{{Area::find($value->area_id)->name}}
				</td>
				<td>
						{{Method::find($value->method_id)->name}}  
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id.'/'.$value->found_date), 'Remove')}}
				</td>
				
			</tr>
		@endforeach
		</tbody>
	</table>
	@endif
	</section>
	@if(count($unconfirmNotfound)>0)
	ไม่พบ
	<table border="1" style="width:100%">
		<tr>			
				<td>
					สิ่งของต้องห้าม
				</td>
				<td>
					วันที่
				</td>
				<td>
					จำนวน 
				</td>
				<td>
					บริเวณที่พบ 
				</td>	
				<td>
					Action 
				</td>
			</tr>
		@foreach($unconfirmNotfound as $value)
			<tr>			
				<td>
					{{Item::find($value->item_id)->name}}
				</td>
				<td>
					
					{{Report::convertYearCtoB(date("d-m-Y", strtotime($value->found_date)))}}
				</td>	
				<td>
					{{$value->qty}} {{Item::find($value->item_id)->unit}}
				</td>
				<td>
					{{$value->area_found}}
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id.'/'.$value->found_date), 'Remove')}}
				</td>
			</tr>
		@endforeach
	</table>
	@endif
	
	{{ Form::close() }}
	

@section('scripts')
<script>
(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}

		function _filter(row) {
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('light-table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);
</script>
@stop