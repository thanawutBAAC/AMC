<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	$sql=" SELECT a1, a2, b1, b2, c1, c2, d1, d2, e1, e2 FROM TableKPI ";
	$result_kpi = query($sql);
	$a1 = number_format( result($result_kpi,0,'a1'),0,"","");
	$a2 = number_format( result($result_kpi,0,'a2'),0,"","");
	$b1 = number_format( result($result_kpi,0,'b1'),0,"","");
	$b2 = number_format( result($result_kpi,0,'b2'),0,"","");
	$c1 = number_format( result($result_kpi,0,'c1'),0,"","");
	$c2 = number_format( result($result_kpi,0,'c2'),0,"","");
	$d1 = number_format( result($result_kpi,0,'d1'),0,"","");
	$d2 = number_format( result($result_kpi,0,'d2'),0,"","");
	$e1 = number_format( result($result_kpi,0,'e1'),0,"","");
	$e2 = number_format( result($result_kpi,0,'e2'),0,"","");
?>
<html>
<head>
<title></title>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
	<script language="JavaScript">
		 function check_submit()
		 {		
			if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล ")) {
				return true;
			}
			else {
				return false; 
			}
		 }
	</script>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- ********************************************************** -->
<form name="report" action="base_kpi_sql.php" method="post" onsubmit=" return check_submit(); ">
<table width="400" align="center" class="gridtable" style="margin-top:5px;">
<tr height="25" bgcolor="#59A7C8"><td colspan="4"><font color="#FFFFFF"><center><b> ข้อมูลกลุ่มผลผลิตหลัก </b></center></font></td></tr>
<tr class="rows_pink" height="23">
	<td align="center" width="70"> ลำดับที่ </td>
	<td align="center" width="130"> สี </td>
	<td align="center" width="100"> ช่วงเริ่มต้น % </td>
	<td align="center" width="100"> ช่วงสิ้นสุด % </td>
</tr>
<tr>
	<td align="center" width="70"> 1 </td>
	<td align="center" width="130"> <input type="text" style=" FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr='#DE0101',EndColorStr='#ffffff');" size="8" class="txt_num" readonly></td>
	<td align="center" width="100"><input type="text" name="a1" size="8" maxlength="3" class="txt_num_system" value="0" readonly></td>
	<td align="center" width="100"><input type="text" name="a2" size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$a2?>"></td>
</tr>
<tr class="rows_grey">
	<td align="center"> 2 </td>
	<td align="center"> <input type="text" style=" FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr='#E86517',EndColorStr='#ffffff');" size="8" class="txt_num" readonly></td>
	<td align="center"><input type="text" name="b1" size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$b1?>"></td>
	<td align="center"><input type="text" name="b2" size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$b2?>"></td>
</tr>
<tr>
	<td align="center"> 3 </td>
	<td align="center" > <input type="text" style=" FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr='#D8A302',EndColorStr='#ffffff');"  size="8" class="txt_num" readonly></td>
	<td align="center" ><input type="text" name="c1" size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$c1?>"></td>
	<td align="center" ><input type="text" name="c2" size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$c2?>"></td>
</tr>
<tr>
	<td align="center" > 4 </td>
	<td align="center" > <input type="text" style=" FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr='#749A01',EndColorStr='#ffffff');"  size="8" class="txt_num" readonly></td>
	<td align="center" ><input type="text" name="d1" size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$d1?>"></td>
	<td align="center" ><input type="text" name="d2"size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$d2?>"></td>
</tr>
<tr class="rows_grey">
	<td align="center" > 5 </td>
	<td align="center" > <input type="text" style=" FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr='#456FEF',EndColorStr='#ffffff');"   size="8" class="txt_num" readonly></td>
	<td align="center" ><input type="text" name="e1"size="8" maxlength="3" class="txt_num" onKeyPress="return isNumberKeyMinus(this);" value="<?=$e1?>"></td>
	<td align="center" ><input type="text" name="e2" size="8" maxlength="3" class="txt_num_system" value="100" readonly></td>
</tr>
</table>
<br>
<center>
<input name="click" type="hidden" value="<?=$click; ?>">
<input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก ">
</center>
</form>
<!-- *********************************************************************** -->
</body>
</html>
<?php
	close();
	include("footer.php")
?>