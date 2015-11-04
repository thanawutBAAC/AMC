<? include ("checkuser.php");?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
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
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_personnel.gif" width="289" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");
				$Year=(date(Y)+543);
				if($list_education=="1" OR $list_education=="2") {$list_degree="0";}
		  		if($username!="" && $password!="")
				{
					echo $login_user;
			?>
            <a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a> 
            <?
				}	
			?>
            </span></span></td>
        </tr>
        <tr> 
          <td height="20" colspan="2" align="center" valign="middle"> 
            <?
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
							$numsql=mssql_num_rows($exsql);
							$P=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="personnel.php">
                <td align="center" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=12 align=left><b>&nbsp; แสดงข้อมูลปี 
                          <?
												$Ckgroup="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear DESC";
												$exCkgroup=mssql_query($Ckgroup);
												$data=mssql_fetch_array($exCkgroup);
												 if($data['PersonnelYear']==$Year)
														{
																$sqlyear=" SELECT DISTINCT (PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear DESC ";
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
						</script></b>
                          <input name="Submit" type="Submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'">
                          <?  if($SendYear==$Year OR $SendYear=="")
								{
								echo '<span class="txtwhite"> | </spand><img src="images/add_02.gif" width="11" height="10">&nbsp;<a href="personnel_add.php" class="link_menu">เพิ่มข้อมูลใหม่</a>';
								}
						?>
                          </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="4%" height="25">ลำดับ</td>
                        <td width="11%">ตำแหน่ง</td>
                        <td width="12%" height="25" align="center">รหัสประชาชน</td>
                        <td width="10%" align="center"><br>
                          ชื่อ<br> <br> </td>
                        <td width="10%" align="center">นามสกุล</td>
                        <td width="5%">อายุ</td>
                        <td width="6%">ปีที่<br>
                          เข้าทำงาน</td>
                        <td width="13%">วุฒิการศึกษา</td>
                        <td width="12%">ระดับการศึกษา</td>
                        <td width="7%">โทรศัพท์</td>
                        <td width="5%">แก้ไข</td>
					<?
					 if($SendYear==$Year OR $SendYear=="")
							{
					?>
						<td width="5%">ลบข้อมูล</td>
					<?
							}
					?>
                      </tr>
                      <?
					/*----------------------------------------------- $sql2 ไว้สำหรับลิสบล๊อค ------------------------------*/		
							/*	$sql2="SELECT *  ";
								$sql2.=" FROM PersonnelCode ";
								$sql2.=" WHERE PersonnelType <> '01' AND PersonnelType <> '02' AND PersonnelType <> '03' ";
								$sql2.=" AND PersonnelType <> '04' AND PersonnelType <> '05'";
								$exsql2=mssql_query($sql2);
					/*-----------------------------------------------------------------------------------------------------------------*/	
								
						
							
								while($rowall=mssql_fetch_row($exsql)) 
									{
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
								$a=substr($rowall[11],6,4);
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
									if($rowall[13]=="1"){echo "ไม่เกินประถมหรือเทียบเท่า";}
									if($rowall[13]=="2"){echo "มัธยมศึกษา";}
									if($rowall[13]=="3"){echo "อนุปริญญา";}
									if($rowall[13]=="4"){echo "ปริญญาตรี";}
									if($rowall[13]=="5"){echo "สูงกว่าปริญญาตรี";}
									//echo "11";
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
									if($rowall[14]=="1"){echo "การตลาด";}
									if($rowall[14]=="2"){echo "บัญชี";}
									if($rowall[14]=="3"){echo "บริหารและการจัดการ";}
									if($rowall[14]=="4"){echo "เกษตรศาสตร์";}
									if($rowall[14]=="5"){echo "สังคมศาสตร์";}
									if($rowall[14]=="6"){echo "อื่นๆ";}
									
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>" type="text" class="Assetsize" style="text-align: left;" maxlength="10" value="<? if($rowall[15]==""){ echo "-";} else { echo $rowall[15];}?>" readonly=""></td>
					    <td style="color:#FF0080;border:1px solid #F0F0F0;"><a href="personnel_update.php?personnelid=<?echo $rowall[4]?>&personnelyear=<?echo $rowall[8]?>&committeeyear=<?echo $rowall[8]?>&personneltype=<?echo $rowall[5]?>"><img src="images/update.gif" width="14" height="13" border="0"></a> 
                        </td>
						<?
						 if($SendYear==$Year OR $SendYear=="")
								{
						?>                        
							<td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลพนักงาน : <?echo $rowall[4].' '.$rowall[5]?>')){ window.location='personnel_delete.php?AMCCode=<?=$amc?>&user_id=<?echo $rowall[4]?>&PersonnelYear=<?echo $rowall[8]?>';}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ลบข้อมูลพนักงาน (<?echo $rowall[4].' '.$rowall[5]; ?>)"></a> 
						<?
								}
						?>
                        </td>
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
					  ?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="18" colspan="12" align=left>&nbsp;&nbsp;&nbsp; 
                          
                          <?  if($SendYear==$Year OR $SendYear=="")
								{
								echo '<img src="images/add.gif.gif" width="11" height="10"><a href="personnel_add.php"> เพิ่มข้อมูลใหม่</a>';
								}
						?>
                        </td>
                      </tr>
                    </table>
                    <br>
                    <br>
                    <input type="hidden" name="row" value="<?=($i-1)?>">
                    <input name="Submit2" type="button" class="formButton" value=" Back " onClick="self.location.href=('amc.php')"  onMouseOver="this.style.cursor='hand'" > 
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
