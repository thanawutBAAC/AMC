<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	
	$div = $_GET['div'];
	$year = $_GET['year'];

// �ʴ������š���Ѻ��Ҫԡ��������ع���͹���
$sql =" SELECT ";
$sql.=" SUM(PlanMember.MemFirstQuarter) AS MemFirstQuarter, ";
$sql.=" SUM(PlanMember.MemSecondQuarter) AS MemSecondQuarter, ";
$sql.=" SUM(PlanMember.MemThirdQuarter) AS MemThirdQuarter, ";
$sql.=" SUM(PlanMember.MemFourthQuarter) AS MemFourthQuarter, ";
$sql.=" PlanMember_year ";
$sql.=" FROM PlanMember ,userlogin ";
$sql.=" WHERE PlanMember.PlanMember_year='".$year."' ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" AND PlanMember.amccode = userlogin.amccode ";
$sql.=" AND userlogin.status ='N' ";
$sql.=" GROUP BY PlanMember_year ";


$result_plan =	query($sql);

//*****************************
	$year3=$year-3;
	$year2=$year-2;
	$year1=$year-1;
	$sql=" SELECT ";
	$sql.=" ans1 = (  SELECT SUM(MemSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year3."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans2 = (  SELECT SUM(MemSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year2."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";
	$sql.=" ans3 = (  SELECT SUM(MemSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year1."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";

	$sql.=" ans4 = (  SELECT SUM(ShareSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year3."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";

	$sql.=" ans5 = (  SELECT SUM(ShareSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year2."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ), ";

	$sql.=" ans6 = (  SELECT SUM(ShareSumYear)  FROM PlanMember, userlogin  WHERE PlanMember_year='".$year1."' 
	AND userlogin.amccode = PlanMember.amccode  AND userlogin.status='N' ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" ) ";

	$sql.=" FROM PlanMember ";
	$result_member= query($sql);

	if($result_member)
	{	
		if(num_rows($result_member)==0){
			$ans1=0;
			$ans2=0;
			$ans3=0;
			$ans4=0;
			$ans5=0;
			$ans6=0;
		}
		else{
			$ans1= number_format(result($result_member,'0','ans1'),0,'','');
			$ans2= number_format(result($result_member,'0','ans2'),0,'','');
			$ans3= number_format(result($result_member,'0','ans3'),0,'','');
			$ans4= number_format(result($result_member,'0','ans4'),0,'','');
			$ans5= number_format(result($result_member,'0','ans5'),0,'','');
			$ans6= number_format(result($result_member,'0','ans6'),0,'','');
		}
   } // end if

// ****************************
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> Ἱ��ô��Թ�ҹ��ҹ <font color='red'>��Ҫԡ��зع���͹��� </font></div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
</span>&nbsp;�����Ż�
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<table  width="1050" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="10" align="left">&nbsp;<font color="#0F7FAF"><b>�Ҿ���Ἱ����Ѻ��Ҫԡ��������ع���͹��鹢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_orange"> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">Ἱ�ҹ</td>
    <td colspan="3" width="" align="center" valign="middle">�ŧҹ��͹��ѧ</td>
    <td colspan="5" align="center" valign="middle">������§ҹ��Шӻ�</td>
  </tr>
  <tr class="rows_orange"> 
    <td align="center" width="90" align="center"><?=$year-3?></td>
    <td align="center" width="90" align="center"><?=$year-2?></td>
	<td align="center" width="90" align="center"><?=$year-1?></td>
    <td align="center" width="90" align="center">����� 1</td>
    <td align="center" width="90" align="center">����� 2</td>
	<td align="center" width="90" align="center">����� 3</td>
    <td align="center" width="90" align="center">����� 4</td>
    <td align="center" width="100" align="center">���������</td>
  </tr>
<!--  ������ʴ�������  -->
<? 
	WHILE($fetch_plan =  fetch_row($result_plan)) {
?>
	<tr>
	<td align="right">1&nbsp;</td>  
	<td align="left">&nbsp;����Ѻ��Ҫԡ</td>
	<td align="center"><?=$ans1 ?></td>
	<td align="center"><?=$ans2 ?></td>
	<td align="center"><?=$ans3 ?></td>
	<td align="right"><?=number_format($fetch_plan[0]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	</tr>
<?  } // end while ?>
<? 
// �ʴ������š�������ع���͹���
$sql =" SELECT  ";
$sql.=" SUM(ShareFirstQuarter),   ";
$sql.=" SUM(ShareSecondQuarter),   ";
$sql.=" SUM(ShareThirdQuarter),   ";
$sql.=" SUM(ShareFourthQuarter),  ";
$sql.=" SUM(ShareSumYear)   ";
$sql.=" FROM PlanMember,userlogin   ";
$sql.=" WHERE userlogin.amccode = PlanMember.amccode  ";
$sql.=" AND PlanMember_year='".$year."'   ";
if($div!=0)
{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
$sql.=" AND userlogin.status = 'N'  ";
$sql.=" GROUP BY PlanMember_year  ";

$result_plan =	query($sql); 

WHILE($fetch_plan =  fetch_row($result_plan)) { ?>
	<tr class='rows_grey'>
	<td align="right">2&nbsp;</td>  
	<td align="left">&nbsp;��������ع���͹��� ( ˹��� : �ѹ�ҷ)</td>
	<td align="center"><?=$ans4 ?></td>
	<td align="center"><?=$ans5 ?></td>
	<td align="center"><?=$ans6 ?></td>
	<td align="right"><?=number_format($fetch_plan[0]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	</tr>
<? } // end while ?>
</table>
<br>
<center><div class='button_print'>
<a href="Excel_ReportSum02.php?year=<?=$year?>&div=<?=$div?>"><img src='../images/page_excel.gif' border='0'> ������ Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>