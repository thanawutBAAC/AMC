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
				$sql="DELETE FROM NetworkBranch WHERE AMCCode='$AMCCode' AND CAT_CC='$CAT_CC' AND CAT_AA='$CAT_AA' AND BranchYear='$year' ";
				mssql_query($sql);
				//echo $sql;
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=networkbranch.php">';
	?>
	
	</td>
  </tr>
</table>
</body>
</html>
