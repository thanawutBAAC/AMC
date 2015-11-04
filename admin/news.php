<?php
	$filename = "../doc/news.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
?>
<html>
<body>
<style type="text/css">
body {  margin: 0px  0px; padding: 0px  0px;  color:#006CFF;  }
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}
</style>
<marquee width="100%" onmouseover="this.scrollAmount=0" onmouseout="this.scrollAmount=1" scrollAmount="1" scrollDelay="27" truespeed="true">
<font face="ms sans serif" size="2" style=" vertical-align: text-bottom "> <?=$contents; ?></font>
</marquee>
</body>
</html>