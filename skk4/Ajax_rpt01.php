<?php session_start();
	ob_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$div = $_GET["div"];  // ฝ่าย
	$province = $_GET["province"];  // สนจ.
	$year = $_GET["year"];  // ปีที่เลือก

	if(trim($div)=='0' OR trim($div)=='')
		$div = '0';  
	if(trim($province)=='')
	   $province = '0'; 

	$temp_report = "";  // ผลลัพธ์ที่จะต้องคืนค่า

// สร้างหัวตาราง
	 $temp_report.="<strong><center> ผลการค้นหาข้อมูลจุดรับซื้อ </center></strong>";
	$temp_report.="<table  width='940' align='center' class='gridtable' style='margin-left:5px; margin-right:5px; margin-top:10px;'> ";
	$temp_report.="<tr height='30'><td colspan='13'> ";
	$temp_report.="<center> ";
	$temp_report.="	<span style='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');' class='span_icon'> ";
	$temp_report.="	<img src='../icons/report.png' alt=' รายงานข้อมูล ' class='images_icon' >  ";
	$temp_report.="	</span>&nbsp;<font color='#0F7FAF'><b> รายงานภาพรวมข้อมูลแผนดำเนินการ </b></center></font> ";
	$temp_report.="</td></tr> ";
	$temp_report.="<tr class='rows_pink'>  ";
	$temp_report.="	<td rowspan='2' valign='middle' align='center' width='60'> ฝ่าย </td> ";
	$temp_report.="	<td rowspan='2' valign='middle' align='center' width='130'> สกต. </td> ";
	$temp_report.="	<td rowspan='2' valign='middle' align='center' width='70'> สรุปแผน </td> ";
	$temp_report.="	<td rowspan='2' valign='middle' align='center' width='70'> แผนสมาชิก </td> ";
	$temp_report.="	<td colspan='2' width='130' align='center'> แผนจัดหาสินค้า </td> ";
	$temp_report.="	<td colspan='2' width='130' align='center'> แผนรวบรวมผลผลิต </td> ";
	$temp_report.="	<td rowspan='2' valign='middle' align='center' width='70'> แผนบริการ </td> ";
	$temp_report.="	<td rowspan='2' valign='middle' align='center' width='70'> แผนใช้จ่าย </td> ";
	$temp_report.="	<td colspan='2' width='130' align='center'> แผนการแปรรูปผลผลิต </td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_pink'>  ";
	$temp_report.="	<td align='center' width='65'> ยอดซื้อ </td> ";
	$temp_report.="	<td align='center' width='65'> ยอดขาย </td> ";
	$temp_report.="	<td align='center' width='65'> ยอดซื้อ </td> ";
	$temp_report.="	<td align='center' width='65'> ยอดขาย </td> ";
	$temp_report.="	<td align='center' width='65'> ยอดซื้อ </td> ";
	$temp_report.="	<td align='center' width='65'> ยอดขาย </td> ";
	$temp_report.="</tr> ";
