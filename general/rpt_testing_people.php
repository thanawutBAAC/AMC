<?
	session_start(); 
?>
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<body <? if($file<>"print"){ echo 'background="images/bg.jpg"';}?> leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr align="left"> 
          <td height="20" valign="middle"> 
            <?
							include("../lib/ms_database.php");
							
						?> </td>
        </tr>
        <tr align="center"> 
          <td height="50" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                  <td align="center" valign="top" > <table  <?if($file=="print"){echo 'border="1"';}?>style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="85%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="30" colspan=6 align=left><b>&nbsp; แสดงข้อมูลประวัติการฝึกอบรม 
                          <?if($type=="personnel"){echo "เจ้าหน้าที่";} if($type=="committee"){echo "คณะกรรมการ";}?>
                          </b> | </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" align="left" bgcolor="#F0B49F" class="boxleft10">ชื่อ 
                          : <?echo $name.' '.$lastname.' ตำแหน่ง : '.$positions;?></td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>การบัญชี/การเงิน</b></td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="50" align="left" bgcolor="#FFFFFF" class="boxleft15"><br> 
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='01'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td height="25" class="font1"><?echo ($a=$a+1).'.';?> 
                                หลักสูตร<?echo $rowall[5];?> จัดอมรมโดย : <?echo $rowall[6]?> 
                                ตั้งแต่วันที่ <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                จำนวน : <?echo $rowall[9]; ?> วัน </td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1"> </td>
                            </tr>
                            <tr> 
                              <td height="5"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br> </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>การบริหาร/การจัดการ</b></td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" align="left" class="boxleft10"><br> <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='02'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td height="25" class="font1"><?echo ($b=$b+1).'.';?> 
                                หลักสูตร<?echo $rowall[5];?> จัดอมรมโดย : <?echo $rowall[6]?> 
                                ตั้งแต่วันที่ <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                จำนวน : <?echo $rowall[9]; ?> วัน </td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1"> </td>
                            </tr>
                            <tr> 
                              <td height="5"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br> </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>การตลาด</b></td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" align="left" class="boxleft10"><br> <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='03'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td height="25" class="font1"><?echo ($c=$c+1).'.';?> 
                                หลักสูตร<?echo $rowall[5];?> จัดอมรมโดย : <?echo $rowall[6]?> 
                                ตั้งแต่วันที่ <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                จำนวน : <?echo $rowall[9]; ?> วัน </td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1"> </td>
                            </tr>
                            <tr> 
                              <td height="5"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br> </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>สหกรณ์</b></td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" align="left" class="boxleft10"><br> <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='04'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td height="25" class="font1"><?echo ($d=$d+1).'.';?> 
                                หลักสูตร<?echo $rowall[5];?> จัดอมรมโดย : <?echo $rowall[6]?> 
                                ตั้งแต่วันที่ <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                จำนวน : <?echo $rowall[9]; ?> วัน </td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1"> </td>
                            </tr>
                            <tr> 
                              <td height="5"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br> </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>อื่นๆ</b></td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" align="left" class="boxleft10"><br> <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='05'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td height="25" class="font1"><?echo ($e=$e+1).'.';?> 
                                หลักสูตร<?echo $rowall[5];?> จัดอมรมโดย : <?echo $rowall[6]?> 
                                ตั้งแต่วันที่ <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                จำนวน : <?echo $rowall[9]; ?> วัน </td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1"> </td>
                            </tr>
                            <tr> 
                              <td height="5"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br> </td>
                      </tr>
                    </table>
                    <br>
					<? if($file<>"print"){?>
                    <input  style="width:130px"type="submit" name="Submit22" value="ต้องการพิมพ์ส่วนนี้"  onClick="window.open('rpt_testing_people.php?rpt_testing_people.php?&positions=<?echo $positions?>&name=<?echo $name?>&lastname=<?echo $lastname?>&type=personnel&file=print&USER_ID=<?echo $USER_ID;?>')">
                	<?}
					else
					{?>
				<script language="javascript">
				window.print();
				window.close();
				</SCRIPT>
				<?
					}
					?>
				</td>
              </tr>
            </table>
            <br> </td>
        </tr>
      </table>
	  </td>
  </tr>
</table>
</body>
</html>
