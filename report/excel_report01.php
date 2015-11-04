<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="ข้อมูลรายงาน 1.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');

	connect();
	$month = escapeshellcmd($_GET["month"]);
	$year = escapeshellcmd($_GET["year"]);
	$province_name = escapeshellcmd($_GET["province_name"]);
	$minus = array("-");  // ในกรณีที่มีข้อมูล -  ให้ลบออก
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
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>ข้อมูลรายงาน 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<?
	// หัวรายงาน
	$temp_report.="<strong><center>สหกรณ์การเกษตรเพื่อการตลาดลูกค้า ธ.ก.ส. จำกัด </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center>รายงานผลการดำเนินงานของ สกต.ประจำเดือน <font color='#76B441'><u>".$month_thai[$month]."</u></font> ปี <font color='#76B441'><u>".$_GET["year"]."</u></font> ".$temp_header."</center></strong>";

	//ค้นหาข้อมูลหัวรายงาน ท้ายรายงานต่าง ๆ ทั้งหมดก่อน แล้วเก็บใส่ไว้ใน array ในหมวดต่าง ๆ 6 หมวด
	$sql=" SELECT ";
	$sql.=" BaseReportHeader.report_group_code, ";
	$sql.=" BaseReportGroup.report_group_name ";
	$sql.=" FROM BaseReportHeader,userlogin,BaseReportGroup ";
	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode ";
	$sql.=" AND BaseReportGroup.report_group_code = BaseReportHeader.report_group_code ";
	if($div!='0')
	{	$sql.=" AND userlogin.br_code='".$div."' ";	}
	if($province!='0')
	{	$sql.=" AND userlogin.amccode='".$province."' "; }
	$sql.=" GROUP BY BaseReportHeader.report_group_code,BaseReportGroup.report_group_name ";
	$sql.=" ORDER BY BaseReportHeader.report_group_code ";
	
	$result_report = query($sql);

	if(num_rows($result_report)==0)
	{
		echo "<center><font color='red'> ไม่มีข้อมูลที่เลือก </font></center>";
		ob_end_flush();
		exit();
	}
	// เก็บข้อมูลว่ามีการกำหนดให้แสดงรายงานหมวดนี้หรือไม่
	$report_search1 = false;
	$report_search2 = false;
	$report_search3 = false;
	$report_search4 = false;
	$report_search5 = false;
	$report_search6 = false;
	$report_search8 = false;

	WHILE($fetch_report = fetch_row($result_report)) { 
		if($fetch_report[0]=='1')
		{	$report_search1 = true;  
			$report_name[1] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
		elseif($fetch_report[0]=='2')
		{	$report_search2 = true;  
			$report_name[2] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
		elseif($fetch_report[0]=='3')
		{	$report_search3 = true;  
			$report_name[3] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
		elseif($fetch_report[0]=='4')
		{	$report_search4 = true;  
			$report_name[4] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
		elseif($fetch_report[0]=='5')
		{	$report_search5 = true;  
			$report_name[5] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
		elseif($fetch_report[0]=='6')
		{	$report_search6 = true;  
			$report_name[6] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
		elseif($fetch_report[0]=='8')
		{	$report_search8 = true;  
			$report_name[8] = trim($fetch_report[1]);   }         // ชื่อกลุ่มรายงาน
	} // end while  

?>
<!--  ข้อมูลรายงานกลุ่มที่ 1 -->
<?php
	if($report_search1) {
	// สร้างหัวตารางรายงานส่วนที่ 1
	  $temp_report.="<table  width='480'  border='1' style='margin-top:15px; margin-left:5px'> ";
	  $temp_report.="  <tr height='25px'><td colspan='2'align='left'>&nbsp;<font color='#0F7FAF'><b>1. ".$report_name[1]."</b></font></td></tr> ";
      $temp_report.="  <tr bgcolor='#FFCC33'> ";
	  $temp_report.="    <td align='center' width='380'> รายการ </td> ";
	  $temp_report.="    <td align='center' width='100'> ข้อมูล </td> ";
	  $temp_report.="  </tr> ";

	  $i=0;   
	   $sql = " SELECT ";
	   $sql.=" BaseReportDetail.report_detail_code, ";
	   $sql.=" BaseReportDetail.report_detail_name, ";
	   $sql.=" SUM(Temp01.report_value) ";
	   $sql.=" FROM BaseReportDetail,userlogin,BaseReportHeader ";
	   $sql.=" LEFT JOIN( ";
	   $sql.=" SELECT  ReportGroup1.report_detail_code, ReportGroup1.report_value, ReportGroup1.amccode ";
	   $sql.=" FROM ReportGroup1 ";
	   $sql.=" WHERE ReportGroup1.report_year='".$year."' AND ReportGroup1.report_month='".$month."' ";
		$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseReportHeader.report_detail_code ";
		$sql.=" AND Temp01.amccode = BaseReportHeader.amccode ";
		$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode ";
		$sql.=" AND BaseReportDetail.report_group_code = BaseReportHeader.report_group_code ";
		$sql.=" AND BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code ";
		$sql.=" AND BaseReportDetail.report_group_code='1' ";
		if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
		if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' "; }
	
		$sql.=" GROUP BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name";
		$sql.=" ORDER BY BaseReportDetail.report_detail_code ";
		$result_report1 = query($sql);
		//  สร้างข้อมูลเนื้อหารายงานในส่วนที่ 1
		WHILE($fetch_report1 = fetch_row($result_report1)) { 
			$i++;	
			if(($i%2)==0)
			{	$temp_report.=" <tr class='rows_grey'>";  }
			else
			{  $temp_report.=" <tr>";  }

				$temp_report.="  <td align='left'>&nbsp;".$fetch_report1[1]."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report1[2])."</td> ";
				$temp_report.="</tr> ";
		}  // end while 
	free_result($result_report1);	
	$temp_report.="</table> ";
  }  // end search  สิ้นสุดข้อมูลรายงานกลุ่มที่ 1  
// *******************************************************************************
	if($report_search2) {
	// สร้างหัวตารางรายงานส่วนที่ 2
	$temp_report.="<br>";
	$temp_report.="<table  width='970' border='1' style='margin-top:15px; margin-left:5px; margin-right:5px;'>";
	$temp_report.="<tr height='25px'> ";
	$temp_report.=" <td colspan='10' align='left'>&nbsp;<font color='#0F7FAF'><b> 2.".$report_name[2]."</b></font></td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#99CC00'> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle' width='250'> รายการ </td>";
	$temp_report.=" <td colspan='5' align='center' width='350'> ซื้อสินค้าระหว่างปี </td>";
	$temp_report.=" <td colspan='3' rowspan='2' align='center' width='225'> ขายสินค้าระหว่างปี </td>";
	$temp_report.=" <td rowspan='3' align='center' valign='middle' width='120'> มูลค่าสินค้าที่จัดหาโดยไม่ผ่าน<br>บัญชีซื้อ-ขาย </td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#99CC00'> ";
	$temp_report.=" <td colspan='3' align='center' width='225'> รวม </td>";
	$temp_report.=" <td colspan='2' align='center' width='150'> เฉพาะที่ซื้อจาก TABCO</td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#99CC00'> ";
	$temp_report.=" <td align='center' width='75'> เป้าหมาย </td>";
	$temp_report.=" <td align='center' width='75'> จริง </td>";
	$temp_report.=" <td align='center' width='75'> ผลต่าง(%) </td>";
	$temp_report.=" <td align='center' width='75'> จริง </td>";
	$temp_report.=" <td align='center' width='75'> คำนวณ </td>";
	$temp_report.=" <td align='center' width='75'> เป้าหมาย </td>";
	$temp_report.=" <td align='center' width='75'> จริง </td>";
	$temp_report.=" <td align='center' width='75'> ผลต่าง(%) </td>";
	$temp_report.="</tr>";

	$i=0;   
	$sql=" SELECT BaseReportDetail.report_detail_code,  ";
	$sql.=" BaseReportDetail.report_detail_name,   ";
	$sql.=" SUM(Temp02.PlanProcureBuy_Sum),  ";
	$sql.=" SUM(Temp01.product_buy_sum),  ";
	$sql.=" SUM(Temp01.product_buy_tabco),  ";
	$sql.=" SUM(Temp03.PlanProcureSell_Sum),  ";
	$sql.=" SUM(Temp01.product_sell_sum),  ";
	$sql.=" SUM(Temp01.product_procure)  ";
	$sql.=" FROM BaseReportDetail,userlogin,BaseReportHeader   ";

	$sql.=" LEFT JOIN(   ";
	$sql.=" SELECT ReportGroup2.report_detail_code,   ";
	$sql.=" ReportGroup2.product_buy_sum,  ";
	$sql.=" ReportGroup2.product_buy_tabco,  ";
	$sql.=" ReportGroup2.product_sell_sum,  ";
	$sql.=" ReportGroup2.product_procure,  ";
	$sql.=" ReportGroup2.amccode ";
	$sql.=" FROM ReportGroup2 ";
	$sql.=" WHERE ReportGroup2.report_year='".$year."' AND ReportGroup2.report_month='".$month."'   ";
	$sql.=" )AS Temp01   ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp01.amccode = BaseReportHeader.amccode  ";
	$sql.=" LEFT JOIN   ";
	$sql.=" ( SELECT PlanProcureBuy.report_detail_code, PlanProcureBuy.PlanProcureBuy_Sum  ";
	$sql.=" , PlanProcureBuy.amccode ";
	$sql.=" FROM PlanProcureBuy ";
	$sql.=" WHERE PlanProcureBuy_year='".$year."' ";
	$sql.=" )AS Temp02   ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp02.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN   ";
	$sql.=" ( SELECT PlanProcureSell.report_detail_code, PlanProcureSell_Sum, PlanProcureSell.amccode  ";
	$sql.="  FROM PlanProcureSell  ";
	$sql.="  WHERE PlanProcureSell_year='".$year."'  ";
	$sql.="  )AS Temp03   ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp03.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode   ";
	$sql.=" AND BaseReportDetail.report_group_code = BaseReportHeader.report_group_code   ";
	$sql.=" AND BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code='2'   ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" GROUP BY  BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";
	$result_report2 = query($sql);

		//  สร้างข้อมูลเนื้อหารายงานในส่วนที่ 2
		$sum01=0; $sum02=0; $sum03=0;
		$sum04=0; $sum05=0; $sum06=0;
		WHILE($fetch_report2 = fetch_row($result_report2)) { 
			$i++;	
			if(($i%2)==0)
			{	$temp_report.=" <tr class='rows_grey'>";  }
			else
			{  $temp_report.=" <tr>";  }

				$temp_report.="  <td align='left'>&nbsp;".$fetch_report2[1]."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report2[2])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report2[3])."</td> ";
				if(number_format($fetch_report2[2])==0)
				{	$temp_present = "0"; }
				else
				{	$temp_present = number_format($fetch_report2[3],0,'','')/(number_format($fetch_report2[2], 0,'', '')/100)-100;  }
				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report2[4])."</td> ";
				if(number_format($fetch_report2[3])==0)
				{	$temp_present = "0"; }
				else
				{	$temp_present = (number_format($fetch_report2[4],0,'', '')/number_format($fetch_report2[3],0,'', ''))*100;  }
				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report2[5])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report2[6])."</td> ";
				if(number_format($fetch_report2[5])==0)
				{	$temp_present = "0"; }
				else
				{	$temp_present = number_format($fetch_report2[6],0,'', '')/(number_format($fetch_report2[5],0,'', '')/100)-100;  } 
				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report2[7])."</td> ";
				$temp_report.="</tr> ";

				$sum01=$sum01+number_format($fetch_report2[2],0,'','');
				$sum02=$sum02+number_format($fetch_report2[3],0,'','');
				$sum03=$sum03+number_format($fetch_report2[4],0,'','');
				$sum04=$sum04+number_format($fetch_report2[5],0,'','');
				$sum05=$sum05+number_format($fetch_report2[6],0,'','');
				$sum06=$sum06+number_format($fetch_report2[7],0,'','');
		}  // end while 
	free_result($result_report2);	

	// สร้างรายงานส่วนท้าย หมวดที่ 2
	$temp_report.="<tr bgcolor='#FFFF99'>";
	$temp_report.="	<td align='center'> รวม </td>";
	$temp_report.="	<td align='right'>".number_format($sum01,'', '.', ',')."</td>";
	$temp_report.="	<td align='right'>".number_format($sum02,'', '.', ',')."</td>";
	$temp_report.="	<td align='center'></td>";
	$temp_report.="	<td align='right'>".number_format($sum03,'', '.', ',')."</td>";
	$temp_report.="	<td align='center'></td>";
	$temp_report.="	<td align='right'>".number_format($sum04,'', '.', ',')."</td>";
	$temp_report.="	<td align='right'>".number_format($sum05,'', '.', ',')."</td>";
	$temp_report.="	<td align='center'></td>";
	$temp_report.="	<td align='right'>".number_format($sum06,'', '.', ',')."</td>";
	$temp_report.="</tr>";
	$temp_report.="</table>";
  }  // end search  สิ้นสุดข้อมูลรายงานกลุ่มที่ 2
//**********************************************************************************
if($report_search3){
	// สร้างหัวตารางรายงานส่วนที่ 3
	$temp_report.="<br>";
	$temp_report.="<table width='1725' border='1' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
    $temp_report.=" <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b> 3. ".$report_name[3]."</b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#CC66FF'>  ";
	$temp_report.=" <td rowspan='4' width='150' align='center' valign='middle'>ผลผลิต</td> ";
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
	$temp_report.="<tr bgcolor='#CC66FF'>  ";
	$temp_report.=" <td colspan='3' align='center' >(3.1) สกต.รวบรวม ผลิตผล/ผลิตภัณฑ์จากสมาชิกเละเกษตรกรทั่วไป</td> ";
	$temp_report.=" <td colspan='3' align='center' >(3.2) สนจ.สนับสนุนองค์กรชุมชน<br>รวบรวม ผลิตผล/ผลิตภัณฑ์</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายรวม</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายให้TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#CC66FF'>  ";
	$temp_report.=" <td colspan='3' align='center' >ผลการรวบรวม</td> ";
	$temp_report.=" <td colspan='3' align='center' >ผลการสนับสนุนรวบรวม</td> ";
	$temp_report.=" <td align='center' >ปริมาณ</td> ";
	$temp_report.=" <td align='center' >มูลค่า</td> ";
	$temp_report.=" <td align='center' >ปริมาณ</td> ";
	$temp_report.=" <td align='center' >มูลค่า</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#CC66FF'>  ";
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
	$sql = " SELECT ";
	$sql.=" BaseReportDetail.report_detail_code,  ";
	$sql.=" BaseReportDetail.report_detail_name,  ";
	$sql.=" SUM(Temp03.target_value), SUM(Temp01.PlanCollectBuy_Unit),  ";
	$sql.=" SUM(Temp01.PlanCollectBuy_Sum),  ";
	$sql.=" SUM(Temp04.data1), SUM(Temp04.data2),  ";
	$sql.=" SUM(Temp04.data3), SUM(Temp04.data4),  ";
	$sql.=" SUM(Temp04.data5), SUM(Temp04.data6),  ";
	$sql.=" SUM(Temp04.data7), SUM(Temp04.data8),  ";
	$sql.=" SUM(Temp02.PlanCollectSell_Unit), SUM(Temp02.PlanCollectSell_Sum), ";
	$sql.=" SUM(Temp04.data9), SUM(Temp04.data10),  ";
	$sql.=" SUM(Temp04.data11),SUM(Temp04.data12), ";
	$sql.=" SUM(Temp04.data13), SUM(Temp04.data14)   ";
	$sql.=" FROM userlogin, BaseReportDetail, BaseReportHeader  ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" PlanCollectBuy.PlanCollectBuy_Sum, ";
	$sql.=" PlanCollectBuy.PlanCollectBuy_Unit, ";
	$sql.=" PlanCollectBuy.report_detail_code, ";
	$sql.=" PlanCollectBuy.amccode ";
	$sql.=" FROM PlanCollectBuy  ";
	$sql.=" WHERE PlanCollectBuy_year='".$year."'  ) AS Temp01 ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp01.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" PlanCollectSell.PlanCollectSell_Sum,  ";
	$sql.=" PlanCollectSell.PlanCollectSell_Unit,  ";
	$sql.=" PlanCollectSell.report_detail_code,  ";
	$sql.=" PlanCollectSell.amccode ";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year='".$year."') AS Temp02  ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp02.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris ";
	$sql.=" WHERE target_year='".$year."' and target_month='".$month."') AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp03.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" data1, data2 , data3 , ";
	$sql.=" data4, data5 , data6 , ";
	$sql.=" data7, data8 , data9 , ";
	$sql.=" data10, data11 , data12 , ";
	$sql.=" data13, data14 ,report_detail_code, amccode ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."' ) ";
	$sql.=" AS Temp04 ON Temp04.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp04.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode AND  ";
	$sql.=" BaseReportDetail.report_group_code = BaseReportHeader.report_group_code AND  ";
	$sql.=" BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code AND  ";
	$sql.=" BaseReportDetail.report_group_code='3'  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }

	$sql.=" GROUP BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name ";
	$result_report3 = query($sql);

	$i = 0;
	WHILE($fetch_report3 = fetch_row($result_report3)) { 
	$i++;
	if(($i%2)==0)
		$temp_report.= "<tr class='rows_grey'>";
	else
		$temp_report.="<tr>"; 

	$temp_report.=" <td align='left'>&nbsp;".trim($fetch_report3[1])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[2])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[3])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[4])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[5])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[6])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[7])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[8])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[9])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[10])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[11])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[12])."</td> ";
	$temp_31 = number_format($fetch_report3[6],0,'','')+number_format($fetch_report3[9],0,'','')+number_format($fetch_report3[11],0,'','');
	$temp_32 = number_format($fetch_report3[7],0,'','')+number_format($fetch_report3[10],0,'','')+number_format($fetch_report3[12],0,'','');
	$temp_report.=" <td align='right'>".number_format($temp_31)."</td> ";
	$temp_report.=" <td align='right'>".number_format($temp_32)."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[13])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[14])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[15])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[16])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[17])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[18])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[19])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[20])."</td> ";
	$temp_report.=" </tr> ";
	$sum31 = $sum31+number_format($fetch_report3[2],0,'','');
	$sum32 = $sum32+number_format($fetch_report3[3],0,'','');
	$sum33 = $sum33+number_format($fetch_report3[4],0,'','');
	$sum34 = $sum34+number_format($fetch_report3[5],0,'','');
	$sum35 = $sum35+number_format($fetch_report3[6],0,'','');
	$sum36 = $sum36+number_format($fetch_report3[7],0,'','');
	$sum37 = $sum37+number_format($fetch_report3[8],0,'','');
	$sum38 = $sum38+number_format($fetch_report3[9],0,'','');
	$sum39 = $sum39+number_format($fetch_report3[10],0,'','');
	$sum310 = $sum310+number_format($fetch_report3[11],0,'','');
	$sum311 = $sum311+number_format($fetch_report3[12],0,'','');
	$sum312 = $sum312+$temp_31;
	$sum313 = $sum313+$temp_32;
	$sum314 = $sum314+number_format($fetch_report3[13],0,'','');
	$sum315 = $sum315+number_format($fetch_report3[14],0,'','');
	$sum316 = $sum316+number_format($fetch_report3[15],0,'','');
	$sum317 = $sum317+number_format($fetch_report3[16],0,'','');
	$sum318 = $sum318+number_format($fetch_report3[17],0,'','');
	$sum319 = $sum319+number_format($fetch_report3[18],0,'','');
	$sum320 = $sum320+number_format($fetch_report3[19],0,'','');
	$sum321 = $sum321+number_format($fetch_report3[20],0,'','');
} // end while
// สร้างข้อมูลส่วนท้ายตาราง
  	$temp_report.="<tr bgcolor='#FFFF99'> ";
	$temp_report.="  <td align='center'> รวม </td> ";
	$temp_report.="  <td align='right'>".number_format($sum31)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum32)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum33)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum34)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum35)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum36)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum37)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum38)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum39)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum310)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum311)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum312)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum313)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum314)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum315)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum316)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum317)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum318)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum319)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum320)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum321)."</td> ";
	$temp_report.=" </tr> ";
	$temp_report.="</table> ";
	 free_result($result_report3);	
} // end search สิ้นสุดข้อมูลรายงานกลุ่มที่ 3
//*************************************************************************************
if($report_search4) {
	// สร้างหัวตารางรายงานส่วนที่ 4
	$temp_report.="<br>";
	$temp_report.=" <table  width='600'  border='1' style='margin-top:15px; margin-left:5px'> ";
	$temp_report.="	<tr height='25px'><td colspan='4' align='left'>&nbsp;<font color='#0F7FAF'><b> 4.".$report_name[4]." </b></font></td></tr> ";
	$temp_report.="	<tr bgcolor='#993300'> ";
	$temp_report.="		<td align='center' width='300'> ประเภทบริการ </td> ";
	$temp_report.="		<td align='center' width='100'> เป้าหมาย </td> ";
	$temp_report.="		<td align='center' width='100'> จริง </td> ";
	$temp_report.="		<td align='center' width='100'> ผลต่าง (%) </td> ";
	$temp_report.="	</tr> ";

	$sql = " SELECT BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
	$sql.=" SUM(Temp01.PlanService_Sum), SUM(Temp02.service_value) ";
	$sql.=" FROM BaseReportDetail,userlogin,BaseReportHeader ";

	$sql.=" LEFT JOIN ( SELECT PlanService.report_detail_code,  ";
	$sql.=" PlanService.PlanService_Sum, PlanService.amccode ";
	$sql.=" FROM PlanService ";
	$sql.=" WHERE PlanService_year='".$year."' )AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code ";
	$sql.=" AND Temp01.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN( SELECT ReportGroup4.report_detail_code, ";
	$sql.=" ReportGroup4.service_value, ReportGroup4.amccode ";
	$sql.=" FROM ReportGroup4 ";
	$sql.=" WHERE ReportGroup4.report_year='".$year."' AND ReportGroup4.report_month='".$month."' ";
	$sql.=" )AS Temp02 ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code ";
	$sql.=" AND Temp02.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode  ";
	$sql.=" AND BaseReportDetail.report_group_code = BaseReportHeader.report_group_code ";
	$sql.=" AND BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code ";
	$sql.=" AND BaseReportDetail.report_group_code='4' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" GROUP BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code ";
	
	$result_report4=	query($sql);

	//  สร้างข้อมูลเนื้อหารายงานในส่วนที่ 4
	$i=0;
		WHILE($fetch_report4 = fetch_row($result_report4)) { 
			$i++;
			if(($i%2)==0)
				$temp_report.="<tr class='rows_grey'>";
			else
				$temp_report.="<tr>"; 

			$temp_report.="<td align='left'>&nbsp;".$fetch_report4[1]."</td>";
			$temp_report.="	<td align='right'>".number_format($fetch_report4[2])."</td>";
			$temp_report.="	<td align='right'>".number_format($fetch_report4[3])."</td>";
			if(number_format($fetch_report4[2])==0)
			{	$temp_present = '0';	}
			else
			{	$temp_present = (number_format($fetch_report4[3],0,'', '')/number_format($fetch_report4[2],0, '', ''))*100; }
			$temp_report.="	<td align='right'>".number_format($temp_present,2, '.', ',')."%</td>";
			$temp_report.="	</tr>";
		} // end while
		  free_result($result_report4);	
	  }  // end search  สิ้นสุดข้อมูลรายงานกลุ่มที่ 4
