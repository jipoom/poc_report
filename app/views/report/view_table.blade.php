@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

<h4>ตารางแสดงสรุปรายงาน</h4>
{{ Form::open(array('url'=>'report/view', 'class'=>'form-signup', 'id'=>'infoForm')) }}
ตั้งแต่: <input type="text" id="startDate" name="startDate" readonly="true"value="{{Input::old('startDate',(isset($startDate))? $startDate : date('d-m').'-'.$buddhistYear)}}"> 	
ถึง: <input type="text" id="endDate" name="endDate" readonly="true"value="{{Input::old('endDate',(isset($endDate))? $endDate : date('d-m').'-'.$buddhistYear)}}"> 	
{{ Form::submit('ดูรายงาน') }}
{{ Form::close() }}
<br>
<P><a target = '_blank' href="{{{ URL::to('report/location/export/'.$startDate.'/'.$endDate) }}}" class="btn btn-default btn-xs">Export table to PDF format</a></p>
<table class="table table-striped table-bordered tabletest" border="1" style="font-size: 12px;" >
			<thead>
					
				<tr>
					<th rowspan="3">วันที่ทำการจู่โจม</th>
					<th class="rotate" rowspan="3"><div><span>เขต</span></div></th>
					<th rowspan="3">เรือนจำ/ทัณฑสถาน</th>
					<th class="rotate" rowspan="3"><div><span>จำนวนครั้งที่มีการจู่โจมกรณีปกติ</span></div></th>
					<th class="rotate" rowspan="3"><div><span>จำนวนครั้งที่มีการจู่โจมกรณีพิเศษ</span></div></th>
					<th rowspan="3">ไม่พบ</th>
					<th rowspan="3">พบ</th>
					<th colspan="23"><center>สิ่งของห้ามนำเข้าเรือนจำ/ทัณฑสถาน</center></th>
				</tr>
				<tr>
					<th colspan="6"><center>ยาเสพติดให้โทษ วัตถุออกฤทธิ์ต่อจิตและประสาท/สารระเหย</center></th>
					<th class="rotate" rowspan="2"><div><span>สุราหรือของมึนเมา</span></div></th>
					<th class="rotate" rowspan="2"><div><span>อุปกรณ์สำหรับเล่นการพนัน</span></div></th>
					<th class="rotate" rowspan="2"><div><span>เครื่องมืออันเป็นอุปกรณ์ในการหลบหนี</span></div></th>
					<th class="rotate" rowspan="2"><div><span>อาวุธ เครื่องกระสุนปืน วัตถุระเบิด  <br>ดอกไม้เพลิง และสิ่งเทียมอาวุธปืน</span></div></th>
					<th class="rotate" rowspan="2"><div><span>อาวุธดัดแปลง เหล็กแหลม</span></div></th>
					<th class="rotate" rowspan="2"><div><span>ของเน่าเสีย หรือของมีพิษต่อร่างกาย</span></div></th>
					<th class="rotate" rowspan="2"><div><span>น้ำมันเชื้อเพลิง</span></div></th>
					<th class="rotate" rowspan="2"><div><span>สัตว์มีชีวิต</span></div></th>
					<th colspan="7"><center>เครื่องคอมพิวเตอร์ โทรศัพท์มือถือ หรือเครื่องมือสื่อสารอื่น รวมทั้งอุปกรณ์สำหรับสิ่งของดังกล่าว</center></th>
					<th rowspan="2">วัตถุ เอกสารหรือสิ่งพิมพ์ซึ่งอาจก่อให้เกิดความไม่สงบเรียบร้อย หรือเสื่อมต่อศีลธรรมอันดีของประชาชน</th>
					<th rowspan="2">อื่นๆ</th>
				</tr>
				<tr>
					
					<th class="rotate"><div><span>ย้าบ้า(เม็ด)</span></div></th>
					<th class="rotate"><div><span>ไอซ์(กรัม)</span></div></th>
					<th class="rotate"><div><span>เฮโรอีน(กรัม)</span></div></th>
					<th class="rotate"><div><span>กัญชา(กรัม)</span></div></th>
					<th class="rotate"><div><span>ยาเมา(เม็ด)</span></div></th>
					<th class="rotate"><div><span>ฝิ่น(กรัม)</span></div></th>
					
					<th class="rotate"><div><span>เครื่องคอมพิวเตอร์</span></div></th>
					<th class="rotate"><div><span>โทรศัพท์มือถือ</span></div></th>
					<th class="rotate"><div><span>แบตเตอรี่</span></div></th>
					<th class="rotate"><div><span>ซิมการ์ด</span></div></th>
					<th class="rotate"><div><span>เมมโมรี่การ์ด</span></div></th>
					<th class="rotate"><div><span>หูฟัง/บลูธูท</span></div></th>
					<th class="rotate"><div><span>อุปกรณ์ชาร์จแบตเตอรี่</span></div></th>
					
				</tr>
			</thead>
					@foreach($table as $transaction)
						<tr>
							<td>{{$transaction->found_date}}</td>
							<td>{{($transaction->khet_id==10)? 'เขตอิสระ' : $transaction->khet_id}}</td>
							<td>{{Location::find($transaction->location_id)->name}}</td>
							@if($transaction->method == 1)
							<td>1</td>	
							<td>-</td>	
							@else
							<td>-</td>
							<td>1</td>	
							@endif
							@if($transaction->a+$transaction->b+$transaction->c+$transaction->d+$transaction->e+
							$transaction->f+$transaction->g+$transaction->h+$transaction->i+$transaction->j+
							$transaction->k+$transaction->l+$transaction->m+$transaction->n+$transaction->o+
							$transaction->p+$transaction->q+$transaction->r+$transaction->s+$transaction->t+
							$transaction->u+$transaction->v+$transaction->w == 0)
							<td>1</td>	
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							@else
							<td>-</td>	
							<td>1</td>
							<td>{{($transaction->a==0)? '-' : $transaction->a}}</td>
							<td>{{($transaction->b==0)? '-' : $transaction->b}}</td>
							<td>{{($transaction->c==0)? '-' : $transaction->c}}</td>
							<td>{{($transaction->d==0)? '-' : $transaction->d}}</td>
							<td>{{($transaction->e==0)? '-' : $transaction->e}}</td>
							<td>{{($transaction->f==0)? '-' : $transaction->f}}</td>
							<td>{{($transaction->g==0)? '-' : $transaction->g}}</td>
							<td>{{($transaction->h==0)? '-' : $transaction->h}}</td>
							<td>{{($transaction->i==0)? '-' : $transaction->i}}</td>
							<td>{{($transaction->j==0)? '-' : $transaction->j}}</td>
							<td>{{($transaction->k==0)? '-' : $transaction->k}}</td>
							<td>{{($transaction->l==0)? '-' : $transaction->l}}</td>
							<td>{{($transaction->m==0)? '-' : $transaction->m}}</td>
							<td>{{($transaction->n==0)? '-' : $transaction->n}}</td>
							<td>{{($transaction->o==0)? '-' : $transaction->o}}</td>
							<td>{{($transaction->p==0)? '-' : $transaction->p}}</td>
							<td>{{($transaction->q==0)? '-' : $transaction->q}}</td>
							<td>{{($transaction->r==0)? '-' : $transaction->r}}</td>
							<td>{{($transaction->s==0)? '-' : $transaction->s}}</td>
							<td>{{($transaction->t==0)? '-' : $transaction->t}}</td>
							<td>{{($transaction->u==0)? '-' : $transaction->u}}</td>
							<td>{{($transaction->v==0)? '-' : $transaction->v}}</td>
							<td>{{($transaction->w==0)? '-' : $transaction->w}}</td>
							@endif
						</tr>
					@endforeach
					<tr>
						@foreach($total as $t)
						<td>
							{{$t}}
						</td>
						@endforeach
					</tr>
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
			$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"})
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