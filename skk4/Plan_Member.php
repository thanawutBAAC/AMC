<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	
	$amc_code = $_GET['amc_code'];
	$year = $_GET['year'];

// �ʴ������š���Ѻ��Ҫԡ��������ع���͹���
$sql=" SELECT userlogin.amccode,  ";
$sql.=" Temp01.MemFirstQuarter,Temp01.MemSecondQuarter, ";
$sql.=" Temp01.MemThirdQuarter,Temp01.MemFourthQuarter, ";
$sql.=" Temp01.MemSumYear ";
$sql.=" FROM  userlogin  ";
$sql.=" LEFT JOIN ( ";
$sql.=" SELECT  ";
$sql.=" amccode,MemFirstQuarter, ";
$sql.="  MemSecondQuarter, MemThirdQuarter, ";
$sql.="  MemFourthQuarter,MemSumYear  ";
$sql.=" FROM PlanMember  ";
$sql.=" WHERE PlanMember_year='".$year."'  ";
$sql.=" ) AS Temp01 ON Temp01.amccode = userlogin.amccode ";
$sql.=" WHERE userlogin.amccode='".$amc_code."' ";

$result_plan =	query($sql);

//*****************************
	$year3=$year-3;
	$year2=$year-2;
	$year1=$year-1;
	$sql=" SELECT ";
	$sql.=" ans1 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year3."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans2 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year2."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans3 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year1."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans4 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year3."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans5 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year2."' AND amccode='".$amc_code."' ), ";
	$sql.=" ans6 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year1."' AND amccode='".$amc_code."' ) ";
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
		<td colspan="10" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ����Ѻ��Ҫԡ��������ع���͹��鹢ͧ ʡ�. �� <?=$year; ?></b></font></td>
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
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[5]); ?>&nbsp;</td>
	</tr>
<?  } // end while ?>
<? 
// �ʴ������š�������ع���͹���
$sql=" SELECT userlogin.amccode,  ";
$sql.=" Temp01.ShareFirstQuarter,  Temp01.ShareSecondQuarter, ";
$sql.=" Temp01.ShareThirdQuarter, Temp01.ShareFourthQuarter, ";
$sql.=" Temp01.ShareSumYear ";
$sql.=" FROM  userlogin  ";
$sql.=" LEFT JOIN ( ";
$sql.=" SELECT  ";
$sql.=" amccode, ShareFirstQuarter, ";
$sql.="  ShareSecondQuarter, ShareThirdQuarter, ";
$sql.="  ShareFourthQuarter,ShareSumYear  ";
$sql.=" FROM PlanMember  ";
$sql.=" WHERE PlanMember_year='".$year."'  ";
$sql.=" ) AS Temp01 ON Temp01.amccode = userlogin.amccode ";
$sql.=" WHERE userlogin.amccode='".$amc_code."' ";
$result_plan =	query($sql); 
WHILE($fetch_plan =  fetch_row($result_plan)) { ?>
	<tr class='rows_grey'>
	<td align="right">2&nbsp;</td>  
	<td align="left">&nbsp;��������ع���͹��� ( ˹��� : �ѹ�ҷ)</td>
	<td align="center"><?=$ans4 ?></td>
	<td align="center"><?=$ans5 ?></td>
	<td align="center"><?=$ans6 ?></td>
	<td align="right"><?=number_format($fetch_plan[1]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[2]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[3]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[4]); ?>&nbsp;</td>
	<td align="right"><?=number_format($fetch_plan[5]); ?>&nbsp;</td>
	</tr>
<? } // end while ?>
</table>
<br>
<center><div class='button_print'>
<a href="Excel_Member.php?year=<?=$year?>&amc_code=<?=$amc_code?>"><img src='../images/page_excel.gif' border='0'> ������ Excel </a></div></center>
<br>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
?>