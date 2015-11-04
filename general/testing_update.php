<?include ("checkuser.php");?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<link href=".inputtype_personal" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
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

 function check_number() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if (e_k != 13 && (e_k < 48) || (e_k > 57)) {
event.returnValue = false;
alert("รับค่าเป็นตัวเลขเท่านั้น");
}
}
</script>
<script language="javascript" type="text/javascript">
<!--
function verify(frm) {

	with( frm )
	 {
		if(frm.txt_eduname.value == "" ) { alert("ใส่ชื่อหลักสูตร"); frm.txt_eduname.focus(); return; }
		if(frm.txt_unit.value == "" ) { alert("ใส่ชื่อหน่วยงานที่จัดอบรม"); frm.txt_unit.focus(); return; }
		if(frm.txt_datetotal.value == "" ) { alert("ใส่จำนวนวันในการอบรม"); frm.txt_datetotal.focus(); return ; } 
		} // whith
		frm.submit()
}

//-->
</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><br><br>
			<?
						if($type=="personnel"){echo '<img src="images/trainning_personnel.gif" width="204" height="22">';} 
						if($type=="committee"){echo '<img src="images/trainning_committee.gif" width="238" height="20">';}
			?>
          </td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr> 
          <td height="40" colspan="2" align="center" valign="middle">
		  </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="testing_updatedata.php" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=4 align=left><b>&nbsp; &nbsp;บันทึกข้อมูลการฝึกอบรม <span class="txtred"><u><?if($type=="personel"){echo "เจ้าหน้าที่";} if($type=="committee"){echo "คณะกรรมการ";}?></u></span></b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="4" class="boxleft30">&nbsp; เพิ่มข้อมูลการฝึกอบรมของ สกต.</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">ตำแหน่ง 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_user_position" type="text" class="inputtypePersonnel" id="txt_user_position" onChange="chkDigitPin(this.value);" onKeyUp="doUnback_id(value)" value="<?echo $position?>" size="13" maxlength="13" readonly ="true"/> 
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">2. 
                        </td>
                        <td width="27%" height="20" align="left" class="boxleft5">หมายเลขบัตรประจำตัวประชาชน 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_user_id" type="text" class="inputtypePersonnel" onChange="chkDigitPin(this.value);" onkeyup="doUnback_id(value)" value="<?echo $USER_ID;?>" size="13" maxlength="13" readonly ="true"/></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F0F0F0">3. </td>
                        <td height="20" align="left" class="boxleft5">ชื่อ : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel" onkeyup="doUnback(value)" value="<?echo $name?>" readonly ="true"/></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">นามสกุล 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel" onkeyup="doUnback_lsname(value)" value="<?echo $lastname;?>" readonly ="true"/>
						<?
							include("../lib/ms_database.php");
								$sql="SELECT * FROM AMCTest WHERE CustomerID='$USER_ID' AND TestID='$TestID' AND TestEduName='$TestEduName' ";
								$exsql=mssql_query($sql);
								$data=mssql_fetch_array($exsql);
								
								$sdate=substr($data[TestStart],6);
								$smonth=substr($data[TestStart],4,2);
								$syear=substr($data[TestStart],0,4);
								$edate=substr($data[TestEnd],6);
								$emonth=substr($data[TestEnd],4,2);
								$eyear=substr($data[TestEnd],0,4);
				/*				echo $edate;
								echo'<br>'.$emonth;
								echo '<br>'.$eyear;
				*/			
						?>
						</td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>5.</td>
                        <td height="20" align="left" class="boxleft5">หมวดวิชาที่อบรม 
                          : </td>
                        <td colspan="2" align="left" class="boxleft5"><select name="education">
                            <?
							$sql="select *
							from AMCTest
							WHERE  CustomerID='$USER_ID' AND TestID='$TestID' AND TestEduName='$TestEduName'AND TestStart='$TestStart'";
							$sqledu="SELECT * FROM AMCTestEdu ";
							$exsqledu=mssql_query($sqledu);
							while($rowedu=mssql_fetch_array($exsqledu))
								{
									echo '<option value='.$rowedu[TestID].'>'.$rowedu[TestName].'</option>';
								}
						?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.education.length-1);i++) {
									if(document.form1.education.options[i].value=="<?echo $data[TestID]?>") {
										document.form1.education.options[i].selected = true;
										break;
									}
								}
							</script>
                          <input type="hidden" name="USER_ID" value="<?echo $USER_ID?>">
                          <input type="hidden" name="CustomerType" value="<?if($type=="committee"){echo "1";} if($type=="personel"){echo "2";}?>">
                          <input type="hidden" name="Position" value="<?echo $position?>">
                          <input type="hidden" name="edutest" value="<?echo $data[TestEduName]?>">
                          <input type="hidden" name="start" value="<?echo $data[TestStart]?>">
                          <input type="hidden" name="type" value="<?echo $type?>"> 
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>6.</td>
                        <td height="20" align="left" class="boxleft5">ชื่อหลักสูตร</td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_eduname" type="text" class="inputtypePersonnel" id="txt_eduname" value="<?echo $data[TestEduName]?>"></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>7.</td>
                        <td height="20" align="left" class="boxleft5">หน่วยงานที่จัดอบรม</td>
                        <td colspan="2" align="left" class="boxleft5"><input name="txt_unit" type="text" class="inputtypePersonnel" id="txt_unit" value="<?echo $data[TestUnit]?>" >
                        </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>8.</td>
                        <td height="20" align="left" class="boxleft5">ระยะเวลาในการอบรม</td>
                        <td width="9%" align="left" class="boxleft5">จากวันที่ 
                        </td>
                        <td width="60%" align="left" class="boxleft5"><select name="startdate" class="datetime">
                            <?
					
								
									for($i=1;$i<=31;$i++)
									{
										echo '<option value='.$i.'>'.$i.'</option>';
									}
							
							?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.startdate.length-1);i++) {
									if(document.form1.startdate.options[i].value=="<?echo $sdate?>") {
										document.form1.startdate.options[i].selected = true;
										break;
									}
								}
							</script>
                          เดือน 
                          <select name="startmonth" class="datemonth">
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.startmonth.length-1);i++) {
									if(document.form1.startmonth.options[i].value=="<?echo $smonth?>") {
										document.form1.startmonth.options[i].selected = true;
										break;
									}
								}
							</script>
                          พ.ศ. 
                          <select name="startyear" class="dateyear">
                            <?
									for($a=(date(Y)+543);$a>=((date(Y)+543)-5);$a--)
									{
										echo '<option value='.$a.'>'.$a.'</option>';
									}
							
							?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.startyear.length-1);i++) {
									if(document.form1.startyear.options[i].value=="<?echo $syear?>") {
										document.form1.startyear.options[i].selected = true;
										break;
									}
								}
							</script></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>&nbsp;</td>
                        <td height="20" align="left" class="boxleft5">&nbsp;</td>
                        <td align="left" class="boxleft5">ถึงวันที่ &nbsp;</td>
                        <td align="left" class="boxleft5"><select name="enddate" class="datetime">
                            <?
									for($i=1;$i<=31;$i++)
									{
										echo '<option value='.$i.'>'.$i.'</option>';
									}
							
							?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.enddate.length-1);i++) {
									if(document.form1.enddate.options[i].value=="<?echo $edate?>") {
										document.form1.enddate.options[i].selected = true;
										break;
									}
								}
							</script>
                          เดือน 
                          <select name="endmonth" class="datemonth">
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.endmonth.length-1);i++) {
									if(document.form1.endmonth.options[i].value=="<?echo $emonth?>") {
										document.form1.endmonth.options[i].selected = true;
										break;
									}
								}
							</script>
                          พ.ศ. 
                          <select name="endyear" class="dateyear">
                            <?
									for($a=(date(Y)+543);$a>=((date(Y)+543)-5);$a--)
									{
										echo '<option value='.$a.'>'.$a.'</option>';
									}
							
							?>
                          </select>
                          <script language=JAVAScript> 
								for(i=0;i<=(document.form1.endyear.length-1);i++) {
									if(document.form1.endyear.options[i].value=="<?echo $eyear?>") {
										document.form1.endyear.options[i].selected = true;
										break;
									}
								}
							</script></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>&nbsp;</td>
                        <td height="20" align="left" class="boxleft5">&nbsp;</td>
                        <td colspan="2" align="left" class="boxleft5">รวมเวลา 
                          <input name="txt_datetotal" type="text" class="datetotal" id="txt_unit3"  onKeyPress="check_number()" value="<?echo $data[TestTotalDay]?>" maxlength="3" >
                          วัน </td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;">
                        <td height="20" align=center>&nbsp;</td>
                        <td height="20" align="left" class="boxleft5">&nbsp;</td>
                        <td colspan="2" align="left" class="boxleft5">&nbsp;</td>
                      </tr>
                    </table>
					
                    <br>
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
