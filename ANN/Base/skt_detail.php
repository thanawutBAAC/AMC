<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");

	connect();	
	$click = $_GET['click'];

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
		var temp_false = false;
		for(i=1;i<=12;i++)
		{
			for(j=1;j<=5;j++)
			{
				temp_01 = document.getElementById(j+"x"+i);
				if(temp_01.value.length==0)
				{
					temp_false = true;		
				}  // end if 
			}  // end for j 
		}  // end for i

		// �óշ���դ����ҧ���͹حҵ����ʴ�������
		if(temp_false==true) {
			alert(' ��سһ�͹�����ŵ���Ţ���ú�ء��ͧ ');
			return false;
		}

		if (confirm(" ��س��׹�ѹ��û�Ѻ��ا������ ")) {
			return true;
		}
		else {
			return false; 
		}
	}  // end function
</script>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************** -->
<form name='frm_base' action='skt_sql.php' method='post' onsubmit=" return check_submit(); ">
&nbsp;&nbsp;&nbsp;
<?
	if($click=='add')
	{	?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon">
	<img src="../../icons/application_add.png" alt=" ���������� " class="images_icon" >
	</span>&nbsp;���������ŻѨ��¾�鹰ҹ ʡ�.
	<? }
	else
	{ ?>
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon">
		<img src="../../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
		</span>&nbsp;��䢢����ŻѨ��¾�鹰ҹ ʡ�.
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

<table width="700" align="center" class="gridtable" style="margin:10 15 10 15 px;">
	<tr height='25px' class='rows_green'>
		<td colspan="6"align="left">&nbsp;<b>�����ŻѨ��¾�鹰ҹ ʡ�. </b></td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="120"> ��͹ </td>
		<td align="center" width="100">  ʡ�. �Ң�</td>
		<td align="center" width="120">  �١��� ���. ������ </td>
		<td align="center" width="120">  ��Ҫԡ ʡ�. ������ </td>
		<td align="center" width="100"> ��ҹ������� </td>
		<td align="center" width="120"> ��Ҫԡ�Ӹ�áԨ <br>������������� </td>
	</tr>
<?
	$temp_month = array("4","5","6","7","8","9","10","11","12","1","2","3");
	$temp_name = array("����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�","���Ҥ�","����Ҿѹ��","�չҤ�");
	// �ó�����������¡������������ʴ�
	if($click=='edit')
	{
		$sql = " SELECT skt_year, skt_month , skt_branch, skt_member, skt_baac, skt_shop, skt_share ";
		$sql.=" FROM AnnSkt  WHERE skt_year='".$year."' ";
		$sql.=" ORDER BY skt_month_list ";
		$result_skt = query($sql);
		$i = 0;
		WHILE($fetch_skt = fetch_row($result_skt)) {
	?>
		<tr>
			<td align="center"><input type="text" size="10"  value="<?=$temp_name[$i]?>" class="txt_system" readonly></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='1x<?=$temp_month[$i]?>' name='1x<?=$temp_month[$i]?>' value="<?=number_format($fetch_skt[2],0,'','')?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='2x<?=$temp_month[$i]?>' name='2x<?=$temp_month[$i]?>' value="<?=number_format($fetch_skt[3],0,'','')?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='3x<?=$temp_month[$i]?>' name='3x<?=$temp_month[$i]?>' value="<?=number_format($fetch_skt[4],0,'','')?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='4x<?=$temp_month[$i]?>' name='4x<?=$temp_month[$i]?>' value="<?=number_format($fetch_skt[5],0,'','')?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='5x<?=$temp_month[$i]?>' name='5x<?=$temp_month[$i]?>' value="<?=number_format($fetch_skt[6],0,'','')?>" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		</tr>
	<?
		$i++;
		} // end while 
	}  // end if edit 
	if($click=='add')
	{
		for($i=0;$i<12;$i++)
		{  ?>
		<tr>
			<td align="center"><input type="text" size="10"  value="<?=$temp_name[$i]?>" class="txt_system" readonly></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='1x<?=$temp_month[$i]?>' name='1x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='2x<?=$temp_month[$i]?>' name='2x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='3x<?=$temp_month[$i]?>' name='3x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='4x<?=$temp_month[$i]?>' name='4x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
			<td align="center"><input type="text" size="9" maxlength="9" id='5x<?=$temp_month[$i]?>' name='5x<?=$temp_month[$i]?>' value="0" class="txt_num" onKeyPress="return isNumberKey(this);"></td>
		</tr>
	<?	}  // end for 
	}  // end if add
?>
</table>
<center>
<input name="click" type="hidden" value="<?=$click; ?>">
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