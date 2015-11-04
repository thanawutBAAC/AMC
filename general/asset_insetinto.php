<?include ("checkuser.php"); ?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?
	include ("../lib/ms_database.php");
	$date=date("d/m/Y");
	$Year=(date('Y')+543);
	for($i=0;$i<=($row-1);$i++)
			{
		
				if($amccode[$i]!="" && $assetname[$i]=="0" && $assetcategory[$i]!="" ) //update ข้อมูลเดิม
					{
						$sql = "UPDATE AssetDetail SET Assetsize='$assetsize[$i]', AssetAmount='$assetamount[$i]', AssetValues='$assetvalues[$i]', Assetapplying='".$_POST['assetapplying'.$i]."', AssetRemark='$assetremark[$i]' ,Assettypeground='$assettypeground[$i]', AssetSize2='$assetsize_ngan[$i]' , AssetSize3='$assetsize_wa[$i]'";
						$sql.= " WHERE AMCCode='$amc' AND AssetType='$assettype[$i]' AND AssetCategory='$assetcategory[$i]'  ";
						mssql_query($sql);
						
						$sql2="UPDATE AssetYear SET AssetYear='$Year' ";
						$sql2.="WHERE AMCCode='$amc' AND AssetType='$assettype[$i]'";
						mssql_query($sql2);
						/*echo $_GET['assetapplying'.$i];
						echo $assetapplying[$i].'<br>';
						echo $sql.'<br>';
						*/
					}
	
				
				if($amccode[$i]=="" && $assetname[$i]=="0" && $assetcategory[$i]!="" ) //insert ข้อมูลเดิม
					{
							if($assetsize[$i]!="" || $assetsize_ngan[$i]!="" || $assetsize_wa[$i]!=""  || $assetamount[$i]!="" || $assetvalues[$i]!="" || $assetremark[$i]!="")
									{
											$sql="INSERT INTO AssetDetail  (AMCCode,AssetProvince, AssetType, AssetCategory, AssetSize,AssetSize2,AssetSize3, AssetAmount, AssetValues, AssetApplying, AssetRemark,AssetTypeGround) ";
											$sql.=" Values ('$amc','$province','$assettype[$i]', '$assetcategory[$i]', '$assetsize[$i]', '$assetsize_ngan[$i]', '$assetsize_wa[$i]', '$assetamount[$i]', '$assetvalues[$i]', '".$_GET['assetapplying'.$i]."', '$assetremark[$i]','$assettypeground[$i]') ";
											mssql_query($sql);
											
									//	echo $sql.'<br>';
											$sql2="UPDATE AssetYear SET AssetYear='$Year' ";
											$sql2.="WHERE AMCCode='$amc' AND AssetType='$assettype[$i]'";
											mssql_query($sql2);
										//	echo $sql2;
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
							$sql2="INSERT INTO AssetDetail  (AMCCode,AssetProvince, AssetType, AssetCategory, AssetSize, AssetAmount, AssetValues, AssetApplying, AssetRemark,AssetTypeGround) ";
							$sql2.=" Values ('$amc','$province','$assettype[$i]', '$plus', '$assetsize[$i]', '$assetamount[$i]', '$assetvalues[$i]', '".$_GET['assetapplying'.$i]."', '$assetremark[$i]','$assettypeground') ";
							mssql_query($sql);
							mssql_query($sql2);
						//	echo $slq2;

					
					}
				
					
			}
			
			

			if($asset=="ground")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_ground.php">';}
			if($asset=="buildings")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_buildings.php">';}
			if($asset=="vehicle")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_vehicle.php">';}
			if($asset=="office")
				{ echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=asset_office.php">';}

?>
</body>
</html>
