


<? include ("checkuser.php");?>


	$flag=$_GET["flag"];

/*	// echo $flag;
	switch ($flag){
		case 'READ':
			ChkPermission(1);
			break;
		case 'NEW':
			ChkPermission(2);
			break;
		case 'EDIT':
			ChkPermission(3);
			break;
	//	case 'DEL':
	//		ChkPermission(4);
	//		break;
		default://ไม่ใช่อะไรเลยให้อ่านได้อย่างเดียว
			ChkPermission(1);
			break;
	}*/

/*	$AMCCode=$_POST["AMCCode"];
//	$AMCProvince=$_POST["AMCProvince"];
//$AMCName=$_POST["AMCName"];
	$AMCAddress=$_POST["AMCAddress"];
	$AMCTel=$_POST["AMCTel"];
	$AMCFax=$_POST["AMCFax"];
	$AMCWan=$_POST["AMCWan"];
	$AMCRegisDate=$_POST["AMCRegisDate"];
	$AMCUpdate=$_POST["AMCUpdate"];
	$AMCPosition_1=$_POST["AMCPosition_1"];
	$AMCPosition_1_Name=$_POST["AMCPosition_1_Name"];
	$AMCPosition_1_Tel=$_POST["AMCPosition_1_Tel"];
	$AMCPosition_2=$_POST["AMCPosition_2"];
	$AMCPosition_2_Name=$_POST["AMCPosition_2_Name"];
	$AMCPosition_2_Tel=$_POST["AMCPosition_2_Tel"];
	$AMCNet=$_POST["AMCNet"];
	$AMCNetRemark=$_POST["AMCNetRemark"];
*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: ระบบฐานข้อมูล สกต. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<?

	//session_start();
        include("../lib/ms_database.php");
//	include("function.php");



/*if ($flag == "UPD"){
		$AMCcode ='ก003838'; 
*/

		$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where AMCCode = '$amc' ";

		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
		if(mssql_num_rows($result)==0){
			$flag = "NEW";
		}else{
			$flag = "EDIT";
//			document.form1.amccode.disabled= true;
		}
		$rs = mssql_fetch_assoc($result);
		

/*if (rs.EOF)  {
			echo ("amc_general_add.php");
		}

	else	if (action == "edit")  {
			echo("amc_general_edit.php");
		}*/

/*} catch(Exception $e) {
	echo 'ERROR : ' .$e->getMessage();
}
	*/
#	echo $sql;

		#$result = show_data("AMC");

