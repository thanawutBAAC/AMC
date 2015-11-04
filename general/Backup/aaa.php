<? session_start();?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_personnel.gif" width="289" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");

		  		if($username!="" && $password!="")
				{
					echo "ยินดีต้อนรับ<b> สกต.".$amcname.'</b> | ';
			?>
            <a class=link_red href="javascript: if(confirm('ต้องการที่จะออกจากระบบหรือไม่ !!')){ window.location='logout.php';}">ออกจากระบบ</a> 
            <?
				}	
			?>
            </span></span></td>
        </tr>
        <tr> 
          <td height="40" colspan="2" align="center" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="90%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="networkbranch_insert.php">
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=9 align=left><b>&nbsp; &nbsp;ข้อมูล 
                          ณ ปี</b></td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="5%">ลำดับ</td>
                        <td width="15%">ตำแหน่ง</td>
                        <td height="25" align="center">รหัสประชาชน</td>
                        <td align="center">ชื่อ - นาสกุล</td>
                        <td> วัน/เดือน/ปีเกิด</td>
                        <td width="12%">อายุงาน</td>
                        <td width="12%">วุฒิการศึกษา</td>
                        <td width="12%">โทรศัพท์</td>
                        <td width="12%">หมายเหตุ</td>
                      </tr>
                      <?
					  		$sql="SELECT B.AMCCode,  A.Positions, A.PostionsName, B.User_ID,B.Name, B.Birthday, ";
							$sql.=" B.Working, B.Education, B.phone, B.Remark ";
							$sql.=" FROM PersonnelPositions A ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT *  ";
							$sql.=" FROM Personnel ";
							$sql.=" WHERE AMCCODE='$amc') AS B ";
							$sql.=" ON A.Positions = B.Positions ";
							$sql.=" WHERE A.Positions Between '01' AND '05' OR B.Positions <>'' ";
					  		
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$i=1;
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
									{
					  ?>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center><?$a=$a+1; echo"$a. ";?></td>
                        <td height="20" align="left" class="boxleft15"><?echo $rowall[2]?></td>
                        <td height="20" ><input name="user_id<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[3];?>"></td>
                        <td height="20" ><input name="valuesbuy<?=$i?>22" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[4];?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="birthday<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[5]?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[6]?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"> <select name="education" >
                            <option value="1">ไม่เกินประถมหรือเทียบเท่า</option>
                            <option value="2">ประถมศึกษา - มัธยมศึกษา</option>
                            <option value="3">มัธยมศึกษา - อนุปริญญา</option>
                            <option value="4">อนุปริญญา - ปริญญาตรี</option>
                            <option value="5">สูงกว่าปริญญาตรี</option>
                          </select> </td>
							<script language=JAVAScript> 
								for(i=0;i<=(document.form1.education1.length-1);i++) {
									if(document.form1.education1.options[i].value=="<%=lstbrn%>") {
										document.form1.education1.options[i].selected = true;
										break;
									}
								}
							</script>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>2" type="text" class="Assetsize" style="text-align: right;" maxlength="10" value="<?echo $rowall[8]?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="remark<?=$i?>2" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[9]?>"></td>
                      </tr>
                      <?
					  			$i++;
					  		}

						$p=$row-$a;
						//echo $row;
						//echo $p;						
						if($row>$a)
							{
								for($b=1;$b<=$p;$b++)
								{
					  ?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F8F1C7">
						<?
							$a=$a+1; echo"<span class='txtred'>*</span>$a. ";
						//	$cat="0101";
						?>
						</td>
                        <td height="20" align="left" bgcolor="#F8F1C7" class="boxleft15">
                            <?
								$sql2="SELECT *  ";
								$sql2.=" FROM PersonnelPositions ";
								$sql2.=" WHERE Positions <> '01' AND Positions <> '02' AND Positions <> '03' ";
								$sql2.=" AND Positions <> '04' AND Positions <> '05'";
								$exsql2=mssql_query($sql2);
								
								echo '<select name="select2" >';
										while($rowall=mssql_fetch_row($exsql2)) 
											{
												echo '<option value='.$rowall[0].'>'.$rowall[2].'</option>';
											}
								echo '</select>';
							?>
                          </td>
                        <td height="20" bgcolor="#F8F1C7" ><input name="user_id<?=$i?>2" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td height="20" bgcolor="#F8F1C7" ><input name="valuesbuy<?=$i?>22" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="birthday<?=$i?>2" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy<?=$i?>42" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <select name="select" >
                            <option value="1">ไม่เกินประถมหรือเทียบเท่า</option>
                            <option value="2">ประถมศึกษา - มัธยมศึกษา</option>
                            <option value="3">มัธยมศึกษา - อนุปริญญา</option>
                            <option value="4">อนุปริญญา - ปริญญาตรี</option>
                            <option value="5">สูงกว่าปริญญาตรี</option>
                          </select> </td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>2" type="text" class="Assetsize" style="text-align: right;" maxlength="10"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="remark<?=$i?>2" type="text" class="Assetsize" style="text-align: right;"></td>
                      </tr>
                      <?
					  
					  			}
					  		}
					  ?>
                      <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
                        <td height="18" colspan="9" align=left>&nbsp;&nbsp;&nbsp; 
                          <a href="personnel.php?row=<?echo $a+1;?>&new=1">เพิ่มรายการใหม่</a> 
                          <b> 
                          <input type="hidden" name="row" value="<?=$a;?>">
                          </b></td>
                      </tr>
                    </table>
                    <br>
                    <input name="Submit2" type="submit" class="formButton" value="Submit">
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset">
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
