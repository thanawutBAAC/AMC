<html>
<head>
<title>Calendar Example</title>
<link href="style/style_calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript"  type="text/javascript" src="lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="lib/calendar-th.js"></script>
</head>
<body>
<table width="100%" cellpadding="2" cellspacing="1" bordercolor="">
<form name="form1" method="post" action="" target="">
<tr bgcolor="">
<td align="right" valign="middle"> ระบุวันที่ : </td>
<td align="left"><input name="txt_date_start" type="text" id="txt_date_start" value="" size="10" maxlength="10" readonly=""><img src="images/calendar.jpg" alt=".เลือกวันที่." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></td>
</tr>
</form>
</table>
</body>
</html>