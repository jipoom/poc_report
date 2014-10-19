{{ Form::open(array('url'=>'report/confirm', 'class'=>'form-signup', 'id'=>'confirmForm')) }}	
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<!-- ./ csrf token -->
	@if(count($unconfirmInsideReport)>0)
	พบภายในเรือนจำ
	
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
					วิธีการ 
				</td>
				<td>
					Action 
				</td>		
			</tr>
		@foreach($unconfirmInsideReport as $value)
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
					{{Method::find($value->method_id)->name}}  
				</td>			
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id.'/'.$value->found_date), 'Remove')}}
				</td>
					
			</tr>
		@endforeach
	</table>
	@endif
	
	@if(count($unconfirmOutsideReport)>0)
	สกัดกั้นก่อนเข้าเรือนจำ
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
					วิธีการ 
				</td>
				<td>
					Action 
				</td>
				
			</tr>
		@foreach($unconfirmOutsideReport as $value)
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
						{{Method::find($value->method_id)->name}}  
				</td>
				<td>
					{{ HTML::link(URL::to('report/delete/'.$value->id.'/'.$value->found_date), 'Remove')}}
				</td>
				
			</tr>
		@endforeach
	</table>
	@endif
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
	<!-- this button is showned when found is selected and hidden when not_found is selected-->
    @if(count($unconfirmInsideReport)+count($unconfirmOutsideReport) > 0)
    	<div id="note_area1">
	    	<p>หมายเหตุ: {{ Form::textarea('note1', isset($noteContent) ? $noteContent : null, array('class'=>'form-control','id'=>'note1'))}}  </p>
			<input type="button" class="btn btn-success pull-right" id ="confirmButton1" onclick="confirmForm()" value="ยืนยัน">
		</div>
	@endif
	<!-- this button is showned when not_found is selected and hidden when found is selected-->
	<div id = "note_area2" style="display: none">
		<p>หมายเหตุ: {{ Form::textarea('note2', isset($noteContent) ? $noteContent : null, array('class'=>'form-control','id'=>'note2'))}}  </p>	
		<input type="button" class="btn btn-success" id ="confirmButton2"  onclick="confirmForm()" value="ยืนยัน">
	</div>
	{{ Form::close() }}