<? include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>


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
function verify(frm) {

	    if(!checkID(document.form1.txt_user_id.value))
       {
	   			alert('��Ǩ�ͺ���ʻ�ЪҪ����١��ͧ'); frm.txt_user_id.focus(); return false;
		}
	with( frm )
	 {
		if(frm.txt_name.value == "" ) { alert("��Ǩ�ͺ�������١��ͧ"); frm.txt_name.focus(); return; }
		if(frm.txt_lsname.value == "" ) { alert("��Ǩ�ͺ���ʡ�����١��ͧ"); frm.txt_lsname.focus(); return; }
		if(frm.txt_birthday.value == "" ) { alert("��Ǩ�ͺ �ѹ/��͹/���Դ ���١��ͧ"); frm.txt_birthday.focus(); return ; } 
		if(frm.txt_phone.value.length < 10  ) { alert("�к���������Ţ���Ѿ�����١��ͧ"); frm.txt_phone.focus(); return; }
		} // whith
		frm.submit()
}

function chkEdu(x){
	if(x<"3"){
		document.forms[0].list_degree.disabled=true;
	}else{
		document.forms[0].list_degree.disabled=false;
	}
}
function bodyOnLoad() {
	document.forms[0].txt_CommitteeSocial.disabled=true;
	document.forms[0].list_degree.disabled=true;
}

