<?php session_start();
include("../check_login.php");
include("../lib/config.inc.php");
include("../lib/database.php");
	connect();
	$sql = " SELECT  report_group_name  FROM BaseReportGroup ";
	$sql.=" WHERE report_group_code<>'7' ";
	$result_report_group = query($sql);
?>
<html>
<head>
	<title></title>
	<link href="../css/main.css" rel="stylesheet" type="text/css"/>
	<script language="JavaScript">
		function confirm_submit()
		{
			if (confirm(" กรุณายืนยันการบันทึกข้อมูล ")) {
				return true;
			}
			else{
				return false;
			} // end if 
		}  // end function
	</script>
</head>
<body>
<? include("../manu_bar.php"); ?>
	<center>หน้าจอเลือกรายการที่ต้องการให้ ปรากฎที่หน้าจอ ส่งรายงานผลการดำเนินงานของท่าน  เลือกได้โดยการกดปุ่มด้านหลังข้อความ</center>
	<form name="frm_report" action="config_report_sql.php" method="post" Onsubmit=" return confirm_submit(); ">
	<table width="600" align="center" class="gridtable" style="margin-top:5px">
	<?
		$i = 0;
		WHILE($result_fetch = fetch_row($result_report_group))
		{ $i++;  
			if($i==7){
				$i++;
			} // end if 
	?>
		<tr height="25" bgcolor="#59A7C8">
			<td align="left" colspan="2">
			&nbsp;<font color="#FFFFFF"><strong><?=$i;?>&nbsp;<?=$result_fetch[0];?></strong></font>
			</td>
		</tr>
		<tr class="rows_pink" height="23">
			<td align="center" width="500">
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_view_list.png');" class="span_icon">
			<img src="../icons/application_view_list.png" alt=" รายการ " class="images_icon" >
			</span>&nbsp;<strong>รายการ</strong>
			</td>
			<td align="center" width="100">
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/accept.png');" class="span_icon">
			<img src="../icons/accept.png" alt=" เลือก " class="images_icon" >
			</span>&nbsp;<strong>เลือก</strong>
			</td>
		</tr>
		<!-- **************   รายละเอียดรายงาน   ************ -->
		<?  
			$j = 0;
			$sql = " SELECT  ";
			$sql.= " BaseReportDetail.report_group_code,  ";
			$sql.= " BaseReportDetail.report_detail_code,  ";
			$sql.= " BaseReportDetail.report_detail_name,  ";
			$sql.= " Temp01.bb ";
 			$sql.= " FROM BaseReportDetail  ";
			$sql.= "	LEFT JOIN (  ";
			$sql.= "	SELECT report_group_code AS aa, report_detail_code AS bb   ";
			$sql.= "	FROM BaseReportHeader  ";
			$sql.= "	WHERE amccode='".$code_online."'  ";
			$sql.= "	)AS Temp01 ON Temp01.aa = BaseReportDetail.report_group_code AND  ";
			$sql.= "	Temp01.bb = BaseReportDetail.report_detail_code  ";
			$sql.= " WHERE BaseReportDetail.report_group_code='".$i."'  ";
			//$sql.= " ORDER BY  cast(BaseReportDetail.report_detail_code AS int) ";
			if($i==8){
				$sql.=" ORDER BY BaseReportDetail.report_detail_code ";   // ในกรณีที่เป็นธุรกิจแปรรูป 
			}else{
				$sql.=" ORDER BY BaseReportDetail.report_detail_name ";  // นอกจากธุรกิจแปรรูป
			} // end if 
			$result_report_detail = query($sql);
			WHILE( $fetch_detail = fetch_row($result_report_detail))
			{ 	$j++;
				if(($j%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
		?>
				<td align="left">&nbsp;<?=trim($fetch_detail[2]); ?></td>
				<td align="center"><input type="checkbox" name="chk<?=trim($fetch_detail[0]).trim($fetch_detail[1]); ?>" <? if(!is_null($fetch_detail[3])) echo "checked"; ?> value="1"></td>
			</tr>
		<?  }  // end while ?>
		<tr height="15px"><td colspan="2"></td></tr>
		<!-- *********************************************** -->
	<?  } // end while ?>
	</table>
	<br>
	<center><input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก "></center>
	</form>
</body>
</html>
<?php
	free_result($result_report_detail);
	free_result($result_report_group);
	close();
	include("../footer.php")
?>