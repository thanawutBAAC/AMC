<?include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><br>
            <br>
            <img src="images/head_personnel.gif" width="289" height="23"><br>
          </td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr> 
          <td height="20" colspan="2" align="center" valign="middle"> 
            <?
							include("../lib/ms_database.php");
									if($SendYear=="")
										{ $Year2=$Year-1;  }
									if($SendYear<>"")
										{$Year2=$SendYear-1; }
							
							$Cktop="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc'  ORDER BY PersonnelYear DESC";
							$exCktop =mssql_query($Cktop);
							$datatop = mssql_fetch_array($exCktop);
/*
							$sql=" SELECT B.AMCCode,C.Amcprovince, C.userdetail,C.br_code, B.PersonnelID,A.PersonnelType,A.PersonnelCategory,D.PersonnelName,A.PersonnelYear, ";
							$sql.=" B.PersonnelName,B.PersonnelLsname,B.PersonnelBrithday, B.PersonnelWorking, B.PersonnelEducation, B.PersonnelDegree, ";
							$sql.=" B.PersonnelPhone,B.PersonnelAddress,B.PersonnelRemark ";
							$sql.=" FROM PersonnelGroup A ";
							$sql.=" RIGHT JOIN( ";
							$sql.=" SELECT * FROM PersonnelDetail  ";
							$sql.=" )AS B ON B.PersonnelID=A.PersonnelID AND B.AMCCode = A.AMCCode ";
							$sql.=" RIGHT JOIN( ";
							$sql.=" SELECT AMCCode, Amcprovince,userdetail,br_code FROM Userlogin  ";
							$sql.=" )AS C ON B.AMCCode = C.AMCCode ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT * FROM PersonnelCode ";
							$sql.=" )AS D ON A.PersonnelType=D.PersonnelType AND A.PersonnelCategory=D.PersonnelCategory ";
*/
							$sql=" SELECT A.AMCCode,C.Amcprovince, C.userdetail,C.br_code, B.MemberID,A.PersonnelType, ";
							$sql.=" A.PersonnelCategory,D.PersonnelName,A.PersonnelYear, B.MemberName,B.MemberLastname,  ";
							$sql.=" B.MemberBirthday, B.MemberWorking, B.MemberEducation, B.MemberDegree, B.MemberPhone, ";
							$sql.=" B.MemberAddress,B.MemberRemark  ";
							$sql.=" FROM PersonnelGroup A  ";
							$sql.=" RIGHT JOIN( SELECT * FROM AMCCustomer ) AS B ON B.MemberID=A.PersonnelID  ";
							$sql.=" RIGHT JOIN( SELECT AMCCode, Amcprovince,userdetail,br_code FROM Userlogin )  ";
							$sql.=" AS C ON A.AMCCode = C.AMCCode LEFT JOIN ( SELECT * FROM PersonnelCode )  ";
							$sql.=" AS D ON A.PersonnelType=D.PersonnelType AND A.PersonnelCategory=D.PersonnelCategory  ";


							$sql.=" WHERE A.AMCCode='$amc' ";
									if($SendYear=="")
										{ $sql.=" AND A.PersonnelYear='$Year' "; }
									if($SendYear<>"")
										{ $sql.=" AND  A.PersonnelYear='$SendYear'";}
							$sql.=" ORDER BY  A.PersonnelType, A.PersonnelID ";
							
							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							$numsql=mssql_num_rows($exsql);
							$P=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="personnel.php">
                <td align="center" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=14 align=left class="boxright15"><b>&nbsp; �ʴ������Ż� 
                          <?
												$Ckgroup="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear DESC";
												$exCkgroup=mssql_query($Ckgroup);
												$data=mssql_fetch_array($exCkgroup);
												 if($data['PersonnelYear']==$Year)
														{
																$sqlyear=" SELECT DISTINCT (PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear DESC ";
																$exsqlyear=mssql_query($sqlyear);
																echo ' <select name="SendYear">';
																//echo '<option>���͡��</option>';
																//echo $sqlyear;
																	while($rowall=mssql_fetch_row($exsqlyear))
																		{
																			echo '<option value="'.$rowall[0].'" >'.$rowall[0].'</opton>' ;
																		}
														
																echo '</select>';
														}
					
												if($data['PersonnelYear']<$Year AND $data['PersonnelYear']<>"")
													{
															$Cklast="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear ";
															$exCklast=mssql_query($Cklast);
															$datalast=mssql_fetch_array($exCklast);
															//echo $Cklast;
															//echo $datalast['CommitteeGroup'];
																echo '<select name="SendYear">';
																for($i=$Year; $i>=$datalast['PersonnelYear']; $i--)
																		{
																				echo '<option value="'.$i.'">'.$i.'</option>';
																		
																		}
																echo '</select>';
													}
													
												if($data['PersonnelYear']=="")
													{
															echo '<select name="SendYear">';
															echo '<option value="'.$Year.'">'.$Year.'</option>';
															echo '</select>';
													}
									?>
                          <script language=JAVAScript> 
										for(i=0;i<=(document.form1.SendYear.length-1);i++) {
											if(document.form1.SendYear.options[i].value=="<? echo $SendYear ?>") {
												document.form1.SendYear.options[i].selected = true;
												break;
											}
										}
						</script>
                          </b> <input name="Submit" type="Submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'"> 
                          <?  
								echo '<span class="txtwhite"> | </spand><img src="images/add_02.gif" width="11" height="10">&nbsp;<a href="personnel_add.php" class="link_menu">��������������</a>';
						?>
                        </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="20" height="25">�ӴѺ</td>
                        <td width="100">���˹�</td>
                        <td width="120" height="25" align="center">���ʻ�ЪҪ�</td>
                        <td width="100" align="center"><br>
                          ����<br> <br> </td>
                        <td width="100" align="center">���ʡ��</td>
                        <td width="40">����</td>
                        <td width="60">�շ��<br>
                          ��ҷӧҹ</td>
                        <td width="100">�زԡ���֡��</td>
                        <td width="100">�дѺ����֡��</td>
                        <td width="80">���Ѿ��</td>
                        <td colspan="4">Action</td>
                      </tr>
                      <?
					/*----------------------------------------------- $sql2 �������Ѻ��ʺ��ͤ ------------------------------*/		
							/*	$sql2="SELECT *  ";
								$sql2.=" FROM PersonnelCode ";
								$sql2.=" WHERE PersonnelType <> '01' AND PersonnelType <> '02' AND PersonnelType <> '03' ";
								$sql2.=" AND PersonnelType <> '04' AND PersonnelType <> '05'";
								$exsql2=mssql_query($sql2);
					/*-----------------------------------------------------------------------------------------------------------------*/	
								
						
							
								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[8]<>($Year2+1)) {break;}

											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
					  ?>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center> 
                          <?=$P;?>
                        </td>
                        <td height="20" align="left" class="boxleft10"> 
                          <?
									echo $rowall[7];
									$b1=substr($rowall[4],0,1); 
									$b2=substr($rowall[4],1,4);
									$b3=substr($rowall[4],5,5);
									$b4=substr($rowall[4],10,2);
									$b5=substr($rowall[4],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                        </td>
                        <td height="20" ><input name="user_showid?>" type="text" class="Assetsize" style="text-align: center;" value="<?=$show_id; ?>" maxlength="13" readonly=""> 
                          <input type="hidden" name="user_id<?=$i?>" value="<?echo $rowall[4];?>"></td>
                        <td height="20" ><input name="name<?=$i?>2" type="text" class="Assetsize"  value="<?echo $rowall[9];?>" readonly=""></td>
                        <td height="20" ><input name="lsname<?=$i?>" type="text" class="Assetsize" value="<?echo $rowall[10];?>" readonly=""></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
								$a=substr(trim($rowall[11]),-4);
								$b =(date('Y')+543);
								if(($b-$a)=="0"){echo "1";}
								else{echo $b-$a;}
							  ?>
                              </td>
                            </tr>
                          </table>
                          <b> </b></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"> <table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?

									{echo $rowall[12];}
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
									if($rowall[13]=="1"){echo "����Թ��ж�������º���";}
									if($rowall[13]=="2"){echo "�Ѹ���֡��";}
									if($rowall[13]=="3"){echo "͹ػ�ԭ��";}
									if($rowall[13]=="4"){echo "��ԭ�ҵ��";}
									if($rowall[13]=="5"){echo "�٧���һ�ԭ�ҵ��";}
									//echo "11";
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
									if($rowall[14]=="1"){echo "��õ�Ҵ";}
									if($rowall[14]=="2"){echo "�ѭ��";}
									if($rowall[14]=="3"){echo "��������С�èѴ���";}
									if($rowall[14]=="4"){echo "�ɵ���ʵ��";}
									if($rowall[14]=="5"){echo "�ѧ����ʵ��";}
									if($rowall[14]=="6"){echo "����";}
									
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>" type="text" class="Assetsize" style="text-align: left;" maxlength="10" value="<? if($rowall[15]==""){ echo "-";} else { echo $rowall[15];}?>" readonly=""></td>
                        <td width="25" style="color:#FF0080;border:1px solid #F0F0F0;"><a href="personnel_update.php?personnelid=<?echo $rowall[4]?>&personnelyear=<?echo $rowall[8]?>&personneltype=<?echo $rowall[5]?>"><img src="images/update.gif" alt="��䢢��������˹�ҷ�� (<?echo $rowall[9].' '.$rowall[10]?>)" width="14" height="13" border="0"></a> 
                        </td>
                        <td width="25" bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����ž�ѡ�ҹ : <?echo $rowall[4].' '.$rowall[5]?>')){ window.location='personnel_delete.php?AMCCode=<?=$amc?>&user_id=<?echo $rowall[4]?>&PersonnelYear=<?echo $rowall[8]?>';}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����ž�ѡ�ҹ (<?echo $rowall[4].' '.$rowall[5]; ?>)"></a> 
                        </td>
                        <td width="25" bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><a href="testing_add.php?position=<?echo $rowall[7]; ?>&USER_ID=<?echo $rowall[4]?>&name=<?echo $rowall[9]?>&lastname=<?echo $rowall[10]?>&ID=<?echo $show_id?>&type=personnel&position=<?echo $rowall[7]?>&PositionID=<?echo $rowall[5]?>"><img src="../TreeImages/vcard_edit.png" border="0" alt="��������ѵԡ�ý֡ͺ��"></a></td>
                        <td width="25" bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;">
						<? if($Year<>$Year){?>
						<a href="personnel_add.php?USER_ID=<?echo $rowall[4]?>&personnelgroup=<?echo $rowall[8];?>"><img src="images/checked.gif" alt="�ѹ�֡������ (<?echo $rowall[9].' '.$rowall[10]?>) 㹻նѴ�" width="13" height="13" border="0"></a></td>
                      <?}?>
					  </tr>
                      <?
					  			$P++;
					  		}

						$p=$row-$a;
						//echo $row;
						//echo $p;						
						if($row>$a)
							{
								for($b=1;$b<=$p;$b++)
								{
					  ?>
                      <?
								$i++;
					  			}
					  		}
							if($numrows=="0"){
					  ?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="30" colspan="14"><span class="txtred"> ��辺������㹻չ��</span>
                        </td>
                      </tr>
					  <?}?>
					  
					    <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="10" colspan="14" align=left> 
                        </td>
                      </tr>
                      <tr align=center bgcolor="#92AED1" class=font1> 
                        <td height="25" colspan="14" align=left>&nbsp;&nbsp;<b>&nbsp; 
                          ��������͹��ѧ 1 ��</b></td>
                      </tr>
					  <?
							$sql=" SELECT A.AMCCode,C.Amcprovince, C.userdetail,C.br_code, B.MemberID,A.PersonnelType, ";
							$sql.=" A.PersonnelCategory,D.PersonnelName,A.PersonnelYear, B.MemberName,B.MemberLastname,  ";
							$sql.=" B.MemberBirthday, B.MemberWorking, B.MemberEducation, B.MemberDegree, B.MemberPhone, ";
							$sql.=" B.MemberAddress,B.MemberRemark  ";
							$sql.=" FROM PersonnelGroup A  ";
							$sql.=" RIGHT JOIN( SELECT * FROM AMCCustomer ) AS B ON B.MemberID=A.PersonnelID  ";
							$sql.=" RIGHT JOIN( SELECT AMCCode, Amcprovince,userdetail,br_code FROM Userlogin )  ";
							$sql.=" AS C ON A.AMCCode = C.AMCCode LEFT JOIN ( SELECT * FROM PersonnelCode )  ";
							$sql.=" AS D ON A.PersonnelType=D.PersonnelType AND A.PersonnelCategory=D.PersonnelCategory  ";


							$sql.=" WHERE A.AMCCode='$amc' ";
									if($SendYear=="")
										{ $sql.=" AND A.PersonnelYear='$Year2' "; }
									if($SendYear<>"")
										{ $sql.=" AND  A.PersonnelYear='$Year2'";}
										
										
							$sql.=" ORDER BY  A.PersonnelType, A.PersonnelID ";
							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							$AA=1;
								while($rowall=mssql_fetch_row($exsql)) 
									{
					  
					  ?>
					  
						<tr align=center <? if($rowall[8]==$Year2 ){echo 'bgcolor="#FFEEE4"';}else{echo 'bgcolor="#F0F0F0" ';} ?> style="color:#666666;"> 
                        <td height="20" align=center> 
                          <?=$AA;?>
                        </td>
                        <td height="20" align="left" class="boxleft10"> 
                          <?
									echo $rowall[7];
									$b1=substr($rowall[4],0,1); 
									$b2=substr($rowall[4],1,4);
									$b3=substr($rowall[4],5,5);
									$b4=substr($rowall[4],10,2);
									$b5=substr($rowall[4],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                        </td>
                        <td height="20" ><input name="user_showid?>" type="text" class="Assetsize" style="text-align: center;" value="<?=$show_id; ?>" maxlength="13" readonly=""> 
                          <input type="hidden" name="user_id<?=$i?>" value="<?echo $rowall[4];?>"></td>
                        <td height="20" ><input name="name<?=$i?>2" type="text" class="Assetsize"  value="<?echo $rowall[9];?>" readonly=""></td>
                        <td height="20" ><input name="lsname<?=$i?>" type="text" class="Assetsize" value="<?echo $rowall[10];?>" readonly=""></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
								$a=substr(trim($rowall[11]),-4);
								$b =(date('Y')+543);
								if(($b-$a)=="0"){echo "1";}
								else{echo $b-$a;}
							  ?>
                              </td>
                            </tr>
                          </table>
                          <b> </b></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"> <table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?

									{echo $rowall[12];}
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
									if($rowall[13]=="1"){echo "����Թ��ж�������º���";}
									if($rowall[13]=="2"){echo "�Ѹ���֡��";}
									if($rowall[13]=="3"){echo "͹ػ�ԭ��";}
									if($rowall[13]=="4"){echo "��ԭ�ҵ��";}
									if($rowall[13]=="5"){echo "�٧���һ�ԭ�ҵ��";}
									//echo "11";
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
									if($rowall[14]=="1"){echo "��õ�Ҵ";}
									if($rowall[14]=="2"){echo "�ѭ��";}
									if($rowall[14]=="3"){echo "��������С�èѴ���";}
									if($rowall[14]=="4"){echo "�ɵ���ʵ��";}
									if($rowall[14]=="5"){echo "�ѧ����ʵ��";}
									if($rowall[14]=="6"){echo "����";}
									
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>" type="text" class="Assetsize" style="text-align: left;" maxlength="10" value="<? if($rowall[15]==""){ echo "-";} else { echo $rowall[15];}?>" readonly=""></td>
                        <td width="25" style="color:#FF0080;border:1px solid #F0F0F0;"><a href="personnel_update.php?personnelid=<?echo $rowall[4]?>&personnelyear=<?echo $rowall[8]?>&committeeyear=<?echo $rowall[8]?>&personneltype=<?echo $rowall[5]?>"><img src="images/update.gif" alt="��䢢��������˹�ҷ�� (<?echo $rowall[9].' '.$rowall[10]?>)" width="14" height="13" border="0"></a> 
                        </td>
                        <td width="25" bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����ž�ѡ�ҹ : <?echo $rowall[4].' '.$rowall[5]?>')){ window.location='personnel_delete.php?AMCCode=<?=$amc?>&user_id=<?echo $rowall[4]?>&PersonnelYear=<?echo $rowall[8]?>';}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����ž�ѡ�ҹ (<?echo $rowall[4].' '.$rowall[5]; ?>)"></a> 
                        </td>
                        <td width="25" bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><a href="testing_add.php?position=<?echo $rowall[7]; ?>&USER_ID=<?echo $rowall[4]?>&name=<?echo $rowall[9]?>&lastname=<?echo $rowall[10]?>&ID=<?echo $show_id?>&type=personnel&position=<?echo $rowall[7]?>&PositionID=<?echo $rowall[5]?>"><img src="../TreeImages/vcard_edit.png" border="0" alt="��������ѵԡ�ý֡ͺ��"></a></td>
                        <td width="25" bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><a href="personnel_add.php?USER_ID=<?echo $rowall[4]?>&personnelgroup=<?echo $rowall[8];?>"><img src="images/checked.gif" alt="�ѹ�֡������ (<?echo $rowall[9].' '.$rowall[10]?>) 㹻նѴ�" width="13" height="13" border="0"></a></td>
                      </tr>
					  <? $AA++;} if($numrows=="0"){?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="30" colspan="14"><span class="txtred"> ��辺��������͹��ѧ</span>
                        </td>
                      </tr>
					  <?}?>					  
					 <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="18" colspan="14" align=left>&nbsp;&nbsp;&nbsp; 
                          <? 
								echo '<img src="images/add.gif.gif" width="11" height="10"><a href="personnel_add.php"> ��������������</a>';
						?>
                        </td>
                      </tr>
                    </table>
                    <br>
                    <br>
                    <input type="hidden" name="row" value="<?=($i-1)?>">
                  </td>
               </form></tr>
            </table></td>
        </tr>
      </table>
	  </td>
  </tr>
</table>
</body>
</html>