function chkposition(x){
	if(x<"02"){
		document.forms[0].rdo_CommitteeAMC[0].disabled=false;
		document.forms[0].rdo_CommitteeAMC[1].disabled=false;
	}else{
		document.forms[0].rdo_CommitteeAMC[0].disabled=true;
		document.forms[0].rdo_CommitteeAMC[1].disabled=true;
	}
}
//-->
</script>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="bodyOnLoad();">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="50" align="center" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="29" valign="bottom" class="boxleft50"><img src="images/head_committee.jpg" width="330" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				//include ("images/lib/ms_database.php");

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
      </table>
      <table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="committee_insertinto.php" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="25" colspan=3 align=left><b>&nbsp; &nbsp;�ѹ�֡�����źؤ�ҡ� 
                          (��С������) </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" colspan="3" class="boxleft30"> <? echo '- ʡ�. �ѧ��Ѵ '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">���˹� 
                          : </td>
                        <td align="left" class="boxleft5"> 
                          <?
						  	$Year=(date(Y)+543);
							include ("images/lib/ms_database.php");
							if($list_degree==""){$list_degree=="0";}
							$sql=" SELECT CommitteeType,CommitteeName FROM CommitteeCode  ";
							$sql.=" WHERE CommitteeType NOT IN ( ";
							$sql.=" SELECT CommitteeType FROM CommitteeGroup ";
							$sql.=" WHERE AMCCode='$amc' AND CommitteeType Between '01' AND '04' AND CommitteeGroup='$Year' ";
							$sql.=" ) ORDER BY CommitteeType  ";
							//echo $sql;
							$exsql=mssql_query($sql);
							//echo '<br>'.$sql;
							echo '<select name="list_CommitteeType" onChange="chkposition(this.value);">';
								while($rowall=mssql_fetch_row($exsql)) 
										{
											if($rowall[0]=="01"){
												$chk01 = "Y";
											}
											echo '<option value='.$rowall[0].'>'.$rowall[1].'</option>';
										}
							echo '</select>';
							$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
							//echo $chk01;
						?>
                          <input type="hidden" name="hdd_CommitteeCategory" value="00"> 
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">2. </td>
                        <td height="20" align="left" class="boxleft5">��ô�ç���˹� 
                          : </td>
                        <td align="left" class="boxleft5"><table width="240" border="0" cellpadding="0" cellspacing="0" class="font1">
                            <tr class="boxleft5" style="color:#666666;"> 
                              <td width="50" align="left">
                                <? $Year=(date('Y')+543); echo '<span class="txtred"><b>�� '.$Year.'</b></span>';?>
                              </td>
                              <td width="50" align="right">���з�� :</td>
                              <td width="37"><select name="list_Committeeoccasion" style="COLOR : #FF0000;FONT-WEIGHT: bold;">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select></td>
                              <td width="37" align="right">�շ�� :</td>
                              <td width="66" class="boxleft5"><select name="list_CommitteeYear" style="COLOR : #FF0000;FONT-WEIGHT: bold;">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">3. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><input name="txt_user_id" type="text" class="inputtypePersonnel" size="13" maxlength="13" onChange="checkID(this.value);" onkeyup="doUnback_id(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">4. </td>
                        <td height="20" align="left" class="boxleft5">���� : </td>
                        <td align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel"  onkeyup="doUnback(value)" ></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="21" align=center>5.</td>
                        <td height="21" align="left" class="boxleft5">���ʡ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" onkeyup="doUnback_lsname(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6.</td>
                        <td height="20" align="left" class="boxleft5">�ѹ/��͹/���Դ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_birthday" type="text" id="birthday" size="10" maxlength="10" readonly="" class="inputtypePersonnel100px"> 
                          <img src="images/calendar_02.gif" alt=".���͡�ѹ���." width="14" height="16" align="absmiddle" onclick=" return showCalendar('birthday','dd-mm-y');" onmouseover="this.style.cursor='hand'"; > 
                          &lt;&lt; ���͡�ѹ���</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" size="10" maxlength="10" onkeyup="doUnback_phone(value)"></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">����֡�� 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_education" onChange="chkEdu(this.value);">
                            <option value="1">����Թ��ж�������º���</option>
                            <option value="2">�Ѹ���֡��</option>
                            <option value="3">͹ػ�ԭ��</option>
                            <option value="4">��ԭ�ҵ��</option>
                            <option value="5">�٧���һ�ԭ�ҵ��</option>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=left> &nbsp;&nbsp;&nbsp;8.1</td>
                        <td height="20" align="left" class="boxleft5">�زԡ���֡�� 
                          : </td>
                        <td align="left" class="boxleft5">
							<select name="list_degree" >
                            <option value="1">��õ�Ҵ</option>
                            <option value="2">�ѭ��</option>
                            <option value="3">��������С�èѴ���</option>
                            <option value="4">�ɵ���ʵ��</option>
                            <option value="5">�ѧ����ʵ��</option>
                            <option value="6">����</option>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">�� ��.ʡ� 
                          ������� :</td>
                        <td align="left" class="boxleft5"><input type="radio" name="rdo_CommitteeAMC" value="1">
                          �� 
                          <input type="radio" name="rdo_CommitteeAMC" value="0"  checked> 
                          <span class="txtred">�����</span></td>
                      </tr>
					  <script language="javascript">
						<!--
							if("<?=$chk01?>"=="Y") {
								chkposition('01');
							}else{
								chkposition('02');
							}
						//-->
					  </script>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>10.</td>
                        <td height="20" align="left" class="boxleft5">ʶҹзҧ�ѧ�� 
                          : </td>
                        <td align="left" class="boxleft5"><table width="55%" border="0" cellpadding="0" cellspacing="0" class="font1">
                            <tr style="color:#666666;"> 
                              <td width="25%" height="25" align="left" valign="middle"><input type="radio" name="rdo_CommitteeSocial" Onclick="document.form1.txt_CommitteeSocial.disabled=false;" value="1">
                                �� (�к�)</td>
                              <td width="75%" height="20" align="left" valign="bottom"><input name="txt_CommitteeSocial" type="text" class="inputtypePersonnel100px" onkeyup="doUnback_socail(value)"></td>
                            </tr>
                            <tr> 
                              <td height="20" colspan="2" style="color:#666666;"><input name="rdo_CommitteeSocial" type="radio"  onClick="document.form1.txt_CommitteeSocial.disabled=true;" value="0" checked checke > 
                                <span class="txtred">�����</span></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        
                  <td height="20" align=center bgcolor="#F0F0F0">11. </td>
                        <td height="20" align="left" class="boxleft5">�Ҫվ��ѡ 
                          : </td>
                        <td align="left" class="boxleft5"> 
                          <? 
							echo '<select name="list_Occu" >';
							for($i=1; $i<=4; $i++)
									{                         
									echo   '<option value='.$i.'>'.$Occu[$i].'</option>';
									 }
                          echo '</select>';	?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        
                  <td height="20" align=center bgcolor="#F0F0F0">12.</td>
                        <td height="20" align="left" class="boxleft5">�Ҫվ�ͧ 
                          :</td>
                        <td align="left" class="boxleft5"> 
                          <? 
							echo '<select name="list_Occusecond" >';
							for($i=1; $i<=4; $i++)
									{                         
									echo   '<option value='.$i.'>'.$Occu[$i].'</option>';
									 }
                          echo '</select>';	?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        
                  <td height="20" align=center>13.</td>
                        <td height="20" align="left" class="boxleft5">������� 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_address" class="areabox150"></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        
                  <td height="20" align=center>14.</td>
                        <td height="20" align="left" class="boxleft5">�����˵� 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"></textarea></td>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#666666;"> 
                        <td height="3" colspan="3" align=center> </td>
                    </table>
                    <br>
                    <input name="Submit2" type="button" class="formButton" value=" Back "onClick="jascript:history.go(-1)"  onMouseOver="this.style.cursor='hand'" >
                    &nbsp; 
                    <input name="Submit" type="button" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'"onClick="onClick=verify(this.form)" >
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset" onMouseOver="this.style.cursor='hand'">
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
