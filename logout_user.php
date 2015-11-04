<?php session_start();
		session_unregister("code_online");
		session_unregister("status_online");
		session_unregister("user_online");
		session_unregister("amc");
		session_unregister("province");
		session_unregister("amcname");
		session_unregister("amcstatus");
		session_unregister("username");
		session_unregister("password");
		session_destroy();
		print '<script>window.top.location.href = "index.php";</script>';
		exit();  	
?>