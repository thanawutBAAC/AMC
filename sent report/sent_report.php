<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');

	connect();
	//  �ʴ������š������ǡ������§ҹ
	$sql = " SELECT ReportMonth.report_year, ReportMonth.report_month, Temp01.sent_date, Temp01.sent_time, ";
	$sql.=" Temp01.sent_status, ReportMonth.report_sent ";
	$sql.=" FROM ReportMonth ";
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT  sent_year, sent_month, sent_date, sent_time, sent_status  ";
	$sql.=" FROM  SentReportHeader  ";
	$sql.= " WHERE amccode='".$code_online."'  ";
	$sql.=" )AS Temp01 ON Temp01.sent_month = ReportMonth.report_month	";
	$sql.=" AND Temp01.sent_year = ReportMonth.report_year ";
	$sql.=" ORDER BY CAST(ReportMonth.report_year AS int) DESC,
					CASE WHEN ReportMonth.report_month = '3' THEN 1
							WHEN ReportMonth.report_month = '2' THEN 2
							WHEN ReportMonth.report_month = '1' THEN 3
							WHEN ReportMonth.report_month = '12' THEN 4
							WHEN ReportMonth.report_month = '11' THEN 5
							WHEN ReportMonth.report_month = '10' THEN 6
							WHEN ReportMonth.report_month = '9' THEN 7
							WHEN ReportMonth.report_month = '8' THEN 8
							WHEN ReportMonth.report_month = '7' THEN 9
							WHEN ReportMonth.report_month = '6' THEN 10
							WHEN ReportMonth.report_month = '5' THEN 11
							WHEN ReportMonth.report_month = '4' THEN 12
							ELSE 99 END ASC ";
	$result_report = query($sql);
	
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
	<script language="JavaScript">
		function check_edit(){
			alert(" <?=$market_connect; ?> ");
		} // end if
	</script>
</head>
<body>
<?
	include("../manu_bar.php");
?>

<table width='600' border='0' align='center'>
<tr>
	<td align='left'><span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
		<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
		</span>&nbsp;<a href="sent_report_detail.php?click=add" alt=" ���������� ">����§ҹ����</a>
	</td>
</tr>
</table>
<table  width="600" align="center" class="gridtable" style="margin-top:5px;">
	<tr height="25">
		<td colspan="6"><center>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
			<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
			</span>&nbsp;<font color="#0F7FAF"><b> �����š������§ҹ </b></center></font>
		</td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="70"> �ӴѺ��� </td>
		<td align="center" width="100"> �պѭ�� </td>
		<td align="center" width="100"> ��͹ </td>
		<td align="center" width="130"> �ѹ����� </td>
		<td align="center" width="100"> ������ </td>
		<td align="center" width="100"> action </td>
	</tr>
	<?php
		$i=0;
		WHILE($result_fetch = fetch_row($result_report))
		{
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
		?>
			<td align="center"><?=$i; ?></td>
			<td align="center"><?=$result_fetch[0]; ?></td>
			<td align="left">&nbsp;<?=$month_thai[trim($result_fetch[1])]; ?></td>
			<?	if(is_null($result_fetch[2])) { ?>
					<td align="center" colspan="3"><font color="red"> ���������§ҹ </font></td>
			<? } else { ?>
			<td align="center"><?=$result_fetch[2]; ?></td>
			<td align="center"><?=$result_fetch[3]; ?></td>
			<td align="center">
			<!--  ��Ǩ�ͺ��������§ҹ -->
			<?  if($result_fetch[4]==1) { ?>	
						<a href="sent_report_detail.php?click=edit&year=<?=$result_fetch[0]; ?>&month=<?=$result_fetch[1]; ?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
						<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
						<img src="../icons/application_edit.png"  class="images_icon" alt=" �����§ҹ ">
						</span></a>
			<? } elseif($result_fetch[4]==2){ ?>
						<a href="#" onclick=" check_edit(); " style='cursor:hand'>
						<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/lock.png');" class="span_icon" alt=" �������� " >
						<img src="../icons/lock.png" class="images_icon">
						</span></a>
			<? } ?>
			</td>
		<? }  // end if ?>
			</tr>
		<!--  ����ش��õ�Ǩ�ͺ��� ʡ� ����§ҹ���������ѧ -->
	<?php
		}  // end while
	?>
	</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" �����§ҹ " class="images_icon" >
</span>&nbsp;�����§ҹ&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/lock.png');" class="span_icon">
<img src="../icons/lock.png" alt=" �����§ҹ����� " class="images_icon" >
</span>&nbsp;��ͧ�ѹ�����§ҹ
</div>
</body>
</html>
<?php
	free_result($result_report);
	close();
	include("../footer.php")
?>