<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg">
<?
		include ("../lib/ms_database.php");
		$sql="DELETE FROM  ASSETCODE WHERE ASSETTYPE='$assettype' AND ASSETCATEGORY='$assetcategory'";
		mssql_query($sql);
		$sql2="DELETE FROM ASSETDETAIL WHERE ASSETTYPE='$assettype' AND ASSETCATEGORY='$assetcategory'";
		mssql_query($sql2);
		
		
				if($assettype=='01')
						{
						echo '<script>alert("ลบข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_ground_admin.php";</script>';
						}
				if($assettype=='02')
						{
						echo '<script>alert("ลบข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_buildings_admin.php";</script>';
						}
				if($assettype=='03')
						{
						echo '<script>alert("ลบข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_vehicle_admin.php";</script>';
						}
				if($assettype=='04')
						{
						echo '<script>alert("ลบข้อมูลทรัพย์สินเรียบร้อยแล้ว");window.location.href = "asset_office_admin.php";</script>';
						}

?>
</body>
</html>
