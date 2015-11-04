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
					$sql.=" A.AssetCategory,C.AssetName, A.AssetSize, A.AssetAmount, A.AssetValues, A.AssetApplying,A.AssetRemark ";
					$sql.=" FROM dbo.AssetDetail A  ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.="  FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince ";
					$sql.="LEFT OUTER JOIN ";
					$sql.=" ( ";
					$sql.="  SELECT *  ";
					$sql.="  FROM AssetCode ";
					$sql.=" )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory" ;
					$sql.=" WHERE A.AMCCode <>'' AND A.AssetAmount <>'' AND A.AssetValues<>''" ;
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
      <td align="right"><?echo $rowall[9];?></td>
      <td align="center"> 
        <?
		  if($rowall[10]=="1")
		  		{echo "ใช้";}
			else
				{echo 'ไม่ใช้';}
	 ?>
      </td>
      <td> 
        <?
		 if($rowall[11]==''){echo "-";}
		 else{echo $rowall[11];}
		  ?>
      </td>
    </tr>
    <?
	}
	?>
    <tr align="left"> 
      <td colspan="8"><br>
        <br>
	    <?
		  	$countA="SELECT ";
		 	$countA.=" Count(A.AssetApplying) As A ";
			$countA.=" FROM dbo.AssetDetail A  ";
			$countA.=" LEFT OUTER JOIN (SELECT * FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince  ";
			$countA.=" LEFT OUTER JOIN ( SELECT * FROM AssetCode )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory  ";
			$countA.=" WHERE A.AMCCode <>'' AND A.AssetAmount <>'' AND A.AssetValues<>''AND A.AssetApplying='1' ";
			$excountA=mssql_query($countA);
			$dataA=mssql_fetch_row($excountA);
			
			$countB="SELECT ";
		 	$countB.=" Count(A.AssetApplying) As A ";
			$countB.=" FROM dbo.AssetDetail A  ";
			$countB.=" LEFT OUTER JOIN (SELECT * FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince  ";
			$countB.=" LEFT OUTER JOIN ( SELECT * FROM AssetCode )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory  ";
			$countB.=" WHERE A.AMCCode <>'' AND A.AssetAmount <>'' AND A.AssetValues<>''AND A.AssetApplying='0' ";
			$excountB=mssql_query($countB);
			$dataB=mssql_fetch_row($excountB);
			

		   echo '*** รายการค้นหาพบทั้งหมด <b>'.$numrows.'</b>';
           echo ' รายการ<br>';
            echo 'ทรัพย์สินที่มีการใช้งานจำนวน<b>'.$dataA[0].' </b>รายการ<br>';
            echo 'ทรัพย์สินที่ไม่มีการใช้งานจำนวน <b>'.$dataB[0].' </b>รายการ';
			
			?>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
