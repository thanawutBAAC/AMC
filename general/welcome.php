<?	session_start();//เรียกฟังก์ชั่น session_start() เพื่อเริ่มใช้งาน session ?>
<html>
<head>
<title>welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<?
		if(session_is_registered(username))
			{
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=main.php">';
			}
		else
			{
?>
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
</body>
		<?
				}
		?>
</html>
