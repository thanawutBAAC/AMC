<? 
include ("checkuser.php");
?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
		include ("images/lib/ms_database.php");
		$sql="DELETE  FROM AMC WHERE AMCCode='$amccode'";
		//echo $sql;
		$exsql=mssql_query($sql);

	echo '<script>window.location.href = "amc_general_admin.php?search=find&delete=yes&div='.$div.'";</script>'; 

		
		
?>
</body>
</html>