<?php session_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="��������´����觢�������§ҹ��Ш���͹.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>��������´����觢�������§ҹ��Ш���͹ </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<!-- ********************************************************************************************** -->
<?
		connect();	
		$sql = " SELECT userlogin.br_code, AMC.AMCName, Temp01.sent_date,Temp01.sent_time, userlogin.amccode ";
		$sql.=" FROM userlogin,AMC ";
		$sql.=" LEFT JOIN( ";
		$sql.=" SELECT amccode ,sent_date,sent_time ";
		$sql.=" FROM SentReportHeader ";
		$sql.=" WHERE sent_month='".$month."' AND sent_year='".$year."' ) ";
		$sql.=" AS Temp01 ON Temp01.amccode = AMC.amccode  ";
		$sql.=" WHERE userlogin.AMCCode = AMC.AMCCode ";
		$sql.=" ORDER BY userlogin.br_code, AMC.amcprovince ";

?>
<table  border='1'>
<tr height="30"><td colspan="4">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> ��§ҹ����觢����Ż�Ш���͹ <font color='red'><u><?=$month_thai[$month]?></u></font> �� <font color='red'><u><?=$year?></u></font> </b></center></font>
</td></tr>
<tr bgcolor='#FFCCFF'> 
	<td valign="middle" align="center" width="50">����</td>
	<td valign="middle" align="center" width="180"> ʡ�. </td>
	<td valign="middle" align="center" width="150"> �ѹ����� </td>
	<td valign="middle" align="center" width="150"> ���ҷ���� </td>
</tr>
<? 
	$result_report =  query($sql);
	$i=0;
	$x = 0;    // �觢�����
	$y = 0;    // ����觢�����
	WHILE( $fetch_report = fetch_row($result_report))
	{  $i++;
	?>
	<tr>
		<td align="center"><?=trim($fetch_report[0]) ?></td>
		<td align="left">&nbsp;<?="ʡ�.".trim($fetch_report[1])?></a></td>
	<?	if(is_null($fetch_report[2])) {	$y++;   ?>
			<td align="center" colspan="2"><font color='red'> ����ա���觢���������к� </font></td>
	<?  }else{  $x++;   ?>
			<td align="center"><?=trim($fetch_report[2]); ?></td><td align="center"><?=trim($fetch_report[3]); ?></td>
	<?  } // end if ?>
	</tr>
<? }  // end while ?>
	<tr bgcolor='#0066FF'>
		<td colspan='2' align='center'> �觢����� : <b><?=number_format($x,0,'','')?></b> ��¡��</td>
		<td colspan='2' align='center'> ������觢����� : <b><?=number_format($y,0,'','')?></b> ��¡��</td>
	</tr>
</table>
<?
	free_result($result_report);
	close();
?>
</body>
</html>