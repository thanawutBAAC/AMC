<?php session_start();
	header( "Expires: Sat, 1 Jan 2009 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม',"1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม');
	$temp_year =  date("Y")+525; 

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/FusionCharts.js"></script>
<script language="JavaScript">
function doCallAjax() {  //  แสดงรายงาน

	var year = document.getElementById("year").value;  // ปี
	var month = document.getElementById("month").value;  // เดือน
	var url = 'Ajax_report99.php?year='+year+'&month='+month;    // ดึงข้อมูลรายงาน

	document.getElementById("ResultFrame").src = url;	// กำหนดค่า src ของ frame 

	document.getElementById("ResultFrame").style.width = "1000px";
	document.getElementById("ResultFrame").style.height = "900px";
	document.getElementById("ResultFrame").location.reload(true);  // refresh
	return true;

} // end function doCallAjax
</script>
</script>
</head>
<body>
<table width="900" border="0" cellpadding="0" cellspacing="0" class="report" style=' margin-top:20px; margin-left:5px; margin-right:50px;'>
	<tr height='30px'>
		<td colspan="2"><font color="#0F7FAF">
		<center><strong> รายงานการรวบรวมผลผลิตหลัก </strong></font>
		&nbsp;ปีบัญชี <select name="year" id="year">
		<? WHILE($i<20) { 
			$i++; 
			$temp_year = $temp_year+1; ?>
			<option value="<?=$temp_year; ?>" 
<? 	if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
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
			เดือน
		<select name="month" id="month">
			<?
			$month_now = date('n');
			foreach ($month_thai as $i => $m)
			{
				if($i==$month_now)
		  			echo "<option value='$i' selected>$m</option>"; 
				else
					echo "<option value='$i'>$m</option>";	
			}
		?>
		</select>
		<input type='button' value=' แสดงข้อมูล ' OnClick=" doCallAjax(); ">
		</center></td>
	</tr>
</table>
<iframe id='ResultFrame'  name='ResultFrame' frameborder='0' src='' height="50%" width="100%" style="margin-left:5px; margin-right:5px; margin-top:10px;"></iframe> 
</body>
</html>
<?php
	include("../footer.php");
?>