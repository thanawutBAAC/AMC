<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$div = $_GET['div'];
	$year = $_GET['year'];

// �ʴ���������Ǵ��� 4 �ͧʡ� ������͡������
$sql = " SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name, Temp01.PlanService_Apr,  ";
$sql.=" Temp01.PlanService_May,Temp01.PlanService_Jun, Temp01.PlanService_Jul, ";
$sql.=" Temp01.PlanService_Aug, Temp01.PlanService_Sep,Temp01.PlanService_Oct,  ";
$sql.=" Temp01.PlanService_Nov,Temp01.PlanService_Dec, Temp01.PlanService_Jan, ";
$sql.=" Temp01.PlanService_Feb, Temp01.PlanService_Mar, Temp01.PlanService_Sum  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanService.PlanService_Apr) AS PlanService_Apr,  ";
$sql.=" SUM(PlanService.PlanService_May) AS PlanService_May, ";
$sql.=" SUM(PlanService.PlanService_Jun) AS PlanService_Jun,  ";
$sql.=" SUM(PlanService.PlanService_Jul) AS PlanService_Jul, ";
$sql.=" SUM(PlanService.PlanService_Aug) AS PlanService_Aug,  ";
$sql.=" SUM(PlanService.PlanService_Sep) AS PlanService_Sep, ";
$sql.=" SUM(PlanService.PlanService_Oct) AS PlanService_Oct,  ";
$sql.=" SUM(PlanService.PlanService_Nov) AS PlanService_Nov, ";
$sql.=" SUM(PlanService.PlanService_Dec) AS PlanService_Dec,  ";
$sql.=" SUM(PlanService.PlanService_Jan) AS PlanService_Jan, ";
$sql.=" SUM(PlanService.PlanService_Feb) AS PlanService_Feb,  ";
$sql.=" SUM(PlanService.PlanService_Mar) AS PlanService_Mar,  ";
$sql.=" SUM(PlanService.PlanService_Sum) AS PlanService_Sum,  ";
$sql.=" PlanService.report_detail_code  ";
$sql.=" FROM PlanService,userlogin  ";
$sql.=" WHERE  PlanService.amccode = userlogin.amccode ";
$sql.=" AND userlogin.status = 'N' ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" AND PlanService.PlanService_year='".$year."' ";
$sql.=" GROUP BY PlanService.report_detail_code  ) AS Temp01  ";
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
$sql.=" WHERE   ";
$sql.=" BaseReportDetail.report_group_code='4'  ";
$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

$result_plan =	query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
</head>
<body>
<br>
<center><div class='button_print'><a href="#" onClick="window.print();return false" alt=" ����� ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/printer.png');" class="span_icon">
<img src="../icons/printer.png" alt=" ����� " class="images_icon" > 
</span>&nbsp;�������§ҹ</a></div></center>
<br>
<div style="margin-left:auto; margin-right:auto; text-align: center "> ��������´Ἱ�Ҿ��������� <font color='red'>��ԡ����������������ɵ� </font> �ͧ ʡ�.  Ἱ ʡ.��4 </div>
<!-- **************************************************************************************** -->
<br>&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
</span>&nbsp;�����Ż�
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>

<table  width="1260" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ��á������ԡ����������������ɵâͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_brown"> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">�������������ԡ����������������ɵ�</td>
    <td colspan="12" align="center">��Ť���Թ��ҷ�����������͹ ( �ѹ�ҷ )</td>
    <td rowspan="2" width="100" align="center">���������</td>
  </tr>
  <tr class="rows_brown"> 
    <td width="70" align="center">��.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">��.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">�.�.</td>
    <td width="70" align="center">��.�.</td>
  </tr>
<!--  ������ʴ�������  -->
<? $i=0;
	WHILE($fetch_plan =  fetch_row($result_plan)) {
	$i++;
	if(($i%2)==0)
		echo "<tr class='rows_grey'>";
	else
		echo "<tr>";
?>
	<td align="right"><?=$i;?>&nbsp;</td>  
	<td align="left">&nbsp;<?=trim($fetch_plan[1]); ?></td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[5]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[6]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[7]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[8]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[9]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[10]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[11]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[12]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[13]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[14]); ?>&nbsp;</td>
	</tr>
<? // �Ҽ�����ͧ���� colume ��������͹

		$temp01=$temp01+number_format($fetch_plan[2],0,'','');	
		$temp02=$temp02+number_format($fetch_plan[3],0,'','');	
		$temp03=$temp03+number_format($fetch_plan[4],0,'','');	
		$temp04=$temp04+number_format($fetch_plan[5],0,'','');	
		$temp05=$temp05+number_format($fetch_plan[6],0,'','');	
		$temp06=$temp06+number_format($fetch_plan[7],0,'','');	
		$temp07=$temp07+number_format($fetch_plan[8],0,'','');	
		$temp08=$temp08+number_format($fetch_plan[9],0,'','');	
		$temp09=$temp09+number_format($fetch_plan[10],0,'','');	
		$temp10=$temp10+number_format($fetch_plan[11],0,'','');	
		$temp11=$temp11+number_format($fetch_plan[12],0,'','');	
		$temp12=$temp12+number_format($fetch_plan[13],0,'','');	
		$temp13=$temp13+number_format($fetch_plan[14],0,'','');	
	} // end while ?>
	<!--  �ʴ������ŷ���������� colume -->
  <tr>
	<td align="center" colspan="2" class="rows_yellow"> ��� </td>  
	<td align="right"><?=number_format($temp01);?>&nbsp;</td>
	<td align="right"><?=number_format($temp02);?>&nbsp;</td>
	<td align="right"><?=number_format($temp03);?>&nbsp;</td>
	<td align="right"><?=number_format($temp04);?>&nbsp;</td>
	<td align="right"><?=number_format($temp05);?>&nbsp;</td>
	<td align="right"><?=number_format($temp06);?>&nbsp;</td>
	<td align="right"><?=number_format($temp07);?>&nbsp;</td>
	<td align="right"><?=number_format($temp08);?>&nbsp;</td>
	<td align="right"><?=number_format($temp09);?>&nbsp;</td>
	<td align="right"><?=number_format($temp10);?>&nbsp;</td>
	<td align="right"><?=number_format($temp11);?>&nbsp;</td>
	<td align="right"><?=number_format($temp12);?>&nbsp;</td>
	<td align="right"><?=number_format($temp13);?>&nbsp;</td>
	</tr>
<!-- ************************************************************************* -->
</table>
<br>
<center><div class='button_print'>
<a href="Excel_ReportSum07.php?year=<?=$year?>&div=<?=$div?>"><img src='../images/page_excel.gif' border='0'> ������ Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>