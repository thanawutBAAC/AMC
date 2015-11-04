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
	
for($i=0;$i<3;$i++)
{ 
	$year=$year-1;
	// ข้อมูลจาก PlanMaster
	$sql=" SELECT ";
	$sql.=" member_year,share_year, ";  //  1  2
	$sql.=" (buy_income_first+buy_income_second+buy_income_third+buy_income_fourth), ";  // 3
	$sql.=" (buy_loan_first+buy_loan_second+buy_loan_third+buy_loan_fourth), ";  // 4
	$sql.=" (buy_principal_first+buy_principal_second+buy_principal_third+buy_principal_fourth), ";   // 5
	$sql.=" (buy_interest_first+buy_interest_second+buy_interest_third+buy_interest_fourth), ";   // 6
	$sql.=" (sell_income_first+sell_income_second+sell_income_third+sell_income_fourth), ";  // 7
	$sql.=" (sell_loan_first+sell_loan_second+sell_loan_third+sell_loan_fourth), ";  // 8
	$sql.=" (sell_principal_first+sell_principal_second+sell_principal_third+sell_principal_fourth), ";  // 9
	$sql.=" (sell_interest_first+sell_interest_second+sell_interest_third+sell_interest_fourth), ";   // 10
	$sql.=" (transform_value_first+transform_value_second+transform_value_third+transform_value_fourth), ";   // 11
	$sql.=" (transform_principal_first+transform_principal_second+transform_principal_third+transform_principal_fourth), ";   // 12
	$sql.=" (transform_income_first+transform_income_second+transform_income_third+transform_income_fourth), ";   //13
	$sql.=" (service_capital_first+service_capital_second+service_capital_third+service_capital_fourth), ";  // 14
	$sql.=" (asset_61_first+asset_61_second+asset_61_third+asset_61_fourth), ";             //  15
	$sql.=" (asset_62_first+asset_62_second+asset_62_third+asset_62_fourth), ";            //   16
	$sql.=" (asset_63_first+asset_63_second+asset_63_third+asset_63_fourth), ";            //   17 
	$sql.=" (asset_64_first+asset_64_second+asset_64_third+asset_64_fourth), ";            //   18
	$sql.=" (asset_65_first+asset_65_second+asset_65_third+asset_65_fourth), ";            //   19
	$sql.=" (asset_66_first+asset_66_second+asset_66_third+asset_66_fourth), ";            //   20
	$sql.=" (asset_67_first+asset_67_second+asset_67_third+asset_67_fourth), ";            //   21
	$sql.=" (asset_68_first+asset_68_second+asset_68_third+asset_68_fourth), ";            //   22
	$sql.=" (asset_69_first+asset_69_second+asset_69_third+asset_69_fourth), ";            //   23
	$sql.=" (asset_610_first+asset_610_second+asset_610_third+asset_610_fourth), ";   //   24
	$sql.=" (asset_611_first+asset_611_second+asset_611_third+asset_611_fourth), ";   //   25
	$sql.=" (asset_612_first+asset_612_second+asset_612_third+asset_612_fourth), ";   //   26
	$sql.=" (asset_613_first+asset_613_second+asset_613_third+asset_613_fourth), ";   //   27
	$sql.=" (asset_614_first+asset_614_second+asset_614_third+asset_614_fourth), ";   //   28
	$sql.=" (asset_615_first+asset_615_second+asset_615_third+asset_615_fourth), ";   //   29
	$sql.=" (income_interest_first+income_interest_second+income_interest_third+income_interset_fourth), ";   // 30
	$sql.=" (income_other_first+income_other_second+income_other_third+income_other_fourth) ";  // 31
	$sql.=" FROM PlanMaster ";
	$sql.=" WHERE amccode='".$temp_code."' AND Plan_year='".$year."' ";

	$result_master = query($sql);
	if(num_rows($result_master)==0)
	{
		$result_xxx = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);  // 31 รายการ
	}
	else{
		$result_xxx = fetch_row($result_master);
	}

	// ข้อมูลแผนสมาชิกรายปี  แผนเพิ่มหุ้น
	$sql = " SELECT MemSumYear, ShareSumYear ";
	$sql.=" FROM PlanMember ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanMember_year='".$year."' ";
	$result_master = query($sql);
	if(num_rows($result_master)==0)
	{ 
		$result_ans.="0#".number_format($result_xxx[0],0,'','')."#0#".number_format($result_xxx[1],0,'','')."#";
	}
	else{
		$result_ans.=result($result_master,0,'MemSumYear')."#"; // 1  รับสมาชิกเพิ่ม
		$result_ans.=number_format($result_xxx[0],0,'','')."#";   //  2  จำนวนสมาชิกสิ้นปี
		$result_ans.=result($result_master,0,'ShareSumYear')."#";  //  3  ทุนเรือนหุ้นเพิ่ม
		$result_ans.=number_format($result_xxx[1],0,'','')."#";  // 4  ทุนเรือนหุ้นสิ้นปี
	}

	// ข้อมูลธุรกิจการซื้อ  ( จัดหาสินค้ามาจำหน่าย) มูลค่าขาย
	$sql =" SELECT  SUM(PlanProcureSell_Sum) ";
	$sql.=" FROM PlanProcureSell ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanProcureSell_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";  // 5  มูลค่าขาย
	} // end while

	// ข้อมูลธุรกิจการซื้อ  ( จัดหาสินค้ามาจำหน่าย) ต้นทุน
	$sql =" SELECT  SUM(PlanProcureBuy_Sum_year) ";
	$sql.=" FROM PlanProcureBuy ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanProcureBuy_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 6  ต้นทุน   ระหว่างปี + ต้นป
	} // end while
   //  หมวดที่ 2  ธุรกิจการซื้อ (จัดหาสินค้ามาจำหน่าย)
	$result_ans.=number_format($result_xxx[2],0,'','')."#";   // 7 รายได้เฉพาะธุรกิจ    

	// หมวดที่ 3 ข้อมูลมูลธุรกิจการซื้อ (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT SUM(PlanExpenses_Sum) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '2'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 8 ค่าใช้จ่ายเฉพาะธุรกิจ
	} // end while
	$result_ans.=number_format($result_xxx[3],0,'','')."#";  // 9  เบิกเงินกู้ ฉ.31 2.2   
	$result_ans.=number_format($result_xxx[4],0,'','')."#";  // 10 ชำระต้นเงิน  
	$result_ans.=number_format($result_xxx[5],0,'','')."#";  // 11 ชำระดอกเบี้ย 

	// ข้อมูลธุรกิจการขาย ( รวบรวมผลิตผล ) มูลค่าขาย
	$sql =" SELECT  SUM(PlanCollectSell_Sum)";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanCollectSell_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 12 มูลค่าขาย
	} // end while 

	// ข้อมูลธุรกิจการขาย ( รวบรวมผลิตผล ) ต้นทุน  
	$sql =" SELECT  SUM(PlanCollectBuy_Sum_year)";
	$sql.=" FROM PlanCollectBuy ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanCollectBuy_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   //  13  ต้นทุน   ระหว่างปี + ต้นปี
	} // end while 

	// หมวดที่ 4 ธุรกิจการขาย (รวบรวมผลิตผล)
	$result_ans.=number_format($result_xxx[6],0,'','')."#";   // 14  รายได้เฉพาะธุรกิจ
	//  (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT SUM(PlanExpenses_Sum) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '3'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";  // 15 ค่าใช้จ่ายเฉพาะธุรกิจ
	} // end while
	$result_ans.=number_format($result_xxx[7],0,'','')."#";   // 16  เบิกเงินกู้ ฉ.31 2.2
	$result_ans.=number_format($result_xxx[8],0,'','')."#";  //  17  ชำระต้นเงิน
	$result_ans.=number_format($result_xxx[9],0,'','')."#";  //  18  ชำระดอกเบี้ย

	// หมวดที่ 5  ข้อมูลธุรกิจแปรรูปผลผลิต และผลิตสินค้า
	$result_ans.=number_format($result_xxx[10],0,'','')."#";   // 19 มูลค่าขาย
	$result_ans.=number_format($result_xxx[11],0,'','')."#";   // 20 ต้นทุน
	$result_ans.=number_format($result_xxx[12],0,'','')."#";   // 21 รายได้
	// (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT SUM(PlanExpenses_Sum) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '4'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 22  ค่าใช้จ่ายเฉฑาะ
	} // end while

