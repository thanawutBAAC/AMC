<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$year = $_GET["year"];
	$month = $_GET["month"];

	// 3. มูลค่าธุรกิจรวบรวมผลิตผล
	//  หาข้อมูลธุรกิจการรวบรวม ทั้ง รวบรวม และจำหน่าย
	$sql= " SELECT BaseReportDetail.report_detail_code, ";
	$sql.="  Temp03.target_value, ";
	$sql.= " Temp01.PlanCollectBuy_Unit, Temp01.PlanCollectBuy_Sum_year,  ";
	$sql.="	Temp02.PlanCollectSell_Unit, Temp02.PlanCollectSell_Sum  ";
	$sql.= " FROM BaseReportHeader, BaseReportDetail  ";

	$sql.= " LEFT JOIN (   ";  // รวมรวมผลผลิตภายในปี ต้นปี + ระหว่างปี
	$sql.= " SELECT PlanCollectBuy_Sum_year, PlanCollectBuy_Unit , report_detail_code  ";
	$sql.= " FROM PlanCollectBuy  ";
	$sql.= " WHERE amccode='".$code_online."' AND PlanCollectBuy_year='".$year."' ) AS Temp01 ";
	$sql.= " ON Temp01.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.= " LEFT JOIN (   ";  // จำหน่ายผลผลิตภายในปี ระหว่างปี
	$sql.= " SELECT PlanCollectSell_Sum, PlanCollectSell_Unit , report_detail_code  ";
	$sql.= " FROM PlanCollectSell   ";
	$sql.= " WHERE amccode='".$code_online."' AND PlanCollectSell_year='".$year."' ) AS Temp02 ";
	$sql.= " ON Temp02.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.="	LEFT JOIN ( ";  // เป้าหมายจาก Tris
	$sql.=" SELECT target_value, report_detail_code ";
	$sql.=" FROM TargetTris ";
	$sql.="  WHERE amccode='".$code_online."' AND target_year='".$year."' AND target_month='".$month."' ) AS Temp03 ";
	$sql.="  ON Temp03.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.= " WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code ";
	$sql.= " AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.= " AND BaseReportHeader.amccode='".$code_online."' AND BaseReportDetail.report_group_code='3' ";
	$sql.= " ORDER BY BaseReportDetail.report_group_code,  ";
	$sql.= " BaseReportDetail.report_detail_code  ";
	$result_plan= query($sql);
	$temp_ans = "";
	WHILE($fetch_plan = fetch_row($result_plan))
	{
		$temp_ans.=number_format($fetch_plan[1],0,'','')."@";
		$temp_ans.=number_format($fetch_plan[2],0,'','')."@";
		$temp_ans.=number_format($fetch_plan[3],0,'','')."@";
		$temp_ans.=number_format($fetch_plan[4],0,'','')."@";
		$temp_ans.=number_format($fetch_plan[5],0,'','')."#";
	}

	$temp_ans = substr($temp_ans, 0, -1);   //  ไม่เอาตัว # สุดท้ายมา   
	echo $temp_ans;	
	free_result($result_plan);
	close();
?>