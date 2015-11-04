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
	$report_detail_code = escapeshellcmd($_GET["report_detail_code"]);
	$report_detail_name = escapeshellcmd($_GET["report_detail_name"]);
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
	$temp_report.="<center>3.รวบรวมผลิตผล ธุรกิจจำหน่าย (เชื่มโยงธุรกิจการผลิตการตลาดโดยขบวนการสหกรณ์และองค์กรชุมชน)</center>";
	$temp_report.="<center>ผลการดำเนินงานของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";

	// สร้างหัวตารางรายงานส่วนที่ 3
	$temp_report.="<table width='770' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
    $temp_report.=" <td colspan='11' align='left'>&nbsp;<font color='#0F7FAF'><b>3. มูลค่าธุรกิจรวบรวมผลิตผล ธุรกิจจำหน่าย </b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td rowspan='3' width='40' align='center' valign='middle'>ฝ่าย</td> ";
	$temp_report.=" <td rowspan='3' width='150' align='center' valign='middle'>ผลผลิต</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>(6) เป้าหมายการจำหน่ายผลิตผล<br> ของ สกต.</td> ";
	$temp_report.=" <td colspan='4' align='center' >(7) ผลการจำหน่ายระหว่างปี</td> ";
	$temp_report.=" <td rowspan='2' align='center' valign='middle'>(8) มูลค่า ผลิตผลคงเหลือ</td> ";
	$temp_report.=" <td rowspan='2' align='center' valign='middle'>(9) เป็นนายหน้า/ตัวแทน</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td colspan='2' align='center' valign='middle'>จำหน่ายรวม</td> ";
	$temp_report.=" <td colspan='2' align='center' valign='middle'>จำหน่ายให้TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td align='center' width='80'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='80'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='70'>(ราคาทุน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
	$temp_report.="</tr> ";

// สร้างข้อมูลส่วนเนือ้หากลางตาราง
	$sql=" SELECT DISTINCT userlogin.br_code, BaseReportHeader.amccode, ";
	$sql.=" userlogin.userdetail, Temp01.PlanCollectSell_Unit, Temp01.PlanCollectSell_Sum,  ";
	$sql.=" Temp02.data9, Temp02.data10, Temp02.data11, Temp02.data12, Temp02.data13,  ";
	$sql.=" Temp02.data14  ";
	$sql.=" FROM userlogin,BaseReportDetail,BaseReportHeader  ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT SUM(PlanCollectSell.PlanCollectSell_Sum)AS PlanCollectSell_Sum ,  ";
	$sql.=" SUM(PlanCollectSell.PlanCollectSell_Unit)AS PlanCollectSell_Unit ,  ";
	$sql.=" PlanCollectSell.amccode  ";
	$sql.=" FROM PlanCollectSell  ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year='".$month."'  ";
	$sql.=" GROUP BY PlanCollectSell.amccode,PlanCollectSell.amccode) AS Temp01  ";
	$sql.=" ON Temp01.amccode=BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT SUM(data9)AS data9, SUM(data10)AS data10, SUM(data11)AS data11,  ";
	$sql.=" SUM(data12)AS data12, SUM(data13)AS data13, SUM(data14)AS data14, amccode  ";
	$sql.=" FROM ReportGroup3  ";
	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."'  ";
	$sql.=" GROUP BY amccode ) AS Temp02  ";
	$sql.=" ON Temp02.amccode=BaseReportHeader.amccode  ";

	$sql.=" WHERE userlogin.status='N'  ";
	$sql.=" AND userlogin.amccode=BaseReportHeader.amccode  ";
	$sql.=" AND BaseReportHeader.report_group_code='3'  ";
	$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code  ";
	$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }

	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";

	$result_report = query($sql);
	$i = 0;
	// หาค่าฝ่ายแรกที่มีข้อมูล
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}
	
	WHILE($fetch_report = fetch_row($result_report)) { 
		if($div==0)  // สรุปข้อมูลในแต่ละฝ่าย
		{
			if($temp_div==trim($fetch_report[0]))
			{	$temp_sum31 = $temp_sum31+number_format($fetch_report[3],0,'','');
				$temp_sum32 = $temp_sum32+number_format($fetch_report[4],0,'','');
				$temp_sum33 = $temp_sum33+number_format($fetch_report[5],0,'','');
				$temp_sum34 = $temp_sum34+number_format($fetch_report[6],0,'','');
				$temp_sum35 = $temp_sum35+number_format($fetch_report[7],0,'','');
				$temp_sum36 = $temp_sum36+number_format($fetch_report[8],0,'','');
				$temp_sum37 = $temp_sum37+number_format($fetch_report[9],0,'','');
				$temp_sum38 = $temp_sum38+number_format($fetch_report[10],0,'','');
			}else
			{	$temp_report.="<tr class='rows_sky' height='20'>"; 
				$temp_report.=" <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div."</td>";
				$temp_report.=" <td align='right'>".number_format($temp_sum31)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum32)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum33)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum34)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum35)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum36)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum37)."&nbsp;</td> ";
				$temp_report.=" <td align='right'>".number_format($temp_sum38)."&nbsp;</td> ";
				$temp_report.="</tr>";
				$temp_sum31 = 0;
				$temp_sum32 = 0;
				$temp_sum33 = 0;
				$temp_sum34 = 0; 
				$temp_sum35 = 0;
				$temp_sum36 = 0;
				$temp_sum37 = 0; 
				$temp_sum38 = 0;
				echo "div = ".$div." fetch_report = ".$fetch_report[0];
				$temp_div = trim($fetch_report[0]);
				echo " temp_div ".$temp_div;
			}
		} // end div=0
	$i++;
	if(($i%2)==0)
		$temp_report.= "<tr class='rows_grey'>";
	else
		$temp_report.="<tr>"; 

	$temp_report.=" <td align='center'>".number_format($fetch_report[0])."</td> ";
	$temp_report.=" <td><a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[1])."\",\"".trim($fetch_report[2])."\")' > &nbsp;สกต.".trim($fetch_report[2])."</a></td>";
	$temp_report.=" <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td> ";
	$temp_report.=" </tr> ";
	$sum31 = $sum31+number_format($fetch_report[3],0,'','');
	$sum32 = $sum32+number_format($fetch_report[4],0,'','');
	$sum33 = $sum33+number_format($fetch_report[5],0,'','');
	$sum34 = $sum34+number_format($fetch_report[6],0,'','');
	$sum35 = $sum35+number_format($fetch_report[7],0,'','');
	$sum36 = $sum36+number_format($fetch_report[8],0,'','');
	$sum37 = $sum37+number_format($fetch_report[9],0,'','');
	$sum38 = $sum38+number_format($fetch_report[10],0,'','');
} // end while

	if($div==0)
	{  // สรุปฝ่ายสุดท้าย
		$temp_report.=" <tr class='rows_sky' height='20'>"; 
		$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
		$temp_report.=" <td align='right'>".number_format($temp_sum31)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum32)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum33)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum34)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum35)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum36)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum37)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_sum38)."&nbsp;</td> ";
		$temp_report.="	</tr>";
	}
// สร้างข้อมูลส่วนท้ายตาราง
  	$temp_report.="<tr class='rows_yellow'> ";
	$temp_report.=" <td align='center' colspan='2'> รวม </td> ";
	$temp_report.=" <td align='right'>".number_format($sum31)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum32)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum33)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum34)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum35)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum36)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum37)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($sum38)."&nbsp;</td> ";
	$temp_report.="</tr> ";
	$temp_report.="</table> ";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";
  free_result($result_report);
  close();

 echo $temp_report;
 ob_end_flush();	