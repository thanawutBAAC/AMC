<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	// �ʴ���������ª��ͼż�Ե��ѡ������
	$sql=" SELECT BaseSubProduct.sub_pro_code, BaseSubProduct.sub_pro_name, ";
	$sql.=" BaseMainProduct.main_pro_code, BaseMainProduct.main_pro_name ";
	$sql.=" FROM  BaseSubProduct,BaseMainProduct ";
	$sql.=" WHERE BaseSubProduct.main_pro_code = BaseMainProduct.main_pro_code ";
	$sql.=" ORDER BY BaseSubProduct.main_pro_code, BaseSubProduct.sub_pro_code ";

	$result_sub_product = query($sql);
	$new_row = num_rows($result_sub_product);
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
<div style="margin-top:25; margin-left:138; margin-bottom:5px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;<a href="base_sub_product_detail.php?click=add&new_row=<?=$new_row; ?>" alt=" ���������� ">����������</a>
</div>
		<table  width="470" align="center" class="gridtable">
		<tr><td colspan="4"><font color="#0F7FAF"><center><b> �����żż�Ե��ѡ </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="100"> ������ż�Ե��ѡ </td>
			<td align="center" width="100"> ���ʼż�Ե��ѡ </td>
			<td align="center" width="170"> ���ͼż�Ե��ѡ </td>
			<td align="center" width="100"> Action </td>
		</tr>
		<?php
			$i=0;
			$temp_name1 = "";
			$temp_name2 = "";
			WHILE($result_fetch  = fetch_row($result_sub_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
				if($temp_name1==trim($result_fetch[3]))
				{		$temp_name2 = "";		}
				else
				{		$temp_name1 = trim($result_fetch[3]);
						$temp_name2 = trim($result_fetch[3]);	 }
			?>
				<td align="center"><?=trim($temp_name2); ?></td>
				<td align="center"><?=trim($result_fetch[0]); ?></td>
				<td align="left">&nbsp;<?=trim($result_fetch[1]); ?></td>
				<td align="center">
				<a href="base_sub_product_detail.php?click=edit&code=<?=trim($result_fetch[0]); ?>&name=<?=trim($result_fetch[1]); ?>&main_code=<?=trim($result_fetch[2]); ?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" ��䢢����� ">
				</span></a>&nbsp;
				<a href="base_sub_product_sql.php?click=del&code=<?=trim($result_fetch[0]); ?>" target="right" alt="ź������" style='cursor: hand' onclick=" return confirm_delete('<?=trim($result_fetch[1]);?>') " >
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
	free_result($result_sub_product);
	close();
	include("footer.php")
?>