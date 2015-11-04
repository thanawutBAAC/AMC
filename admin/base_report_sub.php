<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$sql=" SELECT  report_group_code, report_detail_code, report_detail_name, report_detail_unit  FROM BaseReportDetail ";
	$sql.=" WHERE report_group_code<>'7' ";
	$sql.=" ORDER BY report_group_code, report_detail_code ";
	$result_report_sub = query($sql);
	$new_row = num_rows($result_report_sub);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript">
	function confirm_delete(str_name)
	{
		if (confirm(" กรุณายืนยันการลบข้อมูล "+str_name)) {
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
<div style="margin-top:25px; margin-left:38px; margin-bottom: 5px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;<a href="base_report_sub_detail.php?click=add&new_row=<?=$new_row; ?>" alt=" เพิ่มข้อมูล ">เพิ่มข้อมูล</a>
</div>
	<table  width="670" align="center" class="gridtable">
		<tr><td colspan="5"><font color="#0F7FAF"><center><b> ข้อมูลรายงานประจำเดือน </b></center></font></td></tr>
		<tr class="rows_pink">
			<td align="center" width="70"> หัวข้อ </td>
			<td align="center" width="70"> รหัส </td>
			<td align="center" width="350"> รายละเอียด </td>
			<td align="center" width="80"> หน่วยนับ </td>
			<td align="center" width="100">	Action </td>
		</tr>
		<?php
			$i=0;
			$temp_close1 = "";
			$temp_close2 = "";
			WHILE($result_fetch  = fetch_row($result_report_sub))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
				if(trim($temp_close1)==$result_fetch[0])
				{		$temp_close2="";	}
				else
				{		$temp_close1 = $result_fetch[0];
						$temp_close2 = "ข้อที่ ".$result_fetch[0];	}
			?>
				<td align="center"><font color="#0F7FAF"><?=$temp_close2; ?></font></td>
				<td align="center"><?=trim($result_fetch[1]); ?></td>
				<td align="left">&nbsp;<?=trim($result_fetch[2]); ?></td>
				<td align="center"><?=trim($result_fetch[3]); ?></td>
				<td align="center">
				<? if(trim($result_fetch[0])!='3') { ?>
				<a href="base_report_sub_detail.php?click=edit&group=<?=$result_fetch[0]; ?>&code=<?=$result_fetch[1]; ?>&name=<?=trim($result_fetch[2]); ?>&unit=<?=$result_fetch[3];?>" target="right" alt=" แก้ไขข้อมูล " style='cursor: hand'>
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon" alt=" แก้ไขข้อมูล ">
				<img src="../icons/application_delete.png"  class="images_icon" alt=" แก้ไขข้อมูล ">
				</span></a>&nbsp;
				<a href="base_report_sub_sql.php?click=del&group=<?=$result_fetch[0]; ?>&code=<?=$result_fetch[1]; ?>" target="right" alt="ลบข้อมูล" style='cursor: hand' onclick=" return confirm_delete('<?=trim($result_fetch[2]);?>') " >
				<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon" alt=" ลบข้อมูล " >
				<img src="../icons/application_delete.png" class="images_icon" >
				</span>
				</a>
				<? } // end if 3 ?>
				</td>
		</tr>
		<?php
			} // end while
		?>
		</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
</span>&nbsp;แก้ไขข้อมูล&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_delete.png');" class="span_icon">
<img src="../icons/application_edit.png" alt=" ลบข้อมูล " class="images_icon" >
</span>&nbsp;ลบข้อมูล
</div>
</body>
</html>
<?php
	free_result($result_report_sub);
	close();
	include("footer.php")
?>