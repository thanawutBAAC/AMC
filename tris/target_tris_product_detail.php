<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$sql = " SELECT userlogin.br_code,userlogin.userdetail,  ";
	$sql.=" userlogin.amccode,userlogin.amcprovince , ";
	$sql.=" Temp04.target_value, Temp05.target_value, ";
	$sql.=" Temp06.target_value, Temp07.target_value, ";
	$sql.=" Temp08.target_value, Temp09.target_value, ";
	$sql.=" Temp10.target_value, Temp11.target_value, ";
	$sql.=" Temp12.target_value, Temp01.target_value, ";
	$sql.=" Temp02.target_value, Temp03.target_value ";
	$sql.=" FROM userlogin  ";

	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='1' )AS Temp01  ";
	$sql.=" ON Temp01.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='2' )AS Temp02  ";
	$sql.=" ON Temp02.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='3' )AS Temp03 ";
	$sql.=" ON Temp03.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='4' )AS Temp04  ";
	$sql.=" ON Temp04.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='5' )AS Temp05  ";
	$sql.=" ON Temp05.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='6' )AS Temp06  ";
	$sql.=" ON Temp06.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='7' )AS Temp07  ";
	$sql.=" ON Temp07.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='8' )AS Temp08  ";
	$sql.=" ON Temp08.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='9' )AS Temp09  ";
	$sql.=" ON Temp09.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='10' )AS Temp10  ";
	$sql.=" ON Temp10.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='11' )AS Temp11  ";
	$sql.=" ON Temp11.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='12' )AS Temp12  ";
	$sql.=" ON Temp12.amccode = userlogin.amccode  ";

	$sql.=" WHERE userlogin.status='N'  ";
	if($br_code!='all')
	{	
		$sql.=" AND userlogin.br_code='".$br_code."' ";
	}
	$sql.=" ORDER BY userlogin.br_code,userlogin.userdetail ";
	$result_report = query($sql);

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
<!-- *************************************************************** -->
<form name="" action="target_tris_product_sql.php" method="post" Onsubmit=" return check_submit(); ">
<table width="1470" align="center" class="gridtable" style="margin : 5 5 5 5;">
	<tr height="24"><td colspan="17">
	<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> ข้อมูลกำหนดเป้าหมาย <font color="#76B441"><u><?=$report_detail_name; ?></u></font> &nbsp;หน่วยนับ : <font color="#76B441"><u><?=$temp_count; ?></u></font></b>&nbsp;<input type="text" id="sum_total" class="txt_num_system" size="9" value="0" readonly>&nbsp;เป้าหมายรวมทั้งปี</center></font>
	</td></tr>
	<tr class="rows_pink">
		<td align="center" width="60"> ลำดับที่ </td>
		<td align="center" width="200"> รายชื่อ สกต. </td>
		<td align="center" width="150"> ฝ่าย </td>
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
	</tr>
<?php
	$i=0;
	$temp_name = "";  // เก็บข้อมูลชื่อตัวแปรใน javascript
	WHILE($result_fetch = fetch_row($result_report))
	{
		$i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
		?>
		<td align="center"><?=$i; ?></td>
		<td align="left">&nbsp;สกต.<?=trim($result_fetch[1]); ?></td>
		<td align="left">&nbspฝ่ายกิจการสาขา&nbsp;<?=trim($result_fetch[0])?></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="4x<?=trim($result_fetch[3]); ?>" name="4x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[4]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="5x<?=trim($result_fetch[3]); ?>" name="5x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[5]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="6x<?=trim($result_fetch[3]); ?>" name="6x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[6]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="7x<?=trim($result_fetch[3]); ?>" name="7x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[7]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="8x<?=trim($result_fetch[3]); ?>" name="8x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[8]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="9x<?=trim($result_fetch[3]); ?>" name="9x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[9]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="10x<?=trim($result_fetch[3]); ?>" name="10x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[10]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>		
		<td align="center"><input type="text" size="7" maxlength="7" id="11x<?=trim($result_fetch[3]); ?>" name="11x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[11]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="12x<?=trim($result_fetch[3]); ?>" name="12x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[12]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="1x<?=trim($result_fetch[3]); ?>" name="1x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[13]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>		
		<td align="center"><input type="text" size="7" maxlength="7" id="2x<?=trim($result_fetch[3]); ?>" name="2x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[14]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<td align="center"><input type="text" size="7" maxlength="7" id="3x<?=trim($result_fetch[3]); ?>" name="3x<?=trim($result_fetch[3]); ?>" value="<?=number_format(trim($result_fetch[15]),0,'',''); ?>" class="txt_num" onKeyPress=" return isNumberKey(this); " OnKeyUp=" update_data(); "></td>
		<!--  รวม -->
		<td align="center"><input type="text" size="7" maxlength="7"  id="sumx<?=trim($result_fetch[3]); ?>" name="sumx<?=trim($result_fetch[3]); ?>" class="txt_num_system" readonly></td>

		<!-- เก็บค่าตัวแปรชื่อ javascript  -->
		<? 
			$temp_name = $temp_name.trim($result_fetch[3])."#";
		?>
	</tr>
<?php
		}  // end while
?>
</table>
<?  // ปรับปรุงข้อมูลตัวแปร
	$temp_name = substr($temp_name, 0, -1); //  ไม่เอาตัว # สุดท้ายมา    
 ?>
 <!--  สร้าง function javascript ในการจัดการตัวเลข  -->
 <script language="JavaScript">
function update_data()
{
	var Data = "<?=$temp_name ?>";
	var Array_Temp=Data.split("#");
	var Array_Max=Array_Temp.length;
	var sum_target=0;  // เก็บข้อมูลผลรวมของแต่ละ สกต.
	var sum_total=0; // เก็บข้อมูลผลรวมทั้งหมด
	for(i=0;i<Array_Max;i++)
	{
		sum_target=0;
		for(j=1;j<=12;j++)
		{
			temp_01 = document.getElementById(j+"x"+Array_Temp[i]);
			sum_target=sum_target+parseInt(temp_01.value);
			sum_total=sum_total+parseInt(temp_01.value);
		}
		document.getElementById("sumx"+Array_Temp[i]).value = sum_target;
	}
	document.getElementById("sum_total").value = sum_total;
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
<!--  เรียกใช้ function JavaScript ในการปรับปรุงข้อมูลครั้งแรก  -->
<script language="JavaScript">
	update_data();
</script>
<div style="margin-left=110">
	<font color='red'><b>หมายเหตุ : </font> ข้อมูลห้ามมีช่องว่าง ถ้าไม่ทราบกรุณาป้อน 0 </b>
</div>
<input type="hidden" name="br_code" value="<?=trim($br_code) ?>">
<input type="hidden" name="report_detail_code" value="<?=trim($report_detail_code)?>">
<input type="hidden" name="year" value="<?=$year; ?>">
<br>
<center><input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก "></center>
</form>
<!-- *************************************************************** -->
</body>
</html>
<?php
	close();
	include("../footer.php")
?>