<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	// แสดงข้อมูลกลุ่มผลผลิตทางการเกษตรทั้งหมด
	$sql=" SELECT main_pro_code, main_pro_name FROM BaseMainProduct ";
	$result_main_product = query($sql);
	$new_row = num_rows($result_main_product);

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
<div style="margin: 25 0 0 223; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;<a href="base_main_product_detail.php?click=add&new_row=<?=$new_row; ?>" alt=" เพิ่มข้อมูล ">เพิ่มข้อมูล</a>
</div>
		<table width="300" align="center" class="gridtable" style="margin-top:5px;">
		<tr><td colspan="3"><font color="#0F7FAF"><center><b> ข้อมูลกลุ่มผลผลิตหลัก </b></center></font></td></tr>
		<tr class="rows_pink">
				<td align="center" width="70"> รหัส </td>
				<td align="center" width="130"> ชื่อกลุ่มผลผลิต </td>
				<td align="center" width="100"> Action </td>
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
				<td align="center">
				<a href="base_main_product_detail.php?click=edit&code=<?=$result_fetch[0]; ?>&name=<?=$result_fetch[1]; ?>" target="right" alt=" แก้ไขข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" แก้ไขข้อมูล ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" แก้ไขข้อมูล ">
				</span></a>&nbsp;
				<a href="base_main_product_sql.php?click=del&code=<?=$result_fetch[0]; ?>" target="right" alt="ลบข้อมูล" style='cursor: hand' onclick=" return confirm_delete('<?=$result_fetch[1];?>') " >
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
	free_result($result_main_product);
	close();
	include("footer.php")
?>