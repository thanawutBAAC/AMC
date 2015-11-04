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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="font1">
  <tr>
    <td align="center" valign="top"> 
      <?
					include ("images/lib/ms_database.php");
$sql=" SELECT C.BR_CODE,C.BR_NAME,C.AMCPROVINCE,C.USERDETAIL,C.MEMBERHELPBRANCH,C.CAT_DESC, ";
					$sql.=" C.AMCCODE,A.MEMBERID,A.MEMBERNAME, A.MEMBERLASTNAME,A.MEMBERBIRTHDAY,A.MEMBERPHONE,A.MEMBEREDUCATION, ";
					$sql.=" A.MEMBERADDRESS,C.MEMBERREMARK,C.MEMBERUPDATE  ";
					$sql.=" FROM AMCCustomer A  ";
					$sql.=" LEFT JOIN (  ";
					$sql.=" SELECT A.AMCCODE,B.BR_CODE, B.BR_NAME, A.MEMBERID,A.MEMBERYEAR,A.MEMBERHELP,B.AMCPROVINCE, ";
					$sql.=" B.USERDETAIL, A.MEMBERHELPBRANCH,B.CAT_DESC,A.MEMBERREMARK,A.MEMBERUPDATE  ";
					$sql.=" FROM NETWORKMEMBERGROUP A  ";
					$sql.=" LEFT JOIN ( SELECT * FROM USERLOGIN A  ";
					$sql.=" LEFT JOIN(SELECT *  ";
					$sql.=" FROM CCAATTIS  ";
					$sql.=" WHERE CAT_TT='00'AND CAT_MM='00') ";
					$sql.=" AS B ON A.AMCPROVINCE=B.CAT_CC ) ";
					$sql.=" AS B ON A.AMCCODE=B.AMCCODE AND A.MEMBERHELPBRANCH=B.CAT_AA ) ";
					$sql.=" AS C ON A.MEMBERID=C.MEMBERID  ";

					$sql.=" WHERE C.AMCCODE <> '' ";
									if($div<>"")
											{ $sql.=" AND C.BR_CODE ='$div' "; }
									if($list_province<>"")		
											{ $sql.=" AND C.AMCPROVINCE='$list_province' ";}
									if($branch<>"")
											{ $branch2=substr($branch,2,2);	$sql.=" AND C.MEMBERHELPBRANCH='$branch2'";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.MEMBERID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND A.MEMBERNAME like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND A.MEMBERLASTNAME like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND A.MEMBERPHONE like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND A.MEMBEREDUCATION ='$list_education' "; }
									if($txt_address<>"")		
											{ $sql.=" AND A.MEMBERADDRESS like '%$txt_address%' ";}
									$sql.="ORDER BY  C.BR_CODE, C.AMCProvince,  C.MEMBERHELPBRANCH , A.MEMBERID";
							//echo $province;		
							//echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
							if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
							if($numrows<>"0")
								{
		?>
      <br> 
      <table width="98%" border="1" cellPadding="0" cellSpacing="0" bgcolor=white class=font1 >
        <tr align=center bgcolor="#92AED1" style="color:#333333;"> 
          <td height="19" colspan=18 align=left class="boxleft5"><b> แสดงข้อเครือข่ายสมาชิก</b></td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="25">ลำดับ</td>
          <td width="80" height="25">สกต.</td>
          <td width="100">สาขาที่ช่วยงาน</td>
          <td width="100" height="25" align="center">รหัสประชาชน</td>
          <td width="100" height="25" align="center"> ชื่อ</td>
          <td width="100" height="25" align="center">นามสกุล</td>
          <td width="30" height="25"> อายุ</td>
          <td width="100" height="25">วุฒิการศึกษา</td>
          <td width="100" height="25">โทรศัพท์</td>
          <td width="140" height="25">ที่อยู่</td>
          <td width="100" height="25">หมายเหตุ</td>
        </tr>
        <?
								$i=1;
							//	$Occu=array("","เป็นเกษตรกร","ทำการค้าขาย","รับราชการ","อื่นๆ") ;/// อาชีพ
								
								$Education=array("","ไม่เกินประถมหรือเทียบเท่า","มัธยมศึกษา"," อนุปริญญา","ปริญญาตรี","สูงกว่า ปริญญาตรี");
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
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><?echo $rowall[3]?> 
          </td>
          <td height="20" align="left" class="boxleft10"><?echo $rowall[5];?></td>
          <td height="20" ><?echo $rowall[7]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[8]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[9]?></td>
          <td > 
            <?
			$a=substr($rowall[10],6,4);
			$bb =(date('Y')+543);
				if(($bb-$a)=="0"){ echo "1";}
				else{ 	echo $bb-$a;}

		  ?>
          </td>
          <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[12]]?></td>
          <td><?echo $rowall[11]?></td>
          <td align="left" class="boxleft5" ><?if(ltrim(rtrim($rowall[13]))==""){echo "-";}else {echo $rowall[13];}?></td>
          <td align="left" class="boxleft5" ><?if(ltrim(rtrim($rowall[14]))==""){echo "-";}else {echo $rowall[14];}?></td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}
						}
		?>
        <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
          <td height="2" colspan="24" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
      <script language="javascript">
window.print();
</SCRIPT></td>
  </tr>
</table>
</body>
</html>
