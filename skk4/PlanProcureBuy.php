<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

	// �ʴ������Żպѭ�շ����������
	$sql = " SELECT PlanProcureBuy_year FROM PlanProcureBuy ";
	$sql.=" WHERE amccode='".$code_online."' ";
	$sql.=" GROUP BY PlanProcureBuy_year ";
	$sql.=" ORDER BY PlanProcureBuy_year ";
	$result_plan = query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">
		function confirm_delete(str_name)
		{
			if (confirm(" ��س��׹�ѹ���ź������ �� "+str_name)) {
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
<div style="margin-left:auto; margin-right:auto;  text-align: center "> ��������´Ἱ��èѴ���Թ����Ҩ�˹��¢ͧ ʡ�. <font color='red'>(�ʹ����)</font>  Ἱ ʡ.��4 </div>
<div style="margin: 15 0 0 223; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;<a href="PlanProcureBuy_detail.php?click=add" alt=" ���������� ">����������</a>
</div>
<table width="300" align="center"  class="gridtable" style="margin-top:5px;">
	<tr><td colspan="3"><font color="#0F7FAF"><center><b> ��������´������ </b></center></font></td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> �ӴѺ��� </td>
		<td align="center" width="100"> �պѭ�� </td>
		<td align="center" width="120"> Action </td>
	</tr>
	<?
		$i = 0;
		WHILE($fetch_plan = fetch_row($result_plan)) {
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
	?>
			<td align="center"><?=$i;?></td>
			<td align="center"><?=$fetch_plan[0]; ?></td>
			<td align="center">
				<a href="PlanProcureBuy_detail.php?click=edit&year=<?=$fetch_plan[0]; ?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" ��䢢����� ">
				</span></a>&nbsp;
				<a href="PlanProcureBuy_sql.php?click=del&year=<?=$fetch_plan[0]; ?>" target="right" alt="ź������" style='cursor: hand' onclick=" return confirm_delete('<?=$fetch_plan[0];?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon" alt=" ź������ " >
				<img src="../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
			</td>
		</tr>
	<?
		}
	?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ���Ἱ���Թ�ҹ " class="images_icon" >
</span>&nbsp;���Ἱ&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon">
<img src="../icons/application_delete.png" alt=" źἹ���Թ�ҹ " class="images_icon" >
</span>&nbsp;źἹ
</div>
</body>
</html>
<?
	free_result($result_plan);
	close();
	include("../footer.php")
?>