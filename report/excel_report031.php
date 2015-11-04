<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="รายงานมูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย แยกประเภทสินค้า.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');

	connect();
	$month = trim($_GET["month"]);  //  เดือน
	$year = trim($_GET["year"]);  // ปี
	$div = trim($_GET["div"]);  //  ฝ่ายกิจการสาขา

	if(trim($_GET["div"])=='0')
		{ $div = '0'; 
		   $temp_header = "( รวมทั้งประเทศ )"; }
	else
	   { $div = trim($_GET["div"]); 
		  $temp_header = "ฝ่ายกิจการสาขา ".$div; }

	if($province=='')
			$province= '0';

	// แสดงรายงานรวบรวมผลิตผล โดยเป็นมุมมอง ฝสข. 1-9 
	$year1 = $year+1;	
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>รายงานมูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย แยกประเภทสินค้า</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<?
	$temp_report = "";  // ผลลัพธ์ที่จะต้องคืนค่า
	// หัวรายงาน
	$temp_report.="<br><br><strong><center>สหกรณ์การเกษตรเพื่อการตลาดลูกค้า ธ.ก.ส. จำกัด </center>";
	$temp_report.="<center> มูลค่าธุรกิจรวบรวมผลิตผล (เชื่อมโยงธุรกิจการผลิตการตลาดโดยขบวนการสหกรณ์และองค์กรชุมชน)  </center>";
	$temp_report.="<center>ผลการดำเนินงานสะสมของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";

	// สร้างหัวตารางรายงาน
	$temp_report.="<table  width='1420' border='1'>";
	$temp_report.="<tr height='25px'> ";
	$temp_report.=" <td colspan='16' align='left'>&nbsp;<font color='#0F7FAF'><b> 2. มูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย </b></font>&nbsp;</td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#75B33F'> ";
	$temp_report.="	<td colspan='2' rowspan='3' align='center' valign='middle' width='250'> รายการ </td>";
	$temp_report.="	<td colspan='8' align='center' width='600'> ซื้อสินค้าระหว่างปี </td>";
	$temp_report.="	<td colspan='5' rowspan='2' align='center' width='375'> ขายสินค้าระหว่างปี </td>";
	$temp_report.="	<td rowspan='3' align='center' valign='middle' width='120'> มูลค่าสินค้าที่จัดหาโดยไม่ผ่าน<br>บัญชีซื้อ-ขาย </td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#75B33F'> ";
	$temp_report.="	<td colspan='5' align='center' width='375'> รวม </td>";
	$temp_report.="	<td colspan='3' align='center' width='225'> เฉพาะที่ซื้อจาก TABCO</td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#75B33F'> ";
	$temp_report.="	<td align='center' width='75'> เป้าหมาย <br>(พันบาท)</td>";
	$temp_report.="	<td align='center' width='75'> เป้าหมาย <br>(หน่วย)</td>";
	$temp_report.="	<td align='center' width='75'> จริง <br>(พันบาท)</td>";
	$temp_report.="	<td align='center' width='75'> จริง <br>(หน่วย)</td>";
	$temp_report.="	<td align='center' width='75'> ผลต่าง(%) </td>";
	$temp_report.="	<td align='center' width='75'> จริง <br>(พันบาท)</td>";
	$temp_report.="	<td align='center' width='75'> จริง <br>(หน่วย)</td>";
	$temp_report.="	<td align='center' width='75'> คำนวณ </td>";
	$temp_report.="	<td align='center' width='75'> เป้าหมาย <br>(พันบาท)</td>";
	$temp_report.="	<td align='center' width='75'> เป้าหมาย <br>(หน่วย)</td>";
	$temp_report.="	<td align='center' width='75'> จริง <br>(พันบาท)</td>";
	$temp_report.="	<td align='center' width='75'> จริง <br>(หน่วย)</td>";
	$temp_report.="	<td align='center' width='75'> ผลต่าง(%) </td>";
	$temp_report.="</tr>";
	$temp_report.="<tbody> ";

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

			$current_amc[trim($fetch_amc[2])] = $month_report3[trim($fetch_amc[1])];			// แปลงค่าให้เป็นเดือนปัจจุบัน
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";
		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  ไม่เอาตัว 2 สุดท้ายมา   OR
		$display_sql.=" ) ";
