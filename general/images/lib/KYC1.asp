<!--#include file="Connections/kycconnection.asp" -->
<%
			sql = "SELECT * FROM tb_DepositCustomer Dep "
			sql = sql & "LEFT JOIN (SELECT * FROM tb_relateAccount) R ON Dep.Internal_id = R.Internal_ID "			
			sql = sql & "WHERE Dep.Internal_Id ='959414' AND dep.Idcard ='3101201296882' AND R.AccountNumber='0002364694' "
			Set rs = Conn.Execute(sql)
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="style/style_calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="Javascripts/javascript.js"></script>
<script language="JavaScript" type="text/javascript" src="Javascripts/calendar.js"></script>
<script language="JavaScript" type="text/javascript" src="Javascripts/loadcalendar.js"></script>
<script language="JavaScript" type="text/javascript" src="Javascripts/calendar-th.js"></script>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	font-family: MS Sans Serif;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
              <tr> 
                <td valign="top"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                    <tr valign="top"> 
                      <td width="50%" bgcolor="B3D900"><img src="images/b_online2.gif" width="154" height="25"></td>
                      <td align="right" bgcolor="B3D900"><img src="images/c2.gif" width="6" height="6"></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="#ECF83B">
                    <tr valign="bottom"> 
                      <td width="21">&nbsp;</td>
                      <td width="518" valign="top">&nbsp;</td>
                      <td align="right" width="19">&nbsp;</td>
                    </tr>
                    <tr valign="bottom"> 
                      <td width="21">&nbsp;</td>
                      <td width="518" valign="top"> 
                        <p class="black">?????????????????????????????????????????????????????????? 
                          ??????????????????????????????????????????<span class="black_b"><font color="#FF6600">??????????? 
                          ?????????????????????????? </font></span> 
                      </td>
                      <td align="right" width="19">&nbsp;</td>
                    </tr>
                    <!--
                    <tr valign="bottom"> 
                      <td width="21"><img src="../images/c3.gif" width="6" height="6"></td>
                      <td width="518" valign="top"> 
                        <p>&nbsp;</p>
                      </td>
                      <td align="right" width="19"><img src="../images/c4.gif" width="6" height="6"></td>
                    </tr>-->
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="black">
                    <tr> 
                      <td valign="top"><img src="images/step1.jpg" width="552" height="55"></td>
                    </tr>
                  </table>
                </td>
              </tr>
                            <form name="form1" method="post" enctype="multipart/form-data" action="career_submit.php?step=2">
                <tr> 
                  <td valign="top"> 
                    <!------1------->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              <td valign="top" width="94%" class="black_b">????????????????????????? 
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td valign="top"> 
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                        <tr> 
                                          <td width="29%">&nbsp;</td>
                                          <td width="71%">&nbsp;</td>
                                        </tr>
                                        <tr>                      
                              <td width="29%"> <strong>&nbsp;ประเภท KYC Checklist</strong></td>
                                          <td width="71%"> 
                                            <select name="KYCType" size="1" class="normal">
                                              <option value=""> เลือกประเภท
                                              <option value="P"   > บุคคลธรรมดา                                                                                         
											  <option value="L"   > นิติบุคคล                                                                                            
											  </select>
                                          </td>
                                        </tr>
                                        <tr> 
                                          
                              <td width="29%"><strong>&nbsp;สาขา</strong></td>
                                          <td width="71%"> 
                                            <input type="text" name="Branch" class="normal" value="">
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
					
					 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					
					  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;ข้อมูลบัญชีเงินฝาก</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" height="62" border="0" cellpadding="0" cellspacing="0" class="normal">
                                  <tr> 
                                    
                        <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                      <tr valign="middle">
                                        
                              <td width="143" height="22">&nbsp;<strong>บัญชีเลขที่ 
                                : </strong></td>
                                        <td colspan="2"><input type="text" name="AccountNumber" class="normal" value=""></td>
                                      </tr>	
	                                 <tr valign="middle">
                                        
                              <td width="143" height="24">&nbsp;<strong>ชื่อบัญชี 
                                : </strong></td>
                                        <td colspan="2"><input type="text" name="AccountName" class="normal" value=""></td>
                            </tr>								  						
                            <tr> 
                              <td width="25%"><strong>&nbsp;ประภทบัญชี</strong></td>
                              <td colspan="2".> <select name="Deposittype_Code" size="1" class="normal">
                                  <option value="">เลือกประเภทบัญชี
                                  <option value="A1"   > ออมทรัพย์
                                  <option value="A2"   > กระแสรายวัน
                                  <option value="A4"   > ประจำ
                                  <option value="7"   > ทวีสิน
                                  <option value="A6"   > เพื่อการลงทุนทั่วไป
                                  <option value="A7"   > รักษาทรัพย์
                                  <option value="A8"   > อื่นๆ
                                  </select> 
                              </td>
                            </tr>
							 <tr> 
                              <td width="25%">&nbsp;<strong>จำนวนเงินที่เปิดบัญชี/ทำธุรกรรม </strong></td>
                              <td colspan="2".> <input type="text" name="DepositAmout" class="normal" value=""> 
                              </td>
                            </tr>
                                <tr> </table></td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					<!--  Section A  นิติบุคคล-->
                    <table width="100%" height="447" border="0" cellpadding="0" cellspacing="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;Section 
                    A - ข้อมูลพื้นฐานลูกค้า</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" height="371" border="0" cellpadding="0" cellspacing="0" bgcolor="E2F19E" class="normal">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                            <tr> 
                              <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                              <td colspan="3"  height="22">&nbsp;<strong>KYC Checklist 
                                สำหรับเจ้าของบัญชนิติบุคคล</strong></td>
                            </tr>
                            <tr> 
                              <td width="63" 
height=27 align=middle bgcolor="#f5fbc5"><strong>ชื่อ</strong></td>
                              <td width="121" 
height=27 align=middle bgcolor="#f5fbc5">ภาษาไทย</td>
                              <td 
                                height=27 align=left bgcolor="#f5fbc5"  colspan="2"><input type="text" name="b2name"></td>
                              <!--<TD align=middle width="6%" height=26>จากปี</TD>
                                <TD align=middle width="6%" height=26>ถึงปี</TD>
                                <TD align=middle width="24%" 
                                height=26>วุฒิที่ได้รับและสาขาวิชาเอก</TD>
                                <TD align=middle width="9%" 
                                height=26>เกรด<BR>เฉลี่ย</TD>-->
                            </tr>
                            <tr> 
                              <td align=middle width="63" 
height=26>&nbsp;</td>
                              <td width="121" 
