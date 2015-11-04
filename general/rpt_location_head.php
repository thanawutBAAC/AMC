<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><img src="images/head_amc.jpg" width="237" height="24"><br>
      <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
        <tr> 
          <td width="70" bgcolor="#DEEFBF">&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F0F8FF">
              <tr> 
                <td width="14%">ระบุที่อยู่</td>
                <td width="26%"><input name="textfield" type="text" class="AssetType"></td>
                <td width="13%">เลือกฝ่ายกิจการสาขา</td>
                <td width="47%"><select name="province" onChange="javascript:listBrn(this.value);setComboBox(2,this.value);">
                    <option value="0">--สำนักงานจังหวัด--</option>
                  </select></td>
              </tr>
              <tr> 
                <td>เลขทะเบียน สกต.</td>
                <td><input name="textfield2" type="text" class="AssetType2"></td>
                <td>เลือกจังหวัด</td>
                <td><select name="branch" onChange="javascript:listAmp(this.value);setComboBox(3,this.value);">
                    <option value="0">--สาขา--</option>
                  </select></td>
              </tr>
              <tr> 
                <td>เบอร์โทรศัพท์</td>
                <td><input name="textfield3" type="text" class="AssetType2"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>เบอร์ FAX.</td>
                <td><input name="textfield4" type="text" class="AssetType2"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          <td width="70" align="center" bgcolor="#FBA404"><INPUT name="submit22" TYPE="submit" class="formButton" value="Submit"></td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
</body>
</html>
