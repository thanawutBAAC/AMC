<?php
// ��Ǩ�ͺ�������§ҹ
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

$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');
function datetoday()
{	global $month_thai;
	$today = getdate();
	return $today["mday"]." ".$month_thai[$today["mon"]]." ".($today["year"]+543);
}

?>