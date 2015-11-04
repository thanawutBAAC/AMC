<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************************** -->
<form name="" action="report_tris.php" method="post">
<center>
<!--  แสดงข้อมูลปี -->
เลือกข้อมูลปีบัญชี
<? $temp_year =  date("Y")+525; ?>
<select name="year" id="year">
<? WHILE($i<20) { 
		$i++; 
		$temp_year = $temp_year+1; ?>
		<option value="<?=$temp_year; ?>" 
		<?  	
		if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
		{
			if($temp_year==date("Y")+542){
				echo "selected";
			}
		}
		else{
			if($temp_year==date("Y")+543){
					echo "selected";
		}
		}  // end date ?> ><?=$temp_year; ?></option>
		<?    } // end while ?>
</select>
เลือกฝ่ายกิจการสาขา
<select name="br_code">
	<option value="all" selected> ทุกฝ่าย </option>
	<option value="1"> ฝ่ายกิจการสาขา 1</option>
	<option value="2"> ฝ่ายกิจการสาขา 2</option>
	<option value="3"> ฝ่ายกิจการสาขา 3</option>
	<option value="4"> ฝ่ายกิจการสาขา 4</option>
	<option value="5"> ฝ่ายกิจการสาขา 5</option>
	<option value="6"> ฝ่ายกิจการสาขา 6</option>
	<option value="7"> ฝ่ายกิจการสาขา 7</option>
	<option value="8"> ฝ่ายกิจการสาขา 8</option>
	<option value="9"> ฝ่ายกิจการสาขา 9</option>
</select>
<input type="hidden" name="click" value="1">
<input type="submit" value=" ค้นหาข้อมูล ">
</center>
</form>
<!-- ************************************************************************************* -->
<? if(isset($click)) { 
	$year = $_POST["year"];
	$br_code = $_POST["br_code"];
	connect();
	//  แสดงข้อมูลสินค้าทั้งหมดที่ เฉพาะรายการได้เลือกไว้ในรายการที่ 3 
	$sql = " SELECT BaseReportDetail.report_detail_code, ";
	$sql.=" BaseReportDetail.report_detail_name, ";
	$sql.=" BaseReportDetail.report_detail_unit, ";
	$sql.=" Temp01.target_value ";
	$sql.=" FROM BaseReportDetail ,TargetProduct  ";
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(target_value)AS target_value,report_detail_code ";
	$sql.=" FROM TargetTris,userlogin ";
	$sql.=" WHERE target_year='".$year."' ";
	$sql.=" AND userlogin.amccode=TargetTris.amccode ";
	if($br_code!='all')
	{
		$sql.=" AND userlogin.br_code='".$br_code."' ";
	}
	$sql.=" GROUP BY report_detail_code)AS Temp01 ";
	$sql.=" ON Temp01.report_detail_code = TargetProduct.report_detail_code ";
	$sql.=" WHERE (BaseReportDetail.report_group_code='3' OR BaseReportDetail.report_group_code='8') ";
	$sql.=" AND TargetProduct.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code ";

	$result_report = query($sql);

?>
<table width="530" align="center" class="gridtable" style="margin-top:5px;">
	<tr height="25"><td colspan="4">
	<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> รายงานข้อมูลการกระจายผลผลิตปี <?=$year?> </b></center></font>
	</td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> ลำดับที่ </td>
		<td align="center" width="250"> รายชื่อ ผลผลิต </td>
		<td align="center" width="100"> ปริมาณกระจาย </td>
		<td align="center" width="100"> หน่วยนับ </td>
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
		<td align="left">&nbsp;<a href="report_tris_detail.php?br_code=<?=trim($br_code)?>&year=<?=$year; ?>&report_detail_name=<?=trim($result_fetch[1]); ?>&report_detail_code=<?=trim($result_fetch[0])?>&temp_count=<?=trim($result_fetch[2])?>"><?=trim($result_fetch[1]); ?></a></td>
		<td align="center"><?=number_format($result_fetch[3],0,'',',')?></td>
		<td align="center"><?=trim($result_fetch[2]); ?></td>
	</tr>
<?php
		}  // end while
 ?>
</table>
<?  free_result($result_report);   
	close();
  } // end if ?>
</body>
</html>
<?php
	include("../footer.php")
?>