<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	
	$year = $_GET["year"];
	$amc_code = $_GET["amc_code"];
	
	if(trim($amc_code)==""){
			$temp_code = $code_online;
	}
	else{
			$temp_code = $amc_code;
	}

	$result_ans = '';  // ผลลัพธ์ทั้งหมด
	// ข้อมูลแผนสมาชิกรายปี  แผนเพิ่มหุ้น
    $sql =" SELECT MemFirstQuarter, MemSecondQuarter, ";
	$sql.=" MemThirdQuarter, MemFourthQuarter, ";
	$sql.=" ShareFirstQuarter, ShareSecondQuarter, ";
	$sql.=" ShareThirdQuarter, ShareFourthQuarter ";
	$sql.=" FROM PlanMember ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanMember_year='".$year."' ";
	$result_master = query($sql);
	if(num_rows($result_master)==0)
	{
		$result_ans.="0#0#0#0#0#0#0#0#";
	}
	else
	{
		$result_ans.=result($result_master,0,'MemFirstQuarter')."#";				//   0
		$result_ans.=result($result_master,0,'MemSecondQuarter')."#";			//   1
		$result_ans.=result($result_master,0,'MemThirdQuarter')."#";				//   2
		$result_ans.=result($result_master,0,'MemFourthQuarter')."#";			//   3
		$result_ans.=result($result_master,0,'ShareFirstQuarter')."#";				//   4
		$result_ans.=result($result_master,0,'ShareSecondQuarter')."#";		//   5
		$result_ans.=result($result_master,0,'ShareThirdQuarter')."#";			//   6
		$result_ans.=result($result_master,0,'ShareFourthQuarter')."#";			//   7
	}
// **********************************************************************************************************************************
	// หมวดที่ 3  ข้อมูลธุรกิจการซื้อ (จัดหาสินค้ามาจำหน่าย) มูลค่าขาย
	$sql =" SELECT ";
	$sql.=" SUM(PlanProcureSell_Apr), SUM(PlanProcureSell_May), SUM(PlanProcureSell_Jun), ";
	$sql.=" SUM(PlanProcureSell_Jul),  SUM(PlanProcureSell_Aug), SUM(PlanProcureSell_Sep), ";
	$sql.=" SUM(PlanProcureSell_Oct), SUM(PlanProcureSell_Nov), SUM(PlanProcureSell_Dec), ";
	$sql.=" SUM(PlanProcureSell_Jan), SUM(PlanProcureSell_Feb), SUM(PlanProcureSell_Mar)  ";
	$sql.=" FROM PlanProcureSell ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanProcureSell_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //    8
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //    9
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //  10
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //   11 
	} // end while

	// หมวดที่ 3  ข้อมูลธุรกิจการซื้อ (จัดหาสินค้ามาจำหน่าย) ต้นทุน
	$sql =" SELECT ";
	$sql.=" SUM(PlanProcureBuy_Apr), SUM(PlanProcureBuy_May), SUM(PlanProcureBuy_Jun), ";
	$sql.=" SUM(PlanProcureBuy_Jul), SUM(PlanProcureBuy_Aug), SUM(PlanProcureBuy_Sep), ";
	$sql.=" SUM(PlanProcureBuy_Oct), SUM(PlanProcureBuy_Nov), SUM(PlanProcureBuy_Dec), ";
	$sql.=" SUM(PlanProcureBuy_Jan), SUM(PlanProcureBuy_Feb), SUM(PlanProcureBuy_Mar), ";
	$sql.=" SUM(Imports_price)  FROM PlanProcureBuy ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanProcureBuy_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		// 12
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		// 13
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		// 14
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";	// 15
		$result_ans.=number_format($result_temp[12],0,'','')."#";																		//  16
	} // end while

	// หมวดที่ 3 ข้อมูลมูลธุรกิจการซื้อ (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT ";
	$sql.=" SUM(PlanExpenses_Apr), SUM(PlanExpenses_May), SUM(PlanExpenses_Jun), ";
	$sql.=" SUM(PlanExpenses_Jul), SUM(PlanExpenses_Aug), SUM(PlanExpenses_Sep), ";
	$sql.=" SUM(PlanExpenses_Oct), SUM(PlanExpenses_Nov), SUM(PlanExpenses_Dec), ";
	$sql.=" SUM(PlanExpenses_Jan), SUM(PlanExpenses_Feb), SUM(PlanExpenses_Mar) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '2'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //      17
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //      18
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //		19
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //		20 
	} // end while
