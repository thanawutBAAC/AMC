<? include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="10" align="center" valign="middle"> 
            <?
							$Year=(date(Y)+543);
							include ("images/lib/ms_database.php");
							$sql=" SELECT B.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup,  ";
							$sql.=" A.Committeeoccasion,A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType,  ";
							$sql.=" C.CommitteeCategory, C.CommitteeName, B.CommitteeName,B.CommitteeLastname,  ";
							$sql.=" B.CommitteeBirhtDay, B.CommitteeAddress, B.CommitteePhone, B.CommitteeAMC, B.CommitteeEdu,  ";
							$sql.=" B.CommitteeSocial, B.CommitteeOccu, B.CommitteeOccuSecond, B.CommitteeRemark  ";
							$sql.=" FROM CommitteeGroup A  ";
							$sql.=" LEFT JOIN(SELECT * FROM CommitteeDetail)AS B ON A.CommitteeID=B.CommitteeID ";
							$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode) AS C ON A.CommitteeType=C.CommitteeType AND  ";
							$sql.=" A.CommitteeCategory=C.CommitteeCategory ";
							$sql.=" LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin  ";
							$sql.=" )AS D ON A.AMCCode=D.AMCCode  ";
							$sql.=" WHERE  A.AMCCode='$amc' ";
									if($SendYear=="")
										{ $sql.=" AND A.CommitteeGroup='$Year' "; }
									if($SendYear<>"")
										{ $sql.=" AND  A.CommitteeGroup='$SendYear'";}
								$sql.="ORDER BY C.CommitteeType ";
							//echo $sql.'<br>';
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$i=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="910" align="center" valign="top" ><form name="form1" method="GET" action="committee_show.php" target="AssetMain">
                    <table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td align="center"><table width="1450" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
                            <tr bgcolor="#92AED1" class="font1"> 
                              <td height="23" colspan="17" class="boxleft15" ><b>�ʴ������Ż�&nbsp;</b> 
										<?
												$Ckgroup="SELECT TOP 1(CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$amc' ORDER BY Committeegroup DESC";
												$exCkgroup=mssql_query($Ckgroup);
												$data=mssql_fetch_array($exCkgroup);
												 if($data['CommitteeGroup']==$Year)
														{
																$sqlyear=" SELECT DISTINCT (CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$amc' ORDER BY CommitteeGroup DESC ";
																$exsqlyear=mssql_query($sqlyear);
																echo ' <select name="SendYear">';
																//echo '<option>���͡��</option>';
																//echo $sqlyear;
																	while($rowall=mssql_fetch_row($exsqlyear))
																		{
																			echo '<option value="'.$rowall[0].' " >'.$rowall[0].'</opton>' ;
																		}
														
																echo '</select>';
														}
					
												if($data['CommitteeGroup']<$Year AND $data['CommitteeGroup']<>"")
													{
															$Cklast="SELECT TOP 1(CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$amc' ORDER BY Committeegroup ";
															$exCklast=mssql_query($Cklast);
															$datalast=mssql_fetch_array($exCklast);
															//echo $Cklast;
															//echo $datalast['CommitteeGroup'];
																echo '<select name="SendYear">';
																for($i=$Year; $i>=$datalast['CommitteeGroup']; $i--)
																		{
																				echo '<option value="'.$i.'">'.$i.'</option>';
																		
																		}
																echo '</select>';
													}
													
												if($data['CommitteeGroup']=="")
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
                                <input name="Submit" type="Submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'"> 
                              </td>
                            </tr>
                            <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                              <td width="30" height="35" rowspan="2">�ӴѺ</td>
                              <td width="110" rowspan="2">���˹�</td>
                              <td width="130" rowspan="2">���ʻ�ЪҪ�</td>
                              <td width="100" rowspan="2">����</td>
                              <td width="100" rowspan="2">���ʡ��</td>
                              <td width="40" rowspan="2">����</td>
                              <td width="200" rowspan="2">�������</td>
                              <td width="80" rowspan="2" >�������Ѿ��</td>
                              <td height="20" colspan="2">��ô�ç���˹�</td>
                              <td width="50" rowspan="2">�� <br>
                                ��.ʡ�.</td>
                              <td width="150" rowspan="2">�زԡ���֡��<br>
                                �٧�ش</td>
                              <td width="80" rowspan="2">ʶҹзҧ�ѧ��</td>
                              <td width="100" rowspan="2">�Ҫվ��ѡ</td>
                              <td width="100" rowspan="2">�Ҫվ�ͧ</td>
                              <td width="120" rowspan="2">�����˵�</td>
                              <td width="30" rowspan="2">ź</td>
                            </tr>
                            <tr align="center" bgcolor="#BBD0E1"> 
                              <td width="40" height="18">����</td>
                              <td width="40">��</td>
                            </tr>
                            <?
							while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
											$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
											$Education=array("","��ж�������º���","��ж� - �Ѹ���֡��"," �Ѹ���֡�� - ͹ػ�ԭ��","͹ػ�ԭ�� - ��ԭ�ҵ��","�٧���� ��ԭ�ҵ��");
											$AMC=array("<span class=txtred>�����</span>","��");
								?>
                            <tr bgcolor="#F0F0F0" style="color:#666666;"> 
                              <td height="20" align="center"> 
                                <?=$i;?>
                              </td>
                              <td align="left" class="boxleft5"> 
                                <?
									echo $rowall[12];
									$b1=substr($rowall[9],0,1); 
									$b2=substr($rowall[9],1,4);
									$b3=substr($rowall[9],5,5);
									$b4=substr($rowall[9],10,2);
									$b5=substr($rowall[9],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                              </td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="center" bgcolor="#FFFFFF"><?echo $show_id?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[13]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[14]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="center" bgcolor="#FFFFFF"> 
                                      <?
										$a=substr($rowall[15],6,4);
										$b =(date('Y')+543);
										echo $b-$a;
									  ?>
                                    </td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[16]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="center" bgcolor="#FFFFFF"><?echo $rowall[17]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="center" bgcolor="#FFFFFF"><?echo $rowall[6]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="center" bgcolor="#FFFFFF"><?echo $rowall[7]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="center" bgcolor="#FFFFFF"><?echo $AMC[$rowall[18]]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $Education[$rowall[19]]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5">
									<?
									if($rowall[20]=="�����"){ echo '<span class=txtred>�����</span>';}
									else{echo $rowall[20];}
									?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $Occu[$rowall[21]]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $Occu[$rowall[22]]?></td>
                                  </tr>
                                </table></td>
                              <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                                  <tr> 
                                    <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[23]?></td>
                                  </tr>
                                </table></td>
                              <td width="30" align="center">
							  <a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����Ť�С������ : <?echo $rowall[8].' '.$rowall[9]?>')){ window.location='committee_delete.php?AMCCode=<?=$amc?>&user_id=<?echo $rowall[9]?>';}"><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����Ť�С������ (<?echo $rowall[8].' '.$rowall[9]?>)"></a> 
							  </td>
                            </tr>
                            <?
									$i++;
									}	
							?>
                            <tr bgcolor="#F0F0F0"> 
                              <td colspan="17">&nbsp;&nbsp;&nbsp; <a href="committee_add.php"> 
                                ��������������</a></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
