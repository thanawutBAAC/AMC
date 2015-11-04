<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"> 
      <?
			include ("../lib/ms_database.php");
		if($search=="find")
			{
			$sql=" SELECT A.AMCCode, A.AMCProvince,B.userDetail,B.br_code,B.Br_name,A.AMCAddress,A.AMCTel,A.AMCFax,";
			$sql.=" A.AMCWan,A.AMCRegisdate,A.AMCUpdate ";
			$sql.=" FROM AMC A ";
			$sql.=" RIGHT JOIN  ";
			$sql.=" (SELECT * FROM USERLOGIN)AS B ";
			$sql.=" ON B.AMCCode=A.AMCCode ";
			$sql.=" WHERE B.AMCProvince<> '' AND A.AMCProvince<>'' ";
			
			if($div<>"")
				{$sql.="AND BR_Code='$div' ";}
			if($lis_province<>"")
				{$sql.="AND A.AMCProvince='$lis_province'";}
			$exsql=mssql_query($sql);
			
				
			?>
      <table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
        <tr align="left" bgcolor="#92AED1"> 
          <td height="25" colspan="4" class="boxleft10"><b>ค้นหาข้อมูล สกต. ทั้งหมด</b> 
          </td>
        </tr>
        <tr align="center" bgcolor="#C8D7E3"> 
          <td width="10%" height="20">ลำดับ</td>
          <td width="60%" height="20">ชื่อ สกต.</td>
          <td width="20%" height="20">แก้ไข</td>
        </tr>
        <?
					$i=1;
				while($rowall=mssql_fetch_array($exsql))
						{
		?>
        <tr bgcolor="#F0F0F0" onmouseover="this.bgColor='#EAE9D8' " onmouseout="this.bgColor='#F0F0F0' " > 
          <td height="20" align="center"><?echo $i;?></td>
          <td class="boxleft10"><?echo 'สกต.'.$rowall[2];?></td>
          <td align="center"><a href="amc_general_edit_admin.php?amccode=<?echo $rowall[0];?>">แก้ไขข้อมูล</a></td>
        </tr>
        <?
			
				$i++;
				}

		?>
        <tr bgcolor="#92AED1"> 
          <td height="3" colspan="4"> </td>
        </tr>
      </table>
	  
	  <?
				if($delete=="yes")
					{
						echo '<script>alert("ข้อมูลเรียบร้อยแล้ว");</script>'; 
					}	  
						}
	  ?>
      <br>
      <br>
    </td>
  </tr>
</table>
</body>
</html>
