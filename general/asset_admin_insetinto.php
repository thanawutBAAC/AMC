<? include ("checkuser.php"); ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?
	include ("images/lib/ms_database.php");
	$date=date("d/m/Y");
	$Year=(date('Y')+543);
	$Cktop="SELECT TOP 1 * FROM AssetCode WHERE AssetType='$assettype' Order By AssetCategory DESC";
	//echo $Cktop;
	$exCktop=mssql_query($Cktop);
	$data=mssql_fetch_row($exCktop);
	$datacategory=$data[1];
	//echo $datacategory;
	//$dataadd=$datacategory+01;
	$a=$datacategory+1;
	if(($a+1) <=10){ $plus="0".$a;}
	else{$plus=$a;}
	if($assetname!="")
	{
	
	$Ckname="SELECT * FROM AssetCode WHERE  Assetname='$assetname' AND AssetType='$assettype'";
	//echo $Ckname;
	$exCkname=mssql_query($Ckname);
	$numCkname=mssql_num_rows($exCkname);
			if($numCkname=="0")
					{
							$insertcode="INSERT INTO AssetCode(AssetType,AssetCategory,AssetName,AMCaddDate) ";
							$insertcode.=" VALUES ('$assettype','$plus','$assetname','$date')";
							//echo $insertcode;
							mssql_query($insertcode);
						
					if($assettype=='01')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_ground_admin.php";</script>';
							}
					if($assettype=='02')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_buildings_admin.php";</script>';
							}
					if($assettype=='03')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_vehicle_admin.php";</script>';
							}
					if($assettype=='04')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_office_admin.php";</script>';
							}
							//echo $insertcode;
					}
			else
					if($assettype=='01')
						{
							echo '<script>alert("ไม่สามารถบันทึกข้อมูลทรัพย์สินได้เนื่องจากชื่อทรัพย์สินมีอยู่แล้ว");window.location.href = "asset_ground_admin.php";</script>';
						}
					if($assettype=='02')
						{
							echo '<script>alert("ไม่สามารถบันทึกข้อมูลทรัพย์สินได้เนื่องจากชื่อทรัพย์สินมีอยู่แล้ว");window.location.href = "asset_buildings_admin.php";</script>';
						}
					if($assettype=='03')
						{
							echo '<script>alert("ไม่สามารถบันทึกข้อมูลทรัพย์สินได้เนื่องจากชื่อทรัพย์สินมีอยู่แล้ว");window.location.href = "asset_vehicle_admin.php";</script>';
						}
					if($assettype=='04')
						{
							echo '<script>alert("ไม่สามารถบันทึกข้อมูลทรัพย์สินได้เนื่องจากชื่อทรัพย์สินมีอยู่แล้ว");window.location.href = "asset_office_admin.php";</script>';
						}
						
		}
		
		else
		{
							if($assettype=='01')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_ground_admin.php";</script>';
							}
					if($assettype=='02')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_buildings_admin.php";</script>';
							}
					if($assettype=='03')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_vehicle_admin.php";</script>';
							}
					if($assettype=='04')
							{
							echo '<script>alert("บันทึกข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_office_admin.php";</script>';
							}

		
		}	
	
	
	/*for($i=0;$i<=($row-1);$i++)
			{
		
				if($amccode[$i]!="" && $assetname[$i]=="0" && $assetcategory[$i]!="" ) //update ข้อมูลเดิม
					{
						$sql = "UPDATE AssetDetail SET Assetsize='$assetsize[$i]', AssetAmount='$assetamount[$i]', AssetValues='$assetvalues[$i]', Assetapplying='".$_GET['assetapplying'.$i]."', AssetRemark='$assetremark[$i]'";
						$sql.= " WHERE AMCCode='$amc' AND AssetType='$assettype[$i]' AND AssetCategory='$assetcategory[$i]' ";
						mssql_query($sql);
						
						$sql2="UPDATE AssetYear SET AssetYear='$Year' ";
						$sql2.="WHERE AMCCode='$amc' AND AssetType='$assettype[$i]'";
						mssql_query($sql2);
//						echo $sql.'<br>';
					}
	
				
				if($amccode[$i]=="" && $assetname[$i]=="0" && $assetcategory[$i]!="" ) //update ข้อมูลเดิม
					{
							if($assetsize[$i]!="" || $assetamount[$i]!="" || $assetvalues[$i]!="" || $assetremark[$i]!="")
									{
											$sql="INSERT INTO AssetDetail  (AMCCode,AssetProvince, AssetType, AssetCategory, AssetSize, AssetAmount, AssetValues, AssetApplying, AssetRemark) ";
											$sql.=" Values ('$amc','$province','$assettype[$i]', '$assetcategory[$i]', '$assetsize[$i]', '$assetamount[$i]', '$assetvalues[$i]', '".$_GET['assetapplying'.$i]."', '$assetremark[$i]') ";
											//$sql.=" WHERE AssetType='$assettype[$i]' AND AssetCategory='$assetcategory[$i]' ";
											//$sql.="WHERE $amccode[$i]!=''";
											mssql_query($sql);
//										echo $sql.'<br>';
											$sql2="UPDATE AssetYear SET AssetYear='$Year' ";
											$sql2.="WHERE AMCCode='$amc' AND AssetType='$assettype[$i]'";
											mssql_query($sql2);
//											echo $sql2;
								}

					}
					
				
					
				if($amccode[$i]=="" && $assetname[$i]!="" && $assetcategory[$i]=="" && $assetname[$i]!="0") // insert ข้อมูลใหม่
					{
						$max="SELECT MAX(AssetCategory) ";
						$max.=" FROM AssetCode ";
						$max.="WHERE AssetType='$assettype[$i]'";
						$maxEx=mssql_query($max);
						$data=mssql_fetch_array($maxEx);
						$maxrow=$data[0]; // ตำแหน่งสูงสุด
						$a=$maxrow+1;
							if(($a+1) <=9){ $plus="0".$a;}
							else{$plus=$a;}
					
							$sql="INSERT INTO AssetCode   (AssetType,AssetCategory,AssetName,AMCAdd,AMCAddDate) Values ('$assettype[$i]','$plus','$assetname[$i]','$amc','$date')";
							$sql2="INSERT INTO AssetDetail  (AMCCode,AssetProvince, AssetType, AssetCategory, AssetSize, AssetAmount, AssetValues, AssetApplying, AssetRemark) ";
							$sql2.=" Values ('$amc','$province','$assettype[$i]', '$plus', '$assetsize[$i]', '$assetamount[$i]', '$assetvalues[$i]', '".$_GET['assetapplying'.$i]."', '$assetremark[$i]') ";
							//$sql3="INSET INTO AssetYear  (AMCCode,AssetType,AssetYear) Values ('$1111', '$plus','$Year')";
							mssql_query($sql);
							mssql_query($sql2);
							
//							echo $sql.'<br>';
//							echo $sql2;
					
					}
				
					
			}
			
			
//			echo "de";
			if($asset=="ground")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_ground.php">';}
			if($asset=="buildings")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_buildings.php">';}
			if($asset=="vehicle")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_vehicle.php">';}
			if($asset=="office")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_office.php">';}
*/
?>
</body>
</html>
