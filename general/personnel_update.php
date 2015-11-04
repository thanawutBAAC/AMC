<?include ("checkuser.php");?>
<html>
<head>

<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<link href=".inputtype_personal" rel="stylesheet" type="text/css">
</head>
<?
						  		include("../lib/ms_database.php");
								$sqlall=" SELECT A.AMCCode,A.PersonnelID,A.PersonnelType,A.PersonnelCategory,C.PersonnelName, ";
								$sqlall.=" A.PersonnelYear, B.MemberName,B.MemberLastname,B.MemberBirthday, B.MemberWorking, ";
								$sqlall.=" B.MemberEducation,B.MemberDegree, B.MemberPhone,B.MemberAddress, B.MemberRemark  ";
								$sqlall.=" FROM PersonnelGroup A ";
								$sqlall.="  LEFT JOIN  ";
								$sqlall.=" (SELECT * FROM AMCCustomer)AS B ON A.PersonnelID = B.MemberID ";
								$sqlall.="  LEFT JOIN (SELECT * FROM PersonnelCode)AS C ON A.PersonnelType=C.PersonnelType  ";
								$sqlall.=" WHERE A.AMCCode='$amc' AND A.PersonnelID='$personnelid' AND A.PersonnelYear='$personnelyear' AND A.PersonnelType='$personneltype'";
								$exsqlall=mssql_query($sqlall);
								//echo $sqlall;
								$data=mssql_fetch_row($exsqlall);
								$AMCCode=$data[0];
								$PersonnelType=$data[2];
								$PersonnelCategory=$data[3];
								$PersonnelTypename=$data[4];
								$PersonnelYear=$data[5];
								//$MemberHelp=$data[6];
							//	$MemberHelpBranch=$data[7];
								$PersonnelName=$data[6];
								$PersonnelLsname=$data[7];
								$PersonnelBrithday=$data[8];
								$PersonnelWorking=$data[9];
								$PersonnelEducation=$data[10];
								$PersonnelDegree=$data[11];
								$PersonnelPhone=$data[12];
								$PersonnelAddress=$data[13];
								$PersonnelRemark=$data[14];
								
									$b1=substr($data[1],0,1); 
									$b2=substr($data[1],1,4);
									$b3=substr($data[1],5,5);
									$b4=substr($data[1],10,2);
									$b5=substr($data[1],12,13);
									$Personnelid= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;

?>
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


