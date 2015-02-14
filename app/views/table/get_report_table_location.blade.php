<?php
require_once(public_path().'/mpdf60/mpdf.php');

ini_set('max_execution_time', 300);
ini_set('memory_limit','1024M');
?>
@extends("layout")
@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")

<h4><div id="title">กำลังสร้างไฟล์ PDF...</div></h4>
<?php ob_start(); ?>
<table class="table table-striped table-bordered tabletest" border="1" style="font-size: 12px;">
			<thead>
					
				<tr>
					<th rowspan="3">วันที่ทำการจู่โจม</th>
					<th text-rotate="90" rowspan="3"><div><span>เขต</span></div></th>
					<th rowspan="3">เรือนจำ/ทัณฑสถาน</th>
					<th text-rotate="90" rowspan="3"><div><span>จำนวนครั้งที่มีการจู่โจมกรณีปกติ</span></div></th>
					<th text-rotate="90" rowspan="3"><div><span>จำนวนครั้งที่มีการจู่โจมกรณีพิเศษ</span></div></th>
					<th rowspan="3">ไม่พบ</th>
					<th rowspan="3">พบ</th>
					<th colspan="23"><center>สิ่งของห้ามนำเข้าเรือนจำ/ทัณฑสถาน</center></th>
				</tr>
				<tr>
					<th colspan="6"><center>ยาเสพติดให้โทษ วัตถุออกฤทธิ์ต่อจิตและประสาท/สารระเหย</center></th>
					<th text-rotate="90" rowspan="2"><div><span>สุราหรือของมึนเมา</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>อุปกรณ์สำหรับเล่นการพนัน</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>เครื่องมืออันเป็นอุปกรณ์ในการหลบหนี</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>อาวุธ เครื่องกระสุนปืน วัตถุระเบิด  ดอกไม้เพลิง และสิ่งเทียมอาวุธปืน</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>อาวุธดัดแปลง เหล็กแหลม</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>ของเน่าเสีย หรือของมีพิษต่อร่างกาย</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>น้ำมันเชื้อเพลิง</span></div></th>
					<th text-rotate="90" rowspan="2"><div><span>สัตว์มีชีวิต</span></div></th>
					<th colspan="7"><center>เครื่องคอมพิวเตอร์ โทรศัพท์มือถือ หรือเครื่องมือสื่อสารอื่น รวมทั้งอุปกรณ์สำหรับสิ่งของดังกล่าว</center></th>
					<th rowspan="2">วัตถุ เอกสารหรือสิ่งพิมพ์ซึ่งอาจก่อให้เกิดความไม่สงบเรียบร้อย หรือเสื่อมต่อศีลธรรมอันดีของประชาชน</th>
					<th rowspan="2">อื่นๆ</th>
				</tr>
				<tr>
					
					<th text-rotate="90"><div><span>ย้าบ้า(เม็ด)</span></div></th>
					<th text-rotate="90"><div><span>ไอซ์(กรัม)</span></div></th>
					<th text-rotate="90"><div><span>เฮโรอีน(กรัม)</span></div></th>
					<th text-rotate="90"><div><span>กัญชา(กรัม)</span></div></th>
					<th text-rotate="90"><div><span>ยาเมา(เม็ด)</span></div></th>
					<th text-rotate="90"><div><span>ฝิ่น(กรัม)</span></div></th>
					
					<th text-rotate="90"><div><span>เครื่องคอมพิวเตอร์</span></div></th>
					<th text-rotate="90"><div><span>โทรศัพท์มือถือ</span></div></th>
					<th text-rotate="90"><div><span>แบตเตอรี่</span></div></th>
					<th text-rotate="90"><div><span>ซิมการ์ด</span></div></th>
					<th text-rotate="90"><div><span>เมมโมรี่การ์ด</span></div></th>
					<th text-rotate="90"><div><span>หูฟัง/บลูธูท</span></div></th>
					<th text-rotate="90"><div><span>อุปกรณ์ชาร์จแบตเตอรี่</span></div></th>
					
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
							{{($t=='0')? '-' : $t}}
						</td>
						@endforeach
					</tr>

		</table>
		<?Php
		$html = ob_get_contents();
		ob_clean();
		ob_end_clean();
		$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban');
		
		$pdf->SetDisplayMode('fullpage');
		$pdf->WriteHTML($html, 2);
		$pdf->Output(public_path().'/mpdf60/tmp/'.$filename,'F');
		//Redirect::to(asset('mpdf60/tmp/filename.pdf'));
		//header('Location: http://myhost.com/mypage.php');
		?>
		<div id="show_file"><p><a href="{{asset('mpdf60/tmp/'.$filename)}}">เปิดไฟล์ที่นี่</a></p></div>

@stop
@section('scripts')
<script>
$( document ).ready(function() {
	$("#show_file").hide();
setTimeout(function(){showDownload()},1000);
});
function showDownload(){
	alert('สร้างไฟล์  PDF สำเร็จ');
	$("#title").text("สร้างไฟล์  PDF สำเร็จ");
	$("#show_file").show();
}
</script>
@stop

