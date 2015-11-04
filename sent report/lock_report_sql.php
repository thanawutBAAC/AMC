<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$sql= " SELECT Temp01.br_code, Temp01.userdetail, SentReportHeader.amccode  ";
	$sql.=" FROM SentReportHeader  ";
	$sql.=" LEFT JOIN (  ";
	$sql.="	SELECT amccode, br_code, userdetail  ";
	$sql.="	FROM userlogin  ";
	$sql.="  WHERE userlogin.status <> 'Y'  ";
	$sql.="  ) AS Temp01 ON Temp01.amccode = SentReportHeader.amccode  ";
	$sql.=" WHERE sent_month='".$month."' AND sent_year='".$year."'  ";
	$sql.=" ORDER BY Temp01.br_code, Temp01.userdetail  ";
	$result_update = query($sql);
	WHILE($fetch_update =  fetch_row($result_update))
	{
		 $ans_update = 	$_POST['1x'.trim($fetch_update[2])];
		 if(trim($ans_update)=='')
			{	$ans_update = '1';	  }
		$sql = " UPDATE  SentReportHeader SET sent_status='".$ans_update."'  ";
		$sql.=" WHERE amccode='".trim($fetch_update[2])."' AND sent_month='".$month."' AND sent_year='".$year."' ";
		query($sql);
	}

	close();
	print '<script>window.location.href = "lock_report.php";</script>';	
?>