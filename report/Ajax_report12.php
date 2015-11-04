<?php session_start();
	ob_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../lib/config.inc.php");
	include("../lib/database.php");
	include("../lib/function.php");

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

	$temp_report = "";  // ผลลัพธ์ที่จะต้องคืนค่า
	// หัวรายงาน
	$temp_report.="<strong><center>สหกรณ์การเกษตรเพื่อการตลาดลูกค้า ธ.ก.ส. จำกัด </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center>รายงานผลการดำเนินงานสะสมของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	$temp_report.="<center> ข้อมูล ณ วันที่ ".datetoday()." เวลา ".date("G:i:s")."</center>";

	//สร้างข้อมูลหัวรายงาน สมาชิก ธุรกิจ กับ สกต.
	$temp_report.="<table width='580' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='5' align='left'>&nbsp;<font color='#0F7FAF'><b> แหล่งเงินกู้ (หน่วย:พันบาท) </b></font></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_pink'>  ";
	$temp_report.="   <td  width='60' align='center' rowspan='2'>ฝ่าย</td> ";
	$temp_report.="   <td  width='160' align='center' rowspan='2' >สกต.</td> ";
	$temp_report.="   <td  align='center' colspan='3' > รายได้ค่าบริการ </td> ";
	$temp_report.="</tr><tr class='rows_pink'>";
	$temp_report.="   <td  width='120' align='center'>เป้าหมาย</td> ";
	$temp_report.="   <td  width='120' align='center'>จริง</td> ";
	$temp_report.="   <td  width='120' align='center'>ผลต่าง</td> ";
	$temp_report.=" </tr> ";

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
		if($province!='0' AND trim($province)!='' )
		{	$sql.=" AND userlogin.amccode='".$province."' "; }

		$result_amc = query($sql);
		query(" DROP TABLE #Temp_SentReport ");

		$display_sql = " ( "; // เก็บค่าว่ามี สกต ส่งข้อมูลล่าสุดเดือนไหน 
		WHILE($fetch_amc = fetch_row($result_amc)) { 

			$current_amc[trim($fetch_amc[0])] = $month_report3[trim($fetch_amc[1])];			// แปลงค่าให้เป็นเดือนปัจจุบัน
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";
		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  ไม่เอาตัว 2 สุดท้ายมา   OR
		$display_sql.=" ) ";
//  **************************  สิ้นสุดการตรวจสอบ   ****************************************

	// คำสั่ง sql ค่าบริการ
	$sql = " SELECT  br_code,userdetail,Temp01.PlanService_Sum,Temp02.service_value,userlogin.amccode ";
	$sql.=" FROM userlogin ";

	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(PlanService_Sum)AS PlanService_Sum,amccode ";
	$sql.=" FROM PlanService ";
	$sql.=" WHERE PlanService_year='".$year."' ";
	$sql.=" GROUP BY amccode ";
	$sql.=" )AS Temp01 ON Temp01.amccode = userlogin.amccode ";

	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT amccode,SUM(service_value)AS service_value ";
	$sql.=" FROM ReportGroup4 ";
	$sql.=" WHERE report_year='".$year."' "; // AND report_month='".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" GROUP BY amccode )AS Temp02 ";
	$sql.=" ON Temp02.amccode = userlogin.amccode ";

	$sql.=" WHERE status='N' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";

	$result_report = query($sql);
	$i=0;    // สร้างข้อมูลส่วนเนื้อหา ตัน
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}

	WHILE($fetch_report = fetch_row($result_report)) { 

		if($div==0)  //  สรุปข้อมูลในแต่ละฝ่าย
		{
			if($temp_div==trim($fetch_report[0]))
			{	
				$sum101=$sum101+number_format($fetch_report[2],0,'','');
				$sum102=$sum102+number_format($fetch_report[3],0,'','');
			}else
			{	$temp_report.=" <tr class='rows_sky' height='20'>"; 
				$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
				$temp_report.="  <td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
				$temp_report.="  <td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
				$temp_report.="  <td align='center'>&nbsp;</td>";
				$temp_report.="	</tr>";
				$sum101=0;		$sum102=0;
				$sum101= number_format($fetch_report[2],0,'','');
				$sum102= number_format($fetch_report[3],0,'','');
				$temp_div = trim($fetch_report[0]);
			}
		} // end div=0

		$i++;	
		if(($i%2)==0)
		{	$temp_report.="<tr class='rows_grey'>";  }
		else
		{  $temp_report.="<tr>";  }

		$temp_report.="  <td align='center'>".trim($fetch_report[0])."</td>";
		$temp_report.=" <td><a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[4])."\",\"".trim($fetch_report[1])."\")' > &nbsp;สกต.".trim($fetch_report[1])."</a>  [".$current_amc[$fetch_report[4]]."] </td>";
		$temp_report.="  <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
		if(number_format($fetch_report[2])==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = number_format($fetch_report[3],0,'','')/(number_format($fetch_report[2], 0,'', '')/100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%&nbsp;</td> ";
		$temp_report.="</tr>";
		
		$sum01=$sum01+number_format($fetch_report[2],0,'','');
		$sum02=$sum02+number_format($fetch_report[3],0,'','');
	} // end while 

	if($div==0)
	{	
		$temp_report.=" <tr class='rows_sky' height='20'>"; 
		$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
		$temp_report.=" <td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
		$temp_report.=" <td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
		$temp_report.=" <td align='center'>&nbsp;</td>";
		$temp_report.="	</tr>";
	}
	// สร้างข้อมูลส่วนท้าย ตัน
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center' colspan='2'> รวม </td>";
	$temp_report.=" <td align='right'>".number_format($sum01,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum02,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" </tr></table>";
	$temp_report.="<br>";
	$temp_report.="<center><a href='excel_report12.php?year=".$year."&month=".$month."&div=".$div."&province=".$province."&province_name=".$province_name."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";

   free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();