<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body background="images/bg.jpg">
<?
				include ("images/lib/ms_database.php");
				$sql="DELETE FROM PersonnelGroup WHERE AMCCode='$AMCCode' AND PersonnelID = '$user_id' AND PersonnelYear='$PersonnelYear'";
				mssql_query($sql);
				//echo $sql;
				
				// ลบ Table networkmember
			//	$sql2=" DELETE FROM NetworkMember WHERE AMCCode='$AMCCode' AND User_ID='$user_id'";
			//	mssql_query($sql2);
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel.php">';
?>
</body>
</html>
