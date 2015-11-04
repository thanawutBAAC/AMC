<? include ("checkuser.php");

//echo ("Yeah !!!")

//try {
	include("images/lib/ms_database.php");
		$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where AMCCode = '$amc' ";

		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
		if(mssql_num_rows($result)=="0"){
			$flag = "NEW"; 
			echo " ยังไม่มีข้อมูล !!!";
		}else{
			$flag = "EDIT";
	}
		$rs = mssql_fetch_assoc($result);

//	$flag=$_POST["flag"];
//	echo "flag=".$flag;

	//AMC
	$AMCCode=$_POST["amccode"];
	$AMCName=$_POST["AMCName"];
	$AMCAddress=$_POST["amcaddress"];
	$AMCTel=$_POST["amctel"];
	$AMCFax=$_POST["amcfax"];
	$AMCWan=$_POST["amcwan"];
	$AMCNet=$_POST["AMCNet"];
	$AMCRegisDate=$_POST["AMCRegisDate"];
	$AMCPosition_1=$_POST["AMCPosition_1"];
	$AMCPosition_1_Name=$_POST["AMCPosition_1_Name"];
	$AMCPosition_1_Tel=$_POST["AMCPosition_1_Tel"];
	$AMCPosition_2=$_POST["AMCPosition_2"];
	$AMCPosition_2_Name=$_POST["AMCPosition_2_Name"];
	$AMCPosition_2_Tel=$_POST["AMCPosition_2_Tel"];
	$AMCNetRemark=$_POST["AMCNetRemark"];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: ระบบฐานข้อมูล สกต. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>

<?	if ($flag=="EDIT") { 
		$query =  " UPDATE AMC ";
		$query.="   SET  AMCAddress = '$AMCAddress',  ";
//		$query.="    AMCCode = '$amccode',  "; 
		$query.="    AMCTel = '$AMCTel',  ";
		$query.="    AMCFax = '$AMCFax',  ";
		$query.="    AMCWan = '$AMCWan',  ";
		$query.="    AMCNet = '$AMCNET', ";    // **ชื่อตัวเล็ก/ใหญ ่มีผล
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

//		$result = 'COMMIT';
		$result = mssql_query($query);

		//	echo $query;
//			echo "AMCNET  IS ==>>";
	//		echo " $AMCNET";   

	}



?>

			<script language="javascript">
						alert("บันทึกข้อมูลเรียบร้อยแล้ว     ");
						window.location='amc_general.php';
			</script>

<?
		if ($flag=="NEW") { 
				$query = " insert into AMC ";
				$query.= "(AMCCode, AMCProvince, AMCAddress, AMCTel, AMCFax, AMCWan, AMCNet, ";
				$query.= "AMCRegisDate, AMCUpdate, AMCPosition_1, AMCPosition_1_Name, AMCPosition_1_Tel, ";
				$query.= "AMCPosition_2, AMCPosition_2_Name, AMCPosition_2_Tel) ";
				$query.= "values('$amccode', '$lis_province', '$AMCAddress','$AMCTel','$AMCFax','$AMCWan','$AMCNET','$AMCRegisDate',  ";
				$query.= " getdate(),'$AMCPosition_1','$AMCPosition_1_Name', ";
				$query.= " '$AMCPosition_1_Tel','$AMCPosition_2','$AMCPosition_2_Name', ";
				$query.= " '$AMCPosition_2_Tel'); ";
				echo $query;
				$result = mssql_query($query);

					//	if(mssql_num_rows($result)=="1"){
					//		echo ;
					//	}else{
					//		$flag = "NEW";
					//	}

				$query = " insert into userlogin ";
				$query.= "(username, password, amccode, amcprovine, userdetail, br_code, ";
				$query.= "br_name, status) ";
				$query.= "values('$username', '$password', '$amccode','$amcprovine','$userdetail','$br_code','$br_name','N')  ";
				echo $query;
				$result = mssql_query($query);



//				$query =  " UPDATE userlogin ";
//				$query.="   SET amccode = '$amccode'  ";
//				$query.= " Where username = '$username' ";
//				$query.= " AND password = '$password' ";
//				$query.= " AND amcprovince = '$province' ";
//				//echo $query;
//				$result = mssql_query($query);
	}

?>

			<script language="javascript">
						alert("แก้ไขข้อมูลเรียบร้อยแล้ว     ");
						window.location='amc_general.php';
			</script>

</body>
</html>

