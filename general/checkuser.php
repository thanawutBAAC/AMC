<? 	
	session_start(); //���¡�ѧ���� session_start() �����������ҹ session
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg">
<?
		if(!session_is_registered(username))
			{
			echo '<script>alert("��س���͡�Թ��͹����к�");window.location.href = "../index.php";</script>';
			}
			
		$Year=(date('Y')+543);
		
		if($amcstatus=="N")
				{ $login_user='�Թ�յ�͹�Ѻ<b> ʡ�.'.$amcname.'</b> | ';}
		if($amcstatus=="Y")
				{ $login_user="�Թ�յ�͹�Ѻ<b>�������к�</b> | ";}
				
				//echo $user_login;
		/*$username=$_SESSION['username']; 
		$password=$_SESSION['password']; 
		$amc=$_SESSION['amc'];
		$province=$_SESSION['province'];
		$amcname=$_SESSION['amcname'];
		session_register("amcstatus");

		
	//	echo $amcstatus;
	//	echo $username;

		//echo $amcstatus;
		//echo $Year;
	/*echo $amcstatus.'<br>';
		echo $username.'<br>';
		echo $password.'<br>';
		echo $amc.'<br>';
		echo $province.'<br>';
	/*	echo $username.'<br>';
		echo $password.'<br>';
		echo $amc.'<br>';
		echo $province.'<br>';
		echo $amcname;
		echo '��';
		
	/*	
							$sql="select * from AMC where AMCCode ='$username' AND AMCPassword = '$passw' ";// ��Ǩ�ͺ㹰ҹ������
							$exsql=mssql_query($sql);
							$data=mssql_fetch_array($exsql);
							$AMC=$data[2];
							//echo $sql;
							if(mssql_num_rows($exsql)=="0")// ��������
									{
										echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=welcome.php">';
									}
									
	*/
	//echo $username.'<br>';
	//echo $passw;
	
		/*		if($username=="" OR $password=="" OR $amcstatus="")
					{
										echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=welcome.php">';
					}	
					echo $amcstatus;
		*/							
?>
</body>
</html>
