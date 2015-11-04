<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	query("BEGIN TRAN");

	if($click=='add'){
		$sql = " SELECT  report_detail_code FROM  PlanExpenses ";
		$sql.=" WHERE amccode='".$code_online."' AND PlanExpenses_year='".$year."' ";
		if(num_rows(query($sql))>0)
		{
			print '<script> alert(" ไม่สามารถเพิ่มข้อมูลปีที่เลือกได้   เนื่องจากมีข้อมูลเดิมอยู่แล้ว "); </script>';
			print '<script>javascript:history.back(1);</script>';
		} // end if
	}
	else if($click=='edit'){
		$sql=" DELETE FROM PlanExpenses WHERE amccode='".$code_online."' AND PlanExpenses_year='".$year."' ";
		query($sql);
	}
	else if($click=='del'){
		$sql=" DELETE FROM PlanExpenses WHERE amccode='".$code_online."' AND PlanExpenses_year='".$year."' ";
		query($sql);
		query("COMMIT");
		print '<script> alert(" ลบข้อมูลถูกต้อง "); </script>';
		print '<script>window.location.href = "PlanExpenses.php";</script>';
		exit();
	}

		$sql = " SELECT BaseReportDetail.report_detail_code ";
		$sql.=" FROM BaseReportDetail  ";
		$sql.=" WHERE  BaseReportDetail.report_group_code='7'  ";
		$sql.=" ORDER BY CAST(BaseReportDetail.report_detail_code AS INT)  ";

	$result_product = query($sql);
	WHILE($fetch_product = fetch_row($result_product))		
	{
		$a1= $_POST[trim($fetch_product[0]).'x1'];
		$a2= $_POST[trim($fetch_product[0]).'x2'];
		$a3= $_POST[trim($fetch_product[0]).'x3'];
		$a4= $_POST[trim($fetch_product[0]).'x4'];
		$a5= $_POST[trim($fetch_product[0]).'x5'];
		$a6= $_POST[trim($fetch_product[0]).'x6'];
		$a7= $_POST[trim($fetch_product[0]).'x7'];
		$a8= $_POST[trim($fetch_product[0]).'x8'];
		$a9= $_POST[trim($fetch_product[0]).'x9'];
		$a10= $_POST[trim($fetch_product[0]).'x10'];
		$a11= $_POST[trim($fetch_product[0]).'x11'];
		$a12= $_POST[trim($fetch_product[0]).'x12'];
		$a13= $_POST[trim($fetch_product[0]).'x13'];

		$sql=" INSERT INTO PlanExpenses ";
		$sql.=" (amccode,PlanExpenses_year,report_detail_code,";
		$sql.=" PlanExpenses_Apr,PlanExpenses_May,PlanExpenses_Jun, PlanExpenses_Jul,PlanExpenses_Aug, ";
		$sql.=" PlanExpenses_Sep,PlanExpenses_Oct,PlanExpenses_Nov,PlanExpenses_Dec,PlanExpenses_Jan, ";
		$sql.=" PlanExpenses_Feb,PlanExpenses_Mar,PlanExpenses_Sum) ";
		$sql.=" VALUES ('".$code_online."','".$year."','".trim($fetch_product[0])."',$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13) ";
		$result_sql = query($sql);
	}

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

	close();
	print '<script>window.location.href = "PlanExpenses.php";</script>';
?>