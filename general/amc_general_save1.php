<? include ("checkuser.php");
	include("../lib/ms_database.php");

	$flag=$_POST["flag"];
//	echo "flag=".$flag;

	//AMC
	$AMCCode=$_POST["amccode"];
	$AMCName=$_POST["AMCName"];
	$AMCAddress=$_POST["amcaddress"];
	$AMCTel=$_POST["amctel"];
	$AMCFax=$_POST["amcfax"];
	$AMCWan=$_POST["amcwan"];
	$AMCRegisDate=$_POST["AMCRegisDate"];
	$AMCPosition_1=$_POST["AMCPosition_1"];
	$AMCPosition_1_Name=$_POST["AMCPosition_1_Name"];
	$AMCPosition_1_Tel=$_POST["AMCPosition_1_Tel"];
	$AMCPosition_2=$_POST["AMCPosition_2"];
	$AMCPosition_2_Name=$_POST["AMCPosition_2_Name"];
	$AMCPosition_2_Tel=$_POST["AMCPosition_2_Tel"];
	$AMCNet=$_POST["AMCNet"];
	$AMCNetRemark=$_POST["AMCNetRemark"];

	//userlogin
	//$username=$_POST["username"];
//	$password=$_POST["password"];
//	$amccode=$_POST["amccode"];
//	$amcprovince=$_POST["amcprovince"];
//	$userdetail=$_POST["userdetail"];

	if ($flag=="EDIT") { 
	/*	$query =  " UPDATE AMC ";
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
		$query.= " Where AMCCode = ' ".$amc." ' "; */

		$query =  " UPDATE AMC ";
		$query.="   SET  AMCAddress = '$AMCAddress',  ";
//		$query.="    AMCCode = '$amccode',  "; 
		$query.="    AMCTel = '$AMCTel',  ";
		$query.="    AMCFax = '$AMCFax',  ";
		$query.="    AMCWan = '$AMCWan',  ";
		$query.="    AMCRegisDate = '$AMCRegisDate',  ";
		$query.="    AMCUpdate =  getdate(),  ";
		$query.="    AMCPosition_1 = '$AMCPosition_1',  ";
		$query.="    AMCPosition_1_Name = '$AMCPosition_1_Name',  ";
		$query.="    AMCPosition_1_Tel = '$AMCPosition_1_Tel',  ";
		$query.="    AMCPosition_2 = '$AMCPosition_2',  ";
		$query.="    AMCPosition_2_Name = '$AMCPosition_2_Name',  ";
		$query.="    AMCPosition_2_Tel = '$AMCPosition_2_Tel'  ";
		$query.= "  Where AMCCode = '$amc' ";
		$query.= "  AND AMCProvince = '$province' ";
		//echo $query;

	
	//	$result_query = mssql_query($query,$ms_connect) or die('Query failed: ' . mssql_error());
		$result = mssql_query($query);
//		$result = @mysql_query($query, $connect) or die(',Query failed: ' . mysql_error());
	echo ("แก้ไขข้อมูลเรียบร้อยแล้ว ");

/*		$query =  " UPDATE userlogin ";
		$query.="   SET amccode = '$amccode'  ";
		$query.= " Where username = '$username' ";
		$query.= " AND password = '$password' ";
		$query.= " AND amcprovince = '$province' ";
		echo $query;
		$result = mssql_query($query);
*/
	}

 else {
		$query = " insert into AMC ";
		$query.= "(AMCCode, AMCProvince, AMCAddress, AMCTel, AMCFax, AMCWan, ";
		$query.= "AMCRegisDate, AMCUpdate, AMCPosition_1, AMCPosition_1_Name, AMCPosition_1_Tel, ";
		$query.= "AMCPosition_2, AMCPosition_2_Name, AMCPosition_2_Tel) ";
		$query.= "values('$amccode', '$province', '$AMCAddress','$AMCTel','$AMCFax','$AMCWan','$AMCRegisDate',  ";
		$query.= " getdate(),'$AMCPosition_1','$AMCPosition_1_Name', ";
		$query.= " '$AMCPosition_1_Tel','$AMCPosition_2','$AMCPosition_2_Name', ";
		$query.= " '$AMCPosition_2_Tel'); ";
//		echo $query;

	//	$result_query = mssql_query($query,$ms_connect) or die('Query failed: ' . mssql_error());
		$result = mssql_query($query);
	//	echo ("บันทึกข้อมูลเรียบร้อยแล้ว  ");


	//	$query = " insert into userlogin ";
	//	$query.= " (username, password, amccode, amcprovince, userdetail  ) ";
	//	$query.= " values('$username', '$password', '$amccode','$province', '$amcname'); ";
	//	echo $query;
	//	$result = mssql_query($query);

		$query =  " UPDATE userlogin ";
		$query.="   SET amccode = '$amccode'  ";
		$query.= " Where username = '$username' ";
		$query.= " AND password = '$password' ";
		$query.= " AND amcprovince = '$province' ";
		//echo $query;

	//	echo " เพิ่มข้อมูลเรียบร้อยแล้ว ";
		$result = mssql_query($query);
		echo ("บันทึกข้อมูลเรียบร้อยแล้ว  ");



	}


?>
