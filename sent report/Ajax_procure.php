<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$year = $_GET["year"];
	
	// รายงานหมวดที่ 2  มูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย
	//  หาข้อมูลการซื้อสินค้าระหว่างปี และ การขายสินค้าระหว่างปี
	$sql = " SELECT BaseReportDetail.report_detail_code, ";
	$sql.=" Temp01.PlanProcureBuy_Sum_year, ";
	$sql.=" Temp02.PlanProcureSell_Sum, ";
	$sql.=" Temp01.PlanProcureBuy_Unit,  ";
	$sql.=" Temp02.PlanProcureSell_Unit ";
	$sql.=" FROM  BaseReportHeader, BaseReportDetail  ";

	$sql.=" LEFT JOIN ";                // ซื้อสินค้าระหว่างปี + ต้นปี
	$sql.=" ( SELECT PlanProcureBuy_Sum_year, report_detail_code, PlanProcureBuy_Unit ";
	$sql.="  FROM PlanProcureBuy ";
	$sql.="  WHERE amccode='".$code_online."' AND PlanProcureBuy_year='".$year."' ";
	$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseReportDetail.report_detail_code ";
	
	$sql.=" LEFT JOIN ";               // ขายสินค้าระหว่างปี
	$sql.=" ( SELECT PlanProcureSell_Sum, report_detail_code, PlanProcureSell_Unit ";
	$sql.=" FROM PlanProcureSell ";
	$sql.="  WHERE amccode='".$code_online."' AND PlanProcureSell_year='".$year."'  ";
	$sql.=" )AS Temp02 ON Temp02.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.=" WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
	$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" AND BaseReportHeader.amccode='".$code_online."'  ";
	$sql.=" AND BaseReportDetail.report_group_code='2' ";
	$sql.=" ORDER BY  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code  ";
	
	$result_plan= query($sql);
	$temp_ans = "";
	WHILE($fetch_plan = fetch_row($result_plan))
	{
		$temp_ans.=number_format($fetch_plan[1],0,'.','')."@";
		$temp_ans.=number_format($fetch_plan[2],0,'.','')."@";
		$temp_ans.=number_format($fetch_plan[3],0,'','')."@";
		$temp_ans.=number_format($fetch_plan[4],0,'','')."#";
	}

	$temp_ans = substr($temp_ans, 0, -1);   //  ไม่เอาตัว # สุดท้ายมา   
	echo $temp_ans;	

	close();
?>