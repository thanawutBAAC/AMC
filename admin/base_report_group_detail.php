<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$click = trim($_GET["click"]);
	$type = 0;
	if($click=='edit')
	{		
		$code = $_GET["code"];
		$name = trim($_GET["name"]);
		$comment = trim($_GET["comment"]);
		$type = trim($_GET["type"]);
		$header_name = " แก้ไขข้อมูลหัวข้อรายงาน ";
	}
	else{
		print '<script>alert(" การเลือกข้อมูลไม่ถูกต้อง ");</script>';
		print '<script>window.location.href = "base_report_group.php";</script>';
	}

	connect();
	$sql=" SELECT  report_group_code, report_group_name, report_group_type, report_group_comment ";
	$sql.=" FROM  BaseReportGroup ORDER BY report_group_code ";
	$result_report_group = query($sql);

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
		if (frm_report_group.code.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลรหัสหัวรายงาน ');
			frm_report_group.code.focus();
			return false;
		}
		else if (frm_report_group.name.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลชื่อหัวรายงาน ');
			frm_report_group.name.focus();
			return false;
		}
		else if(frm_report_group.comment.value.length>300)
		{
			alert(' กรุณาบันทึกข้อมูลท้ายตารางน้อยกว่า 300 ตัวอักษร ');
			frm_report_group.comment.focus();
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
<body onload=" frm_report_group.name.focus(); ">
<?php
	include("../manu_bar.php");
?>
	<table   width="550" align="center" class="gridtable" style="margin-top:25px;">
		<tr><td colspan="3"><font color="#0F7FAF"><center><b> ข้อมูลหัวข้อรายงาน </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="70"> รหัส </td>
			<td align="center" width="480"> ชื่อหัวข้อรายงาน </td>
		</tr>
		<?php
			$temp_type = "";
			$temp_comment = "";
			WHILE($result_fetch  = fetch_row($result_report_group))
			{  ?>
			<tr>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="left">&nbsp;<?=$result_fetch[1]; ?></td>
			</tr>
			<tr class='rows_green'>
				<td align="right"><font color="#0F7FAF">คำอธิบาย</font>&nbsp;</td>
			<? if(trim($result_fetch[3])=="")
					$temp_comment = "-";
				else
					$temp_comment = $result_fetch[3];
			?>
				<td align="left">&nbsp;<?=$temp_comment; ?></td>
			</tr>
			<tr bgcolor="#FFFFE1">
				<td align="right"><font color="#0F7FAF">เชื่อมโยง</font>&nbsp;</td>
			<? if(trim($result_fetch[2])=="0")
						$temp_type = "ไม่มีการเชื่อมโยงตารางผลผลิต";
				else
						$temp_type = "มีการเชื่อมโยงตารางผลผลิต";
			?>
				<td align="left">&nbsp;<?=$temp_type; ?></td>
			</tr>
		<?php
			} // end while
		?>
	</table>
<br><br>
<!-- ************************ ปรับปรุงข้อมูลกลุ่มผลผลิตหลัก **************************-->
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
			<form name="frm_report_group" method="post" action="base_report_group_sql.php" onsubmit=" return check_submit(); " >
			<caption>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
				<img src="../icons/application_edit.png" alt=" ลบข้อมูล " class="images_icon" >
				</span>&nbsp;
			<strong><font color="#0F7FAF"><?=$header_name; ?></font></strong>
			</caption>
			<tr class="rows_grey">
				<td align="right"> รหัสหัวข้อรายงาน : </td>
				<td align="left"><input name="code" type="text" maxlength="1" class="txt_system" size="3" value="<?=$code; ?>" 
				readonly  onKeyPress="return isNumberKey(this); "> ห้ามซ้ำ</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> ชื่อหัวข้อรายงาน : </td>
				<td align="left"><input name="name" type="text" maxlength="100" class="txt_string" size="50" value="<?=$name; ?>"></td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> คำอธิบาย : </td>
				<td align="left">
					<textarea name="comment" rows="8" cols="43" class="editor"><?=$comment; ?></textarea>
				</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> เชื่อมโยงตารางผลผลิต : </td>
				<td>
					<input type="radio" name="type" value="1" <? if($type==1) echo "checked"; ?>> เชื่อมโยง 
					<input type="radio" name="type" value="0" <? if($type==0) echo "checked"; ?>> ไม่เชื่อมโยง 
				</td>
			</tr>
			<tr class="rows_grey">
				<td colspan="2" align="center"> 
					<input type="hidden" name="click" value="<?=$_GET["click"]; ?>">
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
<!-- ********************************************************************** -->
</body>
</html>
<?php
	free_result($result_report_group);
	close();
	include("footer.php")
?>
