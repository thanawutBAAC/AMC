<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	
	$div = $_GET['div'];
	$year = $_GET['year'];

// �ʴ���������Ǵ��� 8 �ͧʡ� ������͡������
$sql = " SELECT BaseReportDetail.report_detail_code, ";
$sql.=" BaseReportDetail.report_detail_name, BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.PlanTransSell_price,Temp01.PlanTransSell_Apr,  ";
$sql.=" Temp01.PlanTransSell_May,Temp01.PlanTransSell_Jun,  ";
$sql.=" Temp01.PlanTransSell_Jul,Temp01.PlanTransSell_Aug,  ";
$sql.=" Temp01.PlanTransSell_Sep,Temp01.PlanTransSell_Oct,  ";
$sql.=" Temp01.PlanTransSell_Nov,Temp01.PlanTransSell_Dec,  ";
$sql.=" Temp01.PlanTransSell_Jan,Temp01.PlanTransSell_Feb,  ";
$sql.=" Temp01.PlanTransSell_Mar,Temp01.PlanTransSell_Unit,  ";
$sql.=" Temp01.PlanTransSell_Sum  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.=" SELECT  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_price) AS PlanTransSell_price, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Apr) AS PlanTransSell_Apr,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_May) AS PlanTransSell_May, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Jun) AS PlanTransSell_Jun,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Jul) AS PlanTransSell_Jul, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Aug) AS PlanTransSell_Aug,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Sep) AS PlanTransSell_Sep, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Oct) AS PlanTransSell_Oct,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Nov) AS PlanTransSell_Nov, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Dec) AS PlanTransSell_Dec,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Jan) AS PlanTransSell_Jan, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Feb) AS PlanTransSell_Feb,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Mar) AS PlanTransSell_Mar, ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Unit) AS PlanTransSell_Unit,  ";
$sql.=" SUM(PlanTransSell.PlanTransSell_Sum) AS PlanTransSell_Sum,  ";
$sql.=" PlanTransSell.report_detail_code  ";
$sql.=" FROM PlanTransSell ,userlogin ";
$sql.=" WHERE userlogin.amccode = PlanTransSell.amccode ";
$sql.=" AND PlanTransSell.PlanTransSell_year='".$year."' ";
$sql.=" AND userlogin.status = 'N'  ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" GROUP BY PlanTransSell.report_detail_code ) AS Temp01  ";
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
$sql.=" WHERE  BaseReportDetail.report_group_code='8'  ";
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> �Ҿ���Ἱ������ٻ�ż�Ե����ɵâͧ ʡ�. <font color='red'>(�ʹ���)</font> Ἱ ʡ.��4 </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
</span>&nbsp;�����Ż�
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<!-- ����ش����ʴ��� -->
<table  width="1440" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="18" align="left">&nbsp;<font color="#0F7FAF"><b>��§ҹ������ٻ��Ե�š���ɵ� �ʹ��� ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr bgcolor="#33CCCC"> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">�������ż�Ե</td>
    <td rowspan="2" width="50" align="center" valign="middle">˹��¹Ѻ</td>
    <td rowspan="2" width="80" align="center" valign="middle">�Ҥҵ��˹���<br>(�ҷ)</td>
    <td colspan="12" align="center">��Ť�Ҽż�Ե������������͹ ( �ѹ�ҷ )</td>
    <td colspan="2" align="center">���������</td>
  </tr>
  <tr bgcolor="#33CCCC"> 
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
    <td width="75" align="center">��˹���<br>˹���</td>
    <td width="75" align="center">�ӹǹ�Թ<br>(�ѹ�ҷ)</td>
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
	<td align="center"><?=trim($fetch_plan[2]); ?></td>
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
	<td align="right"><?=number_format($fetch_plan[15]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[16]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[17]); ?>&nbsp;</td>
	</tr>
<? // �Ҽ�����ͧ���� colume ��������͹
		$temp01=$temp01+number_format($fetch_plan[3],0,'','');	
		$temp02=$temp02+number_format($fetch_plan[4],0,'','');	
		$temp03=$temp03+number_format($fetch_plan[5],0,'','');	
		$temp04=$temp04+number_format($fetch_plan[6],0,'','');	
		$temp05=$temp05+number_format($fetch_plan[7],0,'','');	
		$temp06=$temp06+number_format($fetch_plan[8],0,'','');	
		$temp07=$temp07+number_format($fetch_plan[9],0,'','');	
		$temp08=$temp08+number_format($fetch_plan[10],0,'','');	
		$temp09=$temp09+number_format($fetch_plan[11],0,'','');	
		$temp10=$temp10+number_format($fetch_plan[12],0,'','');	
		$temp11=$temp11+number_format($fetch_plan[13],0,'','');	
		$temp12=$temp12+number_format($fetch_plan[14],0,'','');	
		$temp13=$temp13+number_format($fetch_plan[15],0,'','');	
		$temp14=$temp14+number_format($fetch_plan[16],0,'','');	
		$temp15=$temp15+number_format($fetch_plan[17],0,'','');	
	} // end while ?>
	<!--  �ʴ������ŷ���������� colume -->
  <tr>
	<td align="center" colspan="3" class="rows_yellow"><strong> ��� </strong></td>  
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
	<td align="right"><?=number_format($temp14);?>&nbsp;</td>
	<td align="right"><?=number_format($temp15);?>&nbsp;</td>
	</tr>
<!-- ***************************************************************************************************************************************** -->
</table>
<br>
<center><div class='button_print'>
<a href="Excel_ReportSum10.php?year=<?=$year?>&div=<?=$div?>"><img src='../images/page_excel.gif' border='0'> ������ Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>