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
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><br>
            <br>
          </td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr align="left"> 
          <td height="20" colspan="2" valign="middle" class="boxleft50">  
            <?                     
			if($type=="personnel"){echo '<img src="images/trainning_personnel.gif" width="204" height="22">';} 
			if($type=="committee"){echo '<img src="images/trainning_committee.gif" width="238" height="20">';}
							include("../lib/ms_database.php");
							
						
							// personnel
						if($type=="personnel")
							{
								$sql="SELECT *
								FROM PersonnelGroup  A
								LEFT JOIN PersonnelCode B 
								ON A.PersonnelType=b.PersonnelType
								LEFT JOIN AMCCustomer C
								ON A.PersonnelID=C.MemberID
								LEFT JOIN (
								
								SELECT CustomerID, count(case when TestID = '01' Then TestID END)AS A,
								count(case when TestID = '02' Then TestID END)AS B,
								count(case when TestID = '03' Then TestID END)AS C,
								count(case when TestID = '04' Then TestID END)AS D,
								count(case when TestID = '05' Then TestID END)AS E
								FROM AMCTest
								GROUP By CustomerID
								) D 
								ON A.PersonnelID=D.CustomerID WHERE AMCCode='$amc'";
								}
							
							if($type=="committee")
									{
									$sql="SELECT *
									FROM CommitteeGroup  A
									LEFT JOIN CommitteeCode B 
									ON A.CommitteeType=b.CommitteeType
									LEFT JOIN AMCCustomer C
									ON A.CommitteeID=C.MemberID
									LEFT JOIN (
									
									SELECT CustomerID, count(case when TestID = '01' Then TestID END)AS A,
									count(case when TestID = '02' Then TestID END)AS B,
									count(case when TestID = '03' Then TestID END)AS C,
									count(case when TestID = '04' Then TestID END)AS D,
									count(case when TestID = '05' Then TestID END)AS E
									FROM AMCTest
									GROUP By CustomerID
									) D 
									ON A.CommitteeID=D.CustomerID WHERE AMCCode='$amc'";
									}
							$exsql=mssql_query($sql);
							//echo $sql;
						?>
          </td>
        </tr>
        <tr align="center"> 
          <td height="50" colspan="2" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="personnel.php">
                <td align="left" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=12 align=left><b>&nbsp; แสดงข้อมูลประวัติการฝึกอบรม<span class="txtred"><u>
                          <?if($type=="personnel"){echo "เจ้าหน้าที่";} if($type=="committee"){echo "คณะกรรมการ";}?>
                          </u></span></b></td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="4%" height="40" rowspan="2">ลำดับ</td>
                        <td width="11%" rowspan="2">ตำแหน่ง</td>
                        <td width="12%" rowspan="2" align="center">รหัสประชาชน</td>
                        <td width="10%" rowspan="2" align="center"><br>
                          ชื่อ<br> <br> </td>
                        <td width="10%" rowspan="2" align="center">นามสกุล</td>
                        <td height="25" colspan="5" bgcolor="#F0B49F">หมวดวิชาที่ฝึกอบรม</td>
                        <td width="5%" rowspan="2">ข้อมูล<br>
                          การอบรม</td>
                        <td width="8%" rowspan="2">เพิ่มข้อมูล<br>
                          ฝึกอบรม</td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="8%" height="15" bgcolor="#FBDBD9">การบัญชี/การเงิน</td>
                        <td width="8%" bgcolor="#FBDBD9">การบริหาร/การจัดการ</td>
                        <td width="8%" bgcolor="#FBDBD9">การตลาด</td>
                        <td width="8%" bgcolor="#FBDBD9">สหกรณ์</td>
                        <td width="8%" bgcolor="#FBDBD9">อื่นๆ</td>
                      </tr>
						<?

								while($rowall=mssql_fetch_array($exsql))
								{	
								if($type=="personnel")
									{
						?>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;" onMouseOver="this.style.cursor='hand'" onClick="window.location.href ='testing_people.php?USER_ID=<? echo $rowall[1];?>&positions=<?echo $rowall[8]?>&name=<?echo $rowall[10]?>&lastname=<?echo $rowall[11]?>&type=personnel'"> 
                        <td height="20" align=center> 
                          <?echo ($P=$P+1);?>
                        </td>
                        <td height="20" align="left" class="boxleft10"> 
                          <?
									echo $rowall[8];
									$b1=substr($rowall[1],0,1); 
									$b2=substr($rowall[1],1,4);
									$b3=substr($rowall[1],5,5);
									$b4=substr($rowall[1],10,2);
									$b5=substr($rowall[1],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                        </td>
                        <td height="20" ><?=$show_id; ?></td>
                        <td height="20" ><?echo $rowall[10];?></td>
                        <td height="20" ><?echo $rowall[11];?></td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[23]=="0" OR $rowall[23] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                           
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[24]=="0" OR $rowall[24] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[25]=="0" OR $rowall[25] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[26]=="0" OR $rowall[26] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[27]=="0" OR $rowall[27] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><a href="testing_people.php?USER_ID=<? echo $rowall[1];?>&positions=<?echo $rowall[8]?>&name=<?echo $rowall[10]?>&lastname=<?echo $rowall[11]?>&type=personnel&PositionID=<?echo $rowall[2];?>"><img src="../TreeImages/profile.gif" alt="ดูข้อมูลการฝึกอบรมทั้งหมด" border="0"></a> 
                        </td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <a href="testing_add.php?position=<?echo $rowall[7]; ?>&USER_ID=<?echo $rowall[4]?>&name=<?echo $rowall[10]?>&lastname=<?echo $rowall[11]?>&ID=<?echo $show_id?>&type=personnel&position=<?echo $rowall[8]?>&PositionID=<?echo $rowall[2];?>"><img src="../TreeImages/vcard_edit.png" border="0" alt="เพิ่มประวัติการฝึกอบรม"></a> 
                        </td>
                      </tr>
					  <?
							}
						if($type=="committee")
							{
						?>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;" onMouseOver="this.style.cursor='hand'" onClick="window.location.href ='testing_people.php?USER_ID=<? echo $rowall[4];?>&positions=<?echo $rowall[12]?>&name=<?echo $rowall[14]?>&lastname=<?echo $rowall[15]?>&type=committee'"> 
                        <td height="20" align=center> 
                          <?echo ($P=$P+1);?>
                        </td>
                        <td height="20" align="left" class="boxleft10"> 
                          <?
									echo $rowall[12];
									$b1=substr($rowall[4],0,1); 
									$b2=substr($rowall[4],1,4);
									$b3=substr($rowall[4],5,5);
									$b4=substr($rowall[4],10,2);
									$b5=substr($rowall[4],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                        </td>
                        <td height="20" > 
                          <?=$show_id; ?>
                        </td>
                        <td height="20" ><?echo $rowall[14];?></td>
                        <td height="20" ><?echo $rowall[15];?></td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[27]=="0" OR $rowall[27] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                           
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[28]=="0" OR $rowall[28] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[29]=="0" OR $rowall[29] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[30]=="0" OR $rowall[30] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;">
                          <? if($rowall[31]=="0" OR $rowall[31] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                        </td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><a href="testing_people.php?USER_ID=<? echo $rowall[4];?>&positions=<?echo $rowall[12]?>&name=<?echo $rowall[14]?>&lastname=<?echo $rowall[15]?>&type=committee&PositionID=<?echo $rowall[5]?>"><img src="../TreeImages/profile.gif" alt="ดูข้อมูลการฝึกอบรมทั้งหมด"  border="0"></a> 
                        </td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <a href="testing_add.php?position=<?echo $rowall[7]; ?>&USER_ID=<?echo $rowall[4]?>&name=<?echo $rowall[14]?>&lastname=<?echo $rowall[15]?>&ID=<?echo $show_id?>&type=committee&position=<?echo $rowall[12]?>&PositionID=<?echo $rowall[5]?>"><img src="../TreeImages/vcard_edit.png" border="0" alt="เพิ่มประวัติการฝึกอบรม"></a> 
                        </td>
                      </tr>
					<?
						}
						}
					  ?>
					  
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="1" colspan="12" align=left> 
                        </td>
                      </tr>
                    </table>
                    
                  </td>
               </form></tr>
            </table>
            <br>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tahoma11px">
              <tr>
                <td class="boxleft10"><span class="txtred"><b>หมายเหตุ</b></span></td>
              </tr>
              <tr>
                <td class="boxleft10"> &nbsp;<img src="images/checked.gif" width="13" height="13"> 
                  <span class="txtwhite">ผ่านการอบรม</span> </td>
              </tr>
              <tr> 
                <td class="boxleft10">
<input type="checkbox" name="checkbox" value="checkbox" disabled>
                  <span class="txtwhite">ยังไม่ได้อบรม</span></td>
              </tr>
            </table> </td>
        </tr>
      </table>
	  </td>
  </tr>
</table>
</body>
</html>
