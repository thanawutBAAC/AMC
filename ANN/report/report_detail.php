<?php session_start();
  include("../class_ann.php");
  include("../../lib/database.php");
  connect();

?>
<html>
<head>
<title></title>
<META http-equiv='Content-Type' content='text/html'; charset='windows-874'>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../js_sort/css/jq.css" type="text/css" media="print, projection, screen" />
<link rel="stylesheet" href="../js_sort/blue/style.css" type="text/css" id="" media="print, projection, screen" />
<script type="text/javascript" src="../js_sort/jquery-latest.js"></script>
<script type="text/javascript" src="../js_sort/jquery.metadata.js"></script>
<script type="text/javascript" src="../js_sort/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../js_sort/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="../js_sort/chili-1.8b.js"></script>
<script type="text/javascript" src="../js_sort/docs.js"></script>
<script type="text/javascript" id="js">$(document).ready(function() {
		$("table").tablesorter();
		}); 
</script>
<style>
body{
	font-size: 0.8em;
}
</style>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<br>
<table width="1360" align="center"  class='gridtable'  class="tablesorter"  style="margin:10 15 10 15 px; ">
	<thead>
	<tr height='25px' bgcolor='#75B33F'>
		<td colspan="11"align="left" class="{sorter: false}">&nbsp;<b>ข้อมูลผลการดำเนินงานจริงเปรียบเทียบผลพยากรณ์ ( เฉพาะผลผลิตหลัก ) ปี <?=$year ?> </b></td>
	</tr>
	<tr>
		<td align="center" width="140" rowspan='2' bgcolor='#FFDFEF'> เดือน </td>
		<td align="center" width="240" colspan='2' bgcolor='#FFDFEF' class="{sorter: false}"> ข้าวเปลือก</td>
		<td align="center" width="240" colspan='2' bgcolor='#FFDFEF' class="{sorter: false}"> ข้าวโพด </td>
		<td align="center" width="240" colspan='2' bgcolor='#FFDFEF' class="{sorter: false}"> มันสำปะหลัง </td>
		<td align="center" width="240" colspan='2' bgcolor='#FFDFEF' class="{sorter: false}"> อ้อย </td>
		<td align="center" width="240" colspan='2' bgcolor='#FFDFEF' class="{sorter: false}"> ยางพารา </td>
	</tr>
	<tr bgcolor='#FFDFEF'>
		<td align="center" width="120" class="{sorter: false}"> ผลงานจริง </td>
		<td align="center" width="120" class="{sorter: false}"> ค่าพยากรณ์ </td>
		<td align="center" width="120" class="{sorter: false}"> ผลงานจริง </td>
		<td align="center" width="120" class="{sorter: false}"> ค่าพยากรณ์ </td>
		<td align="center" width="120" class="{sorter: false}"> ผลงานจริง </td>
		<td align="center" width="120" class="{sorter: false}"> ค่าพยากรณ์ </td>
		<td align="center" width="120" class="{sorter: false}"> ผลงานจริง </td>
		<td align="center" width="120" class="{sorter: false}"> ค่าพยากรณ์ </td>
		<td align="center" width="120" class="{sorter: false}"> ผลงานจริง </td>
		<td align="center" width="120" class="{sorter: false}"> ค่าพยากรณ์ </td>
	</tr>
</thead>
 <tbody>
<?
	$temp_month = array("4","5","6","7","8","9","10","11","12","1","2","3");
	$temp_name = array("เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม","มกราคม","กุมภาพันธ์","มีนาคม");

	$sql = " SELECT works_year, works_month,rice_value,rice_predic,maize_value,maize_predic,cassava_value, ";
	$sql.=" cassava_predic,sugarcane_value, sugarcane_predic, para_value, para_predic  FROM AnnWorks ";
	$sql.=" WHERE works_year = '".$year."' ORDER BY works_month_list ";
	$result_works = query($sql);
		$i = 0;
		WHILE($fetch_works = fetch_row($result_works)) {
	?>
		<tr>
			<td align="center" bgcolor='#FFFFCC'><?=$temp_name[$i]?></td>
			<td align="right"><?=number_format($fetch_works[2],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[3],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[4],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[5],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[6],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[7],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[8],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[9],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[10],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($fetch_works[11],2,'.',',')?>&nbsp;</td>
		</tr>
	<?
		$i++;
		} // end while 
?>
</tbody>
</table>
<center><a href='excel_report.php?year=<?=$year?>'><img src='../../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>
</body>
</html>
<?
	close();
	include("../footer.php")
?>