<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

// �ʴ���������Ǵ��� 3 �ͧʡ� ������͡������
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name,    ";
$sql.=" BaseReportDetail.report_detail_unit,  ";
$sql.=" Temp01.Imports_unit,Temp01.Imports_price,  ";
$sql.=" Temp01.PlanCollectBuy_price,Temp01.PlanCollectBuy_Apr,  ";
$sql.=" Temp01.PlanCollectBuy_May,Temp01.PlanCollectBuy_Jun,  ";
$sql.=" Temp01.PlanCollectBuy_Jul,Temp01.PlanCollectBuy_Aug,  ";
$sql.=" Temp01.PlanCollectBuy_Sep,Temp01.PlanCollectBuy_Oct,  ";
$sql.=" Temp01.PlanCollectBuy_Nov,Temp01.PlanCollectBuy_Dec,  ";
$sql.=" Temp01.PlanCollectBuy_Jan,Temp01.PlanCollectBuy_Feb,  ";
$sql.=" Temp01.PlanCollectBuy_Mar,Temp01.PlanCollectBuy_Unit,  ";
$sql.=" Temp01.PlanCollectBuy_Sum,Temp01.PlanCollectBuy_Unit_year,  ";
$sql.=" Temp01.PlanCollectBuy_Sum_year  ";
$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT   ";
$sql.="	Imports_unit,Imports_price,  ";
$sql.="	PlanCollectBuy_price,PlanCollectBuy_Apr,  ";
$sql.="	PlanCollectBuy_May,PlanCollectBuy_Jun,  ";
$sql.="	PlanCollectBuy_Jul,PlanCollectBuy_Aug,  ";
$sql.="	PlanCollectBuy_Sep,PlanCollectBuy_Oct,  ";
$sql.="	PlanCollectBuy_Nov,PlanCollectBuy_Dec,  ";
$sql.="	PlanCollectBuy_Jan,PlanCollectBuy_Feb,  ";
$sql.="	PlanCollectBuy_Mar,PlanCollectBuy_Unit,  ";
$sql.="	PlanCollectBuy_Sum,PlanCollectBuy_Unit_year,  ";
$sql.="	PlanCollectBuy_Sum_year,report_detail_code,  ";
$sql.="	amccode,PlanCollectBuy_year  ";
$sql.="	FROM PlanCollectBuy  ";
$sql.="	WHERE amccode='".$code_online."' AND ";
if($click=='add')
{	$sql.=" PlanCollectBuy_year='9999'  "; }
elseif($click=='edit')
{	$sql.=" PlanCollectBuy_year='".$year."'  "; }
$sql.=") AS Temp01   ";
$sql.=" ON Temp01.amccode = BaseReportHeader.amccode   ";
$sql.=" AND Temp01.report_detail_code=BaseReportHeader.report_detail_code   ";
if($click=='add')
{	$sql.=" AND Temp01.PlanCollectBuy_year = '9999'  "; }
elseif($click=='edit')
{	$sql.=" AND Temp01.PlanCollectBuy_year = '".$year."'  "; }
$sql.=" WHERE BaseReportHeader.amccode='".$code_online."'   ";
$sql.=" AND BaseReportHeader.report_group_code='3'    ";
$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code   ";
$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code   ";
$sql.=" ORDER BY BaseReportDetail.report_detail_code   ";

$result_plan =	query($sql);

	WHILE($fetch_id = fetch_row($result_plan)) {
			$product_id =	$product_id.trim($fetch_id[0])."#";
	} // end while
	$product_id = substr($product_id,0,strlen($product_id)-1);
	// ���������Թ��ҷ���ͧ����ҷ����� ���Ǥ�蹴��� # 

	if(num_rows($result_plan)>0)
		data_seek($result_plan);
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">
// �Ң��������͵�駪��͵���á�͹
	var Data = "<?=$product_id?>";
	var Array_Max;
	var Array_Temp;
	Array_Temp=Data.split("#");
	Array_Max=Array_Temp.length;

//  �ʴ������������㹴�ҹ colums
	function update_cols(cols)
	{
		var temp_02 = 0;
		for(i=0;i<Array_Max;i++)
		{
			temp_02 = temp_02 + parseInt(document.getElementById(Array_Temp[i]+'x'+cols).value);
		}
		var sum = document.getElementById("sum"+cols);
		sum.value = temp_02;
	}

