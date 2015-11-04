<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$year = $_GET["year"];
	$month = $_GET["month"];

	// 8. ธุรกิจรวบรวมผลผลิต
	//  หาข้อมูลธุรกิจการรวบรวม ทั้ง รวบรวม และจำหน่าย
	$sql= " SELECT BaseReportDetail.report_detail_code, ";
	$sql.="  Temp03.target_value, ";
	$sql.= " Temp01.PlanTransBuy_Unit, Temp01.PlanTransBuy_Sum_year,  ";
	$sql.="	Temp02.PlanTransSell_Unit, Temp02.PlanTransSell_Sum  ";
	$sql.= " FROM BaseReportHeader, BaseReportDetail  ";

	$sql.= " LEFT JOIN (   ";  // แปรรูปผลผลิตภายในปี ต้นปี + ระหว่างปี
	$sql.= " SELECT PlanTransBuy_Sum_year, PlanTransBuy_Unit , report_detail_code  ";
	$sql.= " FROM PlanTransBuy  ";
	$sql.= " WHERE amccode='".$code_online."' AND PlanTransBuy_year='".$year."' ) AS Temp01 ";
	$sql.= " ON Temp01.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.= " LEFT JOIN (   ";  // จำหน่ายผลผลิตภายในปี ระหว่างปี
	$sql.= " SELECT PlanTransSell_Sum, PlanTransSell_Unit , report_detail_code  ";
	$sql.= " FROM PlanTransSell   ";
	$sql.= " WHERE amccode='".$code_online."' AND PlanTransSell_year='".$year."' ) AS Temp02 ";
	$sql.= " ON Temp02.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.="	LEFT JOIN ( ";  // เป้าหมายจาก Tris
	$sql.=" SELECT target_value, report_detail_code ";
	$sql.=" FROM TargetTris ";
	$sql.="  WHERE amccode='".$code_online."' AND target_year='".$year."' AND target_month='".$month."' ) AS Temp03 ";
	$sql.="  ON Temp03.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.= " WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code ";
	$sql.= " AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.= " AND BaseReportHeader.amccode='".$code_online."' AND BaseReportDetail.report_group_code='8' ";
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