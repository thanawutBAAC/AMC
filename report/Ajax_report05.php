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
	$temp_report.="<table width='980' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b> 3.1 รายงานมูลค่าธุรกิจรวบรวมผลิตผล (หน่วย: พันบาท) </b></font></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="   <td rowspan='3' width='40' align='center' valign='middle'>ฝ่าย</td> ";
	$temp_report.="   <td rowspan='3' width='130' align='center' valign='middle'> สกต.</td> ";
	$temp_report.="   <td rowspan='2' colspan='3' align='center' valign='middle'>รวบรวมระหว่างปี</td> ";
	$temp_report.="	   <td colspan='5' align='center'  valign='middle'>จำหน่ายระหว่างปี</td> ";
	$temp_report.="	   <td rowspan='3' width='95' align='center' valign='middle'>มูลค่าผลผลิตคงเหลือ ราคาทุน</td> ";
	$temp_report.="	   <td rowspan='3' width='90' align='center' valign='middle'>เป็นนายหน้า / <br>ตัวแทน</td> ";
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
	$sql = " SELECT userlogin.br_code, userlogin.userdetail, ";
	$sql.=" Temp01.PlanCollectBuy_Sum,Temp02.data368, ";
	$sql.=" Temp03.PlanCollectSell_Sum,Temp02.data10, ";
	$sql.=" Temp02.data12, Temp02.data13,Temp02.data14, userlogin.amccode ";
	$sql.=" FROM userlogin ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectBuy_Sum)AS PlanCollectBuy_Sum, amccode ";
	$sql.="   FROM PlanCollectBuy ";
	$sql.="   WHERE PlanCollectBuy_year='".$year."' ";
	$sql.="   GROUP BY amccode ";
	$sql.=" )AS Temp01 ON Temp01.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN ( ";
	$sql.="   SELECT SUM(data3+data6+data8)AS data368 ,SUM(data10)AS data10, ";
	$sql.="          SUM(data12)AS data12,SUM(data13)AS data13, ";
	$sql.="          SUM(data14)AS data14, amccode ";
	$sql.="   FROM ReportGroup3 ";
	$sql.="   WHERE report_year='".$year."' AND report_month='".$month."' ";
	$sql.="   GROUP BY amccode ";
	$sql.=" )AS Temp02 ON Temp02.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectSell_Sum)AS PlanCollectSell_Sum, amccode ";
	$sql.="   FROM PlanCollectSell ";
	$sql.="   WHERE PlanCollectSell_year='".$year."' ";
	$sql.="   GROUP BY amccode ";
	$sql.=" )AS Temp03 ON Temp03.amccode = userlogin.amccode ";

	$sql.=" WHERE userlogin.status='N' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";

	$result_report = query($sql);
	$sum01=0;
	$sum02=0;
	$sum03=0;
	$sum04=0;
	$sum05=0;
	$i=0;    
	// หาค่าฝ่ายแรกที่มีข้อมูล
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}

// สร้างข้อมูลส่วนเนื้อหา พันบาท
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
				$sum107=$sum107+number_format($fetch_report[8],0,'','');
			}else
			{	$temp_report.=" <tr class='rows_sky' height='20'>"; 
				$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
				$temp_report.="		<td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='center'>&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum103,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum104,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='center'>&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum105,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='center'>&nbsp;</td>";
				$temp_report.="    <td align='right'>".number_format($sum106,'', '.', ',')."&nbsp;</td>";
				$temp_report.="    <td align='right'>".number_format($sum107,'', '.', ',')."&nbsp;</td>";
				$temp_report.="	</tr>";
				$sum101=0;
				$sum102=0;
				$sum103=0;
				$sum104=0;
				$sum105=0;
				$sum106=0;
				$sum107=0;
				$temp_div = trim($fetch_report[0]);
			}
		} // end div=0
		$i++;	
		if(($i%2)==0)
		{	$temp_report.=" <tr class='rows_grey'>";  }
		else
		{  $temp_report.=" <tr>";  }

		$temp_report.="  <td align='center'>".trim($fetch_report[0])."</td> ";
		$temp_report.=" <td><a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[9])."\",\"".trim($fetch_report[1])."\")' > &nbsp;สกต.".trim($fetch_report[1])."</a></td>";
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

	if($div==0)
	{		$temp_report.=" <tr class='rows_sky' height='20'>"; 
			$temp_report.="  <td align='center' colspan='2'> รวมข้อมูลฝ่าย ".$temp_div." </td>";
			$temp_report.="		<td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='center'>&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum103,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum104,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='center'>&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum105,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='center'>&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum106,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum107,'', '.', ',')."&nbsp;</td>";
			$temp_report.="	</tr>";
	}
	// สร้างข้อมูลส่วนท้าย พันบาท
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center' colspan='2'> รวม </td>";
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
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ข้อมูล Excel </a></center>";

   free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();