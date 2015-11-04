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
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><div align="center"> 
        <?
					include ("../lib/ms_database.php");

					$sql="SELECT A.AMCCode, A.AssetProvince, B.br_code, B.userdetail, A.AssetType, ";
					$sql.=" A.AssetCategory,C.AssetName, A.AssetSize, A.AssetAmount, A.AssetTypeGround, A.AssetValues, A.AssetApplying,A.AssetRemark, A.AssetSize2, A.AssetSize3 ";
					$sql.=" FROM dbo.AssetDetail A  ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.="  FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince ";
					$sql.="LEFT OUTER JOIN ";
					$sql.=" ( ";
					$sql.="  SELECT *  ";
					$sql.="  FROM AssetCode ";
					$sql.=" )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory" ;
					$sql.=" WHERE A.AMCCode <>'' ";  // AND A.AssetAmount <>'' AND A.AssetValues<>''" ;
					if($lb_prov <> '')
						{ $sql.=" AND A.AssetType='$lb_prov' ";}
					if($lb_tumbon<>'' AND $lb_tumbon<>"00")
						{$sql.="AND A.Assetcategory='$lb_tumbon' ";}
					if($div <> '')
						{$sql.=" AND B.br_code='$div' "; }
					if($lis_province <> '')
						{ $sql.="AND A.AssetProvince ='$lis_province' " ;}
						$sql.=" ORDER BY  A.AssetProvince ";
				//	echo $sql;
					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
					
					if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ไม่พบข้อมูลในการค้นหา</span></div>";} // ค้นหาไม่เจอ 
					if($search=="find" AND $numrows>=1)  // เมื่อมีการกด ปุ่ม ค้นหา
					{
		?>
        <table style="margin: 7px 0px 0px 0px" cellspacing="0" cellpadding="0" width="98%" border="1" class=font1 bgcolor=white>
          <tr align="center" bgcolor="#92AED1" class=font1 style="color:#333333"> 
            <td width=4% height="28"><b>ลำดับ</b></td>
            <td width=13%><b>ชือ สกต.</b></td>
            <td width="20%"><b> ประเถททรัพสิน </b></td>
            <td width=10%><b>ขนาด</b></td>
            <td width="10%" align="center"><b>จำนวน</b></td>
            <td width="10%" align="center"><b>ประเภทที่ดิน</b></td>
            <td width=10%><b>มูลค่าปัจจุบัน</b></td>
            <td width="10%"><b>การใช้ประโยชน์</b></td>
            <td width="27%"><b>หมายเหตุ</b></td>
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
          <tr align=left class=font1 style="color:#666666;" <?echo $bgcolor;?>> 
            <td height="20" align="center" ><?echo $number=$number+1;?></td>
            <td height="20" align="left"  class="boxleft15"><? echo "สกต. ".$rowall[3];?></td>
            <td height="20" align="left"  class="boxleft15"><?echo $rowall[6]?></td>
            <td height="20"  class="boxleft15">
              <?
			if($rowall[4]=="01")
				{
					if(trim($rowall[7])<>""){echo $rowall[7].'&nbsp;ไร่&nbsp;';}
					if(trim($rowall[13])<>""){echo $rowall[13].'&nbsp;งาน&nbsp;';}
					if(trim($rowall[14])<>""){echo $rowall[14].'&nbsp;ตรว.&nbsp;';}
				}
			else
			{
			 echo $rowall[7];
			}
		  
		  ?>
            </td>
            <td align="center"  class="boxleft15" border:1px solid #F0F0F0;"><?echo $rowall[8];?></td>
            <td align="center"  class="boxleft15" border:1px solid #F0F0F0;"><?echo $rowall[9];?></td>
            <td height="20"  class="boxleft15"><?echo $rowall[10];?></td>
            <td height="20" align="center"   border:1px solid #F0F0F0;"> 
              <?
		  if($rowall[11]=="1")
		  		{echo "ใช้";}
			else
				{echo '<span class="txtred">ไม่ใช้</span>';}
	 ?>
            </td>
            <td class="boxleft15"border:1px solid #F0F0F0;"> 
              <?
		 if($rowall[12]==''){echo "-";}
		 else{echo $rowall[12];}
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
      </div></td>
  </tr>
</table>
</body>
</html>
