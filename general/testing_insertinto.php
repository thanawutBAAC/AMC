<?  include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg">
<?
		include ("../lib/ms_database.php");
		$TestStart=$startyear.$startmonth.$startdate;
		$TestEnd=$endyear.$endmonth.$enddate;
		
		if($CustomerType=="1"){$local="committee.php";}
		if($CustomerType=="2"){$local="personnel.php";}
		
		$sql="INSERT INTO AMCTest (AMCCode,CustomerID,CustomerType,Positions,TestID,TestEduname,TestUnit,TestStart,TestEnd,TestTotalDay) ";
		$sql.=" VALUES ";
		$sql.=" ('$amc','$USER_ID','$CustomerType', '$PositionID','$education','$txt_eduname','$txt_unit','$TestStart','$TestEnd','$txt_datetotal' )";
		$exsql=mssql_query($sql);
		if($exsql==true)
			{
				echo '<script>alert(" บันทึกประวัติการฝึกอบรมเรียบร้อยแล้ว");window.location.href = "'.$local.'"</script>';
				exit();
			 }
?>
</body>
</html>
