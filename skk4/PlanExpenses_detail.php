<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

// แสดงข้อมูลหมวดที่ 7 ของสกต ที่เลือกทั้งหมด
$sql ="	SELECT BaseReportDetail.report_detail_code,  ";
$sql.=" BaseReportDetail.report_detail_name, ";
$sql.=" Temp01.PlanExpenses_Apr, ";
$sql.=" Temp01.PlanExpenses_May, Temp01.PlanExpenses_Jun,  ";
$sql.=" Temp01.PlanExpenses_Jul, Temp01.PlanExpenses_Aug,  ";
$sql.=" Temp01.PlanExpenses_Sep, Temp01.PlanExpenses_Oct,  ";
$sql.=" Temp01.PlanExpenses_Nov, Temp01.PlanExpenses_Dec,  ";
$sql.=" Temp01.PlanExpenses_Jan, Temp01.PlanExpenses_Feb,  ";
$sql.=" Temp01.PlanExpenses_Mar, Temp01.PlanExpenses_Sum  ";
$sql.=" FROM BaseReportDetail  ";
$sql.=" LEFT JOIN (  ";
$sql.="	SELECT  PlanExpenses_Apr, ";
$sql.="	PlanExpenses_May, PlanExpenses_Jun,  ";
$sql.="	PlanExpenses_Jul, PlanExpenses_Aug,  ";
$sql.="	PlanExpenses_Sep, PlanExpenses_Oct,  ";
$sql.="	PlanExpenses_Nov, PlanExpenses_Dec,  ";
$sql.="	PlanExpenses_Jan, PlanExpenses_Feb,  ";
$sql.="	PlanExpenses_Mar, PlanExpenses_Sum,  ";
$sql.="	report_detail_code, amccode, PlanExpenses_year  ";
$sql.="	FROM PlanExpenses  ";
$sql.="	WHERE amccode='".$code_online."' AND ";
if($click=='add')
{	$sql.=" PlanExpenses_year='9999'  "; }
elseif($click=='edit')
{	$sql.=" PlanExpenses_year='".$year."'  "; }
$sql.=") AS Temp01  "; 
$sql.=" ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
if($click=='add')
{	$sql.=" AND Temp01.PlanExpenses_year = '9999'  "; }
elseif($click=='edit')
{	$sql.=" AND Temp01.PlanExpenses_year = '".$year."'  "; }
$sql.=" WHERE BaseReportDetail.report_group_code='7'   ";
$sql.=" ORDER BY CAST(BaseReportDetail.report_detail_code AS INT) ";
$result_plan =	query($sql);

	WHILE($fetch_id = fetch_row($result_plan)) {
			$product_id =	$product_id.trim($fetch_id[0])."#";
	}
	$product_id = substr($product_id,0,strlen($product_id)-1);	  // จะได้รหัสสินค้าที่ต้องการมาทั้งหมด แล้วคั่นด้วย # 

if(num_rows($result_plan)>0)
	data_seek($result_plan);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">
// หาข้อมูลเพื่อตั้งชื่อตัวแปรก่อน
	var Data = "<?=$product_id?>";
	var Array_Max;
	var Array_Temp;
	Array_Temp=Data.split("#");
	Array_Max=Array_Temp.length;

	alert(' ข้อมูลค่าใช้จ่ายได้ถูกปรับปรุงเป็น : หน่วยพันบาท ');
//  แสดงผลรวมทั้งหมดในด้าน colums
	function update_cols(cols)
	{
		var temp_02 = 0;
		for(i=0;i<Array_Max;i++){
			temp_02 = temp_02 + parseInt(document.getElementById(Array_Temp[i]+'x'+cols).value);
		} // end for
		var sum = document.getElementById("sum"+cols);
		sum.value = temp_02;
	} // end function