height=26 align=middle bgcolor="#f5fbc5">ภาาอังกฤษ</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5" colspan="2"> 
                                <input type="text" name="LAEngName1" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName2" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName3" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName4" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName5" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName6" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName7" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName8" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName9" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName10" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName11" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName12" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName13" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName14" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName15" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName16" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName17" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName18" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName19" size="1" maxlength="1"> 
                                <input type="text" name="LAEngName20" size="1" maxlength="1"> 
                              </td>
                            </tr>
                            <tr valign="middle" ิborder="1"> 
                              <td bordercolor="#B3D900"  height="22" colspan="2">&nbsp;<strong>เลขที่บัตรประจำตัวผู้เสียภาษีอากร 
                                : </strong></td>
                              <td  bordercolor="#B3D900"  height="22"> 
							  	<input type="text" name="LATaxId1" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId2" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId3" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId4" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId5" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId6" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId7" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId8" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId9" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId10" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId11" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId12" size="1" maxlength="1"> 
                                <input type="text" name="LATaxId13" size="1" maxlength="1">
                              </td>
                            </tr>
                            <tr> 
                              <td valign=middle align=middle colspan="2" rowspan="6"><div align="left"><strong>การจดทะเบียน 
                                  :</strong></div></td>
                              <td height="20" colspan="2" valign=middle> <strong>ประเภท</strong> 
                                <input type="checkbox" name="LAType1" value="1">ห้างหุ้นส่วน 
								<input type="checkbox" name="LAType2" value="2">บริษัท 
								<input type="checkbox" name="LAType3" value="3">สมาคม 
								<input type="checkbox" name="LAType4" value="4">มูลนิธิ 
								<input type="checkbox" name="LAType5" value="5">วัด 
                                <input type="checkbox" name="LAType6" value="6">อื่นๆ ระบุ 
                                <input type="text" name="LAType6Other" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td height="23" colspan="2" valign=middle><strong>เอกสารสำคัญแสดงตน</strong> 
                              </td>
                            </tr>
                            <tr> 
                              <td valign=top colspan="2"> 
							  	<input type="checkbox" name="checkbox11" value="checkbox">หนังสือรับรอง 
                                <input type="checkbox" name="checkbox112" value="checkbox">ใบอนุญาตจัดตั้ง 
                                <input type="checkbox" name="checkbox114" value="checkbox">ใบสำคัญจดทะเบียนพานิชย์ 
                                <input type="checkbox" name="checkbox24" value="checkbox">อื่นๆ ระบุ 
                                <input type="text" name="other22" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td width="554" height="22" valign=top>เลขที่ 
                                <input type="text" name="B2CardId1" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId2" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId3" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId4" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId5" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId6" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId7" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId8" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId9" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId10" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId11" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId13" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId14" size="1" maxlength="1"> 
                              </td>
                            </tr>
                            <tr> 
                              <td width="554" height="20">วันที่ออกบัตร 
                                <select name="B2select1D" size="1" class="normal">
                                  <option value=""> 
                                  <option value="1" > 1 
                                  <option value="2" > 2 
                                  <option value="3" > 3 
                                  <option value="4" > 4 
                                  <option value="5" > 5 
                                  <option value="6" > 6 
                                  <option value="7" > 7 
                                  <option value="8" > 8 
                                  <option value="9" > 9 
                                  <option value="10" > 10 
                                  <option value="11" > 11 
                                  <option value="12" > 12 
                                  <option value="13" > 13 
                                  <option value="14" > 14 
                                  <option value="15" > 15 
                                  <option value="16" > 16 
                                  <option value="17" > 17 
                                  <option value="18" > 18 
                                  <option value="19" > 19 
                                  <option value="20" > 20 
                                  <option value="21" > 21 
                                  <option value="22" > 22 
                                  <option value="23" > 23 
                                  <option value="24" > 24 
                                  <option value="25" > 25 
                                  <option value="26" > 26 
                                  <option value="27" > 27 
                                  <option value="28" > 28 
                                  <option value="29" > 29 
                                  <option value="30" > 30 
                                  <option value="31" > 31 </select> <select name="B2select1M" class="normal">
                                  <option value=""> 
                                  <option value="1" >มกราคม 
                                  <option value="2" >กุมภาพันธ์ 
                                  <option value="3" >มีนาคม 
                                  <option value="4" >เมษายน 
                                  <option value="5" >พฤษภาคม 
                                  <option value="6" >มิถุนายน 
                                  <option value="7" >กรกฏาคม 
                                  <option value="8" >สิงหาคม 
                                  <option value="9" >กันยายน 
                                  <option value="10" >ตุลาคม 
                                  <option value="11" >พฤศจิกายน 
                                  <option value="12" >ธันวาคม </select> <select name="B2select1Y" class="normal">
                                  <option value=""> 
                                  <option value="1964" > 2507 
                                  <option value="1965" > 2508 
                                  <option value="1966" > 2509 
                                  <option value="1967" > 2510 
                                  <option value="1968" > 2511 
                                  <option value="1969" > 2512 
                                  <option value="1970" > 2513 
                                  <option value="1971" > 2514 
                                  <option value="1972" > 2515 
                                  <option value="1973" > 2516 
                                  <option value="1974" > 2517 
                                  <option value="1975" > 2518 
                                  <option value="1976" > 2519 
                                  <option value="1977" > 2520 
                                  <option value="1978" > 2521 
                                  <option value="1979" > 2522 
                                  <option value="1980" > 2523 
                                  <option value="1981" > 2524 
                                  <option value="1982" > 2525 
                                  <option value="1983" > 2526 
                                  <option value="1984" > 2527 
                                  <option value="1985" > 2528 
                                  <option value="1986" > 2529 
                                  <option value="1987" > 2530 
                                  <option value="1988" > 2531 
                                  <option value="1989" > 2532 </select></td>
                            </tr>
                            <tr> 
                              <td width="554" height="19">วันที่หมดอายุ 
                                <select name="B2select2D" size="1" class="normal">
                                  <option value=""> 
                                  <option value="1" > 1 
                                  <option value="2" > 2 
                                  <option value="3" > 3 
                                  <option value="4" > 4 
                                  <option value="5" > 5 
                                  <option value="6" > 6 
                                  <option value="7" > 7 
                                  <option value="8" > 8 
                                  <option value="9" > 9 
                                  <option value="10" > 10 
                                  <option value="11" > 11 
                                  <option value="12" > 12 
                                  <option value="13" > 13 
                                  <option value="14" > 14 
                                  <option value="15" > 15 
                                  <option value="16" > 16 
                                  <option value="17" > 17 
                                  <option value="18" > 18 
                                  <option value="19" > 19 
                                  <option value="20" > 20 
                                  <option value="21" > 21 
                                  <option value="22" > 22 
                                  <option value="23" > 23 
                                  <option value="24" > 24 
                                  <option value="25" > 25 
                                  <option value="26" > 26 
                                  <option value="27" > 27 
                                  <option value="28" > 28 
                                  <option value="29" > 29 
                                  <option value="30" > 30 
                                  <option value="31" > 31 </select> <select name="B2select2M" class="normal">
                                  <option value=""> 
                                  <option value="1" >มกราคม 
                                  <option value="2" >กุมภาพันธ์ 
                                  <option value="3" >มีนาคม 
                                  <option value="4" >เมษายน 
                                  <option value="5" >พฤษภาคม 
                                  <option value="6" >มิถุนายน 
                                  <option value="7" >กรกฏาคม 
                                  <option value="8" >สิงหาคม 
                                  <option value="9" >กันยายน 
                                  <option value="10" >ตุลาคม 
                                  <option value="11" >พฤศจิกายน 
                                  <option value="12" >ธันวาคม </select> <select name="B2select2Y" class="normal">
                                  <option value=""> 
                                  <option value="1964" > 2507 
                                  <option value="1965" > 2508 
                                  <option value="1966" > 2509 
                                  <option value="1967" > 2510 
                                  <option value="1968" > 2511 
                                  <option value="1969" > 2512 
                                  <option value="1970" > 2513 
                                  <option value="1971" > 2514 
                                  <option value="1972" > 2515 
                                  <option value="1973" > 2516 
                                  <option value="1974" > 2517 
                                  <option value="1975" > 2518 
                                  <option value="1976" > 2519 
                                  <option value="1977" > 2520 
                                  <option value="1978" > 2521 
                                  <option value="1979" > 2522 
                                  <option value="1980" > 2523 
                                  <option value="1981" > 2524 
                                  <option value="1982" > 2525 
                                  <option value="1983" > 2526 
                                  <option value="1984" > 2527 
                                  <option value="1985" > 2528 
                                  <option value="1986" > 2529 
                                  <option value="1987" > 2530 
                                  <option value="1988" > 2531 
                                  <option value="1989" > 2532 </select> </td>
                            </tr>
                            <tr valign="middle" ิborder="1"> 
                              <td bordercolor="#B3D900"  height="22" colspan="2">&nbsp;<strong>กรณีเป็นหน่วยงานการกุศล 
                                หรือหน่วยงานไม่แสวงหากำไร : </strong></td>
                              <td  bordercolor="#B3D900"  height="22"><input type="checkbox" name="checkbox113" value="checkbox">
                                ระยะเวลาจัดตั้งไม่เกิน 10 ปี <input type="checkbox" name="checkbox1122" value="checkbox">
                                จัดตั้งเกิน 10 ปี <input type="checkbox" name="checkbox1142" value="checkbox">
                                รายได้เกิน 800 ล้าน/ปี</td>
                            </tr>
                            <!--<tr >
                                        <td height="22" colspan="3" bordercolor="#B3D900">&nbsp;<strong>เลขที่บัตรประชาชน 
                                          / หนังสือเดินทาง / ใบต่างด้าว :</strong></td>
                                      </tr> -->
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>ประเภทธุรกิจ 
                                : </strong></td>
                              <td width="554" bordercolor="#B3D900"><input type="text" name="BssType" class="normal" value="" size="50"></td>
                            </tr>
                            <tr> 
                              <td valign=top align=middle colspan="2" rowspan="2"><div align="left"><strong>สถานที่ตั้งจดทะเบียน</strong></div></td>
                              <td valign=middle > เลขที่&nbsp;
                                <input type="text" name="B2IDAddNo" size="7">
                                &nbsp; หมู่&nbsp;
                                <input type="text" name="B2IDAddMoo" size="2">
                                &nbsp; ซอย&nbsp;
                                <input type="text" name="B2IDAddSoi" size="10">
                                &nbsp; ถนน&nbsp;
                                <input type="text" name="B2IDAddRoad" size="10">
                                &nbsp; ตำบล&nbsp;
                                <input type="text" name="B2IDAddTumbol" size="10">
                                &nbsp; อำเภอ&nbsp;
                                <input type="text" name="B2IDAddAmphor" size="10">
                                &nbsp; </td>
                            </tr>
                            <tr valign=top> 
                              <td width=554> <table class=normal cellspacing=0 cellpadding=0 
                                width="100%" border=0>
                                  <tbody>
                                    <tr valign=top> 
                                      <td width="11%">จังหวัด</td>
                                      <td width="34%"><select class=normal 
                                name=address_prov>
                                          <option value="" 
                                selected> 
                                          <option value=1>กทม 
                                          <option 
                                value=2>กระบี่ 
                                          <option value=3>กาญจนบุรี 
                                          <option 
                                value=4>กาฬสินธุ์ 
                                          <option 
                                value=5>กำแพงเพชร 
                                          <option value=6>ขอนแก่น 
                                          <option 
                                value=7>จันทบุรี 
                                          <option 
                                value=8>ฉะเชิงเทรา 
                                          <option value=9>ชลบุรี 
                                          <option 
                                value=10>ชัยนาท 
                                          <option value=11>ชัยภูมิ 
                                          <option 
                                value=12>ชุมพร 
                                          <option value=13>เชียงราย 
                                          <option 
                                value=14>เชียงใหม่ 
                                          <option value=15>ตรัง 
                                          <option 
                                value=16>ตราด 
                                          <option value=17>ตาก 
                                          <option 
                                value=18>นครนายก 
                                          <option value=19>นครปฐม 
                                          <option 
                                value=20>นครพนม 
                                          <option 
                                value=21>นครราชสีมา 
                                          <option 
                                value=22>นครศรีธรรมราช 
                                          <option 
                                value=23>นครสวรรค์ 
                                          <option 
                                value=24>นนทบุรี 
                                          <option value=25>นราธิวาส 
                                          <option 
                                value=26>น่าน 
                                          <option value=27>บุรีรัมย์ 
                                          <option 
                                value=28>ปทุมธานี 
                                          <option 
                                value=29>ประจวบคีรีขันธ์ 
                                          <option 
                                value=30>ปราจีนบุรี 
                                          <option 
                                value=31>ปัตตานี 
                                          <option value=32>พะเยา 
                                          <option 
                                value=33>พังงา 
                                          <option value=34>พัทลุง 
                                          <option 
                                value=35>พิจิตร 
                                          <option value=36>พิษณุโลก 
                                          <option 
                                value=37>เพชรบุรี 
                                          <option 
                                value=38>เพชรบูรณ์ 
                                          <option value=39>แพร่ 
                                          <option 
                                value=40>ภูเก็ต 
                                          <option value=41>มหาสารคาม 
                                          <option 
                                value=42>มุกดาหาร 
                                          <option 
                                value=43>แม่ฮ่องสอน 
                                          <option value=44>ยโสธร 
                                          <option 
                                value=45>ยะลา 
                                          <option value=46>ร้อยเอ็ด 
                                          <option 
                                value=47>ระนอง 
                                          <option value=48>ระยอง 
                                          <option 
                                value=49>ราชบุรี 
                                          <option value=50>ลพบุรี 
                                          <option 
                                value=51>ลำปาง 
                                          <option value=52>ลำพูน 
                                          <option 
                                value=53>เลย 
                                          <option value=54>ศรีสะเกษ 
                                          <option 
                                value=55>สกลนคร 
                                          <option value=56>สงขลา 
                                          <option 
                                value=57>สตูล 
                                          <option value=58>สมุทรปราการ 
                                          <option 
                                value=59>สมุทรสงคราม 
                                          <option 
                                value=60>สมุทรสาคร 
                                          <option 
                                value=61>สระแก้ว 
                                          <option value=62>สระบุรี 
                                          <option 
                                value=63>สิงห์บุรี 
                                          <option 
                                value=64>สุโขทัย 
                                          <option 
                                value=65>สุพรรณบุรี 
                                          <option 
                                value=66>สุราษฎร์ธานี 
                                          <option 
                                value=67>สุรินทร์ 
                                          <option value=68>หนองคาย 
                                          <option 
                                value=69>หนองบัวลำภู 
                                          <option 
                                value=70>อยุธยา 
                                          <option value=71>อ่างทอง 
                                          <option 
                                value=72>อำนาจเจริญ 
                                          <option 
                                value=73>อุดรธานี 
                                          <option 
                                value=74>อุตรดิตถ์ 
                                          <option 
                                value=75>อุทัยธานี 
                                          <option 
                                value=76>อุบลราชธานี</option>
                                        </select> </td>
                                      <td align=right width="22%">รหัสไปรษณีย์ 
                                        &nbsp;</td>
                                      <td width="33%"><input class=normal size=6 
                                name=address_zip maxlength="6"> </td>
                                    </tr>
                                    <tr valign=top> 
                                      <td width="11%">โทรศัพท์ </td>
                                      <td width="34%"><input class=normal size=15 
                                name=address_tel> </td>
                                      <td align=right width="22%">โทรสาร &nbsp; 
                                      </td>
                                      <td width="33%"><input class=normal size=15 
                                name=address_fax> </td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr> 
                              <td valign=top align=middle colspan="2" rowspan="2"><div align="left"><strong>สถานที่ตั้งทำการ</strong></div></td>
                              <td valign=middle colspan=5> เลขที่&nbsp;
                                <input type="text" name="B2AddNo" size="7">
                                &nbsp; หมู่&nbsp;
                                <input type="text" name="B2AddMoo" size="2">
                                &nbsp; ซอย&nbsp;
                                <input type="text" name="B2AddSoi" size="10">
                                &nbsp; ถนน&nbsp;
                                <input type="text" name="B2AddRoad" size="10">
                                &nbsp; ตำบล&nbsp;
                                <input type="text" name="B2AddTumbol" size="10">
                                &nbsp; อำเภอ&nbsp;
                                <input type="text" name="B2AddAmphor" size="10">
                                &nbsp; </td>
                            </tr>
                            <tr valign=top> 
                              <td width=554> <table class=normal cellspacing=0 cellpadding=0 
                                width="100%" border=0>
                                  <tbody>
                                    <tr valign=top> 
                                      <td width="12%">จังหวัด</td>
                                      <td width="33%"><select class=normal 
                                name=address_prov>
                                          <option value="" 
                                selected> 
                                          <option value=1>กทม 
                                          <option 
                                value=2>กระบี่ 
                                          <option value=3>กาญจนบุรี 
                                          <option 
                                value=4>กาฬสินธุ์ 
                                          <option 
                                value=5>กำแพงเพชร 
                                          <option value=6>ขอนแก่น 
                                          <option 
                                value=7>จันทบุรี 
                                          <option 
                                value=8>ฉะเชิงเทรา 
                                          <option value=9>ชลบุรี 
                                          <option 
                                value=10>ชัยนาท 
                                          <option value=11>ชัยภูมิ 
                                          <option 
                                value=12>ชุมพร 
                                          <option value=13>เชียงราย 
                                          <option 
                                value=14>เชียงใหม่ 
                                          <option value=15>ตรัง 
                                          <option 
                                value=16>ตราด 
                                          <option value=17>ตาก 
                                          <option 
                                value=18>นครนายก 
                                          <option value=19>นครปฐม 
                                          <option 
                                value=20>นครพนม 
                                          <option 
                                value=21>นครราชสีมา 
                                          <option 
                                value=22>นครศรีธรรมราช 
                                          <option 
                                value=23>นครสวรรค์ 
                                          <option 
                                value=24>นนทบุรี 
                                          <option value=25>นราธิวาส 
                                          <option 
                                value=26>น่าน 
                                          <option value=27>บุรีรัมย์ 
                                          <option 
                                value=28>ปทุมธานี 
                                          <option 
                                value=29>ประจวบคีรีขันธ์ 
                                          <option 
                                value=30>ปราจีนบุรี 
                                          <option 
                                value=31>ปัตตานี 
                                          <option value=32>พะเยา 
                                          <option 
                                value=33>พังงา 
                                          <option value=34>พัทลุง 
                                          <option 
                                value=35>พิจิตร 
                                          <option value=36>พิษณุโลก 
                                          <option 
                                value=37>เพชรบุรี 
                                          <option 
                                value=38>เพชรบูรณ์ 
                                          <option value=39>แพร่ 
                                          <option 
                                value=40>ภูเก็ต 
                                          <option value=41>มหาสารคาม 
                                          <option 
                                value=42>มุกดาหาร 
                                          <option 
                                value=43>แม่ฮ่องสอน 
                                          <option value=44>ยโสธร 
                                          <option 
                                value=45>ยะลา 
                                          <option value=46>ร้อยเอ็ด 
                                          <option 
                                value=47>ระนอง 
                                          <option value=48>ระยอง 
                                          <option 
                                value=49>ราชบุรี 
                                          <option value=50>ลพบุรี 
                                          <option 
                                value=51>ลำปาง 
                                          <option value=52>ลำพูน 
                                          <option 
                                value=53>เลย 
                                          <option value=54>ศรีสะเกษ 
                                          <option 
                                value=55>สกลนคร 
                                          <option value=56>สงขลา 
                                          <option 
                                value=57>สตูล 
                                          <option value=58>สมุทรปราการ 
                                          <option 
                                value=59>สมุทรสงคราม 
                                          <option 
                                value=60>สมุทรสาคร 
                                          <option 
                                value=61>สระแก้ว 
                                          <option value=62>สระบุรี 
                                          <option 
                                value=63>สิงห์บุรี 
                                          <option 
                                value=64>สุโขทัย 
                                          <option 
                                value=65>สุพรรณบุรี 
                                          <option 
                                value=66>สุราษฎร์ธานี 
                                          <option 
                                value=67>สุรินทร์ 
                                          <option value=68>หนองคาย 
                                          <option 
                                value=69>หนองบัวลำภู 
                                          <option 
                                value=70>อยุธยา 
                                          <option value=71>อ่างทอง 
                                          <option 
                                value=72>อำนาจเจริญ 
                                          <option 
                                value=73>อุดรธานี 
                                          <option 
                                value=74>อุตรดิตถ์ 
                                          <option 
                                value=75>อุทัยธานี 
                                          <option 
                                value=76>อุบลราชธานี</option>
                                        </select> </td>
                                      <td align=right width="22%">รหัสไปรษณีย์ 
                                        &nbsp;</td>
                                      <td width="33%"><input class=normal size=6
                                name=address_zipcode maxlength="6"> </td>
                                    </tr>
                                    <tr valign=top> 
                                      <td width="12%">โทรศัพท์ </td>
                                      <td width="33%"><input class=normal size=15 
                                name=address_tel> </td>
                                      <td align=right width="22%">โทรสาร &nbsp; 
                                      </td>
                                      <td width="33%"><input class=normal size=15 
                                name=address_fax> </td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <!-- 
                                        <tr valign="top"> 
                                          <td width="146">????????????</td>
                                          <td width="359"> 
                                            <input type="radio" name="military" value="1"  onclick="document.form1.military_4.value='';">
                                            ??????????????? 
                                            <input type="radio" name="military" value="2"  onclick="document.form1.military_4.value='';">
                                            ????????????? 
                                            <input type="radio" name="military" value="3"  onclick="document.form1.military_4.value='';">
                                            ???????????????? </td>
                                        </tr>							
                                        <tr valign="top"> 
                                          <td width="146">&nbsp; </td>
                                          <td width="359">
                                            <input type="radio" name="military" value="4" >
                                            ????? 
                                            <input type="text" name="military_4" class="normal" value="">
                                          </td>
                                        </tr>
                                        <tr valign="top"> 
                                          <td width="146">??????????????????????????<br>
                                            ???????????</td>
                                          <td width="359"> 
                                            <input type="text" name="emer" class="normal" value="">
                                            ???????????? 
                                            <input type="text" name="emer_rela" size="15" class="normal" value="">
                                          </td>
                                        </tr>
                                        <tr valign="top"> 
                                          <td width="146">?????????????</td>
                                          <td width="359"> 
                                            <textarea name="emer_addr" class="normal" rows="3" cols="54"></textarea>
                                          </td>
                                        </tr>
                                        <tr valign="top"> 
                                          <td width="146">&nbsp;</td>
                                          <td width="359"> 
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                              <tr valign="top"> 
                                                <td width="12%">???????</td>
                                                <td width="33%"> 
                                                  <select name="emer_prov" class="normal">
												  <option value=""> 
												                                                      <option value="1" >???												                                                    <option value="2" >??????												                                                    <option value="3" >?????????												                                                    <option value="4" >?????????												                                                    <option value="5" >?????????												                                                    <option value="6" >???????												                                                    <option value="7" >????????												                                                    <option value="8" >??????????												                                                    <option value="9" >??????												                                                    <option value="10" >??????												                                                    <option value="11" >???????												                                                    <option value="12" >?????												                                                    <option value="13" >????????												                                                    <option value="14" >?????????												                                                    <option value="15" >????												                                                    <option value="16" >????												                                                    <option value="17" >???												                                                    <option value="18" >???????												                                                    <option value="19" >??????												                                                    <option value="20" >??????												                                                    <option value="21" >??????????												                                                    <option value="22" >?????????????												                                                    <option value="23" >?????????												                                                    <option value="24" >???????												                                                    <option value="25" >????????												                                                    <option value="26" >????												                                                    <option value="27" >?????????												                                                    <option value="28" >????????												                                                    <option value="29" >???????????????												                                                    <option value="30" >??????????												                                                    <option value="31" >???????												                                                    <option value="32" >?????												                                                    <option value="33" >?????												                                                    <option value="34" >??????												                                                    <option value="35" >??????												                                                    <option value="36" >????????												                                                    <option value="37" >????????												                                                    <option value="38" >?????????												                                                    <option value="39" >????												                                                    <option value="40" >??????												                                                    <option value="41" >?????????												                                                    <option value="42" >????????												                                                    <option value="43" >??????????												                                                    <option value="44" >?????												                                                    <option value="45" >????												                                                    <option value="46" >????????												                                                    <option value="47" >?????												                                                    <option value="48" >?????												                                                    <option value="49" >???????												                                                    <option value="50" >??????												                                                    <option value="51" >?????												                                                    <option value="52" >?????												                                                    <option value="53" >???												                                                    <option value="54" >????????												                                                    <option value="55" >??????												                                                    <option value="56" >?????												                                                    <option value="57" >????												                                                    <option value="58" >???????????												                                                    <option value="59" >???????????												                                                    <option value="60" >?????????												                                                    <option value="61" >???????												                                                    <option value="62" >???????												                                                    <option value="63" >?????????												                                                    <option value="64" >???????												                                                    <option value="65" >??????????												                                                    <option value="66" >????????????												                                                    <option value="67" >????????												                                                    <option value="68" >???????												                                                    <option value="69" >???????????												                                                    <option value="70" >??????												                                                    <option value="71" >???????												                                                    <option value="72" >??????????												                                                    <option value="73" >????????												                                                    <option value="74" >?????????												                                                    <option value="75" >?????????												                                                    <option value="76" >???????????												                                                  </select>
                                                </td>
                                                <td width="22%" align="right">???????????? 
                                                  &nbsp;</td>
                                                <td width="33%"> 
                                                  <input type="text" name="emer_zip" size="15" class="normal" value="">
                                                </td>
                                              </tr>
                                              <tr valign="top"> 
                                                <td width="12%">???????? </td>
                                                <td width="33%"> 
                                                  <input type="text" name="emer_tel" size="15" class="normal" value="">
                                                </td>
                                                <td width="22%" align="right">&nbsp;</td>
                                                <td width="33%">&nbsp;</td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
