<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลรายงานทั่วไป.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');

	connect();
	$month = escapeshellcmd($_GET["month"]);
	$year = escapeshellcmd($_GET["year"]);
	$province_name = escapeshellcmd($_GET["province_name"]);
	$minus = "-";  // ในกรณีที่มีข้อมูล -  ให้ลบออก
	$province_name = str_replace($minus, "", $province_name);

	if(trim($_GET["div"])=='0')
		{ $div = '0'; 
		   $temp_header = "( รวมทั้งประเทศ )"; }
	else
	   { $div = trim($_GET["div"]); 
		  $temp_header = "ฝ่ายกิจการสาขา ".$div; }
	if(trim($_GET["province"])=='')
	   {  $province = '0'; 
		   if($div!='0')	
	          $temp_header = "ฝ่ายกิจการสาขา ".$div; 
	   }
	else
	  { $province = trim($_GET["province"]);
		   if($div!='0')	
			   $temp_header = $province_name;  
		}
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>ข้อมูลรายงานทั่วไป</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<?
	$temp_report = "";  // ผลลัพธ์ที่จะต้องคืนค่า
	// หัวรายงาน
	$temp_report.="<strong><center>สหกรณ์การเกษตรเพื่อการตลาดลูกค้า ธ.ก.ส. จำกัด </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center>รายงานผลการดำเนินงานสะสมของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	
	//สร้างข้อมูลหัวรายงาน
		$temp_report.="<table  width='1320'  border='1' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
		$temp_report.="  <tr height='25px'><td colspan='11'align='left'>&nbsp;<font color='#0F7FAF'><b>1. แสดงข้อมูลทั่วไป สกต. ณ สิ้นเดือน ".$month_thai[$month]." ปี ".$year."</b></font></td></tr> ";
		$temp_report.="  <tr bgcolor='#FFCC99'> ";
		$temp_report.="    <td align='center' width='50'> ฝ่าย </td> ";
		$temp_report.="    <td align='center' width='200'>  สกต. </td> ";
		$temp_report.="    <td align='center' width='90'> สกต.เขต </td> ";
		$temp_report.="    <td align='center' width='90'> สกต.สาขา </td> ";
		$temp_report.="    <td align='center' width='90'> ลูกค้า ธกส.<br>( ราย )</td> ";
		$temp_report.="    <td align='center' width='90'> สมาชิก สกต.<br>( ราย )</td> ";
		$temp_report.="    <td align='center' width='90'> สมาชิก สกต. <b><u>ต่อ</u></b> ลูกค้า ธกส. </td> ";
		$temp_report.="    <td align='center' width='90'> มูลค่าหุ้น </td> ";
		$temp_report.="    <td align='center' width='90'> ร้านค้าย่อย </td> ";
		$temp_report.="    <td align='center' width='90'> กำไรขาดทุน<br>หน่วยพันบาท</td> ";
		$temp_report.="    <td align='center' width='350'> สาเหตุ ขาดทุน </td>";
		$temp_report.="  </tr> ";
	
