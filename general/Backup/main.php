<?
		include ("checkuser.php");
	//	include ("checkadmin.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: ระบบฐานข้อมูล สกต. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
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
    <td height="328" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="txtmicrosoftsan9px">
        <tr> 
          <td height="30" align="right" valign="middle">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="right" class="boxright15"><span class="txtwhite">
            <? 
			//	echo $username;
			//	echo $password;

		  		if($username!="" && $password!="")
				{
					echo $login_user;
			?>
			<a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a>
			<?
				}	
			?>
            </span></td>
        </tr>
        <tr> 
          <td width="49%" align="right" valign="middle"><img src="images/acm_index.jpg" width="307" height="84"></td>
          <td width="2%" align="center" valign="top"><img src="images/line_center.jpg" width="1" height="400"></td>
          <td width="49%"><table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="amc_selection.php"><img src="images/index_menu01.jpg" width="152" height="53" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr></tr>
              <td><img src="images/dot.gif" width="25" height="1"><a href="rpt.php"><img src="images/index_menu02.jpg" width="230" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="amc_manual.doc" target="_blank"><img src="images/index_menu03.jpg" width="218" height="53" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
            </table>
			
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
