<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<!-- *********************************************************************** -->
<form name="" action="check_report.php" method="post">
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center; "> ��������´����觢�������§ҹ��Ш���͹  �պѭ�� 
<?  $temp_year =  date("Y")+525; ?>
	<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>"
<? 			
		if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
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
</select>&nbsp;��͹
<select name="month">
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
<input type="submit" value="  �ʴ������� ">
</div>
<input type="hidden" name="click" >
</form>
<!-- ********************************************************************************************** -->
<?
	if(isset($click))
	{
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
<table  width="530" align="center" class="gridtable" style="margin-top:10px;">
<tr height="30"><td colspan="4">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> ��§ҹ����觢����Ż�Ш���͹ <font color='red'><u><?=$month_thai[$month]?></u></font> �պѭ�� <font color='red'><u><?=$year?></u></font> </b></center></font>
</td></tr>
<tr class="rows_pink"> 
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
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
	?>
		<td align="center"><?=trim($fetch_report[0]) ?></td>
		<td align="left">&nbsp;<a href="check_report_detail.php?temp_amccode=<?=trim($fetch_report[4])?>&temp_name=<?=trim($fetch_report[1])?>"  ><?="ʡ�.".trim($fetch_report[1])?></a></td>
	
	<?	if(is_null($fetch_report[2])) {	$y++;   ?>
			<td align="center" colspan="2"><font color='red'> ����ա���觢���������к� </font></td>
	<?  }else{  $x++;   ?>
			<td align="center"><?=trim($fetch_report[2]); ?></td><td align="center"><?=trim($fetch_report[3]); ?></td>
	<?  } // end if ?>
	</tr>
<? }  // end while ?>
	<tr class='rows_blue'>
		<td colspan='2' align='center'> �觢����� : <b><?=number_format($x,0,'','')?></b> ��¡��</td>
		<td colspan='2' align='center'> ������觢����� : <b><?=number_format($y,0,'','')?></b> ��¡��</td>
	</tr>
</table>
<br>
<center><a href='excel_check_report.php?year=<?=$year?>&month=<?=$month?>'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>
<?
	free_result($result_report);
	close();
	} // end if ?>
</body>
</html>
<?php
	include("../footer.php");
?>