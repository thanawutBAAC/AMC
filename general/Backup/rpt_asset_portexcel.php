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
<title>exportexcel</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel"> 
 <?
					include ("images/lib/ms_database.php");

					$sql="SELECT A.AMCCode, A.AssetProvince, B.br_code, B.userdetail, A.AssetType, ";
					$sql.=" A.AssetCategory,C.AssetName, A.AssetSize, A.AssetAmount, A.AssettypeGround, A.AssetValues, A.AssetApplying,A.AssetRemark ";
					$sql.=" FROM dbo.AssetDetail A  ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.="  FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince ";
					$sql.="LEFT OUTER JOIN ";
					$sql.=" ( ";
					$sql.="  SELECT *  ";
					$sql.="  FROM AssetCode ";
					$sql.=" )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory" ;
					$sql.=" WHERE A.AMCCode <>'' ";// AND A.AssetAmount <>'' AND A.AssetValues<>''" ;
					if($AssetType <> '')
						{ $sql.=" AND A.AssetType='$AssetType' ";}
					if($div <> '')
						{$sql.=" AND B.br_code='$div' "; }
					if($lis_province <> '')
						{ $sql.="AND A.AssetProvince ='$lis_province' " ;}
						$sql.=" ORDER BY  A.AssetProvince ";
				//	echo $sql;
					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);

		?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#666666"> 
      <td height="25"><b>ลำดับ</b></td>
      <td><b>ชื่อ สกต.</b></td>
      <td><b>ประเภททรัพย์สิน</b></td>
      <td><b>ขนาด</b></td>
      <td><b>จำนวน</b></td>
      <td><b>ประเภทที่ดิน</b></td>
      <td><b>มูลค่าปัจจุบัน</b></td>
      <td><b>การประโชยน์</b></td>
      <td><b>หมายเหตุ</b></td>
    </tr>
    <?		
		while($rowall=mssql_fetch_row($exsql)) 
			{
	?>
    <tr> 
      <td align="center"><?echo $number=$number+1;?></td>
      <td><? echo "สกต. ".$rowall[3];?></td>
      <td><?echo $rowall[6]?></td>
      <td><?echo $rowall[7]?></td>
      <td align="center"><?echo $rowall[8];?></td>
      <td align="center"><?echo $rowall[9];?></td>
      <td align="right"><?echo $rowall[10];?></td>
      <td align="center"> 
        <?
		  if($rowall[11]=="1")
		  		{echo "ใช้";}
			else
				{echo 'ไม่ใช้';}
	 ?>
      </td>
      <td> 
        <?
		 if($rowall[12]==''){echo "-";}
		 else{echo $rowall[12];}
		  ?>
      </td>
    </tr>
    <?
	}
	?>
    <tr align="left"> 
      <td colspan="9"> </td>
    </tr>
  </table>
</div>
</body>
</html>
