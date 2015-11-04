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
<?
	include("../manu_bar.php");
?>
<!-- *********************************************************************** -->
<form name="" action="check_report.php" method="post">
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center; "> รายละเอียดการส่งข้อมูลรายงาน สกก.4  ปีบัญชี  
<?  $temp_year =  date("Y")+525; ?>
	<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>" 
	<? if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
			{
				if($temp_year==date("Y")+542){
					echo "selected";
				}
			}
			else{
				if($temp_year==date("Y")+543){
						echo "selected";
				}
			}  // end date ?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>&nbsp;&nbsp;
<input type="submit" value="  แสดงข้อมูล ">
</div>
<input type="hidden" name="click" >
</form>
<!-- ********************************************************************************************** -->
<?
	if(isset($click))
	{
		connect();	
		$sql=" SELECT userlogin.br_code, AMC.AMCName, ";
		$sql.=" Temp01.amccode,Temp02.amccode ";
		$sql.=" ,Temp03.amccode,Temp04.amccode ";
		$sql.=" ,Temp05.amccode,Temp06.amccode ";
		$sql.=" ,Temp07.amccode, Temp08.amccode ";
		$sql.=" ,Temp09.amccode,Temp10.amccode, AMC.amccode ";
		$sql.="";
		$sql.=" FROM   userlogin,AMC ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanMaster WHERE Plan_year='".$year."' ";
		$sql.=" )AS Temp01 ON Temp01.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanMember WHERE PlanMember_year='".$year."' ";
		$sql.=" )AS Temp02 ON Temp02.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanProcureBuy WHERE PlanProcureBuy_year='".$year."' ";
		$sql.="  GROUP BY amccode "; 
		$sql.=" )AS Temp03 ON Temp03.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanProcureSell WHERE PlanProcureSell_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp04 ON Temp04.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanCollectBuy WHERE PlanCollectBuy_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp05 ON Temp05.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanCollectSell WHERE PlanCollectSell_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp06 ON Temp06.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanService WHERE PlanService_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp07 ON Temp07.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanExpenses WHERE PlanExpenses_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp08 ON Temp08.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanTransBuy WHERE PlanTransBuy_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp09 ON Temp09.amccode = AMC.amccode ";
		$sql.=" LEFT JOIN( ";
		$sql.="  SELECT amccode FROM PlanTransSell WHERE PlanTransSell_year='".$year."' ";
		$sql.="  GROUP BY amccode ";
		$sql.=" )AS Temp10 ON Temp10.amccode = AMC.amccode ";
		$sql.=" WHERE  userlogin.AMCCode = AMC.AMCCode ";
		$sql.=" ORDER BY userlogin.br_code, AMC.amcprovince ";

?>
<table  width="820" align="center" class="gridtable" style="margin-top:10px;">
<tr height="30"><td colspan="13">
<center>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
	<img src="../icons/report.png" alt=" รายงานข้อมูล " class="images_icon" > 
	</span>&nbsp;<font color="#0F7FAF"><b> รายงานการส่งข้อมูล สกก.4  ปีบัญชี <font color='red'><u><?=$year; ?></u></font></b></center></font>
</td></tr>
<tr class="rows_pink"> 
	<td rowspan="2" valign="middle" align="center" width="20">ฝ่าย</td>
	<td rowspan="2" valign="middle" align="center" width="160"> สกต. </td>
	<td rowspan="2" valign="middle" align="center" width="70"> สรุปแผน </td>
	<td rowspan="2" valign="middle" align="center" width="70"> แผนสมาชิก </td>
	<td colspan="2" width="130" align="center"> แผนจัดหาสินค้า </td>
	<td colspan="2" width="130" align="center"> แผนรวบรวมผลผลิต </td>
	<td rowspan="2" valign="middle" align="center" width="70"> แผนบริการ </td>
	<td rowspan="2" valign="middle" align="center" width="70"> แผนใช้จ่าย </td>
	<td colspan="2" width="130" align="center"> แผนการแปรรูปผลผลิต </td>
</tr>
<tr class="rows_pink"> 
	<td align="center" width="65"> ยอดซื้อ </td>
	<td align="center" width="65"> ยอดขาย </td>
	<td align="center" width="65"> ยอดซื้อ </td>
	<td align="center" width="65"> ยอดขาย </td>
	<td align="center" width="65"> ยอดซื้อ </td>
	<td align="center" width="65"> ยอดขาย </td>
</tr>
<? $result_report =  query($sql);
	$i=0;
	WHILE( $fetch_report = fetch_row($result_report))
	{  $i++;
		if(($i%2)==0)
			echo "<tr class='rows_grey'>";
		else
			echo "<tr>";
	?>
		<td align="center"><?=trim($fetch_report[0]) ?></td>
		<td align="left">&nbsp;<a href="report_detail.php?temp_amccode=<?=trim($fetch_report[12])?>&temp_name=<?=trim($fetch_report[1])?>"  ><?="สกต.".trim($fetch_report[1])?></a></td>
		<td align="center">
		<?	if(is_null($fetch_report[2])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[3])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[4])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[5])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[6])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[7])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[8])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[9])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[10])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
		<td align="center">
		<?	if(is_null($fetch_report[11])) { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
			<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
			</span>
		<?   } else { ?>
			<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
			<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
			</span>
		<?  } // end if ?>
		</td>
	</tr>
<? }  // end while ?>
</table>
<div style="margin-left:auto; margin-right:auto; text-align: center;  margin-top:8px;">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/tick.png');" class="span_icon">
<img src="../icons/tick.png" alt=" ดำเนินการส่งข้อมูลแล้ว " class="images_icon" >
</span>&nbsp;ส่งข้อมูล&nbsp;&nbsp;
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/cross.png');" class="span_icon">
<img src="../icons/cross.png" alt=" ยังไม่มีการส่งข้อมูลให้ระบบ " class="images_icon" >
</span>&nbsp;ไม่มีข้อมูล
</div>
<?
	free_result($result_report);
	close();
	} // end if ?>
</body>
</html>
<?php
	include("../footer.php")
?>