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
	$temp_report.="<center>3.มูลค่าธุรกิจรวบรวมผลิตผล (เชื่มโยงธุรกิจการผลิตการตลาดโดยขบวนการสหกรณ์และองค์กรชุมชน)</center>";
	$temp_report.="<center>ผลการดำเนินงานของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";

	// สร้างหัวตารางรายงานส่วนที่ 3
	$temp_report.="<table width='1725' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
    $temp_report.=" <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b>".trim($report_detail_name)."</b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td rowspan='4' width='150' align='center' valign='middle'> สกต.</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>เป้าหมายตามบันทึกข้อตกลง</td> ";
	$temp_report.=" <td colspan='2' rowspan='3' align='center' valign='middle'>เป้าหมายการรวบรวมผลิตผล ของสกต.</td> ";
	$temp_report.=" <td colspan='6' align='center' >(3) ผลการรวบรวมระหว่างปี(ตัวชี้วัดของ Tris/บันทึกข้อตกลง)</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>(4) สกต./สนจ.สนับสนุนการกระจายผลิตผล/ผลิตภัณฑ์</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>(5)  ผลการดำเนินงาน<br>(3.1)+(3.2)+(4)<br>(Tris/บันทึกข้อตกลง)</td> ";
	$temp_report.=" <td colspan='2' rowspan='3' align='center' valign='middle'>(6) เป้าหมายการจำหน่ายผลิตผล ของสกต</td> ";
	$temp_report.=" <td colspan='4' align='center' >(7) ผลการจำหน่ายระหว่างปี</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(8) มูลค่า ผลิตผลคงเหลือ</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(9) เป็นนายหน้า/ตัวแทน</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td colspan='3' align='center' >(3.1) สกต.รวบรวม ผลิตผล/ผลิตภัณฑ์จากสมาชิกเละเกษตรกรทั่วไป</td> ";
	$temp_report.=" <td colspan='3' align='center' >(3.2) สนจ.สนับสนุนองค์กรชุมชน<br>รวบรวม ผลิตผล/ผลิตภัณฑ์</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายรวม</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายให้TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td colspan='3' align='center' >ผลการรวบรวม</td> ";
	$temp_report.=" <td colspan='3' align='center' >ผลการสนับสนุนรวบรวม</td> ";
	$temp_report.=" <td align='center' >ปริมาณ</td> ";
	$temp_report.=" <td align='center' >มูลค่า</td> ";
	$temp_report.=" <td align='center' >ปริมาณ</td> ";
	$temp_report.=" <td align='center' >มูลค่า</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='75'>(ราย)</td> ";
	$temp_report.=" <td align='center' width='75'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='75'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='70'>(องค์กร)</td> ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
	$temp_report.=" <td align='center' width='70'>(ตัน)</td> ";
	$temp_report.=" <td align='center' width='70'>(พันบาท)</td> ";
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
	$sql = " SELECT DISTINCT userlogin.br_code, userlogin.userdetail, ";
	$sql.=" Temp03.target_value,  ";
	$sql.=" Temp01.PlanCollectBuy_Unit, Temp01.PlanCollectBuy_Sum,  ";
	$sql.=" Temp04.data1, Temp04.data2, Temp04.data3, Temp04.data4,  ";
	$sql.=" Temp04.data5, Temp04.data6, Temp04.data7, Temp04.data8,  ";
	$sql.=" Temp02.PlanCollectSell_Unit, Temp02.PlanCollectSell_Sum,  ";
	$sql.=" Temp04.data9, Temp04.data10, Temp04.data11,Temp04.data12,  ";
	$sql.=" Temp04.data13, Temp04.data14, userlogin.amccode ";
	$sql.=" FROM userlogin  ";
	$sql.=" LEFT JOIN ( SELECT SUM(PlanCollectBuy.PlanCollectBuy_Sum)AS PlanCollectBuy_Sum ,  ";
	$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Unit)AS PlanCollectBuy_Unit ,  ";
	$sql.=" PlanCollectBuy.amccode ";
	$sql.=" FROM PlanCollectBuy  ";
	$sql.=" WHERE PlanCollectBuy_year='".$year."'    ";
	$sql.=" AND PlanCollectBuy.report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY PlanCollectBuy.amccode) AS Temp01  ";
	$sql.=" ON Temp01.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN ( SELECT SUM(PlanCollectSell.PlanCollectSell_Sum)AS PlanCollectSell_Sum,  ";
	$sql.=" SUM(PlanCollectSell.PlanCollectSell_Unit)AS PlanCollectSell_Unit,  ";
	$sql.=" PlanCollectSell.amccode ";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year='".$year."'  ";
	$sql.=" AND PlanCollectSell.report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY PlanCollectSell.amccode ) AS Temp02  ";
	$sql.=" ON Temp02.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN ( SELECT SUM(target_value)AS target_value, amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' and target_month='".$month."'   ";
	$sql.=" AND report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY amccode) AS Temp03  ";
	$sql.=" ON Temp03.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN ( SELECT SUM(data1)AS data1, SUM(data2)AS data2,  ";
	$sql.=" SUM(data3)data3, SUM(data4)AS data4, SUM(data5)AS data5,  ";
	$sql.=" SUM(data6)AS data6, SUM(data7)AS data7, SUM(data8)AS data8,  ";
	$sql.=" SUM(data9)AS data9, SUM(data10)AS data10, SUM(data11)AS data11, ";
	$sql.=" SUM(data12)AS data12, SUM(data13)AS data13, SUM(data14)AS data14 , ";
	$sql.=" amccode  ";
	$sql.=" FROM ReportGroup3  ";
	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."'  ";
	$sql.=" AND report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY amccode ) AS Temp04  ";
	$sql.=" ON Temp04.amccode = userlogin.amccode  ";
	$sql.=" WHERE userlogin.status = 'N'  ";
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

		if($div==0)  //  สรุปข้อมูลในแต่ละฝ่าย
		{
			if($temp_div==trim($fetch_report[0]))
			{	$temp_sum31 = $temp_sum31+number_format($fetch_report[2],0,'','');
				$temp_sum32 = $temp_sum32+number_format($fetch_report[3],0,'','');
				$temp_sum33 = $temp_sum33+number_format($fetch_report[4],0,'','');
				$temp_sum34 = $temp_sum34+number_format($fetch_report[5],0,'','');
				$temp_sum35 = $temp_sum35+number_format($fetch_report[6],0,'','');
				$temp_sum36 = $temp_sum36+number_format($fetch_report[7],0,'','');
				$temp_sum37 = $temp_sum37+number_format($fetch_report[8],0,'','');
				$temp_sum38 = $temp_sum38+number_format($fetch_report[9],0,'','');
				$temp_sum39 = $temp_sum39+number_format($fetch_report[10],0,'','');
				$temp_sum310 = $temp_sum310+number_format($fetch_report[11],0,'','');
				$temp_sum311 = $temp_sum311+number_format($fetch_report[12],0,'','');
				$temp_sum312 = $temp_sum312+$temp_31;
				$temp_sum313 = $temp_sum313+$temp_32;
				$temp_sum314 = $temp_sum314+number_format($fetch_report[13],0,'','');
				$temp_sum315 = $temp_sum315+number_format($fetch_report[14],0,'','');
				$temp_sum316 = $temp_sum316+number_format($fetch_report[15],0,'','');
				$temp_sum317 = $temp_sum317+number_format($fetch_report[16],0,'','');
				$temp_sum318 = $temp_sum318+number_format($fetch_report[17],0,'','');
				$temp_sum319 = $temp_sum319+number_format($fetch_report[18],0,'','');
				$temp_sum320 = $temp_sum320+number_format($fetch_report[19],0,'','');
				$temp_sum321 = $temp_sum321+number_format($fetch_report[20],0,'','');
			}else
			{	
				// สรุปข้อมูลฝ่าย
			  	$temp_report.="<tr class='rows_sky' height='20'> ";
				$temp_report.="  <td align='center'> รวมฝ่าย ".$temp_div."</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum31)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum32)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum33)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum34)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum35)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum36)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum37)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum38)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum39)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum310)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum311)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum312)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum313)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum314)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum315)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum316)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum317)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum318)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum319)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum320)."&nbsp;</td> ";
				$temp_report.="  <td align='right'>".number_format($temp_sum321)."&nbsp;</td> ";
				$temp_report.=" </tr> ";
				$temp_sum31 = 0;
				$temp_sum32 = 0;
				$temp_sum33 = 0;
				$temp_sum34 = 0;
				$temp_sum35 = 0;
				$temp_sum36 = 0;
				$temp_sum37 = 0;
				$temp_sum38 = 0;
				$temp_sum39 = 0;
				$temp_sum310 = 0;
				$temp_sum311 = 0;
				$temp_sum312 = 0;
				$temp_sum313 = 0;
				$temp_sum314 = 0;
				$temp_sum315 = 0;
				$temp_sum316 = 0;
				$temp_sum317 = 0;
				$temp_sum318 = 0;
				$temp_sum319 = 0;
				$temp_sum320 = 0;
				$temp_sum321 = 0;
				$temp_div = trim($fetch_report[0]);
			}
		} // end div=0

	$i++;
	if(($i%2)==0)
		$temp_report.= "<tr class='rows_grey'>";
	else
		$temp_report.="<tr>"; 

	$temp_report.=" <td align='left'>&nbsp;<a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[21])."\",\"".trim($fetch_report[1])."\")'>สกต.".trim($fetch_report[1])."</a></td>";
	$temp_report.=" <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[11])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[12])."&nbsp;</td> ";
	$temp_31 = number_format($fetch_report[6],0,'','')+number_format($fetch_report[9],0,'','')+number_format($fetch_report[11],0,'','');
	$temp_32 = number_format($fetch_report[7],0,'','')+number_format($fetch_report[10],0,'','')+number_format($fetch_report[12],0,'','');
	$temp_report.=" <td align='right'>".number_format($temp_31)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($temp_32)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[13])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[14])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[15])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[16])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[17])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[18])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[19])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report[20])."&nbsp;</td> ";
	$temp_report.=" </tr> ";
	$sum31 = $sum31+number_format($fetch_report[2],0,'','');
	$sum32 = $sum32+number_format($fetch_report[3],0,'','');
	$sum33 = $sum33+number_format($fetch_report[4],0,'','');
	$sum34 = $sum34+number_format($fetch_report[5],0,'','');
	$sum35 = $sum35+number_format($fetch_report[6],0,'','');
	$sum36 = $sum36+number_format($fetch_report[7],0,'','');
	$sum37 = $sum37+number_format($fetch_report[8],0,'','');
	$sum38 = $sum38+number_format($fetch_report[9],0,'','');
	$sum39 = $sum39+number_format($fetch_report[10],0,'','');
	$sum310 = $sum310+number_format($fetch_report[11],0,'','');
	$sum311 = $sum311+number_format($fetch_report[12],0,'','');
	$sum312 = $sum312+$temp_31;
	$sum313 = $sum313+$temp_32;
	$sum314 = $sum314+number_format($fetch_report[13],0,'','');
	$sum315 = $sum315+number_format($fetch_report[14],0,'','');
	$sum316 = $sum316+number_format($fetch_report[15],0,'','');
	$sum317 = $sum317+number_format($fetch_report[16],0,'','');
	$sum318 = $sum318+number_format($fetch_report[17],0,'','');
	$sum319 = $sum319+number_format($fetch_report[18],0,'','');
	$sum320 = $sum320+number_format($fetch_report[19],0,'','');
	$sum321 = $sum321+number_format($fetch_report[20],0,'','');
} // end while

	// สรุปข้อมูลฝ่าย
if($div==0) 
{	$temp_report.="<tr class='rows_sky' height='20'> ";
	$temp_report.="  <td align='center'> รวมฝ่าย ".$temp_div." </td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum31)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum32)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum33)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum34)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum35)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum36)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum37)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum38)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum39)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum310)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum311)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum312)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum313)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum314)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum315)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum316)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum317)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum318)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum319)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum320)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($temp_sum321)."&nbsp;</td> ";
	$temp_report.=" </tr> ";
}
// สร้างข้อมูลส่วนท้ายตาราง
  	$temp_report.="<tr class='rows_yellow' height='20'> ";
	$temp_report.="  <td align='center'> รวม </td> ";
	$temp_report.="  <td align='right'>".number_format($sum31)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum32)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum33)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum34)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum35)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum36)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum37)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum38)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum39)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum310)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum311)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum312)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum313)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum314)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum315)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum316)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum317)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum318)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum319)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum320)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum321)."&nbsp;</td> ";
	$temp_report.=" </tr> ";
	$temp_report.="</table> ";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";
	free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();