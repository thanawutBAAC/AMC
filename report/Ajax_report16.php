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
	$temp_report.="<table width='2070' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr class='rows_pink'> ";
	$temp_report.="  <td rowspan='2'  colspan='2' align='center' width='200'> ผลิตผล </td> ";
	$temp_report.="  <td align='center'> เป้าหมาย <br>มี.ค.".$year1." </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.1 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.2 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.3 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.4 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.5 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.6 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.7 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.8 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ฝสข.9 </td> ";
	$temp_report.="  <td colspan='2' align='center'> รวมผลผลิต </td> ";
	$temp_report.="  <td align='center'> เป้าหมาย <br> ".$month_thai[$month]."</td> ";
	$temp_report.="  <td align='center'> ผลต่าง </td> ";
	$temp_report.="  <td align='center'> เทียบ % </td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> มูลค่า </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.="  <td width='70' align='center'> ปริมาณ </td> ";
	$temp_report.=" </tr> ";
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
	$sql =" SELECT BaseSubProduct.sub_pro_name, ";
	$sql.=" BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail, ";
	$sql.=" SUM(Temp01.target_value) AS sum_target, ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='1' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='1' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='2' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='2' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) ,	";
	$sql.=" SUM(CASE WHEN userlogin.br_code='3' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='3' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='4' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='4' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='5' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='5' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='6' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='6' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='7' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='7' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='8' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='8' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='9' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='9' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(Temp04.target_value) ";
	$sql.=" FROM userlogin, BaseSubProduct, BaseProduct, BaseReportHeader ";

/* เป้าหมายตามบันทึกข้อตกลง */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND target_month='3' ) AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp01.amccode=BaseReportHeader.amccode  ";

