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
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr> 
          <td height="20" colspan="2" align="center" valign="middle"> 
            <?
							include("../lib/ms_database.php");
							$Cktop="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc'  ORDER BY PersonnelYear DESC";
							$exCktop =mssql_query($Cktop);
							$datatop = mssql_fetch_array($exCktop);

							$sql=" SELECT B.AMCCode,C.Amcprovince, C.userdetail,C.br_code, B.PersonnelID,A.PersonnelType,A.PersonnelCategory,D.PersonnelName,A.PersonnelYear, ";
							$sql.=" A.PersonnelStatus,B.PersonnelName,B.PersonnelLsname,B.PersonnelBrithday, B.PersonnelWorking, B.PersonnelEducation, ";
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
							$sql.=" WHERE A.AMCCode='$amc' ";
								if($datatop['PersonnelYear']==$Year)
									{
										$sql.=" AND A.PersonnelYear='$Year'  ";
									}
								if($atattop['PersonnelYear']<$Year)
									{
										$sql.="AND A.PersonnelYear='$datatop[0]' ";  //$datatop[0] = $datatop['PersonnelYear']
									}
							$sql.=" ORDER BY  A.PersonnelStatus DESC, A.PersonnelID ";
							
							//echo $sql;
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$i=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="personnel_update.php">
                <td align="center" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=12 align=left><b>&nbsp; &nbsp;แสดงข้อมูลปี  <? echo $datatop[0];?>
                          </b></td>
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
                        <td width="7%">โทรศัพท์</td>
                        <td width="12%">หมายเหตุ</td>
                        <td width="5%">สถานะ<br>
                          พนักงาน</td>
                        <td width="5%">ลบข้อมูล</td>
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
                          <?=$i;?>
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
                        <td height="20" ><input name="name<?=$i?>2" type="text" class="Assetsize"  value="<?echo $rowall[10];?>" readonly=""></td>
                        <td height="20" ><input name="lsname<?=$i?>" type="text" class="Assetsize" value="<?echo $rowall[11];?>" readonly=""></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma">
							  <?
								$a=substr($rowall[12],6,4);
								$b =(date('Y')+543);
								echo $b-$a;
							  ?>
                              </td>
                            </tr>
                          </table>
                          <b> </b></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"> <table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?

									{echo $rowall[13];}
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="98%" height="17" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td height="15" align="center" bgcolor="#FFFFFF" class="tohoma"> 
                                <?
									if($rowall[14]=="1"){echo "ไม่เกินประถมหรือเทียบเท่า";}
									if($rowall[14]=="2"){echo "ประถมศึกษา - มัธยมศึกษา";}
									if($rowall[14]=="3"){echo "มัธยมศึกษา - อนุปริญญา";}
									if($rowall[14]=="4"){echo "อนุปริญญา - ปริญญาตรี";}
									if($rowall[14]=="5"){echo "สูงกว่าปริญญาตรี";}
								?>
                              </td>
                            </tr>
                          </table></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>" type="text" class="Assetsize" style="text-align: left;" maxlength="10" value="<? if($rowall[15]==""){ echo "-";} else { echo $rowall[15];}?>" readonly=""></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="remark<?=$i?>" type="text" class="Assetsize" style="text-align: left;" value="<? if($rowall[17]==""){ echo "-";} else { echo $rowall[17];}?>" readonly=""></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;">
						<?
							if($datatop[0]==$Year)
								{
										if($rowall[9]=="1") {$check ="checked";}
										if($rowall[9]=="0") {$check ="";}
								}
								//echo $rowall[10];
								//echo $check;
						?>
						<input type="checkbox" name="status<?=$i?>"   <? echo $check;?> ></td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <?
									if($rowall[0]!="")
										{
							?>
                          <a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลพนักงาน : <?echo $rowall[4].' '.$rowall[5]?>')){ window.location='personnel_delete.php?AMCCode=<?=$amc?>&positions=<?echo $rowall[1]?>&user_id=<?echo $rowall[3]?>';}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ลบข้อมูลพนักงาน (<?echo $rowall[4].' '.$rowall[5]; ?>)"></a> 
                          <?
										}
							?>
                        </td>
                      </tr>
                      <?
					  			$i++;
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
                          <a href="personnel_add.php"> เพิ่มข้อมูลใหม่</a></td>
                      </tr>
                    </table>
                    <br>
                    <br>
                    <input type="hidden" name="row" value="<?=($i-1)?>">
                    <input name="Submit2" type="submit" class="formButton" value="Submit"  onClick="javascript: if(confirm('บันทึกข้อมูล')){ window.location='personnel_update.php';}"> 
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
