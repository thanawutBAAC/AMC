<? 
session_start();//เรียกฟังก์ชั่น session_start() เพื่อเริ่มใช้งาน session
		if(session_is_registered(username))
			{
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=main.php">';
			}
?>
<html>
<head>
<title>welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" class="font1"><form name="form1" method="post" action="login.php">
        <br>
        <br>
        <br>
        <table width="308" height="308" border="0" cellpadding="0" cellspacing="0" background="images/login_bg.jpg" class="txtmicrosoftsan8px">
          <tr> 
            <td width="90" height="133">&nbsp;</td>
            <td width="137" align="left" valign="bottom">User ID</td>
            <td width="80">&nbsp;</td>
          </tr>
          <tr> 
            <td height="22">&nbsp;</td>
            <td align="center"><input name="user" type="text" class="buttonlogin" onFocus="if(this.value=='User ID')this.value='';" ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="13"> </td>
            <td>Password</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="22">&nbsp;</td>
            <td align="center"><input name="password" type="password" class="buttonlogin" onFocus="if(this.value=='Password')this.value='';" ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="36">&nbsp;</td>
            <td align="center" valign="bottom"><input type=image height=19 
                        width=84 src="images/bt_login.jpg" 
                        value=submit border=0 name=submit2 onClick="this.style.cursor='hand'"> 
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
        
        <br>
        <span class="txtwhite">[ ใช้ Username และ Password เดียวกับระบบคุณภาพ ]</span> 
      </form></td>
  </tr>
</table>
		<?
				// login
				include ("images/lib/ms_database.php");
				
				$sql="SELECT *";
				$sql.=" FROM userlogin ";
				$sql.=" WHERE username='$user' AND password='$password'";
				$exsql=mssql_query($sql);
				$data=mssql_fetch_array($exsql);
				//echo $sql.'<br>';
				//echo $password.'<br>';
				$amc=$data[2];
				$province=$data[3];
				$amcname=$data[4];
				$amcstatus=$data[7];
				$username=$data[0];
				//echo $username;
				$ckamc=" SELECT * FROM AMC ";
				$ckamc.=" WHERE AMCCode='$amc' AND AMCProvince='$province'";
				$exckamc=mssql_query($ckamc);
				//echo  $ckamc;
				//echo '<br>';
				//echo $amc.$province;
				$numrow=mssql_num_rows($exckamc);
				$numrow2=mssql_num_rows($exsql);
				
				
				if($numrow=="0" AND $numrow2=="1" )
					if($user=="ADM" OR $user=="adm")
							{
											session_start();//เรียกฟังก์ชั่น session_start() เพื่อเริ่มใช้งาน session	
											$username=$username;
											$password=$password;
											session_register("username");
											session_register("password");
											session_register("amc");
											session_register("province");
											session_register("amcname");
											session_register("amcstatus");
									
										if($amcstatus=="N")
										{	
																	print '<script>alert(" ยินดีต้อนรับ สกต.'.$amcname.' ");window.location.href = "main.php";</script>';
																//	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=main.php">';
											}
										if($amcstatus=="Y")
											{
																	print '<script>alert(" ยินดีต้อนรับ '.$amcname.' ");window.location.href = "rpt.php";</script>';
											}		
							
							}
					
					else
						 {
								print '<script>alert(" ไม่พบข้อมูล สกต. กรุณาติดต่อผู้ดูแลระบบ ");</script>';
						 }

			else
						{
								if($numrow2=="1" AND $numrow=="1")
									{
										//echo $numrow;
									//	echo $sql.'<br>';
									//	echo $status;
										/*echo $sql.'<br>';
										echo $password.'<br>';
										echo $numrow.'<br>';
										echo $amc.'<br>';
										echo $province.'<br>';
										echo $amcname;
									*/	
											session_start();//เรียกฟังก์ชั่น session_start() เพื่อเริ่มใช้งาน session	
											$username=$username;
											$password=$password;
											session_register("username");
											session_register("password");
											session_register("amc");
											session_register("province");
											session_register("amcname");
											session_register("amcstatus");
									
										if($amcstatus=="N")
										{	
																	print '<script>alert(" ยินดีต้อนรับ สกต.'.$amcname.' ");window.location.href = "main.php";</script>';
																//	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=main.php">';
											}
										if($amcstatus=="Y")
											{
																	print '<script>alert(" ยินดีต้อนรับ '.$amcname.' ");window.location.href = "rpt.php";</script>';
											}
				
										}
					else
						 {
								print '<script>alert(" ข้อมูลรหัสผ่านไม่ถูกต้อง");</script>';
						 }
						}
		session_register("login_true") ;
	

		?>
</body>
</html>
