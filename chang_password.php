<?php session_start();
		include("lib/config.inc.php");
?>
<html>
<head>
<title></title>
<link href="css/main.css" rel="stylesheet" type="text/css"/>

<script language="JavaScript">
		function check_submit()
		{
			if (frm_password.password_old.value.length==0)
			{
				alert(' กรุณาบันทึกข้อมูลรหัสผ่านเก่า ');
				frm_password.password_old.focus();
				return false;
			}
			else if(frm_password.password_new.value.length==0)
			{
				alert(' กรุณาบันทึกข้อมูลรหัสผ่านใหม่ ');
				frm_password.password_new.focus();
				return false;
			}
			else if(frm_password.password_confirm.value.length==0)
			{
				alert(' กรุณาบันทึกข้อมูลยืนยันรหัสผ่านใหม่ ');
				frm_password.password_confirm.focus();
				return false;
			}
			else if(frm_password.password_new.value!=frm_password.password_confirm.value)
			{
				alert(' กรุณาบันทึกข้อมูลรหัสผ่านใหม่ กับ ข้อมูลยืนยันรหัสใหม่ ให้เหมือนกัน ');
				frm_password.password_confirm.focus();
				return false;
			}
			else
			{
				if (confirm(" คุณต้องการเปลี่ยนรหัสผ่านใหม่ ใช่ หรือ ไม่ ")) {
						return true;
				}
				else{
						return false;
				}  // end if
			}  // end if 
		}  // end function
</script>
</head>
<body onload="frm_password.password_old.focus(); ">
<br><br><br><br>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td height="4" width="4" align="left"><img src="images/framecor_lefttop_10.gif"></td>
		<td height="4" background="images/frame_top_10.gif" ></td>
		<td height="4" width="4" align="right"><img src="images/framecor_righttop_10.gif"></td>
	</tr>
	<tr>
		<td width="4" align="left" background="images/frame_left_10.gif"></td>
		<td align="center">
			<table width="100%" cellpadding="2" cellspacing="1" border="0">
			<form name="frm_password" method="post" action="chang_password.php" onsubmit=" return check_submit();" >
			<caption><strong> เปลี่ยนรหัสผ่าน </strong></caption>
			<tr>
				<td align="right"><font color="#005CA2"> รหัสผ่านเดิม : </font></td>
				<td align="left"><input name="password_old" type="password" maxlength="6" class="txt" size="10"></td>
			</tr>
			<tr>
				<td align="right"><font color="#EA8220"> รหัสผ่านใหม่ : </font></td>
				<td align="left"><input name="password_new" type="password" maxlength="6" class="txt" size="10"></td>
			</tr>
			<tr>
				<td align="right"><font color="#EA8220"> ยืนยันรหัสผ่านใหม่ : </font></td>
				<td align="left"><input name="password_confirm" type="password" maxlength="6" class="txt" size="10"></td>
			</tr>
			<input type="hidden" name="ok" value="1">
			<tr>
				<td colspan="2" align="center"> <input type="submit" value="บันทึกข้อมูล" onsubmit>&nbsp;<input type="reset" value="ยกเลิก"> </td>
			</tr>
			</form>
			</table>
		</td>
		<td width="4" align="right" background="images/frame_right_10.gif"></td>
	</tr>
	<tr>
		<td height="4" width="4" align="left"><img src="images/framecor_leftbt_10.gif"></td>
		<td height="4" background="images/frame_bt_10.gif" ></td>
		<td height="4" width="4" align="right"><img src="images/framecor_rightbt_10.gif"></td>
	</tr>
</table>
</body>
</html>
<?php
	include("lib/database.php");
	if(isset($ok))
	{
		$password_old = $_POST["password_old"];
		$password_new = $_POST["password_new"];
		$password_confirm = $_POST["password_confirm"];

		connect();
		$sql = " SELECT username, password FROM userlogin WHERE amccode='".$code_online."' AND password='".$password_old."' ";
	
		if(num_rows(query($sql))==1)
		{
				$sql = " UPDATE userlogin SET password='".$password_new."' WHERE amccode='".$code_online."' AND password='".$password_old."' ";
				query($sql);
				print '<script> alert(" ปรับปรุงรหัสผ่านใหม่ถูกต้อง ");</script>';
		}
		else
		{
				print '<script> alert(" ข้อมูลรหัสผ่านเดิมไม่ถูกต้อง ");</script>';
		}  // end if 
		close();
	}  // end if isset
?>