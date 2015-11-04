<?php session_start();
  include("../../check_login.php");
  include("../../lib/config.inc.php");
  include("../../lib/database.php");
  connect();

  // =================================//
  // ��˹���Ҿ����������ҧ � 㹡�����ç���»���ҷ����Ẻ Backpropagation Neural Networks
  //  1. ��ӹǹ Layer �ӹǹ 3 Layer ��� Input , Hidden , Output
  //  2. ��˹���Ң�鹵�ӷ������ö����Ѻ�� Learning Rate 
  //  3. ��˹��ӹǹ�ͺ㹡�����¹��� Epochs
  //  4. ��˹���������������  Bias Value
  //  5. ��˹��ٻẺ Transfer Function ��ҧ � � Hidden , Output  Layer
  //  6. ��˹��ӹǹ Neuron ����� Layer
  //  7. ��˹����������ҹ��˹ѡ�������  Weight
  //  8. ��˹���ǧ�������Ң�����㹡�����¹���  set data training
  // =================================//

$month_thai = array("1"=>'����¹',"2"=>'����Ҥ�',"3"=>'�Զع�¹',"4"=>'�á�Ҥ�',"5"=>'�ԧ�Ҥ�',"6"=>'�ѹ��¹',"7"=>'���Ҥ�',"8"=>'��Ȩԡ�¹',"9"=>'�ѹ�Ҥ�',"10"=>'���Ҥ�',"11"=>'����Ҿѹ��',"12"=>'�չҤ�');

$sql_year = " SELECT DISTINCT skt_year FROM AnnSkt ORDER BY skt_year ";
$result_year =	 query($sql_year);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
<script language="JavaScript">
	function confirm_submit()
	{
			if (confirm(" ��س��׹�ѹ����������кǹ������¹��� ")) {
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
<!-- ============================================================================ -->
<table width="660" style=" text-align: center;" border="0" cellpadding="0" cellspacing="0" class="report" align="center">
<form name='' method='post' action='set_ann_process.php' Onsubmit=' return confirm_submit(); ' >
<tr>
	<td colspan="4" valign="top" >
	<table width="659" border="0" cellpadding="0" cellspacing="0" style="margin: 1 1 1 1;">
		<tr height="30px">
		  	<td align="center" bgcolor="#EEEEEE"><strong> ��˹���� ���������� 㹡�����ҧ�����ç���»���ҷ���� </strong></td>
		</tr>
	</table>
	</td>	
</tr>
<tr height="25" valign="bottom" align="center" class='rows_green'>
	<td> &nbsp; </td>
	<td><b> Input Layer </b></td>
	<td><b> Hidden Layer </b></td>
	<td><b> Output Layer </b></td>
</tr>
<tr height="25" valign="bottom" align="center" >
	<td align='right'> Activation Function :</td>
	<td>  <!-- ��˹��ٻẺ Function ����� Layer  -->&nbsp;</td>
	<td>  
		<select name='fn_hidden'>
			<option value='1' selected> Log-Sigmoid </option>
			<option value='2'> Tan-Sigmoid </option>
			<option value='3'> Linear </option>
		</select>
	</td>
	<td>  
		<select name='fn_output'>
			<option value='1'> Log-Sigmoid </option>
			<option value='2'> Tan-Sigmoid </option>
			<option value='3' selected> Linear </option>
		</select>
	</td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Neuron :</td>
	<td><input name='n1' size='13' maxlength='8' value='11' class="txt_system" readonly></td>
	<td><input name='neuron_hidden' size='13' maxlength='8' value='8' class="txt" onKeyPress="return isNumberKeyMinus(this);"></td>
	<td><input name='n3' size='13' maxlength='8' value='1' class="txt_system" readonly></td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Normalization : </td>
	<td>
		<input name='nor_min' size='4' maxlength='4' value='0' class="txt_system" readonly> -
		<input name='nor_max' size='4' maxlength='4' value='1' class="txt_system" readonly>
	</td>
	<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Weight  Initialization : </td>
	<td>
		<input name='weight_min' size='4' maxlength='4' value='0.1' class="txt" onKeyPress="return isNumberKeyMinus(this);"> -
		<input name='weight_max' size='4' maxlength='4' value='1' class="txt" onKeyPress="return isNumberKeyMinus(this);">
	</td>
	<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Bias Initialization :</td>
	<td>
		<input name='bias_min' size='4' maxlength='4' value='0.1' class="txt" onKeyPress="return isNumberKeyMinus(this);"> -
		<input name='bias_max' size='4' maxlength='4' value='1' class="txt" onKeyPress="return isNumberKeyMinus(this);">
	</td>
	<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Epochs : </td>
	<td><input name='epochs' size='13' maxlength='8' value='1000' class="txt" onKeyPress="return isNumberKeyMinus(this);"></td>
	<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Learning Rate : </td>
	<td><input name='learn_rate' size='13' maxlength='8' value='0.05' class="txt" onKeyPress="return isNumberKeyMinus(this);"></td>
	<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr height="25" valign="bottom" align="center">
	<td align="right"> Error threshold : </td>
	<td><input name='error_threshold' size='13' maxlength='8' value='0.005' class="txt" onKeyPress="return isNumberKeyMinus(this);"></td>
	<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr height="25" valign="bottom" align="center" >
	<td align='right'> Product :</td>
	<td>  
		<select name='p' >
			<option value='1' selected>  &nbsp;&nbsp; �������͡ </option>
			<option value='2'>  &nbsp;&nbsp; ����⾴ </option>
			<option value='3'>  &nbsp;&nbsp; �ѹ�ӻ���ѧ </option>
			<option value='4'>  &nbsp;&nbsp; ���� </option>
			<option value='5'>  &nbsp;&nbsp; �ҧ���� </option>
		</select>
	</td>
	<td colspan='2'>&nbsp;</td>
</tr>
<tr height="35" align="center">
	<td align="right"> Data Trianing : </td>
	<td colspan='3'>
	������鹻� <select name="year_start" >
	<?
		WHILE($fetch_year = fetch_row($result_year)) {
	?>
			<option value="<?=trim($fetch_year[0]) ?>"><?=trim($fetch_year[0]) ?> </option>
	<?
		} // end while
	data_seek($result_year);
	?>
	</select>
	��͹ <select name="month_start">
			<?
			$month_now = 1;
			foreach ($month_thai as $i => $m)
			{
				if($i==$month_now)
		  			echo "<option value='$i' selected>$m</option>"; 
				else
					echo "<option value='$i'>$m</option>";	
			}
		?>
		</select> -- 
		���֧�� <select name="year_stop">
		<?
			WHILE($fetch_year = fetch_row($result_year)) {
		?>
			<option value="<?=trim($fetch_year[0]) ?>"><?=trim($fetch_year[0]) ?> </option>
		<?  } // end while	?>
		</select>
		</select>
	��͹ <select name="month_stop">
			<?
			$month_now = 12;
			foreach ($month_thai as $i => $m)
			{
				if($i==$month_now)
		  			echo "<option value='$i' selected>$m</option>"; 
				else
					echo "<option value='$i'>$m</option>";	
			}
		?>
		</select>
	</td>
</tr>
<tr height="45">
	<td colspan="4" align="center"><input type='submit' value=' �������кǹ������¹��� '>&nbsp;&nbsp;<input type='reset' value=' ¡��ԡ '><td>
</tr>
</form>
</table>
</body>
</html>
<?
	include("../footer.php")
?>