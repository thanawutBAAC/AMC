<? include ("checkuser.php");?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<script language="javascript">
function checkID(id) {
    if(id.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)

        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
    return true;
}
function checkForm() {
    if(!checkID(document.form1.txtID.value))
        alert('รหัสประชาชนไม่ถูกต้อง');
    else
        alert('<รหัสประชาชนถูกต้องที่สุด');

}
</script>
<body>
<?
		include ("images/lib/ms_database.php");
						$max="SELECT MAX(AssetCategory)";
						$max.=" FROM AssetCode ";
						$max.="WHERE AssetType='02'";
						$maxEx=mssql_query($max);
						$data=mssql_fetch_array($maxEx);
						$maxrow=$data[0]; // ตำแหน่งสูงสุด
						$a=$maxrow+1;
						if(($a+1) <=9){ $plus="0".$a;}
						else{$plus=$a;}
						//echo $plus;
						
							$sql2="SELECT CAT_AA ";
							$sql2.=" FROM DBTP.DBO.CCAATTIS A ";
							$sql2.=" WHERE A.CAT_CC='$province' AND CAT_AA <> '00'AND CAT_TT='00'AND CAT_MM='00' AND CAT_DESC not like '%*%' ";
							$sql2.=" ORDER BY CAT_AA ";
							$exsql2=mssql_query($sql2);
							$numrows=mssql_num_rows($exsql2);
							echo $sql2;
							echo '<br><br>';
							
							$sql3="SELECT CAT_DESC ";
							$sql3.=" FROM DBTP.DBO.CCAATTIS A ";
							$sql3.=" WHERE A.CAT_CC='$province' AND CAT_AA <> '00'AND CAT_TT='00'AND CAT_MM='00' AND CAT_DESC not like '%*%' ";
							$sql3.=" ORDER BY CAT_AA ";
							$exsql3=mssql_query($sql3);
							echo $sql3;
							
							$rowall2=mssql_fetch_array($exsql2);
							$rowall3=mssql_fetch_array($exsql3);
							echo '<br><br>';
							echo $numrows;
							$i=1;
							echo $rowall2[$i];
							echo $rowall2[2]; 

							echo '<select name="branch'.$i.'">';
							for($b=3;$b<=8;$b++)
								{
								//	echo '<option value="'.$rowall2[$b].'">'.$rowall3[$b].'</option>';
								echo '<option value="23">'.$rowall3[$b].'</option>';


								}
							echo '</select>';

?>

<!-- ลองนำไปประยุกต์ใช้ดูครับ ไม่ยากๆ -->
<form name="form1" onsubmit="checkForm(); return false;">
โปรดกรอกเลขที่บัตร<b style="color:white;background-color:#880000">ประชาชน</b> : <input name="txtID" type="text" size="20">
<input value="ตรวจสอบ" type="submit">
</form>
</body>
</html>
