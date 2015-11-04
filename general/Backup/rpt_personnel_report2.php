<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="font1">
  <tr>
    <td align="center" valign="top"> 
      <?
					include ("images/lib/ms_database.php");
					if($rdo_type=="personnel")
						{
							$sql=" SELECT A.AMCCode,C.AMCProvince, C.userdetail, C.br_code,C.br_name, A.PersonnelID, A.PersonnelType, A.PersonnelCategory, B.PersonnelName, A.PersonnelYear, ";
							$sql.=" A.MemberHelp, A.MemberHelpBranch, D.CAT_DESC,A.MemberRemark, E.PersonnelName, E.PersonnelLsname, E.PersonnelBrithday, E.Personnelworking, E.PersonnelEducation, ";
							$sql.=" E.PersonnelPhone, E.PersonnelAddress, E.PersonnelRemark ";
							$sql.=" FROM PersonnelGroup A ";
							$sql.=" LEFT JOIN ( SELECT * FROM PersonnelCode )AS B ON A.PersonnelType=B.PersonnelType ";
							$sql.=" LEFT JOIN ( SELECT * FROM UserLogin ) AS C ON A.AMCCOde=C.AMCCode ";
							$sql.=" LEFT JOIN ( SELECT * FROM DBTP.DBO.CCAATTIS WHERE CAT_TT='00' AND CAT_MM='00')AS D ON ";
							$sql.=" C.AMCProvince= D.CAT_CC AND A.MemberHelpBranch=D.CAT_AA ";
							$sql.="  LEFT JOIN ( SELECT * FROM PersonnelDetail ) AS E ON A.PersonnelID=E.PersonnelID AND A.AMCCode=E.AMCCode ";
							$sql.=" WHERE A.AMCCode<>'' ";
							
									if($list_personnel<>"")
											{ $sql.=" AND A.PersonnelType ='$list_personnel' "; }
									if($div<>"")
											{ $sql.=" AND C.br_code='$div' ";}
									if($list_province<>"")		
											{ $sql.=" AND C.AMCProvince='$list_province' ";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.PersonnelID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND AE.PersonnelName like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND E.PersonnelLsname like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND E.PersonnelPhone like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND A.E.PersonnelEducation ='$list_education' "; }
									if($txt_address<>"")		
											{ $sql.=" AND E.PersonnelAddress like '%$txt_address%' ";}
									if($list_year<>"")
											{$sql.=" AND A.PersonnelYear='$list_year '";}
									$sql.="ORDER BY A.PersonnelYear DESC,  A.PersonnelType,A.PersonnelID ,A.AMCCode";
							echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
      <br> <table width="1205" border="0" cellPadding="0" cellSpacing="1" bgcolor=white class=font1 >
        <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
          <td height="19" colspan=17 align=left><b>

		  </b>
		  </td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="25">ลำดับ</td>
          <td width="80" height="25">สกต.</td>
          <td width="80">สาขาที่ช่วยงาน</td>
          <td width="100">ตำแหน่ง</td>
          <td width="100" height="25" align="center">รหัสประชาชน</td>
          <td width="100" height="25" align="center"> ชื่อ</td>
          <td width="100" height="25" align="center">นามสกุล</td>
          <td width="30" height="25"> อายุ</td>
          <td width="49" height="25">ปี</td>
          <td width="50">ปีที่<br>
            เข้าทำงาน</td>
          <td width="145" height="25">วุฒิการศึกษา</td>
          <td width="100" height="25">โทรศัพท์</td>
          <td width="140" height="25">ที่อยู่</td>
          <td width="100" height="25">หมายเหตุ</td>
        </tr>
        <?
								$i=1;
							//	$Occu=array("","เป็นเกษตรกร","ทำการค้าขาย","รับราชการ","อื่นๆ") ;/// อาชีพ
								$Position["01"]="ผู้จัดการ";
								$Position["02"]="รักษาการผู้จัดการ";
								$Position["03"]="ผู้ช่วยผู้จัดการ";
								$Position["04"]="รักษาการผู้ช่วยผู้จัดการ";
								$Position["05"]="สมุห์บัญชี";
								$Position["06"]="เจ้าหน้าที่บัญชี";
								$Position["07"]="เจ้าหน้าที่การเงิน";
								$Position["08"]="เจ้าหน้าที่การตลาด";
								$Position["09"]="เจ้าหน้าที่ธุรการ";
								$Position["10"]="นักการภารโรง";
								$Position["11"]="พนักงานขับรถ";
								
								$Education=array("","ไม่เกินประถมหรือเทียบเท่า","ประถม - มัธยมศึกษา"," มัธยมศึกษา - อนุปริญญา","อนุปริญญา - ปริญญาตรี","สูงกว่า ปริญญาตรี");

								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											//$b=$rowall[9];
					  ?>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center> 
            <?=$i;?>
          </td>
          <td height="20" align="left" class="boxleft10"><?echo $rowall[2]?> </td>
          <td height="20" align="left" class="boxleft10"> 
            <?
			if($rowall[10]=="1") {echo $rowall[12]; }
			if($rowall[10]<>"1") {echo '<span class="txtred">ไม่ได้ช่วยงาน</span>';}
	?>
          </td>
          <td height="20" align="left" class="boxleft10"><?echo $Position[$rowall[6]];?></td>
          <td height="20" ><?echo $rowall[5]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[14]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[15]?></td>
          <td > 
            <?
			$a=substr($rowall[16],6,4);
			$b =(date('Y')+543);
				if(($b-$a)=="0"){ echo "1";}
				else{ 	echo $b-$a;}

		  ?>
          </td>
          <td ><?echo $rowall[9]?></td>
          <td ><?echo $rowall[17]?></td>
          <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[18]]?></td>
          <td><?echo $rowall[19]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[20]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[21]?></td>
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
          <td height="2" colspan="23" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
      <?
	  			}
	  		}  // if $search;

					if($rdo_type=="committee")
						{


								$sql=" SELECT B.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup, A.Committeeoccasion, ";
								$sql.=" A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType, C.CommitteeCategory, C.CommitteeName, ";
								$sql.=" B.CommitteeName,B.CommitteeLastname, B.CommitteeBirhtDay, B.CommitteeAddress, B.CommitteePhone, A.CommitteeAMC,  ";
								$sql.=" B.CommitteeEdu, A.CommitteeSocial, B.CommitteeOccu, B.CommitteeOccuSecond, B.CommitteeRemark  ";
								
								$sql.=" FROM CommitteeGroup A LEFT JOIN(SELECT * FROM CommitteeDetail)AS B ON A.CommitteeID=B.CommitteeID ";
								$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode) AS C ON A.CommitteeType=C.CommitteeType AND A.CommitteeCategory=C.CommitteeCategory  ";
								$sql.="LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin )AS D ON A.AMCCode=D.AMCCode ";								
								$sql.="WHERE A.AMCCode<>'' ";
									
								if($list_committee<>"")								
											{ $sql.=" AND C.CommitteeType ='$list_personnel' "; }
									if($div<>"")
											{ $sql.=" AND D.br_code='$div' ";}
									if($list_province<>"")		
											{ $sql.=" AND D.amcprovince='$list_province' ";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.CommitteeID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND B.CommitteeName like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND B.CommitteeLastname like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND B.CommitteePhone like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND B.CommitteeEdu ='$list_education' "; }
									if($txt_address<>"")		
											{ $sql.=" AND A.CommitteeAddress like '%$txt_address%' ";}
									if($list_year<>"")
											{ $sql.=" AND A.CommitteeGroup='$list_year' ";}
									$sql.="ORDER BY A.CommitteeGroup DESC, C.CommitteeType,A.CommitteeID ";

							echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
      <br> <table width="1530" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
        <tr bgcolor="#92AED1" class="font1"> 
          <td height="23" colspan="19" class="boxleft15" ><b>ข้อมูล ณ ปี </b></td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="35" rowspan="2">ลำดับ</td>
          <td width="85" rowspan="2">สกต.</td>
          <td width="120" rowspan="2" align="center">ตำแหน่ง</td>
          <td width="130" rowspan="2">รหัสประชาชน</td>
          <td width="100" rowspan="2">ชื่อ</td>
          <td width="100" rowspan="2">นามสกุล</td>
          <td width="40" rowspan="2">อายุ</td>
          <td width="200" rowspan="2">ที่อยู่</td>
          <td width="39" rowspan="2" align="center" >เบอร์<br>
            โทรศัพท์</td>
          <td width="40" rowspan="2" >ปี</td>
          <td height="20" colspan="2">การดำรงตำแหน่ง</td>
          <td width="50" rowspan="2">เป็น <br>
            คก.สกต.</td>
          <td width="150" rowspan="2">วุฒิการศึกษา<br>
            สูงสุด</td>
          <td width="80" rowspan="2">สถานะ<br>
            ทางสังคม</td>
          <td width="100" rowspan="2">อาชีพหลัก</td>
          <td width="100" rowspan="2">อาชีพรอง</td>
          <td width="120" rowspan="2">หมายเหตุ</td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1"> 
          <td width="40" height="18">วาระ</td>
          <td width="40">ปี</td>
        </tr>
        <?		
  							$i=1;
							while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
											$Occu=array("","เป็นเกษตรกร","ทำการค้าขาย","รับราชการ","อื่นๆ") ;/// อาชีพ
											$Education=array("","ประถมหรือเทียบเท่า","ประถม - มัธยมศึกษา"," มัธยมศึกษา - อนุปริญญา","อนุปริญญา - ปริญญาตรี","สูงกว่า ปริญญาตรี");
											$AMC=array("ไม่เป็น","เป็น");
								?>
        <tr bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align="center"> 
            <?=$i;?>
          </td>
          <td align="left" class="boxleft5"><?echo $rowall[4]?> </td>
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
			//echo$rowall[15];
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
          <td align="center"><?echo $rowall[5]?></td>
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
                <td align="center" bgcolor="#FFFFFF"> 
                  <?
		  if($AMC[$rowall[18]]=="ไม่เป็น"){echo '<span class="txtred">'.$AMC[$rowall[18]].'</span>';}
		  else{echo $AMC[$rowall[18]];}
		  ?>
                </td>
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
		  		if($rowall[20]=="ไม่มี"){echo '<span class="txtred">'.$rowall[20].'</span>';}
				else{echo $rowall[20];}
		  ?>
                </td>
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
        </tr>
        <?
									$i++;
									}	
							?>
        <tr bgcolor="#C8D7E3" style="color:#666666;"> 
          <td height="2" colspan="19" align="center"></td>
        </tr>
      </table>
      <?
	  			}
	  		}  // if $search;
	  ?>
    </td>
  </tr>
</table>
</body>
</html>
