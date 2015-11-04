<?php session_start();
	include("../check_login.php");
	include("../lib/database.php");
	$click = escapeshellcmd(trim($click));
	$code = escapeshellcmd(trim($code));
	$name = escapeshellcmd(trim($_POST["name"]));
	$main_product = escapeshellcmd(trim($_POST["main_product"]));
	connect();

	if($click=='add')
	{	$sql = " SELECT  sub_pro_code  FROM  BaseSubProduct ";
		$sql.=" WHERE  (sub_pro_code = '".$code."') ";
		if(num_rows(query($sql))==1)
		{	print '<script>alert(" มีข้อมูลรหัส '.$code.' ซ้ำกัน  กรุณาบันทึกข้อมูลใหม่อีกครั้ง ");</script>';
			print '<script>window.history.back();</script>';
		}
		$sql =" INSERT INTO BaseSubProduct ";
        $sql.="  (sub_pro_code, sub_pro_name, main_pro_code) ";
		$sql.= " VALUES ('".$code."','".$name."','".$main_product."') ";
	}
	elseif($click=='edit')
	{	$sql =" UPDATE BaseSubProduct ";
		$sql.=" SET  sub_pro_name='".$name."', main_pro_code ='".$main_product."' ";
		$sql.=" WHERE  (sub_pro_code = '".$code."') ";
	}
	elseif($click=='del')
	{	// ตรวจสอบข้อมูลก่อนลบ
		$sql = " SELECT pro_code FROM BaseProduct WHERE sub_pro_code='".$code."' ";
		if(num_rows(query($sql))>=1)
		{
			print '<script>alert(" ไม่สามารถลบข้อมูลรหัส '.$code.' ได้ เนื่องจากได้นำไปใช้แล้ว ");</script>';
			print '<script>window.history.back();</script>';
		}
		// ลบข้อมูล
		$sql = " DELETE FROM BaseSubProduct WHERE sub_pro_code='".$code."' ";
	}
	
	query($sql);
	close();
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';
	print '<script>window.location.href = "base_sub_product.php";</script>';
?>