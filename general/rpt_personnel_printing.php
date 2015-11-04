<?
	session_start(); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<SCRIPT LANGUAGE="JavaScript">
<!--
function bodyOnLoad() {
		
	var offset = (navigator.userAgent.indexOf("Mac") != -1 || 
		navigator.userAgent.indexOf("Gecko") != -1 || 
		navigator.appName.indexOf("Netscape") != -1) ? 0 : 4;
	window.moveTo(-offset, -offset);
	window.resizeTo(screen.availWidth + (2 * offset), screen.availHeight + (2 * offset));

}
//-->
</SCRIPT>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="bodyOnLoad();">

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="font1">
  <tr>
    <td align="center" valign="top"> 
      <?
					include ("../lib/ms_database.php");
					if($rdo_type=="personnel")
						{
								$sql=" SELECT A.AMCCode,C.AMCProvince, C.userdetail, C.br_code,C.br_name, A.PersonnelID,  ";
								$sql.=" A.PersonnelType, A.PersonnelCategory, B.PersonnelName, A.PersonnelYear, D.MemberName,  ";
								$sql.=" D.MemberLastname, D.MemberBirthday, D.memberworking, D.MemberEducation,  ";
								$sql.=" D.MemberDegree, D.MemberPhone, D.MemberAddress, D.MemberRemark  ";

								$sql.=" FROM PersonnelGroup A  ";
								$sql.=" LEFT JOIN ( SELECT * FROM PersonnelCode )AS B ON A.PersonnelType=B.PersonnelType  ";

								$sql.=" LEFT JOIN ( SELECT * FROM UserLogin ) AS C ON A.AMCCOde=C.AMCCode ";

								$sql.=" LEFT JOIN ( SELECT * FROM AMCCustomer)AS D ON  A.PersonnelID=D.MemberID ";								
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
											{ $sql.=" AND D.MemberName like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND D.MemberLastname like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND D.MemberPhone like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND D.MemberEducation ='$list_education' "; }
									if($list_degree)
											{ $sql.=" AND D.MemberDegree= '$list_degree'";}
									if($txt_address<>"")		
											{ $sql.=" AND D.MemberAddress like '%$txt_address%' ";}
									if($list_year<>"")
											{$sql.=" AND A.PersonnelYear='$list_year '";}
									$sql.="WHERE D.br_code is not null ";
									$sql.="ORDER BY A.PersonnelYear DESC,  A.PersonnelType,A.PersonnelID ,A.AMCCode";

							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
      <br> 
      <table width="1200" border="0" cellPadding="0" cellSpacing="1" bgcolor=white class=font1 >
        <tr align=center bgcolor="#92AED1" style="color:#333333;"> 
          <td height="19" colspan=18 align=left class="boxleft5"><b> 
            <?
		  //		echo $list_year;
		  		if($list_year<>"")
					{
							echo  '&nbsp; &nbsp;ข้อมูลพนักงาน ณ ปี '.$list_year.'';
					}
				if($list_year=="")
					{
							echo "แสดงข้อมูลพนักงานทั้งหมด";
					}
		  ?>
            </b></td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="25">ลำดับ</td>
          <td width="80" height="25">สกต.</td>
          <td width="100">ตำแหน่ง</td>
          <td width="100" height="25" align="center">รหัสประชาชน</td>
          <td width="100" height="25" align="center"> ชื่อ</td>
          <td width="100" height="25" align="center">นามสกุล</td>
          <td width="30" height="25"> อายุ</td>
          <td width="50">ปีที่<br>
            เข้าทำงาน</td>
          <td width="80" height="25">วุฒิการศึกษา</td>
          <td width="80">ระดับการศึกษา</td>

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
								$Position["06"]="หัวหน้างานบัญชี";
								$Position["07"]="เจ้าหน้าที่บัญชี";
								$Position["08"]="เจ้าหน้าที่การเงิน";
								$Position["09"]="หัวหน้าการตลาด";
								$Position["10"]="เจ้าหน้าที่การตลาด";
								$Position["11"]="หัวหน้าธุรการ";
								$Position["12"]="นักการภารโรง";
								$Position["13"]="พนักงานขับรถ";
								
								$Education=array("","ไม่เกินประถมหรือเทียบเท่า","มัธยมศึกษา","อนุปริญญา","ปริญญาตรี","สูงกว่า ปริญญาตรี");
								$Edudegree=array("","การตลาด","บัญชี","บริหารและการจัดการ","เกษตรศาสตร์","สังคมศาสตร์","อื่นๆ");
								
								$type=$org_searchtype;
								$page=50;  // กำหนดให้แต่ละเพจแสดงรายการทั้งหมด 40 รายการ
								
					  			$nums=$page*$pagenum; 
								$allpage = $numrows/$page;
							  	$allpage=ceil($allpage);  // ceil เป็นการปัดเศษทั้งหมดให้เป็นจำนวนเต็ม
								$number=$nums;
								//echo $nums;
								
								if($numrows>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											//$b=$rowall[9];
					  ?>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center> <?echo $number=$number+1;?> </td>
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><?echo $rowall[2]?> 
          </td>
          <td height="20" align="left" class="boxleft10"><?echo $Position[$rowall[6]];?></td>
          <td height="20" ><?echo $rowall[5]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[10]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[11]?></td>
          <td > 
            <?
			$a=substr(trim($rowall[12]),-4);
			$bb =(date('Y')+543);
				if(($bb-$a)=="0"){ echo "1";}
				else{ 	echo $bb-$a;}

		  ?>
          </td>
          <td ><?echo $rowall[13]?></td>
          <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[14]]?></td>
          <td align="left" class="boxleft5" ><? if($rowall[15]!=""){ echo $Edudegree[$rowall[15]]; } else {echo "ไม่ระบุ";}?></td>
          <td><?echo $rowall[16]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[17]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[18]?></td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}
		?>
        <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
          <td height="2" colspan="24" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
	  <table width="78%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="20">
          </td>
        </tr>
        <tr>
          <td align="center"> 
            <?
					 if($numrows>0)
					  	{
							$pagenum1=$pagenum+1;

								echo '<span class="font1"><span class="txtblack">แสดงหน้าที่ <b><span class="txtred">'.$pagenum1.'</span></b> 
									จากทั้งหมด <b>'.$allpage.'
									</b>หน้า</span></span>
									<br>';
						}
						
			 ?>
            <br>
            <br>
            <br>
            <br>
          </td>
        </tr>
      </table>
	        <?
	  			}
	  		}  // if $search;

					if($rdo_type=="committee")
						{


								$sql=" SELECT A.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup, ";
								$sql.=" A.Committeeoccasion, A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType,  ";
								$sql.=" C.CommitteeCategory, C.CommitteeName, B.MemberName,B.MemberLastname, B.MemberBirthDay, ";
								$sql.=" B.MemberAddress, B.MemberPhone, A.CommitteeAMC, B.MemberEducation, B.MemberDegree,  ";
								$sql.=" A.CommitteeSocial, B.MemberOccu, B.MemberOccuSecond, B.MemberRemark  ";

								$sql.=" FROM CommitteeGroup A  ";

								$sql.=" LEFT JOIN(SELECT * FROM AMCCustomer)AS B ON A.CommitteeID=B.MemberID  ";

								$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode) AS C ON A.CommitteeType=C.CommitteeType  ";
								$sql.=" AND A.CommitteeCategory=C.CommitteeCategory  ";
								$sql.=" LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin ) ";
								$sql.=" AS D ON A.AMCCode=D.AMCCode  ";

									
								if($list_committee<>"")								
											{ $sql.=" AND C.CommitteeType ='$list_committee' "; }
									if($div<>"")
											{ $sql.=" AND D.br_code='$div' ";}
									if($list_province<>"")		
											{ $sql.=" AND D.amcprovince='$list_province' ";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.CommitteeID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND B.MemberName like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND B.MemberLastname like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND B.MemberPhone like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND B.MemberEducation ='$list_education' "; }
									if($list_degree)
											{ $sql.=" AND B.MemberDegree='$list_degree' ";}
									if($txt_address<>"")		
											{ $sql.=" AND B.MemberAddress like '%$txt_address%' ";}
									if($list_year<>"")
											{ $sql.=" AND A.CommitteeGroup='$list_year' ";}
									$sql.="WHERE D.br_code is not null ";
									$sql.="ORDER BY A.CommitteeGroup DESC, C.CommitteeType,A.CommitteeID ";
							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
      <br> 
      <table width="1600" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
        <tr bgcolor="#92AED1" class="font1"> 
          <td height="19" colspan="20" class="boxleft5" ><b> 
            <?

		  //		echo $list_year;
		  		if($list_year<>"")
					{
							echo  '&nbsp; &nbsp;ข้อมูลคณะกรรมการ ณ ปี '.$list_year.'';
					}
				if($list_year=="")
					{
							echo "แสดงข้อมูลคณะกรรมการทั้งหมด";
					}
		  ?>
            </b></td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="35" rowspan="2">ลำดับ</td>
          <td width="85" rowspan="2" bgcolor="#BBD0E1">สกต.</td>
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
          <td width="100" rowspan="2">ระดับการศึกษา</td>
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
								$type=$org_searchtype;
								$page=30;  // กำหนดให้แต่ละเพจแสดงรายการทั้งหมด 40 รายการ
								
					  			$nums=$page*$pagenum; 
								$allpage = $numrows/$page;
							  	$allpage=ceil($allpage);  // ceil เป็นการปัดเศษทั้งหมดให้เป็นจำนวนเต็ม
								$number=$nums;
								//echo $nums;
								
								if($numrows>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
							while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
											$Occu=array("","เป็นเกษตรกร","ทำการค้าขาย","รับราชการ","อื่นๆ") ;/// อาชีพ
											$Education=array("","ประถมหรือเทียบเท่า","มัธยมศึกษา","อนุปริญญา","ปริญญาตรี","สูงกว่าปริญญาตรี");
											$Edudegree=array("","การตลาด","บัญชี","บริหารและการจัดการ","เกษตรศาสตร์","สังคมศาสตร์","อื่นๆ");
											$AMC=array("ไม่เป็น","เป็น");
								?>
        <tr bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align="center"> <?echo $number=$number+1;?> </td>
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
			$a=substr(trim($rowall[15]),-4);
			$bb =(date('Y')+543);
			//echo$rowall[15];
			echo $bb-$a;
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
                <td align="left" bgcolor="#FFFFFF" class="boxleft5">
                  <? if($rowall[20]!=""){ echo $Edudegree[$rowall[20]]; } else {echo "ไม่ระบุ";}?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF" class="boxleft5"> 
                  <?
		  		if($rowall[21]=="ไม่มี"){echo '<span class="txtred">'.$rowall[21].'</span>';}
				else{echo $rowall[21];}
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $Occu[$rowall[22]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $Occu[$rowall[23]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[24]?></td>
              </tr>
            </table></td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}	
				?>
        <tr bgcolor="#C8D7E3" style="color:#666666;"> 
          <td height="2" colspan="20" align="center"></td>
        </tr>
      </table>
	  <table width="78%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="20">
          </td>
        </tr>
        <tr>
          <td align="center"> 
            <?
					if($pagenum=="")
						{	$pagenum=0;}
					 if($numrows>0)
					  	{
							$pagenum1=$pagenum+1;

								echo '<span class="font1"><span class="txtblack">แสดงหน้าที่ <b><span class="txtred">'.$pagenum1.'</span></b> 
									จากทั้งหมด <b>'.$allpage.'
									</b>หน้า</span></span>
									<br>';
						}
						
						
		  
		  ?>
            <br>
            <br>
          </td>
        </tr>
      </table>
	  
      <?
	  			}
	  		}  // if $search;
	  ?>
    </td>
  </tr>
</table>
        <script language="javascript">
window.print();
</SCRIPT>
</body>
</html>
