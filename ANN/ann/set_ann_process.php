<?php session_start();
  include("../../check_login.php");
  include("../../lib/config.inc.php");
  include("../../lib/database.php");
  connect();

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
<script language="JavaScript" src="FusionCharts.js"></script> 
<script type="text/javascript">
var c=0;
var t;
var timer_is_on=0;

function timedCount()
{
	document.getElementById("txt").innerHTML = c;   
	c=c+1;
	t=setTimeout("timedCount()",1000);
}

function doTimer()
{
	if (!timer_is_on){
		  timer_is_on=1;
		  timedCount();
     }
}

function show_loading(){
		document.getElementById("ajax_loading").style.display = '';
		doTimer();
}
</script>
</head>
<body>
<br>
<!--  เริ่มต้นแสดง chart  -->
<?
	$year_start = trim($_POST['year_start']);                         // ปีที่เริ่มใช้เป็นชุด Train
	$year_stop = trim($_POST['year_stop']);                         // ปีสุดท้ายใช้เป็นชุด Train
	$month_start = trim($_POST['month_start']);                   // เดือนที่เริ่มใช้เป็นชุด Train
	$month_stop = trim($_POST['month_stop']);                   // เดือนสุดท้ายใช้เป็นชุด Train
	$epochs = trim($_POST['epochs']);                                    // จำนวนรอบในการเรียนรู้
	$learn_rate = trim($_POST['learn_rate']);                          // จำนวนค่าต่ำสุดของ อัตราการเรียนรู้  
	$weight_min = trim($_POST['weight_min']);                     // ค่า weight ต่ำสุดที่สามารถสุ่มได้
	$weight_max = trim($_POST['weight_max']);                  // ค่า weight สูงสุดที่สามารถสุ่มได
	$neuron_hidden = trim($_POST['neuron_hidden']);     // จำนวน neuron ในชั้นซ่อน
	$fn_hidden = trim($_POST['fn_hidden']);                         // Activation  function ในชั้นซ่อน
	$fn_output = trim($_POST['fn_output']);                             // Activation  function ในชั้นผลลัพธ์
	$bias_min = trim($_POST['bias_min']);                           // ค่าต่ำสุดของ bias 
	$bias_max = trim($_POST['bias_max']);                         // ค่าสูงสุดของ bias
	$error_threshold = trim($_POST['error_threshold']);    // ค่า error ต่ำสุดที่ยอมรับได้ 
	$p = trim($_POST['p']);															// ค่าผลิตผลที่ต้องการรวบรวม

	$get_value = "year_start=$year_start&year_stop=$year_stop&month_start=$month_start&month_stop=$month_stop&epochs=$epochs&learn_rate=$learn_rate&weight_min=$weight_min";
	$get_value.="&weight_max=$weight_max&neuron_hidden=$neuron_hidden&fn_hidden=$fn_hidden&fn_output=$fn_output&bias_min=$bias_min&bias_max=$bias_max&error_threshold=$error_threshold&p=$p";
	include("create_xml.php");
?>
<!-- สิ้นสุดการแสดง chart  -->
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center"> 
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        Feedforword Multilayer Perceptron </div> 
      <script type="text/javascript"> 
		   var chart = new FusionCharts("DragNode.swf","ChartId","700","500","0","0");
		   chart.setDataURL("Neuron.xml");		   
		   chart.render("chartdiv");
		</script> </td> 
  </tr> 
  <tr><td align='center'>
  <br>
  <form action='process_ann.php' method='get'>
	<input type='hidden' name='year_start' value='<?=$year_start?>'>
	<input type='hidden' name='year_stop' value='<?=$year_stop?>'>
	<input type='hidden' name='month_start' value='<?=$month_start?>'>
	<input type='hidden' name='month_stop' value='<?=$month_stop?>'>
	<input type='hidden' name='epochs' value='<?=$epochs?>'>
	<input type='hidden' name='learn_rate' value='<?=$learn_rate?>'>
	<input type='hidden' name='weight_min' value='<?=$weight_min?>'>
	<input type='hidden' name='weight_max' value='<?=$weight_max?>'>
	<input type='hidden' name='neuron_hidden' value='<?=$neuron_hidden?>'>
	<input type='hidden' name='fn_hidden' value='<?=$fn_hidden?>'>    
	<input type='hidden' name='fn_output' value='<?=$fn_output ?>'>
	<input type='hidden' name='bias_min' value='<?=$bias_min?>'>
	<input type='hidden' name='bias_max' value='<?=$bias_max ?>'>
	<input type='hidden' name='error_threshold' value='<?=$error_threshold?>'>
	<input type='hidden' name='p' value='<?=$p?>'>
     <input type='submit' value=' เริ่มกระบวนการฝึกโครงข่าย ' onclick=' show_loading() '>
  </form>
  </td></tr>
</table> 
<center><img id="ajax_loading" src="../../images/ajax-loading.gif" style="display: none;"></center>
&nbsp;&nbsp;&nbsp; แสดงเวลาประมวลผล : <font color='red'><span id="txt">0.0</span></font>&nbsp;วินาที
</body>
</html>
<?
	include("../footer.php")
?>