<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	query("BEGIN TRAN");

	if($click=='add')
	{
		$sql = " SELECT  report_detail_code FROM  PlanService ";
		$sql.=" WHERE amccode='".$code_online."' AND PlanService_year='".$year."' ";
		if(num_rows(query($sql))>0)
		{
			print '<script> alert(" �������ö���������Żշ�����͡��   ���ͧ�ҡ�բ���������������� "); </script>';
			print '<script>javascript:history.back(1);</script>';
		}
	}
	else if($click=='edit')
	{
		$sql=" DELETE FROM PlanService WHERE amccode='".$code_online."' AND PlanService_year='".$year."' ";
		query($sql);
	}
	else if($click=='del')
	{
		$sql=" DELETE FROM PlanService WHERE amccode='".$code_online."' AND PlanService_year='".$year."' ";
		query($sql);
		query("COMMIT");
		print '<script> alert(" ź�����Ŷ١��ͧ "); </script>';
		print '<script>window.location.href = "PlanService.php";</script>';
		exit();
	}

		$sql = " SELECT BaseReportDetail.report_detail_code ";
		$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
		$sql.=" WHERE BaseReportHeader.amccode='".$code_online."' AND BaseReportHeader.report_group_code='4'  ";
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

		$sql=" INSERT INTO PlanService ";
		$sql.=" (amccode,PlanService_year,report_detail_code,";
		$sql.=" PlanService_Apr,PlanService_May,PlanService_Jun, PlanService_Jul,PlanService_Aug, ";
		$sql.=" PlanService_Sep,PlanService_Oct,PlanService_Nov,PlanService_Dec,PlanService_Jan, ";
		$sql.=" PlanService_Feb,PlanService_Mar,PlanService_Sum) ";
		$sql.=" VALUES ('".$code_online."','".$year."','".trim($fetch_product[0])."',$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13) ";
		$result_sql = query($sql);
	}

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ��Ѻ��ا�����Ŷ١��ͧ ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" �բ�ͼԴ��Ҵ㹡�û�Ѻ��ا������ ");</script>';		}

	close();
	print '<script>window.location.href = "PlanService.php";</script>';
?>