<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

// �ʴ������š���Ѻ��Ҫԡ��������ع���͹���
$sql=" SELECT userlogin.amccode,  ";
$sql.=" Temp01.MemFirstQuarter,Temp01.MemSecondQuarter, ";
$sql.=" Temp01.MemThirdQuarter,Temp01.MemFourthQuarter, ";
$sql.=" Temp01.MemSumYear ";
$sql.=" FROM  userlogin  ";
$sql.=" LEFT JOIN ( ";
$sql.=" SELECT  ";
$sql.=" amccode,MemFirstQuarter, ";
$sql.="  MemSecondQuarter, MemThirdQuarter, ";
$sql.="  MemFourthQuarter,MemSumYear  ";
$sql.=" FROM PlanMember  ";
if($click=='add')
	$sql.=" WHERE PlanMember_year='9999'  ";
else
	$sql.=" WHERE PlanMember_year='".$year."'  ";
$sql.=" ) AS Temp01 ON Temp01.amccode = userlogin.amccode ";
$sql.=" WHERE userlogin.amccode='".$code_online."' ";

$result_plan =	query($sql);

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">

// ��Ѻ��ا�����š���ʴ��Ż�
  function update_year() {
		var xxx=	document.getElementById("year").value
		document.getElementById("year1").innerText = '�� '+(xxx-3);
		document.getElementById("year2").innerText = '�� '+(xxx-2);
		document.getElementById("year3").innerText = '�� '+(xxx-1);
  }

 var HttPRequest = false; 

