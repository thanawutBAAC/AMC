<?php
	include("../js/databranch_area_9_div.js"); 
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
		<td align="right" width='170'> ���͡�պѭ�� :</td>
		<td align="left">&nbsp;
		<select name="year" id="year">
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
			}  // end date ?> ><?=$temp_year; ?></option>
		<?    } // end while ?>
		</select>
		</td>
		<td align="right" width='100'>&nbsp;</td>
		<td align="left" >&nbsp;</td>
</tr>
<tr height="25" valign="bottom">
	<td align="right" width='170'> ���¡Ԩ����Ң� :</td>
	<td align="left">&nbsp;
	     <select id="div" name="div" onChange="javascript:listData(this.value)">
			<option value="0">--��������--</option>
			<option value="1">&nbsp;���¡Ԩ����Ң� 1 </option>
			<option value="2">&nbsp;���¡Ԩ����Ң� 2 </option>
			<option value="3">&nbsp;���¡Ԩ����Ң� 3 </option>
			<option value="4">&nbsp;���¡Ԩ����Ң� 4 </option>
			<option value="5">&nbsp;���¡Ԩ����Ң� 5 </option>
			<option value="6">&nbsp;���¡Ԩ����Ң� 6 </option>
			<option value="7">&nbsp;���¡Ԩ����Ң� 7 </option>
			<option value="8">&nbsp;���¡Ԩ����Ң� 8 </option>
			<option value="9">&nbsp;���¡Ԩ����Ң� 9</option>
		</select>  
	</td>
	<td align="right" width='100'> ���͡ʡ� :</td>
	<td align="left">&nbsp;
		<select id="province" name="province" >    
			<option value="0">-- �ˡó����ɵ����͡�õ�Ҵ --</option>
		</select>  
	</td>
</tr>
<tr height="35">
	<td>&nbsp;</td>
	<td colspan="3" align="left">&nbsp;&nbsp;<input type="button" value=" �ʴ���������§ҹ " OnClick=" doCallAjax(); "><td>
</tr>
</table>
</form>
<!-- ****************************************************************************************************** -->