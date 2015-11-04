<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
</head>
<script>
			nereidFadeObjects = new Object();
			nereidFadeTimers = new Object();
			
			function nereidFade(object, destOp, rate, delta){
			if (!document.all)
			return
			if (object != "[object]"){ //do this so I can take a string too
			setTimeout("nereidFade("+object+","+destOp+","+rate+","+delta+")",0);
			return;
			}
			
			clearTimeout(nereidFadeTimers[object.sourceIndex]);
			
			diff = destOp-object.filters.alpha.opacity;
			direction = 1;
			if (object.filters.alpha.opacity > destOp){
			direction = -1;
			}
			delta=Math.min(direction*diff,delta);
			object.filters.alpha.opacity+=direction*delta;
			
			if (object.filters.alpha.opacity != destOp){
			nereidFadeObjects[object.sourceIndex]=object;
			nereidFadeTimers[object.sourceIndex]=setTimeout("nereidFade(nereidFadeObjects["+object.sourceIndex+"],"+destOp+","+rate+","+delta+")",rate);
			}
			}
			
</script>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr class="txtmicrosoftsan9px"> 
          <td height="30" align="right" valign="middle">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="right" class="boxright15"><span class="txtwhite"> 
            <? 
			//	echo $username;
			//	echo $password;
			//echo $username.$password,$amcstatus;
		  		if($username!="" && $password!="" && $amcstatus!="")
				{

						if($amcstatus=="N")
									{ $login_user='ยินดีต้อนรับ<b> สกต.'.$amcname.'</b> | ';}
							if($amcstatus=="Y")
									{ $login_user="ยินดีต้อนรับ<b>ผู้ดูแลระบบ</b> | ";}

				echo $login_user;
				?>
            <a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a> 
            <?
					}
				?>
			</td>
        </tr>
        <tr> 
          <td width="49%" align="right" valign="middle"><img src="images/rpt_index.jpg" width="313" height="84"></td>
          <td width="2%" align="center" valign="top"><img src="images/line_center.jpg" width="1" height="400"></td>
          <td width="49%" align="left" valign="middle"><table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="rpt_location.php"><img src="images/rpt_menu01.jpg" width="120" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="rpt_personnel.php"><img src="images/rpt_menu02.jpg" width="140" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="rpt_networkmember.php"><img src="images/rpt_menu04.jpg" width="161" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="rpt_asset.php"><img src="images/rpt_menu03.jpg" width="146" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
