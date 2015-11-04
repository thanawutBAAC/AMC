<?php session_start();
	header( "Expires: Sat, 1 Jan 2009 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript">
function doCallAjax() {  //  ��§ҹ�Ҿ���Ἱ ʡ�.4 �����ͧ����� �ʢ.  ��з�駻����

	var year = document.getElementById("year").value;  // ��
	var div = document.getElementById("div").value;  // �����Ҥ
	var report = document.getElementById("report").value;  // ��§ҹ
	var url = 'Frame_ReportSum0'+report+'.php?year='+year+'&div='+div;    // �֧��������§ҹ

	document.getElementById("ResultFrame").src = url;	// ��˹���� src �ͧ frame 

	alert(' �ʴ���������§ҹ ');
	if(report==1)
	{
		document.getElementById("ResultFrame").style.width = "1000px";
		document.getElementById("ResultFrame").style.height = "1400px";
	}
	else if(report==2)
	{
		document.getElementById("ResultFrame").style.width = "1080px";
		document.getElementById("ResultFrame").style.height = "300px";
	}
	else if(report==3)
	{
		document.getElementById("ResultFrame").style.width = "1730px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==4)
	{
		document.getElementById("ResultFrame").style.width = "1470px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==5)
	{
		document.getElementById("ResultFrame").style.width = "1730px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==6)
	{
		document.getElementById("ResultFrame").style.width = "1470px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==7)
	{
		document.getElementById("ResultFrame").style.width = "1290px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==8)
	{
		document.getElementById("ResultFrame").style.width = "1290px";
		document.getElementById("ResultFrame").style.height = "750px";
	}
	else if(report==9)
	{
		document.getElementById("ResultFrame").style.width = "1730px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	else if(report==10)
	{
		document.getElementById("ResultFrame").style.width = "1470px";
		document.getElementById("ResultFrame").style.height = "600px";
	}
	document.getElementById("ResultFrame").location.reload(true);  // refresh
	return true;

} // end function doCallAjax
</script>
</head>
<body>
<table width="700" style="margin-left:5px; text-align: center; margin-top:8px; margin-bottom:0px;" border="0" cellpadding="0" cellspacing="0" class='report'>
	<tr>
		<td colspan="4" valign="top" >
			<table width="699" border="0" cellpadding="0" cellspacing="0" style="margin: 1 1 1 1;">
				<tr height="30px">
		  			<td align="center" bgcolor="#EEEEEE"><strong>��§ҹ�Ҿ���Ἱ ʡ�.4 </strong></td>
				</tr>
			</table>
		</td>	
	</tr>
	<tr height="25" valign="bottom">
		<td align="right" > ���͡�պѭ�� :</td>
		<td align="left" >&nbsp;
		<select name="year" id="year">
		<?
			$temp_year =  date("Y")+525; 
			WHILE($i<20) { 
				$i++; 
				$temp_year = $temp_year+1; ?>
			<option value="<?=$temp_year; ?>" 
<? 		if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
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
		<td align="right"> ���͡���¡Ԩ����Ң� :</td>
		<td align="left">&nbsp;
	     <select id="div" name="div" >
			<option value="0">--��������--</option>
			<option value="1">&nbsp;���¡Ԩ����Ң� 1 </option>
			<option value="2">&nbsp;���¡Ԩ����Ң� 2 </option>
			<option value="3">&nbsp;���¡Ԩ����Ң� 3 </option>
			<option value="4">&nbsp;���¡Ԩ����Ң� 4 </option>
			<option value="5">&nbsp;���¡Ԩ����Ң� 5 </option>
			<option value="6">&nbsp;���¡Ԩ����Ң� 6 </option>
			<option value="7">&nbsp;���¡Ԩ����Ң� 7 </option>
			<option value="8">&nbsp;���¡Ԩ����Ң� 8 </option>
			<option value="9">&nbsp;���¡Ԩ����Ң� 9 </option>
		</select>  
	   </td>
</tr>
<tr height="25" valign="bottom">
	<td align="right"> ���͡��§ҹ :</td>
	<td align="left" colspan='3'>&nbsp;
		<select id="report" name="report" >    
			<option value="1">&nbsp;��§ҹ��ػἹ��ô��Թ�ҹ��Шӻ� </option>
			<option value="2">&nbsp;��§ҹἹ��Ҫԡ ��������ع���͹��� </option>
			<option value="3">&nbsp;��§ҹ�Ѵ���Թ����Ҩ�˹��� �ʹ���� </option>
			<option value="4">&nbsp;��§ҹ�Ѵ���Թ����Ҩ�˹��� �ʹ��� </option>
			<option value="5">&nbsp;��§ҹ����Ǻ�����Ե�š���ɵ� �ʹ���� </option>
			<option value="6">&nbsp;��§ҹ����Ǻ�����Ե�š���ɵ� �ʹ��� </option>
			<option value="7">&nbsp;��§ҹ�������ԡ����������������ɵ� </option>
			<option value="8">&nbsp;��§ҹἹ��è��¤������� </option>
			<option value="9">&nbsp;��§ҹ������ٻ�ż�Ե �ʹ���� </option>
			<option value="10">&nbsp;��§ҹ������ٻ�ż�Ե �ʹ��� </option>
		</select>  
	</td>
</tr>
<tr height="35">
	<td>&nbsp;</td>
	<td colspan="3" align="left">&nbsp;&nbsp;<input type="button" value=" �ʴ���������§ҹ " OnClick=" doCallAjax(); "><td>
</tr>
</table>
<iframe id='ResultFrame'  name='ResultFrame' frameborder='0' src='' height="50%" width="100%" style="margin-left:5px; margin-right:5px; margin-top:10px;"></iframe> 
</body>
</html>
<?php
	include("../footer.php")
?>