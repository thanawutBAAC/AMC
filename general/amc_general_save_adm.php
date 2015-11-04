<? 

 include ("checkuser.php");
 session_start();
 //echo "flag1=".$flag;
//try {
	include("../lib/ms_database.php");
	//	$sql =  " Select * ";
	//	$sql.= " From AMC ";
	//	$sql.= " Where AMCCode = '$amc' ";
/*						$sql=" SELECT * ";
						$sql.=" FROM AMC A ";
						$sql.=" LEFT OUTER JOIN ";
						$sql.=" (SELECT * ";
						$sql.=" FROM USERLOGIN)AS B ON A.AMCProvince = B.amcprovince ";
					//	$sql.=" WHERE A.AMCProvince <>'' AND A.AMCCode <>''  ";

						if($amcstatus=="Y")
							{
									if($div <> '')
										{  
										$sql.=" WHERE A.AMCProvince <>'' AND A.AMCCode <>''  ";
										$sql.=" AND B.br_code='$div' "; 
										$sql.=" AND A.AMCProvince ='$lis_province' " ;
										}
							//		if($lis_province <> '')
							//			{  $sql.=" AND A.AMCProvince ='$lis_province' " ; } 


							$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
							
							if(mssql_num_rows($result)=="0")
									{
										$flag = "NEW"; 
									}
								else
									{
										$flag = "EDIT";
									}	
							}	
							else
							{
							$sql.=" WHERE A.AMCProvince <>'' AND A.AMCCode <>''  ";
							$sql.= " AND A.AMCCode = '$amc' ";

							$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
							
										if(mssql_num_rows($result)=="0")
												{
													echo "ยังไม่มีข้อมูล !!!"; 
												}
											else
												{
													$flag = "EDIT";
												}	
							}

		$rs = mssql_fetch_assoc($result);

//	$flag=$_POST["flag"];*/
//echo "flag=".$flag;
//echo $flag;
//echo  $username;
//echo  $div;
echo  $lis_province;
//echo  $province;
//echo  $amc;

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

<?

	if ($flag=="EDIT") 
		{ 
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
					//$query.= "  Where AMCCode = '$amc' ";
					//$query.= "  AND AMCProvince = '$province' ";  
			
									if($amcstatus=="Y")
										{
											//	$query.= "  WHERE AMCProvince <>'' AND AMCCode <>''  ";
											//	$query.= "  AND AMCCode = '$AMCCode' ";
												$query.= "  WHERE AMCProvince = '$list_province' ";
												mssql_query($query);
												echo $query;
												echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");window.location.href = "amc_general.php?lis_province='.$list_province.'&div='.$div2.'";</script>';
										}	
							
									else
										{
												$query.= "  Where AMCCode = '$amc' ";
												$query.= "  AND AMCProvince = '$province' ";
												echo $query;
												echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");window.location.href = "amc_general.php";</script>';
										}
		//	echo $list_province;
			//		$result = 'COMMIT';
				//	$result = mssql_query($query);
			
				//	echo $query;
		//			echo  $lis_province;
			//			echo "AMCNET  IS ==>>";
				//		echo " $AMCNET";   

}

?>
<?
		if ($flag=="NEW") { 
				$query = " insert into AMC ";
				$query.= "(AMCCode, AMCProvince, AMCAddress, AMCTel, AMCFax, AMCWan, AMCNet, ";
				$query.= "AMCRegisDate, AMCUpdate, AMCPosition_1, AMCPosition_1_Name, AMCPosition_1_Tel, ";
				$query.= "AMCPosition_2, AMCPosition_2_Name, AMCPosition_2_Tel) ";
				$query.= "values('$AMCCode', '$lis_province', '$AMCAddress','$AMCTel','$AMCFax','$AMCWan','$AMCNET','$AMCRegisDate',  ";
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


	/*	$query =  " UPDATE userlogin ";
				$query.="   SET amccode = '$amccode'  ";
				$query.= " Where username = '$username' ";
				$query.= " AND password = '$password' ";
				$query.= " AND amcprovince = '$province' ";
				echo $query;
				echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");window.location.href = "amc_general.php";</script>';*/

	/*			$query =  " UPDATE userlogin ";
				$query.="   SET amccode = '$amccode'  ";
				$query.= " Where amcprovince = '$province' ";
				//$query.= " AND password = '$password' ";
			//	$query.= " AND amcprovince = '$province' ";
				echo $query;
				echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");window.location.href = "amc_general.php";</script>';*/
				
		//		$result = mssql_query($query);
				}

				if ($flag=="DEL") { 

					//	echo '<script>alert("ท่านต้องการลบข้อมูลของ สกต. หรือไม่");window.location.href = "amc_general.php?lis_province='.$list_province.'&div='.$div2.'";</script>';

						$query =  "DELETE  AMC ";
						$query.= "  WHERE AMCProvince = '$list_province' ";
						mssql_query($query);

						echo '<script>alert("ลบข้อมูลเรียบร้อยแล้ว");window.location.href = "amc_general.php?lis_province='.$list_province.'&div='.$div2.'";</script>';

					echo $query;
				//		$result = mssql_query($query);

				}

?>
</body>
</html>

