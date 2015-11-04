<?php  session_start();
	include("./lib/database.php");
	include("./lib/config.inc.php");
	connect();
?>

<HTML>
<HEAD>
<TITLE><?=$webSite['title'] ?></TITLE>
<?=$webSite['meta']; ?>
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<?
// ตรวจสอบการแสดงข้อความหน้าแรก
	$filename = "doc/message.txt";
	$handle = fopen($filename, "r");
	if( filesize($filename)==0)
	{	$contents[0] = "0";
		$contents[1] = ""; }
	else
	{	$contents = fread($handle, filesize($filename));
		$contents = explode("#", $contents);  }
	fclose($handle);
	
	if($contents[0]==1){
		print "<script>alert( '".$contents[1]."' );</script>";
	}
// สิ้นสุดการการตรวจสอบข้อความ

// ตรวจสอบเดือน  ปี เพื่อปรับปรุงข้อมูล
if(date("n")=='1' OR date("n")=='2' OR date("n")=='3'){
	$year=date("Y")+542;
}
else{
	$year=date("Y")+543;
}  // end date

$sql = " SELECT report_month FROM  ReportMonth ";
$sql.=" WHERE report_month = '".date("n")."' AND report_year='".$year."' ";
if(num_rows(query($sql))==0)
{
	$sql =" INSERT INTO ReportMonth (report_month, report_year, report_sent) ";
	$sql.=" VALUES ('".date("n")."','".$year."','0')";
	query($sql);  
}
close();

// สิ้นสุดการตรวจสอบ เดือน ปี 		
//  print '<script>window.location.href = "main.php";</script>';
?>

</HEAD>
<script language="JavaScript">
status="<?=$webSite['copyright'] ?>";
	function check_submit()
	{
		if (frm_login.code.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูล User ID เข้าใช้งาน ');
			frm_login.code.focus();
			return false;
		}
		if(frm_login.name.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูล Password เข้าใช้งาน ');
			frm_login.name.focus();
			return false;
		}
			return true;
	}
</script> 
<body onload="document.frm_login.code.focus();">
<!--  แสดง logo หน้าแรก -->
<br><br>
<hr width="750" align="center" color="#4E82B1">
<table width='750'   align='center' cellpadding="0" cellspacing="0" height='60'>
	<tr bgcolor='#75B33F'>
		<td align='right'><img src="images/amc.jpg" width="50" height="50" ></td>
		<td align="center" valign="absbottom">
			<br>
			<h3><font color='#FFFFFF'><b>ระบบบริหารข้อมูลสหกรณ์การเกษตรเพื่อการตลาด ลูกค้า ธกส. (สกต.)</b></font></h3>
		</td>
	</tr>
</table>
<hr width="750" align="center" color="#4E82B1">
<br>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td height="4" width="4" align="left"><img src="images/border_01.gif"></td>
		<td height="4" background="images/border_02.gif" ></td>
		<td height="4" width="4" align="right"><img src="images/border_03.gif"></td>
	</tr>
	<tr>
		<td width="4" align="left" background="images/border_04.gif"></td>
		<td align="center">
			<table width="100%" cellpadding="2" cellspacing="1" border="0">
			<!-- ************************************************************************************** -->
			<form name="frm_login" method="post" action="main.php" onsubmit=" return check_submit();" >
			<tr bgcolor="#75B33F">
				<td height="30"  align="center" colspan='2'><font color='#FFFFFF'><b> Login เข้าใช้งานโปรแกรม </b></font></td>
			</tr>
			<tr class="rows_grey">
				<td align="right" width='150'> User ID : </td>
				<td align="left" width='150'><input name="code" type="text" maxlength="8" class="txt_string" size="10" value=""></td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> Password : </td>
				<td align="left"><input name="name" type="password" AUTOCOMPLETE="off" maxlength="8" class="txt_string" size="10" value=""></td>
			</tr>
			<tr class="rows_grey">
				<td colspan="2" align="center"> 
					<input type="hidden" name="click" value="<?=$click; ?>">
					<input type="submit" value=" Login เข้าใช้ " >&nbsp;<input type="reset" value="ยกเลิก"> 
				</td>
			</tr>
			<tr class="rows_grey">
				<td colspan="2" align="center"> 
					<a href="main.php?user_blank=blank"> เข้าใช้งานไม่มีรหัสผ่าน </a>
				</td>
			</tr>
			</form>
			<!-- ************************************************************************************** -->
			</table>
		</td>
		<td width="4" align="right" background="images/border_05.gif"></td>
	</tr>
	<tr>
		<td height="4" width="4" align="left"><img src="images/border_06.gif"></td>
		<td height="4" background="images/border_07.gif" ></td>
		<td height="4" width="4" align="right"><img src="images/border_08.gif"></td>
	</tr>
</table>
<br>
<div align="center"><font color="red"> ใช้ข้อมูล User ID และ Password จากระบบบริหารคุณภาพ ISO </font></div>
<div align="center"><font color="red"> กรณีไม่มีรหัสผ่านสามารถเข้าใช้งานได้ <a href="main.php?user_blank=blank">ที่นี่</a></font></div>
<br>
<hr width="70%" align="center" color="#4E82B1">
<div align="center"><? echo $webSite['footer']; ?></div>
<!-- ******************************************************************************** -->
</body>
</HTML>