-->
                          </table></td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
			
			       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
			
				<!--  Section A  นบุคคลธรรมดา-->
                    <table width="100%" height="407" border="0" cellpadding="0" cellspacing="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;Section 
                    A - ข้อมูลพื้นฐานลูกค้า</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" height="376" border="0" cellpadding="0" cellspacing="0" bgcolor="E2F19E" class="normal">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                            <tr> 
                              <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                              <td colspan="3"  height="22">&nbsp;<strong>KYC Checklist 
                                สำหรับเจ้าของบัญชีบุคคล และเจ้าของบัญชีร่วมแต่ละคน</strong></td>
                            </tr>
                            <tr> 
                              <td width="61" 
height=26 align=middle bgcolor="#f5fbc5"><strong>ชื่อนิติบุคคล</strong></td>
                              <td width="109" 
height=26 align=middle bgcolor="#f5fbc5">ภาษาไทย</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5"  colspan="2"><input type="text" name="b2name"></td>
                              <!--<TD align=middle width="6%" height=26>จากปี</TD>
                                <TD align=middle width="6%" height=26>ถึงปี</TD>
                                <TD align=middle width="24%" 
                                height=26>วุฒิที่ได้รับและสาขาวิชาเอก</TD>
                                <TD align=middle width="9%" 
                                height=26>เกรด<BR>เฉลี่ย</TD>-->
                            </tr>
                            <tr> 
                              <td align=middle width="61" 
