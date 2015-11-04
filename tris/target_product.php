<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');

	connect();
	//  แสดงข้อมูลสินค้าที่สามารถกระจายเป้าได้ทั้งหมด หมวดที่ 3 8
	$sql = " SELECT BaseReportDetail.report_detail_code,BaseReportDetail.report_detail_name, ";
	$sql.=" BaseReportDetail.report_detail_unit, Temp01.target_check, Temp01.target_kpi ";
	$sql.=" FROM BaseReportDetail ";
	$sql.="  LEFT JOIN (  ";
	$sql.="	SELECT report_detail_code, target_check, target_kpi  ";
	$sql.="    FROM TargetProduct ";
	$sql.="  )AS Temp01 ON Temp01.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" WHERE report_group_code='3' OR report_group_code='8' ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code ";

	$result_report = query($sql);
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<!-- ******************************************************************************* -->
<script language="JavaScript">
// ยืนยันก่อนปรับปรุงข้อมูล		
	function check_submit()
	{
		if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล ")) 
			return true;
		else
			return false; 
	}
</script>
<form name="" method="post" action="target_product_sql.php" OnSubmit=" return check_submit(); ">
<table  width="530" align="center" class="gridtable" style="margin-top:5px;">
<tr height="25" bgcolor="#59A7C8">
	<td colspan="5"><center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_view_list.png');" class="span_icon">
	<img src="../icons/application_view_list.png" alt=" รายการ " class="images_icon" >
	</span>&nbsp;<font color="#FFFFFF"><strong>รายการรวบรวมผลิตผล</strong></font>
	</td>
</tr>
<tr class="rows_pink">
	<td align="center" width="70"> ลำดับที่ </td>
	<td align="center" width="180"> ชื่อผลิตผล </td>
	<td align="center" width="80"> หน่วยนับ </td>
	<td align="center" width="100">
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/accept.png');" class="span_icon">
		<img src="../icons/accept.png" alt=" เลือก " class="images_icon" >
		</span>&nbsp;เลือก 
	</td>
	<td align="center" width="100"><img src="../images/kpi.gif" valign="baseline"> แสดง KPI</td>
</tr>
<?php
	$i=0;
	WHILE($result_fetch = fetch_row($result_report))
	{
		$i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
		?>
		<td align="center"><?=$i; ?></td>
		<td align="left">&nbsp;<?=trim($result_fetch[1]); ?></td>
		<td align="center"><?=trim($result_fetch[2]); ?></td>
		<? if(is_null($result_fetch[3]) or trim($result_fetch[3]=="") )   // ตรวจสอบว่ารายการนี้ได้ถูกเลือกแล้วหรือยัง 
				$ans_check = "";
			else
				$ans_check = "checked";
			?>
		<td align="center"><input type="checkbox" name="x<?=trim($result_fetch[0]); ?>" value="1" <?=$ans_check; ?>></td>
		<? if(is_null($result_fetch[4]) or trim($result_fetch[4])=="")
				$ans_kpi = "";
			else
				$ans_kpi = "checked";
		?>		
		<td align="center">
			<input type="checkbox" name="y<?=trim($result_fetch[0]); ?>" value="1" <?=$ans_kpi; ?>>
		</td>
	</tr>
<?php
		}  // end while
 ?>
</table>
</body>
<br>
<center><input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก "></center>
</form>
<!-- **************************************************************************** -->
</html>
<?php
	free_result($result_report);
	close();
	include("../footer.php")
?>