function bodyOnLoad()
{
	//alert("222233333");
		<?if($PersonnelEducation>="3"){?>
		document.forms[0].list_degree.disabled=false;
		<?}?>
			//document.forms[0].list_degree.disabled=false;
}
//-->
</script>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="bodyOnLoad()">
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>
<br>
<img src="images/head_personnel.gif" width="289" height="23"><br>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50">&nbsp;</td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr> 
          <td height="10" colspan="2" align="center" valign="middle">
		  </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="personnel_updatedata.php" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=3 align=left><b>&nbsp; &nbsp;บันทึกข้อมูลบุคลากร 
                          (พนักงาน) </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" class="boxleft30"> <? echo '- สกต. จังหวัด '.$amcname;?> 
                          <input type="hidden" name="personnelyear" value="<?echo $personnelyear?>"> 
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">ตำแหน่ง 
                          : </td>
                        <td align="left" class="boxleft5"> 
                          <?
							
							if($personnelyear==$Year)
								{
									$sql="SELECT * FROM PersonnelCode";
									$exsql=mssql_query($sql);
									//echo $sql;
									echo '<select name="list_positions" >';
										while($rowall=mssql_fetch_row($exsql)) 
												{	
													echo '<option value='.$rowall[0].'>'.$rowall[2].'</option>';
												}
									echo '</select>';
								?>
                          <script language=JAVAScript> 
																for(i=0;i<=(document.form1.list_positions.length-1);i++) {
																	if(document.form1.list_positions.options[i].value=="<?echo $PersonnelType?>") {
																		document.form1.list_positions.options[i].selected = true;
																		break;
																	}
																}
								</script> 
                          <?
									}
								if($personnelyear<$Year)
									{
							?>
                          <table width="170" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td bgcolor="#FFFAC1" class="boxleft5"><?echo $PersonnelTypename;?></td>
                            </tr>
                          </table>
                          <?
						  		}
						  ?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">2. </td>
                        <td height="20" align="left" class="boxleft5">ปีบันทึก 
                          : </td>
                        <td align="left" class="boxleft5"> 
                          <b><span class="txtred"><? echo $PersonnelYear?></span></b>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">3. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">หมายเลขบัตรประจำตัวประชาชน 
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><table width="170" height="18" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td bgcolor="#FFFAC1" class="boxleft5"><?echo $Personnelid;?> 
                                <input type="hidden" name="PersonnelID" value="<?echo $data[1]?>"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">4. </td>
                        <td height="20" align="left" class="boxleft5">ชื่อ : </td>
                        <td align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel" value="<?echo $PersonnelName ?>" onkeyup="doUnback(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>5.</td>
                        <td height="20" align="left" class="boxleft5">นามสกุล 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" value="<?echo $PersonnelLsname?>" onkeyup="doUnback_lsname(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6.</td>
                        <td height="20" align="left" class="boxleft5">วัน/เดือน/ปีเกิด 
                          : </td>
                        <td align="left" class="boxleft5"><?
						$PersonnelBrithday=trim($PersonnelBrithday);
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
						?>วัน 
                          <select name="ddate" class="datetime">
                            <?
									for($i=1;$i<=31;$i++)
									{
										echo '<option value='.$i.'>'.$i.'</option>';
									}
							
							?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.ddate.length-1);i++) {
									if(document.form1.ddate.options[i].value=="<?echo substr($PersonnelBrithday,0,strpos($PersonnelBrithday,"/"));?>") {
										document.form1.ddate.options[i].selected = true;
										break;
									}
								}
							</script>
                          เดือน 
                          <select name="dmonth" class="datemonth">
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.dmonth.length-1);i++) {
									if(document.form1.dmonth.options[i].value=="<?echo substr($PersonnelBrithday,strpos($PersonnelBrithday,"/")+1,2);?>") {
										document.form1.dmonth.options[i].selected = true;
										break;
									}
								}
							</script>
                          พ.ศ. 
                          <select name="dyear" class="dateyear">
                            <?
									for($a=(date(Y)+543);$a>=((date(Y)+543)-80);$a--)
									{
										echo '<option value='.$a.'>'.$a.'</option>';
									}
							
							?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.dyear.length-1);i++) {
									if(document.form1.dyear.options[i].value=="<?echo substr($PersonnelBrithday,-4)?>") {
										document.form1.dyear.options[i].selected = true;
										break;
									}
								}
							</script></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7. </td>
                        <td height="20" align="left" class="boxleft5">ปีที่เข้าทำงาน 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_working">
                            <?
									  $date=getdate(); // อ่านวันที่ของเครื่องเก็บที่ตังวแปร $date
									  $year=$date[year]+543; //แปลง ค.ศ ของเครื่องให้เป็น พ.ศ เก็บไว้ที่ตัวแปร $year
									  for ($x=$year;$x>=2530;$x--)  // วนลูปปี พ.ศ ปัจจุบันย้นไป 5 ปี
										echo '<option value='.$x.'>'.$x.'</option>';
							 ?>
                          </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_working.length-1);i++) {
									if(document.form1.list_working.options[i].value=="<?echo $PersonnelWorking;?>") {
										document.form1.list_working.options[i].selected = true;
										break;
									}
								}
							</script> </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">การศึกษา 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_education" onChange="chkEdu(this.value);">
                            <option value="1">ไม่เกินประถมหรือเทียบเท่า</option>
                            <option value="2">มัธยมศึกษา</option>
                            <option value="3">อนุปริญญา</option>
                            <option value="4">ปริญญาตรี</option>
                            <option value="5">สูงกว่าปริญญาตรี</option>
                          </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_education.length-1);i++) {
									if(document.form1.list_education.options[i].value=="<?echo $PersonnelEducation?>") {
										document.form1.list_education.options[i].selected = true;
										break;
									}
								}
							</script> </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=left> &nbsp;&nbsp; 8.1</td>
                        <td height="20" align="left" class="boxleft5">วุฒิการศึกษา 
                          : </td>
                        <td align="left" class="boxleft5"> <select name="list_degree" >
                            <option value="1">การตลาด</option>
                            <option value="2">บัญชี</option>
                            <option value="3">บริหารและการจัดการ</option>
                            <option value="4">เกษตรศาสตร์</option>
                            <option value="5">สังคมศาสตร์</option>
                            <option value="6">อื่นๆ</option>
                          </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.list_degree.length-1);i++) {
									if(document.form1.list_degree.options[i].value=="<?echo $PersonnelDegree?>") {
										document.form1.list_degree.options[i].selected = true;
										break;
									}
								}
							chkEdu('<?=$committeeedu?>');
							</script><?echo $data[MemberWorking];?>
							</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">หมายเลขโทรศัพท์ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" value="<?echo $PersonnelPhone?>" size="10" maxlength="10" onkeyup="doUnback_phone(value)"></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>10.</td>
                        <td height="20" align="left" class="boxleft5">ที่อยู่ 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_address" class="areabox150"><?echo $PersonnelAddress?></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="20" align=center>11.</td>
                        <td height="20" align="left" class="boxleft5">หมายเหตุ 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"><?echo $PersonnelRemark?></textarea></td>
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