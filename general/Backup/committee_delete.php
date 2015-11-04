<? include ("checkuser.php");?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
		include ("images/lib/ms_database.php");
		//$Delete_CommitDetail="DELETE FROM  CommitteeDetail Where CommitteeID='$user_id' AND AMCCode='$amc'";
		$Delete_CommitGroup="DELETE FROM CommitteeGroup Where CommitteeID='$user_id' AND AMCCode='$amc' AND CommitteeGroup='$committeegroup'";
		//mssql_query($Delete_CommitDetail);
		//echo $Delete_CommitGroup;
		mssql_query($Delete_CommitGroup);
		echo '<script>alert(" ลบข้อมูลบุคลากรรหัสปรชาชน '.$user_id.' เรียบร้อยแล้ว");</script>';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=committee.php?SendYear='.$committeegroup.'">';

?>
</body>
</html>
