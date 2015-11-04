<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	// แสดงข้อมูลผลผลิตที่รวบรวมทั้งหมด
	$sql =" SELECT  BaseProduct.pro_code, BaseProduct.pro_name, ";
	$sql.=" BaseMainProduct.main_pro_name, BaseSubProduct.sub_pro_name, BaseProduct.pro_unit ";
	$sql.=" FROM    BaseProduct,BaseSubProduct,BaseMainProduct ";
	$sql.=" WHERE  BaseProduct.sub_pro_code = BaseSubProduct.sub_pro_code AND ";
	$sql.=" BaseSubProduct.main_pro_code = BaseMainProduct.main_pro_code ";
	$sql.=" ORDER BY BaseMainProduct.main_pro_code, BaseSubProduct.sub_pro_code ";
	$result_product = query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">
//**** แสดงรายชื่อกลุ่มผลิตผลทั้งหมด ***//
function ListSubProduct(SelectValue)
{
	frm_product.sub_product.length = 0
//	var myOption = new Option('','') 
//	frm_product.sub_product.options[frm_product.sub_product.length]= myOption
	<?
	$i = 0;
	$sql = " SELECT sub_pro_code, sub_pro_name, main_pro_code FROM BaseSubProduct ";
	$result_sub_product = query($sql);
	while($fetch_sub_product = fetch_row($result_sub_product))
	{
		$i++;
	?> 
		x=<?=$i;?>;
		mySubList = new Array();
		mySubList[x,0]="<?=trim($fetch_sub_product[0]);?>";
		mySubList[x,1]="<?=trim($fetch_sub_product[1]);?>";
		mySubList[x,2]=<?=trim($fetch_sub_product[2]);?>;
		if (mySubList[x,2] == SelectValue)
		{
			var myOption = new Option(mySubList[x,1], mySubList[x,0])  // item  |  value
			frm_product.sub_product.options[frm_product.sub_product.length]= myOption 
		}
<?
	} // end while
?> 
}  // end function
	function check_submit()
	{
		if (frm_product.main_product.value.length==0)
		{
			alert(' กรุณาเลือกข้อมูลกลุ่มผลผลิต ');
			frm_product.main_product.focus();
			return false;
		}
		else if (frm_product.sub_product.value.length==0)
		{
			alert(' กรุณาเลือกข้อมูลผลผลิตหลัก ');
			frm_product.sub_product.focus();
			return false;
		}
		else if (frm_product.code.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลรหัสกลุ่มผลผลิต ');
			frm_product.code.focus();
			return false;
		}
		else if (frm_product.name.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลชื่อกลุ่มผลผลิต ');
			frm_product.name.focus();
			return false;
		}
		else if (frm_product.unit.value.length==0)
		{
			alert(' กรุณาบันทึกข้อมูลหน่วยนับ  ถ้าไม่มีใส่เครื่องหมาย -  ');
			frm_product.unit.focus();
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
<body onload=" frm_product.name.focus(); ">
<?php
	include("../manu_bar.php");
?>
	<table  width="560" align="center" class="gridtable" style="margin-top:25px" >
		<tr><td colspan="5"><font color="#0F7FAF"><center><b> ข้อมูลรายละเอียดผลผลิต </b></center></font></td></tr>
		<tr class="rows_pink">
				<td align="center" width="120"> กลุ่มผลผลิตหลัก </td>
				<td align="center" width="120"> ผลผลิตหลัก </td>
				<td align="center" width="80"> รหัส </td>
				<td align="center" width="150"> ชื่อรายละเอียดผลผลิต </td>
				<td align="center" width="90"> หน่วยนับ </td>
		</tr>
		<?php
			$i=0;
			$temp_main1 = "";
			$temp_main2 = "";
			$temp_sub1 = "";
			$temp_sub2 = "";
			WHILE($fetch_product  = fetch_row($result_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
				if($temp_main1==trim($fetch_product[2]))
					{	$temp_main2 = "";	 }
				else
					{	$temp_main1 = trim($fetch_product[2]);
						$temp_main2 = trim($fetch_product[2]); }
				if($temp_sub1==trim($fetch_product[3]))
					{	$temp_sub2 = "";	 }
				else
					{	$temp_sub1 = trim($fetch_product[3]);
						$temp_sub2 = trim($fetch_product[3]); }
			?>
				<td align="left">&nbsp;<?=$temp_main2; ?></td>
				<td align="left">&nbsp;<?=$temp_sub2; ?></td>
				<td align="center"><?=$fetch_product[0]; ?></td>
				<td align="left">&nbsp;<?=trim($fetch_product[1]); ?></td>
				<td align="center"><?= trim($fetch_product[4]);?></td>
		</tr>
		<?php
			} // end while
			free_result($result_product);
		?>
		</table>
<br><br>
<!-- ************************ ปรับปรุงข้อมูลรายละเอียดผลผลิต *************************************-->
<?php
		$click = escapeshellcmd(trim($_GET["click"]));
		if($click=='edit')
		{		
			$code = escapeshellcmd($_GET["code"]);
			$name = escapeshellcmd(trim($_GET["name"]));
			$unit = escapeshellcmd(trim($_GET["unit"]));
			$header_name = " แก้ไขข้อมูลรายละเอียดผลผลิต ";
		}
		else
		{
			$code = $new_row+1;
			$name = "";
			$unit = "";
			$header_name  = " เพิ่มข้อมูลรายละเอียดผลผลิต ";
		}
?>
<table width="380" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td height="4" width="4" align="left"><img src="../images/border_01.gif"></td>
		<td height="4" background="../images/border_02.gif" ></td>
		<td height="4" width="4" align="right"><img src="../images/border_03.gif"></td>
	</tr>
	<tr>
		<td width="4" align="left" background="../images/border_04.gif"></td>
		<td align="center">
			<table width="100%" cellpadding="2" cellspacing="1" border="0" bordercolor="">
			<form name="frm_product" method="post" action="base_product_sql.php" onsubmit=" return check_submit(); " >
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
				<td align="right" width='200'> ข้อมูลกลุ่มผลผลิตหลัก : </td>
				<td align="left"  width='180'>
				<select name="main_product" onClick = "ListSubProduct(this.value)">
				<? 
					$sql=" SELECT main_pro_code, main_pro_name FROM BaseMainProduct ";
					$result_main_product = query($sql);
					While($result_main =  fetch_row($result_main_product)) 
					{  ?>
						<option value="<?=trim($result_main[0]); ?>" ><?=$result_main[1]; ?></option>	
				<? } // end while
					free_result($result_main_product);
					?>
				</select>
				</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> ข้อมูลผลผลิตหลัก : </td>
				<td align="left"><select name="sub_product" id="sub_product" ></select></td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> รหัสรายละเอียดผลผลิต : </td>
				<td align="left"><input name="code" type="text" maxlength="3" class="txt_system" size="4" 
				<? if($click=='edit') echo "readonly"; ?> onKeyPress="return isNumberKey(this); " value="<?=$code; ?>"> ห้ามซ้ำ</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> ชื่อรายละเอียดผลผลิต : </td>
				<td align="left"><input name="name" type="text" maxlength="20" class="txt_string" size="20" value="<?=$name; ?>"></td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> หน่วยนับ : </td>
				<td align="left"><input name="unit" type="text" maxlength="10" class="txt_string" size="10" value="<?=$unit; ?>"></td>
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
<!-- ******************************************************************************** -->
</body>
</html>
<?php
	close();
	include("footer.php")
?>
