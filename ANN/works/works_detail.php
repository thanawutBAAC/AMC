<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");

	connect();	
	$click = $_GET['click'];

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
<script language="JavaScript">
	function check_submit()
	{
		var temp_false = false;
		for(i=1;i<=12;i++)
		{
			for(j=1;j<=10;j++)
			{
				temp_01 = document.getElementById(j+"x"+i);
				if(temp_01.value.length==0)
				{
					temp_false = true;		
				}  // end if 
			}  // end for j 
		}  // end for i

		// กรณีที่มีค่าว่างไม่อนุญาตให้แสดงข้อมูล
		if(temp_false==true) {
			alert(' กรุณาป้อนข้อมูลตัวเลขให้ครบทุกช่อง ');
			return false;
		}

		if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล ")) {
			return true;
		}
		else {
			return false; 
		}
	}  // end function
</script>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************** -->
<form name='frm_base' action='works_sql.php' method='post' onsubmit=" return check_submit(); ">
&nbsp;&nbsp;&nbsp;
<?
	if($click=='add')
	{	?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon">
	<img src="../../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
	</span>&nbsp;เพิ่มข้อมูลปี
	<? }
	else
	{ ?>
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon">
		<img src="../../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
		</span>&nbsp;แก้ไขข้อมูลปี
	<? } // end if  ?>
<!--  ถ้าเป็นการเพิ่มข้อมูลใหม่จะแสดง list ให้เลือก  ถ้าเป็นการแก้ไขจะแสดง เป็น textbox -->
<!--  แสดงข้อมูลปีที่เลือก -->
<?
	if($click=='add')
	{	  $temp_year =  date("Y")+530; ?>
	<select name="year">
	<? WHILE($i<20) { 
		  $i++; 
		  $temp_year = $temp_year+1; ?>
		<option value="<?=$temp_year; ?>" 
		<? 
			if($temp_year==date("Y")+543){
				echo "selected";
			} // end if 
		?>><?=$temp_year; ?></option>
	<?  } // end while ?>
	</select>
<? } // end add
 if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<?  } ?>
<!-- สิ้นสุดการแสดงปี  เดือน -->

<table width="1360" align="center" class="gridtable" style="margin:10 15 10 15 px;">
	<tr height='25px' class='rows_blue'>
		<td colspan="11"align="left">&nbsp;<b>ข้อมูลผลการดำเนินงานเปรียบเทียบเป้าหมาย ( เฉพาะผลผลิตหลัก ) </b></td>
	</tr>
	<tr>
		<td align="center" width="140" rowspan='2' class='rows_pink'> เดือน </td>
		<td align="center" width="240" colspan='2' class='rows_purple'> ข้าวเปลือก</td>
		<td align="center" width="240" colspan='2' class='rows_purple'> ข้าวโพด </td>
		<td align="center" width="240" colspan='2' class='rows_purple'> มันสำปะหลัง </td>
		<td align="center" width="240" colspan='2' class='rows_purple'> อ้อย </td>
		<td align="center" width="240" colspan='2' class='rows_purple'> ยางพารา </td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="120"> เป้าหมาย </td>
		<td align="center" width="120"> ผลงานจริง </td>
		<td align="center" width="120"> เป้าหมาย </td>
		<td align="center" width="120"> ผลงานจริง </td>
		<td align="center" width="120"> เป้าหมาย </td>
		<td align="center" width="120"> ผลงานจริง </td>
		<td align="center" width="120"> เป้าหมาย </td>
		<td align="center" width="120"> ผลงานจริง </td>
		<td align="center" width="120"> เป้าหมาย </td>
		<td align="center" width="120"> ผลงานจริง </td>
	</tr>
<?
	$temp_month = array("4","5","6","7","8","9","10","11","12","1","2","3");
	$temp_name = array("เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม","มกราคม","กุมภาพันธ์","มีนาคม");
	// กรณีแก้ไขให้ไปเรียกข้อมูลเดิมมาแสดง
	if($click=='edit')
	{
		$sql = " SELECT works_year,works_month, rice_plan,rice_value,maize_plan,maize_value, ";
		$sql.=" cassava_plan,cassava_value,sugarcane_plan,sugarcane_value, para_plan,para_value ";
		$sql.=" FROM AnnWorks WHERE works_year='".$year."' ";
		$sql.=" ORDER BY works_month_list ";
		$result_works = query($sql);
		$i = 0;
		WHILE($fetch_works = fetch_row($result_works)) {
	?>
		<tr>
			<td align="center"><input type="text" size="12"  value="<?=$temp_name[$i]?>" class="txt_system" readonly></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='1x<?=$temp_month[$i]?>' name='1x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[2],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='2x<?=$temp_month[$i]?>' name='2x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[3],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='3x<?=$temp_month[$i]?>' name='3x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[4],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='4x<?=$temp_month[$i]?>' name='4x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[5],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='5x<?=$temp_month[$i]?>' name='5x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[6],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='6x<?=$temp_month[$i]?>' name='6x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[7],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='7x<?=$temp_month[$i]?>' name='7x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[8],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='8x<?=$temp_month[$i]?>' name='8x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[9],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='9x<?=$temp_month[$i]?>' name='9x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[10],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='10x<?=$temp_month[$i]?>' name='10x<?=$temp_month[$i]?>' value="<?=number_format($fetch_works[11],2,'.','')?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
		</tr>
	<?
		$i++;
		} // end while 
	}  // end if edit 
	if($click=='add')
	{
		for($i=0;$i<12;$i++)
		{  ?>
		<tr>
			<td align="center"><input type="text" size="12"  value="<?=$temp_name[$i]?>" class="txt_system" readonly></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='1x<?=$temp_month[$i]?>' name='1x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='2x<?=$temp_month[$i]?>' name='2x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='3x<?=$temp_month[$i]?>' name='3x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='4x<?=$temp_month[$i]?>' name='4x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='5x<?=$temp_month[$i]?>' name='5x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='6x<?=$temp_month[$i]?>' name='6x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='7x<?=$temp_month[$i]?>' name='7x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='8x<?=$temp_month[$i]?>' name='8x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='9x<?=$temp_month[$i]?>' name='9x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
			<td align="center"><input type="text" size="12" maxlength="11" id='10x<?=$temp_month[$i]?>' name='10x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
		</tr>
	<?	}  // end for 
	}  // end if add
?>
</table>
<center>
<input name="click" type="hidden" value="<?=$click; ?>">
<input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก ">
</center>
</form>
<!-- *********************************************************************************************** -->
</body>
</html>
<?php
	close();
	include("../footer.php")
?>