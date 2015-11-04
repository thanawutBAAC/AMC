<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	// �ʴ������żż�Ե����Ǻ���������
	$sql =" SELECT  BaseProduct.pro_code, BaseProduct.pro_name, ";
	$sql.=" BaseMainProduct.main_pro_name, BaseSubProduct.sub_pro_name, BaseProduct.pro_unit ";
	$sql.=" FROM    BaseProduct,BaseSubProduct,BaseMainProduct ";
	$sql.=" WHERE  BaseProduct.sub_pro_code = BaseSubProduct.sub_pro_code AND ";
	$sql.=" BaseSubProduct.main_pro_code = BaseMainProduct.main_pro_code ";
	$sql.=" ORDER BY BaseMainProduct.main_pro_code, BaseSubProduct.sub_pro_code ";
	$result_product = query($sql);
	$new_row = num_rows($result_product);

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
<div style="margin-top:25px; margin-left:43px; margin-bottom: 5px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;<a href="base_product_detail.php?click=add&new_row=<?=$new_row; ?>" alt=" ���������� ">����������</a>
</div>
	<table  width="660" align="center" class="gridtable" >
		<tr><td colspan="6"><font color="#0F7FAF"><center><b> ��������������´�ż�Ե </b></center></font></td></tr>
		<tr class="rows_pink">
				<td align="center" width="120"> ������ż�Ե��ѡ </td>
				<td align="center" width="120"> �ż�Ե��ѡ </td>
				<td align="center" width="80"> ���� </td>
				<td align="center" width="150"> ������������´�ż�Ե </td>
				<td align="center" width="90"> ˹��¹Ѻ </td>
				<td align="center" width="100"> Action </td>
		</tr>
		<?php
			$i=0;
			$temp_main1 = "";
			$temp_main2 = "";
			$temp_sub1 = "";
			$temp_sub2 = "";
			WHILE($result_fetch  = fetch_row($result_product))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
				if($temp_main1==trim($result_fetch[2]))
					{	$temp_main2 = "";	 }
				else
					{	$temp_main1 = trim($result_fetch[2]);
						$temp_main2 = trim($result_fetch[2]); }
				if($temp_sub1==trim($result_fetch[3]))
					{	$temp_sub2 = "";	 }
				else
					{	$temp_sub1 = trim($result_fetch[3]);
						$temp_sub2 = trim($result_fetch[3]); }
			?>
				<td align="left">&nbsp;<?=$temp_main2; ?></td>
				<td align="left">&nbsp;<?=$temp_sub2; ?></td>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="left">&nbsp;<?=trim($result_fetch[1]); ?></td>
				<td align="center"><?=trim($result_fetch[4]); ?></td>
				<td align="center">
				<a href="base_product_detail.php?click=edit&code=<?=$result_fetch[0];?>&name=<?=trim($result_fetch[1]); ?>&unit=<?=trim($result_fetch[4]);?>" target="right" alt=" ��䢢����� " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" ��䢢����� ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" ��䢢����� ">
				</span></a>&nbsp;
				<a href="base_product_sql.php?click=del&code=<?=$result_fetch[0]; ?>" target="right" alt="ź������" style='cursor: hand' onclick=" return confirm_delete('<?=$result_fetch[1];?>') " >
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
<div style="margin-left:auto; margin-right:auto; text-align: center; margin-top:8px;">
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
	free_result($result_product);
	close();
	include("footer.php")
?>