height=26>&nbsp;</td>
                              <td width="109" 
height=26 align=middle bgcolor="#f5fbc5">ภาาอังกฤษ</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5" colspan="2"> 
                                <input type="text" name="B2EngName1" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName2" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName3" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName4" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName5" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName6" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName7" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName8" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName9" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName10" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName11" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName12" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName13" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName14" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName15" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName16" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName17" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName18" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName19" size="1" maxlength="1"> 
                                <input type="text" name="B2EngName20" size="1" maxlength="1"> 
                              </td>
                            </tr>
                            <tr> 
                              <td valign=middle align=middle colspan="2" rowspan="5"><div align="left"><strong>บัตรสำคัญประจำตัว</strong></div></td>
                              <td height="25" colspan="2" valign=middle><input type="checkbox" name="checkbox9" value="checkbox">
                                บัตรประชาชน 
                                <input type="checkbox" name="checkbox22" value="checkbox">
                                บัตรข้าราชการ/รัฐวิสาหกิจ 
                                <input type="checkbox" name="checkbox32" value="checkbox">
                                บัตรพนักงานองค์กร 
                                <input type="checkbox" name="checkbox10" value="checkbox">
                                หนังสือเดินทาง 
                                <input type="checkbox" name="checkbox23" value="checkbox">
                                บัตรอนุญาตขับขี่</td>
                            </tr>
                            <tr> 
                              <td valign=top colspan="2"><input type="checkbox" name="checkbox11" value="checkbox">
                                บัตรประจำตัวผู้เสียภาษี 
                                <input type="checkbox" name="checkbox24" value="checkbox">
                                อื่นๆ ระบุ 
                                <input type="text" name="other22" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td width="568" height="22" valign=top>เลขที่ 
                                <input type="text" name="B2CardId1" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId2" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId3" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId4" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId5" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId6" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId7" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId8" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId9" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId10" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId11" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId13" size="1" maxlength="1"> 
                                <input type="text" name="B2CardId14" size="1" maxlength="1"> 
                              </td>
                            </tr>
                            <tr> 
                              <td width="568" height="20">วันที่ออกบัตร 
                                <select name="B2select1D" size="1" class="normal">
                                  <option value=""> 
                                  <option value="1" > 1 
                                  <option value="2" > 2 
                                  <option value="3" > 3 
                                  <option value="4" > 4 
                                  <option value="5" > 5 
                                  <option value="6" > 6 
                                  <option value="7" > 7 
                                  <option value="8" > 8 
                                  <option value="9" > 9 
                                  <option value="10" > 10 
                                  <option value="11" > 11 
                                  <option value="12" > 12 
                                  <option value="13" > 13 
                                  <option value="14" > 14 
                                  <option value="15" > 15 
                                  <option value="16" > 16 
                                  <option value="17" > 17 
                                  <option value="18" > 18 
                                  <option value="19" > 19 
                                  <option value="20" > 20 
                                  <option value="21" > 21 
                                  <option value="22" > 22 
                                  <option value="23" > 23 
                                  <option value="24" > 24 
                                  <option value="25" > 25 
                                  <option value="26" > 26 
                                  <option value="27" > 27 
                                  <option value="28" > 28 
                                  <option value="29" > 29 
                                  <option value="30" > 30 
                                  <option value="31" > 31 </select> <select name="B2select1M" class="normal">
                                  <option value=""> 
                                  <option value="1" >มกราคม 
                                  <option value="2" >กุมภาพันธ์ 
                                  <option value="3" >มีนาคม 
                                  <option value="4" >เมษายน 
                                  <option value="5" >พฤษภาคม 
                                  <option value="6" >มิถุนายน 
                                  <option value="7" >กรกฏาคม 
                                  <option value="8" >สิงหาคม 
                                  <option value="9" >กันยายน 
                                  <option value="10" >ตุลาคม 
                                  <option value="11" >พฤศจิกายน 
                                  <option value="12" >ธันวาคม </select> <select name="B2select1Y" class="normal">
                                  <option value=""> 
                                  <option value="1964" > 2507 
                                  <option value="1965" > 2508 
                                  <option value="1966" > 2509 
                                  <option value="1967" > 2510 
                                  <option value="1968" > 2511 
                                  <option value="1969" > 2512 
                                  <option value="1970" > 2513 
                                  <option value="1971" > 2514 
                                  <option value="1972" > 2515 
                                  <option value="1973" > 2516 
                                  <option value="1974" > 2517 
                                  <option value="1975" > 2518 
                                  <option value="1976" > 2519 
                                  <option value="1977" > 2520 
                                  <option value="1978" > 2521 
                                  <option value="1979" > 2522 
                                  <option value="1980" > 2523 
                                  <option value="1981" > 2524 
                                  <option value="1982" > 2525 
                                  <option value="1983" > 2526 
                                  <option value="1984" > 2527 
                                  <option value="1985" > 2528 
                                  <option value="1986" > 2529 
                                  <option value="1987" > 2530 
                                  <option value="1988" > 2531 
                                  <option value="1989" > 2532 </select></td>
                            </tr>
                            <tr> 
                              <td width="568" height="19">วันที่หมดอายุ 
                                <select name="B2select2D" size="1" class="normal">
                                  <option value=""> 
                                  <option value="1" > 1 
                                  <option value="2" > 2 
                                  <option value="3" > 3 
                                  <option value="4" > 4 
                                  <option value="5" > 5 
                                  <option value="6" > 6 
                                  <option value="7" > 7 
                                  <option value="8" > 8 
                                  <option value="9" > 9 
                                  <option value="10" > 10 
                                  <option value="11" > 11 
                                  <option value="12" > 12 
                                  <option value="13" > 13 
                                  <option value="14" > 14 
                                  <option value="15" > 15 
                                  <option value="16" > 16 
                                  <option value="17" > 17 
                                  <option value="18" > 18 
                                  <option value="19" > 19 
                                  <option value="20" > 20 
                                  <option value="21" > 21 
                                  <option value="22" > 22 
                                  <option value="23" > 23 
                                  <option value="24" > 24 
                                  <option value="25" > 25 
                                  <option value="26" > 26 
                                  <option value="27" > 27 
                                  <option value="28" > 28 
                                  <option value="29" > 29 
                                  <option value="30" > 30 
                                  <option value="31" > 31 </select> <select name="B2select2M" class="normal">
                                  <option value=""> 
                                  <option value="1" >มกราคม 
                                  <option value="2" >กุมภาพันธ์ 
                                  <option value="3" >มีนาคม 
                                  <option value="4" >เมษายน 
                                  <option value="5" >พฤษภาคม 
                                  <option value="6" >มิถุนายน 
                                  <option value="7" >กรกฏาคม 
                                  <option value="8" >สิงหาคม 
                                  <option value="9" >กันยายน 
                                  <option value="10" >ตุลาคม 
                                  <option value="11" >พฤศจิกายน 
                                  <option value="12" >ธันวาคม </select> <select name="B2select2Y" class="normal">
                                  <option value=""> 
                                  <option value="1964" > 2507 
                                  <option value="1965" > 2508 
                                  <option value="1966" > 2509 
                                  <option value="1967" > 2510 
                                  <option value="1968" > 2511 
                                  <option value="1969" > 2512 
                                  <option value="1970" > 2513 
                                  <option value="1971" > 2514 
                                  <option value="1972" > 2515 
                                  <option value="1973" > 2516 
                                  <option value="1974" > 2517 
                                  <option value="1975" > 2518 
                                  <option value="1976" > 2519 
                                  <option value="1977" > 2520 
                                  <option value="1978" > 2521 
                                  <option value="1979" > 2522 
                                  <option value="1980" > 2523 
                                  <option value="1981" > 2524 
                                  <option value="1982" > 2525 
                                  <option value="1983" > 2526 
                                  <option value="1984" > 2527 
                                  <option value="1985" > 2528 
                                  <option value="1986" > 2529 
                                  <option value="1987" > 2530 
                                  <option value="1988" > 2531 
                                  <option value="1989" > 2532 </select> </td>
                            </tr>
                            <tr> 
                              <td height="24" colspan="2" align=middle valign=middle rowspan="3"><div align="left"><strong>เพศ/สัญชาติ/ว.ด.ป.เกิด</strong></div></td>
                              <td width="568" height="23" valign=middle>&nbsp; <strong>เพศ</strong> 
                                <input type=radio value=gender=f>
                                หญิง 
                                <input type=radio value=gender=m>
                                ชาย</td>
                            </tr>
                            <tr> 
                              <td width="568" height="26" valign=top>&nbsp; <strong>สัญชาติ</strong> 
                                <input type=radio value=gender=f>
                                ไทย 
                                <input type=radio value=gender=m>
                                อื่นๆ ระบุ 
                                <input type="text" name="other2" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td width="568" height="20" valign=top>&nbsp;<strong>วัน/เดือน/ปีเกิด 
                                (พ.ศ.)</strong> <select name="select2" size="1" class="normal">
                                  <option value=""> 
                                  <option value="1" > 1 
                                  <option value="2" > 2 
                                  <option value="3" > 3 
                                  <option value="4" > 4 
                                  <option value="5" > 5 
                                  <option value="6" > 6 
                                  <option value="7" > 7 
                                  <option value="8" > 8 
                                  <option value="9" > 9 
                                  <option value="10" > 10 
                                  <option value="11" > 11 
                                  <option value="12" > 12 
                                  <option value="13" > 13 
                                  <option value="14" > 14 
                                  <option value="15" > 15 
                                  <option value="16" > 16 
                                  <option value="17" > 17 
                                  <option value="18" > 18 
                                  <option value="19" > 19 
                                  <option value="20" > 20 
                                  <option value="21" > 21 
                                  <option value="22" > 22 
                                  <option value="23" > 23 
                                  <option value="24" > 24 
                                  <option value="25" > 25 
                                  <option value="26" > 26 
                                  <option value="27" > 27 
                                  <option value="28" > 28 
                                  <option value="29" > 29 
                                  <option value="30" > 30 
                                  <option value="31" > 31 </select> <select name="select2" class="normal">
                                  <option value=""> 
                                  <option value="1" >มกราคม 
                                  <option value="2" >กุมภาพันธ์ 
                                  <option value="3" >มีนาคม 
                                  <option value="4" >เมษายน 
                                  <option value="5" >พฤษภาคม 
                                  <option value="6" >มิถุนายน 
                                  <option value="7" >กรกฏาคม 
                                  <option value="8" >สิงหาคม 
                                  <option value="9" >กันยายน 
                                  <option value="10" >ตุลาคม 
                                  <option value="11" >พฤศจิกายน 
                                  <option value="12" >ธันวาคม </select> <select name="select2" class="normal">
                                  <option value=""> 
                                  <option value="1964" > 2507 
                                  <option value="1965" > 2508 
                                  <option value="1966" > 2509 
                                  <option value="1967" > 2510 
                                  <option value="1968" > 2511 
                                  <option value="1969" > 2512 
                                  <option value="1970" > 2513 
                                  <option value="1971" > 2514 
                                  <option value="1972" > 2515 
                                  <option value="1973" > 2516 
                                  <option value="1974" > 2517 
                                  <option value="1975" > 2518 
                                  <option value="1976" > 2519 
                                  <option value="1977" > 2520 
                                  <option value="1978" > 2521 
                                  <option value="1979" > 2522 
                                  <option value="1980" > 2523 
                                  <option value="1981" > 2524 
                                  <option value="1982" > 2525 
                                  <option value="1983" > 2526 
                                  <option value="1984" > 2527 
                                  <option value="1985" > 2528 
                                  <option value="1986" > 2529 
                                  <option value="1987" > 2530 
                                  <option value="1988" > 2531 
                                  <option value="1989" > 2532 </select></td>
                            </tr>
                            <!--<tr >
                                        <td height="22" colspan="3" bordercolor="#B3D900">&nbsp;<strong>เลขที่บัตรประชาชน 
                                          / หนังสือเดินทาง / ใบต่างด้าว :</strong></td>
                                      </tr> -->
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>อาชีพหรือประเภทธุรกิจ 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Occupation" class="normal" value=""></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>ตำแหน่ง 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Position" class="normal" value=""></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>สถานที่ทำงาน 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Workplace" class="normal" value="" size="75"></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>ที่อยู่ตามบัตรประชาชน 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="IdcardAddress" class="normal" value="" size="75"></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>สถานที่สะดวกในการติดต่อ 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Address" class="normal" value="" size="75"></td>
                            </tr>
                          </table></td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
			
					
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;Section 
                    B - ข้อมูลที่จำเป็นต้องสอบถาม</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td  width="94%"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                      <tr>
                                        <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                                        <td  height="25" colspan="3" bordercolor="#B3D900">&nbsp;<strong>1. สถานะการตรวจสอบ : มีการตรวจสอบชื่อและรูปพรรณสัณฐานของลูกค้าใน Sanctions และ PEP List 
                                          <input type="radio" name="PEP" value="1" >