// **********************************************************************************************************************************
	// หมวดที่ 4 ข้อมูลธุรกิจการขาย ( รวบรวมผลิตผล ) มูลค่าขาย
	$sql=" SELECT ";
	$sql.=" SUM(PlanCollectSell_Apr), SUM(PlanCollectSell_May), SUM(PlanCollectSell_Jun), ";
	$sql.=" SUM(PlanCollectSell_Jul), SUM(PlanCollectSell_Aug), SUM(PlanCollectSell_Sep), ";
	$sql.=" SUM(PlanCollectSell_Oct), SUM(PlanCollectSell_Nov), SUM(PlanCollectSell_Dec), ";
	$sql.=" SUM(PlanCollectSell_Jan), SUM(PlanCollectSell_Feb), SUM(PlanCollectSell_Mar) ";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanCollectSell_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		//  21
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		//  22
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		//  23
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";  //  24
	}  // end while
	// หมวดที่ 4 ข้อมูลธุรกิจการขาย ( รวบรวมผลิตผล ) ต้นทุน
	$sql=" SELECT ";
	$sql.=" SUM(PlanCollectBuy_Apr), SUM(PlanCollectBuy_May), SUM(PlanCollectBuy_Jun), ";
	$sql.=" SUM(PlanCollectBuy_Jul), SUM(PlanCollectBuy_Aug), SUM(PlanCollectBuy_Sep), ";
	$sql.=" SUM(PlanCollectBuy_Oct), SUM(PlanCollectBuy_Nov), SUM(PlanCollectBuy_Dec), ";
	$sql.=" SUM(PlanCollectBuy_Jan), SUM(PlanCollectBuy_Feb), SUM(PlanCollectBuy_Mar), ";
	$sql.=" SUM(Imports_price)  FROM PlanCollectBuy ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanCollectBuy_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";     // 25
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";     // 26
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";      // 27
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";  // 28
		$result_ans.=number_format($result_temp[12],0,'','')."#";  // 29
	}  // end while
	// หมวดที่ 4 ข้อมูลมูลธุรกิจการซื้อ (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT ";
	$sql.=" SUM(PlanExpenses_Apr), SUM(PlanExpenses_May), SUM(PlanExpenses_Jun), ";
	$sql.=" SUM(PlanExpenses_Jul), SUM(PlanExpenses_Aug), SUM(PlanExpenses_Sep), ";
	$sql.=" SUM(PlanExpenses_Oct), SUM(PlanExpenses_Nov), SUM(PlanExpenses_Dec), ";
	$sql.=" SUM(PlanExpenses_Jan), SUM(PlanExpenses_Feb), SUM(PlanExpenses_Mar) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '3'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //      29
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //      30
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //		31
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //		32 
	} // end while
 // *************************************************************************************************************************
// หมวดที่ 5  ธุรกิจแปรรูปผลผลิต และผลิตสินค้า  (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT ";
	$sql.=" SUM(PlanExpenses_Apr), SUM(PlanExpenses_May), SUM(PlanExpenses_Jun), ";
	$sql.=" SUM(PlanExpenses_Jul), SUM(PlanExpenses_Aug), SUM(PlanExpenses_Sep), ";
	$sql.=" SUM(PlanExpenses_Oct), SUM(PlanExpenses_Nov), SUM(PlanExpenses_Dec), ";
	$sql.=" SUM(PlanExpenses_Jan), SUM(PlanExpenses_Feb), SUM(PlanExpenses_Mar) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '4'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //      33
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //      34
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //		35
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //		36 
	} // end while
 // *************************************************************************************************************************

