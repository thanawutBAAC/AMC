<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$sql = " SELECT sent_year, sent_month, sent_date, sent_time, sent_status ";
	$sql.=" FROM SentReportHeader ";
	$sql.=" WHERE amccode='".$temp_amccode."' ";
	$sql.=" ORDER BY sent_year, sent_month DESC ";
	$result_update = query($sql);
	$i=0;
	WHILE($fetch_update =  fetch_row($result_update))
	{
		 $i++;
		 $ans_update = 	$_POST['i'.$i];
		 if(trim($ans_update)=='')
			{	$ans_update = '1';	  }
		$sql = " UPDATE  SentReportHeader SET sent_status='".$ans_update."'  ";
		$sql.=" WHERE amccode='".trim($temp_amccode)."' AND sent_month='".trim($fetch_update[1])."' AND sent_year='".trim($fetch_update[0])."' ";
		query($sql);
	}

	close();
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง '.$i.' รายการ ");</script>';
	print '<script>window.location.href = "lock_report.php";</script>';	
?>