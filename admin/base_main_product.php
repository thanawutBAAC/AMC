<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	// �ʴ������š�����ż�Ե�ҧ����ɵ÷�����
	$sql=" SELECT main_pro_code, main_pro_name FROM BaseMainProduct ";
	$result_main_product = query($sql);
	$new_row = num_rows($result_main_product);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
	<script language="JavaScript">
		function confirm_delete(str_name)
		{
			if (confirm(" ��س��׹�ѹ���ź������ "+str_name)) {
				return true;
			}
			else
			{
				return false;
			}
		}
	</script>
</head>
<body >
<?php
	include("../manu_bar.php");
?>
<div style="margin: 25 0 0 223; ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;<a href="base_main_product_detail.php?click=add&new_row=<?=$new_row; ?>" alt=" ���������� ">����������</a>
</div>
		<table width="300" align="center" class="gridtable" style="margin-top:5px;">
		<tr><td colspan="3"><font color="#0F7FAF"><center><b> �����š�����ż�Ե��ѡ </b></center></font></td></tr>
		<tr class="rows_pink">
				<td align="center" width="70"> ���� </td>
				<td align="center" width="130"> ���͡�����ż�Ե </td>
				<td align="center" width="100"> Action </td>
		</tr>
		<?php
			$i=0;
			WHILE($result_fetch  = fetch_row($result_main_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
			?>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="left">&nbsp;<?=$result_fetch[1]; ?></td>
				<td align="center">
				<a href="base_main_product_detail.php?click=edit&code=<?=$result_fetch[0]; ?>&name=<?=$result_fetch[1]; ?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" ��䢢����� ">
				</span></a>&nbsp;
				<a href="base_main_product_sql.php?click=del&code=<?=$result_fetch[0]; ?>" target="right" alt="ź������" style='cursor: hand' onclick=" return confirm_delete('<?=$result_fetch[1];?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon" alt=" ź������ " >
				<img src="../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
				</td>
		</tr>
		<?php
			} // end while
		?>
		</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
</span>&nbsp;��䢢�����&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ź������ " class="images_icon" >
</span>&nbsp;ź������
</div>
</body>
</html>
<?php
	free_result($result_main_product);
	close();
	include("footer.php")
?>