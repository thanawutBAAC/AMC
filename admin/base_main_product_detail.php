<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	// แสดงข้อมูลกลุ่มผลผลิตทางการเกษตรทั้งหมด
	$sql=" SELECT main_pro_code, main_pro_name FROM BaseMainProduct ";
	$result_main_product = query($sql);

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
		if (frm_main_product.name.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลชื่อกลุ่มผลผลิต ');
			frm_main_product.name.focus();
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
<body onload=" frm_main_product.name.focus(); ">
<?php
	include("../manu_bar.php");
?>
	<table width="250" align="center" class="gridtable" style="margin-top:25px;">
		<tr><td colspan="2"><font color="#0F7FAF"><center><b> ข้อมูลกลุ่มผลผลิตหลัก </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="100"> รหัส </td>
			<td align="center" width="150"> ชื่อกลุ่มผลผลิต </td>
		</tr>
		<?php
			$i=0;
			WHILE($result_fetch  = fetch_row($result_main_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
			?>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="left">&nbsp;<?=$result_fetch[1]; ?></td>
		</tr>
		<?php
			} // end while
		?>
		</table>
<br><br>
<!-- ************************ ปรับปรุงข้อมูลกลุ่มผลผลิตหลัก *************************************************-->
<?php
	$click = trim($_GET["click"]);
	if($click=='edit')
	{		
		$code = escapeshellcmd($_GET["code"]);
		$name = escapeshellcmd(trim($_GET["name"]));
		$header_name = " แก้ไขข้อมูลกลุ่มผลผลิตหลัก ";
	}
	else
	{
		$code = $_GET["new_row"]+1;
		$name = "";
		$header_name  = " เพิ่มข้อมูลกลุ่มผลผลิตหลัก ";
	}
?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td height="4" width="4" align="left"><img src="../images/border_01.gif"></td>
		<td height="4" background="../images/border_02.gif" ></td>
		<td height="4" width="4" align="right"><img src="../images/border_03.gif"></td>
	</tr>
	<tr>
		<td width="4" align="left" background="../images/border_04.gif"></td>
		<td align="center">
			<table width="100%" cellpadding="2" cellspacing="1" border="0">
			<!-- ************************************************************************************** -->
			<form name="frm_main_product" method="post" action="base_main_product_sql.php" onsubmit=" return check_submit(); " >
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
				<td align="right" width='150'> รหัสกลุ่มผลผลิตหลัก : </td>
				<td align="left" width='150'><input name="code" type="text" maxlength="2" class="txt_system" size="4" value="<?=$code; ?>" 
				<? if($click=='edit') echo "readonly"; ?> onKeyPress="return isNumberKey(this); "> ห้ามซ้ำ</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> ชื่อกลุ่มผลผลิตหลัก : </td>
				<td align="left"><input name="name" type="text" maxlength="20" class="txt_string" size="20" value="<?=$name; ?>"></td>
			</tr>
			<tr class="rows_grey">
				<td colspan="2" align="center"> 
					<input type="hidden" name="click" value="<?=$_GET["click"]; ?>">
					<input type="submit" value="บันทึกข้อมูล" >&nbsp;<input type="reset" value="ยกเลิก"> 
				</td>
			</tr>
			</form>
			<!-- ************************************************************************************** -->
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
	free_result($result_main_product);
	close();
	include("footer.php")
?>
