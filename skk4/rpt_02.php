<?php session_start();
	header( "Expires: Sat, 1 Jan 2009 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript">
function doCallAjax() {  //  รายงานภาพรวมแผน สกก.4 ในมุมมองรวมเป็น ฝสข.  และทั้งประเทศ

	var year = document.getElementById("year").value;  // ปี
	var div = document.getElementById("div").value;  // ฝ่ายภาค
	var report = document.getElementById("report").value;  // รายงาน
	var url = 'Frame_ReportSum0'+report+'.php?year='+year+'&div='+div;    // ดึงข้อมูลรายงาน

	document.getElementById("ResultFrame").src = url;	// กำหนดค่า src ของ frame 

	alert(' แสดงข้อมูลรายงาน ');
	if(report==1)
	{
		document.getElementById("ResultFrame").style.width = "1000px";
		document.getElementById("ResultFrame").style.height = "1400px";
	}
	else if(report==2)
	{
		document.getElementById("ResultFrame").style.width = "1080px";
		document.getElementById("ResultFrame").style.height = "300px";
	}
	else if(report==3)
	{
		document.getElementById("ResultFrame").style.width = "1730px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==4)
	{
		document.getElementById("ResultFrame").style.width = "1470px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==5)
	{
		document.getElementById("ResultFrame").style.width = "1730px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==6)
	{
		document.getElementById("ResultFrame").style.width = "1470px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==7)
	{
		document.getElementById("ResultFrame").style.width = "1290px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==8)
	{
		document.getElementById("ResultFrame").style.width = "1290px";
		document.getElementById("ResultFrame").style.height = "750px";
	}
	else if(report==9)
	{
		document.getElementById("ResultFrame").style.width = "1730px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==10)
	{
		document.getElementById("ResultFrame").style.width = "1470px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	document.getElementById("ResultFrame").location.reload(true);  // refresh
	return true;

} // end function doCallAjax
</script>
</head>
<body>
<table width="700" style="margin-left:5px; text-align: center; margin-top:8px; margin-bottom:0px;" border="0" cellpadding="0" cellspacing="0" class='report'>
	<tr>
		<td colspan="4" valign="top" >
			<table width="699" border="0" cellpadding="0" cellspacing="0" style="margin: 1 1 1 1;">
				<tr height="30px">
		  			<td align="center" bgcolor="#EEEEEE"><strong>รายงานภาพรวมแผน สกก.4 </strong></td>
				</tr>
			</table>
		</td>	
	</tr>
	<tr height="25" valign="bottom">
		<td align="right" > เลือกปีบัญชี :</td>
		<td align="left" >&nbsp;
		<select name="year" id="year">
		<?
			$temp_year =  date("Y")+525; 
			WHILE($i<20) { 
				$i++; 
				$temp_year = $temp_year+1; ?>
			<option value="<?=$temp_year; ?>" 
<? 		if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
			{
				if($temp_year==date("Y")+542){
					echo "selected";
				}
			}
			else{
				if($temp_year==date("Y")+543){
						echo "selected";
				}
			}  // end date ?> ><?=$temp_year; ?></option>
		<?    } // end while ?>
		</select>
		</td>
		<td align="right"> เลือกฝ่ายกิจการสาขา :</td>
		<td align="left">&nbsp;
	     <select id="div" name="div" >
			<option value="0">--รวมประเทศ--</option>
			<option value="1">&nbsp;ฝ่ายกิจการสาขา 1 </option>
			<option value="2">&nbsp;ฝ่ายกิจการสาขา 2 </option>
			<option value="3">&nbsp;ฝ่ายกิจการสาขา 3 </option>
			<option value="4">&nbsp;ฝ่ายกิจการสาขา 4 </option>
			<option value="5">&nbsp;ฝ่ายกิจการสาขา 5 </option>
			<option value="6">&nbsp;ฝ่ายกิจการสาขา 6 </option>
			<option value="7">&nbsp;ฝ่ายกิจการสาขา 7 </option>
			<option value="8">&nbsp;ฝ่ายกิจการสาขา 8 </option>
			<option value="9">&nbsp;ฝ่ายกิจการสาขา 9 </option>
		</select>  
	   </td>
</tr>
<tr height="25" valign="bottom">
	<td align="right"> เลือกรายงาน :</td>
	<td align="left" colspan='3'>&nbsp;
		<select id="report" name="report" >    
			<option value="1">&nbsp;รายงานสรุปแผนการดำเนินงานประจำปี </option>
			<option value="2">&nbsp;รายงานแผนสมาชิก และเพิ่มทุนเรือนหุ้น </option>
			<option value="3">&nbsp;รายงานจัดหาสินค้ามาจำหน่าย ยอดซื้อ </option>
			<option value="4">&nbsp;รายงานจัดหาสินค้ามาจำหน่าย ยอดขาย </option>
			<option value="5">&nbsp;รายงานการรวบรวมผลิตผลการเกษตร ยอดซื้อ </option>
			<option value="6">&nbsp;รายงานการรวบรวมผลิตผลการเกษตร ยอดขาย </option>
			<option value="7">&nbsp;รายงานการให้บริการและส่งเสริมการเกษตร </option>
			<option value="8">&nbsp;รายงานแผนการจ่ายค่าใช้จ่าย </option>
			<option value="9">&nbsp;รายงานการแปรรูปผลผลิต ยอดซื้อ </option>
			<option value="10">&nbsp;รายงานการแปรรูปผลผลิต ยอดขาย </option>
		</select>  
	</td>
</tr>
<tr height="35">
	<td>&nbsp;</td>
	<td colspan="3" align="left">&nbsp;&nbsp;<input type="button" value=" แสดงข้อมูลรายงาน " OnClick=" doCallAjax(); "><td>
</tr>
</table>
<iframe id='ResultFrame'  name='ResultFrame' frameborder='0' src='' height="50%" width="100%" style="margin-left:5px; margin-right:5px; margin-top:10px;"></iframe> 
</body>
</html>
<?php
	include("../footer.php")
?>