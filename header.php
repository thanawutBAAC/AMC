<?php  session_start();
		include("lib/config.inc.php");
?>
<HTML>
<HEAD>
<TITLE><?=$webSite['title'] ?></TITLE>
<?=$webSite['meta']; ?>
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<style>
      #Good {
        background-repeat: repeat-x;
        background-position: center center;
        background-image: url(images/back_blue.jpg);
      }

	.Hide { 
		display: ; 
		position:absolute;
	} 
	.Show { 
		display: none; 
		position:absolute;
	} 

 </style>
</HEAD>
<script language="JavaScript">
status="<?=$webSite['copyright'] ?>";

function HideFrame()
{  // for IE;
var lfr = window.top.document.getElementById('main_frame');
 if (lfr == null)
	return; 
 lfr.cols ="0,* ";
 document.getElementById('hideframe').style.display='none';
 document.getElementById('showframe').style.display='block';
}

function ShowFrame()
{  // for IE;
var lfr = window.top.document.getElementById('main_frame');
 if (lfr == null)
	return; 
 lfr.cols ="250,* ";
 document.getElementById('hideframe').style.display='block';
 document.getElementById('showframe').style.display='none';
}
</script> 
<body bgcolor='#75B33F'>
<br>
<!--  �ʴ��ٻ�Ҿ��ͺ���� -->
<div style=" float:left; right:1px; bottom:0px; position:absolute">
	<img src="images/thai_logo.jpg" width="285" height="85" align="absbottom">
</div>
<!-- ******** logo ************** -->
<div style=" float:left; left:5px; bottom:40px; position:absolute">
	<img src="images/amc.jpg" width="50" height="50" align="absbottom">
</div>
<!-- **************** -->
<div style=" float:left; left:70px; bottom:40px; position:absolute">
	<h3><font color="#FFFFFF"> �к������â����� �ˡó����ɵ����͡�õ�Ҵ�١��� ���. </font></h3>
</div>

<div id="hideframe" style="float:left; position:absolute; right:2px; top:5px;" style="display:" class='Hide' >
	<span style="	cursor: hand; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='icons/layout_delete.png');" class="span_icon" onClick=" HideFrame();">
	<img src="icons/layout_delete.png" alt=" ��͹���� " class="images_icon"  > 
	</span>&nbsp;<a href="#" onClick=" HideFrame();"><font color="#FFFFFF">��͹����</font></a>&nbsp;
</div>
<div id="showframe" style="float:left; position:absolute; right:2px; top:5px;" style="display:none;" class='Show' >
	<span style="	cursor: hand; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='icons/layout_add.png');" class="span_icon" onClick=" ShowFrame();">
	<img src="icons/layout_add.png" alt=" �ʴ����� " class="images_icon"  > 
</span>&nbsp;<a href="#" onClick=" ShowFrame();" ><font color="#FFFFFF">�ʴ�����</font></a>&nbsp;
</div> 
<!--  �ʴ���Ǣ�͢�����õ����� -->
<div  style="float:left; left:3px; bottom:2px; position:absolute">
	<img src="images/icon_news.gif" alt=" ������û�Ш��ѹ " > 
</div>
<div style="height:24px;width:690px;border:1px solid #7b946f;background:#fff; float:left; left: 35px; bottom: 2px; position: absolute" align="center">
		<iframe src="admin/news.php" frameborder="0" scrolling="no" width="650" height="20" ></iframe>
</div>
<!-- ����ش����ʴ�������õ����� -->
<!-- �ʴ������ż�������ҹ -->
<div style=" float:left; right:65px; bottom:31px; position:absolute">
	��������ҹ : <font color="red"> <?=$user_online; ?></font>
</div>
<!--  �Թ�ش����ʴ���������ҹ -->
<!--  �ʴ������� logout -->
<div style=" float:left; right:65px; bottom:16px; position:absolute">�͡�ҡ����� :
	<a href="logout_user.php" onclick=" javascript: return confirm(' ��س��׹�ѹ����͡�ҡ����� ')"><font color="#6CAA35"><b>[ Logout ]</b></font></a>
</div>
<!-- ����ش�ʴ������� logout -->

<!--  �ʴ���á�˹���Ҵ����ѡ�� -->
<div style=" float:left; right:32px; bottom:0px; position:absolute">
	 ��˹���Ҵ�ѡ�� : 
	<a href="#" onclick="javascript:parent.right.document.body.style.fontSize='0.8em' "> ���� </a>
	<a href="#" onclick="javascript:parent.right.document.body.style.fontSize='1em' "> �˭� </a>
	<a href="#" onclick="javascript:parent.right.document.body.style.fontSize='1.2em' "> �˭��ҡ </a>
</div>
<!--  �Թ�ش��á�˹���Ҵ����ѡ�� -->
</body>
</html>