<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');

	connect();	
?>
<html>
<head>
	<title></title>
	<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<? include("../manu_bar.php"); ?>
<!-- ************************************************************************************************************************************** -->
<form name="frm_lock" action="lock_report_detail_sql.php" method="post" Onsubmit=" return confirm_submit(); ">
<div style=" margin-left:85px;">
<input type="checkbox" name="checkbox_all" OnClick=" checkAll(); ">���͡������ <img src="../images/application_form_edit.gif" style="vertical-align: text-bottom;">
</div>
<table  width="600" align="center" class="gridtable" style="margin-top:5px;">
<tr height="25"><td colspan="5">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> �����š������§ҹ��Ш���͹ ʡ�. <?=trim($temp_name); ?></b></center></font>
</td></tr>
<tr class="rows_pink"> 
	<td align="center" width="100"> �� </td>
	<td align="center" width="100"> ��͹ </td>
	<td align="center" width="150"> �ѹ����� </td>
	<td align="center" width="100"> ���ҷ���� </td>
	<td align="center" width="150" > <span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/lock.png');" class="span_icon">
	<img src="../icons/lock.png" alt=" ʶҹС�û�ͧ�ѹ " class="images_icon" > 
	</span> &nbsp;ʶҹС�û�ͧ�ѹ </td>
</tr>
<?  
	$sql = " SELECT sent_year, sent_month, sent_date, sent_time, sent_status ";
	$sql.=" FROM SentReportHeader ";
	$sql.=" WHERE amccode='".$temp_amccode."' ";
	$sql.=" ORDER BY sent_year, sent_month DESC ";

	$result_report =	query($sql);
	$i=0;
	WHILE( $fetch_report = fetch_row($result_report))
	{  $i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
?>		
	<td align="center"><?=trim($fetch_report[0]); ?></td>
	<td align="left">&nbsp;<?=$month_thai[trim($fetch_report[1])]; ?></td>
	<td align="center"><?=trim($fetch_report[2]); ?></td>
	<td align="center"><?=trim($fetch_report[3]); ?></td>
	<?
		$check_status = '';
		if(trim($fetch_report[4])=='2')
		{	$check_status = 'checked';	}
	?>
	<td align="center"><input type="checkbox" name="i<?=$i;?>" id="i<?=$i; ?>" <?=$check_status; ?> value='2'></td>
	</tr>
<?   } // end while  ?>
</table>
<br>
<input type="hidden" name="temp_amccode"  value="<?=$temp_amccode?>">
<center><input type="submit" value=" �ѹ�֡������ ">&nbsp;<input type="reset" value=" ¡��ԡ "> </center>
</form>
<!-- ************************************************************************************************************************************** -->
<script language="JavaScript">
var array_count="<?=$i?>";
//  ���͡�����ŷ�����
	 function checkAll()
	 {
		 for(var j=1;j<=array_count;j++)
		 {
			 box = eval("document.frm_lock.i"+j);
			 if (frm_lock.checkbox_all.checked)
				{	if(box.checked==false) box.checked = true;  }
			 else
				{	if(box.checked==true) box.checked = false;   }
		 }
	 }
</script>

<script language="JavaScript">
		function confirm_submit()
		{
			if (confirm(" ��س��׹�ѹ��úѹ�֡������ ")) {
				return true;
			}
			else
			{
				return false;
			}
		}
	</script>
<?php
	free_result($result_report);
	close();
?>
</body>
</html>
<?
	include("../footer.php")
?>