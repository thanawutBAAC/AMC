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

<body  <? if($action<>"print"){ echo 'background="images/bg.jpg"';}?> leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<?
			if($type=="search")
			{
		?>
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="font1">
        <tr> 
          <td align="center" valign="top"> 
            <?
			include("../lib/ms_database.php");
			if($rdo_type=="personnel")
				{
					$sql="SELECT A.AMCCode, A.PersonnelID,A.PersonnelType,B.PersonnelName, C.MemberName, C.MemberLastName,C.MemberBirthday, C.MemberPhone, C.MemberEducation,
								C.memberDegree,E.username, E.amcprovince,E.userdetail, E.br_code, E.br_name, D.A, D.B, D.C, D.D, D.E
								FROM PersonnelGroup A 
								LEFT JOIN PersonnelCode B ON A.PersonnelType=b.PersonnelType 
								LEFT JOIN AMCCustomer C ON A.PersonnelID=C.MemberID 
								LEFT JOIN userlogin E ON A.AMCCode=E.AMCCode
								
								LEFT JOIN ( SELECT CustomerID, count(case when TestID = '01' Then TestID END)AS A, 
								count(case when TestID = '02' Then TestID END)AS B, count(case when TestID = '03' Then TestID END)AS C,
								count(case when TestID = '04' Then TestID END)AS D, count(case when TestID = '05' Then TestID END)AS E 
								FROM AMCTest GROUP By CustomerID ) 
								D ON A.PersonnelID=D.CustomerID 
								WHERE A.AMCCode<> ''  ";
								
									if($div<>"") {
										$sql.="AND E.br_code='$div' "; }
									if($list_province<>""){
										$sql.=" AND E.AMCProvince='41' "; }
									if($txt_user_id<>""){
										$sql.=" AND A.PersonnelID like '%$txt_user_id%' ";}
									if($txt_name<>""){
										$sql.= " AND C.MemberName like '%$txt_name%' ";}
									if($txt_lastname<>""){
										$sql.=" AND C.MemberLastName like '%$txt_lastname%' "; }
										
									if($education<>""){
											if($education=="01"){
												$sql.=" AND D.A>'0' AND D.A is not null"; }
											if($education=="02"){
												$sql.=" AND D.B>'0' AND D.B is not null"; }
											if($education=="03"){
												$sql.=" AND D.C>'0' AND D.C is not null" ;}
											if($education=="04"){
												$sql.=" AND D.D>'0' AND D.D is not null" ;}
											if($education=="05"){
												$sql.=" AND D.E>'0' AND D.E is not null" ;}
												
									}
				}
			if($rdo_type=="committee"){
				$sql="SELECT A.AMCCode, A.CommitteeID,A.CommitteeType,B.CommitteeName, C.MemberName, C.MemberLastName,C.MemberBirthday, 
				C.MemberPhone, C.MemberEducation, C.memberDegree,E.username, E.amcprovince,E.userdetail, E.br_code, E.br_name, 
				D.A, D.B, D.C, D.D, D.E FROM CommitteeGroup A 
				LEFT JOIN CommitteeCode B ON A.CommitteeType=b.CommitteeType 
				LEFT JOIN AMCCustomer C ON A.CommitteeID=C.MemberID 
				LEFT JOIN userlogin E ON A.AMCCode=E.AMCCode 
				LEFT JOIN ( SELECT CustomerID, 
				count(case when TestID = '01' Then TestID END)AS A, 
				count(case when TestID = '02' Then TestID END)AS B, 
				count(case when TestID = '03' Then TestID END)AS C, 
				count(case when TestID = '04' Then TestID END)AS D, 
				count(case when TestID = '05' Then TestID END)AS E 
				FROM AMCTest GROUP By CustomerID ) D ON A.CommitteeID=D.CustomerID 
				WHERE A.AMCCode<> ''  ";
				
						if($div<>"") {
							$sql.="AND E.br_code='$div' "; }
						if($list_province<>""){
							$sql.=" AND E.AMCProvince='41' "; }
						if($txt_user_id<>""){
							$sql.=" AND A.CommitteeID like '%$txt_user_id%' ";}
						if($txt_name<>""){
							$sql.= " AND C.MemberName like '%$txt_name%' ";}
						if($txt_lastname<>""){
							$sql.=" AND C.MemberLastName like'%$txt_lastname%' "; }
							
						if($education<>""){
								if($education=="01"){
									$sql.=" AND D.A>'0' AND D.A is not null"; }
								if($education=="02"){
									$sql.=" AND D.B>'0' AND D.B is not null"; }
								if($education=="03"){
									$sql.=" AND D.C>'0' AND D.C is not null" ;}
								if($education=="04"){
									$sql.=" AND D.D>'0' AND D.D is not null" ;}
								if($education=="05"){
									$sql.=" AND D.E>'0' AND D.E is not null" ;}
									
						}

				}
				//echo $sql;
				$exsql=mssql_query($sql);
	?>
            <br> <table  <?if($action=="print"){echo 'border="1"';}?> style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="98%" border="0" class=font1 bgcolor=white>
              <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                <td height="19" colspan=13 align=left><b>&nbsp; แสดงข้อมูลประวัติการฝึกอบรม<span class="txtred"><u> 
                  <?if($type=="personnel"){echo "เจ้าหน้าที่";} if($type=="committee"){echo "คณะกรรมการ";}?>
                  </u></span></b></td>
              </tr>
              <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                <td width="5%" height="40" rowspan="2">ลำดับ</td>
                <td width="10%" rowspan="2">สกต.</td>
                <td width="10%" rowspan="2">ตำแหน่ง</td>
                <td width="10%" rowspan="2" align="center">รหัสประชาชน</td>
                <td width="10%" rowspan="2" align="center"><br>
                  ชื่อ<br> <br> </td>
                <td width="10%" rowspan="2" align="center">นามสกุล</td>
                <td height="25" colspan="5" bgcolor="#F0B49F">หมวดวิชาที่ฝึกอบรม</td>
                <td width="5%" rowspan="2">ข้อมูล<br>
                  การอบรม</td>
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
								if($rdo_type=="personnel")
									{
						?>
               <tr align=center bgcolor="#F0F0F0" style="color:#666666;" onMouseOver="this.style.cursor='hand'" onClick="window.location.href ='rpt_testing_people.php?USER_ID=<? echo $rowall[1];?>&positions=<?echo $rowall[3]?>&name=<?echo $rowall[4]?>&lastname=<?echo $rowall[5]?>&type=personnel'"> 
                
          <td height="20" align=center> <?echo ($P=$P+1);?></td>
                <td height="20" align="left" class="boxleft10"><?echo $rowall[12]?></td>
                <td height="20" align="left" class="boxleft10"> 
                  <?
									echo $rowall[3];
									$b1=substr($rowall[1],0,1); 
									$b2=substr($rowall[1],1,4);
									$b3=substr($rowall[1],5,5);
									$b4=substr($rowall[1],10,2);
									$b5=substr($rowall[1],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
					?>
                </td>
                <td height="20" > 
                  <?=$show_id; ?>
                </td>
                <td height="20" ><?echo $rowall[4];?></td>
                <td height="20" ><?echo $rowall[5];?></td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[15]=="0" OR $rowall[15] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[16]=="0" OR $rowall[16] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[17]=="0" OR $rowall[17] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[18]=="0" OR $rowall[18] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[19]=="0" OR $rowall[19] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td style="color:#FF0080;border:1px solid #F0F0F0;"><a href="rpt_testing_people.php?USER_ID=<? echo $rowall[1];?>&type=personnel"><img src="../TreeImages/profile.gif" alt="ดูข้อมูลการฝึกอบรมทั้งหมด" border="0"></a> 
                </td>
              </tr>
              <?
							}
					if($rdo_type=="committee")
							{
						?>
			  <tr align=center bgcolor="#F0F0F0" style="color:#666666;" onMouseOver="this.style.cursor='hand'" onClick="window.location.href ='rpt_testing_people.php?USER_ID=<? echo $rowall[1];?>&positions=<?echo $rowall[3]?>&name=<?echo $rowall[4]?>&lastname=<?echo $rowall[5]?>&type=committee'"> 
                <td height="20" align=center> <?echo ($P=$P+1);?> </td>
                <td height="20" align="left" class="boxleft10"><?echo $rowall[12]?> 
                </td>
                <td height="20" align="left" class="boxleft10"> 
                  <?
									echo $rowall[3];
									$b1=substr($rowall[1],0,1); 
									$b2=substr($rowall[1],1,4);
									$b3=substr($rowall[1],5,5);
									$b4=substr($rowall[1],10,2);
									$b5=substr($rowall[1],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
							?>
                </td>
                <td height="20" > 
                  <?=$show_id; ?>
                </td>
                <td height="20" ><?echo $rowall[4];?></td>
                <td height="20" ><?echo $rowall[5];?></td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[15]=="0" OR $rowall[15] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[16]=="0" OR $rowall[16] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[17]=="0" OR $rowall[17] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[18]=="0" OR $rowall[18] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td align="center" bgcolor="#F9EAE8" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                  <? if($rowall[19]=="0" OR $rowall[19] == null)
						  		{ echo '<input type="checkbox" name="checkbox" value="checkbox" disabled> ';} 
							else 
								{echo '<img src="images/checked.gif">';}
							?>
                </td>
                <td style="color:#FF0080;border:1px solid #F0F0F0;"><a href="rpt_testing_people.php?USER_ID=<? echo $rowall[1];?>&type=committee"><img src="../TreeImages/profile.gif" alt="ดูข้อมูลการฝึกอบรมทั้งหมด"  border="0"></a> 
                </td>
              </tr>
              <?
						}
						}
					  ?>
              <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                <td height="1" colspan="13" align=left> </td>
              </tr>
            </table>
			
      <br>
	  <?if($action<>"print")
			{
	  ?>
      <input  style="width:130px"type="submit" name="Submit22" value="ต้องการพิมพ์ส่วนนี้"  onClick="window.open('rpt_testing_report.php?div=<?echo $div?>&list_province=<?echo $list_province?>&list_committee=<?echo $list_committee?>&list_personnel=<?echo $list_presonnel?>&txt_user_id=<?echo $txt_user_id?>&txt_name=<?echo $txt_name?>&txt_lastname=<?echo $txt_lastname?>&rdo_type=<?echo $rdo_type?>&type=<?echo $type;?>&action=print&education=<?echo $education;?>')"> 
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tahoma11px">
        <tr> 
          <td valign="top" class="boxleft10"><span class="txtred"><b>หมายเหตุ</b></span></td>
        </tr>
        <tr> 
          <td class="boxleft10"> &nbsp;<img src="images/checked.gif" width="13" height="13"> 
            <span class="txtwhite">ผ่านการอบรม</span> </td>
        </tr>
        <tr> 
          <td class="boxleft10"> <input type="checkbox" name="checkbox" value="checkbox" disabled> 
            <span class="txtwhite">ยังไม่ได้อบรม</span></td>
        </tr>
      </table>
			<?
				}
				else
				{
				 ?>
			<script language="javascript">
			window.print();
			window.close();
			</SCRIPT>
				 <?
				}
			?>
			</td>
        </tr>
      </table>
      
<?}?>
</body>
</html>
