<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Control usage demonstration file
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// กำหนดการใช้ Spaw editor control 
require("../editor/config/path.php");
if (!ereg('/$', $HTTP_SERVER_VARS['DOCUMENT_ROOT']))
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'].'/';
else
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

define('DR', $_root);
unset($_root);

// set $spaw_root variable to the physical path were control resides
// don't forget to modify other settings in config/spaw_control.config.php
// namely $spaw_dir and $spaw_base_url most likely require your modification
$spaw_root = DR.$pathDir.'/editor/';

// include the control file
include $spaw_root.'spaw_control.class.php';

// here we add some styles to styles dropdown
$spaw_dropdown_data['style']['default'] = 'ไม่ได้กำหนดรูปแบบ';
$spaw_dropdown_data['style']['style1'] = 'รูปแบบที่ 1';
$spaw_dropdown_data['style']['style2'] = 'รูปแบบที่ 2';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Solmetra SPAW Editor usage demonstration page</title>
</head>
<body>
<style type="text/css">
  pre {
    background : #cccccc; 
    padding : 5 5 5 5;
  }
</style>
<p>&nbsp;</p>
<!--<form name="spawdemo" method="post" action="<?=$_SERVER["PHP_SELF"];?>">-->
<form name="spawdemo" method="post" action="test2.php">
  <hr width="100%" size="1">
  <h2>ทดสอบการใช้งาน Spaw_Editor</h2>

<?php 
$sw = new SPAW_Wysiwyg('spaw2' /*name*/,stripslashes($HTTP_POST_VARS['spaw2']) /*value*/,
                       'en' /*language*/, 'sidetable' /*toolbar mode*/, 'default' /*theme*/,
                       '550px' /*width*/, '350px' /*height*/);
$sw->show();
?>
<input type="submit" value="บันทึกข้อมูลทั้งหมด">

</form>
</body>
</html>