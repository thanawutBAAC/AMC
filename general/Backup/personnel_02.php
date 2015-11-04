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
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>

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
            <a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a> 
            <?
				}	
			?>
            </span></span></td>
        </tr>
        <tr> 
          <td height="40" colspan="2" align="center" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="personnel_insertinto.php">
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=11 align=left><b>&nbsp; &nbsp;ข้อมูล 
                          ณ ปี</b></td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="4%" height="25">ลำดับ</td>
                        <td width="10%">ตำแหน่ง</td>
                        <td width="15%" height="25" align="center">รหัสประชาชน</td>
                        <td width="10%" align="center"><br>
                          ชื่อ<br> <br> </td>
                        <td width="10%" align="center">นามสกุล</td>
                        <td width="10%"> วัน/เดือน/ปีเกิด</td>
                        <td width="6%">ปีที่<br>
                          เข้าทำงาน</td>
                        <td width="12%">วุฒิการศึกษา</td>
                        <td width="8%">โทรศัพท์</td>
                        <td width="10%">หมายเหตุ</td>
                        <td width="5%">ลบข้อมูล</td>
                      </tr>
                      <?
					  		$sql="SELECT B.AMCCode,  A.Positions, A.PostionsName, B.User_ID,B.Name, B.Lsname, B.Birthday, ";
							$sql.=" B.Working, B.Education, B.phone, B.Remark ";
							$sql.=" FROM PersonnelCode A ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT *  ";
							$sql.=" FROM Personnel ";
							$sql.=" WHERE AMCCODE='$amc') AS B ";
							$sql.=" ON A.Positions = B.Positions ";
							$sql.=" WHERE A.Positions Between '01' AND '05' OR B.Positions <>'' ";
					  				
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$i=1;
							
							
								echo $sql;
					/*----------------------------------------------- $sql2 ไว้สำหรับลิสบล๊อค ------------------------------*/		
								$sql2="SELECT *  ";
								$sql2.=" FROM PersonnelCode ";
								$sql2.=" WHERE Positions <> '01' AND Positions <> '02' AND Positions <> '03' ";
								$sql2.=" AND Positions <> '04' AND Positions <> '05'";
								$exsql2=mssql_query($sql2);
					/*-----------------------------------------------------------------------------------------------------------------*/	
								
						
							
								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
					  ?>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center> 
                          <?$a=$a+1; echo"$a. ";?>
                        </td>
                        <td height="20" align="left" class="boxleft10"> <input type="hidden" name="amccode<?=$i?>" value="<?echo $rowall[0]?>"> 
                          <input name="positions<?=$i?>" type="hidden" value="<?echo $rowall[1]?>"> 
                          <input type="hidden" name="Update<?=$i?>" value="<?echo $Update?>"> 
                          <?
								//echo $i;
								if($rowall[1] <=05) { echo $rowall[2]; }
								else
									{
										echo '<select name="positions'.$i.'" >';
									while($rowall2=mssql_fetch_row($exsql2)) 
											{
												echo '<option value='.$rowall2[0].'>'.$rowall2[2].'</option>';
											//		echo $rowall2[0];
											}
											echo '</select>'; 
											

							?>
                          <script language=JAVAScript> 
												for(i=0;i<=(document.form1.positions<?=$i?>.length-1);i++) {
													
													if(document.form1.positions<?=$i?>.options[i].value=="<?echo $rowall[1]?>") {
														document.form1.positions<?=$i?>.options[i].selected = true;
														break;
													}
												}
											</script> 
                          <?	
											
										}
							?>
                        </td>
                        <td width="15%" height="20" ><input name="user_id<?=$i?>" type="text" class="Assetsize" style="text-align: center;" value="<?echo $rowall[3];?>" maxlength="13" readonly=""></td>
                        <td height="20" ><input name="name<?=$i?>" type="text" class="Assetsize"  value="<?echo $rowall[4];?>"></td>
                        <td height="20" ><input name="lsname<?=$i?>" type="text" class="Assetsize" value="<?echo $rowall[5];?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="80%"><b> 
                                <input name="birthday<?=$i?>" type="text" id="birthday<?=$i?>" value="<?echo $rowall[6];?>" size="10" maxlength="10" readonly="" class="Assetsize">
                                </b></td>
                              <td width="20%" align="center"><b><img src="images/calendar_02.gif" alt=".เลือกวันที่." width="14" height="16" align="absmiddle" onclick=" return showCalendar('birthday<?=$i?>','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></b></td>
                            </tr>
                          </table>
                          <b> </b></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"> <select name="working<?=$i?>">
                            <?
									  $date=getdate(); // อ่านวันที่ของเครื่องเก็บที่ตังวแปร $date
									  $year=$date[year]+543; //แปลง ค.ศ ของเครื่องให้เป็น พ.ศ เก็บไว้ที่ตัวแปร $year
									  for ($x=$year;$x>=2540;$x--)  // วนลูปปี พ.ศ ปัจจุบันย้นไป 5 ปี
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
                          </select> </td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"> <select name="education<?=$i?>" >
                            <option value="1">ไม่เกินประถมหรือเทียบเท่า</option>
                            <option value="2">ประถมศึกษา - มัธยมศึกษา</option>
                            <option value="3">มัธยมศึกษา - อนุปริญญา</option>
                            <option value="4">อนุปริญญา - ปริญญาตรี</option>
                            <option value="5">สูงกว่าปริญญาตรี</option>
                          </select> </td>
                        <script language=JAVAScript> 
								for(i=0;i<=(document.form1.education<?=$i?>.length-1);i++) {
									if(document.form1.education<?=$i?>.options[i].value=="<?echo $rowall[8]?>") {
										document.form1.education<?=$i?>.options[i].selected = true;
										break;
									}
								}
							</script>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>" type="text" class="Assetsize" style="text-align: right;" maxlength="10" value="<?echo $rowall[9]?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="remark<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[10]?>"></td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <?
									if($rowall[0]!="")
										{
							?>
                          <a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลด้านบุคลากร : <?echo $rowall[4].' '.$rowall[5]?>')){ window.location='personnel_delete.php?AMCCode=<?=$amc?>&positions=<?echo $rowall[1]?>&user_id=<?echo $rowall[3]?>';}"><img src="images/bin.gif" width="20" height="12" border="0"></a> 
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
                        <td height="18" colspan="11" align=left>&nbsp;&nbsp;&nbsp; 
                          <a href="personnel.php?row=<?echo $a+1;?>&new=1">เพิ่มรายการใหม่</a> 
                          <b> 
                          <input type="hidden" name="row" value="<?=$a;?>">
                          </b></td>
                      </tr>
                    </table>
                    <br>
                    <input name="Submit2" type="submit" class="formButton" value="Submit">
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset">
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
