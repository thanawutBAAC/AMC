<?php session_start();
	include("../check_login.php");
	$filename = "../doc/message.txt";
	$handle = fopen($filename, "r");
	if( filesize($filename)==0)
	{	$contents[0] = "0";
		$contents[1] = ""; }
	else
	{	$contents = fread($handle, filesize($filename));
		$contents = explode("#", $contents);  }
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
	<form name="news" action="config_message.php" method="post">
		<div style="margin-top: 25px; margin-left:85px; margin-bottom:3px">
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/comment_edit.png');" class="span_icon">
		<img src="../icons/comment_edit.png" alt=" �ѹ�֡������ " class="images_icon" > 
		</span><font color="#0F7FAF"> ��ͤ���˹���á : </font>
		</div>
		<center>
		<textarea name="content" rows="8" cols="80" class="editor"><?echo trim($contents[1]) ?></textarea>
		</center>
		<div style="margin-top:2px; margin-left:85px;">
			<input type="checkbox" name="check" value="1" <? if($contents[0]==1) echo "checked"; ?>> ����ʴ�˹���á�ء����
		</div>
		<br>
		<center>
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
<!--  �ѹ�֡������ŧ���  doc / message.txt  -->
<?php
	if (isset($ok))
	{
		$handle = fopen($filename, "w");
		$somecontent = $_POST["content"];
		$check = $_POST["check"];
		if($check==1)
			$somecontent = "1#".$somecontent;
		else
			$somecontent = "0#".$somecontent;

		 if (fwrite($handle, $somecontent) === FALSE) 
		{
				echo "Cannot write to file ($filename)";
				exit;
		  } 
		fclose($handle);
		print '<script>alert(" ��Ѻ��ا��ͤ���˹���á�١��ͧ ");</script>';
		print '<script>window.location.href = "config_message.php";</script>';
	}
?>