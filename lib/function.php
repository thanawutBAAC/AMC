<?php
// ตรวจสอบการส่งรายงาน
function sendreport($num) {
	$filename = "doc/month.txt";
	$handle = fopen($filename, "r");
	if( filesize($filename)==0)
	{	$contents = array("0"=>'0',"1"=>'0',"2"=>'0',"3"=>'0',"4"=>'0',"5"=>'0',"6"=>'0',"7"=>'0',"8"=>'0',"9"=>'0',"10"=>'0',"11"=>'0');	}
	else
	{	$contents = fread($handle, filesize($filename));
		$contents = explode("#", $contents);  }
	fclose($handle);
	return $contents[$num-1];
	// return 1 true  0 false
}

$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');
function datetoday()
{	global $month_thai;
	$today = getdate();
	return $today["mday"]." ".$month_thai[$today["mon"]]." ".($today["year"]+543);
}

?>