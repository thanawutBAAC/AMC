<?include ("checkuser.php");?>
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
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>
<script language="javascript">
function chkDigitPin(pin) {	
	var sum = (pin.charAt(0) * 13)+(pin.charAt(1) * 12)+(pin.charAt(2) * 11)+
						(pin.charAt(3) * 10)+(pin.charAt(4) * 9)+(pin.charAt(5) * 8)+
						(pin.charAt(6) * 7)+(pin.charAt(7) * 6)+(pin.charAt(8) * 5)+
						(pin.charAt(9) * 4)+(pin.charAt(10) * 3)+(pin.charAt(11) * 2);
	var digit = sum % 11;
	if (digit == 1) {digit = 0;}
	else if (digit == 0) {digit = 1;}
	else {digit = 11 - digit};
	if (digit != pin.charAt(12)) {
		return false;		
	}
	return true;
}

</script>
<script language="javascript" type="text/javascript">
<!--
function verify() {
		 if(form1.txt_user_id.value.length <13 ) { alert("��Ǩ�ͺ�Ţ���ѵû�Шӵ�ǻ�ЪҪ����ú 13 ��ѡ"); form1.txt_user_id.focus(); return false; }
		 if(!chkDigitPin(form1.txt_user_id.value)){ alert("�Ţ�ѵû�Шӵ�ǻ�ЪҪ����١��ͧ"); form1.txt_user_id.focus(); return false;} 
		if(form1.txt_name.value == "" ) { alert("��Ǩ�ͺ�������١��ͧ"); form1.txt_name.focus(); return false; }
		if(form1.txt_lsname.value == "" ) { alert("��Ǩ�ͺ���ʡ�����١��ͧ"); form1.txt_lsname.focus(); return false; }
		if(form1.txt_birthday.value == "" ) { alert("��Ǩ�ͺ �ѹ/��͹/���Դ ���١��ͧ"); form1.txt_birthday.focus(); return false; } 
		if(form1.txt_phone.value.length =="" ) { alert("�к����������Ţ���Ѿ�����١��ͧ"); form1.txt_phone.focus(); return false; }
	return true;

}

 function check_number() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if (e_k != 13 && (e_k < 46) || (e_k > 57) || (e_k==47)) {
event.returnValue = false;
alert("��ͧ�繵���Ţ��ҹ��... \n��سҵ�Ǩ�ͺ�����Ţͧ��ҹ�ա����...");
}
}

 function check_text() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if ((e_k>=33 && e_k<=64) || (e_k>=91 && e_k<=95) || (e_k >=123 && e_k<=160) || (e_k>=239 && e_k<= 251) ) {
event.returnValue = false;
alert("��͹��������������ѧ�����ҹ��... \n��سҵ�Ǩ�ͺ�����Ţͧ��ҹ�ա����...");
}
}

