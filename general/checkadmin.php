<body background="images/bg.jpg"><?
		session_start(); //���¡�ѧ���� session_start() �����������ҹ session
		$username=$_SESSION['username']; 
		$password=$_SESSION['password']; 
		$amc=$_SESSION['amc'];
		$province=$_SESSION['province'];
		$amcname=$_SESSION['amcname'];
		$status=$_SESSION['status'];
		
				if($username<>""&&$password<>"" && $status=="0")
					{
										echo '<script>alert("Administrator ������Է��㹡�úѹ��ء������");window.location.href = "rpt.php";</script>';
					}								
?>