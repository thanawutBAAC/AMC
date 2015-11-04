<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************************** -->
<form name="" action="target_tris.php" method="post">
<center>
<!--  แสดงข้อมูลปี -->
เลือกข้อมูลปีบัญชี
<? $temp_year =  date("Y")+525; ?>
<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>" <? if($temp_year==date("Y")+543) echo "selected"; ?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>	&nbsp;&nbsp;
เลือกฝ่ายกิจการสาขา
<select name="br_code">
	<option value="all" selected> ทุกฝ่าย </option>
	<option value="1"> ฝ่ายกิจการสาขา 1</option>
	<option value="2"> ฝ่ายกิจการสาขา 2</option>
	<option value="3"> ฝ่ายกิจการสาขา 3</option>
	<option value="4"> ฝ่ายกิจการสาขา 4</option>
	<option value="5"> ฝ่ายกิจการสาขา 5</option>
	<option value="6"> ฝ่ายกิจการสาขา 6</option>
	<option value="7"> ฝ่ายกิจการสาขา 7</option>
	<option value="8"> ฝ่ายกิจการสาขา 8</option>
	<option value="9"> ฝ่ายกิจการสาขา 9</option>
</select>
<input type="hidden" name="click" value="1">
<input type="submit" value=" ค้นหาข้อมูล ">
</center>
</form>
<!-- ************************************************************************************* -->
<? if(isset($click)) { 
	$year = $_POST["year"];
	connect();
	$sql =" SELECT  userlogin.amccode, userlogin.userdetail, userlogin.br_name, Temp01.amccode ";
	$sql.=" FROM   userlogin ";
	$sql.=" LEFT JOIN ( ";
	$sql.="  SELECT amccode ";
	$sql.="  FROM TargetTris ";
	$sql.="  WHERE target_year='".$year."' ";
	$sql.="  GROUP BY amccode )AS Temp01 ";
	$sql.=" ON Temp01.amccode = userlogin.amccode ";
	$sql.=" WHERE  status='N'  "; 
	if($br_code!='all')
	{
		$sql.=" AND br_code='".$br_code."' ";
	}
	$sql.=" ORDER BY br_code, userdetail ";
	$result_report = query($sql);

?>
<table width="530" align="center" class="gridtable" style="margin-top:5px;">
	<tr height="25"><td colspan="4">
	<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> ข้อมูลกำหนดเป้าหมาย Tris ราย สกต </b></center></font>
	</td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> ลำดับที่ </td>
		<td align="center" width="200"> รายชื่อ สกต. </td>
		<td align="center" width="150"> ฝ่าย </td>
		<td align="center" width="100"> สถานะ </td>
	</tr>
<?php
	$i=0;
	WHILE($result_fetch = fetch_row($result_report))
	{
		$i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
		?>
		<td align="center"><?=$i; ?></td>
		<td align="left">&nbsp;<a href="target_tris_detail.php?temp_amccode=<?=trim($result_fetch[0])?>&year=<?=$year; ?>&temp_name=<?=trim($result_fetch[1]); ?>">สกต.<?=trim($result_fetch[1]); ?></a></td>
		<td align="left">&nbsp;<?=trim($result_fetch[2]); ?></td>
		<td align="center">
		<?  if(is_null($result_fetch[3])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tag_blue_delete.png');" class="span_icon">
			<img src="../icons/tag_blue_delete.png" alt=" ไม่มีข้อมูล " class="images_icon" >
			</span>
		<? } else {  ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tag_blue_add.png');" class="span_icon">
			<img src="../icons/tag_blue_add.png" alt=" กำหนดข้อมูลแล้ว " class="images_icon" >
			</span>
		<? } // end if ?>
		</td>
	</tr>
<?php
		}  // end while
 ?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tag_blue_add.png');" class="span_icon">
<img src="../icons/tag_blue_add.png" alt=" กำหนดข้อมูลแล้ว " class="images_icon" >
</span>&nbsp;มีข้อมูล&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tag_blue_delete.png');" class="span_icon">
<img src="../icons/tag_blue_delete.png" alt=" ไม่มีข้อมูล " class="images_icon" >
</span>&nbsp;ไม่มีข้อมูล
</div>
<?  free_result($result_report);   
	close();
  } // end if ?>
</body>
</html>
<?php
	include("../footer.php")
?>