// แสดงผลรวมทั้งหมดในด้าน rows
	function update_rows(rows)
	{
		var t1 = document.getElementById(rows+"x1");
		var t2 = document.getElementById(rows+"x2");
		var t3 = document.getElementById(rows+"x3");
		var t4 = document.getElementById(rows+"x4");
		var t5 = document.getElementById(rows+"x5");
		var t6 = document.getElementById(rows+"x6");
		var t7 = document.getElementById(rows+"x7");
		var t8 = document.getElementById(rows+"x8");
		var t9 = document.getElementById(rows+"x9");
		var t10 = document.getElementById(rows+"x10");
		var t11 = document.getElementById(rows+"x11");
		var t12 = document.getElementById(rows+"x12");
		var t13 = document.getElementById(rows+"x13");

		t13.value =parseInt(t1.value)+parseInt(t2.value)+parseInt(t3.value)+parseInt(t4.value)+parseInt(t5.value)+parseInt(t6.value)+parseInt(t7.value)+parseInt(t8.value)+parseInt(t9.value)+parseInt(t10.value)+parseInt(t11.value)+parseInt(t12.value);
	} // end function

// ส่งค่าที่ได้มาที่ function นี้ เพราะนำข้อมูลไปปรับปรุงแต่ละด้าน
	function update_data(x,y)
	{
		update_rows(x);
		update_cols(y);
		update_cols(13);
	} // end function

// ยืนยันก่อนปรับปรุงข้อมูล		
	function check_submit()
	{
		var temp_01;
		var temp_false = false;
		// ตรวจสอบค่าทั้งหมดก่อนว่ามีค่าว่างหรือไม่
		for(j=1;j<=13;j++)
		{
			for(i=0;i<Array_Max;i++)
			{
				temp_01 = document.getElementById(Array_Temp[i]+"x"+j);
				if(temp_01.value.length==0)
				{
					temp_false = true;		
				}
			}
		}
		// กรณีที่มีค่าว่างไม่อนุญาตให้แสดงข้อมูล
		if(temp_false==true)
		{
			alert(' กรุณาป้อนข้อมูลตัวเลขให้ครบทุกช่อง ');
			return false;
		}
		if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล ")) {
			return true;
		}
		else
		{
			return false; 
		}
	}  // end function
</script>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<div style="margin-left:auto; margin-right:auto; text-align: center "> รายละเอียดแผนการ <font color='red'>ค่าใช้จ่าย</font> สกต.  </div>
<!-- ******************************************************************************************************************************************** -->
<form name="Frm_Expenses" action="PlanExpenses_sql.php" method="post" onsubmit=" return check_submit();">
&nbsp;
<?
if($click=='add')
{	?>
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;เพิ่มข้อมูลปีบัญชี
<? }
else
{ ?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
	</span>&nbsp;แก้ไขข้อมูลปีบัญชี
<? } ?>
<!--  ถ้าเป็นการเพิ่มข้อมูลใหม่จะแสดง list ให้เลือก  ถ้าเป็นการแก้ไขจะแสดง เป็น textbox -->
<!--  แสดงข้อมูลปีที่เลือก -->
<?
if($click=='add')
{	  $temp_year =  date("Y")+535; ?>
<select name="year">
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>" 
<? 	if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
			{
				if($temp_year==date("Y")+542){
					echo "selected";
				}
			}
			else{
				if($temp_year==date("Y")+543){
						echo "selected";
				}
			}  // end date?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>
<? } // end add?>
<? if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<?  } ?>
<!-- สิ้นสุดการแสดงปี -->
<table  width="1260" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการประมาณการค่าใช้จ่ายของ สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_blue"> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td rowspan="2" width="300" align="center" valign="middle">ประเภทค่าใช้จ่าย</td>
    <td colspan="12" align="center">ค่าใช้จ่ายแต่ละเดือน (หน่วย : พันบาท)</td>
    <td rowspan="2" width="100" align="center">รวมค่าใช้จ่าย</td>
  </tr>
  <tr class="rows_blue"> 
    <td width="70" align="center">เม.ย.</td>
    <td width="70" align="center">พ.ค.</td>
    <td width="70" align="center">มิ.ย.</td>
    <td width="70" align="center">ก.ค.</td>
    <td width="70" align="center">ส.ค.</td>
    <td width="70" align="center">ก.ย.</td>
    <td width="70" align="center">ต.ค.</td>
    <td width="70" align="center">พ.ย.</td>
    <td width="70" align="center">ธ.ค.</td>
    <td width="70" align="center">ม.ค.</td>
    <td width="70" align="center">ก.พ.</td>
    <td width="70" align="center">มี.ค.</td>
  </tr>
