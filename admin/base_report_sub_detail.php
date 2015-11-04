<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$click = trim($_GET["click"]);
	if($click=='add')
	{		
		$code = $new_row+1;
		$name = "";
		$unit = "";
		$header_name = " เพิ่มข้อมูลหัวข้อรายงาน ";
	}
	else{
		$group = $_GET["group"];
		$code = $_GET["code"];
		$name = trim($_GET["name"]);
		$unit = trim($_GET["unit"]);
		$header_name = " แก้ไขข้อมูลหัวข้อรายงาน ";
	}
	connect();
	$sql=" SELECT  report_group_code, report_detail_code, report_detail_name, report_detail_unit FROM BaseReportDetail ";
	$sql.=" ORDER BY report_group_code, report_detail_code ";
	$result_report_sub = query($sql);
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">
	function check_submit()
	{
		if (frm_report_sub.code.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลรหัสรายงาน ');
			frm_report_sub.code.focus();
			return false;
		}
		else if (frm_report_sub.name.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลชื่อรายงาน ');
			frm_report_sub.name.focus();
			return false;
		}
		else if (frm_report_sub.unit.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลหน่วยนับ ถ้าไม่ทราบป้อน - ');
			frm_report_sub.unit.focus();
			return false;
		}
		if (confirm(" กรุณายืนยันการทำงาน ")) {
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
</head>
<body onload=" frm_report_sub.name.focus(); ">
<?php
	include("../manu_bar.php");
?>
<table  width="570" align="center" class="gridtable" style="margin-top:25px">
	<tr><td colspan="4"><font color="#0F7FAF"><center><b> ข้อมูลรายงานประจำเดือน </b></center></font></td></tr>
	<tr class="rows_pink">
		<td align="center" width="70"> หัวข้อ </td>
		<td align="center" width="70"> รหัส </td>
		<td align="center" width="350"> รายละเอียด </td>
		<td align="center" width="80"> หน่วยนับ </td>
	</tr>
	<?php
		$i=0;
		$temp_close1 = "";
		$temp_close2 = "";
		WHILE($result_fetch  = fetch_row($result_report_sub))
		{
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
			if(trim($temp_close1)==$result_fetch[0])
			{		$temp_close2="";	}
			else
			{		$temp_close1 = $result_fetch[0];
					$temp_close2 = "ข้อที่ ".$result_fetch[0];				}
			?>
				<td align="center"><font color="#0F7FAF"><?=$temp_close2; ?></font></td>
				<td align="center"><?=trim($result_fetch[1]); ?></td>
				<td align="left">&nbsp;<?=trim($result_fetch[2]); ?></td>
				<td align="center"><?=trim($result_fetch[3]); ?></td>
		</tr>
		<?php
			}  // end while
			free_result($result_report_sub);
		?>
	</table>
<br><br>
<!-- ************************ ปรับปรุงข้อมูลรายงาน**************************-->
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td height="4" width="4" align="left"><img src="../images/border_01.gif"></td>
		<td height="4" background="../images/border_02.gif" ></td>
		<td height="4" width="4" align="right"><img src="../images/border_03.gif"></td>
	</tr>
	<tr>
		<td width="4" align="left" background="../images/border_04.gif"></td>
		<td align="center">
			<table width="100%" cellpadding="2" cellspacing="1" border="0">
			<form name="frm_report_sub" method="post" action="base_report_sub_sql.php" onsubmit=" return check_submit(); " >
			<caption>
			<?
			if($click=='add')
			{	?>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
				<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
				</span>
			<? }
			else
			{ ?>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
				<img src="../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
				</span>
			<? } ?>&nbsp;
			<strong><font color="#0F7FAF"><?=$header_name; ?></font></strong>
			</caption>
			<tr class="rows_grey">
				<td align="right" width="100"><? if($click=='add') echo 'หัวข้อ'; else echo 'ข้อ '.$group;?> :</td>
				<td align="left" width="400">
				<select name="group" <? if($click=='edit') echo "disabled"; ?> >	 
				<?
					$sql = " SELECT  report_group_code, report_group_name  FROM  BaseReportGroup ";
					if($group<>3)
					{	$sql.= " WHERE  report_group_type='0' ";	}
					$result_group = query($sql);
					WHILE($fetch_group = fetch_row($result_group))
					{	?>
					<option value="<?=$fetch_group[0];?>" <? if($group==$fetch_group[0]) echo "selected "; ?>>
					<?=trim($fetch_group[1]);?></option>
				<? } // end while
					free_result($result_group);
				?>
				</select>		
				</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> รหัสรายงาน : </td>
				<td align="left"><input name="code" type="text" maxlength="2" class="txt_system" size="4" value="<?=$code; ?>" 
				<? if($click=='edit') echo "readonly"; ?>  onKeyPress="return isNumberKey(this); "> ห้ามซ้ำแต่ละข้อ</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> ชื่อรายงาน : </td>
				<td align="left"><input name="name" type="text" maxlength="100" class="txt_string" size="45" value="<?=$name; ?>"></td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> หน่วยนับ : </td>
				<td align="left"><input name="unit" type="text" maxlength="10" class="txt_string" size="10" value="<?=$unit; ?>"></td>
			</tr>
			<tr class="rows_grey">
				<td colspan="2" align="center"> 
					<input type="hidden" name="click" value="<?=$_GET["click"]; ?>">
					<? if(trim($_GET["click"])=='edit') { ?>
					<input type="hidden" name="group" value="<?=$group; ?>">
					<? } ?>
					<input type="submit" value="บันทึกข้อมูล" onsubmit>&nbsp;<input type="reset" value="ยกเลิก"> 
				</td>
			</tr>
			</form>
			</table>
		</td>
		<td width="4" align="right" background="../images/border_05.gif"></td>
	</tr>
	<tr>
		<td height="4" width="4" align="left"><img src="../images/border_06.gif"></td>
		<td height="4" background="../images/border_07.gif" ></td>
		<td height="4" width="4" align="right"><img src="../images/border_08.gif"></td>
	</tr>
</table>
<!-- ******************************************************************************** -->
</body>
</html>
<?php
	close();
	include("footer.php")
?>
