<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");
	
	if($code=='1'){
		$temp_name = 'ข้าว';
	}
	elseif($code=='2'){
		$temp_name = 'ข้าวโพด';
	}
	elseif($code=='3'){
		$temp_name = 'มันสำปะหลัง';
	}
	elseif($code=='4'){
		$temp_name = 'อ้อย';
	}
	elseif($code=='5'){
		$temp_name = 'ยางพารา';
	}

	connect();	
	$click = $_GET['click'];
	if($click=='add')
	{  // กรณีเพิ่มข้อมูล
		$temp_planted = 0; // เนื้อที่เพาะปลูก 
		$temp_harvested = 0; // เนื้อที่เก็บเกี่ยว
		$temp_production = 0; // ผลผลิต
		$temp_yield = 0; // ผลผลิต ต่อ ไร
		$temp_farm_price = 0; // ราคาเกษตรกรขายได
		$temp_farm_value = 0; //  มูลค่าของผลผลิตตามราคาเกษตรขายได
	}
	else
	{  // กรณีแก้ไขข้อมูล
		$year = $_GET['year'];
		$sql = " SELECT Planted,Harvested,Production,Yield,Farm_price,Farm_value ";
		$sql.=" FROM AnnProduction WHERE Product_code='".$code."' AND Product_year='".$year."' ";
		$result_production = query($sql);
		$temp_planted = number_format(result($result_production,0,'Planted'),0,'',''); // เนื้อที่เพาะปลูก
		$temp_harvested = number_format(result($result_production,0,'Harvested'),0,'',''); // เนื้อที่เก็บเกี่ยว
		$temp_production =	number_format(result($result_production,0,'Production'),0,'','');  // ผลผลิต
		$temp_yield = number_format(result($result_production,0,'Yield'),0,'',''); // ผลผลิต ต่อ ไร
		$temp_farm_price = number_format(result($result_production,0,'Farm_price'),2,'.','');  // ราคาเกษตรกรขายได
		$temp_farm_value = number_format(result($result_production,0,'Farm_value'),0,'','');  //  มูลค่าของผลผลิตตามราคาเกษตรขายได
	} // end if 

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
			 if(frm_base.planted.value.length==0)
			{
					alert('กรุณาบันทึก เนื้อที่เพาะปลูก');
					frm_base.planted.focus();
					return false;
			}
			 else if(frm_base.harvested.value.length==0)
			{
					alert('กรุณาบันทึก เนื้อที่เก็บเกี่ยว');
					frm_base.harvested.focus();
					return false;
			}
			 else if(frm_base.production.value.length==0)
			{
					alert('กรุณาบันทึก ผลผลิต');
					frm_base.production.focus();
					return false;
			}
			 else if(frm_base.yield.value.length==0)
			{
					alert('กรุณาบันทึก ผลผลิต ต่อ ไร่ ');
					frm_base.yield.focus();
					return false;
			}
			 else if(frm_base.farm_price.value.length==0)
			{
					alert('กรุณาบันทึก ราคาเกษตรกรขายได้');
					frm_base.farm_price.focus();
					return false;
			}
			 else if(frm_base.farm_value.value.length==0)
			{
					alert('กรุณาบันทึก มูลค่าของผลผลิตตามราคาเกษตรขายได้');
					frm_base.farm_value.focus();
					return false;
			}

			if (confirm(" กรุณายืนยันการบันทึกข้อมูล ")) {
				return true;
			}
			else {
				return false; 
			}

		}
</script>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************** -->
<form name='frm_base' action='production_sql.php' method='post' onsubmit=" return check_submit(); ">
&nbsp;&nbsp;&nbsp;
<?
	if($click=='add')
	{	?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon">
	<img src="../../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
	</span>&nbsp;เพิ่มข้อมูลปัจจัยพื้นฐาน<?=$temp_name ?>
	<? }
	else
	{ ?>
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon">
		<img src="../../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
		</span>&nbsp;แก้ไขข้อมูลปัจจัยพื้นฐาน<?=$temp_name ?>
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

<table width="740" align="center" class="gridtable" style="margin:10 15 10 15 px;">
	<tr height='25px' class='rows_orange'>
		<td colspan="6"align="left">&nbsp;<b>ข้อมูลปัจจัยพื้นฐาน<?=$temp_name ?></b></td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="120"> เนื้อที่เพาะปลูก <br>(1,000 ไร่)</td>
		<td align="center" width="120"> เนื้อที่เก็บเกี่ยว <br>(1,000 ไร่)</td>
		<td align="center" width="120"> ผลผลิต <br>(1,000 ตัน)</td>
		<td align="center" width="120"> ผลผลิตต่อไร่ <br> กก. </td>
		<td align="center" width="130"> ราคาที่เกษตรกรขายได้ <br> ( บาท/ตัน)</td>
		<td align="center" width="130"> มูลค่าตามผลผลิตที่<br>เกษตรกรขายได้ <br>( ล้านบาท )</td>
	</tr>
	<tr>
		<td align="center"><input type="text" size="9" maxlength="9" name='planted' value="<?=$temp_planted; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='harvested' value="<?=$temp_harvested; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9" name='production' value="<?=$temp_production; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='yield' value="<?=$temp_yield; ?>" class="txt_num" onKeyPress="return isNumberKey(this);" ></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='farm_price' value="<?=$temp_farm_price; ?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='farm_value' value="<?=$temp_farm_value; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
	</tr>
</table>
<br>
<center>
<input name="click" type="hidden" value="<?=$click; ?>">
<input name="code" type="hidden" value="<?=$code; ?>">
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