function doCallAjax() { 
	HttPRequest = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest = new XMLHttpRequest();
		if (HttPRequest.overrideMimeType) { 
			HttPRequest.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
        
	if (!HttPRequest) {    
		alert(' �������ö���ҧ XMLHTTP instance �������ö�֧�����Ũҡ�к��� ');    
		return false; 
	} 

	var year = document.getElementById("year").value
	var Temp_ans;
	var Array_ans;
	var url = 'Ajax_Member.php?year='+year;     
	HttPRequest.open('get',url,true); 
	HttPRequest.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest.onreadystatechange = function() 
	{ 
		update_year();
		if(HttPRequest.readyState == 3)  // Loading Request    
		{             
			document.getElementById("mySpan").innerHTML = "Now is Loading...";        
		}      
		if(HttPRequest.readyState == 4) // Return Request 
		{    
			if(HttPRequest.status==200){
			   if(HttPRequest.responseText == 'N')                   
			   {               
				  document.getElementById("a1").value = "0";       
				  document.getElementById("a2").value = "0";       
				  document.getElementById("a3").value = "0";       
				  document.getElementById("b1").value = "0";       
			 	  document.getElementById("b2").value = "0";       
				  document.getElementById("b3").value = "0";       
			   }   
		      else       
			  {          
				  Temp_ans = HttPRequest.responseText; 
				  Array_ans= Temp_ans.split("#");
				  document.getElementById("a1").value = Array_ans[0];       
				  document.getElementById("a2").value = Array_ans[1];  
			      document.getElementById("a3").value = Array_ans[2];  
				  document.getElementById("b1").value = Array_ans[3];  
				  document.getElementById("b2").value = Array_ans[4];  
				  document.getElementById("b3").value = Array_ans[5];  
				  document.getElementById("mySpan").innerHTML = "";        
			  }  // end N
		   }  // 200
		}    // end 4
	}  // end function
	HttPRequest.send(null);
} // end function doCallAjax

// �ʴ������������㹴�ҹ����Ѻ��Ҫԡ
	function update_rows_x()
	{
		var t1 = document.getElementById("x1");
		var t2 = document.getElementById("x2");
		var t3 = document.getElementById("x3");
		var t4 = document.getElementById("x4");
		var t5 = document.getElementById("x5");

		t5.value = parseInt(t1.value)+parseInt(t2.value)+parseInt(t3.value)+parseInt(t4.value);
	}
// �ʴ������������㹴�ҹ�ع���͹�����Ҫԡ
	function update_rows_y()
	{
		var t1 = document.getElementById("y1");
		var t2 = document.getElementById("y2");
		var t3 = document.getElementById("y3");
		var t4 = document.getElementById("y4");
		var t5 = document.getElementById("y5");

		t5.value = parseInt(t1.value)+parseInt(t2.value)+parseInt(t3.value)+parseInt(t4.value);
	}

// �׹�ѹ��͹��Ѻ��ا������		
	function check_submit()
	{
		var temp_01;
		var temp_false = false;
		// ��Ǩ�ͺ��ҡ���Ѻ��Ҫԡ�������ҧ�������
			for(i=1;i<=5;i++)
			{
				temp_01 = document.getElementById('x'+i);
				if(temp_01.value.length==0)
				{
					temp_false = true;		
				}
			}
	   // ��Ǩ�ͺ��������ع���͹���
			for(i=1;i<=5;i++)
			{
				temp_01 = document.getElementById('y'+i);
				if(temp_01.value.length==0)
				{
					temp_false = true;		
				}
			}
		// �óշ���դ����ҧ���͹حҵ����ʴ�������
		if(temp_false==true)
		{
			alert(' ��سһ�͹�����ŵ���Ţ���ú�ء��ͧ ');
			return false;
		}
		if (confirm(" ��س��׹�ѹ��û�Ѻ��ا������ ")) {
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
<div style="margin-left:auto; margin-right:auto; margin-bottom:5px;  text-align: center "> Ἱ��ô��Թ�ҹ��ҹ <font color='red'>��Ҫԡ��зع���͹��� </font></div>
<!-- ******************************************************************************************************************************************** -->
<form name="Frm_Member" action="PlanMember_sql.php" method="post" onsubmit=" return check_submit();">
&nbsp;
<?
if($click=='add')
{	?>
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" ���������� " class="images_icon" >
</span>&nbsp;���������Żպѭ��
<? }
else
{ ?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" ��䢢����� " class="images_icon" >
	</span>&nbsp;��䢢����Żպѭ��
<? } ?>
<!--  ����繡������������������ʴ� list ������͡  ����繡����䢨��ʴ� �� textbox -->
<!--  �ʴ������Żշ�����͡ -->
<?
if($click=='add')
{	  $temp_year =  date("Y")+535; ?>
<select name="year" onChange='doCallAjax(); '>
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
<? } // end add?>
<? if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<?  } ?>
<!-- ����ش����ʴ��� -->
<span id='mySpan'></span>
<table  width="1050" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="10" align="left">&nbsp;<font color="#0F7FAF"><b>��������´Ἱ����Ѻ��Ҫԡ��������ع���͹��鹢ͧ ʡ�. �� <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_orange"> 
    <td rowspan="2" width="20" align="center" valign="middle">���</td>
    <td rowspan="2" width="300" align="center" valign="middle">Ἱ�ҹ</td>
    <td colspan="3" width="" align="center" valign="middle">�ŧҹ��͹��ѧ</td>
    <td colspan="5" align="center" valign="middle">������§ҹ��Шӻ�</td>
  </tr>
  <tr class="rows_orange"> 
    <td align="center" width="90" align="center"><span id='year1'></span></td>
    <td align="center" width="90" align="center"><span id='year2'></span></td>
	<td align="center" width="90" align="center"><span id='year3'></span></td>
    <td align="center" width="90" align="center">����� 1</td>
    <td align="center" width="90" align="center">����� 2</td>
	<td align="center" width="90" align="center">����� 3</td>
    <td align="center" width="90" align="center">����� 4</td>
    <td align="center" width="100" align="center">���������</td>
  </tr>
<!--  ������ʴ�������  -->
<? 
	WHILE($fetch_plan =  fetch_row($result_plan)) {
?>
	<tr>
	<td align="right">1&nbsp;</td>  
	<td align="left">&nbsp;����Ѻ��Ҫԡ</td>
	<td align="center"><input type="text" size="7" id='a1' maxlength="7" class="txt_num_system" value="" readonly></td>
	<td align="center"><input type="text" size="7" id='a2' maxlength="7" class="txt_num_system" value="" readonly></td>
	<td align="center"><input type="text" size="7" id='a3' maxlength="7" class="txt_num_system" value="" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="x1" id="x1" class="txt_num"  onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_x(); " value="<?=number_format($fetch_plan[1],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="x2" id="x2" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_x(); " value="<?=number_format($fetch_plan[2],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="x3" id="x3" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_x(); " value="<?=number_format($fetch_plan[3],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="x4" id="x4" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_x(); " value="<?=number_format($fetch_plan[4],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="x5" id="x5" class="txt_num_system" value="<?=number_format($fetch_plan[5],0,'',''); ?>" readonly></td>
	</tr>
<?  } // end while ?>
<? 
// �ʴ������š�������ع���͹���
$sql=" SELECT userlogin.amccode,  ";
$sql.=" Temp01.ShareFirstQuarter,  Temp01.ShareSecondQuarter, ";
$sql.=" Temp01.ShareThirdQuarter, Temp01.ShareFourthQuarter, ";
$sql.=" Temp01.ShareSumYear ";
$sql.=" FROM  userlogin  ";
$sql.=" LEFT JOIN ( ";
$sql.=" SELECT  ";
$sql.=" amccode, ShareFirstQuarter, ";
$sql.="  ShareSecondQuarter, ShareThirdQuarter, ";
$sql.="  ShareFourthQuarter,ShareSumYear  ";
$sql.=" FROM PlanMember  ";
$sql.=" WHERE PlanMember_year='".$year."'  ";
$sql.=" ) AS Temp01 ON Temp01.amccode = userlogin.amccode ";
$sql.=" WHERE userlogin.amccode='".$code_online."' ";

$result_plan =	query($sql); 
WHILE($fetch_plan =  fetch_row($result_plan)) { ?>
	<tr class='rows_grey'>
	<td align="right">2&nbsp;</td>  
	<td align="left">&nbsp;��������ع���͹��� ( ˹��� : �ѹ�ҷ)</td>
	<td align="center"><input type="text" size="7" id='b1' maxlength="7" class="txt_num_system" value="" readonly></td>
	<td align="center"><input type="text" size="7" id='b2' maxlength="7" class="txt_num_system" value="" readonly></td>
	<td align="center"><input type="text" size="7" id='b3' maxlength="7" class="txt_num_system" value="" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="y1" id="y1" class="txt_num"  onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_y(); " value="<?=number_format($fetch_plan[1],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="y2" id="y2" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_y(); " value="<?=number_format($fetch_plan[2],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="y3" id="y3" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_y(); " value="<?=number_format($fetch_plan[3],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="y4" id="y4" class="txt_num" onKeyPress="return isNumberKey(this); " onKeyUp=" update_rows_y(); " value="<?=number_format($fetch_plan[4],0,'',''); ?>" ></td>
	<td align="center"><input type="text" size="7" maxlength="7"  name="y5" id="y5" class="txt_num_system" value="<?=number_format($fetch_plan[5],0,'',''); ?>" readonly></td>
	</tr>
<? } // end while ?>
	<tr height="40">
		<input name="click" type="hidden" value="<?=$click; ?>">
		<td colspan="10" align="center"><input type="submit" value=" �ѹ�֡������ ">&nbsp;<input type="reset" value=" ¡��ԡ "></td>
	</tr>
<!--  ����ش��Ѻ��ا������ -->
</form>
<script language="JavaScript">
		doCallAjax();
</script>
<!-- ***************************************************************************************************************************************** -->
</table>
</body>
</html>
<!-- ************************** -->
<?php
	free_result($result_plan);
	close();
	include("../footer.php")
?>