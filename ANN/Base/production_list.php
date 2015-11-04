<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");
	connect();

	if($code=='1'){
		$temp_name = 'ข้าว';
	}
	elseif($code=='2'){
		$temp_name = 'ข้าวโพด';
	}
	elseif($code=='3'){
		$temp_name = 'มันสำปะหลัง';
	}
	elseif($code=='4'){
		$temp_name = 'อ้อย';
	}
	elseif($code=='5'){
		$temp_name = 'ยางพารา';
	}

	// แสดงข้อมูลปีทั้งหมดผลผลิตที่เลือก
	$sql = " SELECT Product_year FROM  AnnProduction ";
	$sql.=" WHERE  Product_code='".$code."' ";
	$sql.=" ORDER BY Product_year ";
	$result_production = query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
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
<div style="margin-left:auto; margin-right:auto;  text-align: center "><strong> ข้อมูลพื้นฐานการผลิต<?=$temp_name?> </strong></div>
<div style="margin: 15 0 0 228; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon"> 
<img src="../../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;<a href="production_detail.php?click=add&code=<?=$code?>" alt=" เพิ่มข้อมูล ">เพิ่มข้อมูล</a>
</div>
<table width="300" align="center"  class="gridtable" style="margin-top:5px;">
	<tr class='rows_orange'><td colspan="3"><center><b> รายละเอียดข้อมูล </b></center></td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> ลำดับที่ </td>
		<td align="center" width="100"> ปี </td>
		<td align="center" width="120"> Action </td>
	</tr>
	<?
		$i = 0;
		WHILE($fetch_production = fetch_row($result_production)) {
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
	?>
			<td align="center"><?=$i;?></td>
			<td align="center"><?=$fetch_production[0]; ?></td>
			<td align="center">
				<a href="production_detail.php?click=edit&year=<?=$fetch_production[0]; ?>&code=<?=$code?>" target="right" alt=" แก้ไขข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon" alt=" แก้ไขข้อมูล ">
				<img src="../../icons/application_delete.png"  class="images_icon" alt=" แก้ไขข้อมูล ">
				</span></a>&nbsp;
				<a href="production_sql.php?click=del&year=<?=$fetch_production[0]; ?>&code=<?=$code?>" target="right" alt="ลบข้อมูล" style='cursor: hand' onclick=" return confirm_delete('<?=$fetch_production[0];?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_delete.png');" class="span_icon" alt=" ลบข้อมูล " >
				<img src="../../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
			</td>
		</tr>
	<?
		}
	?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon">
<img src="../../icons/application_edit.png" alt=" แก้ไขพื้นฐานการผลิต " class="images_icon" >
</span>&nbsp;แก้ไขพื้นฐานการผลิต&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_delete.png');" class="span_icon">
<img src="../../icons/application_delete.png" alt=" ลบพื้นฐานการผลิต " class="images_icon" >
</span>&nbsp;ลบพื้นฐานการผลิต
</div>
</body>
</html>
<?
	free_result($result_production);
	close();
	include("../footer.php")
?>