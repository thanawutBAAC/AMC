<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: ระบบฐานข้อมูล สกต. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>

<?
$con = msssql_connect("../lib/ms_database.php");
if (!$con)   {
						 die('ติดต่อฐานข้อมูลไม่ได้: ' . msssql_error());
					}
					msssql_select_db("my_data", $con);

$sql= mssql_query ( "INSERT INTO AMC(AMCCode,AMCProvince,AMCName,AMCAddress,AMCTel,AMCFax,AMCWan,AMCRegisDate,AMCUpdate,AMCPosition_1,AMCPosition_1_Name,AMCPosition_1_Tel,AMCPosition_2,AMCPosition_2_Name,AMCPosition_2_Tel) 
VALUES($_POST["AMCCode"];$_POST["AMCProvince"];$_POST["AMCName"];$_POST["AMCAddress"];$_POST["AMCTel"];$_POST["AMCFax"];$_POST["AMCWan"];$_POST["AMCRegisDate"];$_POST["AMCUpdate"];$_POST["AMCPosition_1"];$_POST["AMCPosition_1_Name"];$_POST["AMCPosition_1_Tel"];$_POST["AMCPosition_2"];$_POST["AMCPosition_2_Name"];$_POST["AMCPosition_2_Tel"]; )";)
		 
if (!mssql_query($sql,$con)   {
   die('Error: ' . msssql_error());
}
else  {
   echo "ป้อนสำเร็จ!";
} 

	
?>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="328" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="96" align="right" background="images/bg_head.gif"><img src="images/header_1.jpg" width="320" height="96"><img src="images/header_2.jpg" width="320" height="96"><img src="images/header_3.jpg" width="325" height="96"></td>
        </tr>
        <tr>
          <td align="center" valign="top"><table width="80%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="40" valign="bottom"><img src="images/head_general.jpg" width="223" height="23"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><form name="form1" method="post" action="">
                    <table width="500" border="0" cellpadding="0" cellspacing="0" class="txtmicrosoftsan10px">
                      <tr> 
                        <td width="120" height="25">&nbsp;</td>
                        <td width="100">&nbsp;</td>
                        <td width="150">&nbsp;</td>
                        <td width="130">&nbsp; </td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">เลขทะเบียน สกต.</td>
                        <td class="txtwhite"><input type="text" name="amccode"></td>
                        <td width="170" align="left" class="boxleft15"><span class="txtwhite">วันที่จดทะเบียน</span></td>
                        <td><input name="txt_date_start" type="text" id="txt_date_start" size="10" maxlength="10" readonly="">
                          <img src="images/calendar.jpg" alt=".เลือกวันที่." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ที่ตั้ง สกต.</td>
                        <td colspan="3" class="txtwhite"><textarea name="amcaddress" class="areabox80x200"></textarea></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">หมายเลขโทรศัพท์</td>
                        <td class="txtwhite"><input name="amcphone" type="text" class="textbox30" maxlength="10"  ></td>
                        <td class="boxleft15"><span class="txtwhite">หมายเลข wan</span></td>
                        <td><input name="amcwan" type="text" class="textbox40" ></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">Fax.</td>
                        <td class="txtwhite"><input name="amcfax" type="text" class="textbox30" maxlength="9" ></td>
                        <td class="txtwhite">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="15" class="txtwhite">&nbsp;</td>
                        <td class="txtwhite">&nbsp;</td>
                        <td class="txtwhite">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr bgcolor="#CCCCCC"> 
                        <td height="1" class="txtwhite"> </td>
                        <td class="txtwhite"> </td>
                        <td class="txtwhite"> </td>
                        <td> </td>
                      </tr>
                      <tr> 
                        <td height="15" class="txtwhite">&nbsp;</td>
                        <td class="txtwhite">&nbsp;</td>
                        <td class="txtwhite">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ชื่อ-สกุล ผู้แดแล</td>
                        <td class="txtwhite"><input type="text" name="textfield5"></td>
						<!-- <td align="left" class="boxleft15"><span class="txtwhite">นามสกุล</span></td>
                        <td><input type="text" name="textfield52" value="<?=$rs["AMCPosition_1_Name"]?>"></td> -->
					
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ตำแหน่ง</td>
                        <td class="txtwhite"><input type="text" name="textfield6" ></td>
                        <td align="left" class="boxleft15"><span class="txtwhite">หมายเลขโทรศัพท์</span></td>
                        <td><input name="textfield72" type="text" class="textbox30" maxlength="10" ></td>
                      </tr>
                      <tr> 
                        <td height="15" class="txtwhite"></td>
                        <td class="txtwhite">&nbsp;</td>
                        <td align="left" class="boxleft15">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ชื่อ- สกุล ผู้แดแลแทน</td>
                        <td class="txtwhite"><input type="text" name="textfield5" ></td>
                        <td align="left" class="boxleft15"><span class="txtwhite"></span></td>
                        <td></td>
			
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ตำแหน่ง</td>
                        <td class="txtwhite"><input type="text" name="textfield6" ></td>
                        <td align="left" class="boxleft15"><span class="txtwhite"">หมายเลขโทรศัพท์</span></td>
                        <td><input name="textfield72" type="text" class="textbox30" maxlength="10"></td>
                      </tr>
                      <tr> 
                        <td height="60">&nbsp;</td>
                        <td height="50" colspan="2" align="center" valign="bottom"><input type="submit" name="Submit" value="จัดเก็บข้อมูล"> 
                          <input name="reset" type="reset" id="reset" value="เคลีย์ค่าในฟอร์ม"></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </9/7/2551></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
