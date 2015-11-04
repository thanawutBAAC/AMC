<html>
<head>
<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<body bgcolor="#FFFFFF">
<form name="form1" method="post" action="sample8.php">
  <?
$host="localhost";
$username="";
$pass_word="";
$db="mydatabase";
$tb="color";
mysql_connect( $host,$username,$pass_word) or die ("ติดต่อกับฐานข้อมูล Mysql ไม่ได้ ");
mysql_select_db($db) or die("เลือกฐานข้อมูลไม่ได้"); 

$sql="Select * From $tb order by color_no asc";
$db_query=mysql_db_query($db,$sql);
$num_rows=mysql_num_rows($db_query); /* นับ Reccord ที่พบ */
?>
  กรุณาเลือกสี 
  <select name="color_no" onChange="MM_jumpMenu('parent',this,0)">
    <option selected>กรุณาเลือกสี</option>
    <option>unnamed1</option>
    <option value="Sample10.php?color_no=<?echo $color_no;?>"> <?echo $color_name;?> 
    </option>
    <option>unnamed2</option>
  </select>
  <br>
</form>
</body>
</html>




