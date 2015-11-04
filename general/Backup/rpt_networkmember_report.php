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
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
							if($numrows<>"0" AND $search=="1")
								{
		?>
      <br> 
      <table width="98%" border="0" cellPadding="0" cellSpacing="1" bgcolor=white class=font1 >
        <tr align=center bgcolor="#92AED1" style="color:#333333;"> 
          <td height="19" colspan=18 align=left class="boxleft5"><b>ข้อมูลเครือข่ายสมาชิก</b></td>
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
          <td align="left" class="boxleft5" ><?echo $rowall[13]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[14]?></td>
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

								echo '<span class="font1"><span class="txtwhite">แสดงหน้าที่ <b><span class="txtred">'.$pagenum1.'</span></b> 
									จากทั้งหมด <b>'.$allpage.'
									</b>หน้า</span></span>
									<br>';
						}
						
						  if ($allpage>1)
								 {
									for($i=1; $i<=$allpage; $i++)
									{
										$b=$i-1;
										if($pagenum+1==$i)
											{	echo "<font color='red'>";}
										else
											{	echo "<font color='black'>";}
											
										//ตัดแถวของจำนวนหน้า แถวละ 15 เพจ
											$d=10;
											$modpage=$i/$d;
											$modpage=ceil($modpage);
											
											$mpage=$i/$d;
											
											if($mpage==$modpage)
												{ $br="<br>";}
											if($mpage<>$modpage)
												{ $br="";}
										echo '<span class="font1">[&nbsp;<a  class="link_page" href ="rpt_networkmember_report.php?pagenum='.$b.'&div='.$div.'&list_province='.$list_province.'&branch='.$branch.'&txt_user_id='.$txt_user_id.'&list_personnel='.$list_personnel.'&txt_name='.$txt_name.'&txt_lastname='.$txt_lastname.'&txt_phone='.$txt_phone.'&list_education='.$list_education.'&txt_address='.$txt_address.'">'.$i.'</a>&nbsp;]</font>&nbsp;</span>'.$br;
									}
								}
		  ?>
            <br>
            <br>
            <input  style="width:130px"type="submit" name="Submit22" value="ต้องการพิมพ์ส่วนนี้"  onClick="window.open('rpt_networkmember_printing.php?pagenum=<?echo $pagenum?>&div=<?echo $div?>&list_province=<?echo $list_province?>&branch=<?echo $branch?>&txt_user_id=<?echo $txt_user_id?>&txt_name=<?echo $txt_name?>&txt_lastname=<?echo $txt_lastname?>&txt_phone=<?echo $txt_phone?>&list_education=<?echo $list_education?>&txt_address=<?echo $txt_address;?>')">
            &nbsp; 
            <input  style="width:130px"type="submit" name="Submit232" value="ส่งข้อมูลออกเป็น Excel"  onClick="window.open('rpt_networkmember_portexcel.php?pagenum=<?echo $pagenum?>&div=<?echo $div?>&list_province=<?echo $list_province?>&branch=<?echo $branch?>&txt_user_id=<?echo $txt_user_id?>&txt_name=<?echo $txt_name?>&txt_lastname=<?echo $txt_lastname?>&txt_phone=<?echo $txt_phone?>&list_education=<?echo $list_education?>&txt_address=<?echo $txt_address?>&txt_address=<?echo $txt_address?>')">
            <br>
            <br>
          </td>
        </tr>
      </table>
      <?
	  		}  // if $search;
	  ?>
    </td>
  </tr>
</table>
</body>
</html>