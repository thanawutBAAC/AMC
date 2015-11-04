<?php session_start();
	include("../lib/config.inc.php");
	include("../lib/database.php");

// 1. ลบข้อมูลทั้งหมด
// 2. ปรับปรุงรายงานใหม่ตามที่เลือกมาที่ละรายการ
	connect();
	query("BEGIN TRAN");

	$sql=" DELETE FROM TargetTris ";
	$sql.=" FROM  TargetTris INNER JOIN ";
	$sql.=" userlogin ON TargetTris.amccode = userlogin.amccode ";
	$sql.="	WHERE TargetTris.target_year='".$year."' ";
	$sql.=" AND TargetTris.report_detail_code='".$report_detail_code."' ";
	if($br_code!='all')
	{	
		$sql.=" AND userlogin.br_code='".$br_code."' ";
	}

	query($sql);

	//  ปรับปรุงข้อมูลเป้าหมาย tris ให้ถูกต้อง
	$sql = " SELECT userlogin.br_code, userlogin.userdetail, userlogin.amcprovince, userlogin.amccode ";
	$sql.=" FROM userlogin ";
	$sql.=" WHERE userlogin.status='N' ";
	if($br_code!='all')
	{	
		$sql.=" AND userlogin.br_code='".$br_code."' ";
	}
	$sql.=" ORDER BY userlogin.br_code,userlogin.userdetail ";
	$result_insert =query($sql);

	WHILE( $fetch_insert =  fetch_row($result_insert))
	{
		for($j=1;$j<=12;$j++)
		{
		$temp_insert = number_format($_POST[$j."x".trim($fetch_insert[2])],0,'','');
		$temp_amccode = trim($fetch_insert[3]);
			if($temp_insert!=0)
			{
				$sql=" INSERT INTO TargetTris ";
				$sql.=" (target_year, target_month, report_detail_code,amccode,target_value) ";
				$sql.=" VALUES  ('".$year."','".$j."','".trim($report_detail_code)."','".$temp_amccode."',".$temp_insert.") ";		

				$result_sql=query($sql);
			} // end if
		} // end for
	} // end while

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

	close();
	print '<script>window.location.href = "target_tris_product.php";</script>';
?>