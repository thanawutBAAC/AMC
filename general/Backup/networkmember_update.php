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
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>
<script language="javascript" type="text/javascript">
<!--
function verify(frm) {
	with( frm )
	 {
		if(frm.txt_name.value == "" ) { alert("��Ǩ�ͺ�������١��ͧ"); frm.txt_name.focus(); return; }
		if(frm.txt_lsname.value == "" ) { alert("��Ǩ�ͺ���ʡ�����١��ͧ"); frm.txt_lsname.focus(); return; }
		if(frm.txt_brithday.value == "" ) { alert("��Ǩ�ͺ �ѹ/��͹/���Դ ���١��ͧ"); frm.txt_birthday.focus(); return ; } 
		if(frm.txt_phone.value.length =="" ) { alert("�к���������Ţ���Ѿ�����١��ͧ"); frm.txt_phone.focus(); return; }

		} // whith
		frm.submit()

}
/*	function bodyOnLoad() {
	if if(frm.help.value =="0" ){
		document.form1.list_branch.disabled=true;	
		}
	}
*/
//-->
</script>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_member.jpg" width="357" height="23"></td>
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
		  </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="networkmember_updatedata.php" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=4 align=left><b>&nbsp; &nbsp;��䢢�����͢�����Ҫԡ</b> 
                          <?
								$sql=" SELECT A.AMCCode, A.MemberHelp,A.MemberHelpBranch,C.CAT_DESC, A.MemberYear,A.MemberID, ";
								$sql.=" B.MemberName, B.MemberLastname, B.MemberBirthday,B.MemberPhone,B.MemberEducation, B.MemberAddress, ";
								$sql.=" A.MemberRemark  ";
								$sql.=" FROM NetworkMemberGroup A  ";
								$sql.=" LEFT JOIN( SELECT * FROM AMCCustomer )AS B ON A.MemberID=B.MemberID ";
								$sql.=" LEFT JOIN (SELECT D.AMCCode,D.amcprovince,E.CAT_AA,E.CAT_DESC FROM userlogin D  ";
								$sql.=" LEFT JOIN(SELECT * FROM CCAATTIS WHERE CAT_CC<>'00'AND CAT_AA<>'00' AND CAT_TT='00'  ";
								$sql.=" AND CAT_MM='00' AND CAT_DESC NOT LIKE '%*%')  ";
								$sql.=" AS E ON D.amcprovince=E.CAT_CC )AS C ON A.AMCCode=C.AMCCode AND A.MemberHelpBranch=C.CAT_AA  ";

								$sql.=" WHERE A.AMCCode='$amc' AND A.MemberYear='$memberyear' AND A.MemberID='$memberid' ";
								//echo $sql;
								$exsql=mssql_query($sql);
								$data=mssql_fetch_row($exsql);
								$memberhelp=$data[1];
								$memberhelpbranch=$data[2];
								$cat_desc=$data[3];
								$memberyear=$data[4];
								$memberid=$data[5];
								$membername=$data[6];
								$memberlsname=$data[7];
								$memberbrithday=$data[8];
								$memberphone=$data[9];
								$memberedu=$data[10];
								$memberaddress=$data[11];
								$memberremark=$data[12];
									if($memberhelp=="1")
										{$check1="checked";	}
									else{
									$check2="checked";
									}
							?>
                        </td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="4" class="boxleft30"> <? echo '- ʡ�. �ѧ��Ѵ '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0"> 
                        <td height="20" align=center style="color:#666666;">1.</td>
                        <td height="20" align="left" class="boxleft5" style="color:#666666;">��ê��§ҹ�Ң� 
                          : </td>
                        <td width="27%" align="left" valign="middle" class="boxleft5"> 
                          <?
						 		if($memberyear==$Year)
									{						 	
						 ?>
                          <input name="rdo_help" type="radio"   onClick="document.form1.list_branch.disabled=false;" value="1" <? echo $check1?>>
                          ���§ҹ�Ң� &nbsp; 
                          <?
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
                          <script language=JAVAScript> 
									for(i=0;i<=(document.form1.list_branch.length-1);i++) {
										if(document.form1.list_branch.options[i].value=="<?echo $memberhelpbranch?>") {
											document.form1.list_branch.options[i].selected = true;
											break;
										}
									}
								</script> 
								<?
										}/// if($memberyear==$Year)
								else
										{
									?>
											<table width="170" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
												<tr> 
												  <td bgcolor="#FFFAC1" class="boxleft5">
												  <?
												  	if($memberhelp=="1")
															{
															  echo $cat_desc;
															 }
													else{ echo '<span class="txtred">�������§ҹ�Ң�</span>';}
												  ?> 
												  <input type="hidden" name="rdo_help" value="<?echo $memberhelp?>">
												  <input name="list_branch" type="hidden" value="<?echo $memberhelpbranch;?>">
												  </td>
												</tr>
											  </table>
								<?	
						  				}	
								?>                      
								 </td>
                        <td width="44%" align="left" valign="middle" class="boxleft5"> 
								<?
										if($memberyear==$Year)
											{
								?>
                          <input type="radio" name="rdo_help" value="0" onClick="document.form1.list_branch.disabled=true;" <?echo $check2?>>
                          <span class="txtred">�������§ҹ�Ң� 
                          
                          <input type="hidden" name="memberyear" value="<?echo $memberyear;?>">
                          </span> 
                          <?
									}
							?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">2. 
                        </td>
                        <td width="25%" height="20" align="left" class="boxleft5">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><table width="170" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td bgcolor="#FFFAC1" class="boxleft5"><?echo $memberid;?> 
                                <input type="hidden" name="memberid" value="<?echo $memberid?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">3. </td>
                        <td height="20" align="left" class="boxleft5">���� : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel" value="<?echo $membername?>" onkeyup="doUnback(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">���ʡ�� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" value="<?echo $memberlsname?>" onkeyup="doUnback_lsname(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>5.</td>
                        <td height="20" align="left" class="boxleft5">�ѹ/��͹/���Դ 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_brithday" type="text" class="inputtypePersonnel" id="birthday" value="<?echo $memberbrithday?>" size="10" maxlength="10" readonly=""> 
                          <img src="images/calendar_02.gif" alt=".���͡�ѹ���." width="14" height="16" align="absmiddle" onclick=" return showCalendar('birthday','dd-mm-y');" onmouseover="this.style.cursor='hand'"; > 
                          &lt;&lt; ���͡�ѹ���</td>
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
                          </select>
							<script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_education.length-1);i++) {
									if(document.form1.list_education.options[i].value=="<?echo $memberedu?>") {
										document.form1.list_education.options[i].selected = true;
										break;
									}
								}
							</script>						  
						  </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" value="<?echo $memberphone?>" size="10" maxlength="10" onkeyup="doUnback_phone(value)"></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">������� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><textarea name="area_address" class="areabox150"><?echo $memberaddress?></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">�����˵� 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"><?echo $memberremark?></textarea></td>
                    </table>
					
                    <br>
                    <input name="Submit2" type="button" class="formButton" value=" Back "onClick="jascript:history.go(-1)"  onMouseOver="this.style.cursor='hand'" >
                    &nbsp; 
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
