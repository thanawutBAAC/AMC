<?php session_start();
	include("../lib/config.inc.php");
	include("../lib/database.php");

// 1. ลบข้อมูลทั้งหมด
// 2. ปรับปรุงรายงานใหม่ตามที่เลือกมาที่ละรายการ
	connect();
	$sql=" DELETE FROM TargetTris ";
	$sql.=" FROM  TargetTris ";
	$sql.="	WHERE TargetTris.target_year='".$year."' ";
	$sql.=" AND TargetTris.amccode='".$temp_amccode."' ";
	query($sql);

	//  ปรับปรุงข้อมูลเป้าหมาย tris ให้ถูกต้อง
	$sql = " SELECT BaseReportDetail.report_detail_code  ";
	$sql.=" FROM TargetProduct, BaseReportDetail ";
	$sql.=" WHERE (BaseReportDetail.report_group_code='3' OR BaseReportDetail.report_group_code='8') ";
	$sql.=" AND TargetProduct.report_detail_code=BaseReportDetail.report_detail_code ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code ";
	$result_insert = query($sql);

	WHILE( $fetch_insert =  fetch_row($result_insert))
	{
		for($i=1;$i<=12;$i++)
		{
			$temp_insert = number_format($_POST[$i."x".trim($fetch_insert[0])],0,'','');
			if($temp_insert!=0)
			{
				$sql=" INSERT INTO TargetTris ";
				$sql.=" (target_year,target_month, report_detail_code,amccode,target_value) ";
				$sql.=" VALUES     ('".$year."','".$i."','".trim($fetch_insert[0])."','".$temp_amccode."',".$temp_insert.") ";
				query($sql);
			} // end if
		} // end for
	} // end while
	free_result($result_insert);
	close();
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';
	print '<script>window.location.href = "target_tris.php";</script>';	
?>