<? include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript" type="text/javascript">
<!--


function chkEdu(x){
	if(x<"3"){
		document.forms[0].list_degree.disabled=true;
	}else{
		//alert("testtest");
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
		document.forms[0].rdo_CommitteeAMC[1].disabled=false
	}else{
		document.forms[0].rdo_CommitteeAMC[0].disabled=true;
		document.forms[0].rdo_CommitteeAMC[1].disabled=true;
	}
}

//-->
</script>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="50" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="committee_updatedata.php" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="25" colspan=3 align=left><b>&nbsp; &nbsp;��䢢����źؤ�ҡ� 
                          (��С������) </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" colspan="3" class="boxleft30"><? echo '- ʡ�. �ѧ��Ѵ '.$amcname;?> 
                          <?
						 	$Year=(date(Y)+543);
							include ("images/lib/ms_database.php");
							$sql=" SELECT A.AMCCode, A.CommitteeGroup,A.Committeeoccasion,A.CommitteeYear,A.committeeID, ";
							$sql.=" A.CommitteeType,A.CommitteeCategory, C.CommitteeName,A.CommitteeStatus,B.MemberName, ";
							$sql.=" B.MemberLastname,B.MemberBirthday,B.MemberAddress,B.MemberPhone, A.CommitteeAMC, ";
							$sql.=" B.MemberEducation,B.MemberDegree,A.CommitteeSocial, B.MemberOccu,B.MemberOccuSecond, ";
							$sql.=" B.MemberRemark  ";
							$sql.=" FROM CommitteeGroup A  ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT * FROM AMCCustomer ";
							$sql.=" )AS B ON A.CommitteeID=B.MemberID  ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT * FROM CommitteeCode ";
							$sql.=" )AS C ON A.CommitteeType=C.CommitteeType  ";
							$sql.=" WHERE A.Committeegroup ='$comitteegroup' AND A.Committeeoccasion='$committeeoccasion' AND A.committeeYear='$committeeyear' AND A.CommitteeID='$committeeid' AND A.CommitteeType='$committeetype'";
							//echo $sql;
							$exsql=mssql_query($sql);
							$data=mssql_fetch_row($exsql);
							$amccode=$data[0];
							$committeegroup=$data[1];
							$committeeoccasion=$data[2];
							$committeeyear=$data[3];
							$committeeid=$data[4];
							$committeetype=$data[5];
							$committeecategory=$data[6];
							$committeetypename=$data[7];
							$committeestatus=$data[8];
							$committeename=$data[9];
							$committeelastname=$data[10];
							$committeebrithday=$data[11];
							$committeeadress=$data[12];
							$committeephone=$data[13];
							$committeeamc=$data[14];
							$committeeedu=$data[15];
							$committeedegree=$data[16];
							$committeesocial=$data[17];
							$committeeoccu=$data[18];
							$committeeoccusecond=$data[19];
							$committeeremark=$data[20];
							
							
							$b1=substr($data[4],0,1); 
							$b2=substr($data[4],1,4);
							$b3=substr($data[4],5,5);
							$b4=substr($data[4],10,2);
							$b5=substr($data[4],12,13);
							$committeeid= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
					
							$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
						?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">���˹� 
                          : </td>
                        <td align="left" class="boxleft5"> 
                          <?
								if($committeegroup==$Year)
									{
						?>
                          <table width="150" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td> 
                                <?
								  echo '<select name="list_committeetype" onChange="chkposition(this.value);" >';
								  $sql="SELECT * FROM CommitteeCode";
								  $exsql=mssql_query($sql);
											while($rowall=mssql_fetch_array($exsql))
												{
												  echo '<option value="'.$rowall[0]. '">'.$rowall[2].'</option>';
												}
								  echo  '</select>';
						  ?>
                                <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_committeetype.length-1);i++) {
									if(document.form1.list_committeetype.options[i].value=="<?echo $committeetype?>") {
										document.form1.list_committeetype.options[i].selected = true;
										break;
									}
								}
							</script> <input type="hidden" name="hdd_CommitteeCategory" value="00"></td>
                            </tr>
                          </table>
                          <?
						  			}
								if($committeegroup<>$Year)
									{
						  ?>
                          <table width="150" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="CCCCCC" class="font1">
                            <tr> 
                              <td bgcolor="#FFFAC1" class="boxleft5"><?echo $committeetypename;?> 
                                <input type="hidden" name="list_committeetype" value="00"> 
                                <input type="hidden" name="hdd_CommitteeCategory" value="00"> 
                              </td>
                            </tr>
                          </table>
                          <?
						  		}
						  ?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">2. </td>
                        <td height="20" align="left" class="boxleft5">��ô�ç���˹� 
                          : </td>
                        <td align="left" class="boxleft5"><table width="200" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                            <tr> 
                              <td width="200" bgcolor="#FFFAC1"><table width="189" border="0" cellpadding="0" cellspacing="0" class="font1">
                                  <tr > 
                                    <td width="46" align="left" class="boxleft5"><?echo  '<b><span  class="txtred">�� '.$committeegroup?></span></b></td>
                                    <td width="56" align="right">���з�� : </td>
                                    <td width="23"><b><span class="txtred"><?echo ' '.$committeeoccasion?></span></b></td>
                                    <td width="39" align="right">�շ�� :</td>
                                    <td width="25" class="boxleft5"><b><span class="txtred"><?echo $committeeyear?></span></b></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
                          <input type="hidden" name="committeeoccasion" value="<?echo $committeeoccasion?>"> 
                          <input type="hidden" name="committeeyear" value="<?echo $committeeyear?>"> 
                          <input type="hidden" name="committeegroup" value="<?echo $committeegroup?>"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">3. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
                          : </td>
                        <td width="69%" align="left" class="boxleft5"> <table width="150" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="CCCCCC" class="font1">
                            <tr> 
                              <td bgcolor="#FFFAC1" class="boxleft5"><?echo $committeeid?> 
                              </td>
                            </tr>
                          </table>
                          <input type="hidden" name="committeeid" value="<?echo $data[4]?>"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">4. </td>
                        <td height="20" align="left" class="boxleft5">���� : </td>
                        <td align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel" value="<?echo $committeename?>" onkeyup="doUnback(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="21" align=center>5.</td>
                        <td height="21" align="left" class="boxleft5">���ʡ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" value="<?echo $committeelastname?>" onkeyup="doUnback_lsname(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6.</td>
                        <td height="20" align="left" class="boxleft5">�ѹ/��͹/���Դ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_birthday" type="text" id="birthday" size="10" maxlength="10" readonly="" class="inputtypePersonnel100px" value="<?echo $committeebrithday?>"> 
                          <img src="images/calendar_02.gif" alt=".���͡�ѹ���." width="14" height="16" align="absmiddle" onclick=" return showCalendar('birthday','dd-mm-y');" onmouseover="this.style.cursor='hand'"; > 
                          &lt;&lt; ���͡�ѹ���</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" size="10" maxlength="10" value="<?echo $committeephone?>" onkeyup="doUnback_phone(value)"></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">����֡�� 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_education"  onChange="chkEdu(this.value);">
                            <option value="1">����Թ��ж�������º���</option>
                            <option value="2">�Ѹ���֡��</option>
                            <option value="3">͹ػ�ԭ��</option>
                            <option value="4">��ԭ�ҵ��</option>
                            <option value="5">�٧���һ�ԭ�ҵ��</option>
                          </select>
						  <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_education.length-1);i++) {
									if(document.form1.list_education.options[i].value=="<?echo $committeeedu?>") {
										document.form1.list_education.options[i].selected = true;
										break;
									}
								}
							</script>
							</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=left> &nbsp;&nbsp;&nbsp;8.1</td>
                        <td height="20" align="left" class="boxleft5">�زԡ���֡�� 
                          : </td>
                        <td align="left" class="boxleft5"> <select name="list_degree" >
                            <option value="1">��õ�Ҵ</option>
                            <option value="2">�ѭ��</option>
                            <option value="3">��������С�èѴ���</option>
                            <option value="4">�ɵ���ʵ��</option>
                            <option value="5">�ѧ����ʵ��</option>
                            <option value="6">����</option>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_education.length-1);i++) {
									if(document.form1.list_degree.options[i].value=="<?echo $committeedegree?>") {
										document.form1.list_degree.options[i].selected = true;
										break;
									}
								}
								chkEdu('<?=$committeeedu?>');
							</script>
							</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">�� ��.ʡ� 
                          ������� :</td>
                        <? 
						  		if($committeeamc=="1"){$showamc="checked";}
								else{$showamc2="checked";}
						  ?>
                        <td align="left" class="boxleft5">
						<input type="radio"   name="rdo_CommitteeAMC" value="1" <?echo $showamc?>>
                          �� 
                          <input type="radio" name="rdo_CommitteeAMC"    value="0" <?echo $showamc2?> > 
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
                              <?  if($committeesocial=="�����") {$socialno="checked";}
									else{$socialyes="checked"; $socialshow=$committeesocial;}
								//	echo $committeesocial;
							?>
                              <td width="25%" height="25" align="left" valign="middle"><input type="radio" name="rdo_CommitteeSocial"  Onclick="document.form1.txt_CommitteeSocial.disabled=false;" value="1"  <? echo $socialyes;?>>
                                �� (�к�)</td>
                              <td width="75%" height="20" align="left" valign="bottom"><input name="txt_CommitteeSocial" type="text" class="inputtypePersonnel100px"  value="<?echo $socialshow;?>" onkeyup="doUnback_socail(value)"></td>
                            </tr>
                            <tr> 
                              <td height="20" colspan="2" style="color:#666666;"><input type="radio" name="rdo_CommitteeSocial" value="0" checke onClick="document.form1.txt_CommitteeSocial.disabled=true;" <?echo $socialno;?> > 
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
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_Occu.length-1);i++) {
									if(document.form1.list_Occu.options[i].value=="<?echo $committeeoccu?>") {
										document.form1.list_Occu.options[i].selected = true;
										break;
									}
								}
							</script>
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
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_Occusecond.length-1);i++) {
									if(document.form1.list_Occusecond.options[i].value=="<?echo $committeeoccusecond?>") {
										document.form1.list_Occusecond.options[i].selected = true;
										break;
									}
								}
							</script></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>13.</td>
                        <td height="20" align="left" class="boxleft5">������� 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_address" class="areabox150" ><?echo $committeeadress?></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>14.</td>
                        <td height="20" align="left" class="boxleft5">�����˵� 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"><?echo $committeeremark?></textarea></td>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#666666;"> 
                        <td height="3" colspan="3" align=center> </td>
                    </table>
                    <br>
                    <input name="Submit2" type="button" class="formButton" value=" Back "onClick="jascript:history.go(-1)"  onMouseOver="this.style.cursor='hand'" >
                    &nbsp; 
                    <input name="Submit" type="submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'" >
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