<?php session_start(); 
   include("lib/config.inc.php"); ?>


<!--  ตัวเลื่อน status  -->
<script language="JavaScript">
  message = "<?=$webSite['copyright'] ?>^" +"^";
  scrollSpeed = 50;
  lineDelay   = 1500;
  txt = "";
  function scrollText(pos) {
    if (message.charAt(pos) != '^') {
      txt = txt + message.charAt(pos);
      status = txt;
      pauze  = scrollSpeed;
    }
    else {
      pauze = lineDelay;
      txt = "";
      if (pos == message.length-1) pos = -1
    }
    pos++;
    setTimeout("scrollText('"+pos+"')",pauze);
  }
scrollText(0);
  </script> 

<?
	if (!session_is_registered("code_online") OR trim($code_online)=='')
	{		print '<script>alert(" กรุณา Login ก่อนใช้งาน '.$_SERVER['REMOTE_ADDR'].' ");window.location.href = "../index.php";</script>';
			exit();	
	}
?>