// �ʴ������������㹴�ҹ rows
	function update_rows(rows)
	{
		var t2 = document.getElementById(rows+"x2");
		var t4 = document.getElementById(rows+"x4");
		var t5 = document.getElementById(rows+"x5");
		var t6 = document.getElementById(rows+"x6");
		var t7 = document.getElementById(rows+"x7");
		var t8 = document.getElementById(rows+"x8");
		var t9 = document.getElementById(rows+"x9");
		var t10 = document.getElementById(rows+"x10");
		var t11 = document.getElementById(rows+"x11");
		var t12 = document.getElementById(rows+"x12");
		var t13 = document.getElementById(rows+"x13");
		var t14 = document.getElementById(rows+"x14");
		var t15 = document.getElementById(rows+"x15");
		var t16 = document.getElementById(rows+"x16");
		var t17 = document.getElementById(rows+"x17");
		var t19 = document.getElementById(rows+"x19");

		t17.value = parseInt(t4.value)+parseInt(t5.value)+parseInt(t6.value)+parseInt(t7.value)+parseInt(t8.value)+parseInt(t9.value)+parseInt(t10.value)+parseInt(t11.value)+parseInt(t12.value)+parseInt(t13.value)+parseInt(t14.value)+parseInt(t15.value);
		t19.value = parseInt(t2.value)+parseInt(t17.value);
	}

// �觤�ҷ�����ҷ�� function ��� ���йӢ�����任�Ѻ��ا���д�ҹ
	function update_data(x,y)
	{
		update_rows(x);
		update_cols(y);
		update_cols(17);
		update_cols(19);
	}

// �׹�ѹ��͹��Ѻ��ا������		
	function check_submit()
	{
		var temp_01;
		var temp_false = false;
		// ��Ǩ�ͺ��ҷ�������͹����դ����ҧ�������
		for(j=1;j<=19;j++)
		{
			for(i=0;i<Array_Max;i++)
			{
				temp_01 = document.getElementById(Array_Temp[i]+'x'+j);
				if(temp_01.value.length==0)
				{
					temp_false = true;		
				}
			}
		}
		// �óշ���դ����ҧ���͹حҵ����ʴ�������
		if(temp_false==true)
		{
			alert(' ��سһ�͹�����ŵ���Ţ���ú�ء��ͧ ');
			return false;
		}
		if (confirm(" ��س��׹�ѹ��û�Ѻ��ا������ ")) {
			return true;
		}
		else
		{
			return false; 
		}
	}
</script>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<div style="margin-left:auto; margin-right:auto;  text-align: center "> ��������´Ἱ<u>��ë���/�Ǻ�����Ե��</u>����ɵâͧ ʡ�. <font color='red'>(�ʹ����)</font>  Ἱ ʡ.��4 </div>
<!-- ******************************************************************************************************************************************** -->
<form name="Frm_CollectBuy" action="PlanCollectBuy_sql.php" method="post" onsubmit=" return check_submit();">
&nbsp;
<?
if($click=='add')
{	?>
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;���������Żպѭ��
<? }
else
{ ?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
	</span>&nbsp;��䢢����Żպѭ��
<? } ?>
<!--  ����繡������������������ʴ� list ������͡  ����繡����䢨��ʴ� �� textbox -->
<!--  �ʴ������Żշ�����͡ -->
<?
if($click=='add')
{	  $temp_year =  date("Y")+535; ?>
<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>" 
<? 	if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
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
</select>
<? } // end add?>
<? if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<?  } ?>
<!-- ����ش����ʴ��� -->

