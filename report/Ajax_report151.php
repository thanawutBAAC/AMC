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
	$month = trim($_GET["month"]);  //  เดือน
	$year = trim($_GET["year"]);  // ปี
	$div = trim($_GET["div"]);  //  ฝ่ายกิจการสาขา

	if(trim($_GET["div"])=='0')
		{ $div = '0'; 
		   $temp_header = "( รวมทั้งประเทศ )"; }
	else
	   { $div = trim($_GET["div"]); 
		  $temp_header = "ฝ่ายกิจการสาขา ".$div; }

	// แสดงรายงานรวบรวมผลิตผล โดยเป็นมุมมอง ฝสข. 1-9 
	$year1 = $year+1;	

	$temp_report = "";  // ผลลัพธ์ที่จะต้องคืนค่า
	// หัวรายงาน
	$temp_report.="<br><br><strong><center>สหกรณ์การเกษตรเพื่อการตลาดลูกค้า ธ.ก.ส. จำกัด </center>";
	$temp_report.="<center> มูลค่าธุรกิจรวบรวมผลิตผล (เชื่อมโยงธุรกิจการผลิตการตลาดโดยขบวนการสหกรณ์และองค์กรชุมชน)  </center>";
	$temp_report.="<center>ผลการดำเนินงานสะสมของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	$temp_report.="<center> ข้อมูล ณ วันที่ ".datetoday()." เวลา ".date("G:i:s")."</center>";

	// สร้างหัวตารางรายงาน
	$temp_report.="<table width='2000' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr> ";
	$temp_report.=" <td colspan='24' height='22'><font color='#0F7FCC'><b>&nbsp;&nbsp; มูลค่าธุรกิจรวบรวมผลิตผล (เชื่อมโยงธุรกิจการผลิตผลการตลาดโดยขบวนการสหกรณ์และองค์กรชุมชน) <font color='red'> มุมมอง ฝสข.</font></b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'> ";
	$temp_report.=" <td rowspan='4' colspan='2' align='center' width='320'>ฝสข/จำนวน<br> สาขา/ผลิตผล <br> ข้อมูลเดือน  </td> ";
	$temp_report.=" <td rowspan='2' align='center'>(1) เป้าหมาย<br>ตามบันทึก<br>ข้อตกลง</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center'> (2) เป้าหมาย <br>การรวบรวม <br>ผลิตผล ของ สกต.</td> ";
	$temp_report.=" <td colspan='6'>&nbsp;&nbsp; 3. ผลการรวบรวมระหว่างปี (ตัวชี้วัดของ Tris / บันทึกข้อตกลง)</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center'> (4) สกต./สนจ. สนับสนุน <br>การกระจาย <br>ผลิตผล/ผลิตภัณฑ์ </td> ";
	$temp_report.=" <td colspan='3' rowspan='2' align='center'> (5) ผลการดำเนินงาน <br>(3.1+3.2+4) <br>(Tris/บันทึกข้อตกลง) </td> ";
	$temp_report.=" <td colspan='2' rowspan='3' align='center' valign='middle'>(6) เป้าหมายการจำหน่ายผลิตผล ของสกต</td> ";
	$temp_report.=" <td colspan='4' align='center' >(7) ผลการจำหน่ายระหว่างปี</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(8) มูลค่า ผลิตผลคงเหลือ</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(9) เป็นนายหน้า/ตัวแทน</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_pink'> ";
	$temp_report.=" <td colspan='3' align='center'> (3.1) สกต.รวบรวม <br> ผลิตผล/ผลิตภัณฑ์ <br>จากสมาชิกและเกษตรกรทั่วไป</td> ";
	$temp_report.=" <td colspan='3' align='center'>(3.2) สนจ. สนับสนุน <br> องค์กรชุมชน รวบรวม <br> ผลิตผล/ผลิตภัณฑ์ผ่าน   สกต.</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายรวม</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายให้TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_pink'> ";
	$temp_report.=" <td align='center'> มี.ค.".$year1." </td> ";
	$temp_report.=" <td colspan='2' align='center'> สกต.ตั้งเป้าทั้งปี </td> ";
	$temp_report.=" <td colspan='3' align='center'> ผลการรวบรวม ถึง 31/03/".$year1."</td> ";
	$temp_report.=" <td colspan='3' align='center'> ผลการสนับสนุนรวบรวม</td> ";
	$temp_report.=" <td align='center'> ปริมาณ </td> ";
	$temp_report.=" <td align='center'> มูลค่า </td> ";
	$temp_report.=" <td align='center'> เป้าสะสม </td> ";
	$temp_report.=" <td align='center'> ปริมาณ </td> ";
	$temp_report.=" <td align='center'> มูลค่า </td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_green'> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(ราย)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(องค์กร)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td width='90' align='center'> ".$month_thai[$month]." 2552 </td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='85'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='80'>(ราคาทุน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.="</tr> ";
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

