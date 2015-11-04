<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	query("BEGIN TRAN");

	$sql=" DELETE FROM TableKPI ";
	query($sql);

	$a1= number_format($_POST['a1'],0,'','');
	$a2= number_format($_POST['a2'],0,'','');
	$b1= number_format($_POST['b1'],0,'','');
	$b2= number_format($_POST['b2'],0,'','');
	$c1= number_format($_POST['c1'],0,'','');
	$c2= number_format($_POST['c2'],0,'','');
	$d1= number_format($_POST['d1'],0,'','');
	$d2= number_format($_POST['d2'],0,'','');
	$e1= number_format($_POST['e1'],0,'','');
	$e2= number_format($_POST['e2'],0,'','');
	$sql = " INSERT INTO TableKPI (a1,a2,b1,b2,c1,c2,d1,d2,e1,e2) ";
	$sql.=" VALUES ('$a1','$a2','$b1','$b2','$c1','$c2','$d1','$d2','$e1','$e2') ";
	$result_sql = query($sql);

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

	close();
	print '<script>window.location.href = "base_kpi.php";</script>';
?>