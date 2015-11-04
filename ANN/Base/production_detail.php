<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");
	
	if($code=='1'){
		$temp_name = '����';
	}
	elseif($code=='2'){
		$temp_name = '����⾴';
	}
	elseif($code=='3'){
		$temp_name = '�ѹ�ӻ���ѧ';
	}
	elseif($code=='4'){
		$temp_name = '����';
	}
	elseif($code=='5'){
		$temp_name = '�ҧ����';
	}

	connect();	
	$click = $_GET['click'];
	if($click=='add')
	{  // �ó�����������
		$temp_planted = 0; // ���ͷ����л�١ 
		$temp_harvested = 0; // ���ͷ���������
		$temp_production = 0; // �ż�Ե
		$temp_yield = 0; // �ż�Ե ��� ��
		$temp_farm_price = 0; // �Ҥ��ɵáâ���
		$temp_farm_value = 0; //  ��Ť�Ңͧ�ż�Ե����Ҥ��ɵâ���
	}
	else
	{  // �ó���䢢�����
		$year = $_GET['year'];
		$sql = " SELECT Planted,Harvested,Production,Yield,Farm_price,Farm_value ";
		$sql.=" FROM AnnProduction WHERE Product_code='".$code."' AND Product_year='".$year."' ";
		$result_production = query($sql);
		$temp_planted = number_format(result($result_production,0,'Planted'),0,'',''); // ���ͷ����л�١
		$temp_harvested = number_format(result($result_production,0,'Harvested'),0,'',''); // ���ͷ���������
		$temp_production =	number_format(result($result_production,0,'Production'),0,'','');  // �ż�Ե
		$temp_yield = number_format(result($result_production,0,'Yield'),0,'',''); // �ż�Ե ��� ��
		$temp_farm_price = number_format(result($result_production,0,'Farm_price'),2,'.','');  // �Ҥ��ɵáâ���
		$temp_farm_value = number_format(result($result_production,0,'Farm_value'),0,'','');  //  ��Ť�Ңͧ�ż�Ե����Ҥ��ɵâ���
	} // end if 

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
<script language="JavaScript">
		function check_submit()
		{
			 if(frm_base.planted.value.length==0)
			{
					alert('��سҺѹ�֡ ���ͷ����л�١');
					frm_base.planted.focus();
					return false;
			}
			 else if(frm_base.harvested.value.length==0)
			{
					alert('��سҺѹ�֡ ���ͷ���������');
					frm_base.harvested.focus();
					return false;
			}
			 else if(frm_base.production.value.length==0)
			{
					alert('��سҺѹ�֡ �ż�Ե');
					frm_base.production.focus();
					return false;
			}
			 else if(frm_base.yield.value.length==0)
			{
					alert('��سҺѹ�֡ �ż�Ե ��� ��� ');
					frm_base.yield.focus();
					return false;
			}
			 else if(frm_base.farm_price.value.length==0)
			{
					alert('��سҺѹ�֡ �Ҥ��ɵáâ����');
					frm_base.farm_price.focus();
					return false;
			}
			 else if(frm_base.farm_value.value.length==0)
			{
					alert('��سҺѹ�֡ ��Ť�Ңͧ�ż�Ե����Ҥ��ɵâ����');
					frm_base.farm_value.focus();
					return false;
			}

			if (confirm(" ��س��׹�ѹ��úѹ�֡������ ")) {
				return true;
			}
			else {
				return false; 
			}

		}
</script>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************** -->
<form name='frm_base' action='production_sql.php' method='post' onsubmit=" return check_submit(); ">
&nbsp;&nbsp;&nbsp;
<?
	if($click=='add')
	{	?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon">
	<img src="../../icons/application_add.png" alt=" ���������� " class="images_icon" >
	</span>&nbsp;���������ŻѨ��¾�鹰ҹ<?=$temp_name ?>
	<? }
	else
	{ ?>
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon">
		<img src="../../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
		</span>&nbsp;��䢢����ŻѨ��¾�鹰ҹ<?=$temp_name ?>
	<? } // end if  ?>
<!--  ����繡������������������ʴ� list ������͡  ����繡����䢨��ʴ� �� textbox -->
<!--  �ʴ������Żշ�����͡ -->
<?
	if($click=='add')
	{	  $temp_year =  date("Y")+530; ?>
	<select name="year">
	<? WHILE($i<20) { 
		  $i++; 
		  $temp_year = $temp_year+1; ?>
		<option value="<?=$temp_year; ?>" 
		<? 
			if($temp_year==date("Y")+543){
				echo "selected";
			} // end if 
		?>><?=$temp_year; ?></option>
	<?  } // end while ?>
	</select>
<? } // end add
 if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<?  } ?>
<!-- ����ش����ʴ���  ��͹ -->

<table width="740" align="center" class="gridtable" style="margin:10 15 10 15 px;">
	<tr height='25px' class='rows_orange'>
		<td colspan="6"align="left">&nbsp;<b>�����ŻѨ��¾�鹰ҹ<?=$temp_name ?></b></td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="120"> ���ͷ����л�١ <br>(1,000 ���)</td>
		<td align="center" width="120"> ���ͷ��������� <br>(1,000 ���)</td>
		<td align="center" width="120"> �ż�Ե <br>(1,000 �ѹ)</td>
		<td align="center" width="120"> �ż�Ե������ <br> ��. </td>
		<td align="center" width="130"> �Ҥҷ���ɵáâ���� <br> ( �ҷ/�ѹ)</td>
		<td align="center" width="130"> ��Ť�ҵ���ż�Ե���<br>�ɵáâ���� <br>( ��ҹ�ҷ )</td>
	</tr>
	<tr>
		<td align="center"><input type="text" size="9" maxlength="9" name='planted' value="<?=$temp_planted; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='harvested' value="<?=$temp_harvested; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9" name='production' value="<?=$temp_production; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='yield' value="<?=$temp_yield; ?>" class="txt_num" onKeyPress="return isNumberKey(this);" ></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='farm_price' value="<?=$temp_farm_price; ?>" class="txt_num" onKeyPress="return isNumberKeyMinus(this);"></td>
		<td align="center"><input type="text" size="9" maxlength="9"  name='farm_value' value="<?=$temp_farm_value; ?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
	</tr>
</table>
<br>
<center>
<input name="click" type="hidden" value="<?=$click; ?>">
<input name="code" type="hidden" value="<?=$code; ?>">
<input type="submit" value=" �ѹ�֡������ ">&nbsp;<input type="reset" value=" ¡��ԡ ">
</center>
</form>
<!-- *********************************************************************************************** -->
</body>
</html>
<?php
	close();
	include("../footer.php")
?>