<table  width="1700" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ����Ǻ����ż�Ե����ɵ� ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_purple"> 
    <td rowspan="3" width="20" align="center" valign="middle">���</td>
    <td rowspan="3" width="300" align="center" valign="middle">�������Թ���</td>
    <td rowspan="3" width="50" align="center" valign="middle">˹��¹Ѻ</td>
    <td colspan="2" align="center">�Թ��Ҥ������¡�ҵ鹻�</td>
    <td rowspan="3" width="80" align="center" valign="middle">�Ҥҵ��˹���<br>(�ҷ)</td>
    <td colspan="14" align="center">��Ť���Թ��ҷ������������͹ ( �ѹ�ҷ )</td>
    <td colspan="2" align="center">����Թ��ҷ���������ը�˹���</td>
  </tr>
  <tr class="rows_purple"> 
    <td rowspan="2" width="70" align="center">�ӹǹ<br>˹���</td>
    <td rowspan="2" width="70" align="center">�ӹǹ�Թ<br>(�ѹ�ҷ)</td>
    <td rowspan="2" width="70" align="center">��.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">��.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">�.�.</td>
    <td rowspan="2" width="70" align="center">��.�.</td>
    <td colspan="2" align="center">���������</td>
    <td rowspan="2" width="75" align="center">��˹���<br>˹���</td>
    <td rowspan="2" width="75" align="center">�ӹǹ�Թ<br>(�ѹ�ҷ)</td>
  </tr>
  <tr class="rows_purple"> 
    <td align="center" width="50" align="center">˹���</td>
    <td align="center" width="70" align="center">�ӹǹ�Թ</td>
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
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x1"?>" id="<?=trim($fetch_plan[0])."x1"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',1) " value="<?=number_format($fetch_plan[3],0,'',''); ?>"></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x2"?>" id="<?=trim($fetch_plan[0])."x2"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',2); " value="<?=number_format($fetch_plan[4],0,'',''); ?>"></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x3"?>" id="<?=trim($fetch_plan[0])."x3"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',3); " value="<?=number_format($fetch_plan[5],0,'',''); ?>"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x4"?>" id="<?=trim($fetch_plan[0])."x4"?>" class="txt_num"  onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',4); " value="<?=number_format($fetch_plan[6],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x5"?>" id="<?=trim($fetch_plan[0])."x5"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',5); " value="<?=number_format($fetch_plan[7],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x6"?>" id="<?=trim($fetch_plan[0])."x6"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',6); " value="<?=number_format($fetch_plan[8],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x7"?>" id="<?=trim($fetch_plan[0])."x7"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',7); " value="<?=number_format($fetch_plan[9],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x8"?>" id="<?=trim($fetch_plan[0])."x8"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',8); " value="<?=number_format($fetch_plan[10],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x9"?>" id="<?=trim($fetch_plan[0])."x9"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',9); " value="<?=number_format($fetch_plan[11],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x10"?>" id="<?=trim($fetch_plan[0])."x10"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',10); " value="<?=number_format($fetch_plan[12],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x11"?>" id="<?=trim($fetch_plan[0])."x11"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',11); " value="<?=number_format($fetch_plan[13],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x12"?>" id="<?=trim($fetch_plan[0])."x12"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',12); " value="<?=number_format($fetch_plan[14],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x13"?>" id="<?=trim($fetch_plan[0])."x13"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',13); " value="<?=number_format($fetch_plan[15],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x14"?>" id="<?=trim($fetch_plan[0])."x14"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',14); " value="<?=number_format($fetch_plan[16],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x15"?>" id="<?=trim($fetch_plan[0])."x15"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',15); " value="<?=number_format($fetch_plan[17],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x16"?>" id="<?=trim($fetch_plan[0])."x16"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',16); " value="<?=number_format($fetch_plan[18],0,'',''); ?>"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x17"?>" id="<?=trim($fetch_plan[0])."x17"?>" class="txt_num_system" value="<?=number_format($fetch_plan[19],0,'',''); ?>" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x18"?>" id="<?=trim($fetch_plan[0])."x18"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>',18); " value="<?=number_format($fetch_plan[20],0,'',''); ?>"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x19"?>" id="<?=trim($fetch_plan[0])."x19"?>" class="txt_num_system" value="<?=number_format($fetch_plan[21],0,'',''); ?>" readonly></td>
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
		$temp16=$temp16+number_format($fetch_plan[18],0,'','');
		$temp17=$temp17+number_format($fetch_plan[19],0,'','');
		$temp18=$temp18+number_format($fetch_plan[20],0,'','');
		$temp19=$temp19+number_format($fetch_plan[21],0,'','');

	} // end while ?>
	<!--  �ʴ������ŷ���������� colume -->
  <tr>
	<td align="center" colspan="3" class="rows_yellow"> ��� </td>  
	<td align="center"><input type="text" size="7"  id="sum1" name="sum1" class="txt_num_system" value="<?=number_format($temp01);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum2" name="sum2" class="txt_num_system" value="<?=number_format($temp02);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum3" name="sum3" class="txt_num_system" value="<?=number_format($temp03);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum4" name="sum4" class="txt_num_system" value="<?=number_format($temp04);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum5" name="sum5" class="txt_num_system" value="<?=number_format($temp05);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum6" name="sum6" class="txt_num_system" value="<?=number_format($temp06);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum7" name="sum7" class="txt_num_system" value="<?=number_format($temp07);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum8" name="sum8" class="txt_num_system" value="<?=number_format($temp08);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum9" name="sum9" class="txt_num_system" value="<?=number_format($temp09);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum10" name="sum10" class="txt_num_system" value="<?=number_format($temp10);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum11" name="sum11" class="txt_num_system" value="<?=number_format($temp11);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum12" name="sum12" class="txt_num_system" value="<?=number_format($temp12);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum13" name="sum13" class="txt_num_system" value="<?=number_format($temp13);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum14" name="sum14" class="txt_num_system" value="<?=number_format($temp14);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum15" name="sum15" class="txt_num_system" value="<?=number_format($temp15);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum16" name="sum16" class="txt_num_system" value="<?=number_format($temp16);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum17" name="sum17" class="txt_num_system" value="<?=number_format($temp17);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum18" name="sum18" class="txt_num_system" value="<?=number_format($temp18);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum19" name="sum19" class="txt_num_system" value="<?=number_format($temp19);?>" readonly></td>
	</tr>
	<tr height="40">
		<input name="click" type="hidden" value="<?=$click; ?>">
		<td colspan="22" align="center"><input type="submit" value=" �ѹ�֡������ ">&nbsp;<input type="reset" value=" ¡��ԡ "></td>
	</tr>
<!--  ����ش��Ѻ��ا������ -->
</form>
<!-- ***************************************************************************************************************************************** -->
</table>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
	include("../footer.php")
?>