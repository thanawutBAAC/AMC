<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");	

	connect();

	$sql = " SELECT BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
	$sql.=" BaseReportDetail.report_detail_unit,  ";
	$sql.=" Temp04.target_value, Temp05.target_value, ";
	$sql.=" Temp06.target_value, Temp07.target_value, ";
	$sql.=" Temp08.target_value, Temp09.target_value, ";
	$sql.=" Temp10.target_value, Temp11.target_value, ";
	$sql.=" Temp12.target_value, Temp01.target_value, ";
	$sql.=" Temp02.target_value, Temp03.target_value ";
	$sql.=" FROM TargetProduct, BaseReportDetail  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='1')AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='2')AS Temp02  ";
	$sql.=" ON Temp02.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='3')AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='4')AS Temp04  ";
	$sql.=" ON Temp04.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='5')AS Temp05  ";
	$sql.=" ON Temp05.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='6')AS Temp06  ";
	$sql.=" ON Temp06.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='7')AS Temp07  ";
	$sql.=" ON Temp07.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='8')AS Temp08  ";
	$sql.=" ON Temp08.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='9')AS Temp09 ";
	$sql.=" ON Temp09.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='10')AS Temp10  ";
	$sql.=" ON Temp10.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='11')AS Temp11  ";
	$sql.=" ON Temp11.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT report_detail_code, target_value ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND amccode='".$temp_amccode."' AND target_month='12')AS Temp12  ";
	$sql.=" ON Temp12.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" WHERE (BaseReportDetail.report_group_code='3' OR BaseReportDetail.report_group_code='8') ";
	$sql.=" AND TargetProduct.report_detail_code=BaseReportDetail.report_detail_code  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

	$result_report =	query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- ******************************************************* -->
<form action="target_tris_detail_sql.php" method="post" OnSubmit=" return check_submit(); ">
<table width="1390" align="center" class="gridtable" style="margin-top:5px; margin-bottom:7px;">
	<tr height="25"><td colspan="16">
	<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> ข้อมูลกำหนดเป้าหมาย Tris ราย สกต <?=trim($temp_name); ?>ประจำปี <?=$year; ?></b></center></font>
	</td></tr>
	<tr class="rows_pink">
		<td align="center" width="60"> ลำดับที่ </td>
		<td align="center" width="190"> ชื่อผลผลิต </td>
		<td align="center" width="80"> เม.ย. </td>
		<td align="center" width="80"> พ.ค. </td>
		<td align="center" width="80"> มิ.ย. </td>
		<td align="center" width="80"> ก.ค. </td>
		<td align="center" width="80"> ส.ค. </td>
		<td align="center" width="80"> ก.ย. </td>
		<td align="center" width="80"> ต.ค. </td>
		<td align="center" width="80"> พ.ย. </td>
		<td align="center" width="80"> ธ.ค. </td>
		<td align="center" width="80"> ม.ค. </td>
		<td align="center" width="80"> ก.พ. </td>
		<td align="center" width="80"> มี.ค. </td>
		<td align="center" width="100"> รวมทั้งปี </td>
		<td align="center" width="80"> หน่วยนับ </td>
	</tr>
<?php
	$i=0;
	$temp_name='';   // เก็บข้อมูลรหัสผลผลิตที่เลือกไว้ 
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
		<td align="center"><input type="text" size="7" maxlength="7" id="4x<?=trim($result_fetch[0]); ?>" name="4x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[3]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="5x<?=trim($result_fetch[0]); ?>" name="5x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[4]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="6x<?=trim($result_fetch[0]); ?>" name="6x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[5]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="7x<?=trim($result_fetch[0]); ?>" name="7x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[6]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="8x<?=trim($result_fetch[0]); ?>" name="8x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[7]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="9x<?=trim($result_fetch[0]); ?>" name="9x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[8]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="10x<?=trim($result_fetch[0]); ?>" name="10x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[9]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>		
		<td align="center"><input type="text" size="7" maxlength="7" id="11x<?=trim($result_fetch[0]); ?>" name="11x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[10]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="12x<?=trim($result_fetch[0]); ?>" name="12x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[11]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="1x<?=trim($result_fetch[0]); ?>" name="1x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[12]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>		
		<td align="center"><input type="text" size="7" maxlength="7" id="2x<?=trim($result_fetch[0]); ?>" name="2x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[13]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="3x<?=trim($result_fetch[0]); ?>" name="3x<?=trim($result_fetch[0]); ?>" value="<?=number_format(trim($result_fetch[14]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>

		<td align="center"><input type="text" size="7" maxlength="7"  id="sumx<?=trim($result_fetch[0]); ?>" name="sumx<?=trim($result_fetch[0]); ?>" class="txt_num_system" readonly></td>
		<td align="center"><?=trim($result_fetch[2]); ?></td>
	</tr>
<?php
	$temp_name=$temp_name.trim($result_fetch[0])."#";
	}  // end while
 ?>
</table>
<div style="margin-left=150">
	<font color='red'><b>หมายเหตุ : </font> ข้อมูลห้ามมีช่องว่าง ถ้าไม่ทราบกรุณาป้อน 0 </b>
</div>
<input type="hidden" name="temp_amccode" value="<?=trim($temp_amccode) ?>">
<input type="hidden" name="year" value="<?=$year; ?>">
<br>
<center><input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก "></center>
</form>
<!-- ****************************************************************************************** -->
<!--   สร้าง function javascript  ตรวจสอบการบันทึกข้อมูล -->
<?  	$temp_name = substr($temp_name, 0, -1); //  ไม่เอาตัว # สุดท้ายมา    ?>
<script language="JavaScript">

function update_data()
{
	var Data = "<?=$temp_name ?>";
	var Array_Temp=Data.split("#");
	var Array_Max=Array_Temp.length;
	var sum_target=0;
	for(i=0;i<Array_Max;i++)
	{
		sum_target=0;
		for(j=1;j<=12;j++)
		{
			temp_01 = document.getElementById(j+"x"+Array_Temp[i]);
			sum_target=sum_target+parseInt(temp_01.value);
		}
		document.getElementById("sumx"+Array_Temp[i]).value = sum_target;
	}
}

function check_submit()
{
	var temp_false = false;
	var temp_01;
	var Data = "<?=$temp_name ?>";
	var Array_Temp=Data.split("#");
	var Array_Max=Array_Temp.length;
	for(i=0;i<Array_Max;i++)
	{
		for(j=1;j<=12;j++)
		{
			temp_01 = document.getElementById(j+"x"+Array_Temp[i]);
			if(temp_01.value.length==0)
			{
				temp_false = true;		
			}
		}
	}
	// กรณีที่มีค่าว่างไม่อนุญาตให้แสดงข้อมูล
	if(temp_false==true) {
		alert(' กรุณาป้อนข้อมูลตัวเลขให้ครบทุกช่อง ');
		return false;
	}
	if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล ")) {
		return true;
	}
	else {
		return false; 
	}
} // end function
</script>
<!--  ปรับปรุงข้อมูล -->
<script language="JavaScript">
	update_data();    //  ปรับปรุงข้อมูล
</script>
<!-- ************************************************************************************** -->
<?  free_result($result_report);   
	close();   ?>
</body>
</html>
<?php
	include("../footer.php")
?>