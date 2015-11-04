<? 
//session_start();
$strExcelFileName ="Port_loan_balance.xls"; 
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\""); 
header("Content-Disposition: inline; filename=\"$strExcelFileName\""); 
header("Pragma: no-cache")

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<style id="SiXhEaD_Excel_Styles"></style>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel"> 
  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" ><tr><td align="center" valign="top">
    <?
					include ("images/lib/ms_database.php");
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
									$sql.="ORDER BY A.PersonnelYear DESC,  A.PersonnelType,A.PersonnelID ,A.AMCCode";

							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br>!!! ไม่พบข้อมูลในการค้นหา</div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
    <br>
    <table width="0" border="0" cellPadding="0" cellSpacing="1" bgcolor=white >
      <tr align="center" bgcolor="#BBD0E1"> 
        <td height="25"><b>ลำดับ</b></td>
        <td height="25"><b>สกต.</b></td>
        <td><b>ตำแหน่ง</b></td>
        <td height="25" align="center"><b>รหัสประชาชน</b></td>
        <td height="25" align="center"><b> ชื่อ</b></td>
        <td height="25" align="center"><b>นามสกุล</b></td>
        <td height="25"><b> อายุ</b></td>
        <td><b>ปีที่เข้าทำงาน</b></td>
        <td height="25"><b>วุฒิการศึกษา</b></td>
        <td><b>ระดับการศึกษา</b></td>
        <td height="25"><b>โทรศัพท์</b></td>
        <td height="25"><b>ที่อยู่</b></td>
        <td height="25"><b>หมายเหตุ</b></td>
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
								
								$Education=array("","ไม่เกินประถมหรือเทียบเท่า","มัธยมศึกษา","อนุปริญญา","ปริญญาตรี","สูงกว่าปริญญาตรี");
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
      <tr align=center bgcolor="#F0F0F0"> 
        <td height="20" align=center> <?echo $number=$number+1;?> </td>
        <td height="20" align="left" bgcolor="#F0F0F0" ><?echo $rowall[2]?> </td>
        <td height="20" align="left"><?echo $Position[$rowall[6]];?></td>
        <td height="20" ><?echo $rowall[5]?></td>
        <td height="20" align="left"><?echo $rowall[10]?></td>
        <td height="20" align="left"><?echo $rowall[11]?></td>
        <td > 
          <?
			$a=substr($rowall[12],6,4);
			$bb =(date('Y')+543);
				if(($bb-$a)=="0"){ echo "1";}
				else{ 	echo $bb-$a;}

		  ?>
        </td>
        <td ><?echo $rowall[13]?></td>
        <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[14]]?></td>
        <td align="left" > 
          <? if($rowall[15]!=""){ echo $Edudegree[$rowall[15]]; } else {echo "ไม่ระบุ";}?>
        </td>
        <td><?echo $rowall[16]?></td>
        <td align="left"><?echo $rowall[17]?></td>
        <td align="left" ><?echo $rowall[18]?></td>
      </tr>
      <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}
		?>
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
									$sql.="ORDER BY A.CommitteeGroup DESC, C.CommitteeType,A.CommitteeID ";

							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br>!!! ไม่พบข้อมูลในการค้นหา</div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
        <br>
    <table border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
       <tr align="center" bgcolor="#BBD0E1" > 
        <td height="35" rowspan="2"><b>ลำดับ</b></td>
        <td rowspan="2" bgcolor="#BBD0E1"><b>สกต.</b></td>
        <td rowspan="2" align="center"><b>ตำแหน่ง</b></td>
        <td rowspan="2"><b>รหัสประชาชน</b></td>
        <td rowspan="2"><b>ชื่อ</b></td>
        <td rowspan="2"><b>นามสกุล</b></td>
        <td rowspan="2"><b>อายุ</b></td>
        <td rowspan="2"><b>ที่อยู่</b></td>
        <td width="39" rowspan="2" align="center" ><b>เบอร์<br>
          โทรศัพท์</b></td>
        <td rowspan="2" >ปี</td>
        <td colspan="2"><b>การดำรงตำแหน่ง</b></td>
        <td rowspan="2"><b>เป็น คก.สกต.</b></td>
        <td rowspan="2"><b>วุฒิการศึกษา สูงสุด</b></td>
        <td rowspan="2"><b>ระดับการศึกษา</b></td>
        <td rowspan="2"><b>สถานะ<br>
          ทางสังคม</b></td>
        <td rowspan="2"><b>อาชีพหลัก</b></td>
        <td rowspan="2"><b>อาชีพรอง</b></td>
        <td rowspan="2"><b>หมายเหตุ</b></td>
      </tr>
      <tr align="center" bgcolor="#BBD0E1"> 
        <td height="18"><b>วาระ</b></td>
        <td><b>ปี</b></td>
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
      <tr bgcolor="#F0F0F0"> 
        <td height="20" align="center"> <?echo $number=$number+1;?> </td>
        <td align="left"><?echo $rowall[4]?> </td>
        <td align="left" > 
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
            <td align="center"> <?echo $show_id?></td>
            <td align="center"><?echo $rowall[13]?> </td>
            <td align="center"><?echo $rowall[14]?> </td>
            <td align="center"> 
              <?
			$a=substr($rowall[15],6,4);
			$bb =(date('Y')+543);
			//echo$rowall[15];
			echo $bb-$a;
		  ?>
            </td>
            <td align="center"><?echo $rowall[16]?> </td>
            <td align="center"><?echo $rowall[17]?> </td>
            <td align="center"><?echo $rowall[5]?></td>
            <td align="center"><?echo $rowall[6]?> </td>
            <td align="center"> <?echo $rowall[7]?></td>
            <td align="center"> 
              <?
						  if($AMC[$rowall[18]]=="ไม่เป็น"){echo $AMC[$rowall[18]];}
						  else{echo $AMC[$rowall[18]];}
				  ?>
            </td>
            <td align="center"><?echo $Education[$rowall[19]]?> </td>
            <td align="center"> 
              <? if($rowall[20]!=""){ echo $Edudegree[$rowall[20]]; } else {echo "ไม่ระบุ";}?>
            </td>
            <td align="center"> 
              <?
		  		if($rowall[21]=="ไม่มี"){echo $rowall[21];}
				else{echo $rowall[21];}
		  ?>
            </td>
            <td align="center"><?echo $Occu[$rowall[22]]?> </td>
            <td align="center"><?echo $Occu[$rowall[23]]?> </td>
            <td align="center"><?echo $rowall[24]?> </td>
      </tr>
      <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}	
				?>
    </table>
        <?
	  			}
	  		}  // if $search;
	  ?>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
