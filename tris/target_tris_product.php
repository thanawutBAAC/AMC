<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
	include("../manu_bar.php");
?>
<!-- *************************************************************************** -->
<form name="" action="target_tris_product.php" method="post">
<center>
<!--  �ʴ������Ż� -->
���͡�����Żպѭ��
<? $temp_year =  date("Y")+525; ?>
<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>" <? if($temp_year==date("Y")+543) echo "selected"; ?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>	&nbsp;&nbsp;
���͡���¡Ԩ����Ң�
<select name="br_code">
	<option value="all" selected> �ء���� </option>
	<option value="1"> ���¡Ԩ����Ң� 1</option>
	<option value="2"> ���¡Ԩ����Ң� 2</option>
	<option value="3"> ���¡Ԩ����Ң� 3</option>
	<option value="4"> ���¡Ԩ����Ң� 4</option>
	<option value="5"> ���¡Ԩ����Ң� 5</option>
	<option value="6"> ���¡Ԩ����Ң� 6</option>
	<option value="7"> ���¡Ԩ����Ң� 7</option>
	<option value="8"> ���¡Ԩ����Ң� 8</option>
	<option value="9"> ���¡Ԩ����Ң� 9</option>
</select>
<input type="hidden" name="click" value="1">
<input type="submit" value=" ���Ң����� ">
</center>
</form>
<!-- ************************************************************************* -->
<? if(isset($click)) { 
	$year = $_POST["year"];
	connect();
	//  �ʴ��������Թ��ҷ�������� ੾����¡�������͡������¡�÷�� 3 
	$sql = " SELECT BaseReportDetail.report_detail_code,BaseReportDetail.report_detail_name, ";
	$sql.=" BaseReportDetail.report_detail_unit ";
	$sql.=" FROM BaseReportDetail ,TargetProduct ";
	$sql.=" WHERE (BaseReportDetail.report_group_code='3' OR BaseReportDetail.report_group_code='8') ";
	$sql.=" AND TargetProduct.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code ";
	$result_report = query($sql);
?>
<table width="330" align="center" class="gridtable" style="margin-top:5px;">
	<tr height="25"><td colspan="3">
	<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> �����š�˹�������� Tris ��¼ż�Ե 
	<? if($br_code=='all'){ 
			echo " [�ء����]";
		}else{
			echo " [���� :".$br_code."]";
		} ?>
	</b></center></font>
	</td></tr>
	<tr class="rows_pink">
		<td align="center" width="70"> �ӴѺ��� </td>
		<td align="center" width="180"> ���ͼż�Ե </td>
		<td align="center" width="80"> ˹��¹Ѻ </td>
	</tr>
<?php
	$i=0;
	WHILE($result_fetch = fetch_row($result_report))
	{
		$i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
		?>
		<td align="center"><?=$i; ?></td>
		<td align="left">&nbsp;<a href="target_tris_product_detail.php?report_detail_code=<?=trim($result_fetch[0]); ?>&year=<?=$year; ?>&br_code=<?=$br_code; ?>&report_detail_name=<?=trim($result_fetch[1]); ?>&temp_count=<?=trim($result_fetch[2]) ?>"><?=trim($result_fetch[1]); ?></a></td>
		<td align="center"><?=trim($result_fetch[2]); ?></td>
	</tr>
<?php
		}  // end while
 ?>
</table>
</body>
</html>
<?php
	free_result($result_report);
	close();
	} // end if
	include("../footer.php")
?>