// สร้างข้อมูลส่วนเนือ้หากลางตาราง

	//ค้นหาข้อมูลตามเงื่อนไขที่เลือก
	$sql=" SELECT userlogin.br_code, AMC.AMCName, ";
	$sql.=" Temp01.amccode,Temp02.amccode ";
	$sql.=" ,Temp03.amccode,Temp04.amccode ";
	$sql.=" ,Temp05.amccode,Temp06.amccode ";
	$sql.=" ,Temp07.amccode,Temp08.amccode, AMC.amccode, userlogin.amcprovince, userlogin.br_code ";
	$sql.=" ,Temp09.amccode,Temp10.amccode ";
	$sql.=" FROM   userlogin,AMC ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanMaster WHERE Plan_year='".$year."' ";
	$sql.=" )AS Temp01 ON Temp01.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanMember WHERE PlanMember_year='".$year."' ";
	$sql.=" )AS Temp02 ON Temp02.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanProcureBuy WHERE PlanProcureBuy_year='".$year."' ";
	$sql.="  GROUP BY amccode "; 
	$sql.=" )AS Temp03 ON Temp03.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanProcureSell WHERE PlanProcureSell_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp04 ON Temp04.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanCollectBuy WHERE PlanCollectBuy_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp05 ON Temp05.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanCollectSell WHERE PlanCollectSell_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp06 ON Temp06.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanService WHERE PlanService_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp07 ON Temp07.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanExpenses WHERE PlanExpenses_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp08 ON Temp08.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanTransBuy WHERE PlanTransBuy_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp09 ON Temp09.amccode = AMC.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="  SELECT amccode FROM PlanTransSell WHERE PlanTransSell_year='".$year."' ";
	$sql.="  GROUP BY amccode ";
	$sql.=" )AS Temp10 ON Temp10.amccode = AMC.amccode ";
	$sql.=" WHERE  userlogin.AMCCode = AMC.AMCCode ";

	if($div!='0')
		$sql.=" AND userlogin.br_code='".$div."' ";

	if($province!='0')
		$sql.=" AND userlogin.amccode='".$province."' ";

	$sql.=" ORDER BY userlogin.br_code, AMC.amcprovince ";
	
	$result_report = query($sql);

	if(num_rows($result_report)==0)
	{
		echo "<center><font color='red'> ไม่มีข้อมูลที่เลือก </font></center>";
		ob_end_flush();
		exit();
	}
	// ***************************   แสดงข้อมูลรายละเอียด  *****************************
	$i=0;
	WHILE($fetch_report = fetch_row($result_report))
	{  $i++;
		if(($i%2)==0)
			$temp_report.="<tr class='rows_grey'>";
		else
			$temp_report.="<tr>";
	
		$temp_report.="<td align='center'>".trim($fetch_report[0])."</td>";
		$temp_report.="<td align='left'>&nbsp;สกต.".trim($fetch_report[1])."</td> ";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[2])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_Master.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='สรุปแผนดำเนินงาน'></a>";	
		 } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[3])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_Member.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='สรุปแผนสมาชิก'></a>";	
		  } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[4])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_ProcureBuy.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการจัดหาสินค้า ยอดซื้อ'></a>";	
		 } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[5])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		} else { 
			 $temp_report.="<a href='Plan_ProcureSell.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการจัดหาสินค้า ยอดขาย'></a>";	
		} // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[6])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_CollectBuy.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการรวบรวมผลผลิต ยอดซื้อ'></a>";	
		  } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[7])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_CollectSell.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการรวบรวมผลผลิต ยอดขาย'></a>";	
		 } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[8])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_service.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการบริการ'></a>";	
		 } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[9])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_Expenses.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนค่าใช้จ่าย '></a>";	
	     } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[13])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_TransBuy.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการแปรรูปผลผลิต ยอดซื้อ '></a>";	
	     } // end if 
		$temp_report.="</td>";
		$temp_report.="<td align='center'>";
		if(is_null($fetch_report[14])) { 
			$temp_report.="<img src='../images/cross.gif' border='0'>";	
		 } else { 
			 $temp_report.="<a href='Plan_TransSell.php?amc_code=".trim($fetch_report[10])."&year=".trim($year)."' target='_blank'><img src='../images/page_blue.gif' border='0' title='แผนการแปรรูปผลผลิต ยอดขาย '></a>";	
	     } // end if 
		$temp_report.="</td>";
		$temp_report.="</tr>";
 }  // end while 

	$temp_report.=" </table>";
	$temp_report.="<br>";
	$temp_report.="<center><img src='../images/page_blue.gif' border='0'> ข้อมูลแผนดำเนินงาน &nbsp;<img src='../images/cross.gif' border='0'> ไม่มีข้อมูล  </center>";

	$temp_report.="<br>";

	free_result($result_report);	

//  สิ้นสุดข้อมูลรายงาน
	close();
	echo $temp_report;
	ob_end_flush();