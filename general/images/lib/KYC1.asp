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
                              <td width="29%"> <strong>&nbsp;������ KYC Checklist</strong></td>
                                          <td width="71%"> 
                                            <select name="KYCType" size="1" class="normal">
                                              <option value=""> ���͡������
                                              <option value="P"   > �ؤ�Ÿ�����                                                                                         
											  <option value="L"   > �ԵԺؤ��                                                                                            
											  </select>
                                          </td>
                                        </tr>
                                        <tr> 
                                          
                              <td width="29%"><strong>&nbsp;�Ң�</strong></td>
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
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;�����źѭ���Թ�ҡ</strong></td>
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
                                        
                              <td width="143" height="22">&nbsp;<strong>�ѭ���Ţ��� 
                                : </strong></td>
                                        <td colspan="2"><input type="text" name="AccountNumber" class="normal" value=""></td>
                                      </tr>	
	                                 <tr valign="middle">
                                        
                              <td width="143" height="24">&nbsp;<strong>���ͺѭ�� 
                                : </strong></td>
                                        <td colspan="2"><input type="text" name="AccountName" class="normal" value=""></td>
                            </tr>								  						
                            <tr> 
                              <td width="25%"><strong>&nbsp;������ѭ��</strong></td>
                              <td colspan="2".> <select name="Deposittype_Code" size="1" class="normal">
                                  <option value="">���͡�������ѭ��
                                  <option value="A1"   > �����Ѿ��
                                  <option value="A2"   > ���������ѹ
                                  <option value="A4"   > ��Ш�
                                  <option value="7"   > ����Թ
                                  <option value="A6"   > ���͡��ŧ�ع�����
                                  <option value="A7"   > �ѡ�ҷ�Ѿ��
                                  <option value="A8"   > ����
                                  </select> 
                              </td>
                            </tr>
							 <tr> 
                              <td width="25%">&nbsp;<strong>�ӹǹ�Թ����Դ�ѭ��/�Ӹ�á��� </strong></td>
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
					<!--  Section A  �ԵԺؤ��-->
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
                    A - �����ž�鹰ҹ�١���</strong></td>
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
                              <!--<td width="29%"> <strong>������ KYC Checklist</strong></td>-->
                              <td colspan="3"  height="22">&nbsp;<strong>KYC Checklist 
                                ����Ѻ��Ңͧ�ѭ��ԵԺؤ��</strong></td>
                            </tr>
                            <tr> 
                              <td width="63" 
height=27 align=middle bgcolor="#f5fbc5"><strong>����</strong></td>
                              <td width="121" 
height=27 align=middle bgcolor="#f5fbc5">������</td>
                              <td 
                                height=27 align=left bgcolor="#f5fbc5"  colspan="2"><input type="text" name="b2name"></td>
                              <!--<TD align=middle width="6%" height=26>�ҡ��</TD>
                                <TD align=middle width="6%" height=26>�֧��</TD>
                                <TD align=middle width="24%" 
                                height=26>�زԷ�����Ѻ����Ң��Ԫ��͡</TD>
                                <TD align=middle width="9%" 
                                height=26>�ô<BR>�����</TD>-->
                            </tr>
                            <tr> 
                              <td align=middle width="63" 
height=26>&nbsp;</td>
                              <td width="121" 