//  ***********************   ตรวจสอบการส่งข้อมูลล่าสุดของ สกต นั้น  **************************
		$current_amc = array();
		$sql = " CREATE TABLE #Temp_SentReport ( amccode varchar(30)  COLLATE THAI_CI_AS NULL, sent_month int NULL, max_month int NULL )
			 
					INSERT INTO #Temp_SentReport SELECT [amccode], [sent_month] ,
					  (CASE WHEN SentReportHeader.sent_month = '1' THEN 13 
						WHEN SentReportHeader.sent_month = '2' THEN 14 
						WHEN SentReportHeader.sent_month = '3' THEN 15 
						WHEN SentReportHeader.sent_month = '4' THEN 4 
						WHEN SentReportHeader.sent_month = '5' THEN 5 
						WHEN SentReportHeader.sent_month = '6' THEN 6 
						WHEN SentReportHeader.sent_month = '7' THEN 7 
						WHEN SentReportHeader.sent_month = '8' THEN 8 
						WHEN SentReportHeader.sent_month = '9' THEN 9 
						WHEN SentReportHeader.sent_month = '10' THEN 10 
						WHEN SentReportHeader.sent_month = '11' THEN 11 
						WHEN SentReportHeader.sent_month = '12' THEN 12 ELSE 0 END)AS max_month2 
					FROM [SentReportHeader]
					WHERE sent_year = '".$year."'

				SELECT userlogin.amccode, Temp01.max_month, userlogin.userdetail  FROM userlogin 
					LEFT JOIN ( 
					SELECT amccode, MAX(max_month) AS max_month FROM #Temp_SentReport
					WHERE max_month <= ".$month_report2[$month]."
					GROUP BY amccode
				)AS Temp01 ON Temp01.amccode = userlogin.amccode ";
		$sql.=" WHERE userlogin.status='N' ";
		if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";	}
		if($province!='0' AND trim($province)!='')
		{	$sql.=" AND userlogin.amccode='".$province."' "; }

		$result_amc = query($sql);
		query(" DROP TABLE #Temp_SentReport ");

		$display_sql = " ( "; // เก็บค่าว่ามี สกต ส่งข้อมูลล่าสุดเดือนไหน
		$display_sql2 = " ( "; // เก็บค่าว่ามี สกต เป้าหมาย

		WHILE($fetch_amc = fetch_row($result_amc)) { 

			$current_amc[trim($fetch_amc[2])] = $month_report3[trim($fetch_amc[1])];			// แปลงค่าให้เป็นเดือนปัจจุบัน
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";
			$display_sql2.=" ( amccode='".trim($fetch_amc[0])."' AND target_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";

		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  ไม่เอาตัว 2 สุดท้ายมา   OR
		$display_sql.=" ) ";
		$display_sql2 = substr($display_sql2, 0, -2);   //  ไม่เอาตัว 2 สุดท้ายมา   OR
		$display_sql2.=" ) ";
//  **************************  สิ้นสุดการตรวจสอบ   ****************************************

		$sql = " SELECT userlogin.br_code, userlogin.userdetail, ";
		$sql.=" Temp01.report_value,Temp02.report_value, ";
		$sql.=" Temp03.report_value,Temp04.report_value, ";
		$sql.=" Temp05.report_value,Temp06.report_value, userlogin.amccode, Temp07.comment ";
		$sql.=" FROM userlogin  ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
		$sql.=" ReportGroup1.amccode ";
		$sql.=" FROM ReportGroup1,userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
		$sql.=" AND ReportGroup1.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
		//$sql.=" AND ReportGroup1.report_month='".$month."' ";
		$sql.=" AND ReportGroup1.report_detail_code='1' ";
		$sql.=" GROUP BY ReportGroup1.amccode ";
		$sql.=" )AS Temp01 ON Temp01.amccode = userlogin.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
		$sql.=" ReportGroup1.amccode ";
		$sql.=" FROM ReportGroup1,userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
		$sql.=" AND ReportGroup1.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
//		$sql.=" AND ReportGroup1.report_month='".$month."' ";
		$sql.=" AND ReportGroup1.report_detail_code='2' ";
		$sql.=" GROUP BY ReportGroup1.amccode ";
		$sql.=" )AS Temp02 ON Temp02.amccode = userlogin.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
		$sql.=" ReportGroup1.amccode ";
		$sql.=" FROM ReportGroup1,userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
		$sql.=" AND ReportGroup1.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
//		$sql.=" AND ReportGroup1.report_month='".$month."' ";
		$sql.=" AND ReportGroup1.report_detail_code='3' ";
		$sql.=" GROUP BY ReportGroup1.amccode ";
		$sql.=" )AS Temp03 ON Temp03.amccode = userlogin.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
		$sql.=" ReportGroup1.amccode ";
		$sql.=" FROM ReportGroup1,userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
		$sql.=" AND ReportGroup1.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
//		$sql.=" AND ReportGroup1.report_month='".$month."' ";
		$sql.=" AND ReportGroup1.report_detail_code='4' ";
		$sql.=" GROUP BY ReportGroup1.amccode ";
		$sql.=" )AS Temp04 ON Temp04.amccode = userlogin.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
		$sql.=" ReportGroup1.amccode ";
		$sql.=" FROM ReportGroup1,userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
		$sql.=" AND ReportGroup1.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
//		$sql.=" AND ReportGroup1.report_month='".$month."' ";
		$sql.=" AND ReportGroup1.report_detail_code='5' ";
		$sql.=" GROUP BY ReportGroup1.amccode ";
		$sql.=" )AS Temp05 ON Temp05.amccode = userlogin.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
		$sql.=" ReportGroup1.amccode ";
		$sql.=" FROM ReportGroup1,userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
		$sql.=" AND ReportGroup1.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
//		$sql.=" AND ReportGroup1.report_month='".$month."' ";
		$sql.=" AND ReportGroup1.report_detail_code='6' ";
		$sql.=" GROUP BY ReportGroup1.amccode ";
		$sql.=" )AS Temp06 ON Temp06.amccode = userlogin.amccode ";
		// สาเหตุการขาดทุน
		$sql.=" LEFT JOIN ( ";
		$sql.=" SELECT ReportComment.comment  AS comment, ReportComment.amccode ";
		$sql.=" FROM ReportComment, userlogin ";
		$sql.=" WHERE userlogin.amccode = ReportComment.amccode  ";
		$sql.=" AND ReportComment.report_year='".$year."'  ";
		$sql.=" AND ".$display_sql;
//		$sql.=" AND ReportComment.report_month='".$month."'  ";
		$sql.=" )AS Temp07 ON Temp07.amccode = userlogin.amccode ";

		$sql.=" WHERE status='N' ";
		if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";	}
		if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' "; }

		$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";
		$result_report = query($sql);
	
		//  สร้างข้อมูลเนื้อหารายงานในส่วนที่ 1
		$i=0;
		// หาค่าฝ่ายแรกที่มีข้อมูล
		if($div==0)
		{	$temp_div = result($result_report,0,"br_code");
			data_seek($result_report);	}

		WHILE($fetch_report = fetch_row($result_report)) { 

				if($div==0)  //  สรุปข้อมูลในแต่ละฝ่าย
				{
					if($temp_div==trim($fetch_report[0]))
					{	$sum101=$sum101+number_format($fetch_report[2],0,'','');
						$sum102=$sum102+number_format($fetch_report[3],0,'','');
						$sum103=$sum103+number_format($fetch_report[4],0,'','');
						$sum104=$sum104+number_format($fetch_report[5],0,'','');
						$sum105=$sum105+number_format($fetch_report[6],0,'','');
						$sum106=$sum106+number_format($fetch_report[7],0,'','');
					}else
					{	$temp_report.=" <tr bgcolor='#99CCFF' height='20'>"; 
						$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
						$temp_report.="  <td align='right'>0</td> ";
						$temp_report.="  <td align='right'>".number_format($sum101)."</td> ";
						$temp_report.="  <td align='right'>".number_format($sum102)."</td> ";
						$temp_report.="  <td align='right'>".number_format($sum103)."</td> ";
						$temp_report.="  <td align='center'>-</td> ";
						$temp_report.="  <td align='right'>".number_format($sum104)."</td> ";
						$temp_report.="  <td align='right'>".number_format($sum105)."</td> ";
						$temp_report.="  <td align='right'>".number_format($sum106)."</td> ";
						$temp_report.=" <td></td>";
						$temp_report.="</tr> ";
						$sum101=0;   $sum102=0;	$sum103=0;
						$sum104=0;   $sum105=0;   $sum106=0;
						$sum101= number_format($fetch_report[2],0,'','');
						$sum102= number_format($fetch_report[3],0,'','');
						$sum103= number_format($fetch_report[4],0,'','');
						$sum104= number_format($fetch_report[5],0,'','');
						$sum105= number_format($fetch_report[6],0,'','');
						$sum106= number_format($fetch_report[7],0,'','');
						$temp_div = trim($fetch_report[0]);
					}
				} // end div=0

			$i++;	
			if(($i%2)==0)
			{	$temp_report.=" <tr bgcolor='#C0C0C0'>";  }
			else
			{  $temp_report.=" <tr>";  }
				$temp_report.="  <td align='center'>&nbsp;".trim($fetch_report[0])."</td>";
				$temp_report.=" <td>&nbsp;สกต.".trim($fetch_report[1])." [".$current_amc[$fetch_report[8]]."] </td>";
				$temp_report.="  <td align='right'>0</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[2])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[3])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[4])."</td> ";
				if(number_format($fetch_report[3], 0,'', '')==0)
						$temp_present = "0";
				else
				{	$temp_present = (number_format($fetch_report[4],0,'','')/number_format($fetch_report[3], 0,'', ''))*100;  }

				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[5])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[6])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[7])."</td> ";
				$temp_report.="  <td align='left'>".trim($fetch_report[9])."</td> ";  // สาเหตุการขาดทุน
				$temp_report.="</tr> ";

				$sum01=$sum01+number_format($fetch_report[2],0,'','');
				$sum02=$sum02+number_format($fetch_report[3],0,'','');
				$sum03=$sum03+number_format($fetch_report[4],0,'','');
				$sum04=$sum04+number_format($fetch_report[5],0,'','');
				$sum05=$sum05+number_format($fetch_report[6],0,'','');
				$sum06=$sum06+number_format($fetch_report[7],0,'','');
		}  // end while 
	//  แสดงฝ่ายสุดท้าย
	if($div==0)
	{		$temp_report.=" <tr bgcolor='#99CCFF' height='20'>"; 
			$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
			$temp_report.="  <td align='right'>0</td> ";
			$temp_report.="  <td align='right'>".number_format($sum101)."</td> ";
			$temp_report.="  <td align='right'>".number_format($sum102)."</td> ";
			$temp_report.="  <td align='right'>".number_format($sum103)."</td> ";
			$temp_report.="  <td align='center'>-</td> ";
			$temp_report.="  <td align='right'>".number_format($sum104)."</td> ";
			$temp_report.="  <td align='right'>".number_format($sum105)."</td> ";
			$temp_report.="  <td align='right'>".number_format($sum106)."</td> ";
			$temp_report.=" <td></td>";
			$temp_report.="</tr> ";
	}
	// สร้างข้อมูลส่วนท้ายตารางสรุปทั้งหมด
	$temp_report.=" <tr bgcolor='#FFFF99' height='25'>"; 
	$temp_report.="  <td align='center' colspan='2'><b> รวมข้อมูลทั้งหมด </b></td>";
	$temp_report.="  <td align='right'>0</td> ";
	$temp_report.="  <td align='right'>".number_format($sum01)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum02)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum03)."</td> ";
	$temp_report.="  <td align='center'>-</td> ";
	$temp_report.="  <td align='right'>".number_format($sum04)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum05)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum06)."</td> ";
	$temp_report.=" <td></td>";
	$temp_report.="</tr> ";
	$temp_report.="</table> ";
	$temp_report.="<br>";

   free_result($result_report);	
   close();
   echo $temp_report;
   ob_end_flush();
 ?>
</body></html>