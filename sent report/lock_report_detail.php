<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');

	connect();	
?>
<html>
<head>
	<title></title>
	<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<? include("../manu_bar.php"); ?>
<!-- ************************************************************************************************************************************** -->
<form name="frm_lock" action="lock_report_detail_sql.php" method="post" Onsubmit=" return confirm_submit(); ">
<div style=" margin-left:85px;">
<input type="checkbox" name="checkbox_all" OnClick=" checkAll(); ">เลือกทั้งหมด <img src="../images/application_form_edit.gif" style="vertical-align: text-bottom;">
</div>
<table  width="600" align="center" class="gridtable" style="margin-top:5px;">
<tr height="25"><td colspan="5">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> ข้อมูลการส่งรายงานประจำเดือน สกต. <?=trim($temp_name); ?></b></center></font>
</td></tr>
<tr class="rows_pink"> 
	<td align="center" width="100"> ปี </td>
	<td align="center" width="100"> เดือน </td>
	<td align="center" width="150"> วันที่ส่ง </td>
	<td align="center" width="100"> เวลาที่ส่ง </td>
	<td align="center" width="150" > <span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/lock.png');" class="span_icon">
	<img src="../icons/lock.png" alt=" สถานะการป้องกัน " class="images_icon" > 
	</span> &nbsp;สถานะการป้องกัน </td>
</tr>
<?  
	$sql = " SELECT sent_year, sent_month, sent_date, sent_time, sent_status ";
	$sql.=" FROM SentReportHeader ";
	$sql.=" WHERE amccode='".$temp_amccode."' ";
	$sql.=" ORDER BY sent_year, sent_month DESC ";

	$result_report =	query($sql);
	$i=0;
	WHILE( $fetch_report = fetch_row($result_report))
	{  $i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
?>		
	<td align="center"><?=trim($fetch_report[0]); ?></td>
	<td align="left">&nbsp;<?=$month_thai[trim($fetch_report[1])]; ?></td>
	<td align="center"><?=trim($fetch_report[2]); ?></td>
	<td align="center"><?=trim($fetch_report[3]); ?></td>
	<?
		$check_status = '';
		if(trim($fetch_report[4])=='2')
		{	$check_status = 'checked';	}
	?>
	<td align="center"><input type="checkbox" name="i<?=$i;?>" id="i<?=$i; ?>" <?=$check_status; ?> value='2'></td>
	</tr>
<?   } // end while  ?>
</table>
<br>
<input type="hidden" name="temp_amccode"  value="<?=$temp_amccode?>">
<center><input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก "> </center>
</form>
<!-- ************************************************************************************************************************************** -->
<script language="JavaScript">
var array_count="<?=$i?>";
//  เลือกข้อมูลทั้งหมด
	 function checkAll()
	 {
		 for(var j=1;j<=array_count;j++)
		 {
			 box = eval("document.frm_lock.i"+j);
			 if (frm_lock.checkbox_all.checked)
				{	if(box.checked==false) box.checked = true;  }
			 else
				{	if(box.checked==true) box.checked = false;   }
		 }
	 }
</script>

<script language="JavaScript">
		function confirm_submit()
		{
			if (confirm(" กรุณายืนยันการบันทึกข้อมูล ")) {
				return true;
			}
			else
			{
				return false;
			}
		}
	</script>
<?php
	free_result($result_report);
	close();
?>
</body>
</html>
<?
	include("../footer.php")
?>