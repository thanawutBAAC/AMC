<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$sql = " SELECT userlogin.br_code,userlogin.userdetail,  ";
	$sql.=" userlogin.amccode,userlogin.amcprovince , ";
	$sql.=" Temp04.target_value, Temp05.target_value, ";
	$sql.=" Temp06.target_value, Temp07.target_value, ";
	$sql.=" Temp08.target_value, Temp09.target_value, ";
	$sql.=" Temp10.target_value, Temp11.target_value, ";
	$sql.=" Temp12.target_value, Temp01.target_value, ";
	$sql.=" Temp02.target_value, Temp03.target_value ";
	$sql.=" FROM userlogin  ";

	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='1' )AS Temp01  ";
	$sql.=" ON Temp01.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='2' )AS Temp02  ";
	$sql.=" ON Temp02.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='3' )AS Temp03 ";
	$sql.=" ON Temp03.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='4' )AS Temp04  ";
	$sql.=" ON Temp04.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='5' )AS Temp05  ";
	$sql.=" ON Temp05.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='6' )AS Temp06  ";
	$sql.=" ON Temp06.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='7' )AS Temp07  ";
	$sql.=" ON Temp07.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='8' )AS Temp08  ";
	$sql.=" ON Temp08.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='9' )AS Temp09  ";
	$sql.=" ON Temp09.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='10' )AS Temp10  ";
	$sql.=" ON Temp10.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='11' )AS Temp11  ";
	$sql.=" ON Temp11.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN( SELECT target_value, report_detail_code,amccode  ";
	$sql.=" FROM TargetTris WHERE target_year='".$year."' AND report_detail_code='".$report_detail_code."'  ";
	$sql.=" AND target_month='12' )AS Temp12  ";
	$sql.=" ON Temp12.amccode = userlogin.amccode  ";

	$sql.=" WHERE userlogin.status='N'  ";
	if($br_code!='all')
	{	
		$sql.=" AND userlogin.br_code='".$br_code."' ";
	}
	$sql.=" ORDER BY userlogin.br_code,userlogin.userdetail ";
	$result_report = query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************** -->
<table width="1470" align="center" class="gridtable" style="margin-top:5px;">
	<tr height="24"><td colspan="17">
	<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> �����š�˹�������� <font color="#76B441"><u><?=$report_detail_name; ?></u></font>&nbsp;˹��¹Ѻ : <font color="#76B441"><u><?=$temp_count; ?></u></font></b>&nbsp;<input type="text" id="sum_total" class="txt_num_system" size="9" value="0" readonly>&nbsp;������������駻�</center></font>
	</td></tr>
	<tr class="rows_pink">
		<td align="center" width="60"> �ӴѺ��� </td>
		<td align="center" width="200"> ��ª��� ʡ�. </td>
		<td align="center" width="150"> ���� </td>
		<td align="center" width="80"> ��.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> ��.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> �.�. </td>
		<td align="center" width="80"> ��.�. </td>
		<td align="center" width="100"> �����駻� </td>
	</tr>
<?php
	$i=0;
	$temp_num = 0; // �红����ŵ���Ţ���
	WHILE($result_fetch = fetch_row($result_report))
	{
		$i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
		?>
		<td align="center"><?=$i; ?></td>
		<td align="left">&nbsp;ʡ�.<?=trim($result_fetch[1]); ?></td>
		<td align="left">&nbsp���¡Ԩ����Ң�&nbsp;<?=trim($result_fetch[0])?></td>
		<td align="center"><input type="text" size="7" maxlength="7" value="<?=number_format(trim($result_fetch[4]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[5]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7" value="<?=number_format(trim($result_fetch[6]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[7]),0,'',''); ?>" class="txt_num" readonly ></td>
		<td align="center"><input type="text" size="7" maxlength="7" value="<?=number_format(trim($result_fetch[8]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[9]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[10]),0,'',''); ?>" class="txt_num" readonly></td>		
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[11]),0,'',''); ?>" class="txt_num" readonly ></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[12]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[13]),0,'',''); ?>" class="txt_num" readonly></td>		
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[14]),0,'',''); ?>" class="txt_num" readonly></td>
		<td align="center"><input type="text" size="7" maxlength="7"  value="<?=number_format(trim($result_fetch[15]),0,'',''); ?>" class="txt_num" readonly></td>
		<!--  ��� -->
	<?	$temp_sum = number_format($result_fetch[4],0,'','')+number_format($result_fetch[5],0,'','')+number_format($result_fetch[6],0,'','')+number_format($result_fetch[7],0,'','')+number_format($result_fetch[8],0,'','')+number_format($result_fetch[9],0,'','')+number_format($result_fetch[10],0,'','')+number_format($result_fetch[11],0,'','')+number_format($result_fetch[12],0,'','')+number_format($result_fetch[13],0,'','')+number_format($result_fetch[14],0,'','')+number_format($result_fetch[15],0,'','');  ?>
		<td align="center"><input type="text" size="7" maxlength="7" value="<?=$temp_sum?>" class="txt_num_system" readonly></td>
	</tr>
<?php
	$temp_num = $temp_num + number_format($temp_sum,0,'',''); 
	}  // end while
?>
</table>
 <!--  ���ҧ function javascript 㹡�èѴ��õ���Ţ  -->
 <script language="JavaScript">
	document.getElementById("sum_total").value = <?=$temp_num?>;
 </script>
<!-- *************************************************************** -->
</body>
</html>
<?php
	close();
	include("../footer.php")
?>