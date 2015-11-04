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
            <img src="images/head_member.jpg" width="357" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr> 
          <td height="20" colspan="2" align="center" valign="middle"> 
            <?
							include("../lib/ms_database.php");
							$sql=" SELECT A.AMCCode, A.MemberHelp,A.MemberHelpBranch,C.CAT_DESC, A.MemberYear,A.MemberID, ";
							$sql.=" B.MemberName, B.MemberLastname, B.MemberBirthday,B.MemberPhone,B.MemberEducation, B.MemberAddress, ";
							$sql.=" A.MemberRemark  ";
							$sql.=" FROM NetworkMemberGroup A  ";
							$sql.=" LEFT JOIN( SELECT * FROM AMCCustomer ) ";
							$sql.=" AS B ON A.MemberID=B.MemberID ";
							$sql.=" LEFT JOIN (SELECT D.AMCCode,D.amcprovince,E.CAT_AA,E.CAT_DESC FROM userlogin D  ";
							$sql.=" LEFT JOIN(SELECT * FROM CCAATTIS WHERE CAT_CC<>'00'AND CAT_AA<>'00' AND CAT_TT='00'  ";
							$sql.=" AND CAT_MM='00' AND CAT_DESC NOT LIKE '%*%') AS E ON D.amcprovince=E.CAT_CC ) ";
							$sql.=" AS C ON A.AMCCode=C.AMCCode AND A.MemberHelpBranch=C.CAT_AA ";

							$sql.=" WHERE A.AMCCode='$amc' ";
							/*		if($SendYear=="")
										{ $sql.=" AND A.MemberYear='$Year' "; }
									if($SendYear<>"")
										{ $sql.=" AND  A.MemberYear='$SendYear'";}
							*/
							$sql.=" ORDER BY  A.MemberYear DESC, A.MemberID ";
							
							//echo $sql;
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$i=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="networkmember.php">
                <td align="center" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=12 align=left><b>&nbsp; แสดงข้อมูลเครื่อข่ายสมาชิกทั้งหมด</b>
								<?php echo '<span class="txtwhite"> | </spand><img src="images/add_02.gif" width="11" height="10">&nbsp;<a href="networkmember_add.php" class="link_menu">เพิ่มข้อมูลใหม่</a>'; ?>
						</td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="4%" height="25">ลำดับ</td>
                        <td width="11%">สาขาที่ช่วยงาน</td>
                        <td width="12%" height="25" align="center">รหัสประชาชน</td>
                        <td width="10%" align="center"><br>
                          ชื่อ<br> <br> </td>
                        <td width="10%" align="center">นามสกุล</td>
                        <td width="5%">อายุ</td>
                        <td width="13%">วุฒิการศึกษา</td>
                        <td width="9%">โทรศัพท์</td>
                        <td width="5%">แก้ไข</td>
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
						  			if($rowall[1]=="1")
										{
												echo $rowall[3];
										}
									else
										{
												echo '<span class="txtred">ไม่ได้ช่วยงานสาขา</span>';
										}
									
									$b1=substr($rowall[5],0,1); 
									$b2=substr($rowall[5],1,4);
									$b3=substr($rowall[5],5,5);
									$b4=substr($rowall[5],10,2);
									$b5=substr($rowall[5],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                        </td>
                        <td height="20" ><?echo $show_id;?> </td>
                        <td height="20" align="left" class="boxleft5" ><?echo $rowall[6]?></td>
                        <td height="20" align="left" class="boxleft5" ><?echo $rowall[7]?></td>
                        <td> 
                          <?
								$a=substr(trim($rowall[8]),-4);
								$b =(date('Y')+543);
								if(($b-$a)=="0") {echo "1";}
								else{echo $b-$a;}
							  ?>
                        </td>
                        <td>
                          <?
									if($rowall[10]=="1"){echo "ไม่เกินประถมหรือเทียบเท่า";}
									if($rowall[10]=="2"){echo "มัธยมศึกษา";}
									if($rowall[10]=="3"){echo "อนุปริญญา";}
									if($rowall[10]=="4"){echo "ปริญญาตรี";}
									if($rowall[10]=="5"){echo "สูงกว่าปริญญาตรี";}
								?>
                        </td>
                        <td><? if($rowall[9]==""){ echo "-";} else { echo $rowall[9];}?></td>
					    <td><a href="networkmember_update.php?memberid=<?echo $rowall[5]?>&memberyear=<?echo $rowall[4]?>&amc=<?echo $amc?>"><img src="images/update.gif" width="14" height="13" border="0"></a> 
                        </td>
							<td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลพนักงาน : <?echo $rowall[6].' '.$rowall[7]?>')){ window.location='networkmember_delete.php?AMCCode=<?=$amc?>&memberid=<?echo $rowall[5]?>&memberyear=<?echo $rowall[4]?>';}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ลบข้อมูลพนักงาน (<?echo $rowall[6].' '.$rowall[7]; ?>)"></a> 
                        </td>
                      </tr>
                      <?
					  		$i++;
					  		}
					  ?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="10" colspan="12" align=left>&nbsp;&nbsp;&nbsp; 
                          <? 
								echo '<img src="images/add.gif.gif" width="11" height="10"><a href="networkmember_add.php"> เพิ่มข้อมูลใหม่</a>';
						?>
                          <input type="hidden" name="user_id" value="<?echo $rowall[4];?>">
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
