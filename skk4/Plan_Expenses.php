<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

	$amc_code = $_GET['amc_code'];
	$year = $_GET['year'];

// �ʴ���������Ǵ��� 7 �ͧʡ� ������͡������
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name, ";
$sql.=" Temp01.PlanExpenses_Apr, ";
$sql.=" Temp01.PlanExpenses_May,Temp01.PlanExpenses_Jun,  ";
$sql.=" Temp01.PlanExpenses_Jul,Temp01.PlanExpenses_Aug,  ";
$sql.=" Temp01.PlanExpenses_Sep,Temp01.PlanExpenses_Oct,  ";
$sql.=" Temp01.PlanExpenses_Nov,Temp01.PlanExpenses_Dec,  ";
$sql.=" Temp01.PlanExpenses_Jan,Temp01.PlanExpenses_Feb,  ";
$sql.=" Temp01.PlanExpenses_Mar, ";
$sql.=" Temp01.PlanExpenses_Sum  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT   ";
$sql.="	PlanExpenses_Apr,  ";
$sql.="	PlanExpenses_May,PlanExpenses_Jun,  ";
$sql.="	PlanExpenses_Jul,PlanExpenses_Aug,  ";
$sql.="	PlanExpenses_Sep,PlanExpenses_Oct,  ";
$sql.="	PlanExpenses_Nov,PlanExpenses_Dec,  ";
$sql.="	PlanExpenses_Jan,PlanExpenses_Feb,  ";
$sql.="	PlanExpenses_Mar, ";
$sql.="	PlanExpenses_Sum,  ";
$sql.="	report_detail_code,  ";
$sql.="	amccode,PlanExpenses_year  ";
$sql.="	FROM PlanExpenses  ";
$sql.="	WHERE amccode='".$amc_code."' AND ";
$sql.=" PlanExpenses_year='".$year."'  "; 
$sql.=") AS Temp01  "; 
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code   ";
$sql.=" AND Temp01.PlanExpenses_year = '".$year."'  "; 
$sql.=" WHERE BaseReportDetail.report_group_code='7'    ";
$sql.=" ORDER BY CAST(BaseReportDetail.report_detail_code AS INT) ";

$result_plan =	query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<br>
<center><div class='button_print'><a href="#" onClick="window.print();return false" alt=" ����� ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/printer.png');" class="span_icon">
<img src="../icons/printer.png" alt=" ����� " class="images_icon" > 
</span>&nbsp;�������§ҹ</a></div></center>
<br>
<div style="margin-left:auto; margin-right:auto; text-align: center "> ��������´Ἱ��� <font color='red'>��������</font> ʡ�.  </div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<img src="../images/application_form.gif" border='0' alt=" ������ "  align="absmiddle" >&nbsp;�����Ż�
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<!-- ����ش����ʴ��� -->
<table  width="1260" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ��û���ҳ��ä������¢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_blue"> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">��������������</td>
    <td colspan="12" align="center">��������������͹ (˹��� : �ҷ)</td>
    <td rowspan="2" width="100" align="center">�����������</td>
  </tr>
  <tr class="rows_blue"> 
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

// <!--  �ʴ���������� �  -->
	if($i==1){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������´��Թ�ҹ </b></font></td>
	</tr>
<? }elseif($i==24){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ�Ѵ���Թ����Ҩ�˹��� </b></font></td>
	</tr>
 <? }elseif($i==29){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ�Ǻ����ż�Ե </b></font></td>
	</tr>
 <? }elseif($i==34){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ���ٻ�ż�Ե��м�Ե�Թ���</b></font></td>
	</tr>
 <? }elseif($i==39){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ��ԡ�� </b></font></td>
	</tr>
 <? }elseif($i==43){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> �������¸�áԨ�Թ���� </b></font></td>
	</tr>
 <? }  // end if 
//  ����ش����ʴ���������� � 

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
<? 
//  ����ش����ʴ���������� � 

// �Ҽ�����ͧ���� colume ��������͹
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
<!--  ����ش��Ѻ��ا������ -->
<!-- ***************************************************************************************************************************************** -->
</table>
<br>
<center><div class='button_print'>
<a href="excel_expenses.php?year=<?=$year?>&amc_code=<?=$amc_code?>"><img src='../images/page_excel.gif' border='0'> ������ Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>