// สร้างข้อมูลส่วนเนือ้หากลางตาราง
	$sql = " SELECT userlogin.br_code,  ";
	$sql.=" userlogin.userdetail, ";
	$sql.=" BaseReportDetail.report_detail_name, ";
	$sql.=" SUM(Temp01.target_value), ";
	$sql.=" SUM(Temp02.PlanCollectBuy_Unit), ";
	$sql.=" SUM(Temp02.PlanCollectBuy_Sum), ";
	$sql.=" SUM(Temp03.data1), SUM(Temp03.data2), SUM(Temp03.data3),  ";
	$sql.=" SUM(Temp03.data4), SUM(Temp03.data5), SUM(Temp03.data6),  ";
	$sql.=" SUM(Temp03.data7), SUM(Temp03.data8), ";
	$sql.=" SUM(Temp04.target_value),  ";
	$sql.=" SUM(Temp05.PlanCollectSell_Unit), SUM(Temp05.PlanCollectSell_Sum), ";
	$sql.=" SUM(Temp03.data9), SUM(Temp03.data10),  ";
	$sql.=" SUM(Temp03.data11),SUM(Temp03.data12), ";
	$sql.=" SUM(Temp03.data13), SUM(Temp03.data14)  ";
	$sql.=" FROM userlogin,BaseReportDetail,BaseReportHeader  ";

/* เป้าหมายตามบันทึกข้อตกลง  มี.ค. */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND target_month='3' ) AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp01.amccode=BaseReportHeader.amccode  ";

/* เป้าหมายการรวบรวม ผลิตผล ของ สกต. */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT PlanCollectBuy.PlanCollectBuy_Sum,  ";
	$sql.=" PlanCollectBuy.PlanCollectBuy_Unit,  ";
	$sql.=" PlanCollectBuy.report_detail_code, PlanCollectBuy.amccode  ";
	$sql.=" FROM PlanCollectBuy  ";
	$sql.=" WHERE PlanCollectBuy.PlanCollectBuy_year='".$year."' ) AS Temp02  ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp02.amccode=BaseReportHeader.amccode  ";

