<?php session_start();
	include("../../check_login.php");
	include("../../lib/config.inc.php");
	include("../../lib/database.php");
	connect();

	// �ʴ������Ż� ��鹰ҹ�ͧ������ ʡ�. ������ 
	$sql = " SELECT distinct skt_year ";
	$sql.=" FROM AnnSkt  ORDER BY skt_year ";
	$result_skt = query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
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
<div style="margin-left:auto; margin-right:auto;  text-align: center "><strong> �����ŻѨ��¾�鹰ҹ�ͧ ʡ�. </strong></div>
<div style="margin: 15 0 0 223; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_add.png');" class="span_icon"> 
<img src="../../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;<a href="skt_detail.php?click=add" alt=" ���������� ">����������</a>
</div>
<table width="300" align="center"  class="gridtable" style="margin-top:5px;">
	<tr class='rows_green'><td colspan="3"><center><b> ��������´������ </b></center></td></tr>
	<tr class="rows_pink">
		<td align="center" width="80"> �ӴѺ��� </td>
		<td align="center" width="100"> �� </td>
		<td align="center" width="120"> Action </td>
	</tr>
	<?
		$i = 0;
		WHILE($fetch_skt = fetch_row($result_skt)) {
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>";
	?>
			<td align="center"><?=$i;?></td>
			<td align="center"><?=$fetch_skt[0]; ?></td>
			<td align="center">
				<a href="skt_detail.php?click=edit&year=<?=$fetch_skt[0]; ?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
				<img src="../../icons/application_delete.png"  class="images_icon" alt=" ��䢢����� ">
				</span></a>&nbsp;
				<a href="skt_sql.php?click=del&year=<?=$fetch_skt[0]; ?>" target="right" alt="ź������" style='cursor: hand' onclick=" return confirm_delete('<?=$fetch_skt[0];?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_delete.png');" class="span_icon" alt=" ź������ " >
				<img src="../../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
			</td>
		</tr>
	<?
		}
	?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_edit.png');" class="span_icon">
<img src="../../icons/application_edit.png" alt=" ��䢻Ѩ��¾�鹰ҹ  ʡ�." class="images_icon" >
</span>&nbsp;��䢻Ѩ��¾�鹰ҹ ʡ�.&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../../icons/application_delete.png');" class="span_icon">
<img src="../../icons/application_delete.png" alt=" ź�Ѩ��¾�鹰ҹ ʡ�." class="images_icon" >
</span>&nbsp;ź�Ѩ��¾�鹰ҹ ʡ�.
</div>
</body>
</html>
<?
	free_result($result_skt);
	close();
	include("../footer.php")
?>