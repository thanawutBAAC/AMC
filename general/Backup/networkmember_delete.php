<? include ("checkuser.php");?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top">
	<?
				include ("images/lib/ms_database.php");
				$sql="DELETE FROM NetworkMemberGroup WHERE AMCCode='$AMCCode' AND  MemberID='$memberid' AND MemberYear='$memberyear' ";
				$sqldelete="DELETE FROM NetworkMemberDetail WHERE AMCCode='$AMCCode' AND  MemberID='$memberid'";
				mssql_query($sqldelete);
				mssql_query($sql);
				echo '<script>alert("ลบข้อมูลเรียบร้อยแล้ว");window.location.href = "networkmember.php";</script>';
	?>
	
	</td>
  </tr>
</table>
</body>
</html>