<!--  เริ่มแสดงข้อมูล  -->
<? $i=0;
	WHILE($fetch_plan =  fetch_row($result_plan)) {
	$i++;
// <!--  แสดงข้อมูลอื่น ๆ  -->
	if($i==1){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายดำเนินงาน </b></font></td>
	</tr>
<? }elseif($i==24){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจจัดหาสินค้ามาจำหน่าย </b></font></td>
	</tr>
 <? }elseif($i==29){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจรวบรวมผลผลิต </b></font></td>
	</tr>
 <? }elseif($i==34){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจแปรรูปผลผลิตและผลิตสินค้า</b></font></td>
	</tr>
 <? }elseif($i==39){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจบริการ </b></font></td>
	</tr>
 <? }elseif($i==43){ ?>
	<tr height='25' class='rows_orange'> 
		<td colspan="15" align="left">&nbsp;&nbsp;&nbsp;<font color="#000000"><b> ค่าใช้จ่ายธุรกิจสินเชื่อ </b></font></td>
	</tr>
 <? }  // end if 
//  สิ้นสุดการแสดงข้อมูลอื่น ๆ 
	if(($i%2)==0)
		echo "<tr class='rows_grey'>";
	else
		echo "<tr>";
?>
	<td align="center"><?=$i;?></td>  
	<td align="left">&nbsp;<?=trim($fetch_plan[1]); ?></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x1"?>" id="<?=trim($fetch_plan[0])."x1"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','1') " value="<?=number_format($fetch_plan[2],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x2"?>" id="<?=trim($fetch_plan[0])."x2"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','2'); " value="<?=number_format($fetch_plan[3],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7" name="<?=trim($fetch_plan[0])."x3"?>" id="<?=trim($fetch_plan[0])."x3"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','3'); " value="<?=number_format($fetch_plan[4],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x4"?>" id="<?=trim($fetch_plan[0])."x4"?>" class="txt_num"  onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','4'); " value="<?=number_format($fetch_plan[5],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x5"?>" id="<?=trim($fetch_plan[0])."x5"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','5'); " value="<?=number_format($fetch_plan[6],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x6"?>" id="<?=trim($fetch_plan[0])."x6"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','6'); " value="<?=number_format($fetch_plan[7],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x7"?>" id="<?=trim($fetch_plan[0])."x7"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','7'); " value="<?=number_format($fetch_plan[8],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x8"?>" id="<?=trim($fetch_plan[0])."x8"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','8'); " value="<?=number_format($fetch_plan[9],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x9"?>" id="<?=trim($fetch_plan[0])."x9"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','9'); " value="<?=number_format($fetch_plan[10],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x10"?>" id="<?=trim($fetch_plan[0])."x10"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','10'); " value="<?=number_format($fetch_plan[11],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x11"?>" id="<?=trim($fetch_plan[0])."x11"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','11'); " value="<?=number_format($fetch_plan[12],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x12"?>" id="<?=trim($fetch_plan[0])."x12"?>" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_data('<?=trim($fetch_plan[0])?>','12'); " value="<?=number_format($fetch_plan[13],0,'',''); ?>" style="background-color: #EDFFFF;"></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="<?=trim($fetch_plan[0])."x13"?>" id="<?=trim($fetch_plan[0])."x13"?>" class="txt_num_system" value="<?=number_format($fetch_plan[14],0,'',''); ?>"  readonly></td>
	</tr>
<? 
// หาผลรวมของแต่ละ colume ทั้งหมดก่อน
	$temp01=$temp01+number_format($fetch_plan[2],0,'','');	
	$temp02=$temp02+number_format($fetch_plan[3],0,'','');	
	$temp03=$temp03+number_format($fetch_plan[4],0,'','');	
	$temp04=$temp04+number_format($fetch_plan[5],0,'','');	
	$temp05=$temp05+number_format($fetch_plan[6],0,'','');	
	$temp06=$temp06+number_format($fetch_plan[7],0,'','');	
	$temp07=$temp07+number_format($fetch_plan[8],0,'','');	
	$temp08=$temp08+number_format($fetch_plan[9],0,'','');	
	$temp09=$temp09+number_format($fetch_plan[10],0,'','');	
	$temp10=$temp10+number_format($fetch_plan[11],0,'','');	
	$temp11=$temp11+number_format($fetch_plan[12],0,'','');	
	$temp12=$temp12+number_format($fetch_plan[13],0,'','');	
	$temp13=$temp13+number_format($fetch_plan[14],0,'','');	
} // end while ?>

	<!--  แสดงข้อมูลทั้งหมดในแต่ละ colume -->
  <tr>
	<td align="center" colspan="2" class="rows_yellow"> รวม </td>  
	<td align="center"><input type="text" size="7"  id="sum1" name="sum1" class="txt_num_system" value="<?=number_format($temp01);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum2" name="sum2" class="txt_num_system" value="<?=number_format($temp02);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum3" name="sum3" class="txt_num_system" value="<?=number_format($temp03);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum4" name="sum4" class="txt_num_system" value="<?=number_format($temp04);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum5" name="sum5" class="txt_num_system" value="<?=number_format($temp05);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum6" name="sum6" class="txt_num_system" value="<?=number_format($temp06);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum7" name="sum7" class="txt_num_system" value="<?=number_format($temp07);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum8" name="sum8" class="txt_num_system" value="<?=number_format($temp08);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum9" name="sum9" class="txt_num_system" value="<?=number_format($temp09);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum10" name="sum10" class="txt_num_system" value="<?=number_format($temp10);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum11" name="sum11" class="txt_num_system" value="<?=number_format($temp11);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum12" name="sum12" class="txt_num_system" value="<?=number_format($temp12);?>" readonly></td>
	<td align="center"><input type="text" size="7"  id="sum13" name="sum13" class="txt_num_system" value="<?=number_format($temp13);?>" readonly></td>
	</tr>
	<tr height="40">
		<input name="click" type="hidden" value="<?=$click; ?>">
		<td colspan="18" align="center"><input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก "></td>
	</tr>
