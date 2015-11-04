<? //include ("checkuser.php");?>
<html>
<head>
<title>AMC</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="10" align="center" valign="middle">
<form name="form1" method="get" action="amc_general_editdata_admin.php">
              <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="60%" border="0" class=font1 bgcolor=white>
                <tr align=center class=font1 style="color:#333333;"> 
                  <td height="19" colspan=4 align=left bgcolor="#92AED1"><b>&nbsp; 
                    &nbsp;ข้อมูลทั่วไป </b></td>
                </tr>
                <tr align="left" bgcolor="#C8D7E3" class=font1 style="color:#333333"> 
                  <td height="20" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo '- บัีนทึกข้อมูลทั่วไป สกต.'.$amcname;?></td>
                  <?
						include ("images/lib/ms_database.php");
						/*$sql=" SELECT * FROM AMC  A " ;
						$sql.=" LEFT JOIN  ";
						$sql.= "(SELECT * FROM USERLOGIN)AS B ON A.AMCCODE=B.AMCCODE ";
						$sql.=" WHERE A.AMCCODE='$amccode' ";
						//echo $sql;
						$exsql=mssql_query($sql);
						$data=mssql_fetch_row($exsql);
						//echo $data[amcname];
						
					*/

				?>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">1</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">เลขทะเบียน 
                    สกต. : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="textfield32" type="text"  style="	height: 20px; width: 180px;" ></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">2</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >ชื่อ 
                    สกต. : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10">
				  <?
							$sql=" SELECT * FROM USERLOGIN  ";
							$sql.=" WHERE AMCCODE NOT IN(SELECT AMCCODE FROM AMC)	AND br_code <>'' ";
							$exsql=mssql_query($sql);
							echo  '<select  name "list_province">';
								while($rowall=mssql_fetch_array($exsql))
										{
											echo '<option value="'.$rowall[3].'">'.$rowall[4].'</option>';
										}
							echo '</select>';
							
					?>
					
					</td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">3</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >วันที่จดทะเบียน 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"> 
                    <input name="txt_amcregisdate" type="text" id="amcregisdate" size="10" maxlength="10" readonly="" style="	height: 20px; width: 180px;" > 
                    <img src="images/calendar_02.gif" alt=".เลือกวันที่." width="14" height="16" align="absmiddle" onClick=" return showCalendar('amcregisdate','dd-mm-y');" onMouseOver="this.style.cursor='hand'"; > 
                    &lt;&lt; เลือกวันที่</td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">4</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">ที่ตั้ง 
                    สกต. : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><textarea name="area_amcaddress" style="	height: 60px; width: 200px; font-size: 10pt; font-family: "microsoft sans serif";><?echo  ltrim(rtrim($data[2]))?></textarea ></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">5</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >หมายเลขโทรศัพท์ 
                    :</td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcphone" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">6</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">หมายเลข 
                    wan : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcwan" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">7</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >Fax. 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcfax" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="22" align=center bgcolor="#F0F0F0">8</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">Internet 
                    ของ สกต. : </td>
                  <td width="70%" height="22" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="rad_amcnet" type="radio" value="1" checked >
                    มี 
                    <input type="radio" name="rad_amcnet" value="0" >
                    ไม่มี </td>
                </tr>
                <tr style="color:#666666;"> 
                  <td rowspan="3" align=center bgcolor="#F0F0F0">9</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;"   >ชื่อ-สกุล 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcposition_1_name" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr style="color:#666666;"> 
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" >ตำแหน่ง 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcposition_1" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr style="color:#666666;"> 
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10">หมายเลขโทรศัพท์ 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcposition_1_phone" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td rowspan="3" align=center bgcolor="#F0F0f0">10</td>
                  <td align="left" bgcolor="#F0F0f0" class="boxleft10" style="border:1px solid #F0F0F0;" >ชื่อ-สกุล 
                    :</td>
                  <td height="20" align="left" bgcolor="#f0f0f0" class="boxleft10"><input name="txt_amcposition_2_name" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td align="left" class="boxleft10" style="border:1px solid #F0F0F0;" >ตำแหน่ง 
                    :</td>
                  <td height="20" align="left" class="boxleft10"><input name="txt_amcposition_2" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td align="left" class="boxleft10" style="border:1px solid #F0F0F0;" >หมายเลขโทรศัพท์ 
                    : </td>
                  <td height="20" align="left" class="boxleft10"><input name="txt_amcposition_2_phone" type="text"  style="	height: 20px; width: 180px;"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">11</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">หมายเหตุ 
                    : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><textarea name="area_amcremark" style="	height: 40px; width: 200px; font-size: 10pt; font-family: "microsoft sans serif";><?echo ltrim(rtrim($data[15]));?></textarea >
                    <input type="hidden" name="amccode" value="<?echo $data[0];?>"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="3"colspan="3" bgcolor="#C8D7E3"></td>
                </tr>
              </table>
              <br>
               <input name="Submit23" type="button" class="formButton" value=" Back "  onMouseOver="this.style.cursor='hand'" onClick="self.location.href=('amc.php')" > 
            &nbsp; <input name="Submit2" type="submit" class="formButton" value="Submit" onClick="javascript: if(confirm('บันทึกข้อมูลทั่วไป สกต.')){ window.location='amc_general_editdata.php';}" onMouseOver="this.style.cursor='hand'"> 
            &nbsp; <input name="Submit22" type="reset" class="formButton" value="Reset" onMouseOver="this.style.cursor='hand'"> 
            <br>
            </form> </td>
        </tr>
      </table>
        </td>
  </tr>
</table>
<?
if($save=="yes")
	{
		echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว");</script>'; 
		$save=1;
	}
?>
</body>
</body>
</html>
