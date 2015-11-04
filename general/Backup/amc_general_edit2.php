<? include ("checkuser.php");?><?


	echo ("Test !!!! ")

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
        include("images/lib/ms_database.php");
//	include("function.php");
		
/*	$AMCCode=$_POST["AMCCode"];
	$AMCProvince=$_POST["AMCProvince"];
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

/*if ($flag == "UPD"){
		$AMCcode ='ก003838'; 
*/

		/*$sql =  " Update AMC set ";
		$sql.=" AMCProvince='$AMCProvince',  ";
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
		$sql.= " Where AMCCode = '$amc' ";*/

	/*	$result_query = @mysql_query($query, $connect) or die(',Query failed: ' . mysql_error());*/

		$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where AMCCode = '$amc' ";

//		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
//		$rs = mssql_fetch_assoc($result);

		$result1 = mssql_query($sql) or die('Query failed: ' . mssql_error());
		$rs1 = mssql_fetch_assoc($result1);
?>

<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="form1" method="post" action="amc_general_edit_save.php" >
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
    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=3 align=left><b>&nbsp; &nbsp;ข้อมูลทั่วไป 
                          </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" class="boxleft30">
						<? echo '- สกต. จังหวัด '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">เลขทะเบียน สกต.
                          : </td>
                        <td align="left" class="boxleft5">
							<input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>">
						</td>
                      </tr>
						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>2.</td>
                        <td height="20" align="left" class="boxleft5">วันที่จดทะเบียน
                          : </td>
                        <td align="left" class="boxleft5"><input name="AMCRegisDate" type="text" id="txt_date_start" value="<?=$rs["AMCRegisDate"]?>" size="10" maxlength="10" readonly="">
                          <img src="images/calendar_02.gif" alt=".เลือกวันที่." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; >
                          &lt;&lt; 
                          เลือกวันที่</td>
                      </tr>
<!-- 						
						<td width="170" align="left" class="boxleft15"><span class="txtwhite">วันที่จดทะเบียน</span></td>
                        <td><input name="AMCRegisDate" type="text" id="txt_date_start" value="<?=$rs["AMCRegisDate"]?>" size="10" maxlength="10" readonly="">
                          <img src="images/calendar.jpg" alt=".เลือกวันที่." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></td> -->


						 <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
						<td height="20" align=center>3.</td>
                        <td height="20" align="left" class="boxleft5">ที่ตั้ง สกต.
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="amcaddress" class="areabox80x200"><?=$rs["AMCAddress"]?></textarea></td>
						</tr>

<!-- 						<tr> 
                        <td height="30" class="txtwhite">ที่ตั้ง สกต.</td>
                        <td colspan="3" class="txtwhite"><textarea name="amcaddress" class="areabox80x200"><?=$rs["AMCAddress"]?></textarea></td>
                      </tr> -->

						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">หมายเลขโทรศัพท์ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="amctel" type="text" class="textbox30" maxlength="10"  value="<?=$rs["AMCTel"]?>"></td></tr>

				<!-- 		<td height="30" class="txtwhite">หมายเลขโทรศัพท์</td>
                        <td class="txtwhite"><input name="amctel" type="text" class="textbox30" maxlength="10"  value="<?=$rs["AMCTel"]?>"></td> -->


                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">5. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">หมายเลข wan
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><input name="amcwan" type="text" class="textbox40" value="<?=$rs["AMCWan"]?>"></td>
                      </tr>
					<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">6. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">Fax.
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><input name="amcfax" type="text" class="textbox30" maxlength="9" value="<?=$rs["AMCFax"]?>"></td>
                      </tr>
					  <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">7. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">Internet ของ สกต.
                          : </td>
                        <td width="69%" align="left" class="boxleft5">
								<input type="radio" name="AMCNET"  value="1"<? if($AMCNET=="1"){ echo "checked";}?>> 
								<? if($AMCNET=="1"){echo"<span class='txtgreen'>";}?>
								<? if($AMCNET=="1"){$green="</span>";}?>
								มี <? echo $green;?>
								<input type="radio" name="AMCNET"  value="0" <? if($AMCNET<>"1"){echo "checked";}?>> 
								<? if($AMCNET<>"1"){echo"<span class='txtred'>";}?>
								<? if($AMCNET<>"1"){$red="</span>";}?>
								ไม่มี<?echo $red;?>
						</td>
                      </tr>

						<tr align=center bgcolor="#BBD0E1" style="color:#BBD0E1;">
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center rowspan="3">8. </td>
                        <td height="20" align="left" class="boxleft5">ชื่อ-สกุล ผู้ดูแล : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_1_Name" value="<?=$rs["AMCPosition_1_Name"]?>"></td>
                      </tr>
  
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                       <!--  <td height="20" align=center >8. </td> -->
                        <td height="20" align="left" class="boxleft5">ตำแหน่ง : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_1" value="<?=$rs["AMCPosition_1"]?>"></td>
                      </tr>

					<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                      <!--   <td height="20" align=center>9.</td> -->
                        <td height="20" align="left" class="boxleft5">หมายเลขโทรศัพท์ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="AMCPosition_1_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_1_Tel"]?>"></td></tr>
						</tr>

						<tr>
						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center rowspan="3">9. </td>
                        <td height="20" align="left" class="boxleft5" rowspan="3">ชื่อ-สกุล ผู้ดูแลแทน :<br> <br>ตำแหน่ง :<br><br>หมายเลขโทรศัพท์ : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_2_Name" value="<?=$rs["AMCPosition_2_Name"]?>"><br><input type="text" name="AMCPosition_2" value="<?=$rs["AMCPosition_2"]?>"><br><input name="AMCPosition_2_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_2_Tel"]?>"></td>
                      </tr>
  
						</tr>
                    </table>
					<br>
							<input type="submit" name="Submit" value="จัดเก็บข้อมูล" onSubmit="btnSaveOnClick();return false;"> 
							<input name="reset" type="submit" id="reset" value="ค่าเริ่มต้น">
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
</body>
</html>

