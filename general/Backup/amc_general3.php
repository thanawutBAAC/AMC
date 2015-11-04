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

	//session_start();
        include("images/lib/ms_database.php");
//	include("function.php");

	$AMCCode=$_POST["AMCCode"];
	$AMCProvince=$_POST["AMCProvince"];
	$AMCName=$_POST["AMCName"];
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

/*if ($flag == "UPD"){
		$AMCcode ='ก003838'; 
*/

	/*	$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where amccode='$username' "; */

				$sql="SELECT * ";
				$sql.=" FROM AMC ";
				$sql.= " Where amccode='a010203' "; 
	//			$sql.=" WHERE AMCCode='$user' AND AMCPassword='$password'";
	/*			$exsql=mssql_query($sql);
				$data=mssql_fetch_array($exsql);
				$amc=$data[0];
				$province=$data[1];
				$amcname=$data[2];
				$numrow=mssql_num_rows($exsql);*/

				$sql="UPDATE AMC ";
				$sql.="SET AMCProvince='$AMCProvince',  ";
				$sql.=" AMCName='$AMCName',  ";
				$sql.=" AMCAddress='$AMCAddress',  ";
				$sql.=" AMCTel='$AMCTel',  ";
				$sql.=" AMCFax='$AMCFax',  ";
				$sql.=" AMCWan='$AMCWan',  ";
				$sql.=" AMCRegisDate='$AMCRegisDate',  ";
				$sql.=" AMCUpdate='$AMCUpdate',  ";
				$sql.=" AMCPosition_1='$AMCPosition_1',  ";
				$sql.=" AMCPosition_1_Name='$AMCPosition_1_Name',  ";
				$sql.=" 	AMCPosition_1_Tel='$AMCPosition_1_Tel',  ";
				$sql.=" AMCPosition_2='$AMCPosition_2',  ";
				$sql.=" AMCPosition_2_Name='$AMCPosition_2_Name',  ";
				$sql.=" AMCPosition_2_Tel='$AMCPosition_2_Tel'  ";
				$sql.= " Where amccode='a010203' "; 

//				UPDATE AMC 
//SET AMCPosition_2='??.???.', 
//AMCPosition_2_Name='???A ???Z', 
//AMCPosition_2_Tel='021234567' 
//WHERE AMCCode='a010203' ;


		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
		$rs = mssql_fetch_assoc($result);

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
                        <td class="txtwhite"><input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>"></td>
                        <td width="170" align="left" class="boxleft15"><span class="txtwhite">วันที่จดทะเบียน</span></td>
                        <td><input name="txt_date_start" type="text" id="txt_date_start" value="<?=$rs["AMCRegisDate"]?>" size="10" maxlength="10" readonly="">
                          <img src="images/calendar.jpg" alt=".เลือกวันที่." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ที่ตั้ง สกต.</td>
                        <td colspan="3" class="txtwhite"><textarea name="amcaddress" class="areabox80x200"><?=$rs["AMCAddress"]?></textarea></td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">หมายเลขโทรศัพท์</td>
                        <td class="txtwhite"><input name="amcphone" type="text" class="textbox30" maxlength="10"  value="<?=$rs["AMCTel"]?>"></td>
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
                        <td height="30" class="txtwhite">ชื่อ-สกุล ผู้แดแล</td>
                        <td class="txtwhite"><input type="text" name="textfield5" value="<?=$rs["AMCPosition_1_Name"]?>"></td>
						<!-- <td align="left" class="boxleft15"><span class="txtwhite">นามสกุล</span></td>
                        <td><input type="text" name="textfield52" value="<?=$rs["AMCPosition_1_Name"]?>"></td> -->
					
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ตำแหน่ง</td>
                        <td class="txtwhite"><input type="text" name="textfield6" value="<?=$rs["AMCPosition_1"]?>"></td>
                        <td align="left" class="boxleft15"><span class="txtwhite">หมายเลขโทรศัพท์</span></td>
                        <td><input name="textfield72" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_1_Tel"]?>"></td>
                      </tr>
                      <tr> 
                        <td height="15" class="txtwhite"></td>
                        <td class="txtwhite">&nbsp;</td>
                        <td align="left" class="boxleft15">&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ชื่อ- สกุล ผู้แดแลแทน</td>
                        <td class="txtwhite"><input type="text" name="textfield5" value="<?=$rs["AMCPosition_2_Name"]?>"></td>
                        <td align="left" class="boxleft15"><span class="txtwhite"></span></td>
                        <td></td>
			
                      </tr>
                      <tr> 
                        <td height="30" class="txtwhite">ตำแหน่ง</td>
                        <td class="txtwhite"><input type="text" name="textfield6" value="<?=$rs["AMCPosition_2"]?>"></td>
                        <td align="left" class="boxleft15"><span class="txtwhite"">หมายเลขโทรศัพท์</span></td>
                        <td><input name="textfield72" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_2_Tel"]?>"></td>
                      </tr>
                      <tr> 
                                <td height="60">&nbsp;</td>
                        <td height="50" colspan="4" align="center" valign="bottom">
						<!-- 	<input name="add" type="submit" id="add" value="เพิ่มข้อมมูล"> -->
							<input name="edit" type="submit" id="edit" value="แก้ไข">
							<input type="submit" name="Submit" value="จัดเก็บข้อมูล"> 
							<!-- <input name="Reset" type="reset" id="Reset" value="เคลีย์ค่าในฟอร์ม"> -->
							<input type="reset" name="Submit2" value="ค่าเริ่มต้น">
							<input name="ok" type="hidden" id="ok" value="ok_pass">
						 </td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
