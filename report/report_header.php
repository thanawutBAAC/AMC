<?php
	include("../js/databranch_area_9_div.js"); 
	$month_thai = array("4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม',"1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม');
	$temp_year =  date("Y")+525; 
?>
<!-- *************************************************************************************************** -->
<form method="">
<table width="700" style="margin-left:5px; text-align: center; margin-top:8px; margin-bottom:0px;" border="0" cellpadding="0" cellspacing="0" class="report" >
	<tr>
		<td colspan="4" valign="top" >
			<table width="699" border="0" cellpadding="0" cellspacing="0" style="margin: 1 1 1 1;">
				<tr height="30px">
		  			<td align="center" bgcolor="#EEEEEE"><strong><?=$report_header; ?></strong></td>
				</tr>
			</table>
		</td>	
	</tr>
	<tr height="25" valign="bottom">
		<td align="right" width="170"> ปีบัญชี :</td>
		<td align="left" width="">&nbsp;
		<select name="year" id="year">
		<? WHILE($i<20) { 
			$i++; 
			$temp_year = $temp_year+1; ?>
			<option value="<?=$temp_year; ?>" 
			<?  	
			if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
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
		</select>
		</td>
		<td align="right" width="100"> เดือน :</td>
		<td align="left" width="">&nbsp;
			<select name="month" id="month">
			<?
			$month_now = date('n');
			foreach ($month_thai as $i => $m)
			{
				if($i==$month_now)
		  			echo "<option value='$i' selected>$m</option>"; 
				else
					echo "<option value='$i'>$m</option>";	
			}
		?>
		</select>
	</td>
</tr>
<tr height="25" valign="bottom">
	<td align="right" width="170"> ฝ่ายกิจการสาขา :</td>
	<td align="left">&nbsp;
	     <select id="div" name="div" onChange="javascript:listData(this.value)">
			<option value="0">--รวมประเทศ--</option>
			<option value="1">ฝ่ายกิจการสาขา 1</option>
			<option value="2">ฝ่ายกิจการสาขา 2</option>
			<option value="3">ฝ่ายกิจการสาขา 3</option>
			<option value="4">ฝ่ายกิจการสาขา 4</option>
			<option value="5">ฝ่ายกิจการสาขา 5</option>
			<option value="6">ฝ่ายกิจการสาขา 6</option>
			<option value="7">ฝ่ายกิจการสาขา 7</option>
			<option value="8">ฝ่ายกิจการสาขา 8</option>
			<option value="9">ฝ่ายกิจการสาขา 9</option>
		</select>  
	</td>
	<td align="right" width="100"> สกต :</td>
	<td align="left">&nbsp;
		<select id="province" name="province" >    
			<option value="0">-- สหกรณ์การเกษตรเพื่อการตลาด --</option>
		</select>  
	</td>
</tr>
<tr height="35">
	<td>&nbsp;</td>
	<td colspan="3" align="left">&nbsp;&nbsp;<input type="button" value=" แสดงข้อมูลรายงาน " OnClick=" doCallAjax(); "><td>
</tr>
</table>
</form>
<!-- ****************************************************************************************************** -->