//-->
</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><br>
            <br>
            <img src="images/head_member.jpg" width="357" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            </span></span></td>
        </tr>
        <tr> 
          <td height="40" colspan="2" align="center" valign="middle">
		  </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="networkmember_insertinto.php" onsubmit=" return verify(); " >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="95%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=4 align=left><b>&nbsp; &nbsp;�ѹ�֡������͢�����Ҫԡ</b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="4" class="boxleft30"> <? echo '- ʡ�. �ѧ��Ѵ '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0"> 
                        <td height="20" align=center style="color:#666666;">1.</td>
                        <td height="20" align="left" class="boxleft5" style="color:#666666;">��ê��§ҹ�Ң� 
                          : </td>
                        <td width="40%" align="left" valign="middle" class="boxleft5"> 
                          <input name="rdo_help" type="radio"   onClick="document.form1.list_branch.disabled=false;" value="1" checked>
                          ���§ҹ�Ң� &nbsp; 
                          <?
						  			include("../lib/ms_database.php");
									$sql_desc=" SELECT CAT_CC,CAT_AA,CAT_TT,CAT_MM,CAT_DESC FROM CCAATTIS  ";
									$sql_desc.=" WHERE CAT_AA<>'00' AND CAT_TT ='00'AND CAT_MM='00'AND CAT_DESC not like '%*%' AND CAT_Cc='$province' ORDER BY CAT_AA  ";
									$exsql_desc=mssql_query($sql_desc);
									//echo $sql_desc;
									echo '<select name="list_branch">';
										while($rowall=mssql_fetch_array($exsql_desc))
												{
													echo '<option value="'.$rowall[1].'">'.$rowall[4].'</option>';
												}
									echo '</select>';
							?>
                        </td>
                        <td width="44%" align="left" valign="middle" class="boxleft5"> 
                          <input type="radio" name="rdo_help" value="0" onClick="document.form1.list_branch.disabled=true;"> 
                          <span class="txtred">�������§ҹ�Ң�</span></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">2. 
                        </td>
                        <td width="25%" height="20" align="left" class="boxleft5">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_user_id" type="text" class="inputtypePersonnel" size="13" maxlength="13"  onKeyPress=check_number(); onChange="chkDigitPin(this.value);" ></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">3. </td>
                        <td height="20" align="left" class="boxleft5">���� : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel" onKeyPress=check_text(); ></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">���ʡ�� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" onKeyPress=check_text(); ></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>5.</td>
                        <td height="20" align="left" class="boxleft5">�ѹ/��͹/���Դ 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5">
                          <?
						$data[8]=trim($data[8]);
						/*echo substr($PersonnelBrithday,0,2);
						echo '<br>';
						echo substr($PersonnelBrithday,0,2);
						echo '<br>';
						echo substr($PersonnelBrithday,-5);
						echo '<br>';
						
						//echo strpos($PersonnelBrithday,"/");
						echo substr($PersonnelBrithday,0,strpos($PersonnelBrithday,"/"));
												echo substr($PersonnelBrithday,3,strpos($PersonnelBrithday,"/"));

						*/
						?>
                          �ѹ 
                          <select name="ddate" class="datetime">
                            <?
									for($i=1;$i<=31;$i++)
									{
										echo '<option value='.$i.'>'.$i.'</option>';
									}
							
							?>
                          </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.ddate.length-1);i++) {
									if(document.form1.ddate.options[i].value=="<?echo substr($data[8],0,strpos($data[8],"/"));?>") {
										document.form1.ddate.options[i].selected = true;
										break;
									}
								}
							</script>
                          ��͹ 
                          <select name="dmonth" class="datemonth">
                            <option value="01">���Ҥ�</option>
                            <option value="02">����Ҿѹ��</option>
                            <option value="03">�չҤ�</option>
                            <option value="04">����¹</option>
                            <option value="05">����Ҥ�</option>
                            <option value="06">�Զع�¹</option>
                            <option value="07">�á�Ҥ�</option>
                            <option value="08">�ԧ�Ҥ�</option>
                            <option value="09">�ѹ��¹</option>
                            <option value="10">���Ҥ�</option>
                            <option value="11">��Ȩԡ�¹</option>
                            <option value="12">�ѹ�Ҥ�</option>
                          </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.dmonth.length-1);i++) {
									if(document.form1.dmonth.options[i].value=="<?echo substr($data[8],strpos($data[8],"/")+1,2);?>") {
										document.form1.dmonth.options[i].selected = true;
										break;
									}
								}
							</script>
                          �.�. 
                          <select name="dyear" class="dateyear">
                            <?
									for($a=(date(Y)+543);$a>=((date(Y)+543)-80);$a--)
									{
										echo '<option value='.$a.'>'.$a.'</option>';
									}
							
							?>
                          </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.dyear.length-1);i++) {
									if(document.form1.dyear.options[i].value=="<?echo substr($data[8],-4)?>") {
										document.form1.dyear.options[i].selected = true;
										break;
									}
								}
							</script></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6.</td>
                        <td height="20" align="left" class="boxleft5">����֡�� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><select name="list_education" >
                            <option value="1">����Թ��ж�������º���</option>
                            <option value="2">�Ѹ���֡��</option>
                            <option value="3">͹ػ�ԭ��</option>
                            <option value="4">��ԭ�ҵ��</option>
                            <option value="5">�٧���һ�ԭ�ҵ��</option>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" size="10" maxlength="10" onKeyPress=check_number(); ></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">������� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><textarea name="area_address" class="areabox150"></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">�����˵� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"></textarea></td>
                    </table>
                    <br>
                    <input name="Submit" type="submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'">
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
