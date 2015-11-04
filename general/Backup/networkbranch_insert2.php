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
					for($i=0;$i<=($row-1);$i++)
						{
							if($CAT_AA[$i] !="")
								{
										$sql="INSERT INTO NetworkBranch (ACMCode,CAT_CC,CAT_AA, BranchTypeBuy, BranchTypeSell,BranchTypeService, ";
										$sql.=" BranchValuesBuy, BranchValuesSell, BranchValuesService,BranchYear) VALUES ('$amc','$province','$CAT_AA',";
										$sql.=" '$typebuy[$i]','$typesell[$i]','$typeservice[$i]','$valuesbuy[$i]','$valuessell[$i]','$valuesservice[$i]','$year' )";
										//$exsql=mssql_query($sql);
										echo $sql.'<br>';
								}
				
						}
	?>
	
	</td>
  </tr>
</table>
</body>
</html>
