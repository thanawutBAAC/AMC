<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body background="images/bg.jpg">
<?
				include ("../lib/ms_database.php");
				$sql="DELETE FROM AMCTest WHERE AMCCode='$AMCCode' AND CustomerId = '$USER_ID' AND TestEduName='$TestEduName' AND TestStart='$TestStart' AND TestID='$TestID'";
				$exslq=mssql_query($sql);
					echo '<script>alert(" ź���������¹��������");window.location.href = "testing_people.php?USER_ID='.$USER_ID.'&name='.$name.'&lastname='.$lastname.'&positions='.$positions.'&type='.$type.'"</script>';
					exit();
?>
</body>
</html>
