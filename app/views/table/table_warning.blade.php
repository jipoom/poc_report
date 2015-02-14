<?php
require_once(public_path().'/mpdf60/mpdf.php');

ini_set('max_execution_time', 300);
ini_set('memory_limit','1024M');
?>
@extends("layout")
@section('styles')
@stop
@section("content")

<h4>สร้างไฟล์ PDF</h4>
<font color="red">ตารางมีขนาดใหญ่เกินไป ไม่สามารถ export ได้</font>

@stop

