<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$sql=" SELECT  report_group_code, report_group_name, report_group_type, report_group_comment ";
	$sql.=" FROM  BaseReportGroup ORDER BY report_group_code ";
	$result_report_group = query($sql);
	$new_row = num_rows($result_report_group);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body >
<?php
	include("../manu_bar.php");
?>
	<table width="520" align="center" class="gridtable" style="margin-top:25px;">
		<tr><td colspan="3"><font color="#0F7FAF"><center><b> ��������Ǣ����§ҹ�� </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="70"> ���� </td>
			<td align="center" width="350"> ������Ǣ����§ҹ </td>
			<td align="center" width="100"> Action </td>
		</tr>
		<?php
			$i=0;
			WHILE($result_fetch  = fetch_row($result_report_group))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
			?>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="left">&nbsp;<?=trim($result_fetch[1]); ?></td>
				<td align="center">
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_lightning.png');" class="span_icon">
				<img src="../icons/application_lightning.png"  class="images_icon" alt="<?=trim($result_fetch[3]);?>">
				</span>&nbsp;
				<a href="base_report_group_detail.php?click=edit&code=<?=$result_fetch[0]; ?>&name=<?=trim($result_fetch[1]); ?>&type=<?=$result_fetch[2]; ?>&comment=<?=trim($result_fetch[3]); ?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
				<img src="../icons/application_edit.png"  class="images_icon" alt=" ��䢢����� ">
				</span></a>
				</td>
		</tr>
		<?php
			} // end while
		?>
		</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_lightning.png');" class="span_icon">
<img src="../icons/application_lightning.png" alt=" ��������´�����˵�" class="images_icon" >
</span>&nbsp;��������´�����˵�&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
</span>&nbsp;��䢢�����
</div>
</body>
</html>
<?php
	free_result($result_report_group);
	close();
	include("footer.php")
?>