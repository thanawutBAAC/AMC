<body background="images/bg.jpg"><?
		session_start(); //เรียกฟังก์ชั่น session_start() เพื่อเริ่มใช้งาน session
		$username=$_SESSION['username']; 
		$password=$_SESSION['password']; 
		$amc=$_SESSION['amc'];
		$province=$_SESSION['province'];
		$amcname=$_SESSION['amcname'];
		$status=$_SESSION['status'];
		
				if($username<>""&&$password<>"" && $status=="0")
					{
										echo '<script>alert("Administrator ไม่มีสิทธิในการบันทึุกข้อมูล");window.location.href = "rpt.php";</script>';
					}								
?>