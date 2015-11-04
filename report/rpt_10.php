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
	var province_list=document.getElementById("province");
	var province = province_list.value;  // ʡ� �ѧ��Ѵ
	var province_name = province_list.options[province_list.selectedIndex].text;  // ������ ʡ�.�ѧ��Ѵ������͡
	var url = 'Ajax_report10.php?year='+year+'&month='+month+'&div='+div+'&province='+province+'&province_name='+province_name;    // �֧��������§ҹ
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
function doCallAjax99(province,province_name) {  //  �ʴ���������§ҹ�����
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
	var province_list=document.getElementById("province");
	var province = province;  // ʡ� �ѧ��Ѵ
	var province_name = province_name;  // ������ ʡ�.�ѧ��Ѵ������͡
	var url = 'Ajax_report01.php?year='+year+'&month='+month+'&div='+div+'&province='+province+'&province_name='+province_name;    // �֧��������§ҹ
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
} // end function doCallAjax99
function doCallAjax1(div,year,month) {  //  �ʴ���������§ҹ��������´��Ǵ��� 1
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
	
	var province_list=document.getElementById("province");
	var province = province_list.value;  // ʡ� �ѧ��Ѵ
	var province_name = province_list.options[province_list.selectedIndex].text;  // ������ ʡ�.�ѧ��Ѵ������͡
	var url = 'Ajax_report02.php?div='+div+'&year='+year+'&month='+month+'&province='+province+'&province_name='+province_name;    // �֧��������§ҹ
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
} // end function doCallAjax1

function doCallAjax2(div,year,month) {  //  �ʴ���������§ҹ��������´��Ǵ��� 1
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
	
	var province_list=document.getElementById("province");
	var province = province_list.value;  // ʡ� �ѧ��Ѵ
	var province_name = province_list.options[province_list.selectedIndex].text;  // ������ ʡ�.�ѧ��Ѵ������͡
	var url = 'Ajax_report03.php?div='+div+'&year='+year+'&month='+month+'&province='+province+'&province_name='+province_name;    // �֧��������§ҹ
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
} // end function doCallAjax2
</script>
</head>
<body>
<?php  // �ʴ������������§ҹ
	$report_header =" 10. ��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ��� ��Ǫ���Ѵ�ͧ Tris (����ͧ�ʢ.,�ѧ��Ѵ) ";
	$report_type ="1";
	include("report_header.php"); ?>
<span style="margin-left:5px; margin-top:0px " id="result_search"></span>
<img id="ajax_loading" src="../images/ajax-loading.gif" style="display: none;">
</body>
</html>
<?php
	include("../footer.php")
?>