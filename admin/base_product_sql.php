<?php session_start();
	include("../check_login.php");
	include("../lib/database.php");
	$click = escapeshellcmd(trim($click));
	$code = escapeshellcmd(trim($code));
	$name = escapeshellcmd(trim($_POST["name"]));
	$unit = escapeshellcmd(trim($_POST["unit"]));
	$main_product = escapeshellcmd(trim($_POST["main_product"]));
	$sub_product = escapeshellcmd(trim($_POST["sub_product"]));
	connect();

	if($click=='add')
	{
		$sql = " SELECT  pro_code  FROM  BaseProduct ";
		$sql.=" WHERE  (pro_code = '".$code."') ";
		if(num_rows(query($sql))==1)
		{
			print '<script>alert(" �բ��������� '.$code.' ��ӡѹ  ��سҺѹ�֡�����������ա���� ");</script>';
			print '<script>window.history.back();</script>';
		}
		$sql = " INSERT INTO BaseProduct (pro_code, pro_name, sub_pro_code, pro_unit) ";
		$sql.=" VALUES  ('".$code."','".$name."','".$sub_product."','".$unit."') ";
		// �����ŵ��ҧ��˹���§ҹ��ҧ � 
		$sql1 = " INSERT INTO BaseReportDetail ";
		$sql1.= "  (report_group_code,report_detail_code,report_detail_name, report_detail_unit) ";
		$sql1.= " VALUES  ('3','".$code."','".$name."','".$unit."') ";
	}
	elseif($click=='edit')
	{	$sql = " UPDATE BaseProduct ";
		$sql.=" SET  pro_name = '".$name."', sub_pro_code = '".$sub_product."' ,pro_unit = '".$unit."' ";
		$sql.=" WHERE pro_code='".$code."' ";
		// �����ŵ��ҧ��˹���§ҹ��ҧ � 
		$sql1 = " UPDATE BaseReportDetail ";
		$sql1.=" SET report_detail_name='".$name."', report_detail_unit='".$unit."' ";
		$sql1.= " WHERE report_group_code='3' AND report_detail_code='".$code."' ";
	}
	elseif($click=='del')
	{
		// ��Ǩ�ͺ�����š�͹ź
		$sql = " SELECT report_group_code FROM BaseReportDetail ";
		$sql.="	WHERE report_detail_code='".$code."' AND report_group_code ='3' ";
		if(num_rows(query($sql))>=1)
		{	print '<script>alert(" �������öź���������� '.$code.' �� ���ͧ�ҡ���������� ");</script>';
			print '<script>window.history.back();</script>';
		}

		// �����ŵ��ҧ��˹���§ҹ��ҧ � 
		$sql = " DELETE FROM BaseProduct WHERE pro_code='".$code."' ";
		$sql1 = " DELETE FROM BaseReportDetail WHERE  report_group_code='3' AND report_detail_code='".$code."' ";
	}
	query($sql);
	query($sql1);
	close();

	print '<script>alert(" ��Ѻ��ا�����Ŷ١��ͧ ");</script>';
	print '<script>window.location.href = "base_product.php";</script>';
?>