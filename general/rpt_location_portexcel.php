<? 
//session_start();
$strExcelFileName ="รายงานด้านที่ตั้ง.xls"; 
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\""); 
header("Content-Disposition: inline; filename=\"$strExcelFileName\""); 
header("Pragma: no-cache")

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script language="Javascript">
<!--
window.moveTo(0,0)
window.resizeTo(screen.width,screen.height)
}
//-->
</SCRIPT>
<style id="SiXhEaD_Excel_Styles"></style> 
<title>exportexcel</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel"> 
		<?
					include ("../lib/ms_database.php");

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

					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
					
					if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
					if($search=="find" AND $numrows>=1)  // เมื่อมีการกด ปุ่ม ค้นหา
					{
			
		?>

<!-- <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"> 
      <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="98%" border="0" >
        <tr>
    <td >  -->
      <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF"  style="margin: 7px 0px 0px 0px">
        <tr  align="center" style="color:#333333" rowspan="2"> 
          <td width="3%" height="28" bgcolor="#C8D7E3"   rowspan="2"><b>ลำดับ</b></td>
          <td width="10%" bgcolor="#C8D7E3"  rowspan="2"><b>ชื่อ สกต.</b></td>
          <td width="5%" bgcolor="#C8D7E3"  rowspan="2"><b>เลขทะเบียน<br> สกต. </b></td>
		  <td width="7%" bgcolor="#C8D7E3"  rowspan="2"><b>วันที่<br>จดทะเบียน</b></td>
          <td width="17%" bgcolor="#C8D7E3"  rowspan="2"><b>ที่อยู่ติดต่อ</b></td>
          <td width="7%" align="center" bgcolor="#C8D7E3"  rowspan="2"><b>โทรศัพท์</b></td>
          <td width="7%" bgcolor="#C8D7E3"  rowspan="2"><b>โทรสาร</b></td>
          <td width="4%" bgcolor="#C8D7E3"  rowspan="2"><b>หมายเลข<br> WAN</b></td>
		  <td width="5%" bgcolor="#C8D7E3"  rowspan="2"><b>Internet</b></td>
		  <td width="8%" bgcolor="#C8D7E3"  rowspan="2"><b>ชื่อ - สกุล</b></td>
		  <td width="4%" bgcolor="#C8D7E3"  rowspan="2"><b>ตำแหน่ง</b></td>
		  <td width="7%" bgcolor="#C8D7E3"  rowspan="2"><b>โทรศัพท์</b></td>
		  <td width="5%" bgcolor="#C8D7E3"rowspan="2"><b>หมายเหตุ</b></td>
        </tr>
        <?						
								while($rowall=mssql_fetch_row($exsql)) 
								{
							
						?>
	       <tr > 
          <td height="20" align="center" bgcolor="#F0F0F0" >&nbsp; &nbsp;</td>
          <td height="21" align="left" bgcolor="#F0F0F0"  >&nbsp; &nbsp;</td>
          <td bgcolor="#F0F0F0"  align="center"  >&nbsp;&nbsp; </td>
          <td height="15" bgcolor="#F0F0F0" align="left" >&nbsp; &nbsp;</td>
		  <td height="20" bgcolor="#F0F0F0"  >&nbsp; &nbsp;</td>
          <td align="center" bgcolor="#F0F0F0" >&nbsp; &nbsp;</td>
          <td height="20" bgcolor="#F0F0F0"   >&nbsp; &nbsp;</td>
          <td height="20"  align="center" bgcolor="#F0F0F0"  >&nbsp; &nbsp; </td>
		  <td height="20" bgcolor="#F0F0F0"  >&nbsp; &nbsp;
		</td>
		  <td height="20" bgcolor="#F0F0F0"   >&nbsp; &nbsp;</td>
		  <td height="20" bgcolor="#F0F0F0"  >&nbsp; &nbsp; </td>
		  <td height="20" bgcolor="#F0F0F0"  > &nbsp; &nbsp;</td>
 <td align="center" bgcolor="#F0F0F0" > 
&nbsp; &nbsp;
          </td>
        </tr>

       <tr > 
          <td height="20" align="center" bgcolor="#F0F0F0" rowspan="2" ><?echo $number=$number+1;?></td>
          <td height="21" align="left" bgcolor="#F0F0F0"  rowspan="2" >&nbsp;<? echo "สกต. ".$rowall[2];?>&nbsp; &nbsp;</td>
          <td bgcolor="#F0F0F0"  align="center" rowspan="2" >&nbsp;<?echo $rowall[3];?>&nbsp; </td>
          <td height="15" bgcolor="#F0F0F0" align="left" rowspan="2"  >&nbsp; &nbsp;<?echo $rowall[4];?>&nbsp; &nbsp;</td>
		  <td height="20" bgcolor="#F0F0F0" rowspan="2"  >&nbsp; &nbsp;<?echo $rowall[5];?>&nbsp; &nbsp;</td>
          <td align="center" bgcolor="#F0F0F0" rowspan="2" >&nbsp; &nbsp;<?echo $rowall[6];?>&nbsp; &nbsp;</td>
          <td height="20" bgcolor="#F0F0F0"  rowspan="2"  >&nbsp; &nbsp;<?echo $rowall[7];?>&nbsp; &nbsp;</td>
          <td height="20"  align="center" bgcolor="#F0F0F0" rowspan="2"  >&nbsp; &nbsp;<?echo $rowall[8];?>&nbsp; &nbsp; </td>
		  <td height="20" bgcolor="#F0F0F0" rowspan="2"  >&nbsp; &nbsp;
						<? if($rowall[9]=="1"){echo"<span class='txtgreen'> มี";}
							else{echo"<span class='txtred'> ไม่มี";}
						?>
		</td>
		  <td height="20" bgcolor="#F0F0F0"  rowspan="2"  >&nbsp; &nbsp;<?echo $rowall[10];?> &nbsp; &nbsp;</td>
		  <td height="20" bgcolor="#F0F0F0"  rowspan="2" >&nbsp; &nbsp;<?echo $rowall[11];?>&nbsp; &nbsp; </td>
		  <td height="20" bgcolor="#F0F0F0"  rowspan="2" >&nbsp; &nbsp;<?echo $rowall[12];?> &nbsp; &nbsp;</td>
 <td align="center" bgcolor="#F0F0F0" rowspan="2" > 
<?
		 if($rowall[13]==''){echo "-";}
		 else{echo $rowall[13];}
		  ?>
          </td>
        </tr>
<?

						}
		?>

	  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="font1">
        <tr> 
          <td height="20" align="center">
          </td>
        </tr>
        <tr>
          <td align="center" align="center"> 
   <!--    <?
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
		  
		  ?> -->
            <br>
            <br>
          </td>
        </tr>
      </table>
	<?
	  		}  // if $search;
	  ?>
      <br>
      <br>
  </tr>
</table>
</div>
</body>
</html>
