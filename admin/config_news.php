<?php
	include("../check_login.php");
	$filename = "../doc/news.txt";
	$handle = fopen($filename, "r");
	if(filesize($filename)==0)
	{	$contents="";	}
	else {	  $contents = fread($handle, filesize($filename)); }
	fclose($handle); 
?>
<html>
<head>
<title></title>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<br>
	<form name="news" action="config_news.php" method="post">
		<div style="margin-top: 25px; margin-left:85px; margin-bottom:3px">
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/comment_edit.png');" class="span_icon">
		<img src="../icons/comment_edit.png" alt=" �ѹ�֡������ " class="images_icon" > 
		</span><font color="#0F7FAF"> ��ͤ���������� : </font>
		</div>
	 	<center> 
			<textarea name="content" rows="8" cols="80" class="editor"><?echo trim($contents) ?></textarea>
			<br><br>
			<input name="ok" type="hidden" >
			<input type="submit" value=" �ѹ�֡������ ">
			<input type="reset" value=" ¡��ԡ ">
		</center>
	</form>
</body>
</html>
<?php
	include("footer.php")
?>
<!--  �ѹ�֡������ŧ���  doc / news.txt  -->
<?
	if (isset($ok))
	{
		$handle = fopen($filename, "w");
		$somecontent = $_POST["content"];
	
		 if (fwrite($handle, $somecontent) === FALSE) 
		{
				echo "Cannot write to file ($filename)";
				exit;
		  } 
		fclose($handle);
		print '<script>alert(" ��Ѻ��ا�����Ţ�����ö١��ͧ ");</script>';
		print'<script>parent.frames["topFrame"].document.location="../header.php";</script>';
		print '<script>window.location.href = "config_news.php";</script>';
	}
		
?>