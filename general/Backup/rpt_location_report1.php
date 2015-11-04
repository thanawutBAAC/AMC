<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>.:: ระบบฐานข้อมูล สกต. ::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<?
					include ("images/lib/ms_database.php");
					

					$sql=" SELECT A.AMCProvince,B.br_code,B.userdetail, A.AMCCode,A.AMCRegisdate,  ";
 					$sql.=" A.AMCAddress, A.AMCTel, A.AMCFax, A.AMCWAN, ";
					$sql.=" A.AMCNet, A.AMCPosition_1_Name, A.AMCPosition_1, A.AMCPosition_1_tel ";
					$sql.=" FROM AMC A ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.=" FROM USERLOGIN)AS B ON A.AMCProvince = B.amcprovince ";
					$sql.=" WHERE A.AMCProvince <>'' AND A.AMCCode <>''  ";

					if($div <> '')
						{$sql.=" AND B.br_code='$div' "; }
					if($lis_province <> '')
						{ $sql.=" AND A.AMCProvince ='$lis_province' " ;}
					if($AMCCode <> '')
						{$sql.=" AND A.AMCCode like '%$AMCCode%' "; }
					if($AMCPhone <> '')
						{ $sql.=" AND A.AMCTel like '%$AMCPhone%' " ;}
					if($AMCFax <> '')
						{ $sql.=" AND A.AMCFax like '%$AMCFax%' " ;}

					$sql.=" ORDER BY  B.userdetail ";

					//echo $sql;

					//echo  $username;
//echo  $div;
//echo  $lis_province;
//echo  $amc;

					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
					
					if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
					if($search=="find" AND $numrows>=1)  // เมื่อมีการกด ปุ่ม ค้นหา
					{
			
		?>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"> 
      <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="98%" border="0" class=font1>
        <tr>
    <td align="center" valign="top"> 
      <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor=#FFFFFF class=font1 style="margin: 7px 0px 0px 0px">
        <tr class=font1 align="center" style="color:#333333"> 
          <td width=3% height="28" bgcolor="#C8D7E3"><b>ลำดับ</b></td>
          <td width=10% bgcolor="#C8D7E3"><b>ชื่อ สกต.</b></td>
          <td width="5%" bgcolor="#C8D7E3"><b>เลขทะเบียน<br> สกต. </b></td>
		  <td width="7%" bgcolor="#C8D7E3"><b>วันที่<br>จดทะเบียน</b></td>
          <td width=17% bgcolor="#C8D7E3"><b>ที่อยู่ติดต่อ</b></td>
          <td width="7%" align="center" bgcolor="#C8D7E3"><b>โทรศัพท์</b></td>
          <td width=7% bgcolor="#C8D7E3"><b>โทรสาร</b></td>
          <td width="4%" bgcolor="#C8D7E3"><b>หมายเลข WAN</b></td>
		  <td width="5%" bgcolor="#C8D7E3"><b>Internet</b></td>
		  <td width="8%" bgcolor="#C8D7E3"><b>ชื่อ - สกุล</b></td>
		   <td width="4%" bgcolor="#C8D7E3"><b>ตำแหน่ง</b></td>
		    <td width="7%" bgcolor="#C8D7E3"><b>โทรศัพท์</b></td>
      <!--     <td width="5%" bgcolor="#C8D7E3"><b>หมายเหตุ</b></td> -->
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
							
						?>
       <tr align=left class=font1 style="color:#666666;"> 
          <td height="20" align="center" bgcolor="#F0F0F0"><?echo $number=$number+1;?></td>
          <td height="21" align="left" bgcolor="#F0F0F0">&nbsp;<a href="rpt_amc_detail.php?AMCCode=<?=$rowall[3];?>&AMCName=<?=$rowall[2];?>"><? echo "สกต. ".$rowall[2];?></a>&nbsp; &nbsp;</td>
              <td bgcolor="#F0F0F0"  align="center">&nbsp;<?echo $rowall[3];?>&nbsp; </td>
              <td height="15" bgcolor="#F0F0F0" >&nbsp; &nbsp;<?echo $rowall[4];?>&nbsp; &nbsp;</td>
		  <td height="20" bgcolor="#F0F0F0" >&nbsp; &nbsp;<?echo $rowall[5];?>&nbsp; &nbsp;</td>
          <td align="center" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;">&nbsp; &nbsp;<?echo $rowall[6];?>&nbsp; &nbsp;</td>
          <td height="20" bgcolor="#F0F0F0" >&nbsp; &nbsp;<?echo $rowall[7];?>&nbsp; &nbsp;</td>
          <td height="20"  align="center" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;">&nbsp; &nbsp;<?echo $rowall[8];?>&nbsp; &nbsp; </td>
		  <td height="20" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;">&nbsp; &nbsp;
						<? if($rowall[9]=="1"){echo"<span class='txtgreen'> มี";}
							else{echo"<span class='txtred'> ไม่มี";}
						?>
		</td>
		  <td height="20" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;">&nbsp; &nbsp;<?echo $rowall[10];?> &nbsp; &nbsp;</td>
		  <td height="20" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;">&nbsp; &nbsp;<?echo $rowall[11];?>&nbsp; &nbsp; </td>
		  <td height="20" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;">&nbsp; &nbsp;<?echo $rowall[12];?> &nbsp; &nbsp;</td>
<!--           <td bgcolor="#F0F0F0" class="boxleft15"border:1px solid #F0F0F0;"> 
<?
		 if($rowall[13]==''){echo "-";}
		 else{echo $rowall[13];}
		  ?>
          </td> -->
        </tr>
<?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}
		?>
        <tr > 
          <td height="2" colspan="13" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
	  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="font1">
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

								echo '<span class="txtwhite">แสดงหน้าที่ <b><span class="txtred">'.$pagenum1.'</span></b> 
									จากทั้งหมด <b>'.$allpage.'
									</b>หน้า</span>
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
										echo '[&nbsp;<a class="link_page" href ="rpt_location_report1.php?pagenum='.$b.'&div='.$div.'&lis_province='.$lis_province.'&AMCCode='.$AMCCode.'&AMCTel='.$AMCPhone.'&AMCFax='.$AMCFax.'&search='.$search.'">'.$i.'</a>&nbsp;]</font>&nbsp;'.$br;
									}
								}
		  
		  ?>
            <br>
            <br>
          </td>
        </tr>
      </table>
     <input  style="width:130px"type="submit" name="Submit2" value="ต้องการพิมพ์ส่วนนี้"  onClick="window.open('rpt_location_printing.php?pagenum=<?echo $pagenum?>&search=<?echo $search?>&div=<?echo $div?>&lis_province=<?echo $lis_province?>&AMCCode =<?echo $AMCCode?>&AMCTel=<?echo $AMCPhone?>&AMCFax=<?echo $AMCFax?>')"> 
	  &nbsp; 
      <input  style="width:130px"type="submit" name="Submit22" value="ส่งข้อมูลออกเป็น Excel"  onClick="window.open('rpt_location_portexcel.php?pagenum=<?echo $pagenum?>&search=<?echo $search?>&div=<?echo $div?>&lis_province=<?echo $lis_province?>&AssetType=<?echo $AssetType?>')">
	<?
	  		}  // if $search;
	  ?>
      <br>
      <br>
  </tr>
</table>
</body>
</html>
