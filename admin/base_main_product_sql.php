<?php session_start();
	include("../check_login.php");
	include("../lib/database.php");

	$click = escapeshellcmd(trim($click));
	$code = escapeshellcmd(trim($code));
	$name = escapeshellcmd(trim($_POST["name"]));

	connect();

	if($click=='add')
	{
		$sql =" SELECT main_pro_code FROM BaseMainProduct ";
		$sql.=" WHERE (main_pro_code = '".$code."') ";

		if(num_rows(query($sql))==1)
		{
			print '<script>alert(" �բ��������� '.$code.' ��ӡѹ  ��سҺѹ�֡�����������ա���� ");</script>';
			print '<script>window.history.back();</script>';
		}
		$sql = " INSERT INTO BaseMainProduct (main_pro_code,main_pro_name) VALUES ('".$code."','".$name."') ";
	}
	elseif($click=='edit')
	{
		$sql =" UPDATE  BaseMainProduct SET main_pro_name = '".$name."' ";
		$sql.=" WHERE main_pro_code = '".$code."' ";
	}
	elseif($click=='del')
	{
		// ��Ǩ�ͺ�����š�͹ź
		$sql = " SELECT sub_pro_code FROM BaseSubProduct WHERE main_pro_code='".$code."' ";
		if(num_rows(query($sql))>=1)
		{
			print '<script>alert(" �������öź���������� '.$code.' �� ���ͧ�ҡ���������� ");</script>';
			print '<script>window.history.back();</script>';
		}
		$sql = " DELETE FROM BaseMainProduct WHERE main_pro_code='".$code."' ";
	}
	
	query($sql);
	close();
	print '<script>alert(" ��Ѻ��ا�����Ŷ١��ͧ ");</script>';
	print '<script>window.location.href = "base_main_product.php";</script>';
?>