?>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="checkForm" method="post" action="amc_general_save.php" onsubmit="return check2();" >
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
                <td align="center" valign="top">
                    <table width="500" border="0" cellpadding="0" cellspacing="0" class="txtmicrosoftsan10px">
                      <tr> 
                        <td width="120" height="25">&nbsp;</td>
                        <td width="100">&nbsp;</td>
                        <td width="150">&nbsp;</td>
                        <td width="130">&nbsp; </td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">เลขทะเบียน สกต.</td>
                        <td class="txtwhite"><input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>"></td>
                        <td width="170" align="left" class="boxleft15"><span class="txtwhite">วันที่จดทะเบียน</span></td>
                        <td><input name="AMCRegisDate" type="text" id="txt_date_start" value="<?=$rs["AMCRegisDate"]?>" size="10" maxlength="10" readonly="">
                          <img src="images/calendar.jpg" alt=".เลือกวันที่." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ที่ตั้ง สกต.</td>
                        <td colspan="3" class="txtwhite"><textarea name="amcaddress" class="areabox80x200"><?=$rs["AMCAddress"]?></textarea></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">หมายเลขโทรศัพท์</td>
                        <td class="txtwhite"><input name="amctel" type="text" class="textbox30" maxlength="10"  value="<?=$rs["AMCTel"]?>"></td>
                        <td class="boxleft15"><span class="txtwhite">หมายเลข wan</span></td>
                        <td><input name="amcwan" type="text" class="textbox40" value="<?=$rs["AMCWan"]?>"></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">Fax.</td>
                        <td class="txtwhite"><input name="amcfax" type="text" class="textbox30" maxlength="9" value="<?=$rs["AMCFax"]?>"></td>
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
                        <td height="30" class="txtwhite">ชื่อ-สกุล ผู้ดูแล</td>
                        <td class="txtwhite"><input type="text" name="AMCPosition_1_Name" value="<?=$rs["AMCPosition_1_Name"]?>"></td>
						<!-- <td align="left" class="boxleft15"><span class="txtwhite">นามสกุล</span></td>
                        <td><input type="text" name="textfield52" value="<?=$rs["AMCPosition_1_Name"]?>"></td> -->
					
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ตำแหน่ง</td>
                        <td class="txtwhite"><input type="text" name="AMCPosition_1" value="<?=$rs["AMCPosition_1"]?>"></td>
                        <td align="left" class="boxleft15"><span class="txtwhite">หมายเลขโทรศัพท์</span></td>
                        <td><input name="AMCPosition_1_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_1_Tel"]?>"></td>
                      </tr>
                      <tr> 
                        <td height="15" class="txtwhite"></td>
                        <td class="txtwhite">&nbsp;</td>
                        <td align="left" class="boxleft15">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ชื่อ- สกุล ผู้ดูแลแทน</td>
                        <td class="txtwhite"><input type="text" name="AMCPosition_2_Name" value="<?=$rs["AMCPosition_2_Name"]?>"></td>
                        <td align="left" class="boxleft15"><span class="txtwhite"></span></td>
                        <td></td>
			
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ตำแหน่ง</td>
                        <td class="txtwhite"><input type="text" name="AMCPosition_2" value="<?=$rs["AMCPosition_2"]?>"></td>
                        <td align="left" class="boxleft15"><span class="txtwhite"">หมายเลขโทรศัพท์</span></td>
                        <td><input name="AMCPosition_2_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_2_Tel"]?>"></td>
                      </tr>
                      <tr> 
                        <td height="60">&nbsp;</td>
                        <td height="50" colspan="2" align="center" valign="bottom">
							<!-- <input name="add" type="submit" id="add" value="เพิ่มข้อมมูล"> -->
							<!-- <input name="edit" type="submit" id="edit" value="แก้ไข"> -->
							 <input name="flag" type="hidden" id="flag" value="<?=$flag?>">
							<input type="submit" name="Submit"  value="บันทึกข้อมูล">
							<input name="reset" type="reset" id="reset" value="ค่าเริ่มต้น">
						</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>

<script language="javascript">

function check2() {
if(document.checkForm.amccode.value=="") {
alert(" กรุณากรอกเลขทะเบียน สกต.") ;
document.checkForm.amccode.focus() ;
return false ;
}
else if(document.checkForm.AMCRegisDate.value=="") {
alert(" กรุณาเลือกวันที่จดทะเบียน ") ;
document.checkForm.AMCRegisDate.focus() ;
return false ;
}
else if(document.checkForm.amcaddress.value=="") {
alert(" กรุณากรอกที่ตั้ง สกต. ") ;
document.checkForm.amcaddress.focus() ;
return false ;
}
else if(document.checkForm.amctel.value=="") {
alert(" กรุณากรอกหมายเลขโทรศัพท์ของ สกต. ") ;
document.checkForm.amctel.focus() ;
return false ;
}
/*else if(document.checkForm.amcwan.value=="") {
alert(" กรุณากรอกหมายเลข wan") ;
document.checkForm.amcwan.focus() ;
return false ;
}
else if(document.checkForm.amcfax.value=="") {
alert(" กรุณากรอกหมายเลข Fax. ") ;
document.checkForm.amcfax.focus() ;
return false ;
}
else if(document.checkForm.AMCPosition_1_Name.value=="") {
alert("กรุณาระบุ ชื่อ-สกุล ผู้ดูแล") ;
document.checkForm.AMCPosition_1_Name.focus() ;
return false ;
}
else if(document.checkForm.AMCPosition_1.value=="") {
alert("กรุณาระบุตำแหน่งของผู้ดูแล") ;
document.checkForm.AMCPosition_1.focus() ;
return false ;
}
else if(document.checkForm.AMCPosition_1_Tel.value=="") {
alert("กรุณาระบุหมายเลขโทรศัพท์ของผู้ดูแล") ;
document.checkForm.AMCPosition_1_Tel.focus() ;
return false ;
}*/
else 
return true ;
}

</script>
</form>
</body>
</html>
