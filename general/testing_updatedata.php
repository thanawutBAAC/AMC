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
		if($CustomerType=="2"){$local="personel.php";}
		
		$sql="UPDATE AMCTest SET TestID='$education', TestEduName='$txt_eduname', TestUnit='$txt_unit', TestStart='$TestStart', TestEnd='$TestEnd', TestTotalDay='$txt_datetotal' ";
		$sql.=" WHERE CustomerID='$txt_user_id' AND TestEduName='$edutest' AND TestStart='$start'";
		$exsql=mssql_query($sql);
	//	echo $sql;
		if($exsql==true)
			{
			echo '<script>alert(" ลบข้อมูลเรียนร้อยแล้ว");window.location.href = "testing_people.php?USER_ID='.$USER_ID.'&name='.$txt_name.'&lastname='.$txt_lsname.'&positions='.$txt_user_position.'&type='.$type.'"</script>';
				exit();
			 }
?>
</body>
</html>
