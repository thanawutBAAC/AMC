<?
	include("checkuser.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_asset.jpg" width="236" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
			//	echo $username;
			//	echo $password;
			//echo $amc;

		  		if($username!="" && $password!="")
				{
					echo $login_user;
			?>
			<a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a>
			<?
				}	
			?>
            </span></span></td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"> <legend> 
            <span class="fonts3"><a href="asset_ground.php" target="AssetMain" class="link_white" >บันทึกข้อมูลที่ดิน</a> 
            | <a href="asset_buildings.php" target="AssetMain" class="link_white">บันทึกข้อมูลสิ่งปลูกสร้าง</a> 
            | <a href="asset_vehicle.php" target="AssetMain" class="link_white">บันทึกข้อมูลยานพาหนะ</a> 
            | <a href="asset_office.php" target="AssetMain" class="link_white">บันทึกข้อมูลครุภัณฑ์</a></span></legend> 
            <center>
            </CENTER></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