มี
 <input type="radio" name="PEP" value="2" >
ไม่มี
<label></label>
                                        </strong></td>
                                      </tr>
									   <tr >
										<td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>2. มีการตรวจสอบชื่อ : มีการตรวจสอบชื่อ วันเกิด และสัญชาติของลูกค้า ตามเอกสารแสดงตน จากฉบับจริง พร้อมตราประทับหน่วยงานผู้ออกเอกสาร </strong>(ถ้ามี) <br>
										  &nbsp;<strong>วันเกิด สัญชาติ : "ได้ตรวจสอบจากต้นฉบับจริง" ในสำเนาเอกสาร</strong> <label>
										  <input type="checkbox" name="checkbox" value="checkbox">
										  บัตรประชาชน 
										  <input type="checkbox" name="checkbox2" value="checkbox">
										  หนังสือเดินทาง 
										  <input type="checkbox" name="checkbox3" value="checkbox">
										  ใบต่างด้าว</label></td>
                                      </tr>
									  <tr valign="middle">
                                        <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                                        <td  height="25" colspan="3" bordercolor="#B3D900">&nbsp;<strong>3. ตรวจสอบที่อยู่ : มีการตรวจสอบที่อยู่จากหลักฐานที่นำมาแสดงที่อยู่ 
                                          <label>
                                          <input type="checkbox" name="checkbox4" value="checkbox">
                                          บัตรประชาชน</label>
                                          <label>
                                          <input type="checkbox" name="checkbox5" value="checkbox">
                                          หนังสือรับรองการจดทะเบียน</label>
                                        </strong></td>
                                      </tr>
										<tr >
										<td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>4. วัตถุประสงค์ในการเปิดบัญชี : ระบุวัตถุประสงค์ เลือกได้มากกว่า 1 ข้อ </strong><br>
										  &nbsp;<label>
										  <input type="checkbox" name="checkbox" value="checkbox">
										  ออมเงิน 
										  <input type="checkbox" name="checkbox2" value="checkbox">
										  การลงทุนในธุรกิจ
										  <input type="checkbox" name="checkbox3" value="checkbox">
										  รับ/ชำระเงินกู้ 
										  <input type="checkbox" name="checkbox6" value="checkbox">
										  บัญชีเงินเดือน 
										  <input type="checkbox" name="checkbox7" value="checkbox">
										  ชำระค่าสาธารณูปโภค 
										  <input type="checkbox" name="checkbox8" value="checkbox">
										  อื่นๆ โปรดระบุ </label><input type="text" name="other" class="normal" value=""></td>
                                      </tr>
											<tr >
										<td  height="52" colspan="3" bordercolor="#B3D900">&nbsp;<strong>5. แหล่งที่มาของเงินฝาก : แหล่งที่มาของเงินฝาก เลือกได้มากกว่า 1 ข้อ </strong><input type="radio" name="PEP" value="1" >
