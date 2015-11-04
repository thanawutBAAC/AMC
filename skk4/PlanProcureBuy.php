<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

	// แสดงข้อมูลปีบัญชีทั้งหมดที่มี
	$sql = " SELECT PlanProcureBuy_year FROM PlanProcureBuy ";
	$sql.=" WHERE amccode='".$code_online."' ";
	$sql.=" GROUP BY PlanProcureBuy_year ";
	$sql.=" ORDER BY PlanProcureBuy_year ";
	$result_plan = query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">
		function confirm_delete(str_name)
		{
			if (confirm(" กรุณายืนยันการลบข้อมูล ปี "+str_name)) {
				return true;
			}
			else
			{
				return false;
			}
	}
</script>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<div style="margin-left:auto; margin-right:auto;  text-align: center "> รายละเอียดแผนการจัดหาสินค้ามาจำหน่ายของ สกต. <font color='red'>(ยอดซื้อ)</font>  แผน สก.กก4 </div>
<div style="margin: 15 0 0 223; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;<a href="PlanProcureBuy_detail.php?click=add" alt=" เพิ่มข้อมูล ">เพิ่มข้อมูล</a>
</div>
<table width="300" align="center"  class="gridtable" style="margin-top:5px;">
	<tr><td colspan="3"><font color="#0F7FAF"><center><b> รายละเอียดข้อมูล </b></center></font></td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> ลำดับที่ </td>
		<td align="center" width="100"> ปีบัญชี </td>
		<td align="center" width="120"> Action </td>
	</tr>
	<?
		$i = 0;
		WHILE($fetch_plan = fetch_row($result_plan)) {
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
	?>
			<td align="center"><?=$i;?></td>
			<td align="center"><?=$fetch_plan[0]; ?></td>
			<td align="center">
				<a href="PlanProcureBuy_detail.php?click=edit&year=<?=$fetch_plan[0]; ?>" target="right" alt=" แก้ไขข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" แก้ไขข้อมูล ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" แก้ไขข้อมูล ">
				</span></a>&nbsp;
				<a href="PlanProcureBuy_sql.php?click=del&year=<?=$fetch_plan[0]; ?>" target="right" alt="ลบข้อมูล" style='cursor: hand' onclick=" return confirm_delete('<?=$fetch_plan[0];?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon" alt=" ลบข้อมูล " >
				<img src="../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
			</td>
		</tr>
	<?
		}
	?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" แก้ไขแผนดำเนินงาน " class="images_icon" >
</span>&nbsp;แก้ไขแผน&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon">
<img src="../icons/application_delete.png" alt=" ลบแผนดำเนินงาน " class="images_icon" >
</span>&nbsp;ลบแผน
</div>
</body>
</html>
<?
	free_result($result_plan);
	close();
	include("../footer.php")
?>