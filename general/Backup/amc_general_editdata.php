<?  include ("checkuser.php");?>
<html>
<head>
<title>AMC</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
		include ("images/lib/ms_database.php");
		$a=date('d-m');
		$b=(date('Y')+543);
		$day=$a.'-'.$b;
		//echo $day;
		
		$sql="UPDATE AMC SET  AMCRegisDate='$txt_amcregisdate', AMCAddress='$area_amcaddress', AMCTel='$txt_amcphone', AMCWan='$txt_amcwan', AMCFax='$txt_amcfax' ,";
		$sql.=" AMCNet='$rad_amcnet', AMCPosition_1_Name='$txt_amcposition_1_name', AMCPosition_1='$txt_amcposition_1', AMCPosition_1_Tel='$txt_amcposition_1_phone' ,";
		$sql.=" AMCPosition_2_Name='$txt_amcposition_2_name', AMCPosition_2='$txt_amcposition_2', AMCPosition_2_Tel='$txt_amcposition_2_phone' ,AMCRemark='$area_amcremark' ,AMCUpdate='$day' ";
		$sql.=" WHERE AMCCode='$amc' ";
		//echo $sql.'<br><br><br>';
		$exsql=mssql_query($sql);
		echo '<script>window.location.href = "amc_general_edit.php?save=yes";</script>'; 

?>
</body>
</body>
</html>
