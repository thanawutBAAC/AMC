<?php session_start();
  include("../../check_login.php");
  include("../../lib/config.inc.php");
  include("../../lib/database.php");
  connect();	

	$month_thai = array("1"=>'����¹',"2"=>'����Ҥ�',"3"=>'�Զع�¹',"4"=>'�á�Ҥ�',"5"=>'�ԧ�Ҥ�',"6"=>'�ѹ��¹',"7"=>'���Ҥ�',"8"=>'��Ȩԡ�¹',"9"=>'�ѹ�Ҥ�',"10"=>'���Ҥ�',"11"=>'����Ҿѹ��',"12"=>'�չҤ�');

	$sql_year = " SELECT DISTINCT skt_year FROM AnnSkt ORDER BY skt_year ";
	$result_year =	query($sql_year);

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
<br>
<!-- ============================================================================ -->
<form name='' method='post' action='cal_process.php' Onsubmit=' return confirm_submit(); ' >
<table width="660" style=" text-align: center;" border="0" cellpadding="0" cellspacing="0" class="report" align="center">
<tr>
	<td colspan="4" valign="top" >
	<table width="659" border="0" cellpadding="0" cellspacing="0" style="margin: 1 1 1 1;">
		<tr height="30px">
		  	<td align="center" class="rows_brown"><strong> �ӹǳ�����żš�ô��Թ�ҹ�ҡ�ç���»���ҷ���� </strong></td>
		</tr>
	</table>
	</td>	
</tr>
<tr height="25" valign="bottom" align="center" class='rows_purple'>
	<td colspan='2' align='center'><b> ���͡��ǧ�����ŷ���ͧ��þ�ҡó� </b></td>
</tr>
<tr height="35" align="center" >
	<td align='right' > �������ż�Ե :</td>
	<td align='left'>  &nbsp;
		<select name='p' >
			<option value='1' selected>   �������͡ </option>
			<option value='2'>   ����⾴ </option>
			<option value='3'>   �ѹ�ӻ���ѧ </option>
			<option value='4'>   ���� </option>
			<option value='5'>   �ҧ���� </option>
		</select>
	</td>
</tr>
<tr height="25" align="center">
	<td align="right"> ������鹢����� : </td>
	<td align='left'>&nbsp;
	 <select name="year_start" >
	<?
		WHILE($fetch_year = fetch_row($result_year)) {
	?>
			<option value="<?=trim($fetch_year[0]) ?>"><?=trim($fetch_year[0]) ?> </option>
	<?	} // end while
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
		</select>  
	</td>
</tr>
<tr height="25" align="center">
	<td align="right"> ����ش������  : </td>
	<td align='left'>&nbsp;
	 <select name="year_stop" >
	<?
		WHILE($fetch_year = fetch_row($result_year)) {
	?>
			<option value="<?=trim($fetch_year[0]) ?>"><?=trim($fetch_year[0]) ?> </option>
	<?
		} // end while 
	?>
		</select>
	��͹ <select name="month_stop">
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
		</select>  
	</td>
</tr>
<tr height="45">
	<td colspan="2" align="center"><input type='submit' value=' ��ҡó������ '>&nbsp;&nbsp;<input type='reset' value=' ¡��ԡ '><td>
</tr>
</table>
</form>
<!-- ============================================================================ -->
<br>
<table class='gridtable' width='98%' style='margin-top:15px; margin-left:5px; margin-right:5px;'>
<tr class='rows_pink' align='center'>
	<td> �ӴѺ </td>
	<td> ������ </td>
	<td> Function Hidden</td>
	<td> Function Output </td>
	<td> ��� MSE ��ӷ���ش </td>
	<td> �ӹǹ���駷�����¹��� </td>
	<td> ��ǧ������㹡�� Train  </td>
</tr>
<?
	$product_list = array("1"=>'����',"2"=>'����⾴',"3"=>'�ѹ�ӻ���ѧ',"4"=>'����',"5"=>'�ҧ����');
	$function_list = array("1"=>' Log-Sigmoid',"2"=>'Tan-Sigmoid',"3"=>'Linear');
	$month_list = array("1"=>'����¹',"2"=>'����Ҥ�',"3"=>'�Զع�¹',"4"=>'�á�Ҥ�',"5"=>'�ԧ�Ҥ�',"6"=>'�ѹ��¹',"7"=>'���Ҥ�',"8"=>'��Ȩԡ�¹',"9"=>'�ѹ�Ҥ�',"10"=>'���Ҥ�',"11"=>'����Ҿѹ��',"12"=>'�չҤ�');

	$sql = " SELECT Product_code,Fn_Hidden,Hidden_Neuron,Fn_Output,MSE,Total_rows , ";
	$sql.=" Data_Trianing_start,Data_Trianing_stop FROM  AnnPerceptron ";
	$sql.=" WHERE Status='1' ";
	$sql.=" ORDER BY Product_code ";
	$result_report = query($sql);
	$i = 0;
	WHILE($fetch_report = fetch_row($result_report)) { 
		$i++;						
		if(($i%2)==0) { ?>
			<tr class='rows_grey'>
		<? } else  { ?>
			<tr>
		<? } // end if  
			$date_start = explode("@",$fetch_report[6]);
			$date_stop = explode("@",$fetch_report[7]);
		?>
		<td align='center'><?=$i ?></td>
		<td align='left'>&nbsp;<?=$product_list[trim($fetch_report[0])] ?></td>
		<td align='center'><?=$function_list[trim($fetch_report[1])]."  &nbsp;<font color='red'>[".trim($fetch_report[2])."]</font>" ?></td>
		<td align='center'><?=$function_list[trim($fetch_report[3])] ?></td>
		<td align='right'><?=$fetch_report[4] ?>&nbsp;</td>
		<td align='right'><?=number_format($fetch_report[5],0,'',',') ?>&nbsp;</td>
		<td align='center'><?=$month_list[$date_start[0]]." ".$date_start[1]  ?>-<?=$month_list[$date_stop[0]]." ".$date_stop[1]  ?></td>
	</tr>
<?	} // end while  ?>
</table>
</body>
</body>
</html>
<?
	include("../footer.php")
?>