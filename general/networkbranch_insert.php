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
				include ("../lib/ms_database.php");
				$Year=(date('Y')+543);
			//s	if($)
					for($i=1;$i<=($row);$i++)
						{
							//echo $i.' = ';
							//echo  $_GET['new'.$i].'<br>';
							if($_GET['new'.$i]=="0")
								{
									/*	if($_GET['typebuy'.$i]=="0"){$valuesbuy.$i="";}
										if($_GET['typesell'.$i]=="0"){$valuessell.$i="";}
										if($_GET['typesevice'.$i]=="0"){$valuesservice.$i="";}
										
										$sql="UPDATE NetworkBranch SET BranchTypeBuy='".$_GET['typebuy'.$i]."', BranchTypeSell='".$_GET['typesell'.$i]."', ";
										$sql.=" BranchTypeService='".$_GET['typeservice'.$i]."' , BranchValuesBuy='".$_GET['valuesbuy'.$i]."',BranchValuesSell='".$_GET['valuessell'.$i]."', ";
										$sql.=" BranchValuesService='".$_GET['valuesservice'.$i]."'";	
										
										
										echo "$valuesbuy =".$valuesbuy.'<br>';
										echo "$valuessell".$valuessell.'<br>';
										echo "$valuesservice".$valuesservice.'<br>';
									*/
									if($_GET['typebuy'.$i]=="1")
									 {	if($_GET['valuesbuy'.$i]==""){$valuesbuy=0;} else { $valuesbuy=$_GET['valuesbuy'.$i]; } }
									else
										{	$valuesbuy=0; }									 
									 
									if($_GET['typesell'.$i]=="1")
										{	 if($_GET['valuessell'.$i]==""){$valuessell=0;} else { $valuessell=$_GET['valuessell'.$i];}	}
									else
										{	$valuessell=0; }
																				
									if($_GET['typeservice'.$i]=="1")
										{ if($_GET['valuesservice'.$i]==""){$valuesservice=0;} else { $valuesservice=$_GET['valuesservice'.$i];} }
									else
										{	$valuesservice=0; }
									
										$sql="UPDATE NetworkBranch SET BranchTypeBuy='".$_GET['typebuy'.$i]."', BranchTypeSell='".$_GET['typesell'.$i]."', ";
										$sql.=" BranchTypeService='".$_GET['typeservice'.$i]."' , BranchValuesBuy='$valuesbuy', BranchValuesSell='$valuessell', ";
										$sql.=" BranchValuesService='$valuesservice' ";
										$sql.=" WHERE AMCCode='$amc' AND CAT_CC='$province' AND CAT_AA='".$_GET['CAT_AA'.$i]."' AND BranchYear='$Year'";
										//echo $sql.'<br>';
										mssql_query($sql);
								}
						
							if($_GET['new'.$i]=="1"&&$_GET['CAT_AA'.$i]!="" AND $_GET['typebuy'.$i]!="" AND $_GET['typesell'.$i]!="" AND $_GET['typeservice'.$i]!="")
								{
										//'".$_GET['assetapplying'.$i]."'
										$sql="INSERT INTO NetworkBranch (AMCCode,CAT_CC,CAT_AA, BranchTypeBuy, BranchTypeSell,BranchTypeService, ";
										$sql.=" BranchValuesBuy, BranchValuesSell, BranchValuesService,BranchYear) VALUES ('$amc','$province','".$_GET['CAT_AA'.$i]."',";
										$sql.=" '".$_GET['typebuy'.$i]."','".$_GET['typesell'.$i]."','".$_GET['typeservice'.$i]."','".$_GET['valuesbuy'.$i]."','".$_GET['valuessell'.$i]."','".$_GET['valuesservice'.$i]."','$Year' )";
										//$exsql=mssql_query($sql);
										mssql_query($sql);
									//	echo $sql.'<br>';
								}
						}
						print '<script>alert(" บันทึกข้อมูลเรียบร้อยแล้ว ");window.location.href = "networkbranch.php";</script>';

				//echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=networkbranch.php">';
	?>
	</td>
  </tr>
</table>
</body>
</html>
