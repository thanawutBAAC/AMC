<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	
	connect();
	$year = $_GET["year"];
	// แสดงข้อมูลหมวดที่ 4 ของสกต ที่เลือกทั้งหมด
	$sql =" SELECT BaseReportDetail.report_detail_code,  ";
	$sql.="   Temp01.PlanService_Sum  ";
	$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
	$sql.=" LEFT JOIN (  ";
	$sql.="	SELECT   ";
	$sql.="	  PlanService_Sum,  ";
	$sql.="	  report_detail_code,  ";
	$sql.="	  amccode, PlanService_year  ";
	$sql.="	FROM PlanService  ";
	$sql.="	WHERE amccode='".$code_online."' AND PlanService_year='".$year."'  "; 
	$sql.=") AS Temp01   ";
	$sql.=" ON Temp01.amccode = BaseReportHeader.amccode   ";
	$sql.=" AND Temp01.report_detail_code=BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp01.PlanService_year = '".$year."'  "; 
	$sql.=" WHERE BaseReportHeader.amccode='".$code_online."'   ";
	$sql.="   AND BaseReportHeader.report_group_code='4'    ";
	$sql.="   AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code   ";
	$sql.="   AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code   ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code   ";
	$result_service = query($sql);

	WHILE($fetch_service = fetch_row($result_service)) {
			$temp_service = $temp_service.number_format($fetch_service[1],0,'','')."#";
	}
	
	$temp_service = substr($temp_service, 0, -1);   //  ไม่เอาตัว # สุดท้ายมา   
	echo $temp_service;

	free_result($result_service);
	close();
?>