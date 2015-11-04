<? include ("checkuser.php");?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<link href=".inputtype_personal" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="bodyOnLoad();">
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>
<script language="javascript">

function checkID(id) {
    if(id.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)

        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
    return true;
}

</script>
<script language="javascript" type="text/javascript">
<!--
function verify(frm) {

	    if(!checkID(document.form1.txt_user_id.value))
       {
	   			alert('ตรวจสอบรหัสประชาชนให้ถูกต้อง'); frm.txt_user_id.focus(); return false;
		}
	with( frm )
	 {
		if(frm.txt_name.value == "" ) { alert("ตรวจสอบชื่อให้ถูกต้อง"); frm.txt_name.focus(); return; }
		if(frm.txt_lsname.value == "" ) { alert("ตรวจสอบนามสกุลให้ถูกต้อง"); frm.txt_lsname.focus(); return; }
		if(frm.txt_birthday.value == "" ) { alert("ตรวจสอบ วัน/เดือน/ปีเกิด ให้ถูกต้อง"); frm.txt_birthday.focus(); return ; } 
		if(frm.txt_phone.value.length =="" ) { alert("ระบุรหัสหายเลขโทรศัพท์ให้ถูกต้อง"); frm.txt_phone.focus(); return; }

		} // whith
		frm.submit()

}

function bodyOnLoad() {
	document.forms[0].list_degree.disabled=true;
}

function chkEdu(x){
	if(x<"3"){
		document.forms[0].list_degree.disabled=true;
	}else{
		document.forms[0].list_degree.disabled=false;
	}
}
//-->
</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_personnel.gif" width="289" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");
				$Year=(date('Y')+543);
		  		if($username!="" && $password!="")
				{
					echo $login_user;
			?>
            <a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a> 
            <?
				}	
			?>
            </span></span></td>
        </tr>
        <tr> 
          <td height="40" colspan="2" align="center" valign="middle">
		  </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="personnel_insertinto.php" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=3 align=left><b>&nbsp; &nbsp;บันทึกข้อมูลบุคลากร 
                          (พนักงาน) </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" class="boxleft30"> <? echo '- สกต. จังหวัด '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">ตำแหน่ง 
                          : </td>
                        <td align="left" class="boxleft5"> 
                          <?
							
							$sql="SELECT PersonnelType, PersonnelName ";
							$sql.=" FROM PersonnelCode ";
							$sql.=" WHERE PersonnelType ";
							$sql.=" NOT IN (SELECT PersonnelType FROM PersonnelGroup WHERE AMCCode='$amc' AND PersonnelType Between '01' AND '05' AND PersonnelYear='$Year') ";
							$sql.=" ORDER BY PersonnelType ";
							$exsql=mssql_query($sql);
							//echo $sql;
							echo '<select name="list_positions" >';
								while($rowall=mssql_fetch_row($exsql)) 
										{	
											echo '<option value='.$rowall[0].'>'.$rowall[1].'</option>';
										}
							echo '</select>';
						?>
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">2. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">หมายเลขบัตรประจำตัวประชาชน 
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><input name="txt_user_id" type="text" class="inputtypePersonnel" size="13" maxlength="13" onChange="chkDigitPin(this.value);" onkeyup="doUnback_id(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">3. </td>
                        <td height="20" align="left" class="boxleft5">ชื่อ : </td>
                        <td align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel" onkeyup="doUnback(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">นามสกุล 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" onkeyup="doUnback_lsname(value)"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>5.</td>
                        <td height="20" align="left" class="boxleft5">วัน/เดือน/ปีเกิด 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_birthday" type="text" id="birthday" size="10" maxlength="10" readonly="" class="inputtypePersonnel"> 
                          <img src="images/calendar_02.gif" alt=".เลือกวันที่." width="14" height="16" align="absmiddle" onclick=" return showCalendar('birthday','dd-mm-y');" onmouseover="this.style.cursor='hand'"; > 
                          &lt;&lt; เลือกวันที่</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6. </td>
                        <td height="20" align="left" class="boxleft5">ปีที่เข้าทำงาน 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_working">
                            <?
									  $date=getdate(); // อ่านวันที่ของเครื่องเก็บที่ตังวแปร $date
									  $year=$date[year]+543; //แปลง ค.ศ ของเครื่องให้เป็น พ.ศ เก็บไว้ที่ตัวแปร $year
									  for ($x=$year;$x>=2530;$x--)  // วนลูปปี พ.ศ ปัจจุบันย้นไป 5 ปี
										echo '<option value='.$x.'>'.$x.'</option>';
								  ?>
                            <script language=JAVAScript> 
														for(i=0;i<=(document.form1.list_working.length-1);i++) {
															if(document.form1.list_working.options[i].value=="<?echo $rowall[7]?>") {
																document.form1.list_working.options[i].selected = true;
																break;
															}
														}
									</script>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">การศึกษา 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_education"  onChange="chkEdu(this.value);">
                            <option value="1">ไม่เกินประถมหรือเทียบเท่า</option>
                            <option value="2">มัธยมศึกษา</option>
                            <option value="3">อนุปริญญา</option>
                            <option value="4">ปริญญาตรี</option>
                            <option value="5">สูงกว่าปริญญาตรี</option>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=left> &nbsp;&nbsp;&nbsp;7.1</td>
                        <td height="20" align="left" class="boxleft5">วุฒิการศึกษา 
                          : </td>
                        <td align="left" class="boxleft5"><select name="list_degree" >
                            <option value="1">การตลาด</option>
                            <option value="2">บัญชี</option>
                            <option value="3">บริหารและการจัดการ</option>
                            <option value="4">เกษตรศาสตร์</option>
                            <option value="5">สังคมศาสตร์</option>
                            <option value="6">อื่นๆ</option>
                          </select></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">หมายเลขโทรศัพท์ 
                          : </td>
                        <td align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" size="10" maxlength="10" onkeyup="doUnback_phone(value)"></td>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>9.</td>
                        <td height="20" align="left" class="boxleft5">ที่อยู่ 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_address" class="areabox150"></textarea></td>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="20" align=center>10.</td>
                        <td height="20" align="left" class="boxleft5">หมายเหตุ 
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"></textarea></td>
                    </table>
					
                    <br>
                    <input name="Submit2" type="button" class="formButton" value=" Back "onClick="jascript:history.go(-1)"  onMouseOver="this.style.cursor='hand'" >
                    &nbsp; 
                    <input name="Submit" type="button" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'"onClick="onClick=verify(this.form)" >
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset" onMouseOver="this.style.cursor='hand'">
                  </form>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
