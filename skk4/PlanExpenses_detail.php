<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

// �ʴ���������Ǵ��� 7 �ͧʡ� ������͡������
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name, ";
$sql.=" Temp01.PlanExpenses_Apr, ";
$sql.=" Temp01.PlanExpenses_May, Temp01.PlanExpenses_Jun,  ";
$sql.=" Temp01.PlanExpenses_Jul, Temp01.PlanExpenses_Aug,  ";
$sql.=" Temp01.PlanExpenses_Sep, Temp01.PlanExpenses_Oct,  ";
$sql.=" Temp01.PlanExpenses_Nov, Temp01.PlanExpenses_Dec,  ";
$sql.=" Temp01.PlanExpenses_Jan, Temp01.PlanExpenses_Feb,  ";
$sql.=" Temp01.PlanExpenses_Mar, Temp01.PlanExpenses_Sum  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT  PlanExpenses_Apr, ";
$sql.="	PlanExpenses_May, PlanExpenses_Jun,  ";
$sql.="	PlanExpenses_Jul, PlanExpenses_Aug,  ";
$sql.="	PlanExpenses_Sep, PlanExpenses_Oct,  ";
$sql.="	PlanExpenses_Nov, PlanExpenses_Dec,  ";
$sql.="	PlanExpenses_Jan, PlanExpenses_Feb,  ";
$sql.="	PlanExpenses_Mar, PlanExpenses_Sum,  ";
$sql.="	report_detail_code, amccode, PlanExpenses_year  ";
$sql.="	FROM PlanExpenses  ";
$sql.="	WHERE amccode='".$code_online."' AND ";
if($click=='add')
{	$sql.=" PlanExpenses_year='9999'  "; }
elseif($click=='edit')
{	$sql.=" PlanExpenses_year='".$year."'  "; }
$sql.=") AS Temp01  "; 
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
if($click=='add')
{	$sql.=" AND Temp01.PlanExpenses_year = '9999'  "; }
elseif($click=='edit')
{	$sql.=" AND Temp01.PlanExpenses_year = '".$year."'  "; }
$sql.=" WHERE BaseReportDetail.report_group_code='7'   ";
$sql.=" ORDER BY CAST(BaseReportDetail.report_detail_code AS INT) ";
$result_plan =	query($sql);

	WHILE($fetch_id = fetch_row($result_plan)) {
			$product_id =	$product_id.trim($fetch_id[0])."#";
	}
	$product_id = substr($product_id,0,strlen($product_id)-1);	  // ���������Թ��ҷ���ͧ����ҷ����� ���Ǥ�蹴��� # 

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

	alert(' �����Ť���������١��Ѻ��ا�� : ˹��¾ѹ�ҷ ');
//  �ʴ������������㹴�ҹ colums
	function update_cols(cols)
	{
		var temp_02 = 0;
		for(i=0;i<Array_Max;i++){
			temp_02 = temp_02 + parseInt(document.getElementById(Array_Temp[i]+'x'+cols).value);
		} // end for
		var sum = document.getElementById("sum"+cols);
		sum.value = temp_02;
	} // end function

// �ʴ������������㹴�ҹ rows
	function update_rows(rows)
	{
		var t1 = document.getElementById(rows+"x1");
		var t2 = document.getElementById(rows+"x2");
		var t3 = document.getElementById(rows+"x3");
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

		t13.value =parseInt(t1.value)+parseInt(t2.value)+parseInt(t3.value)+parseInt(t4.value)+parseInt(t5.value)+parseInt(t6.value)+parseInt(t7.value)+parseInt(t8.value)+parseInt(t9.value)+parseInt(t10.value)+parseInt(t11.value)+parseInt(t12.value);
	} // end function

// �觤�ҷ�����ҷ�� function ��� ���йӢ�����任�Ѻ��ا���д�ҹ
	function update_data(x,y)
	{
		update_rows(x);
		update_cols(y);
		update_cols(13);
	} // end function