// หมวดที่  6  ข้อมูลรายได้ธุรกิจ บริการ
	$sql=" SELECT ";
	$sql.=" SUM(PlanService_Apr), SUM(PlanService_May), SUM(PlanService_Jun), ";
	$sql.=" SUM(PlanService_Jul),  SUM(PlanService_Aug), SUM(PlanService_Sep), ";
	$sql.=" SUM(PlanService_Oct), SUM(PlanService_Nov), SUM(PlanService_Dec), ";
	$sql.=" SUM(PlanService_Jan), SUM(PlanService_Feb), SUM(PlanService_Mar) ";
	$sql.=" FROM PlanService ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanService_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";      // 37
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";      // 38
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";      // 39
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";  // 40
	}  // end while 
// ธุรกิจบริการ  (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT ";
	$sql.=" SUM(PlanExpenses_Apr), SUM(PlanExpenses_May), SUM(PlanExpenses_Jun), ";
	$sql.=" SUM(PlanExpenses_Jul), SUM(PlanExpenses_Aug), SUM(PlanExpenses_Sep), ";
	$sql.=" SUM(PlanExpenses_Oct), SUM(PlanExpenses_Nov), SUM(PlanExpenses_Dec), ";
	$sql.=" SUM(PlanExpenses_Jan), SUM(PlanExpenses_Feb), SUM(PlanExpenses_Mar) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '5'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //      41
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //      42
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //		43
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //		44 
	} // end while
 // *************************************************************************************************************************

// หมวดที่  6  ข้อมูลรายได้ธุรกิจ สินเชื่อ
	$sql = " SELECT ";
	$sql.=" SUM(PlanExpenses_Apr), SUM(PlanExpenses_May), SUM(PlanExpenses_Jun), ";
	$sql.=" SUM(PlanExpenses_Jul), SUM(PlanExpenses_Aug), SUM(PlanExpenses_Sep), ";
	$sql.=" SUM(PlanExpenses_Oct), SUM(PlanExpenses_Nov), SUM(PlanExpenses_Dec), ";
	$sql.=" SUM(PlanExpenses_Jan), SUM(PlanExpenses_Feb), SUM(PlanExpenses_Mar) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '6'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //      45
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //      46
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //		47
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //		48 
	} // end while
 // *************************************************************************************************************************
// หมวดที่  11  ข้อมูลค่าใช้จ่ายดำเนินงาน
	$sql = " SELECT ";
	$sql.=" SUM(PlanExpenses_Apr), SUM(PlanExpenses_May), SUM(PlanExpenses_Jun), ";
	$sql.=" SUM(PlanExpenses_Jul), SUM(PlanExpenses_Aug), SUM(PlanExpenses_Sep), ";
	$sql.=" SUM(PlanExpenses_Oct), SUM(PlanExpenses_Nov), SUM(PlanExpenses_Dec), ";
	$sql.=" SUM(PlanExpenses_Jan), SUM(PlanExpenses_Feb), SUM(PlanExpenses_Mar) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '1'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0]+$result_temp[1]+$result_temp[2] ,0,'','')."#";		  //      49
		$result_ans.=number_format($result_temp[3]+$result_temp[4]+$result_temp[5] ,0,'','')."#";		  //      50
		$result_ans.=number_format($result_temp[6]+$result_temp[7]+$result_temp[8] ,0,'','')."#";		  //		51
		$result_ans.=number_format($result_temp[9]+$result_temp[10]+$result_temp[11] ,0,'','')."#";    //		52 
	} // end while
 // *************************************************************************************************************************

	$result_ans = substr($result_ans, 0, -1);  // ไม่เอาข้อมูลตัว # ท้ายสุดมา
	// ข้อมูลทั้งหมด 52 รายการ
	echo $result_ans;
	free_result($result_master);
	close();
?>