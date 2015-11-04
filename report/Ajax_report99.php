<?php session_start();
	ob_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$year = trim($_GET["year"]);         // ปี
	$month = trim($_GET["month"]);  // เดือน

	$sql = " SELECT BaseProduct.pro_code, BaseProduct.pro_name ";
	$sql.= " FROM TargetProduct, BaseProduct ";
	$sql.= " WHERE BaseProduct.pro_code = TargetProduct.report_detail_code ";
	$sql.= " AND TargetProduct.target_kpi = '1' ";
	$sql.= " ORDER BY BaseProduct.pro_code ";
	if(num_rows(query($sql))==0)
	{
			echo " ไม่มีการเลือกข้อมูลให้แสดง ";
			exit();
	}

//  ประมวลผล xml 
	include("create_xml.php");
?>
<html>
<head>
	<title></title>
	<link href="../css/main.css" rel="stylesheet" type="text/css"/>
	<script language="JavaScript" type="text/javascript" src="../js/FusionCharts.js"></script>
</head>
<body>
<table width='900' border='0' cellpadding='0' cellspacing='0' class='report' style=' margin-top:20px; margin-left:5px; margin-right:50px;'> 
<!--  แบ่งแยกเป็น 2 colume ใหญ่ -->
<tr> 
<!-- ***************************** colume 1***************************************************** -->
<td width='600' valign='top' class='rightcol'> 
	<table width='600' border='0' cellspacing='0' cellpadding='0'> 
	 <tr><td class='tab'><div align='center' > ข้อมูลการรวบรวมผลผลิตหลัก <a href=''>รายละเอียด..</a></div></td></tr> 
	 <tr><td> 
	<?
		$temp_data = "../data/".$year.$month."data1.xml";;
	?>	
	  <div id='chart_master' align='center'> 
	 <script type='text/javascript'> 
	 	var chart = new FusionCharts('../Charts/Column3D.swf', 'chart_master', '600', '350', '0', '0'); 
				chart.setDataURL('<?=$temp_data ?>');
	 			chart.render('chart_master'); 
	 </script>
	 </div> 
	 </td> 
	 </tr> 
	 <tr><td class='bordertop'><img src='../Images/dot_white.gif' width='1' height='15'/></td></tr> 
	 <tr><td class='tab'><div align='center' > รายงานความเคลือนไหวสะสมประจำปี <a href=''>รายละเอียด..</a></div></td></tr> 
	 <tr><td> 
	<?
		$temp_data = "../data/".$year.$month."data2.xml";;
	?>	
	 <div id='chart_year' align='center'> 
	 <script type='text/javascript'> 
	 	var chart = new FusionCharts('../Charts/MSLine.swf', 'chart_year', '600', '350', '0', '0');   
				chart.setDataURL('<?=$temp_data ?>');
	 			chart.render('chart_year'); 
	 </script> 
	 </div> 
	 </td> 
	 </tr> 
 </table> 
	 </td> 
<!-- ***************************** end 1    ** ***************************************************** -->
<!-- ***************************** colume 2 ***************************************************** -->
	<td width='300' valign='top' class='rightcol'> 
	<table width='300' border='0' cellspacing='0' cellpadding='0'>
		<tr><td class='tab'><div align='center'>Key Performance Indicators </div></td></tr>
<?
  // เริ่มแสดงรายงานฝั่งขวา
	$sql = " SELECT BaseProduct.pro_code, BaseProduct.pro_name ";
	$sql.= " FROM TargetProduct, BaseProduct ";
	$sql.= " WHERE BaseProduct.pro_code = TargetProduct.report_detail_code ";
	$sql.= " AND TargetProduct.target_kpi = '1' ";
	$sql.= " ORDER BY BaseProduct.pro_code ";
	$result_report = query($sql);
	$j = 3;
	WHILE($fetch_report = fetch_row($result_report)) { 
?>
	<tr><td><img src='../images/dot_white.gif' width='1' height='15' /></td></tr>
	<tr><td>
	<?
		$temp_data = "../data/".$year.$month."data".$j.".xml";;
		$temp_chart = 'chart'.$j;
	?>	
		<div id='<?=$temp_chart?>' align='center'>
		<script type='text/javascript'>
		var chart1 = new FusionCharts('../Charts/AngularGauge.swf', '<?=$temp_chart ?>', '250', '120', '0', '0');
				chart1.setDataURL('<?=$temp_data ?>');
				chart1.render('<?=$temp_chart ?>');
		</script>
		</div>
		</td>
		</tr>
		<tr><td><div align='center' class='text'><?=trim($fetch_report[1])?></div></td></tr>
<?
		$j++;
	} // end while 
?>	
	</table> 
			<!-- **************************** end 2  *************************** -->
	 </td> 
	</tr> 
</table>
</body>
</html>