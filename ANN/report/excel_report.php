<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="��������§ҹ�š�þ�ҡó�.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
  include("../../lib/config.inc.php");
  include("../class_ann.php");
  include("../../lib/database.php");
  connect();

?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<br>
<table width="1360" align="center" border='1' style="margin:10 15 10 15 px;">
	<tr height='25px' bgcolor='75B33F'>
		<td colspan="11"align="left">&nbsp;<b>�����żš�ô��Թ�ҹ��ԧ���º��º�ž�ҡó� ( ੾�мż�Ե��ѡ ) �� <?=$year ?> </b></td>
	</tr>
	<tr>
		<td align="center" width="140" rowspan='2' bgcolor='#FF99CC'> ��͹ </td>
		<td align="center" width="240" colspan='2' bgcolor='#CC99FF'> �������͡</td>
		<td align="center" width="240" colspan='2' bgcolor='#CC99FF'> ����⾴ </td>
		<td align="center" width="240" colspan='2' bgcolor='#CC99FF'> �ѹ�ӻ���ѧ </td>
		<td align="center" width="240" colspan='2' bgcolor='#CC99FF'> ���� </td>
		<td align="center" width="240" colspan='2' bgcolor='#CC99FF'> �ҧ���� </td>
	</tr>
	<tr bgcolor='#FF99CC'>
		<td align="center" width="120"> ������� </td>
		<td align="center" width="120"> �ŧҹ��ԧ </td>
		<td align="center" width="120"> ������� </td>
		<td align="center" width="120"> �ŧҹ��ԧ </td>
		<td align="center" width="120"> ������� </td>
		<td align="center" width="120"> �ŧҹ��ԧ </td>
		<td align="center" width="120"> ������� </td>
		<td align="center" width="120"> �ŧҹ��ԧ </td>
		<td align="center" width="120"> ������� </td>
		<td align="center" width="120"> �ŧҹ��ԧ </td>
	</tr>
<?
	$temp_month = array("4","5","6","7","8","9","10","11","12","1","2","3");
	$temp_name = array("����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�","���Ҥ�","����Ҿѹ��","�չҤ�");

	$sql = " SELECT works_year, works_month,rice_value,rice_predic,maize_value,maize_predic,cassava_value, ";
	$sql.=" cassava_predic,sugarcane_value, sugarcane_predic, para_value, para_predic  FROM AnnWorks ";
	$sql.=" WHERE works_year = '".$year."' ORDER BY works_month_list ";
	$result_works = query($sql);
		$i = 0;
		WHILE($fetch_works = fetch_row($result_works)) {
	?>
		<tr>
			<td align="center"><?=$temp_name[$i]?></td>
			<td align="right"><?=number_format($fetch_works[2],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[3],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[4],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[5],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[6],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[7],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[8],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[9],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[10],2,'.','')?></td>
			<td align="right"><?=number_format($fetch_works[11],2,'.','')?></td>
		</tr>
	<?
		$i++;
		} // end while 
?>
</table>
</body>
</html>
<?
	ob_end_flush();
	close();
	include("../footer.php")
?>