//*******************************************************************************
if($report_search5) {
	// สร้างหัวตารางข้อที่ 5	
	$temp_report.="<br>";
	$temp_report.=" <table  width='650'  border='1' style='margin-top:15px; margin-left:5px'> ";
	$temp_report.=" <tr height='25px'><td colspan='5' align='left'>&nbsp;<font color='#0F7FAF'><b> 5. ".$report_name[5]."</b></font></td></tr> ";
	$temp_report.=" <tr bgcolor='#FF99FF'> ";
	$temp_report.=" 	<td align='center' width='250'> ชื่อผู้ให้กู้ </td> ";
	$temp_report.=" 	<td align='center' width='100'> วงเงินกู้ </td> ";
	$temp_report.=" 	<td align='center' width='100'> เบิกเงินกู้ </td> ";
	$temp_report.=" 	<td align='center' width='100'> ชำระเงินกู้ </td> ";
	$temp_report.=" 	<td align='center' width='100'> ยอดหนี้คงเหลือ </td> ";
	$temp_report.=" </tr>";
	// สร้างเนื้อหาส่วนที่ 5
	$sql =" SELECT BaseReportDetail.report_detail_code, ";
	$sql.=" BaseReportDetail.report_detail_name,  ";
	$sql.=" SUM(Temp02.loan_limit), SUM(Temp02.loan_fund), SUM(Temp02.loan_pay)  ";
	$sql.=" FROM BaseReportDetail,userlogin,BaseReportHeader  ";

	$sql.=" LEFT JOIN( SELECT ReportGroup5.report_detail_code,  ";
	$sql.=" ReportGroup5.loan_limit, ReportGroup5.loan_fund,ReportGroup5.loan_pay,  ";
	$sql.=" ReportGroup5.amccode ";
	$sql.=" FROM ReportGroup5  ";
	$sql.=" WHERE ReportGroup5.report_year='".$year."'  ";
	$sql.=" AND ReportGroup5.report_month='".$month."')  ";
	$sql.=" AS Temp02 ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp02.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode  ";
	$sql.=" AND BaseReportDetail.report_group_code = BaseReportHeader.report_group_code  ";
	$sql.=" AND BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND BaseReportDetail.report_group_code='5'  ";
		if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" GROUP BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

	$result_report5=	query($sql);
	$i=0;
	$sum01=0;
	$sum02=0;
	$sum03=0;
	WHILE($fetch_report5 = fetch_row($result_report5)) { 
		$i++;
		if(($i%2)==0)
			$temp_report.= "<tr class='rows_grey'>";
		else
			$temp_report.=" <tr>"; 

		$temp_report.=" <td align='left'>&nbsp;".trim($fetch_report5[1])."</td>";
		$temp_report.=" <td align='right'>".number_format($fetch_report5[2])."</td>";
		$temp_report.=" <td align='right'>".number_format($fetch_report5[3])."</td>";
		$temp_report.=" <td align='right'>".number_format($fetch_report5[4])."</td>";
		$temp_present = number_format($fetch_report5[3],0,'', '')-number_format($fetch_report5[4],0, '', '');
		$temp_report.=" <td align='right'>".number_format($temp_present)."</td>";
		$temp_report.="</tr>";

		$sum01 = $sum01+number_format($fetch_report5[2],0,'', '');
		$sum02 = $sum02+number_format($fetch_report5[3],0,'', '');
		$sum03 = $sum03+number_format($fetch_report5[4],0,'', '');

	} // end while
	// สร้างท้ายตารางข้อที่ 5
	$temp_report.=" <tr bgcolor='#FFFF99'> ";
	$temp_report.=" 	<td align='center'> รวม </td> ";
	$temp_report.=" 	<td align='right'>".number_format($sum01)."</td> ";
	$temp_report.=" 	<td align='right'>".number_format($sum02)."</td> ";
	$temp_report.=" 	<td align='right'>".number_format($sum03)."</td> ";
	$temp_report.=" 	<td align='center'></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" </table> ";
	 free_result($result_report5);	
} // end search สิ้นสุดข้อมูลรายงานกลุ่มที่ 5
//*********************************************************************************
if($report_search6) {
	// สร้างหัวตาราง
	$temp_report.="<br>";
	$temp_report.=" <table width='550'  border='1' style='margin-top:15px; margin-left:5px'> ";
	$temp_report.=" <tr height='25px'><td colspan='3' align='left'>&nbsp;<font color='#0F7FAF'><b> 6.".$report_name[6]." </b></font></td></tr> ";
	$temp_report.=" <tr bgcolor='#6666FF'> ";
	$temp_report.=" 	<td align='center' width='350'> รายการ </td> ";
	$temp_report.=" 	<td align='center' width='100'> ข้อมูล </td> ";
	$temp_report.=" 	<td align='center' width='100'> เปอร์เซนต์ </td> ";
	$temp_report.=" </tr> ";

	// แสดงจำนวนสมาชิกทั้งหมด
	$sql = " SELECT SUM(report_value) AS  member_year ";
	$sql.=" FROM  ReportGroup1 , userlogin ";
	$sql.=" WHERE userlogin.amccode = ReportGroup1.amccode  ";
	$sql.=" AND report_year='".$year."'  ";
	$sql.=" AND report_month='".$month."' ";
	$sql.=" AND ReportGroup1.report_detail_code='3' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }

	$result_member = query($sql);
	if(num_rows($result_member)==0)
	{	$temp_number=0;		}
	else
	{	$temp_number =  result($result_member,0,"member_year");	}		
	$temp_report.="	<tr>";
	$temp_report.="		<td align='left' width='350'>&nbsp;จำนวนสมาชิกทั้งหมด </td> ";
	$temp_report.="		<td align='right' width='100'>".number_format($temp_number)."</td> ";
	$temp_report.="		<td align='right' width='100'> 100%</td> ";
	$temp_report.="	</tr> ";
	free_result($result_member);
	// สร้างเนื้อหาส่วนกลาง
	$sql = " SELECT BaseReportDetail.report_detail_code,  ";
	$sql.=" BaseReportDetail.report_detail_name, ";
	$sql.=" SUM(Temp02.member_value) ";
	$sql.=" FROM BaseReportDetail,userlogin,BaseReportHeader ";
	$sql.=" LEFT JOIN(  ";
	$sql.=" SELECT ReportGroup6.report_detail_code, ReportGroup6.member_value, ReportGroup6.amccode ";
	$sql.=" FROM ReportGroup6  ";
	$sql.=" WHERE ReportGroup6.report_year='".$year."'  ";
	$sql.=" AND ReportGroup6.report_month='".$month."' ";
	$sql.="  ) ";
	$sql.=" AS Temp02 ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp02.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode  ";
	$sql.=" AND BaseReportDetail.report_group_code = BaseReportHeader.report_group_code  ";
	$sql.=" AND BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND BaseReportDetail.report_group_code='6'  ";
	if($div!='0')
	{	$sql.=" AND userlogin.br_code='".$div."' ";	}
	if($province!='0')
	{	$sql.=" AND userlogin.amccode='".$province."' "; }
	$sql.=" GROUP BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

	$result_report6=	query($sql);
		WHILE($fetch_report6 = fetch_row($result_report6)) { 
			if(($i%2)==0)
				$temp_report.= " <tr class='rows_grey'>";
			else
				$temp_report.= "<tr>"; 

			$temp_report.= "<td align='left'>&nbsp;".trim($fetch_report6[1])."</td> ";
			$temp_report.= "<td align='right'>".number_format($fetch_report6[2])."</td> ";
			if($temp_number==0)
				  $temp_present = "0";
			else
				  $temp_present =  (number_format($fetch_report6[2],0,'','')/$temp_number)*100;
			$temp_report.= "<td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
			$temp_report.= "</tr> ";
	$i++;	 
     } // end while
$temp_report.=" </table>";

  free_result($result_report6);	
} // end search สิ้นสุดข้อมูลรายงานกลุ่มที่ 6
// *********************************************************************
//**********************************************************************************
if($report_search8){
	// สร้างหัวตารางรายงานส่วนที่ 8
	$temp_report.="<br>";
	$temp_report.="<table width='1725' border='1' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
    $temp_report.=" <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b> 8. ".$report_name[8]."</b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#33CCCC'>  ";
	$temp_report.=" <td rowspan='4' width='150' align='center' valign='middle'>ผลผลิต</td> ";
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
	$temp_report.="<tr bgcolor='#33CCCC'> ";
	$temp_report.=" <td colspan='3' align='center' >(3.1) สกต.รวบรวม ผลิตผล/ผลิตภัณฑ์จากสมาชิกเละเกษตรกรทั่วไป</td> ";
	$temp_report.=" <td colspan='3' align='center' >(3.2) สนจ.สนับสนุนองค์กรชุมชน<br>รวบรวม ผลิตผล/ผลิตภัณฑ์</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายรวม</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>จำหน่ายให้TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#33CCCC'>  ";
	$temp_report.=" <td colspan='3' align='center' >ผลการรวบรวม</td> ";
	$temp_report.=" <td colspan='3' align='center' >ผลการสนับสนุนรวบรวม</td> ";
	$temp_report.=" <td align='center' >ปริมาณ</td> ";
	$temp_report.=" <td align='center' >มูลค่า</td> ";
	$temp_report.=" <td align='center' >ปริมาณ</td> ";
	$temp_report.=" <td align='center' >มูลค่า</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#33CCCC'>  ";
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
	$sql = " SELECT ";
	$sql.=" BaseReportDetail.report_detail_code,  ";
	$sql.=" BaseReportDetail.report_detail_name,  ";
	$sql.=" SUM(Temp03.target_value), SUM(Temp01.PlanTransBuy_Unit),  ";
	$sql.=" SUM(Temp01.PlanTransBuy_Sum),  ";
	$sql.=" SUM(Temp04.data1), SUM(Temp04.data2),  ";
	$sql.=" SUM(Temp04.data3), SUM(Temp04.data4),  ";
	$sql.=" SUM(Temp04.data5), SUM(Temp04.data6),  ";
	$sql.=" SUM(Temp04.data7), SUM(Temp04.data8),  ";
	$sql.=" SUM(Temp02.PlanTransSell_Unit), SUM(Temp02.PlanTransSell_Sum), ";
	$sql.=" SUM(Temp04.data9), SUM(Temp04.data10),  ";
	$sql.=" SUM(Temp04.data11),SUM(Temp04.data12), ";
	$sql.=" SUM(Temp04.data13), SUM(Temp04.data14)   ";
	$sql.=" FROM userlogin, BaseReportDetail, BaseReportHeader  ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" PlanTransBuy.PlanTransBuy_Sum, ";
	$sql.=" PlanTransBuy.PlanTransBuy_Unit, ";
	$sql.=" PlanTransBuy.report_detail_code, ";
	$sql.=" PlanTransBuy.amccode ";
	$sql.=" FROM PlanTransBuy  ";
	$sql.=" WHERE PlanTransBuy_year='".$year."'  ) AS Temp01 ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp01.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" PlanTransSell.PlanTransSell_Sum,  ";
	$sql.=" PlanTransSell.PlanTransSell_Unit,  ";
	$sql.=" PlanTransSell.report_detail_code,  ";
	$sql.=" PlanTransSell.amccode ";
	$sql.=" FROM PlanTransSell ";
	$sql.=" WHERE PlanTransSell.PlanTransSell_year='".$year."') AS Temp02  ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp02.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris ";
	$sql.=" WHERE target_year='".$year."' and target_month='".$month."') AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp03.amccode = BaseReportHeader.amccode ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" data1, data2 , data3 , ";
	$sql.=" data4, data5 , data6 , ";
	$sql.=" data7, data8 , data9 , ";
	$sql.=" data10, data11 , data12 , ";
	$sql.=" data13, data14 ,report_detail_code, amccode ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."' ) ";
	$sql.=" AS Temp04 ON Temp04.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp04.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode AND  ";
	$sql.=" BaseReportDetail.report_group_code = BaseReportHeader.report_group_code AND  ";
	$sql.=" BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code AND  ";
	$sql.=" BaseReportDetail.report_group_code='8'  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }

	$sql.=" GROUP BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name ";
	$result_report8 = query($sql);

	$i = 0;
	WHILE($fetch_report8 = fetch_row($result_report8)) { 
	$i++;
	if(($i%2)==0)
		$temp_report.= "<tr class='rows_grey'>";
	else
		$temp_report.="<tr>"; 

	$temp_report.=" <td align='left'>&nbsp;".trim($fetch_report8[1])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[2])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[3])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[4])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[5])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[6])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[7])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[8])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[9])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[10])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[11])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[12])."</td> ";
	$temp_81 = number_format($fetch_report8[6],0,'','')+number_format($fetch_report8[9],0,'','')+number_format($fetch_report8[11],0,'','');
	$temp_82 = number_format($fetch_report8[7],0,'','')+number_format($fetch_report8[10],0,'','')+number_format($fetch_report8[12],0,'','');
	$temp_report.=" <td align='right'>".number_format($temp_31)."</td> ";
	$temp_report.=" <td align='right'>".number_format($temp_32)."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[13])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[14])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[15])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[16])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[17])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[18])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[19])."</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report8[20])."</td> ";
	$temp_report.=" </tr> ";
	$sum81 = $sum81+number_format($fetch_report8[2],0,'','');
	$sum82 = $sum82+number_format($fetch_report8[3],0,'','');
	$sum83 = $sum83+number_format($fetch_report8[4],0,'','');
	$sum84 = $sum84+number_format($fetch_report8[5],0,'','');
	$sum85 = $sum85+number_format($fetch_report8[6],0,'','');
	$sum86 = $sum86+number_format($fetch_report8[7],0,'','');
	$sum87 = $sum87+number_format($fetch_report8[8],0,'','');
	$sum88 = $sum88+number_format($fetch_report8[9],0,'','');
	$sum89 = $sum89+number_format($fetch_report8[10],0,'','');
	$sum810 = $sum810+number_format($fetch_report8[11],0,'','');
	$sum811 = $sum811+number_format($fetch_report8[12],0,'','');
	$sum812 = $sum812+$temp_81;
	$sum813 = $sum813+$temp_82;
	$sum814 = $sum814+number_format($fetch_report8[13],0,'','');
	$sum815 = $sum815+number_format($fetch_report8[14],0,'','');
	$sum816 = $sum816+number_format($fetch_report8[15],0,'','');
	$sum817 = $sum817+number_format($fetch_report8[16],0,'','');
	$sum818 = $sum818+number_format($fetch_report8[17],0,'','');
	$sum819 = $sum819+number_format($fetch_report8[18],0,'','');
	$sum820 = $sum820+number_format($fetch_report8[19],0,'','');
	$sum821 = $sum821+number_format($fetch_report8[20],0,'','');
} // end while
// สร้างข้อมูลส่วนท้ายตาราง
  	$temp_report.="<tr bgcolor='#FFFF99'> ";
	$temp_report.="  <td align='center'> รวม </td> ";
	$temp_report.="  <td align='right'>".number_format($sum81)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum82)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum83)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum84)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum85)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum86)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum87)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum88)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum89)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum810)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum811)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum812)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum813)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum814)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum815)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum816)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum817)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum818)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum819)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum820)."</td> ";
	$temp_report.="  <td align='right'>".number_format($sum821)."</td> ";
	$temp_report.=" </tr> ";
	$temp_report.="</table> ";
	 free_result($result_report8);	
} // end search สิ้นสุดข้อมูลรายงานกลุ่มที่ 8
//*************************************************************************************

	close();
	echo $temp_report;
	ob_end_flush();
?>
</body></html>