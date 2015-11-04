<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	
	connect();
	// แสดงข้อมูลรายชื่อผลผลิตหลักทั้งหมด
	$sql=" SELECT BaseSubProduct.sub_pro_code, BaseSubProduct.sub_pro_name, ";
	$sql.=" BaseMainProduct.main_pro_code, BaseMainProduct.main_pro_name ";
	$sql.=" FROM  BaseSubProduct,BaseMainProduct ";
	$sql.=" WHERE BaseSubProduct.main_pro_code = BaseMainProduct.main_pro_code ";
	$sql.=" ORDER BY BaseSubProduct.main_pro_code, BaseSubProduct.sub_pro_code ";

	$result_sub_product = query($sql);
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>

	<script language="JavaScript">
		function check_submit()
		{
			if (frm_sub_product.name.value.length==0)
			{
				alert(' กรุณาบันทึกข้อมูลชื่อกลุ่มผลผลิต ');
				frm_sub_product.name.focus();
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
<body onload=" frm_sub_product.name.focus(); ">
<?php
	include("../manu_bar.php");
?>
	<table width="370" align="center" class="gridtable" style="margin-top:25px;">
		<tr><td colspan="3"><font color="#0F7FAF"><center><b> ข้อมูลผลผลิตหลัก </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="100"> กลุ่มผลผลิตหลัก </td>
			<td align="center" width="100"> รหัสผลผลิตหลัก </td>
			<td align="center" width="170"> ชื่อผลผลิตหลัก </td>
		</tr>
		<?php
			$i=0;
			$temp_name1="";
			$temp_name2= "";
			WHILE($result_fetch  = fetch_row($result_sub_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
				if($temp_name1==trim($result_fetch[3]))
				{		$temp_name2 = "";	}
				else
				{		$temp_name1 = trim($result_fetch[3]);
						$temp_name2 = trim($result_fetch[3]);	  }
			?>
				<td align="center"><?=$temp_name2; ?></td>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="left">&nbsp;<?=$result_fetch[1]; ?></td>
		</tr>
		<?php
			}  // end while
		?>
	</table>
<br><br>
<!-- ************************ ปรับปรุงข้อมูลผลผลิตหลัก *********************************-->
<?php
		$click = trim($_GET["click"]);
		if($click=='edit')
		{		
			$code = $_GET["code"];
			$name = trim($_GET["name"]);
			$main_code = trim($_GET["main_code"]);
			$header_name = " แก้ไขข้อมูลผลผลิตหลัก ";
		}
		else
		{
			$code = $_GET["new_row"]+1;
			$name = "";
			$header_name  = " เพิ่มข้อมูลผลผลิตหลัก ";
		}

?>
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td height="4" width="4" align="left"><img src="../images/border_01.gif"></td>
		<td height="4" background="../images/border_02.gif" ></td>
		<td height="4" width="4" align="right"><img src="../images/border_03.gif"></td>
	</tr>
	<tr>
		<td width="4" align="left" background="../images/border_04.gif"></td>
		<td align="center">
			<table width="100%" cellpadding="2" cellspacing="1" border="0">
			<form name="frm_sub_product" method="post" action="base_sub_product_sql.php" onsubmit=" return check_submit(); " >
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
			<? } // end click ?>&nbsp;
			<strong><font color="#0F7FAF"><?=$header_name; ?></font></strong>
			</caption>
			<tr  class="rows_grey">
				<td align="right" width='200'> ข้อมูลกลุ่มอาชีพ : </td>
				<td align="left"  width='150'>
				<select name="main_product">
				<? 
					$sql=" SELECT main_pro_code, main_pro_name FROM BaseMainProduct ";
					$result_main_product = query($sql);
					While($result_main =  fetch_row($result_main_product)) 
					{  
						if($main_code==trim($result_main[0]))
							$main_select = "selected";
						else
							$main_select = "";
						?>
						<option value="<?=$result_main[0]; ?>" <?=$main_select ?> ><?=$result_main[1]; ?></option>	
				<? }  ?>
				</select>
				</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> รหัสผลผลิตหลัก : </td>
				<td align="left"><input name="code" type="text" maxlength="3" class="txt_system" size="4" value="<?=$code; ?>" 
				<? if($click=='edit') echo "readonly"; ?>> ห้ามซ้ำ</td>
			</tr>
			<tr class="rows_grey">
				<td align="right"> ชื่อผลผลิตหลัก : </td>
				<td align="left"><input name="name" type="text" maxlength="30" class="txt_string" size="25" value="<?=$name; ?>"></td>
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
		<td height="4" background="../images/border_07" ></td>
		<td height="4" width="4" align="right"><img src="../images/border_08.gif"></td>
	</tr>
</table>
<!-- ******************************************************************************** -->
</body>
</html>
<?php
	free_result($result_sub_product);
	free_result($result_main_product);
	close();
	include("footer.php")
?>
