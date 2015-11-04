<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	query("BEGIN TRAN");

	if($click=='add')
	{
		$sql = " SELECT  report_detail_code FROM  PlanCollectBuy ";
		$sql.=" WHERE amccode='".$code_online."' AND PlanCollectBuy_year='".$year."' ";
		if(num_rows(query($sql))>0)
		{
			print '<script> alert(" ไม่สามารถเพิ่มข้อมูลปีที่เลือกได้   เนื่องจากมีข้อมูลเดิมอยู่แล้ว "); </script>';
			print '<script>javascript:history.back(1);</script>';
		}
	}
	else if($click=='edit')
	{
		$sql=" DELETE FROM PlanCollectBuy WHERE amccode='".$code_online."' AND PlanCollectBuy_year='".$year."' ";
		query($sql);
	}
	else if($click=='del')
	{
		$sql=" DELETE FROM PlanCollectBuy WHERE amccode='".$code_online."' AND PlanCollectBuy_year='".$year."' ";
		query($sql);
		query("COMMIT");
		print '<script> alert(" ลบข้อมูลถูกต้อง "); </script>';
		print '<script>window.location.href = "PlanCollectBuy.php";</script>';
		exit();
	}

		$sql = " SELECT BaseReportDetail.report_detail_code ";
		$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
		$sql.=" WHERE BaseReportHeader.amccode='".$code_online."' AND BaseReportHeader.report_group_code='3'  ";
		$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code ";
		$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code ";
		$sql.=" ORDER BY BaseReportDetail.report_detail_code ";

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
		$a14= $_POST[trim($fetch_product[0]).'x14'];
		$a15= $_POST[trim($fetch_product[0]).'x15'];
		$a16= $_POST[trim($fetch_product[0]).'x16'];
		$a17= $_POST[trim($fetch_product[0]).'x17'];
		$a18= $_POST[trim($fetch_product[0]).'x18'];
		$a19= $_POST[trim($fetch_product[0]).'x19'];

		$sql=" INSERT INTO PlanCollectBuy ";
		$sql.=" (amccode,PlanCollectBuy_year,report_detail_code,Imports_unit,Imports_price,PlanCollectBuy_price, ";
		$sql.=" PlanCollectBuy_Apr,PlanCollectBuy_May,PlanCollectBuy_Jun, PlanCollectBuy_Jul,PlanCollectBuy_Aug, ";
		$sql.=" PlanCollectBuy_Sep,PlanCollectBuy_Oct,PlanCollectBuy_Nov,PlanCollectBuy_Dec,PlanCollectBuy_Jan, ";
		$sql.=" PlanCollectBuy_Feb,PlanCollectBuy_Mar,PlanCollectBuy_Unit,PlanCollectBuy_Sum,PlanCollectBuy_Unit_year, ";
		$sql.=" PlanCollectBuy_Sum_year) ";
		$sql.=" VALUES ('".$code_online."','".$year."','".trim($fetch_product[0])."',$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13,$a14,$a15,$a16,$a17,$a18,$a19) ";
		$result_sql = query($sql);
	}

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

	close();
	print '<script>window.location.href = "PlanCollectBuy.php";</script>';
?>