/* ผลการรวบรวมระหว่างปี ตามบันทึกข้อตกลง  3  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT data1, data2, data3, data4, data5,  ";
	$sql.=" data6, data7, data8, data9 , ";
	$sql.=" data10, data11 , data12 , ";
	$sql.=" data13, data14, report_detail_code, amccode  ";
	$sql.=" FROM ReportGroup3  ";
	$sql.=" WHERE report_year='".$year."' AND ".$display_sql.") AS Temp03  ";
//	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."') AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp03.amccode=BaseReportHeader.amccode  ";

/* เป้าหมายตามบันทึกข้อตกลง  สะสมประจำเดือน  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND ".$display_sql2." ) AS Temp04  ";
//	$sql.=" WHERE target_year='".$year."' AND target_month='".$month."' ) AS Temp04  ";
	$sql.=" ON Temp04.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp04.amccode=BaseReportHeader.amccode  ";

/*   เป้าหมายการจำหน่ายผลิตผล ของสกต */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" PlanCollectSell.PlanCollectSell_Sum,  ";
	$sql.=" PlanCollectSell.PlanCollectSell_Unit,  ";
	$sql.=" PlanCollectSell.report_detail_code,  ";
	$sql.=" PlanCollectSell.amccode ";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year='".$year."') AS Temp05  ";
	$sql.=" ON Temp05.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp05.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode ";
	$sql.=" AND BaseReportHeader.report_group_code = BaseReportDetail.report_group_code ";
	$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" AND BaseReportHeader.report_group_code = '3' ";
	$sql.=" AND userlogin.status = 'N' ";

	if($div!=0)  // กรณีเลือกเป็นฝ่ายกิจการสาขา
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY userlogin.br_code, userlogin.userdetail,  ";
	$sql.=" BaseReportDetail.report_detail_name WITH ROLLUP ";
	
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail  ";
	
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

		if( is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]))  // สรุปรวมทั้งประเทศ
		{
			$temp_report.="<tr class='rows_yellow'>";
			$temp_report.="<td colspan='2'>&nbsp; รวมทั้งประเทศ </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[1]) && is_null($fetch_report[2]))   // สรุปรวมแต่ละฝ่าย
		{
			$temp_report.="</tbody>";
			$temp_report.="<tr class='rows_sky'>"; 
			$temp_report.=" <td colspan='2'>&nbsp;<img id='pic".trim($fetch_report[0])."' src='../images/icon_plus.gif' style='cursor: hand'  onclick=showhide(page".trim($fetch_report[0]).",'pic".trim($fetch_report[0])."') > รวมฝ่าย ".trim($fetch_report[0])." </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[2])) // สรุปแต่ละ สกต. 
		{
			$temp_report.="<tr class='rows_orange'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; ข้อมูล สกต.".trim($fetch_report[1])."  [".$current_amc[trim($fetch_report[1])]."] </td>";
			$i = 0;
		}
		else    // แสดงธรรมดา
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr class='rows_grey'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.=" <td width='80' nowrap>&nbsp;".trim($fetch_report[1])."</td>";   // สกต
			$temp_report.=" <td width='180' nowrap>&nbsp;".trim($fetch_report[2])."</td>";  // รายชื่อผลผลิต
		}  // end if
	
		$temp_report.=" <td align='right'>".number_format($fetch_report[3])."&nbsp;</td>";  // เป้าหมาย tris
		$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td>";  // เป้าหมาย สกก 4  ตัน
		$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td>";  // เป้าหมาย สกก 4  พันบาท
		$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td>";  // ราย 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td>";  //  ตัน 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td>";  //  พันบาท 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td>";  //  องค์กร 3.2
		$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td>";  //  ตัน 3.2 
		$temp_report.=" <td align='right'>".number_format($fetch_report[11])."&nbsp;</td>";  // พันบาท 3.2 
		$temp_report.=" <td align='right'>".number_format($fetch_report[12])."&nbsp;</td>";  //  ตัน 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[13])."&nbsp;</td>";  //  พัน 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[14])."&nbsp;</td>";  //  เป้าหมายสะสม สกก4 ประจำเดือน  5
		$temp_sum1 = number_format($fetch_report[7],0,'','')+number_format($fetch_report[10],0,'','')+number_format($fetch_report[12],0,'','');
		$temp_sum2 = number_format($fetch_report[8],0,'','')+number_format($fetch_report[11],0,'','')+number_format($fetch_report[13],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_sum1)."&nbsp;</td>";  //  ตัน 5
		$temp_report.=" <td align='right'>".number_format($temp_sum2)."&nbsp;</td>";  //  พัน 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[15])."&nbsp;</td>";  //  6  เป้าหมายการจำหน่ายผลิตผล  ตัน
		$temp_report.=" <td align='right'>".number_format($fetch_report[16])."&nbsp;</td>";  //  6  เป้าหมายการจำหน่ายผลิตผล  พันบาท
		$temp_report.=" <td align='right'>".number_format($fetch_report[17])."&nbsp;</td>";  //  7 จำหน่ายรวม ตัน
		$temp_report.=" <td align='right'>".number_format($fetch_report[18])."&nbsp;</td>";  //  7 จำหน่ายรวม พันบาท
		$temp_report.=" <td align='right'>".number_format($fetch_report[19])."&nbsp;</td>";  //  7 จำหน่ายให้TABCO ตัน
		$temp_report.=" <td align='right'>".number_format($fetch_report[20])."&nbsp;</td>";  //  7 จำหน่ายให้TABCO พันบาท
		$temp_report.=" <td align='right'>".number_format($fetch_report[21])."&nbsp;</td>";  //  8 มูลค่า ผลิตผลคงเหลือ
		$temp_report.=" <td align='right'>".number_format($fetch_report[22])."&nbsp;</td>";  //  9 นายหน้าตัวแทน
		$temp_report.="</tr>";

		if( !is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]))  //  ซ่อนข้อมูลฝ่ายในฝ่าย เอาไว้ก่อน
		{	
			$temp_report.="<tbody id=page".$fetch_report[0]." style='DISPLAY: none'>";
		}  // end if 

	} // end while

	$temp_report.="</tbody>";
	$temp_report.="</table> ";

	$temp_report.="<br>";
	$temp_report.="<center><a href='excel_report151.php?div=".$div."&year=".$year."&month=".$month."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";
	free_result($result_report);
    close();

	echo $temp_report;
	ob_end_flush();	