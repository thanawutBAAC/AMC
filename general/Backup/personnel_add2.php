<? include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<link href=".inputtype_personal" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="javascript">
function checkID(id) {
    if(id.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)

        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
    return true;
}

</script>


<script language="javascript" type="text/javascript">
<!--

function chkDigitPin(pin) {
//	alert(pin);
	var sum = (pin.charAt(0) * 13)+(pin.charAt(1) * 12)+(pin.charAt(2) * 11)+
						(pin.charAt(3) * 10)+(pin.charAt(4) * 9)+(pin.charAt(5) * 8)+
						(pin.charAt(6) * 7)+(pin.charAt(7) * 6)+(pin.charAt(8) * 5)+
						(pin.charAt(9) * 4)+(pin.charAt(10) * 3)+(pin.charAt(11) * 2);
	var digit = sum % 11;
	if (digit == 1) {digit = 0;}
	else if (digit == 0) {digit = 1;}
	else {digit = 11 - digit};
	if (digit != pin.charAt(12)) {
		alert(' ���ʻ�ЪҪ����١��ͧ'); frm.user_id.focus(); return;
	}
	return true;
}



function verify(frm) {
	    if(!checkID(document.form1.user_id.value))
       {alert('���ʻ�ЪҪ����١��ͧ'); frm.user_id.focus(); return false;}
	
	with( frm )
	 { 
		if(frm.user_id.value == "" ) { alert("��Ǩ�ͺ���ʻ�Шӵ�ǻ�ЪҪ����١��ͧ"); frm.user_id.focus(); return; }	
		//if(frm.user_id.value.length < 13 ) { alert("�к����ʻ�Шӵ�ǻ�ЪҪ�����Ѻ 13 ��ѡ"); frm.user_id.focus(); return; }
		if(frm.name.value == "" ) { alert("��Ǩ�ͺ�������١��ͧ"); frm.name.focus(); return; }
		if(frm.lsname.value == "" ) { alert("��Ǩ�ͺ���ʡ�����١��ͧ"); frm.lsname.focus(); return; }
		if(frm.birthday.value == "" ) { alert("��Ǩ�ͺ �ѹ/��͹/���Դ ���١��ͧ"); frm.birthday.focus(); return ; } 
		if(frm.phone.value.length < 10  ) { alert("�к���������Ţ���Ѿ������Ѻ 10 ��ѡ"); frm.phone.focus(); return; }

		} // whith
		

		frm.submit()
		

}
//-->
</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_personnel.gif" width="289" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");

		  		if($username!="" && $password!="")
				{
					echo $login_user;
			?>
            <a class=link_red href="javascript: if(confirm('��ͧ��÷����͡�ҡ�к�������� !!')){ window.location='logout.php';}">�͡�ҡ�к�</a> 
            <?
				}	
			?>
            </span></span></td>
        </tr>
        <tr> 
          <td height="40" colspan="2" align="center" valign="middle">
		  <?
		  		if($alert=="YES"&&$atert_1=="") 
				{ 
					print '<script>alert(" ���ʻ�ЪҪ� '.$user_id.' �բ����ž�ѡ�ҹ�к��������� ");</script>';
			 	}
		  ?>
		  </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="personnel_insertinto.php">
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=3 align=left><b>&nbsp; &nbsp;�ѹ�֡�����źؤ�ҡ� 
                          (��ѡ�ҹ) </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" class="boxleft30">
						<? echo '- ʡ�. �ѧ��Ѵ '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">���˹� 
                          : </td>
                        <td align="left" class="boxleft5">
						<?
							
							$sql="SELECT Positions,Positionsname ";
							$sql.=" FROM PersonnelCode ";
							$sql.=" WHERE Positions ";
							$sql.=" NOT IN (SELECT Positions FROM Personnel WHERE AMCCode='$amc' AND Positions Between '01' AND '05') ";
							$sql.=" ORDER BY Positions ";
							$exsql=mssql_query($sql);
							//echo $sql;
							echo '<select name="positions" >';
								while($rowall=mssql_fetch_row($exsql)) 
										{	
											echo '<option value='.$rowall[0].'>'.$rowall[1].'</option>';
										}
							echo '</select>';
						?>
						
						</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">2. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><input name="user_id" type="text" class="inputtypePersonnel" size="13" maxlength="13" ></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">3. </td>
                        <td height="20" align="left" class="boxleft5">���� : 
                        </td>
                        <td align="left" class="boxleft5"><input name="name" type="text" class="inputtypePersonnel"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">���ʡ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="lsname" type="text" class="inputtypePersonnel"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>5.</td>
                        <td height="20" align="left" class="boxleft5">�ѹ/��͹/���Դ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="birthday" type="text" id="birthday" size="10" maxlength="10" readonly="" class="inputtypePersonnel">
                          <img src="images/calendar_02.gif" alt=".���͡�ѹ���." width="14" height="16" align="absmiddle" onclick=" return showCalendar('birthday','dd-mm-y');" onmouseover="this.style.cursor='hand'"; > 
                          &lt;&lt; 
                          ���͡�ѹ���</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6. </td>
                        <td height="20" align="left" class="boxleft5">�շ����ҷӧҹ 
                          : </td>
                        <td align="left" class="boxleft5"><select name="working">
                            <?
									  $date=getdate(); // ��ҹ�ѹ���ͧ����ͧ�纷��ѧ��� $date
									  $year=$date[year]+543; //�ŧ �.� �ͧ����ͧ����� �.� ����������� $year
									  for ($x=$year;$x>=2540;$x--)  // ǹ�ٻ�� �.� �Ѩ�غѹ��� 5 ��
										echo '<option value='.$x.'>'.$x.'</option>';
								  ?>
                            <script language=JAVAScript> 
														for(i=0;i<=(document.form1.working<?=$i?>.length-1);i++) {
															if(document.form1.working<?=$i?>.options[i].value=="<?echo $rowall[7]?>") {
																document.form1.working<?=$i?>.options[i].selected = true;
																break;
															}
														}
									</script>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">����֡�� 
                          : </td>
                        <td align="left" class="boxleft5"><select name="education" >
                            <option value="1">����Թ��ж�������º���</option>
                            <option value="2">��ж��֡�� - �Ѹ���֡��</option>
                            <option value="3">�Ѹ���֡�� - ͹ػ�ԭ��</option>
                            <option value="4">͹ػ�ԭ�� - ��ԭ�ҵ��</option>
                            <option value="5">�٧���һ�ԭ�ҵ��</option>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="phone" type="text" class="inputtypePersonnel" size="10" maxlength="10"></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">������� 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="address" class="areabox150"></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="20" align=center>10.</td>
                        <td height="20" align="left" class="boxleft5">�����˵� 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="remark" class="areabox150"></textarea></td>
                    </table>
					
                    <br>
                    <input name="Submit" type="button" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'"onClick="onClick=verify(this.form)" >
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset" onMouseOver="this.style.cursor='hand'">
                  </form>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