height=26 align=middle bgcolor="#f5fbc5">����ѧ���</td>
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
                            <tr valign="middle" �border="1"> 
                              <td bordercolor="#B3D900"  height="22" colspan="2">&nbsp;<strong>�Ţ���ѵû�Шӵ�Ǽ�����������ҡ� 
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
                              <td valign=middle align=middle colspan="2" rowspan="6"><div align="left"><strong>��è�����¹ 
                                  :</strong></div></td>
                              <td height="20" colspan="2" valign=middle> <strong>������</strong> 
                                <input type="checkbox" name="LAType1" value="1">��ҧ�����ǹ 
								<input type="checkbox" name="LAType2" value="2">����ѷ 
								<input type="checkbox" name="LAType3" value="3">��Ҥ� 
								<input type="checkbox" name="LAType4" value="4">��ŹԸ� 
								<input type="checkbox" name="LAType5" value="5">�Ѵ 
                                <input type="checkbox" name="LAType6" value="6">���� �к� 
                                <input type="text" name="LAType6Other" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td height="23" colspan="2" valign=middle><strong>�͡����Ӥѭ�ʴ���</strong> 
                              </td>
                            </tr>
                            <tr> 
                              <td valign=top colspan="2"> 
							  	<input type="checkbox" name="checkbox11" value="checkbox">˹ѧ����Ѻ�ͧ 
                                <input type="checkbox" name="checkbox112" value="checkbox">�͹حҵ�Ѵ��� 
                                <input type="checkbox" name="checkbox114" value="checkbox">��Ӥѭ������¹�ҹԪ�� 
                                <input type="checkbox" name="checkbox24" value="checkbox">���� �к� 
                                <input type="text" name="other22" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td width="554" height="22" valign=top>�Ţ��� 
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
                              <td width="554" height="20">�ѹ����͡�ѵ� 
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
                                  <option value="1" >���Ҥ� 
                                  <option value="2" >����Ҿѹ�� 
                                  <option value="3" >�չҤ� 
                                  <option value="4" >����¹ 
                                  <option value="5" >����Ҥ� 
                                  <option value="6" >�Զع�¹ 
                                  <option value="7" >�á�Ҥ� 
                                  <option value="8" >�ԧ�Ҥ� 
                                  <option value="9" >�ѹ��¹ 
                                  <option value="10" >���Ҥ� 
                                  <option value="11" >��Ȩԡ�¹ 
                                  <option value="12" >�ѹ�Ҥ� </select> <select name="B2select1Y" class="normal">
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
                              <td width="554" height="19">�ѹ���������� 
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
                                  <option value="1" >���Ҥ� 
                                  <option value="2" >����Ҿѹ�� 
                                  <option value="3" >�չҤ� 
                                  <option value="4" >����¹ 
                                  <option value="5" >����Ҥ� 
                                  <option value="6" >�Զع�¹ 
                                  <option value="7" >�á�Ҥ� 
                                  <option value="8" >�ԧ�Ҥ� 
                                  <option value="9" >�ѹ��¹ 
                                  <option value="10" >���Ҥ� 
                                  <option value="11" >��Ȩԡ�¹ 
                                  <option value="12" >�ѹ�Ҥ� </select> <select name="B2select2Y" class="normal">
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
                            <tr valign="middle" �border="1"> 
                              <td bordercolor="#B3D900"  height="22" colspan="2">&nbsp;<strong>�ó���˹��§ҹ��á��� 
                                ����˹��§ҹ�����ǧ�ҡ��� : </strong></td>
                              <td  bordercolor="#B3D900"  height="22"><input type="checkbox" name="checkbox113" value="checkbox">
                                �������ҨѴ�������Թ 10 �� <input type="checkbox" name="checkbox1122" value="checkbox">
                                �Ѵ����Թ 10 �� <input type="checkbox" name="checkbox1142" value="checkbox">
                                ������Թ 800 ��ҹ/��</td>
                            </tr>
                            <!--<tr >
                                        <td height="22" colspan="3" bordercolor="#B3D900">&nbsp;<strong>�Ţ���ѵû�ЪҪ� 
                                          / ˹ѧ����Թ�ҧ / 㺵�ҧ���� :</strong></td>
                                      </tr> -->
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>��������áԨ 
                                : </strong></td>
                              <td width="554" bordercolor="#B3D900"><input type="text" name="BssType" class="normal" value="" size="50"></td>
                            </tr>
                            <tr> 
                              <td valign=top align=middle colspan="2" rowspan="2"><div align="left"><strong>ʶҹ����駨�����¹</strong></div></td>
                              <td valign=middle > �Ţ���&nbsp;
                                <input type="text" name="B2IDAddNo" size="7">
                                &nbsp; ����&nbsp;
                                <input type="text" name="B2IDAddMoo" size="2">
                                &nbsp; ���&nbsp;
                                <input type="text" name="B2IDAddSoi" size="10">
                                &nbsp; ���&nbsp;
                                <input type="text" name="B2IDAddRoad" size="10">
                                &nbsp; �Ӻ�&nbsp;
                                <input type="text" name="B2IDAddTumbol" size="10">
                                &nbsp; �����&nbsp;
                                <input type="text" name="B2IDAddAmphor" size="10">
                                &nbsp; </td>
                            </tr>
                            <tr valign=top> 
                              <td width=554> <table class=normal cellspacing=0 cellpadding=0 
                                width="100%" border=0>
                                  <tbody>
                                    <tr valign=top> 
                                      <td width="11%">�ѧ��Ѵ</td>
                                      <td width="34%"><select class=normal 
                                name=address_prov>
                                          <option value="" 
                                selected> 
                                          <option value=1>��� 
                                          <option 
                                value=2>��к�� 
                                          <option value=3>�ҭ������ 
                                          <option 
                                value=4>����Թ��� 
                                          <option 
                                value=5>��ᾧྪ� 
                                          <option value=6>�͹�� 
                                          <option 
                                value=7>�ѹ����� 
                                          <option 
                                value=8>���ԧ��� 
                                          <option value=9>�ź��� 
                                          <option 
                                value=10>��¹ҷ 
                                          <option value=11>������� 
                                          <option 
                                value=12>����� 
                                          <option value=13>��§��� 
                                          <option 
                                value=14>��§���� 
                                          <option value=15>��ѧ 
                                          <option 
                                value=16>��Ҵ 
                                          <option value=17>�ҡ 
                                          <option 
                                value=18>��ù�¡ 
                                          <option value=19>��û�� 
                                          <option 
                                value=20>��þ�� 
                                          <option 
                                value=21>����Ҫ���� 
                                          <option 
                                value=22>�����ո����Ҫ 
                                          <option 
                                value=23>������ä� 
                                          <option 
                                value=24>������� 
                                          <option value=25>��Ҹ���� 
                                          <option 
                                value=26>��ҹ 
                                          <option value=27>��������� 
                                          <option 
                                value=28>�����ҹ� 
                                          <option 
                                value=29>��ШǺ���բѹ�� 
                                          <option 
                                value=30>��Ҩչ���� 
                                          <option 
                                value=31>�ѵ�ҹ� 
                                          <option value=32>����� 
                                          <option 
                                value=33>�ѧ�� 
                                          <option value=34>�ѷ�ا 
                                          <option 
                                value=35>�ԨԵ� 
                                          <option value=36>��ɳ��š 
                                          <option 
                                value=37>ྪú��� 
                                          <option 
                                value=38>ྪú�ó� 
                                          <option value=39>��� 
                                          <option 
                                value=40>���� 
                                          <option value=41>�����ä�� 
                                          <option 
                                value=42>�ء����� 
                                          <option 
                                value=43>�����ͧ�͹ 
                                          <option value=44>��ʸ� 
                                          <option 
                                value=45>���� 
                                          <option value=46>������� 
                                          <option 
                                value=47>�йͧ 
                                          <option value=48>���ͧ 
                                          <option 
                                value=49>�Ҫ���� 
                                          <option value=50>ž���� 
                                          <option 
                                value=51>�ӻҧ 
                                          <option value=52>�Ӿٹ 
                                          <option 
                                value=53>��� 
                                          <option value=54>������� 
                                          <option 
                                value=55>ʡŹ�� 
                                          <option value=56>ʧ��� 
                                          <option 
                                value=57>ʵ�� 
                                          <option value=58>��طû�ҡ�� 
                                          <option 
                                value=59>��ط�ʧ���� 
                                          <option 
                                value=60>��ط��Ҥ� 
                                          <option 
                                value=61>������ 
                                          <option value=62>��к��� 
                                          <option 
                                value=63>�ԧ����� 
                                          <option 
                                value=64>��⢷�� 
                                          <option 
                                value=65>�ؾ�ó���� 
                                          <option 
                                value=66>����ɮ��ҹ� 
                                          <option 
                                value=67>���Թ��� 
                                          <option value=68>˹ͧ��� 
                                          <option 
                                value=69>˹ͧ������� 
                                          <option 
                                value=70>��ظ�� 
                                          <option value=71>��ҧ�ͧ 
                                          <option 
                                value=72>�ӹҨ��ԭ 
                                          <option 
                                value=73>�شøҹ� 
                                          <option 
                                value=74>�صôԵ�� 
                                          <option 
                                value=75>�ط�¸ҹ� 
                                          <option 
                                value=76>�غ��Ҫ�ҹ�</option>
                                        </select> </td>
                                      <td align=right width="22%">������ɳ��� 
                                        &nbsp;</td>
                                      <td width="33%"><input class=normal size=6 
                                name=address_zip maxlength="6"> </td>
                                    </tr>
                                    <tr valign=top> 
                                      <td width="11%">���Ѿ�� </td>
                                      <td width="34%"><input class=normal size=15 
                                name=address_tel> </td>
                                      <td align=right width="22%">����� &nbsp; 
                                      </td>
                                      <td width="33%"><input class=normal size=15 
                                name=address_fax> </td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr> 
                              <td valign=top align=middle colspan="2" rowspan="2"><div align="left"><strong>ʶҹ����駷ӡ��</strong></div></td>
                              <td valign=middle colspan=5> �Ţ���&nbsp;
                                <input type="text" name="B2AddNo" size="7">
                                &nbsp; ����&nbsp;
                                <input type="text" name="B2AddMoo" size="2">
                                &nbsp; ���&nbsp;
                                <input type="text" name="B2AddSoi" size="10">
                                &nbsp; ���&nbsp;
                                <input type="text" name="B2AddRoad" size="10">
                                &nbsp; �Ӻ�&nbsp;
                                <input type="text" name="B2AddTumbol" size="10">
                                &nbsp; �����&nbsp;
                                <input type="text" name="B2AddAmphor" size="10">
                                &nbsp; </td>
                            </tr>
                            <tr valign=top> 
                              <td width=554> <table class=normal cellspacing=0 cellpadding=0 
                                width="100%" border=0>
                                  <tbody>
                                    <tr valign=top> 
                                      <td width="12%">�ѧ��Ѵ</td>
                                      <td width="33%"><select class=normal 
                                name=address_prov>
                                          <option value="" 
                                selected> 
                                          <option value=1>��� 
                                          <option 
                                value=2>��к�� 
                                          <option value=3>�ҭ������ 
                                          <option 
                                value=4>����Թ��� 
                                          <option 
                                value=5>��ᾧྪ� 
                                          <option value=6>�͹�� 
                                          <option 
                                value=7>�ѹ����� 
                                          <option 
                                value=8>���ԧ��� 
                                          <option value=9>�ź��� 
                                          <option 
                                value=10>��¹ҷ 
                                          <option value=11>������� 
                                          <option 
                                value=12>����� 
                                          <option value=13>��§��� 
                                          <option 
                                value=14>��§���� 
                                          <option value=15>��ѧ 
                                          <option 
                                value=16>��Ҵ 
                                          <option value=17>�ҡ 
                                          <option 
                                value=18>��ù�¡ 
                                          <option value=19>��û�� 
                                          <option 
                                value=20>��þ�� 
                                          <option 
                                value=21>����Ҫ���� 
                                          <option 
                                value=22>�����ո����Ҫ 
                                          <option 
                                value=23>������ä� 
                                          <option 
                                value=24>������� 
                                          <option value=25>��Ҹ���� 
                                          <option 
                                value=26>��ҹ 
                                          <option value=27>��������� 
                                          <option 
                                value=28>�����ҹ� 
                                          <option 
                                value=29>��ШǺ���բѹ�� 
                                          <option 
                                value=30>��Ҩչ���� 
                                          <option 
                                value=31>�ѵ�ҹ� 
                                          <option value=32>����� 
                                          <option 
                                value=33>�ѧ�� 
                                          <option value=34>�ѷ�ا 
                                          <option 
                                value=35>�ԨԵ� 
                                          <option value=36>��ɳ��š 
                                          <option 
                                value=37>ྪú��� 
                                          <option 
                                value=38>ྪú�ó� 
                                          <option value=39>��� 
                                          <option 
                                value=40>���� 
                                          <option value=41>�����ä�� 
                                          <option 
                                value=42>�ء����� 
                                          <option 
                                value=43>�����ͧ�͹ 
                                          <option value=44>��ʸ� 
                                          <option 
                                value=45>���� 
                                          <option value=46>������� 
                                          <option 
                                value=47>�йͧ 
                                          <option value=48>���ͧ 
                                          <option 
                                value=49>�Ҫ���� 
                                          <option value=50>ž���� 
                                          <option 
                                value=51>�ӻҧ 
                                          <option value=52>�Ӿٹ 
                                          <option 
                                value=53>��� 
                                          <option value=54>������� 
                                          <option 
                                value=55>ʡŹ�� 
                                          <option value=56>ʧ��� 
                                          <option 
                                value=57>ʵ�� 
                                          <option value=58>��طû�ҡ�� 
                                          <option 
                                value=59>��ط�ʧ���� 
                                          <option 
                                value=60>��ط��Ҥ� 
                                          <option 
                                value=61>������ 
                                          <option value=62>��к��� 
                                          <option 
                                value=63>�ԧ����� 
                                          <option 
                                value=64>��⢷�� 
                                          <option 
                                value=65>�ؾ�ó���� 
                                          <option 
                                value=66>����ɮ��ҹ� 
                                          <option 
                                value=67>���Թ��� 
                                          <option value=68>˹ͧ��� 
                                          <option 
                                value=69>˹ͧ������� 
                                          <option 
                                value=70>��ظ�� 
                                          <option value=71>��ҧ�ͧ 
                                          <option 
                                value=72>�ӹҨ��ԭ 
                                          <option 
                                value=73>�شøҹ� 
                                          <option 
                                value=74>�صôԵ�� 
                                          <option 
                                value=75>�ط�¸ҹ� 
                                          <option 
                                value=76>�غ��Ҫ�ҹ�</option>
                                        </select> </td>
                                      <td align=right width="22%">������ɳ��� 
                                        &nbsp;</td>
                                      <td width="33%"><input class=normal size=6
                                name=address_zipcode maxlength="6"> </td>
                                    </tr>
                                    <tr valign=top> 
                                      <td width="12%">���Ѿ�� </td>
                                      <td width="33%"><input class=normal size=15 
                                name=address_tel> </td>
                                      <td align=right width="22%">����� &nbsp; 
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
			
				<!--  Section A  ��ؤ�Ÿ�����-->
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
                    A - �����ž�鹰ҹ�١���</strong></td>
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
                              <!--<td width="29%"> <strong>������ KYC Checklist</strong></td>-->
                              <td colspan="3"  height="22">&nbsp;<strong>KYC Checklist 
                                ����Ѻ��Ңͧ�ѭ�պؤ�� �����Ңͧ�ѭ���������Ф�</strong></td>
                            </tr>
                            <tr> 
                              <td width="61" 
