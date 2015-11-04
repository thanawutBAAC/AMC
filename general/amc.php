<? include ("checkuser.php");?>
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
			//echo $username;
			//	echo $password;

		  		if($username!="" && $password!="")
				{
					echo $login_user;
				?>
			<a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a>
				<?
					$Year=(date('Y')+543);
					}
				?>
            </span></td>
        </tr>
        <tr> 
          <td width="49%" align="right" valign="middle"><img src="images/insert_index.jpg" width="313" height="84"></td>
          <td width="2%" align="center" valign="top"><img src="images/line_center.jpg" width="1" height="400"></td>
          <td width="49%" align="left" valign="middle">
		  <?
		  		if($amcstatus=="Y")
					{
		  ?>
		    <table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="amc_general_main.php"><img src="images/amc_menu01.jpg" width="170" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
                <tr><td>&nbsp;</td></tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="asset_admin.php"><img src="images/amc_menu04.jpg" width="169" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
            </table>
			<?
						}
				else
					{					
			?>
            <table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="amc_general_edit.php"><img src="images/amc_menu01.jpg" width="170" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="committee.php"><img src="images/amc_menu02.jpg" width="148" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="personnel.php"><img src="images/amc_menu03.jpg" width="139" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="images/dot.gif" width="25" height="1"><a href="asset.php"><img src="images/amc_menu04.jpg" width="169" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="16"><img src="images/dot.gif" width="25" height="1"><a href="networkmember.php?SendYear=<?echo $Year;?>"><img src="images/amc_menu05.jpg" width="160" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
              <tr> 
                <td height="16">&nbsp;</td>
              </tr>
              <tr> 
                <td height="16"><img src="images/dot.gif" width="25" height="1"><a href="networkbranch.php"><img src="images/amc_select_05.jpg" width="148" height="52" border="0" style="filter:alpha(opacity=100)" onmouseover="nereidFade(this,50,30,8)" onmouseout="nereidFade(this,100,50,8)"></a></td>
              </tr>
            </table>
			<?
					}
			?>
			</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
