<? 
session_start(); //���¡�ѧ���� session_start() �����������ҹ session
include ("checkuser.php");
//include ("checkadmin.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: �к��ҹ������ ʡ�. ::</title>
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
    <td height="328" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr class="txtmicrosoftsan9px"> 
          <td height="30" align="right" valign="middle">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="right" class="boxright15"><span class="txtwhite"> 
            <? 
			//	echo $username;
			//	echo $password;
			//echo $username.$password,$amcstatus;

		  		if($username<>"" && $password<>"")
				{
					echo $login_user;
				?>
            <a class=link_red href="javascript: if(confirm('��ͧ��÷����͡�ҡ�к�������� !!')){ window.location='logout.php';}">�͡�ҡ�к�</a> 
            <?
					}
				?>
            </span></td>
        </tr>
        <tr> 
          <td width="49%" align="right" valign="middle"><img src="images/insert_index.jpg" width="313" height="84"></td>
          <td width="2%" align="center" valign="top"><img src="images/line_center.jpg" width="1" height="400"></td>
          <td width="49%" align="left" valign="middle"><table width="80%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="#"><img src="images/amc_select_01.jpg" width="240" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="#"><img src="images/amc_select_02.jpg" width="184" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="#"><img src="images/amc_select_03.jpg" width="236" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="amc.php"><img src="images/amc_select_04.jpg" width="220" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