height=26 align=middle bgcolor="#f5fbc5"><strong>���͹ԵԺؤ��</strong></td>
                              <td width="109" 
height=26 align=middle bgcolor="#f5fbc5">������</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5"  colspan="2"><input type="text" name="b2name"></td>
                              <!--<TD align=middle width="6%" height=26>�ҡ��</TD>
                                <TD align=middle width="6%" height=26>�֧��</TD>
                                <TD align=middle width="24%" 
                                height=26>�زԷ�����Ѻ����Ң��Ԫ��͡</TD>
                                <TD align=middle width="9%" 
                                height=26>�ô<BR>�����</TD>-->
                            </tr>
                            <tr> 
                              <td align=middle width="61" 
height=26>&nbsp;</td>
                              <td width="109" 
height=26 align=middle bgcolor="#f5fbc5">����ѧ���</td>
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
                              <td valign=middle align=middle colspan="2" rowspan="5"><div align="left"><strong>�ѵ��Ӥѭ��Шӵ��</strong></div></td>
                              <td height="25" colspan="2" valign=middle><input type="checkbox" name="checkbox9" value="checkbox">
                                �ѵû�ЪҪ� 
                                <input type="checkbox" name="checkbox22" value="checkbox">
                                �ѵâ���Ҫ���/�Ѱ����ˡԨ 
                                <input type="checkbox" name="checkbox32" value="checkbox">
                                �ѵþ�ѡ�ҹͧ��� 
                                <input type="checkbox" name="checkbox10" value="checkbox">
                                ˹ѧ����Թ�ҧ 
                                <input type="checkbox" name="checkbox23" value="checkbox">
                                �ѵ�͹حҵ�Ѻ���</td>
                            </tr>
                            <tr> 
                              <td valign=top colspan="2"><input type="checkbox" name="checkbox11" value="checkbox">
                                �ѵû�Шӵ�Ǽ���������� 
                                <input type="checkbox" name="checkbox24" value="checkbox">
                                ���� �к� 
                                <input type="text" name="other22" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td width="568" height="22" valign=top>�Ţ��� 
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
                              <td width="568" height="20">�ѹ����͡�ѵ� 
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
                                  <option value="1" >���Ҥ� 
                                  <option value="2" >����Ҿѹ�� 
                                  <option value="3" >�չҤ� 
                                  <option value="4" >����¹ 
                                  <option value="5" >����Ҥ� 
                                  <option value="6" >�Զع�¹ 
                                  <option value="7" >�á�Ҥ� 
                                  <option value="8" >�ԧ�Ҥ� 
                                  <option value="9" >�ѹ��¹ 
                                  <option value="10" >���Ҥ� 
                                  <option value="11" >��Ȩԡ�¹ 
                                  <option value="12" >�ѹ�Ҥ� </select> <select name="B2select1Y" class="normal">
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
                              <td width="568" height="19">�ѹ���������� 
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
                                  <option value="1" >���Ҥ� 
                                  <option value="2" >����Ҿѹ�� 
                                  <option value="3" >�չҤ� 
                                  <option value="4" >����¹ 
                                  <option value="5" >����Ҥ� 
                                  <option value="6" >�Զع�¹ 
                                  <option value="7" >�á�Ҥ� 
                                  <option value="8" >�ԧ�Ҥ� 
                                  <option value="9" >�ѹ��¹ 
                                  <option value="10" >���Ҥ� 
                                  <option value="11" >��Ȩԡ�¹ 
                                  <option value="12" >�ѹ�Ҥ� </select> <select name="B2select2Y" class="normal">
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
                              <td height="24" colspan="2" align=middle valign=middle rowspan="3"><div align="left"><strong>��/�ѭ�ҵ�/�.�.�.�Դ</strong></div></td>
                              <td width="568" height="23" valign=middle>&nbsp; <strong>��</strong> 
                                <input type=radio value=gender=f>
                                ˭ԧ 
                                <input type=radio value=gender=m>
                                ���</td>
                            </tr>
                            <tr> 
                              <td width="568" height="26" valign=top>&nbsp; <strong>�ѭ�ҵ�</strong> 
                                <input type=radio value=gender=f>
                                �� 
                                <input type=radio value=gender=m>
                                ���� �к� 
                                <input type="text" name="other2" class="normal" value="" size="15"></td>
                            </tr>
                            <tr> 
                              <td width="568" height="20" valign=top>&nbsp;<strong>�ѹ/��͹/���Դ 
                                (�.�.)</strong> <select name="select2" size="1" class="normal">
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
                                  <option value="1" >���Ҥ� 
                                  <option value="2" >����Ҿѹ�� 
                                  <option value="3" >�չҤ� 
                                  <option value="4" >����¹ 
                                  <option value="5" >����Ҥ� 
                                  <option value="6" >�Զع�¹ 
                                  <option value="7" >�á�Ҥ� 
                                  <option value="8" >�ԧ�Ҥ� 
                                  <option value="9" >�ѹ��¹ 
                                  <option value="10" >���Ҥ� 
                                  <option value="11" >��Ȩԡ�¹ 
                                  <option value="12" >�ѹ�Ҥ� </select> <select name="select2" class="normal">
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
                                        <td height="22" colspan="3" bordercolor="#B3D900">&nbsp;<strong>�Ţ���ѵû�ЪҪ� 
                                          / ˹ѧ����Թ�ҧ / 㺵�ҧ���� :</strong></td>
                                      </tr> -->
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>�Ҫվ���ͻ�������áԨ 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Occupation" class="normal" value=""></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>���˹� 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Position" class="normal" value=""></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>ʶҹ���ӧҹ 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="Workplace" class="normal" value="" size="75"></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>����������ѵû�ЪҪ� 
                                : </strong></td>
                              <td width="568" bordercolor="#B3D900"><input type="text" name="IdcardAddress" class="normal" value="" size="75"></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2">&nbsp;<strong>ʶҹ����дǡ㹡�õԴ��� 
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
                    B - �����ŷ����繵�ͧ�ͺ���</strong></td>
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
                                        <!--<td width="29%"> <strong>������ KYC Checklist</strong></td>-->
                                        <td  height="25" colspan="3" bordercolor="#B3D900">&nbsp;<strong>1. ʶҹС�õ�Ǩ�ͺ : �ա�õ�Ǩ�ͺ��������ٻ��ó�ѳ�ҹ�ͧ�١���� Sanctions ��� PEP List 
                                          <input type="radio" name="PEP" value="1" >