<!--  สิ้นสุดปรับปรุงข้อมูล -->
</form>
<!-- ***************************************************************************************************************************************** -->
</table>
<p>
&nbsp;&nbsp;  <strong><u>หมายเหตุ</u></strong> ( ค่าใช้จ่ายทั้งหมดให้รวมทั้งของกรรมการและพนักงาน)<br>
&nbsp;&nbsp;  <strong>เงินเดือนและค่าจ้าง</strong> =  เงินเดือน ค่าจ้าง ค่าแรงงาน ค่าล่วงเวลา ที่ต้องจ่ายประจำ <br>
&nbsp;&nbsp;  <strong> ค่าตอบแทน </strong> = ค่าตอบแทนพิเศษที่จ่ายเป็นครั้งคราว นอกเหนือจากเงินเดือน<br>
&nbsp;&nbsp;  <strong> ค่าพาหนะและน้ำมันเชื้อเพลิง</strong> = ค่าพาหนะ ค่าขนส่ง ค่าน้ำมันเชื้อเพลิง ของพนักงานและกรรมการ<br>
&nbsp;&nbsp;  <strong>ค่าใช้จ่ายในการประชุม </strong>= ค่าใช้จ่ายในการประชุม เบี้ยประชุม <br>
&nbsp;&nbsp;  <strong> ค่าใช้จ่ายสวัสดิการ</strong> = ค่ารักษาพยาบาล ค่าเล่าเรียนบุตร ค่าครองชีพ ค่าเครื่องแบบ ค่าเล่าเรียนบุตร ของพนักงานและกรรมการ<br>
&nbsp;&nbsp;  <strong> ค่าใช้จ่ายสำหนักงาน </strong>= ค่าน้ำ ค่าไฟฟ้า ค่าทำความสะอาด ค่าไปรษณีโทรเลข  ค่าโทรศัพท์สำนักงาน ค่าถ่ายเอกสาร<br>
&nbsp;&nbsp;   <strong>ค่าอุปกรณ์สำนักงานใช้ไป </strong>= ค่าถ่ายเอกสาร ค่าเครื่องเขียนแบบพิมพ์ ค่าอุปกรณ์สำนักงาน<br>
&nbsp;&nbsp;  <strong> เงินสมทบกองทุน</strong> = ประกันสังคม สำรองเลี้ยงชีพ กองทุนบำเหน็จ<br>
&nbsp;&nbsp;  <strong> ค่าเช่า</strong> = ค่าเช่าคลังสินค้า ค่าเช่าสำนักงาน ค่าเช่าอาคาร<br>
&nbsp;&nbsp;   <strong>ค่าซ่อมแซม</strong> = ครุภัณฑ์ ยานพาหนะ อาคาร สินทรัพย์<br>
</p>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
	include("../footer.php")
?>