/* ผลการรวบรวมระหว่างปี ตามบันทึกข้อตกลง  3  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT data2, data3, data5, data6,  ";
	$sql.=" data7, data8, report_detail_code, amccode  ";
	$sql.=" FROM ReportGroup3  ";
//	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."') AS Temp03  ";
	$sql.=" WHERE report_year='".$year."' AND ".$display_sql." ) AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp03.amccode=BaseReportHeader.amccode  ";

/* เป้าหมายตามบันทึกข้อตกลง  สะสมประจำเดือน  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
//	$sql.=" WHERE target_year='".$year."' AND target_month='".$month."' ) AS Temp04  ";
	$sql.=" WHERE target_year='".$year."' AND ".$display_sql2." ) AS Temp04  ";
	$sql.=" ON Temp04.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp04.amccode=BaseReportHeader.amccode  ";

	$sql.=" WHERE BaseSubProduct.sub_pro_code = BaseProduct.sub_pro_code ";
	$sql.=" AND BaseReportHeader.report_group_code = '3' ";
	$sql.=" AND BaseReportHeader.report_detail_code =  BaseProduct.pro_code  ";
	$sql.=" AND BaseReportHeader.amccode = userlogin.amccode ";
	$sql.=" AND userlogin.status = 'N' ";

	if($div!=0)  // กรณีเลือกเป็นฝ่ายกิจการสาขา
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY BaseSubProduct.sub_pro_name, ";
	$sql.=" BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail WITH ROLLUP ";

	$sql.=" ORDER BY BaseSubProduct.sub_pro_name,BaseProduct.pro_name, userlogin.br_code ";

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
	$j = 1;  // ควบคุมการแสดงของ page 
	//  แสดงข้อมูลทั้งหมด
	WHILE($fetch_report = fetch_row($result_report)) { 

	 //  ตรวจสอบว่ามีการสรุปรวม  ลักษณะราย สกต ที่ไม่ต้องการ ก็ไม่ต้องให้แสดง
		if( !is_null($fetch_report[0]) && !is_null($fetch_report[1]) && !is_null($fetch_report[2]) && is_null($fetch_report[3])){
			continue;
		} // end if 

		if( is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]) )  // สรุปรวมทั้งประเทศ
		{
			$temp_report.="<tr class='rows_yellow'>";
			$temp_report.="<td colspan='2'>&nbsp; รวมทั้งประเทศ </td>";
			$i = 0;
		}
		elseif(!is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))   // สรุปรวมแต่ละผลผลิตหลัก
		{
			$temp_report.="</tbody>";
			$temp_report.="<tr class='rows_sky'>"; 
			$temp_report.=" <td colspan='2'>&nbsp;<img id='pic".$j."' src='../images/icon_plus.gif' style='cursor: hand'  onclick=showhide(page".$j.",'pic".$j."') > รวม ".trim($fetch_report[0])." </td>";
			$i = 0;
		}
		elseif(!is_null($fetch_report[0]) && !is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))  // สรุปแต่ละ ผลผลิตย่อย
		{
			$temp_report.="<tr class='rows_orange'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; รวม ".trim($fetch_report[1])." </td>";
			$i = 0;
		}
		else    // แสดงธรรมดา
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr class='rows_grey'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.=" <td width='230' nowrap>&nbsp;".trim($fetch_report[1])."</td>";   // ผลผลิตย่อย
			$temp_report.=" <td width='150' nowrap>&nbsp;".trim($fetch_report[2])."&nbsp;".trim($fetch_report[3])." [".$current_amc[trim($fetch_report[3])]."] </td>";  // รายชื่อ ฝ่าย / สกต.
		}  // end if
		
		$temp_sum1 = 0;   // รวมปริมาณ ชั่วคราว
		$temp_sum2 = 0;  // รวมมูลค่า ชั่วคราว
		$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td>";  // เป้าหมาย tris ปริมาณ
		$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td>";  // ปริมาณ ฝ่าย 1
		$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td>";  // มูลค่า ฝ่าย 1
		$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td>";  // ปริมาณ ฝ่าย 2
		$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td>";  // มูลค่า ฝ่าย 2
		$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td>";  // ปริมาณ ฝ่าย 3
		$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td>";  // มูลค่า ฝ่าย 3
		$temp_report.=" <td align='right'>".number_format($fetch_report[11])."&nbsp;</td>";  // ปริมาณ ฝ่าย 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[12])."&nbsp;</td>";  // มูลค่า ฝ่าย 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[13])."&nbsp;</td>";  // ปริมาณ ฝ่าย 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[14])."&nbsp;</td>";  // มูลค่า ฝ่าย 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[15])."&nbsp;</td>";  // ปริมาณ ฝ่าย 6
		$temp_report.=" <td align='right'>".number_format($fetch_report[16])."&nbsp;</td>";  // มูลค่า ฝ่าย 6
		$temp_report.=" <td align='right'>".number_format($fetch_report[17])."&nbsp;</td>";  // ปริมาณ ฝ่าย 7
		$temp_report.=" <td align='right'>".number_format($fetch_report[18])."&nbsp;</td>";  // มูลค่า ฝ่าย 7
		$temp_report.=" <td align='right'>".number_format($fetch_report[19])."&nbsp;</td>";  // ปริมาณ ฝ่าย 8
		$temp_report.=" <td align='right'>".number_format($fetch_report[20])."&nbsp;</td>";  // มูลค่า ฝ่าย 8
		$temp_report.=" <td align='right'>".number_format($fetch_report[21])."&nbsp;</td>";  // ปริมาณ ฝ่าย 9
		$temp_report.=" <td align='right'>".number_format($fetch_report[22])."&nbsp;</td>";  // มูลค่า ฝ่าย 9
		$temp_sum1 = number_format($fetch_report[5]+$fetch_report[7]+$fetch_report[9]+$fetch_report[11]+$fetch_report[13]+$fetch_report[15]+$fetch_report[17]+$fetch_report[19]+$fetch_report[21],0,'','');  // รวมปริมาณชั่วคราว
		$temp_sum2 = number_format($fetch_report[6]+$fetch_report[8]+$fetch_report[10]+$fetch_report[12]+$fetch_report[14]+$fetch_report[16]+$fetch_report[18]+$fetch_report[20]+$fetch_report[22],0,'','');  // รวมมูลค่าชั่วคราว
		$temp_report.=" <td align='right'>".number_format($temp_sum1)."&nbsp;</td>";  //  รวมปริมาณ
		$temp_report.=" <td align='right'>".number_format($temp_sum2)."&nbsp;</td>";  //  รวม มูลค่า
		$temp_report.=" <td align='right'>".number_format($fetch_report[23])."&nbsp;</td>";  // เป้าหมาย สะสม ปริมาณ ณ เดือน
		$temp_sum3 = number_format($temp_sum1-$fetch_report[23],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_sum3)."&nbsp;</td>";  //  ผลต่าง 
		
		if( number_format($fetch_report[23],0,'','')==0){	 // เก็บข้อมูล เทียบ % ชั่วคราว
			$temp_sum3 = 100;
		}else{
			$temp_sum3 = number_format(($temp_sum1/$fetch_report[23])*100,2,'.',''); 
		}

		$temp_report.=" <td align='right'>".number_format($temp_sum3,2,'.','')."%&nbsp;</td>";// เทียบเปอร์เซ็นต์
		$temp_report.="</tr>";

	//  ซ่อนข้อมูลภายในผลผลิตหลัก  เอาไว้ก่อน
		if( !is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3])) 
		{	
			$temp_report.="<tbody id=page".$j." style='DISPLAY: none'>";
			$j++;
		}  // end if 

	} // end while

	$temp_report.="</tbody>";
	$temp_report.="</table> ";

	$temp_report.="<br>";
	$temp_report.="<center><a href='excel_report16.php?div=".$div."&year=".$year."&month=".$month."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";
	free_result($result_report);
    close();

	echo $temp_report;
	ob_end_flush();	