เงินออม
  <input type="radio" name="PEP" value="2" >
                                ธุรกิจส่วนตัว<br>
										  &nbsp;<label>
										  <input type="checkbox" name="checkbox" value="checkbox">
										  รับจ้าง 
										  <input type="checkbox" name="checkbox2" value="checkbox">
										  มรดก/ของขวัญ
										  <input type="checkbox" name="checkbox3" value="checkbox">
										  ขายหลักทรัพย์/หน่วยลงทุน 
										  <input type="checkbox" name="checkbox6" value="checkbox">
										  ค้าขาย 
										   
										  <input type="checkbox" name="checkbox8" value="checkbox">
										  อื่นๆ โปรดระบุ </label><input type="text" name="other" class="normal" value=""></td>
                                      </tr>
									  
									  <tr >
										
                              <td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>6. 
                                <!-- เฉพาะนิติบุคคล-->
                                รายได้ส่วนใหญ่ของกิจการได้มาเป็น</strong><br>
                                &nbsp; <label> <strong> </strong>
                                <input type="radio" name="BCo61" value="1" >
                                เงินสด 
                                <input type="radio" name="BCo62" value="2" >
                                ไม่ใช่เงินสด<strong> (กรณีเป็นหน่วยงานการกุศล 
                                หรือหน่วยงานไม่แสวงหากำไรไม่ต้องสอบถาม)</strong></label></td>
                                      </tr>
									  		
									  <tr bordercolor="#B3D900" > 
                      <td width="246" height="22" align="center" bgcolor="#CBE64F"><strong>ประมาณการทำธุรกิจต่อเดือน</strong></td>
                      <td width="262" align="center" bgcolor="#CBE64F"><strong>จำนวนรายการต่อเดือน</strong></td>
                      <td width="232" align="center" bgcolor="#CBE64F"><strong>มูลค่าธุรกรรมดดยประมาณ (บาท) ต่อเดือน</strong></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                      <td height="1" colspan="4" bgcolor="#E2F19E"></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                              <td height="22" align="center" bgcolor="#E2F19E">รายการฝาก+รับโอน/เดือน</td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang1_speak" id="lang1_speak">
                          <option selected="selected" value="">----- เลือก -----</option>
                          <option value="rec1">1-10</option>
                          <option value="rec2">11-20</option>
                          <option value="rec3">มากกว่า 20</option>
                        </select></td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang1_read" id="lang1_read">
                          <option selected="selected" value="">----- เลือก -----</option>
                          <option value="rec4"> <50,000  </option>
                          <option value="rec5">50,001-100,000</option>
                          <option value="rec6">100,001-500,000</option>
						  <option value="rec7">>500,001</option>
                        </select></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                              <td height="22" align="center" bgcolor="#E2F19E">รายการถอน+โอนออก/เดือน</td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang2_speak" id="lang2_speak">
                          <option selected="selected" value="">----- เลือก -----</option>
                          <option value="rec8">1-10</option>
                          <option value="rec9">11-20</option>
                          <option value="rec10">มากกว่า 20</option>
                        </select></td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang2_read" id="lang2_read">
                          <option selected="selected" value="">----- เลือก -----</option>
                          <option value="rec11"> <50,000  </option>
                          <option value="rec12">50,001-100,000</option>
                          <option value="rec13">100,001-500,000</option>
						  <option value="rec14">>500,001</option>
                        </select></td>
                    </tr>								  								  
                                
  
                                    </table></td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%">&nbsp;</td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                        <td valign="top" width="94%" class="black_b">&nbsp;</td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                            <tr valign="middle" bordercolor="#B3D900" ิborder="1" > 
                              <td  height="24" 	 colspan="2"><div align="center"><strong>บันทึกรายละเอียดโดยพนักงาน/ตัวแทน</strong></div></td>
                              <td  height="24" colspan="2"><div align="center"><strong>ตรวจสอบโดยพนักงานผู้รับมอบอำนาจ</strong></div></td>
                            </tr>
                            <tr valign="middle" bordercolor="#B3D900" ิborder="1"> 
                              <td width="179"  height="22"><strong>&nbsp;ชื่อ 
                                : 
                                <input type="text" name="recname" size="20">
                                </strong></td>
                              <td width="181"  height="22"><strong>&nbsp;ตำแหน่ง 
                                : 
                                <input type="text" name="recposition" size="15">
                                </strong></td>
                              <td width="181"  height="22"><strong>&nbsp;ชื่อ 
                                : </strong><input type="text" name="checkername" size="20"></td>
                              <td width="185"  height="22"><strong>&nbsp;ตำแหน่ง 
                                : </strong><input type="text" name="checkerposition" size="15"></td>
                            </tr>
                            <tr valign="top" bordercolor="#B3D900" border="1"> 
                              <td  height="22" colspan="2" ><strong>&nbsp;ความเห็น 
                                :</strong> <textarea name="textarea"></textarea></td>
                              <td  height="22" colspan="2"><strong>&nbsp;ความเห็น 
                                : 
                                <textarea name="textarea2"></textarea>
                                </strong> </td>
                            </tr>
                            <tr valign="middle" bordercolor="#B3D900" ิborder="1"> 
                              <td  height="22" colspan="2">&nbsp;สมควรจัดระดับความเสี่ยงเป็น 
                                <input type="radio" name="risk1" value="1">
                                ระดับ 
                                <input type="radio" name="risk2" value="2">
                                ระดับ2 
                                <input type="radio" name="risk3" value="3">
                                ระดับ3</td>
                              <td  height="22" colspan="2">&nbsp;</td>
                            </tr>
                            <tr valign="middle" bordercolor="#B3D900" ิborder="1"> 
                              <td width="179"  height="22">&nbsp;ลายเซ็นต์ 
                                ..........................................</td>
                              <td width="181"  height="22">&nbsp;วันที่....................................................</td>
                              <td width="181"  height="22">&nbsp;ลายเซ็นต์ 
                                ..........................................</td>
                              <td width="185"  height="22">&nbsp;วันที่....................................................</td>
                            </tr>
                          </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
										  
						  
                        </td>
                      </tr>
                    </table>
        
					
                    <!------2------->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="#ECF83B">
                      <tr> 
                        <td width="3%" valign="top"><img src="images/c1.gif" width="6" height="6"></td>
                        <td width="94%" valign="bottom" align="right"> </td>
                        <td align="right" width="3%" valign="top"><img src="images/c2.gif" width="6" height="6"></td>
                      </tr>
                                            <tr> 
                        <td width="3%" valign="bottom">&nbsp;</td>
                        <td width="94%" valign="bottom" align="right"> 
                          <input type="submit" value=" ต่อไป &gt; " style="cursor:hand" name="submit4">
                          <img src="images/spacer.gif" width="97" height="25" align="absmiddle"></td>
                        <td align="right" width="3%" valign="bottom">&nbsp;</td>
                      </tr>
                                            <tr> 
                        <td width="3%" valign="bottom"><img src="images/c3.gif" width="6" height="6"></td>
                        <td width="94%" valign="bottom" align="right"></td>
                        <td align="right" width="3%" valign="bottom"><img src="images/c4.gif" width="6" height="6"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </form>
              <tr> 
                <td valign="top" align="right"><a href="#top"><img src="images/gotop.gif" width="41" height="21" border="0" vspace="3" align="absmiddle"></a> 
                </td>
              </tr>
            </table>
</body>
</html>
