<?php session_start();
	header( "Expires: Sat, 1 Jan 2009 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�',"1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�');
	$temp_year =  date("Y")+525; 

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>

<script language="JavaScript">
function showhide(varAction,temp_picture)
{

	if (varAction.style.display == 'none'){
        newImage = "../images/icon_minus.gif";
        document.getElementById(temp_picture).src = newImage;
		varAction.style.display='';
  }else{
		newImage = "../images/icon_plus.gif";
		document.getElementById(temp_picture).src = newImage;
		varAction.style.display='none';
	}
}
</script>

<script language="JavaScript">

function doCallAjax() {  //  �ʴ���������§ҹ�����
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
		alert(' �������ö���ҧ XMLHTTP instance  �������ö�֧�����Ũҡ�к��� ');    
		return false; 
	} 
	var year = document.getElementById("year").value;  // ��
	var month = document.getElementById("month").value;  // ��͹
	var div = document.getElementById("div").value;  // �����Ҥ
	var target = document.getElementsByName('target');
	var url ='';
	for(var i = 0; i < target.length; i++)
	{
	    if(target[i].checked== true) {   // ��Ǩ�ͺ������͡����ʴ�����ͧ�˹  0 ����ͧ �ʢ. 1 ����ͧ �ż�Ե
              varItem = target[i].value;
              break;
		}  // end if
	}  // end for

	if (varItem=='0'){
		 url = 'Ajax_report151.php?year='+year+'&month='+month+'&div='+div;    // �֧��������§ҹ ����ͧ �ʢ.
	}
	else{
		 url = 'Ajax_report152.php?year='+year+'&month='+month+'&div='+div;    // �֧��������§ҹ ����ͧ �ż�Ե
	} // end if else 

	document.getElementById("result_search").innerHTML = "Now is Loading... ";        // page loading
	document.getElementById("ajax_loading").style.display = '';
	HttPRequest.open('get',url,true); 
	HttPRequest.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest.onreadystatechange = function() 
	{ 
		if(HttPRequest.readyState == 4) { // Return Request 
			if(HttPRequest.status==200){
				document.getElementById("result_search").innerHTML = HttPRequest.responseText; 
				document.getElementById("ajax_loading").style.display = 'none';
			} // end if 200 
		}  // end if 4      
	}  // end function
   HttPRequest.send(null);
} // end function doCallAjax

</script>
</head>
<body>
<table width="700" style="margin-left:5px; text-align: center; margin-top:8px; margin-bottom:0px;" border="0" cellpadding="0" cellspacing="0" class="report" >
	<tr>
		<td colspan="4" valign="top" >
			<table width="699" border="0" cellpadding="0" cellspacing="0" style="margin: 1 1 1 1;">
				<tr height="30px">
		  			<td align="center" bgcolor="#EEEEEE"><strong> ��§ҹ�Ǻ����ż�Ե������ ʡ�. ( ��Դ���������� )</strong></td>
				</tr>
			</table>
		</td>	
	</tr>
	<tr height="25" valign="bottom">
		<td align="right" width="170"> �պѭ�� :</td>
		<td align="left" width="">&nbsp;
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
		<td align="right" width="100"> ��͹ :</td>
		<td align="left" >&nbsp;
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
	<td align="right" width="170"> ���¡Ԩ����Ң� :</td>
	<td align="left">&nbsp;
	     <select id="div" name="div">
			<option value="0">--��������--</option>
			<option value="1">���¡Ԩ����Ң� 1</option>
			<option value="2">���¡Ԩ����Ң� 2</option>
			<option value="3">���¡Ԩ����Ң� 3</option>
			<option value="4">���¡Ԩ����Ң� 4</option>
			<option value="5">���¡Ԩ����Ң� 5</option>
			<option value="6">���¡Ԩ����Ң� 6</option>
			<option value="7">���¡Ԩ����Ң� 7</option>
			<option value="8">���¡Ԩ����Ң� 8</option>
			<option value="9">���¡Ԩ����Ң� 9</option>
		</select>  
	</td>
	<td align="right" width="100"> �ٻẺ :</td>
	<td align="left">&nbsp;
		<input type="radio" name='target'  value='0' checked> ����ͧ �ʢ.
		<input type="radio" name='target'  value='1' > ����ͧ �ż�Ե
	</td>
</tr>
<tr height="35">
	<td>&nbsp;</td>
	<td colspan="3" align="left">&nbsp;&nbsp;<input type="button" value=" �ʴ���������§ҹ " OnClick=" doCallAjax(); "><td>
</tr>
</table>
<span style="margin-left:5px; margin-top:0px " id="result_search"></span>
<img id="ajax_loading" src="../images/ajax-loading.gif" style="display: none;">
</body>
</html>
<?php
	include("../footer.php")
?>