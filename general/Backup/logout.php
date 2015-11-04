<?php
session_start();
echo '<body background="images/bg.jpg">';
session_unset();
session_destroy();
print '<script>window.top.location.href = "index.php";</script>';
//echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=welcome.php">';

?>
