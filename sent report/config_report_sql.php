<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

// 1. ลบข้อมูลทั้งหมด
// 2. ปรับปรุงรายงานใหม่ตามที่เลือกมาที่ละรายการ
	connect();
	$sql = " DELETE FROM BaseReportHeader WHERE amccode='".$code_online."' ";
	query($sql);

	$sql = " SELECT  report_group_code, report_detail_code FROM  BaseReportDetail ";
	$sql.=" WHERE report_group_code<>'7' ";
//	$sql.=" ORDER BY  cast(BaseReportDetail.report_detail_code AS int)  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_name ";
	$result_insert = query($sql);
	WHILE( $fetch_insert =  fetch_row($result_insert))
	{
		$temp_insert = $_POST["chk".trim($fetch_insert[0]).trim($fetch_insert[1])];
		if(trim($temp_insert)==1)
		{		
			$i++;
			$sql = " INSERT INTO BaseReportHeader ";
			$sql.="  (amccode, report_group_code, report_detail_code) ";
			$sql.="  VALUES ('".$code_online."','".trim($fetch_insert[0])."','".trim($fetch_insert[1])."') ";
			query($sql);
		}
	}
	close();
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง '.$i.' รายการ ");</script>';
	print '<script>window.location.href = "config_report.php";</script>';	
?>