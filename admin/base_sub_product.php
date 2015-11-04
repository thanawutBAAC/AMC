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
	$new_row = num_rows($result_sub_product);
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
	<script language="JavaScript">

		function confirm_delete(str_name)
		{
			if (confirm(" กรุณายืนยันการลบข้อมูล "+str_name)) {
				return true;
			}
			else
			{
				return false;
			}
	}
	</script>
</head>
<body >
<?php
	include("../manu_bar.php");
?>
<div style="margin-top:25; margin-left:138; margin-bottom:5px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;<a href="base_sub_product_detail.php?click=add&new_row=<?=$new_row; ?>" alt=" เพิ่มข้อมูล ">เพิ่มข้อมูล</a>
</div>
		<table  width="470" align="center" class="gridtable">
		<tr><td colspan="4"><font color="#0F7FAF"><center><b> ข้อมูลผลผลิตหลัก </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="100"> กลุ่มผลผลิตหลัก </td>
			<td align="center" width="100"> รหัสผลผลิตหลัก </td>
			<td align="center" width="170"> ชื่อผลผลิตหลัก </td>
			<td align="center" width="100"> Action </td>
		</tr>
		<?php
			$i=0;
			$temp_name1 = "";
			$temp_name2 = "";
			WHILE($result_fetch  = fetch_row($result_sub_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
				if($temp_name1==trim($result_fetch[3]))
				{		$temp_name2 = "";		}
				else
				{		$temp_name1 = trim($result_fetch[3]);
						$temp_name2 = trim($result_fetch[3]);	 }
			?>
				<td align="center"><?=trim($temp_name2); ?></td>
				<td align="center"><?=trim($result_fetch[0]); ?></td>
				<td align="left">&nbsp;<?=trim($result_fetch[1]); ?></td>
				<td align="center">
				<a href="base_sub_product_detail.php?click=edit&code=<?=trim($result_fetch[0]); ?>&name=<?=trim($result_fetch[1]); ?>&main_code=<?=trim($result_fetch[2]); ?>" target="right" alt=" แก้ไขข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" แก้ไขข้อมูล ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" แก้ไขข้อมูล ">
				</span></a>&nbsp;
				<a href="base_sub_product_sql.php?click=del&code=<?=trim($result_fetch[0]); ?>" target="right" alt="ลบข้อมูล" style='cursor: hand' onclick=" return confirm_delete('<?=trim($result_fetch[1]);?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon" alt=" ลบข้อมูล " >
				<img src="../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
				</td>
		</tr>
		<?php
			} // end while
		?>
		</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
</span>&nbsp;แก้ไขข้อมูล&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ลบข้อมูล " class="images_icon" >
</span>&nbsp;ลบข้อมูล
</div>
</body>
</html>
<?php
	free_result($result_sub_product);
	close();
	include("footer.php")
?>