//  **************************  สิ้นสุดการตรวจสอบ   ****************************************



// สร้างข้อมูลส่วนเนือ้หากลางตาราง
	$sql =" SELECT ";
	$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
	$sql.=" userlogin.br_code, userlogin.userdetail,   ";
	$sql.=" SUM(Temp02.PlanProcureBuy_Sum),   ";
	$sql.=" SUM(Temp01.product_buy_sum),   ";
	$sql.=" SUM(Temp01.product_buy_tabco),   ";
	$sql.=" SUM(Temp03.PlanProcureSell_Sum),   ";
	$sql.=" SUM(Temp01.product_sell_sum),  ";
	$sql.=" SUM(Temp01.product_procure),  ";
	$sql.=" SUM(Temp01.product_buy_unit),  ";
	$sql.=" SUM(Temp01.product_sell_unit),  ";
	$sql.=" SUM(Temp01.product_tabco_unit),  ";
	$sql.=" SUM(Temp02.PlanProcureBuy_Unit),   ";
	$sql.=" SUM(Temp03.PlanProcureSell_Unit)   ";
	$sql.=" FROM  BaseReportDetail,userlogin,BaseReportHeader  ";

	$sql.="  LEFT JOIN(   ";
	$sql.="  SELECT ReportGroup2.report_detail_code,    ";
	$sql.="  ReportGroup2.product_buy_sum,   ";
	$sql.="  ReportGroup2.product_buy_tabco,   ";
	$sql.="  ReportGroup2.product_sell_sum,   ";
	$sql.="  ReportGroup2.product_procure,  ";
	$sql.="  ReportGroup2.product_buy_unit,  ";
	$sql.="  ReportGroup2.product_sell_unit,  ";
	$sql.="  ReportGroup2.product_tabco_unit, "; 
	$sql.="  ReportGroup2.amccode  ";
	$sql.="  FROM ReportGroup2  ";
	$sql.="  WHERE ReportGroup2.report_year='".$year."' "; 
	//AND ReportGroup2.report_month='".$month."'    ";
	$sql.=" AND ".$display_sql;
	$sql.="  )AS Temp01    ";
	$sql.="  ON Temp01.report_detail_code = BaseReportHeader.report_detail_code    ";
	$sql.="  AND Temp01.amccode = BaseReportHeader.amccode   ";

	$sql.="  LEFT JOIN    ";
	$sql.="  ( SELECT PlanProcureBuy.report_detail_code, PlanProcureBuy.PlanProcureBuy_Sum  ";
	$sql.="  , PlanProcureBuy.amccode , PlanProcureBuy.PlanProcureBuy_Unit  ";
	$sql.="  FROM PlanProcureBuy  ";
	$sql.="  WHERE PlanProcureBuy_year='".$year."'  ";
	$sql.="  )AS Temp02    ";
	$sql.="  ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.="  AND Temp02.amccode = BaseReportHeader.amccode  ";

	$sql.="  LEFT JOIN    ";
	$sql.="  ( SELECT PlanProcureSell.report_detail_code, PlanProcureSell_Sum, PlanProcureSell.amccode  ";
	$sql.="  , PlanProcureSell.PlanProcureSell_Unit  ";
	$sql.="   FROM PlanProcureSell   ";
	$sql.="   WHERE PlanProcureSell_year='".$year."'   ";
	$sql.="   )AS Temp03   ";
	$sql.="  ON Temp03.report_detail_code = BaseReportHeader.report_detail_code    ";
	$sql.="  AND Temp03.amccode = BaseReportHeader.amccode  ";

	$sql.="  WHERE  ";
	$sql.="  userlogin.amccode = BaseReportHeader.amccode    ";
	$sql.="  AND BaseReportDetail.report_group_code = BaseReportHeader.report_group_code    ";
	$sql.="  AND BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code    ";
	$sql.="  AND BaseReportDetail.report_group_code='2'    ";
	$sql.="  AND userlogin.status = 'N'    ";

	if($div!='0')  // กรณีเลือกเป็นฝ่ายกิจการสาขา
	{	$sql.=" AND userlogin.br_code='".$div."' ";	}
	if($province!='0')
	{	$sql.=" AND userlogin.amccode='".$province."' "; }
  
	$sql.="  GROUP BY  ";
	$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
	$sql.=" userlogin.br_code, userlogin.userdetail  WITH ROLLUP   ";

	$sql.="  ORDER BY  ";
	$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
	$sql.=" userlogin.br_code  ";

	$result_report = query($sql);
	if(num_rows(query($sql))==0)
	{
		$temp_report ="<br><br><center><font color='red'> ไม่มีข้อมูลที่เลือก </font></center>";
		free_result($result_report);
		close();
		echo $temp_report;
		ob_end_flush();	
		exit();
	}
	$i = 0;
	//  แสดงข้อมูลทั้งหมด
	WHILE($fetch_report = fetch_row($result_report)) { 

		if( is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))  // สรุปรวมทั้งประเทศ
		{
			$temp_report.="<tr bgcolor='#FFFF99'>";
			$temp_report.="<td colspan='2'>&nbsp; รวมทั้งหมด </td>";
			$i = 0;
		}
		elseif( !is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3])){
			continue;   // ในกรณีที่แสดงเฉพาะประเภทสินค้า ให้ไม่ต้องแสดง
		}
		elseif( !is_null($fetch_report[0]) && !is_null($fetch_report[0]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))   // สรุปรวมแต่ละสินค้า
		{
			$temp_report.="<tr bgcolor='#99CCFF'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; รวมสินค้า ".trim($fetch_report[1])." </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[3])) // สรุปแต่ละ ฝ่าย. 
		{
			$temp_report.="<tr bgcolor='#FFCC99'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; ข้อมูล ฝ่าย  ".trim($fetch_report[2])." </td>";
			$i = 0;
		}
		else    // แสดงธรรมดาราย สกต.
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr bgcolor='#C0C0C0'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.=" <td width='50'>&nbsp;".trim($fetch_report[2])."</td>";   // ฝ่าย
			$temp_report.=" <td>&nbsp;".trim($fetch_report[3])."  [".$current_amc[trim($fetch_report[3])]."]  </td>";  // รายชื่อ สกต
		}  // end if

		$temp_report.="  <td align='right'>".number_format($fetch_report[4],0,'','')."</td> ";   // เป้าหมาย พันบาท ซื้อ
		$temp_report.="  <td align='right'>".number_format($fetch_report[13],0,'','')."</td>";  // เป้าหมาย หน่วย ซื้อ
		$temp_report.="  <td align='right'>".number_format($fetch_report[5],0,'','')."</td> ";  // จริง พันบาท
		$temp_report.="  <td align='right'>".number_format($fetch_report[10],0,'','')."</td>";  // จริง หน่วย ซื้อ
		if(number_format($fetch_report[4])==0)
			{	$temp_present = "0"; }
		else
			{	$temp_present = number_format($fetch_report[5],0,'','')/(number_format($fetch_report[4], 0,'', '')/100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[6],0,'','')."</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[12],0,'','')."</td> ";  // จริง หน่วย tabco
		if(number_format($fetch_report[5])==0)
			{	$temp_present = "0"; }
		else
			{	$temp_present = (number_format($fetch_report[6],0,'', '')/number_format($fetch_report[5],0,'', ''))*100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[7],0,'','')."</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[14],0,'','')."</td> ";  // เป้าหมาย หน่วย ขาย
		$temp_report.="  <td align='right'>".number_format($fetch_report[8],0,'','')."</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[11],0,'','')."</td> ";   // จริง หน่วย ขาย
			if(number_format($fetch_report[7])==0)
				{	$temp_present = "0"; }
			else
				{	$temp_present = number_format($fetch_report[8],0,'', '')/(number_format($fetch_report[7],0,'', '')/100)-100;  } 
		$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[9],0,'','')."</td> ";
		$temp_report.="</tr> ";
	} // end while

	$temp_report.="</table> ";
	$temp_report.="<br>";
	free_result($result_report);
    close();

	echo $temp_report;
	ob_end_flush();	
 ?>
 </body></html>