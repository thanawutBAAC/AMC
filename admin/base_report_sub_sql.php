<?php session_start();
	include("../check_login.php");
	include("../lib/database.php");
	$click = escapeshellcmd(trim($click));
	$code = escapeshellcmd(trim($code));
	$name = escapeshellcmd(trim($_POST["name"]));
	$unit = escapeshellcmd(trim($_POST["unit"]));
	$type = escapeshellcmd($_POST["type"]);
	$group = trim($group);
	$comment = escapeshellcmd($_POST["comment"]);
	connect();

	if($click=='add')
	{	$sql = " INSERT INTO BaseReportDetail ";
		$sql.= " (report_group_code, report_detail_code, report_detail_name, report_detail_unit) ";
		$sql.= " VALUES ('".$group."','".$code."','".$name."','".$unit."') ";
		echo $sql;
	}
	elseif($click=='edit')
	{	$sql = " UPDATE  BaseReportDetail SET report_detail_name='".$name."' ,report_detail_unit='".$unit."' ";
		$sql.= " WHERE report_group_code='".$group."' AND ";
		$sql.= " report_detail_code='".$code."' ";
	}
	else
	{	// ตรวจสอบข้อมูลก่อนลบ
		$sql = " SELECT  report_detail_code FROM ReportGroup".trim($group)." ";
		$sql.=" WHERE report_detail_code='".$code."' ";
		echo $sql;
		if(num_rows(query($sql))>=1)
		{
			print '<script>alert(" ไม่สามารถลบข้อมูลรหัส '.$code.' ได้ เนื่องจากได้นำไปใช้แล้ว ");</script>';
			print '<script>window.history.back();</script>';
		}
		$sql = " DELETE FROM BaseReportDetail WHERE ";
		$sql.=" report_group_code='".$group."' AND report_detail_code='".$code."' ";
	}
	
	query($sql);
	close();

	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';
	print '<script>window.location.href = "base_report_sub.php";</script>';
?>