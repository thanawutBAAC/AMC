<?include ("checkuser.php");?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
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
          <td height="10" align="center" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="29" valign="bottom" class="boxleft50"><br>
                  <br>
                  <img src="images/head_committee.jpg" width="330" height="23"></td>
                <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
              </tr>
            </table> 
            <br>
            <?
							//$Year=(date(Y)+543);
							include ("../lib/ms_database.php");
							$sql=" SELECT A.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup,  ";
							$sql.=" A.Committeeoccasion,A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType,  ";
							$sql.=" C.CommitteeCategory, C.CommitteeName, B.MemberName,B.MemberLastname, B.MemberBirthday,  ";
							$sql.=" B.MemberAddress, B.MemberPhone, A.CommitteeAMC, B.MemberEducation, A.CommitteeSocial,  ";
							$sql.=" B.MemberOccu, B.MemberOccuSecond, B.MemberRemark  ";
							
							$sql.=" FROM CommitteeGroup A  ";
							 
							$sql.=" LEFT JOIN( ";
							$sql.=" SELECT * FROM AMCCustomer) ";
							$sql.=" AS B ON A.CommitteeID=B.MemberID  ";
							
							$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode)  ";
							$sql.=" AS C ON A.CommitteeType=C.CommitteeType AND A.CommitteeCategory=C.CommitteeCategory  ";
							
							$sql.=" LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin ) ";
							$sql.=" AS D ON A.AMCCode=D.AMCCode  ";
							$sql.=" WHERE  A.AMCCode='$amc' ";
									if($SendYear=="")
										{ $Year2=$Year-1; $sql.=" AND A.CommitteeGroup='$Year'  "; }
									if($SendYear<>"")
										{$Year2=$SendYear-1;  $sql.=" AND A.CommitteeGroup='$SendYear' ";}
								$sql.="ORDER BY C.CommitteeType ";
						//echo $sql.'<br>';

							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							
							$P=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="top"><table width="0" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
              <form name="form1" method="GET" action="committee.php" >
                <tr bgcolor="#92AED1" class="font1"> 
                  <td height="23" colspan="21" class="boxleft15" ><b>แสดงข้อมูลปี&nbsp;</b> 
                    <?
												$Ckgroup="SELECT TOP 1(CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$amc' ORDER BY Committeegroup DESC";
												$exCkgroup=mssql_query($Ckgroup);
												$data=mssql_fetch_array($exCkgroup);
												 if($data['CommitteeGroup']==$Year)
														{
																$sqlyear=" SELECT DISTINCT (CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$amc' ORDER BY CommitteeGroup DESC ";
																$exsqlyear=mssql_query($sqlyear);
																echo ' <select name="SendYear">';
																//echo '<option>เลือกปี</option>';
																//echo $sqlyear;
																	while($rowall=mssql_fetch_row($exsqlyear))
																		{
																			echo '<option value="'.$rowall[0].'" >'.$rowall[0].'</opton>' ;
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
						</script> <input name="Submit" type="Submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'"> 
                    &nbsp; 
                    <? 
								echo '<span class="txtwhite"> | </spand><img src="images/add_02.gif" width="11" height="10">&nbsp;<a href="committee_add.php" class="link_menu">เพิ่มข้อมูลใหม่</a>';
						?>
                  </td>
                </tr>
                <tr bgcolor="#BBD0E1" style="color:#333333"> 
                  <td width="20" height="35" rowspan="2" align="center">ลำดับ</td>
                  <td width="100" rowspan="2" align="center">ตำแหน่ง</td>
                  <td width="120" rowspan="2" align="center" bgcolor="#BBD0E1">รหัสประชาชน</td>
                  <td width="100" rowspan="2" align="center">ชื่อ</td>
                  <td width="100" rowspan="2" align="center">นามสกุล</td>
                  <td width="50" rowspan="2" align="center">อายุ</td>
                  <td width="70" rowspan="2" align="center" >เบอร์โทรศัพท์</td>
                  <td height="20" colspan="2" align="center">การดำรงตำแหน่ง</td>
                  <td width="50" rowspan="2" align="center">เป็น <br>
                    คก.สกต.</td>
                  <td width="120" rowspan="2" align="center">วุฒิการศึกษา<br>
                    สูงสุด</td>
                  <td width="60" rowspan="2" align="center">สถานะ<br>
                    ทางสังคม</td>
                  <td width="50" rowspan="2" align="center">ปีบันทึก</td>
                  <td colspan="4" rowspan="2" align="center">Action</td>
                </tr>
                <tr align="center" bgcolor="#BBD0E1"> 
                  <td width="10" height="18">วาระ</td>
                  <td width="10">ปี</td>
                </tr>
                <?
							while($rowall=mssql_fetch_row($exsql)) 
									{
											
											if($rowall[5]<>($Year2+1)) {break;}

											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
											$Occu=array("","เป็นเกษตรกร","ทำการค้าขาย","รับราชการ","อื่นๆ") ;/// อาชีพ
											$Education=array("","ประถมหรือเทียบเท่า","มัธยมศึกษา"," อนุปริญญา","ปริญญาตรี","สูงกว่า ปริญญาตรี");
											$AMC=array("<span class=txtred>ไม่เป็น</span>","เป็น","-");
								?>
                <tr <? if($rowall[5]==$Year2 ){echo 'bgcolor="#FFEEE4"';}else{echo 'bgcolor="#F0F0F0" ';} ?> style="color:#666666;"> 
                  <td height="20" align="center"> 
                    <?=$P;?>
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
										$a=substr(trim($rowall[15]),-4);
										$b =(date('Y')+543);
										echo $b-$a;
							?>
                        </td>
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
                        <td align="center" bgcolor="#FFFFFF" class="boxleft5"> 
                          <?
									if($rowall[20]=="ไม่มี"){ echo '<span class=txtred>ไม่มี</span>';}
									else{echo $rowall[20];}
							?>
                        </td>
                      </tr>
                    </table></td>
                  <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                      <tr> 
                        <td align="center" bgcolor="#FFFFFF" class="boxleft5"> 
                          <?
						  			if($rowall[5]==$Year2){echo '<span class=txtred>'.$rowall[5].'</span>';}else{echo $rowall[5];}
							?>
                        </td>
                      </tr>
                    </table></td>
                  <td width="25" align="center" valign="middle"><a href="committee_update.php?committeeid=<?echo $rowall[9]?>&committeeoccasion=<?echo $rowall[6]?>&committeeyear=<?echo $rowall[7]?>&comitteegroup=<?echo $rowall[5]?>&committeetype=<?echo $rowall[10]?>"><img src="images/update.gif" alt="แก้ไขข้อมูลคณะกรรมการ (<?echo $rowall[13].' '.$rowall[14]?>)" width="14" height="13" border="0"></a> 
                  </td>
                  <td width="25" align="center" valign="middle"><a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลคณะกรรมการ : <?echo $rowall[13].' '.$rowall[14]?>')){ window.location='committee_delete.php?AMCCode=<?=$amc?>&user_id=<?echo $rowall[9]?>&committeegroup=<?echo $rowall[5]?>';}"><img src="images/bin.gif" width="20" height="12" border="0" alt="ลบข้อมูลคณะกรรมการ (<?echo $rowall[13].' '.$rowall[14]?>)"></a></td>
                  <td width="30" align="center" valign="middle"><a href="testing_add.php?position=<?echo $rowall[12]; ?>&USER_ID=<?echo $rowall[9]?>&name=<?echo $rowall[13]?>&lastname=<?echo $rowall[14]?>&ID=<?echo $show_id?>&type=committee&position=<?echo $rowall[12];?>&PositionID=<?echo $rowall[10]?>"><img src="../TreeImages/vcard_edit.png" border="0" alt="เพิ่มประวัติการฝึกอบรม"></a></td>
                  <td width="25" align="center" valign="middle">
				 <? if($Year2<>$Year){?>
				  <a href="committee_add.php?USER_ID=<?echo $rowall[9]?>&committeegroup=<?echo $rowall[5];?>"><img src="images/checked.gif" alt="บันทึกข้อมูล (<?echo $rowall[13].' '.$rowall[14]?>) ในปีถัดไป" width="13" height="13" border="0"></a></td>
                <?}?>
				</tr>
                <?
									$P++;
									}
									if($numsql=="0"){	
							?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="30" colspan="17"><span class="txtred"> ไม่พบข้อมูลในปีนี้</span>
                        </td>
                      </tr>     
					 <?}?>          
				 <tr bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="10" colspan="17" align="center"> </td>
                </tr>
                <tr align="left" bgcolor="#BBD0E1" > 
                  <td height="25" colspan="17"  class="boxleft15" > <b>ข้อมูลคณะกรรมการย้อนหลัง 
                    1 ปี</b></b></td>
                </tr>				
               
			   
			   	<? 
					$AA=1;

							$sql=" SELECT A.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup,  ";
							$sql.=" A.Committeeoccasion,A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType,  ";
							$sql.=" C.CommitteeCategory, C.CommitteeName, B.MemberName,B.MemberLastname, B.MemberBirthday,  ";
							$sql.=" B.MemberAddress, B.MemberPhone, A.CommitteeAMC, B.MemberEducation, A.CommitteeSocial,  ";
							$sql.=" B.MemberOccu, B.MemberOccuSecond, B.MemberRemark  ";
							
							$sql.=" FROM CommitteeGroup A  ";
							 
							$sql.=" LEFT JOIN( ";
							$sql.=" SELECT * FROM AMCCustomer) ";
							$sql.=" AS B ON A.CommitteeID=B.MemberID  ";
							
							$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode)  ";
							$sql.=" AS C ON A.CommitteeType=C.CommitteeType AND A.CommitteeCategory=C.CommitteeCategory  ";
							
							$sql.=" LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin ) ";
							$sql.=" AS D ON A.AMCCode=D.AMCCode  ";
							$sql.=" WHERE  A.AMCCode='$amc' ";
									if($SendYear=="")
										{ $Year2=$Year-1; $sql.=" AND  A.CommitteeGroup='$Year2' "; }
									if($SendYear<>"")
										{$Year2=$SendYear-1;  $sql.=" AND A.CommitteeGroup='$Year2' ";}
								$sql.="ORDER BY C.CommitteeType ";
						//echo $sql.'<br>';

							$exsql2=mssql_query($sql);
							$numrows=mssql_num_rows($exsql2);
						//	echo $numrows;
							while($rowall=mssql_fetch_row($exsql2)) 
									{
											$Occu=array("","เป็นเกษตรกร","ทำการค้าขาย","รับราชการ","อื่นๆ") ;/// อาชีพ
											$Education=array("","ประถมหรือเทียบเท่า","มัธยมศึกษา"," อนุปริญญา","ปริญญาตรี","สูงกว่า ปริญญาตรี");
											$AMC=array("<span class=txtred>ไม่เป็น</span>","เป็น","-");

										//if($rowall[5]==$Year2){
				
				?>
			   
			    <tr <? if($rowall[5]==$Year2 ){echo 'bgcolor="#FFEEE4"';}else{echo 'bgcolor="#F0F0F0" ';} ?> style="color:#666666;"> 
                  <td height="20" align="center"> 
                    <?=$AA;?>
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
										$a=substr(trim($rowall[15]),-4);
										$b =(date('Y')+543);
										echo $b-$a;
							?>
                        </td>
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
                        <td align="center" bgcolor="#FFFFFF" class="boxleft5"> 
                          <?
									if($rowall[20]=="ไม่มี"){ echo '<span class=txtred>ไม่มี</span>';}
									else{echo $rowall[20];}
							?>
                        </td>
                      </tr>
                    </table></td>
                  <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
                      <tr> 
                        <td align="center" bgcolor="#FFFFFF" class="boxleft5"> 
                          <?
						  			if($rowall[5]==$Year2){echo '<span class=txtred>'.$rowall[5].'</span>';}else{echo $rowall[5];}
							?>
                        </td>
                      </tr>
                    </table></td>
                  <td width="25" align="center" valign="middle"><a href="committee_update.php?committeeid=<?echo $rowall[9]?>&committeeoccasion=<?echo $rowall[6]?>&committeeyear=<?echo $rowall[7]?>&comitteegroup=<?echo $rowall[5]?>&committeetype=<?echo $rowall[10]?>"><img src="images/update.gif" alt="แก้ไขข้อมูลคณะกรรมการ (<?echo $rowall[13].' '.$rowall[14]?>)" width="14" height="13" border="0"></a> 
                  </td>
                  <td width="25" align="center" valign="middle"><a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลคณะกรรมการ : <?echo $rowall[13].' '.$rowall[14]?>')){ window.location='committee_delete.php?AMCCode=<?=$amc?>&user_id=<?echo $rowall[9]?>&committeegroup=<?echo $rowall[5]?>';}"><img src="images/bin.gif" width="20" height="12" border="0" alt="ลบข้อมูลคณะกรรมการ (<?echo $rowall[13].' '.$rowall[14]?>)"></a></td>
                  <td width="30" align="center" valign="middle"><a href="testing_add.php?position=<?echo $rowall[12]; ?>&USER_ID=<?echo $rowall[9]?>&name=<?echo $rowall[13]?>&lastname=<?echo $rowall[14]?>&ID=<?echo $show_id?>&type=committee&position=<?echo $rowall[12];?>&PositionID=<?echo $rowall[10]?>"><img src="../TreeImages/vcard_edit.png" border="0" alt="เพิ่มประวัติการฝึกอบรม"></a></td>
                  <td width="25" align="center" valign="middle"><a href="committee_add.php?USER_ID=<?echo $rowall[9]?>&committeegroup=<?echo $rowall[5];?>"> 
                    <img src="images/checked.gif" alt="บันทึกข้อมูล (<?echo $rowall[13].' '.$rowall[14]?>) ในปีถัดไป" width="13" height="13" border="0"></a></td>
                </tr>
				<? $AA++;}//} 
					if($numrows=="0"){
				?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="12" colspan="17"><span class="txtred"> ไม่พบข้อมูลในปีนี้</span>
                        </td>
                      </tr>   
					  <?}?>  
				
                <tr bgcolor="#F0F0F0"> 
                  <td colspan="21">&nbsp;&nbsp;&nbsp; 
                    <? 
								echo '<img src="images/add.gif.gif" width="11" height="10"><a href="committee_add.php"> เพิ่มข้อมูลใหม่</a>';
						?>
                  </td>
                </tr>
              </form>
            </table>
            <br>
            <br>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
