<?php session_start();
	include("../lib/config.inc.php");
	include("../lib/database.php");

// 1. ลบข้อมูลทั้งหมด
// 2. ปรับปรุงรายงานใหม่ตามที่เลือกมาที่ละรายการ
	connect();
	$sql = " DELETE FROM TargetProduct ";
	query($sql);

	//  แสดงข้อมูลสินค้าที่สามารถกระจายเป้าได้ทั้งหมด หมวดที่ 3 8
	$sql = " SELECT BaseReportDetail.report_detail_code ";
	$sql.=" FROM BaseReportDetail ";
	$sql.=" WHERE report_group_code='3' OR report_group_code='8' ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code ";
	$result_insert = query($sql);
	WHILE( $fetch_insert =  fetch_row($result_insert))
	{
		$temp_insert = $_POST["x".trim($fetch_insert[0])];
		$temp_kpi = $_POST["y".trim($fetch_insert[0])];
		if(trim($temp_insert)==1)
			$a = 1;
		else
			$a = null;
		if(trim($temp_kpi)==1)
			$b = 1;
		else
			$b = null;

		if( ($a==1) or ($b==1)  )
		{		
			$i++;
			$sql = " INSERT INTO TargetProduct ";
            $sql.="  (report_detail_code, target_check, target_kpi) ";
			$sql.="  VALUES ('".trim($fetch_insert[0])."','".$a."','".$b."') ";
			query($sql);
		}
	}
	free_result($result_insert);
	close();
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง '.$i.' รายการ ");</script>';
	print '<script>window.location.href = "target_product.php";</script>';	
?>