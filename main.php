<?php session_start();
	include("./lib/config.inc.php");
	include("./lib/database.php");
	connect();
//*************************************************************************************
	if($status_online=='Y'){ 
?>
		<HTML>
		<HEAD>
		<TITLE><?=$webSite['title'] ?></TITLE>
		<?=$webSite['meta']; ?>
		<link href="css/main.css" rel="stylesheet" type="text/css"/>
		</HEAD>
		<script language="JavaScript">
			status="<?=$webSite['copyright'] ?>";
		</script> 
		<frameset rows="100,*" cols="*" frameborder="NO" border="0" framespacing="0" resize="yes" >
		<frame src="header.php" name="topFrame" scrolling="No" >
		<frameset rows="*" cols="245,*" id="main_frame" framespacing="0" frameborder="NO" border="0" noresize>
		<frame src="menu.php" name="left" scrolling="Yes" frameborder="NO" >
			<frame src="" name="right" frameborder="NO" scrolling="Auto" ></frameset>
		</frameset>
		<noframes>
			<body>����������㹢�й�����ʹѺʹع�����ҹ Frame </body>
		</noframes>
		</HTML>
<?  
		exit();
	}  // end if status_online Y
?>
<HTML>
<HEAD>
<TITLE><?=$webSite['title'] ?></TITLE>
<?=$webSite['meta']; ?>
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<?
//***************************************************************************************
	$code = escapeshellcmd(trim($_POST['code']));
	$name = escapeshellcmd(trim($_POST['name']));
	$user_blank = $_GET['user_blank'];
	$user_type = '';
	// 㹡ó��繼�������� ������͹���ʼ�ҹ����� 
	if(trim($user_blank)=="blank"){
		$code_online = "x";
		$user_online = " �����ҹ����� ";
		$status_online = "N";
		$user_type= "xxx";
		session_register("code_online");
		session_register("user_online");
		session_register("user_type");
	} 
	else // �����ҹ����͹���� Uer Id ��� Password
	{
		if(strtolower($code)=='thanawut' AND strtolower($name)=='thanawut' )     //  �����ҹ ���ز�  ���Թ���
		{
			$user_type = "thanawut";
			$code_online = "thanawut";
			$user_online = "��¸��ز� ���Թ���";
		}
		else if(strtolower($code)=='adm')     //  �����ҹ administrator
		{
			$sql = " SELECT userdetail, amccode, status FROM userlogin ";
			$sql.=" WHERE username='".$code."' AND password='".$name."' AND status='Y' ";
			if(num_rows(query($sql))==0){
				print '<script> alert(" ������ User ID ��� Password ���١��ͧ   ����Һ�Դ��� WAN:4471-4472 "); </script>';
				print '<script>javascript:window.location.href="logout_user.php"</script>';
				exit();
			}
			else{
				$user_type = "admin";
				$code_online = "Admin";
				$user_online = "Administrator";
			}  // end if 
		} // end if 
		else{    //  �ó��� ʡ�. ( ʹ�.)
			$temp_username = '';
			if(substr(trim($code), -1)=='A'){	    // �����ҹ ʹ�. 
				$sql = " SELECT username FROM userlogin ";
				$sql.=" WHERE username='".$code."' AND password='".$name."'  ";
				$result_iso = query($sql);
				if(num_rows($result_iso)==1){
					$temp_username = trim(result($result_iso,0,'username'));
				} 
			}elseif(substr(trim($code), -1)=='B'){
				$sql = " SELECT username FROM userlogin ";
				$sql.=" WHERE username='".$code."' AND password='".$name."' AND amccode='�048337' ";
				$result_iso = query($sql);
				if(num_rows($result_iso)==1){
					$temp_username = trim(result($result_iso,0,'username'));
				} 
			} // end if B

			$sql = " SELECT userdetail, amccode, status, amcprovince,userdetail,username,password FROM userlogin ";
			$sql.=" WHERE username='".$temp_username."' ";
			if(num_rows(query($sql))==0){
				print '<script> alert(" ������ User ID ��� Password ���١��ͧ   ����Һ�Դ��� WAN:4471-4472 "); </script>';
				print '<script>javascript:window.location.href="logout_user.php"</script>';
				exit();
			}
			else{
			$result_user = query($sql);
			$code_online = trim(result($result_user,0,'amccode'));
			$status_online = trim(result($result_user,0,'status'));
			$user_online = "ʡ�.".trim(result($result_user,0,'userdetail'));
			$user_type = "skt";

		//--------------------------- pee
				$amc =  trim(result($result_user,0,'amccode'));
				$province = trim(result($result_user,0,'amcprovince'));
				$amcname = trim(result($result_user,0,'userdetail'));
				$amcstatus = trim(result($result_user,0,'status'));
				$username = trim(result($result_user,0,'username'));
				$password = trim(result($result_user,0,'password'));

			//----------------------- pee
				session_register("amc");
				session_register("province");
				session_register("amcname");
				session_register("amcstatus");
				session_register("username");
				session_register("password");
			}  // end if 
		} // end if
		
		$status_online = "Y";
		session_register("user_type");
		session_register("code_online");
		session_register("user_online");
		session_register("status_online");
		print '<script> alert(" �Թ�յ�͹�Ѻ '.$user_online.' "); </script>';

		// �óռ������ ʡ�. ����Ǩ�ͺ��������͡��Ǣ����§ҹ���������ѧ  
		if($user_type=='skt')  
		{
			$sql = "  SELECT  amccode FROM  BaseReportHeader ";
			$sql.=" WHERE amccode = '".$code_online."' ";
			if(num_rows(query($sql))==0)
			{
				print '<script> alert(" �ѧ������˹���Ǣ�͡���觢�������§ҹ "); </script>';
				print '<script> alert(" ��سҡ�˹�������� [ �к�����§ҹ-->��˹���Ǣ����§ҹ] ��͹���Թ���� �  "); </script>';
			}
		} // end if skt 
	}
?>
</HEAD>
<script language="JavaScript">
status="<?=$webSite['copyright'] ?>";
</script> 
 <frameset rows="100,*" cols="*" frameborder="NO" border="0" framespacing="0" resize="yes" >
  <frame src="header.php" name="topFrame" scrolling="No" >
  <frameset rows="*" cols="245,*" id="main_frame" framespacing="0" frameborder="NO" border="0" noresize>
    <frame src="menu.php" name="left" scrolling="Yes" frameborder="NO" >
    <frame src="" name="right" frameborder="NO" scrolling="Auto" >
  </frameset>
</frameset>
<noframes><body>
����������㹢�й�����ʹѺʹع�����ҹ Frame 
</body></noframes>
</HTML>