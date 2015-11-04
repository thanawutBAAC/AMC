<?php session_start();
	include("../check_login.php");
	include("../lib/database.php");
	$click = escapeshellcmd(trim($click));
	$code = escapeshellcmd(trim($code));
	$name = escapeshellcmd(trim($_POST["name"]));
	$type = escapeshellcmd($_POST["type"]);
	$comment = escapeshellcmd(trim($_POST["comment"]));

	if($click=='edit')
	{
		$sql = " UPDATE   BaseReportGroup ";
		$sql.=" SET  report_group_name='".$name."', ";
		$sql.=" report_group_type='".$type."', ";
		$sql.=" report_group_comment='".$comment."' ";
		$sql.=" WHERE report_group_code='".$code."'  ";
	}
	
	connect();
	query($sql);
	close();

	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';
	print '<script>window.location.href = "base_report_group.php";</script>';
?>