��
 <input type="radio" name="PEP" value="2" >
�����
<label></label>
                                        </strong></td>
                                      </tr>
									   <tr >
										<td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>2. �ա�õ�Ǩ�ͺ���� : �ա�õ�Ǩ�ͺ���� �ѹ�Դ ����ѭ�ҵԢͧ�١��� ����͡����ʴ��� �ҡ��Ѻ��ԧ �������һ�зѺ˹��§ҹ����͡�͡��� </strong>(�����) <br>
										  &nbsp;<strong>�ѹ�Դ �ѭ�ҵ� : "���Ǩ�ͺ�ҡ�鹩�Ѻ��ԧ" ������͡���</strong> <label>
										  <input type="checkbox" name="checkbox" value="checkbox">
										  �ѵû�ЪҪ� 
										  <input type="checkbox" name="checkbox2" value="checkbox">
										  ˹ѧ����Թ�ҧ 
										  <input type="checkbox" name="checkbox3" value="checkbox">
										  㺵�ҧ����</label></td>
                                      </tr>
									  <tr valign="middle">
                                        <!--<td width="29%"> <strong>������ KYC Checklist</strong></td>-->
                                        <td  height="25" colspan="3" bordercolor="#B3D900">&nbsp;<strong>3. ��Ǩ�ͺ������� : �ա�õ�Ǩ�ͺ�������ҡ��ѡ�ҹ�������ʴ�������� 
                                          <label>
                                          <input type="checkbox" name="checkbox4" value="checkbox">
                                          �ѵû�ЪҪ�</label>
                                          <label>
                                          <input type="checkbox" name="checkbox5" value="checkbox">
                                          ˹ѧ����Ѻ�ͧ��è�����¹</label>
                                        </strong></td>
                                      </tr>
										<tr >
										<td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>4. �ѵ�ػ��ʧ��㹡���Դ�ѭ�� : �к��ѵ�ػ��ʧ�� ���͡���ҡ���� 1 ��� </strong><br>
										  &nbsp;<label>
										  <input type="checkbox" name="checkbox" value="checkbox">
										  ����Թ 
										  <input type="checkbox" name="checkbox2" value="checkbox">
										  ���ŧ�ع㹸�áԨ
										  <input type="checkbox" name="checkbox3" value="checkbox">
										  �Ѻ/�����Թ��� 
										  <input type="checkbox" name="checkbox6" value="checkbox">
										  �ѭ���Թ��͹ 
										  <input type="checkbox" name="checkbox7" value="checkbox">
										  ���Ф���Ҹ�óٻ��� 
										  <input type="checkbox" name="checkbox8" value="checkbox">
										  ���� �ô�к� </label><input type="text" name="other" class="normal" value=""></td>
                                      </tr>
											<tr >
										<td  height="52" colspan="3" bordercolor="#B3D900">&nbsp;<strong>5. ���觷���Ңͧ�Թ�ҡ : ���觷���Ңͧ�Թ�ҡ ���͡���ҡ���� 1 ��� </strong><input type="radio" name="PEP" value="1" >
