<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	query("BEGIN TRAN");

	if($click=='add')
	{
		$sql = " SELECT  PlanMember_year FROM  PlanMember ";
		$sql.=" WHERE amccode='".$code_online."' AND PlanMember_year='".$year."' ";
		if(num_rows(query($sql))>0)
		{
			print '<script> alert(" ไม่สามารถเพิ่มข้อมูลปีที่เลือกได้   เนื่องจากมีข้อมูลเดิมอยู่แล้ว "); </script>';
			print '<script>javascript:history.back(1);</script>';
		}
	}
	else if($click=='edit')
	{
		$sql=" DELETE FROM PlanMember WHERE amccode='".$code_online."' AND PlanMember_year='".$year."' ";
		query($sql);
	}
	else if($click=='del')
	{
		$sql=" DELETE FROM PlanMember  WHERE amccode='".$code_online."' AND PlanMember_year='".$year."' ";
		query($sql);
		query("COMMIT");
		print '<script> alert(" ลบข้อมูลถูกต้อง "); </script>';
		print '<script>window.location.href = "PlanMember.php";</script>';
		exit();
	}

		$a1= $_POST['x1'];
		$a2= $_POST['x2'];
		$a3= $_POST['x3'];
		$a4= $_POST['x4'];
		$a5= $_POST['x5'];
		$a6= $_POST['y1'];
		$a7= $_POST['y2'];
		$a8= $_POST['y3'];
		$a9= $_POST['y4'];
		$a10=$_POST['y5'];

	$sql=" INSERT INTO PlanMember ";
    $sql.="   (amccode, PlanMember_year,MemFirstQuarter,MemSecondQuarter,MemThirdQuarter,MemFourthQuarter,MemSumYear, ";
    $sql.="  ShareFirstQuarter,ShareSecondQuarter,ShareThirdQuarter,ShareFourthQuarter,ShareSumYear) ";
	$sql.=" VALUES ('$code_online','$year',$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10) ";
	
	$result_sql = query($sql);

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

	close();
	print '<script>window.location.href = "PlanMember.php";</script>';
?>