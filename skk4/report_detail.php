<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();	
	
$sql=" SELECT  ReportMonth.report_year ";
$sql.=" ,Temp01.Temp_year, Temp02.Temp_year ";
$sql.=" ,Temp03.Temp_year, Temp04.Temp_year ";
$sql.=" ,Temp05.Temp_year, Temp06.Temp_year ";
$sql.=" ,Temp07.Temp_year, Temp08.Temp_year ";
$sql.=" FROM  ReportMonth ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT Plan_year AS Temp_year FROM PlanMaster  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.=" )AS Temp01 ON Temp01.Temp_year = ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanMember_year AS Temp_year FROM PlanMember  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.=" )AS Temp02 ON Temp02.Temp_year = ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanProcureBuy_year AS Temp_year FROM PlanProcureBuy  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.="  GROUP BY PlanProcureBuy_year ";
$sql.=" )AS Temp03 ON Temp03.Temp_year=ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanProcureSell_year AS Temp_year FROM PlanProcureSell  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.="  GROUP BY PlanProcureSell_year ";
$sql.=" )AS Temp04 ON Temp04.Temp_year = ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanCollectBuy_year AS Temp_year FROM PlanCollectBuy  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.="  GROUP BY PlanCollectBuy_year ";
$sql.=" )AS Temp05 ON Temp05.Temp_year=ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanCollectSell_year AS Temp_year FROM PlanCollectSell  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.="  GROUP BY PlanCollectSell_year ";
$sql.=" )AS Temp06 ON Temp06.Temp_year=ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanService_year AS Temp_year FROM PlanService  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.="  GROUP BY PlanService_year ";
$sql.=" )AS Temp07 ON Temp07.Temp_year=ReportMonth.report_year ";
$sql.=" LEFT JOIN( ";
$sql.="  SELECT PlanExpenses_year AS Temp_year FROM PlanExpenses  ";
$sql.="  WHERE amccode='".$temp_amccode."' ";
$sql.="  GROUP BY PlanExpenses_year ";
$sql.=" )AS Temp08 ON Temp08.Temp_year=ReportMonth.report_year ";
$sql.=" GROUP BY ReportMonth.report_year ";
$sql.=" ,Temp01.Temp_year, Temp02.Temp_year ";
$sql.=" ,Temp03.Temp_year, Temp04.Temp_year ";
$sql.=" ,Temp05.Temp_year, Temp06.Temp_year ";
$sql.=" ,Temp07.Temp_year, Temp08.Temp_year ";
$sql.=" ORDER BY ReportMonth.report_year ";

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?
	include("../manu_bar.php");
?>

<table  width="640" align="center" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
<tr height="25"><td colspan="10">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> รายงานการส่งข้อมูล สกก.4  สกต.<?=$temp_name; ?></b></center></font>
</td></tr>
<tr class="rows_pink"> 
	<td rowspan="2" valign="middle" align="center" width="20">ที่ </td>
	<td rowspan="2" valign="middle" align="center" width="100"> ปีดำเนินงาน </td>
	<td rowspan="2" valign="middle" align="center" width="70"> สรุปแผน </td>
	<td rowspan="2" valign="middle" align="center" width="70"> แผนสมาชิก </td>
	<td colspan="2" width="120" align="center"> แผนจัดหาสินค้า </td>
	<td colspan="2" width="120" align="center"> แผนรวบรวมผลผลิต </td>
	<td rowspan="2" valign="middle" align="center" width="70"> แผนบริการ </td>
	<td rowspan="2" valign="middle" align="center" width="70"> แผนใช้จ่าย </td>
</tr>
<tr class="rows_pink"> 
	<td align="center" width="65"> ยอดซื้อ </td>
	<td align="center" width="65"> ยอดขาย </td>
	<td align="center" width="65"> ยอดซื้อ </td>
	<td align="center" width="65"> ยอดขาย </td>
</tr>
<? $result_report =  query($sql);
	$i=0;
	WHILE( $fetch_report = fetch_row($result_report))
	{  $i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
	?>
		<td align="center"><?=$i?></td>
		<td align="left">&nbsp;ปี <?=trim($fetch_report[0])?></td>
		<td align="center">
		<?	if(is_null($fetch_report[1])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[2])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[3])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[4])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[5])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[6])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[7])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[8])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
	</tr>
<? }  // end while ?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
</span>&nbsp;ส่งข้อมูล&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
</span>&nbsp;ไม่มีข้อมูล
</div>
</body>
</html>
<?php	
	free_result($result_report);
	close();
	include("../footer.php")
?>