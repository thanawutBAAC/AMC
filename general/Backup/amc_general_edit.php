<? include ("checkuser.php");?>
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
          <td height="10" align="center" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="29" valign="bottom" class="boxleft50"><img src="images/head_general.jpg" width="223" height="23"></td>
                <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
                  <? 
				//echo '$amc = '.$amc.'<br>';
				//include ("images/lib/ms_database.php");

		  		if($username!="" && $password!="")
				{
					echo $login_user;
			?>
                  <a class=link_red href="javascript: if(confirm('��ͧ��÷����͡�ҡ�к�������� !!')){ window.location='logout.php';}">�͡�ҡ�к�</a> 
                  <?
				}	
			?>
                  </span></span></td>
              </tr>
            </table>
            <form name="form1" method="get" action="amc_general_editdata.php">
              <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="60%" border="0" class=font1 bgcolor=white>
                <tr align=center class=font1 style="color:#333333;"> 
                  <td height="19" colspan=4 align=left bgcolor="#92AED1"><b>&nbsp; 
                    &nbsp;�����ŷ���� </b></td>
                </tr>
                <tr align="left" bgcolor="#C8D7E3" class=font1 style="color:#333333"> 
                  <td height="20" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo '- ��չ�֡�����ŷ���� ʡ�.'.$amcname;?></td>
                  <?
						include ("images/lib/ms_database.php");
						$a=date('d-m');
						$b=(date('Y')+543);
						$day=$a.'-'.$b;
								//echo $day;
						
						$sql=" SELECT * FROM AMC  A " ;
						$sql.=" LEFT JOIN  ";
						$sql.= "(SELECT * FROM USERLOGIN)AS B ON A.AMCCODE=B.AMCCODE ";
						$sql.=" WHERE A.AMCCODE='$amc' ";
						//echo $sql;
						$exsql=mssql_query($sql);
						$data=mssql_fetch_row($exsql);
						//echo $data[amcname];
						
					

				?>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">1</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">�Ţ����¹ 
                    ʡ�. : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="textfield32" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[0]))?>" disabled></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">2</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >���� 
                    ʡ�. : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="textfield33" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[16]))?>"  disabled></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">3</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >�ѹ��訴����¹ 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"> 
                    <input name="txt_amcregisdate" type="text" id="amcregisdate" size="10" maxlength="10" readonly=""  value="<?echo  ltrim(rtrim($data[6]))?>" style="	height: 20px; width: 180px;" > 
                    <img src="images/calendar_02.gif" alt=".���͡�ѹ���." width="14" height="16" align="absmiddle" onClick=" return showCalendar('amcregisdate','dd-mm-y');" onMouseOver="this.style.cursor='hand'"; > 
                    &lt;&lt; ���͡�ѹ���</td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">4</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">����� 
                    ʡ�. : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><textarea name="area_amcaddress" style="	height: 60px; width: 200px; font-size: 10pt; font-family: "microsoft sans serif";><?echo  ltrim(rtrim($data[2]))?></textarea ></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">5</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >�����Ţ���Ѿ�� 
                    :</td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcphone" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[3]))?>"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">6</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">�����Ţ 
                    wan : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcwan" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[5]))?>"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">7</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;" >Fax. 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcfax" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[4]))?>"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">8</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">Internet 
                    �ͧ ʡ�. : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input type="radio" name="rad_amcnet" value="1" <? if($data[14=="1"] ){echo "checked";} ?>>
                    �� 
                    <input type="radio" name="rad_amcnet" value="0" <? if($data[14]=="0") { echo "checked";}?> >
                    ����� </td>
                </tr>
                <tr style="color:#666666;"> 
                  <td rowspan="3" align=center bgcolor="#F0F0F0">9</td>
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;"   >����-ʡ�� 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcposition_1_name" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[9]))?>"></td>
                </tr>
                <tr style="color:#666666;"> 
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10" >���˹� 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcposition_1" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[8]))?>"></td>
                </tr>
                <tr style="color:#666666;"> 
                  <td align="left" bgcolor="#F0F0F0" class="boxleft10">�����Ţ���Ѿ�� 
                    : </td>
                  <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><input name="txt_amcposition_1_phone" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[10]))?>"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td rowspan="3" align=center bgcolor="#F0F0f0">10</td>
                  <td align="left" bgcolor="#F0F0f0" class="boxleft10" style="border:1px solid #F0F0F0;" >����-ʡ�� 
                    :</td>
                  <td height="20" align="left" bgcolor="#f0f0f0" class="boxleft10"><input name="txt_amcposition_2_name" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[12]))?>"></td>
                </tr>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td align="left" class="boxleft10" style="border:1px solid #F0F0F0;" >���˹� 
                    :</td>
                  <td height="20" align="left" class="boxleft10"><input name="txt_amcposition_2" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[11]))?>"></td>
                </tr>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td align="left" class="boxleft10" style="border:1px solid #F0F0F0;" >�����Ţ���Ѿ�� 
                    : </td>
                  <td height="20" align="left" class="boxleft10"><input name="txt_amcposition_2_phone" type="text"  style="	height: 20px; width: 180px;" value="<?echo  ltrim(rtrim($data[13]))?>"></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td width="5%" height="20" align=center bgcolor="#F0F0F0">11</td>
                  <td width="25%" align="left" bgcolor="#F0F0F0" class="boxleft10" style="border:1px solid #F0F0F0;">�����˵� 
                    : </td>
                  <td width="70%" height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><textarea name="area_amcremark" style="	height: 40px; width: 200px; font-size: 10pt; font-family: "microsoft sans serif";><?echo ltrim(rtrim($data[15]));?></textarea ></td>
                </tr>
                <tr align=center class=font1 style="color:#666666;"> 
                  <td height="3"colspan="3" bgcolor="#C8D7E3"></td>
                </tr>
              </table>
              <br>
               <input name="Submit23" type="button" class="formButton" value=" Back "  onMouseOver="this.style.cursor='hand'" onClick="self.location.href=('amc.php')" > 
            &nbsp; <input name="Submit2" type="submit" class="formButton" value="Submit" onClick="javascript: if(confirm('�ѹ�֡�����ŷ���� ʡ�.')){ window.location='amc_general_editdata.php';}" onMouseOver="this.style.cursor='hand'"> 
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
		echo '<script>alert("�ѹ�֡���������º��������");</script>'; 
		$save=1;
	}
?>
</body>
</body>
</html>
