<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
					//echo $sql;
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
        <tr align="left" bgcolor="#92AED1" class=font1 style="color:#333333"> 
          <td height="19" colspan="9" class="boxleft5"> <b> 
            <?
		  		if($AssetType=="01") {echo "แสดงข้อมูลทรัพย์สินประเภทที่ดิน";}
		  		if($AssetType=="02") {echo "แสดงข้อมูลทรัพย์สินประเภทสิ่งปลูกสร้าง";}
		  		if($AssetType=="03") {echo "แสดงข้อมูลทรัพย์สินประเภททยานพาหนะ";}
		  		if($AssetType=="04") {echo "แสดงข้อมูลทรัพย์สินประเภทเครื่องใช้สำนักงาน";}
				if($AssetType==""){  echo "แสดงข้อมูลทรัพย์สินทุกประเภท";}
		  ?>
            </b> </td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" class=font1 style="color:#333333"> 
          <td width=4% height="28"><b>ลำดับ</b></td>
          <td width=13%><b>ชื่อ สกต.</b></td>
          <td width="20%"><b> ประเภททรัพย์สิน </b></td>
          <td width=10%><b>ขนาด</b></td>
          <td width="5%" align="center"><b>จำนวน</b></td>
          <td width="8%" align="center"><b>ประเภท</b></td>
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
							
						?>
        <tr align=left style="color:#666666;"> 
          <td height="20" align="center" bgcolor="#F0F0F0"><?echo $number=$number+1;?></td>
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft15"><? echo "สกต. ".$rowall[3];?></td>
          <td bgcolor="#F0F0F0" class="boxleft15" style="border:1px solid #F0F0F0;"><?echo $rowall[6]?></td>
          <td height="20" align="center" bgcolor="#F0F0F0"><?
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
		  
		  ?></td>
          <td align="center" bgcolor="#F0F0F0" ><? echo $rowall[8];?></td>
          <td align="center" bgcolor="#F0F0F0" >
		<?
				echo $rowall[9];
		?> 
         </td>
          <td height="20" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[10];?></td>
          <td height="20" align="center" bgcolor="#F0F0F0"  > 
            <?
		  if($rowall[11]=="1")
		  		{echo "ใช้";}
			else
				{echo '<span class="txtred">ไม่ใช้</span>';}
		  ?>
          </td>
          <td bgcolor="#F0F0F0" class="boxleft15" > 
            <?
		 if($rowall[12]==''){echo "-";}
		 else{echo $rowall[12];}
		  ?>
          </td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// ออกจากลูปโดยอัตโนมัติ เมื่อครบตามที่กำหนดตามลูป
						{  break;	}
							$i++;
						}
		?>
        <tr > 
          <td height="2" colspan="9" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
	  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="font1">
        <tr> 
          <td height="20"> 
            <?
		  	$countA="SELECT ";
		 	$countA.=" Count(A.AssetApplying) As A ";
			$countA.=" FROM dbo.AssetDetail A  ";
			$countA.=" LEFT OUTER JOIN (SELECT * FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince  ";
			$countA.=" LEFT OUTER JOIN ( SELECT * FROM AssetCode )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory  ";
			$countA.=" WHERE A.AMCCode <>'' AND A.AssetApplying='1' ";
				if($AssetType <> '')
					{ $countA.=" AND A.AssetType='$AssetType' ";}
				if($div <> '')
					{$countA.=" AND B.br_code='$div' "; }
				if($lis_province <> '')
					{ $countA.="AND A.AssetProvince ='$lis_province' " ;}

			$excountA=mssql_query($countA);
			$dataA=mssql_fetch_row($excountA);
			
			//echo $countA.'<br>';
			
			
			$countB="SELECT ";
		 	$countB.=" Count(A.AssetApplying) As A ";
			$countB.=" FROM dbo.AssetDetail A  ";
			$countB.=" LEFT OUTER JOIN (SELECT * FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince  ";
			$countB.=" LEFT OUTER JOIN ( SELECT * FROM AssetCode )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory  ";
			$countB.=" WHERE A.AMCCode <>'' AND A.AssetApplying='0' ";
				if($AssetType <> '')
					{ $countB.=" AND A.AssetType='$AssetType' ";}
				if($div <> '')
					{$countB.=" AND B.br_code='$div' "; }
				if($lis_province <> '')
					{ $countB.="AND A.AssetProvince ='$lis_province' " ;}
			
			$excountB=mssql_query($countB);
			$dataB=mssql_fetch_row($excountB);
			//echo $countB;

		   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=txtwhite>*** รายการค้นหาพบทั้งหมด <b>'.$numrows.'</b>';
           echo ' รายการ<br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<img src="images/icon_green.gif" width="6" height="6">  ';
            echo '&nbsp;ทรัพย์สินที่มีการใช้งานจำนวน<span class=txtred> <b>'.$dataA[0].' </b></span>รายการ<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';
            echo '<img src="images/icon_red.gif" width="6" height="6"> &nbsp;ทรัพย์สินที่ไม่มีกาีรใช้งานจำนวน<span class =txtred> <b>'.$dataB[0].' </b></span>รายการ';
			
			?>
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
										echo '<span class="font1">[&nbsp;<a class="link_page" href ="rpt_asset_report.php?pagenum='.$b.'&div='.$div.'&lis_province='.$lis_province.'&AssetType='.$AssetType.'&search='.$search.'">'.$i.'</a>&nbsp;]</font>&nbsp;</span>'.$br;
									}
								}
		  
		  ?>
            <br>
            <br>
          </td>
        </tr>
      </table>
      <input  style="width:130px"type="submit" name="Submit2" value="ต้องการพิมพ์ส่วนนี้"  onClick="window.open('rpt_asset_printing.php?pagenum=<?echo $pagenum?>&search=<?echo $search?>&div=<?echo $div?>&lis_province=<?echo $lis_province?>&lb_prov=<?echo $lb_prov?>&lb_tumbon=<?echo $lb_tumbon;?>')">
      &nbsp; 
      <input  style="width:130px"type="submit" name="Submit22" value="ส่งข้อมูลออกเป็น Excel"  onClick="window.open('rpt_asset_portexcel.php?pagenum=<?echo $pagenum?>&search=<?echo $search?>&div=<?echo $div?>&lis_province=<?echo $lis_province?>&lb_prov=<?echo $lb_prov?>&lb_tumbon=<?echo $lb_tumbon;?>')">
      <?
	  		}  // if $search;
	  ?>
      <br>
      <br>
  </tr>
</table>
</body>
</html>
