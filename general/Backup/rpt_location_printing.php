<? session_start();?>
<html>
<head>
<title>พิมพ์ข้อมูล</title>
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

				//	echo $sql;


					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
					
					if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
					if($search=="find" AND $numrows>=1)  // เมื่อมีการกด ปุ่ม ค้นหา
					{
			
		?>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"> 
      <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="98%" border="0" class=font1 bgcolor=white>
        <tr>
    <td align="center" valign="top"> 
      <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="98%" border="0" class=font1 bgcolor=white>
        <tr align="center" bgcolor="#92AED1" class=font1 style="color:#333333"> 
          <td width=3% height="28"><b>ลำดับ</b></td>
          <td width=10%><b>ชื่อ สกต.</b></td>
          <td width="5%"><b>เลขทะเบียน<br> สกต. </b></td>
		  <td width="7%"><b>วันที่<br>จดทะเบียน</b></td>
          <td width=17%><b>ที่อยู่ติดต่อ</b></td>
          <td width="7%" align="center"><b>โทรศัพท์</b></td>
          <td width=7%><b>โทรสาร</b></td>
          <td width="4%"><b>หมายเลข WAN</b></td>
		  <td width="5%"><b>Internet</b></td>
		  <td width="8%"><b>ชื่อ-สกุล</b></td>
		   <td width="4%"><b>ตำแหน่ง</b></td>
		    <td width="7%"><b>โทรศัพท์</b></td>
          <td width="5%"><b>หมายเหตุ</b></td>
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
								if(($i %2)<>"0")
									{	$bgcolor='bgcolor="#F0F0F0"';}
								if(($i%2)=="0")
									{  $bgcolor='bgcolor="#FFFFFF"';}
							
						?>
			<tr align=left class=font1 style="color:#666666;"> 
          <td height="20" align="center" bgcolor="#F0F0F0"><?echo $number=$number+1;?></td>
          <td height="21" align="left" bgcolor="#F0F0F0">&nbsp;<? echo "สกต. ".$rowall[2];?>&nbsp; &nbsp;</td>
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
          <td bgcolor="#F0F0F0" class="boxleft15"border:1px solid #F0F0F0;"> 
<?
		 if($rowall[13]==''){echo "-";}
		 else{echo $rowall[13];}
		  ?>
          </td>
        </tr>
  <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{		break;	}
							$i++;
						}
	?>
</table>
<br>
<script language="javascript">
window.print();
</SCRIPT>
<?
 } 
?>
</body>
</html>