�Թ���
  <input type="radio" name="PEP" value="2" >
                                ��áԨ��ǹ���<br>
										  &nbsp;<label>
										  <input type="checkbox" name="checkbox" value="checkbox">
										  �Ѻ��ҧ 
										  <input type="checkbox" name="checkbox2" value="checkbox">
										  �ô�/�ͧ��ѭ
										  <input type="checkbox" name="checkbox3" value="checkbox">
										  �����ѡ��Ѿ��/˹���ŧ�ع 
										  <input type="checkbox" name="checkbox6" value="checkbox">
										  ��Ң�� 
										   
										  <input type="checkbox" name="checkbox8" value="checkbox">
										  ���� �ô�к� </label><input type="text" name="other" class="normal" value=""></td>
                                      </tr>
									  
									  <tr >
										
                              <td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>6. 
                                <!-- ੾�йԵԺؤ��-->
                                �������ǹ�˭�ͧ�Ԩ���������</strong><br>
                                &nbsp; <label> <strong> </strong>
                                <input type="radio" name="BCo61" value="1" >
                                �Թʴ 
                                <input type="radio" name="BCo62" value="2" >
                                ������Թʴ<strong> (�ó���˹��§ҹ��á��� 
                                ����˹��§ҹ�����ǧ�ҡ�������ͧ�ͺ���)</strong></label></td>
                                      </tr>
									  		
									  <tr bordercolor="#B3D900" > 
                      <td width="246" height="22" align="center" bgcolor="#CBE64F"><strong>����ҳ��÷Ӹ�áԨ�����͹</strong></td>
                      <td width="262" align="center" bgcolor="#CBE64F"><strong>�ӹǹ��¡�õ����͹</strong></td>
                      <td width="232" align="center" bgcolor="#CBE64F"><strong>��Ť�Ҹ�á�����»���ҳ (�ҷ) �����͹</strong></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                      <td height="1" colspan="4" bgcolor="#E2F19E"></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                              <td height="22" align="center" bgcolor="#E2F19E">��¡�ýҡ+�Ѻ�͹/��͹</td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang1_speak" id="lang1_speak">
                          <option selected="selected" value="">----- ���͡ -----</option>
                          <option value="rec1">1-10</option>
                          <option value="rec2">11-20</option>
                          <option value="rec3">�ҡ���� 20</option>
                        </select></td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang1_read" id="lang1_read">
                          <option selected="selected" value="">----- ���͡ -----</option>
                          <option value="rec4"> <50,000  </option>
                          <option value="rec5">50,001-100,000</option>
                          <option value="rec6">100,001-500,000</option>
						  <option value="rec7">>500,001</option>
                        </select></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                              <td height="22" align="center" bgcolor="#E2F19E">��¡�ö͹+�͹�͡/��͹</td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang2_speak" id="lang2_speak">
                          <option selected="selected" value="">----- ���͡ -----</option>
                          <option value="rec8">1-10</option>
                          <option value="rec9">11-20</option>
                          <option value="rec10">�ҡ���� 20</option>
                        </select></td>
                      <td align="center" bgcolor="#E2F19E"><select name="lang2_read" id="lang2_read">
                          <option selected="selected" value="">----- ���͡ -----</option>
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
                            <tr valign="middle" bordercolor="#B3D900" �border="1" > 
                              <td  height="24" 	 colspan="2"><div align="center"><strong>�ѹ�֡��������´�¾�ѡ�ҹ/���᷹</strong></div></td>
                              <td  height="24" colspan="2"><div align="center"><strong>��Ǩ�ͺ�¾�ѡ�ҹ����Ѻ�ͺ�ӹҨ</strong></div></td>
                            </tr>
                            <tr valign="middle" bordercolor="#B3D900" �border="1"> 
                              <td width="179"  height="22"><strong>&nbsp;���� 
                                : 
                                <input type="text" name="recname" size="20">
                                </strong></td>
                              <td width="181"  height="22"><strong>&nbsp;���˹� 
                                : 
                                <input type="text" name="recposition" size="15">
                                </strong></td>
                              <td width="181"  height="22"><strong>&nbsp;���� 
                                : </strong><input type="text" name="checkername" size="20"></td>
                              <td width="185"  height="22"><strong>&nbsp;���˹� 
                                : </strong><input type="text" name="checkerposition" size="15"></td>
                            </tr>
                            <tr valign="top" bordercolor="#B3D900" border="1"> 
                              <td  height="22" colspan="2" ><strong>&nbsp;������� 
                                :</strong> <textarea name="textarea"></textarea></td>
                              <td  height="22" colspan="2"><strong>&nbsp;������� 
                                : 
                                <textarea name="textarea2"></textarea>
                                </strong> </td>
                            </tr>
                            <tr valign="middle" bordercolor="#B3D900" �border="1"> 
                              <td  height="22" colspan="2">&nbsp;����èѴ�дѺ��������§�� 
                                <input type="radio" name="risk1" value="1">
                                �дѺ 
                                <input type="radio" name="risk2" value="2">
                                �дѺ2 
                                <input type="radio" name="risk3" value="3">
                                �дѺ3</td>
                              <td  height="22" colspan="2">&nbsp;</td>
                            </tr>
                            <tr valign="middle" bordercolor="#B3D900" �border="1"> 
                              <td width="179"  height="22">&nbsp;����繵� 
                                ..........................................</td>
                              <td width="181"  height="22">&nbsp;�ѹ���....................................................</td>
                              <td width="181"  height="22">&nbsp;����繵� 
                                ..........................................</td>
                              <td width="185"  height="22">&nbsp;�ѹ���....................................................</td>
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
                          <input type="submit" value=" ���� &gt; " style="cursor:hand" name="submit4">
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
