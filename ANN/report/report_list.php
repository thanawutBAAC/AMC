<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");
	connect();

	// แสดงข้อมูลปี ผลการดำเนินงานเปรียบเทียบเป้าหมาย
	$sql = " SELECT distinct works_year ";
	$sql.=" FROM AnnWorks  ORDER BY works_year ";
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
<br>
<div style="margin-left:auto; margin-right:auto;  text-align: center "><strong> ข้อมูลผลการดำเนินงานเปรียบเทียบผลพยากรณ์ ( เฉพาะผลผลิตหลัก )</strong></div>

<table width="300" align="center"  class="gridtable" style="margin-top:5px;">
	<tr bgcolor='#75B33F'><td colspan="3"><center><b> รายละเอียดข้อมูล </b></center></td></tr>
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
				<a href="report_detail.php?year=<?=$fetch_skt[0]; ?>" target="right" alt=" แสดงข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_view_list.png');" class="span_icon" alt=" แสดงข้อมูล ">
				<img src="../../icons/application_view_list.png"  class="images_icon" alt=" แสดงข้อมูล ">
				</span></a>
			</td>
		</tr>
	<?
		}
	?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_view_list.png');" class="span_icon">
<img src="../../icons/application_view_list.png" alt=" แสดงรายงาน" class="images_icon" >
</span>&nbsp;แสดงรายงาน&nbsp;&nbsp;
</div>
</body>
</html>
<?
	free_result($result_skt);
	close();
	include("../footer.php")
?>