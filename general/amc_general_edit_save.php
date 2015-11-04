<? include ("checkuser.php");
//try {
        include("../lib/ms_database.php");

     echo ("Wellcome!!!    ");

/*	$flag=$_POST["flag"]; */

	//AMC
	$AMCCode=$_POST["AMCCode"];
	$AMCProvince=$_POST["AMCProvince"];
//$AMCName=$_POST["AMCName"];
	$AMCAddress=$_POST["AMCAddress"];
	$AMCTel=$_POST["AMCTel"];
	$AMCFax=$_POST["AMCFax"];
	$AMCWan=$_POST["AMCWan"];
	$AMCNet=$_POST["AMCNet"];
	$AMCRegisDate=$_POST["AMCRegisDate"];
	$AMCUpdate=$_POST["AMCUpdate"];
	$AMCPosition_1=$_POST["AMCPosition_1"];
	$AMCPosition_1_Name=$_POST["AMCPosition_1_Name"];
	$AMCPosition_1_Tel=$_POST["AMCPosition_1_Tel"];
	$AMCPosition_2=$_POST["AMCPosition_2"];
	$AMCPosition_2_Name=$_POST["AMCPosition_2_Name"];
	$AMCPosition_2_Tel=$_POST["AMCPosition_2_Tel"];
	$AMCNet=$_POST["AMCNet"];
	$AMCNetRemark=$_POST["AMCNetRemark"];

	/*
	//userlogin
	//$username=$_POST["username"];
//	$password=$_POST["password"];
	$amccode=$_POST["amccode"];
//	$amcprovince=$_POST["amcprovince"];
//	$userdetail=$_POST["userdetail"];

//	if ($flag=="EDIT") { 
		$query =  " UPDATE AMC ";
		$query.="  SET AMCProvince = ' ".$AMCProvince." ',  "; 
		$query.="     AMCName = ' ".$AMCName." ',  ";
		$query.="    AMCAddress = ' ".$AMCAddress." ',  ";
		$query.="    AMCTel = ' ".$AMCTel." ',  ";
		$query.="    AMCFax = ' ".$AMCFax." ',  ";
		$query.="    AMCWan = ' ".$AMCWan." ',  ";
		$query.="    AMCRegisDate = ' ".$AMCRegisDate." ',  ";
		$query.="    AMCUpdate =  CURRENT_TIMESTAMP(),  ";
		$query.="    AMCPosition_1 = ' ".$AMCPosition_1." ',  ";
		$query.="    AMCPosition_1_Name = ' ".$AMCPosition_1_Name." ',  ";
		$query.="    AMCPosition_1_Tel = ' ".$AMCPosition_1_Tel." ',  ";
		$query.="    AMCPosition_2 = ' ".$AMCPosition_2." ',  ";
		$query.="    AMCPosition_2_Name = ' ".$AMCPosition_2_Name." ',  ";
		$query.="    AMCPosition_2_Tel = ' ".$AMCPosition_2_Tel." '  ";
		$query.= " Where AMCCode = ' ".$amc." ' ";

		mssql_query($query);

//	$result_query = @mysql_query($query, $connect) or die('Query failed: ' . mysql_error());

	$result_query = mssql_query($ms_connect, $query) or die ("Query failed: ");

	//	$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
//		$rs = mssql_fetch_assoc($result);

//	}
*/
	





	$sql =  " UPDATE AMC ";
	//	$query.="  SET AMCProvince = '$AMCProvince ',  "; 
		$sql.="    SET   AMCName = '$AMCName',  ";
		$sql.="    AMCAddress = '$AMCAddress',  ";
		$sql.="    AMCTel = '$AMCTel',  ";
		$sql.="    AMCFax = '$AMCFax',  ";
		$sql.="    AMCWan = '$AMCWan',  ";
	//	$query.="    AMCRegisDate = '$AMCRegisDate',  ";
		$sql.="    AMCUpdate =  CURRENT_TIMESTAMP(),  ";
		$sql.="    AMCPosition_1 = '$AMCPosition_1',  ";
		$sql.="    AMCPosition_1_Name = '$AMCPosition_1_Name',  ";
		$sql.="    AMCPosition_1_Tel = '$AMCPosition_1_Tel',  ";
		$sql.="    AMCPosition_2 = '$AMCPosition_2',  ";
		$sql.="    AMCPosition_2_Name = '$AMCPosition_2_Name',  ";
		$sql.="    AMCPosition_2_Tel = '$AMCPosition_2_Tel'  ";
		$sql.= " Where AMCCode = '$amc' ";


//	$result_query = @mysql_query($query, $connect) or die('Query failed: ' . mysql_error());
//	$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
//		mssql_query($sql);
//		$ms_results= mssql_query($sql,$ms_connect);

		$ms_results = mssql_query(sql) or die ("มีข้อผิดพลาดในการจัดการข้อมูล");
		mssql_close($ms_connect);

?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>

</body>
</html>