// หมวดที่ 6 ธุรกิจบริการ
	$sql =" SELECT  SUM(PlanService_Sum)";
	$sql.=" FROM PlanService ";
	$sql.=" WHERE amccode='".$temp_code."' AND PlanService_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 23 รายได้
	} // end while 
	$result_ans.=number_format($result_xxx[13],0,'','')."#";   // 24 ต้นทุน

	// (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT SUM(PlanExpenses_Sum) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '5'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";  // 25
	} // end while

	// หมวดที่ 7 ธุรกิจสินเชื่อ
	$result_ans.=number_format($result_xxx[14],0,'','')."#";   // 26 รายได้
	$result_ans.=number_format($result_xxx[15],0,'','')."#";   // 27 ต้นทุน
	// (ค่าใช้จ่ายเฉพาะ)
	$sql = " SELECT SUM(PlanExpenses_Sum) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '6'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 28
	} // end while

	// หมวดที่ 8  ค่าใช้จ่ายในการลงทุนทรัพย์สิน
	$result_ans.=number_format($result_xxx[16],0,'','')."#";   // 29 ซื้อที่ดิน
	$result_ans.=number_format($result_xxx[17],0,'','')."#";   // 30 ซื้อรถยนต์
	$result_ans.=number_format($result_xxx[18],0,'','')."#";  //  31 เครื่องใช้สำนักงาน
	$result_ans.=number_format($result_xxx[19],0,'','')."#";  //  32 ซื้อรถหกล้อ
	$result_ans.=number_format($result_xxx[20],0,'','')."#";  //  33 สร้างที่เก็บสินค้า
	$result_ans.=number_format($result_xxx[21],0,'','')."#";   // 34 ซื้อรถจักรยานยนต์
	$result_ans.=number_format($result_xxx[22],0,'','')."#";   // 35 สร้างโรงสี
	$result_ans.=number_format($result_xxx[23],0,'','')."#";  //  36 เบิกเงินกู้ 26
	$result_ans.=number_format($result_xxx[24],0,'','')."#";  //  37 ชำระต้นเงิน
	$result_ans.=number_format($result_xxx[25],0,'','')."#";  //  38 ชำระดอกเบี้ย
  	$result_ans.=number_format($result_xxx[26],0,'','')."#";  //  39 สร้างอาคารสำนักงาน      
	$result_ans.=number_format($result_xxx[27],0,'','')."#";    //  40 สร้างยุ้งฉาง       
	$result_ans.=number_format($result_xxx[28],0,'','')."#";    //  41 สร้างลานตาก      
	$result_ans.=number_format($result_xxx[29],0,'','')."#";    //  42 ซื้อเครื่องจักรและอุปกรณ์      
	$result_ans.=number_format($result_xxx[30],0,'','')."#";    //  43 อื่น ๆ 
	// หมวดที่ 9 ไม่มี
	// หมวดที่ 10 รายได้อื่น ๆ 
	$result_ans.=number_format($result_xxx[31],0,'','')."#";  // 44 รายได้ดอกเบี้ยเงินฝากธนาคาร
	$result_ans.=number_format($result_xxx[32],0,'','')."#";  // 45 รายได้อื่น ๆ 

	// หมวดที่ 11 ค่าใช้จ่ายดำเนินงาน
	$sql = " SELECT SUM(PlanExpenses_Sum) ";
	$sql.=" FROM  BaseReportDetail, PlanExpenses  ";
	$sql.=" WHERE BaseReportDetail.report_detail_code = PlanExpenses.report_detail_code   ";
	$sql.=" AND BaseReportDetail.report_group_code = '7'  ";
	$sql.=" AND BaseReportDetail.report_detail_unit = '1'  ";
	$sql.=" AND PlanExpenses.amccode='".$temp_code."' AND PlanExpenses.PlanExpenses_year='".$year."' ";
	$result_master = query($sql);
	WHILE($result_temp= fetch_row($result_master)){
		$result_ans.=number_format($result_temp[0],0,'','')."#";   // 46
	} // end while

} ///// end for
	
	$rest = substr($result_ans, 0, -1);  // ไม่เอาข้อมูลตัว # ท้ายสุดมา
	echo $rest;
	free_result($result_master);
	close();
?>