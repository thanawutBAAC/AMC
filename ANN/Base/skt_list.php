<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");
	connect();

	// แสดงข้อมูลปี พื้นฐานของข้อมูล สกต. ทั้งหมด 
	$sql = " SELECT distinct skt_year ";
	$sql.=" FROM AnnSkt  ORDER BY skt_year ";
	$result_skt = query($sql);

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
<div style="margin-left:auto; margin-right:auto;  text-align: center "><strong> ข้อมูลปัจจัยพื้นฐานของ สกต. </strong></div>
<div style="margin: 15 0 0 223; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon"> 
<img src="../../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;<a href="skt_detail.php?click=add" alt=" เพิ่มข้อมูล ">เพิ่มข้อมูล</a>
</div>
<table width="300" align="center"  class="gridtable" style="margin-top:5px;">
	<tr class='rows_green'><td colspan="3"><center><b> รายละเอียดข้อมูล </b></center></td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> ลำดับที่ </td>
		<td align="center" width="100"> ปี </td>
		<td align="center" width="120"> Action </td>
	</tr>
	<?
		$i = 0;
		WHILE($fetch_skt = fetch_row($result_skt)) {
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
	?>
			<td align="center"><?=$i;?></td>
			<td align="center"><?=$fetch_skt[0]; ?></td>
			<td align="center">
				<a href="skt_detail.php?click=edit&year=<?=$fetch_skt[0]; ?>" target="right" alt=" แก้ไขข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon" alt=" แก้ไขข้อมูล ">
				<img src="../../icons/application_delete.png"  class="images_icon" alt=" แก้ไขข้อมูล ">
				</span></a>&nbsp;
				<a href="skt_sql.php?click=del&year=<?=$fetch_skt[0]; ?>" target="right" alt="ลบข้อมูล" style='cursor: hand' onclick=" return confirm_delete('<?=$fetch_skt[0];?>') " >
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
<img src="../../icons/application_edit.png" alt=" แก้ไขปัจจัยพื้นฐาน  สกต." class="images_icon" >
</span>&nbsp;แก้ไขปัจจัยพื้นฐาน สกต.&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_delete.png');" class="span_icon">
<img src="../../icons/application_delete.png" alt=" ลบปัจจัยพื้นฐาน สกต." class="images_icon" >
</span>&nbsp;ลบปัจจัยพื้นฐาน สกต.
</div>
</body>
</html>
<?
	free_result($result_skt);
	close();
	include("../footer.php")
?>