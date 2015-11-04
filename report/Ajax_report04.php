<?php session_start();
	ob_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
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

	$temp_report = "";  // ผลลัพธ์ที่จะต้องคืนค่า
	// หัวรายงาน
	$temp_report.="<strong><center>สหกรณ์การเกษตรเพื่อการตลาดลูกค้า ธ.ก.ส. จำกัด </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center>รายงานผลการดำเนินงานของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	
	//สร้างข้อมูลหัวรายงาน พันบาท
	$temp_report.="<table width='975' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b> 3.1 รายงานมูลค่าธุรกิจรวบรวมผลิตผล (หน่วย: พันบาท) </b></font><a href='#' OnClick=' doCallAjax5(".$div.",".$year.",".$month."); ' > [รายละเอียด] </a></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="   <td rowspan='3' width='180' align='center' valign='middle'>รายการ<br>(จำนวน สกต.)</td> ";
	$temp_report.="   <td rowspan='2' colspan='3' align='center' valign='middle'>รวบรวมระหว่างปี</td> ";
	$temp_report.="	   <td colspan='5' align='center'  valign='middle'>จำหน่ายระหว่างปี</td> ";
	$temp_report.="	   <td rowspan='3' width='85' align='center' valign='middle'>มูลค่าผลผลิต<br>คงเหลือ<br>ราคาทุน</td> ";
	$temp_report.="	   <td rowspan='3' width='85' align='center' valign='middle'>เป็นนายหน้า / <br>ตัวแทน</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="    <td colspan='3' align='center'>รวม</td> ";
	$temp_report.="    <td colspan='2' align='center'>จำหน่ายให้ TABCO</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="  <td align='center' width='80'>เป้าหมาย</td> ";
	$temp_report.="  <td align='center' width='80'>จริง</td> ";
	$temp_report.="  <td align='center' width='75'>ผลต่าง %</td> ";
	$temp_report.="  <td align='center' width='80'>เป้าหมาย</td> ";
	$temp_report.="  <td align='center' width='80'>จริง</td> ";
	$temp_report.="  <td align='center' width='75'>ผลต่าง %</td> ";
	$temp_report.="  <td align='center' width='80'>จริง</td> ";
	$temp_report.="  <td align='center' width='75'>สัดส่วน</td> ";
	$temp_report.=" </tr> ";
	// คำสั่ง sql  พันบาท
	$sql =" SELECT DISTINCT BaseReportDetail.report_detail_code, ";
	$sql.=" BaseReportDetail.report_detail_name, Temp01.PlanCollectBuy_Sum, ";
	$sql.=" Temp02.data368, Temp03.PlanCollectSell_Sum, ";
	$sql.=" Temp02.data10, Temp02.data12, Temp02.data13, Temp02.data14, Temp04.COUNT01 ";
	$sql.=" FROM BaseReportHeader,BaseReportDetail ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectBuy_Sum)AS PlanCollectBuy_Sum, report_detail_code ";
	$sql.="  FROM PlanCollectBuy,userlogin ";
	$sql.="  WHERE PlanCollectBuy_year='".$year."' ";
	$sql.="  AND PlanCollectBuy.amccode = userlogin.amccode ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="  GROUP BY report_detail_code ";
	$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" LEFT JOIN ( ";
	$sql.="  SELECT SUM(data3+data6+data8)AS data368 ,SUM(data10)AS data10, ";
	$sql.="         SUM(data12)AS data12,SUM(data13)AS data13, ";
	$sql.="         SUM(data14)AS data14, report_detail_code ";
	$sql.="  FROM ReportGroup3,userlogin ";
	$sql.="  WHERE ReportGroup3.amccode = userlogin.amccode  ";
	$sql.="  AND report_year='".$year."' AND report_month='".$month."' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="  GROUP BY report_detail_code ";
	$sql.=" )AS Temp02 ON Temp02.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT SUM(PlanCollectSell_Sum)AS PlanCollectSell_Sum, report_detail_code ";
	$sql.="  FROM PlanCollectSell,userlogin ";
	$sql.="  WHERE PlanCollectSell_year='".$year."' ";
	$sql.="  AND PlanCollectSell.amccode = userlogin.amccode ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="  GROUP BY report_detail_code ";
	$sql.=" )AS Temp03 ON Temp03.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT COUNT(DISTINCT BaseReportHeader.amccode)AS COUNT01, ";
	$sql.="   BaseReportHeader.report_detail_code ";
	$sql.="   FROM BaseReportHeader,userlogin ";
	$sql.="   WHERE BaseReportHeader.amccode = userlogin.amccode ";
	$sql.="   AND BaseReportHeader.report_group_code='3' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="   GROUP BY BaseReportHeader.report_detail_code ";
	$sql.=" )AS Temp04 ON Temp04.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.="  WHERE BaseReportHeader.report_group_code='3' ";
	$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code ";
	$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code "; 
	
	$result_report = query($sql);

	$sum01=0;
	$sum02=0;
	$sum03=0;
	$sum04=0;
	$sum05=0;
	$i=0;    // สร้างข้อมูลส่วนเนื้อหา พันบาท
	WHILE($fetch_report = fetch_row($result_report)) { 
		$i++;	
		if(($i%2)==0)
		{	$temp_report.=" <tr class='rows_grey'>";  }
		else
		{  $temp_report.=" <tr>";  }

		$temp_report.="  <td align='left'>&nbsp; <a href='#' OnClick=' doCallAjax41(".$div.",".$year.",".$month.",".trim($fetch_report[0]).",\"".trim($fetch_report[1])."\") '>".trim($fetch_report[1])."(".$fetch_report[9].")</a></td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
		if(number_format($fetch_report[2],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[3],0,'','')/number_format($fetch_report[2], 0,'', '')*100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // ผลต่าง
		$temp_report.="  <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[5])."&nbsp;</td> ";
		if(number_format($fetch_report[4],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[5],0,'','')/number_format($fetch_report[4], 0,'', '')*100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // ผลต่าง
		$temp_report.="  <td align='right'>".number_format($fetch_report[6])."&nbsp;</td> ";
		if(number_format($fetch_report[5],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[6],0,'','')/number_format($fetch_report[5], 0,'', ''))*100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // ผลต่าง
		$temp_report.="  <td align='right'>".number_format($fetch_report[7])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[8])."&nbsp;</td> ";
		$temp_report.="</tr> ";

		$sum01=$sum01+number_format($fetch_report[2],0,'','');
		$sum02=$sum02+number_format($fetch_report[3],0,'','');
		$sum03=$sum03+number_format($fetch_report[4],0,'','');
		$sum04=$sum04+number_format($fetch_report[5],0,'','');
		$sum05=$sum05+number_format($fetch_report[6],0,'','');
		$sum06=$sum06+number_format($fetch_report[7],0,'','');
		$sum07=$sum07+number_format($fetch_report[8],0,'','');

	} // end while 

	// สร้างข้อมูลส่วนท้าย พันบาท
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center'> รวม </td>";
	$temp_report.=" <td align='right'>".number_format($sum01,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum02,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum03,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum04,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum05,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum06,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum07,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" </tr></table>";
//********************************************************************************//
	//สร้างข้อมูลหัวรายงาน ตัน
	$temp_report.="<table width='805' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b> 3.2 รายงานมูลค่าธุรกิจรวบรวมผลิตผล (หน่วย: ตัน) </b></font><a href='#' OnClick=' doCallAjax6(".$div.",".$year.",".$month."); '> [รายละเอียด] </a></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="   <td rowspan='3' width='180' align='center' valign='middle'>รายการ<br>(จำนวน สกต.)</td> ";
	$temp_report.="   <td rowspan='2' colspan='3' align='center' valign='middle'>รวบรวมระหว่างปี</td> ";
	$temp_report.="	   <td colspan='5' align='center'  valign='middle'>จำหน่ายระหว่างปี</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="    <td colspan='3' align='center'>รวม</td> ";
	$temp_report.="    <td colspan='2' align='center'>จำหน่ายให้ TABCO</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="  <td align='center' width='80'>เป้าหมาย</td> ";
	$temp_report.="  <td align='center' width='80'>จริง</td> ";
	$temp_report.="  <td align='center' width='75'>ผลต่าง %</td> ";
	$temp_report.="  <td align='center' width='80'>เป้าหมาย</td> ";
	$temp_report.="  <td align='center' width='80'>จริง</td> ";
	$temp_report.="  <td align='center' width='75'>ผลต่าง %</td> ";
	$temp_report.="  <td align='center' width='80'>จริง</td> ";
	$temp_report.="  <td align='center' width='75'>สัดส่วน</td> ";
	$temp_report.=" </tr> ";

	// สร้าง sql ตัน
	$sql = " SELECT DISTINCT BaseReportDetail.report_detail_code, ";
	$sql.=" BaseReportDetail.report_detail_name, Temp01.PlanCollectBuy_Unit, ";
	$sql.=" Temp02.data257,Temp03.PlanCollectSell_Unit, ";
	$sql.=" Temp02.data9,Temp02.data11,Temp04.COUNT01 ";
	$sql.="  FROM BaseReportHeader,BaseReportDetail ";
	$sql.="   LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectBuy_Unit)AS PlanCollectBuy_Unit, report_detail_code ";
	$sql.="   FROM PlanCollectBuy,userlogin ";
	$sql.="   WHERE PlanCollectBuy_year='".$year."' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="   AND PlanCollectBuy.amccode = userlogin.amccode ";
	$sql.="   GROUP BY report_detail_code ";
	$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" LEFT JOIN ( ";
	$sql.="   SELECT SUM(data2+data5+data7)AS data257 ,SUM(data9)AS data9, ";
	$sql.="          SUM(data11)AS data11,report_detail_code ";
	$sql.="   FROM ReportGroup3,userlogin ";
	$sql.="   WHERE ReportGroup3.amccode = userlogin.amccode  ";
	$sql.="   AND report_year='".$year."' AND report_month='".$month."' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="   GROUP BY report_detail_code ";
	$sql.=" )AS Temp02 ON Temp02.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.="  LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectSell_Unit)AS PlanCollectSell_Unit, report_detail_code ";
	$sql.="   FROM PlanCollectSell,userlogin ";
	$sql.="   WHERE PlanCollectSell_year='".$year."' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="   AND PlanCollectSell.amccode = userlogin.amccode ";
	$sql.="   GROUP BY report_detail_code ";
	$sql.=" )AS Temp03 ON Temp03.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT COUNT(DISTINCT BaseReportHeader.amccode)AS COUNT01, ";
	$sql.="   BaseReportHeader.report_detail_code ";
	$sql.="   FROM BaseReportHeader,userlogin ";
	$sql.="   WHERE BaseReportHeader.amccode = userlogin.amccode ";
	$sql.="   AND BaseReportHeader.report_group_code='3' ";
	$sql.="   GROUP BY BaseReportHeader.report_detail_code ";
	$sql.=" )AS Temp04 ON Temp04.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.=" WHERE BaseReportHeader.report_group_code='3' ";
	$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code ";
	$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code "; 
	$result_report = 	query($sql);
	$sum01=0;
	$sum02=0;
	$sum03=0;
	$sum04=0;
	$sum05=0;
	$i=0;    // สร้างข้อมูลส่วนเนื้อหา ตัน
	WHILE($fetch_report = fetch_row($result_report)) { 
		$i++;	
		if(($i%2)==0)
		{	$temp_report.=" <tr class='rows_grey'>";  }
		else
		{  $temp_report.=" <tr>";  }

		$temp_report.="  <td align='left'>&nbsp; <a href='#' OnClick=' doCallAjax42(".$div.",".$year.",".$month.",".trim($fetch_report[0]).",\"".trim($fetch_report[1])."\") '>".trim($fetch_report[1])."(".$fetch_report[7].")</a></td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
		if(number_format($fetch_report[2],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[3],0,'','')/number_format($fetch_report[2], 0,'', '')*100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // ผลต่าง
		$temp_report.="  <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[5])."&nbsp;</td> ";
		if(number_format($fetch_report[4],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[5],0,'','')/number_format($fetch_report[4], 0,'', '')*100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // ผลต่าง
		$temp_report.="  <td align='right'>".number_format($fetch_report[6])."&nbsp;</td> ";
		if(number_format($fetch_report[5],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[6],0,'','')/number_format($fetch_report[5], 0,'', ''))*100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // ผลต่าง
		$temp_report.="</tr> ";

		$sum01=$sum01+number_format($fetch_report[2],0,'','');
		$sum02=$sum02+number_format($fetch_report[3],0,'','');
		$sum03=$sum03+number_format($fetch_report[4],0,'','');
		$sum04=$sum04+number_format($fetch_report[5],0,'','');
		$sum05=$sum05+number_format($fetch_report[6],0,'','');
	} // end while 

// สร้างข้อมูลส่วนท้าย ตัน
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center'> รวม </td>";
	$temp_report.=" <td align='right'>".number_format($sum01,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum02,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum03,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum04,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum05,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>&nbsp;</td>";
	$temp_report.=" </tr></table>";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";

   free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();