// �׹�ѹ��͹��Ѻ��ا������		
	function check_submit()
	{
		var temp_01;
		var temp_false = false;
		// ��Ǩ�ͺ��ҷ�������͹����դ����ҧ�������
		for(j=1;j<=13;j++)
		{
			for(i=0;i<Array_Max;i++)
			{
				temp_01 = document.getElementById(Array_Temp[i]+"x"+j);
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
	}  // end function
</script>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<div style="margin-left:auto; margin-right:auto; text-align: center "> ��������´Ἱ��� <font color='red'>��������</font> ʡ�.  </div>
<!-- ******************************************************************************************************************************************** -->
<form name="Frm_Expenses" action="PlanExpenses_sql.php" method="post" onsubmit=" return check_submit();">
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
			}  // end date?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>
<? } // end add?>
<? if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<?  } ?>
<!-- ����ش����ʴ��� -->
<table  width="1260" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ��û���ҳ��ä������¢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_blue"> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">��������������</td>
    <td colspan="12" align="center">��������������͹ (˹��� : �ѹ�ҷ)</td>
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
	<td align="center"><?=$i;?></td>  
	<td align="left">&nbsp;<?=trim($fetch_plan[1]); ?></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x1"?>" id="<?=trim($fetch_plan[0])."x1"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','1') " value="<?=number_format($fetch_plan[2],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x2"?>" id="<?=trim($fetch_plan[0])."x2"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','2'); " value="<?=number_format($fetch_plan[3],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x3"?>" id="<?=trim($fetch_plan[0])."x3"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','3'); " value="<?=number_format($fetch_plan[4],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x4"?>" id="<?=trim($fetch_plan[0])."x4"?>" class="txt_num"  onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','4'); " value="<?=number_format($fetch_plan[5],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x5"?>" id="<?=trim($fetch_plan[0])."x5"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','5'); " value="<?=number_format($fetch_plan[6],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x6"?>" id="<?=trim($fetch_plan[0])."x6"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','6'); " value="<?=number_format($fetch_plan[7],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x7"?>" id="<?=trim($fetch_plan[0])."x7"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','7'); " value="<?=number_format($fetch_plan[8],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x8"?>" id="<?=trim($fetch_plan[0])."x8"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','8'); " value="<?=number_format($fetch_plan[9],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x9"?>" id="<?=trim($fetch_plan[0])."x9"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','9'); " value="<?=number_format($fetch_plan[10],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x10"?>" id="<?=trim($fetch_plan[0])."x10"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','10'); " value="<?=number_format($fetch_plan[11],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x11"?>" id="<?=trim($fetch_plan[0])."x11"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','11'); " value="<?=number_format($fetch_plan[12],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x12"?>" id="<?=trim($fetch_plan[0])."x12"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','12'); " value="<?=number_format($fetch_plan[13],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x13"?>" id="<?=trim($fetch_plan[0])."x13"?>" class="txt_num_system" value="<?=number_format($fetch_plan[14],0,'',''); ?>"  readonly></td>
	</tr>
<? 
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
	</tr>
	<tr height="40">
		<input name="click" type="hidden" value="<?=$click; ?>">
		<td colspan="18" align="center"><input type="submit" value=" �ѹ�֡������ ">&nbsp;<input type="reset" value=" ¡��ԡ "></td>
	</tr>
<!--  ����ش��Ѻ��ا������ -->
</form>
<!-- ***************************************************************************************************************************************** -->
</table>
<p>
&nbsp;&nbsp;  <strong><u>�����˵�</u></strong> ( �������·�������������駢ͧ���������о�ѡ�ҹ)<br>
&nbsp;&nbsp;  <strong>�Թ��͹��Ф�Ҩ�ҧ</strong> =  �Թ��͹ ��Ҩ�ҧ ����ç�ҹ �����ǧ���� ����ͧ���»�Ш� <br>
&nbsp;&nbsp;  <strong> ��ҵͺ᷹ </strong> = ��ҵͺ᷹����ɷ������繤��駤��� �͡�˹�ͨҡ�Թ��͹<br>
&nbsp;&nbsp;  <strong> ��Ҿ�˹���й���ѹ������ԧ</strong> = ��Ҿ�˹� ��Ң��� ��ҹ���ѹ������ԧ �ͧ��ѡ�ҹ��С������<br>
&nbsp;&nbsp;  <strong>��������㹡�û�Ъ�� </strong>= ��������㹡�û�Ъ�� ���»�Ъ�� <br>
&nbsp;&nbsp;  <strong> �����������ʴԡ��</strong> = ����ѡ�Ҿ�Һ�� ����������¹�ص� ��Ҥ�ͧ�վ �������ͧẺ ����������¹�ص� �ͧ��ѡ�ҹ��С������<br>
&nbsp;&nbsp;  <strong> ����������˹ѡ�ҹ </strong>= ��ҹ�� ���俿�� ��ҷӤ������Ҵ �����ɳ����Ţ  ������Ѿ���ӹѡ�ҹ ��Ҷ����͡���<br>
&nbsp;&nbsp;   <strong>����ػ�ó��ӹѡ�ҹ��� </strong>= ��Ҷ����͡��� �������ͧ��¹Ẻ����� ����ػ�ó��ӹѡ�ҹ<br>
&nbsp;&nbsp;  <strong> �Թ�����ͧ�ع</strong> = ��Сѹ�ѧ�� ���ͧ����§�վ �ͧ�ع���˹�<br>
&nbsp;&nbsp;  <strong> ������</strong> = �����Ҥ�ѧ�Թ��� �������ӹѡ�ҹ �������Ҥ��<br>
&nbsp;&nbsp;   <strong>��ҫ�����</strong> = ����ѳ�� �ҹ��˹� �Ҥ�� �Թ��Ѿ��<br>
</p>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
	include("../footer.php")
?>