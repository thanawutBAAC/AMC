<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: �к��ҹ������ ʡ�. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<?

	//session_start();
        include("images/lib/ms_database.php");
//	include("function.php");



/*if ($flag == "UPD"){
		$AMCcode ='�003838'; 
*/

		$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where AMCCode = '$amc' ";

		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
		$rs = mssql_fetch_assoc($result);

/*		if (rs.EOF)  {
			echo ("amc_general_add.php")
		}

		if (action = "edit")  {
			echo("amc_general_edit.php")
		}*/

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
<form name="form1" method="post" action="amc_general_add_save.php" >
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="328" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");

		  		if($username!="" && $password!="")
				{
					echo "�Թ�յ�͹�Ѻ<b> ʡ�.".$amcname.'</b> | ';
			?>
            <a class=link_red href="javascript: if(confirm('��ͧ��÷����͡�ҡ�к�������� !!')){ window.location='logout.php';}">�͡�ҡ�к�</a> 
            <?
				}	
			?>
            </span></span></td>
<!--         <tr>
          <td height="96" align="right" background="images/bg_head.gif"><img src="images/header_1.jpg" width="320" height="96"><img src="images/header_2.jpg" width="320" height="96"><img src="images/header_3.jpg" width="325" height="96"></td>
        </tr> -->
        <tr>
          <td align="center" valign="top"><table width="80%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="40" valign="bottom"><img src="images/head_general.jpg" width="223" height="23"></td>
			
              </tr>
              <tr>
                <td align="center" valign="top">
					<table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="70%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=3 align=left><b>&nbsp; &nbsp;�����ŷ���� 
                          </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" class="boxleft30">
						<? echo '- ʡ�. �ѧ��Ѵ '.$amcname;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">�Ţ����¹ ʡ�.
                          : </td>
                        <td align="left" class="boxleft5">
							<input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>">
						</td>
                      </tr>
						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>2.</td>
                        <td height="20" align="left" class="boxleft5">�ѹ��訴����¹
                          : </td>
                        <td align="left" class="boxleft5"><input name="AMCRegisDate" type="text" id="txt_date_start" value="<?=$rs["AMCRegisDate"]?>" size="10" maxlength="10" readonly="">
                          <img src="images/calendar_02.gif" alt=".���͡�ѹ���." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; >
                          &lt;&lt; 
                          ���͡�ѹ���</td>
                      </tr>
<!-- 						
						<td width="170" align="left" class="boxleft15"><span class="txtwhite">�ѹ��訴����¹</span></td>
                        <td><input name="AMCRegisDate" type="text" id="txt_date_start" value="<?=$rs["AMCRegisDate"]?>" size="10" maxlength="10" readonly="">
                          <img src="images/calendar.jpg" alt=".���͡�ѹ���." align="absmiddle" onclick=" return showCalendar('txt_date_start','dd-mm-y');" onmouseover="this.style.cursor='hand'"; ></td> -->


						 <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
						<td height="20" align=center>3.</td>
                        <td height="20" align="left" class="boxleft5">����� ʡ�.
                          : </td>
                        <td align="left" class="boxleft5"><textarea name="amcaddress" class="areabox80x200"><?=$rs["AMCAddress"]?></textarea></td>
						</tr>

<!-- 						<tr> 
                        <td height="30" class="txtwhite">����� ʡ�.</td>
                        <td colspan="3" class="txtwhite"><textarea name="amcaddress" class="areabox80x200"><?=$rs["AMCAddress"]?></textarea></td>
                      </tr> -->

						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="amctel" type="text" class="textbox30" maxlength="10"  value="<?=$rs["AMCTel"]?>"></td></tr>

				<!-- 		<td height="30" class="txtwhite">�����Ţ���Ѿ��</td>
                        <td class="txtwhite"><input name="amctel" type="text" class="textbox30" maxlength="10"  value="<?=$rs["AMCTel"]?>"></td> -->


                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">5. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5">�����Ţ wan
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
                        <td width="22%" height="20" align="left" class="boxleft5">Internet �ͧ ʡ�.
                          : </td>
                        <td width="69%" align="left" class="boxleft5">
								<input type="radio" name="AMCNET"  value="1"<? if($AMCNET=="1"){ echo "checked";}?>> 
								<? if($AMCNET=="1"){echo"<span class='txtgreen'>";}?>
								<? if($AMCNET=="1"){$green="</span>";}?>
								�� <? echo $green;?>
								<input type="radio" name="AMCNET"  value="0" <? if($AMCNET<>"1"){echo "checked";}?>> 
								<? if($AMCNET<>"1"){echo"<span class='txtred'>";}?>
								<? if($AMCNET<>"1"){$red="</span>";}?>
								�����<?echo $red;?>
						</td>
                      </tr>

						<tr align=center bgcolor="#BBD0E1" style="color:#BBD0E1;">
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center rowspan="3">8. </td>
                        <td height="20" align="left" class="boxleft5">����-ʡ�� ������ : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_1_Name" value="<?=$rs["AMCPosition_1_Name"]?>"></td>
                      </tr>
  
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                       <!--  <td height="20" align=center >8. </td> -->
                        <td height="20" align="left" class="boxleft5">���˹� : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_1" value="<?=$rs["AMCPosition_1"]?>"></td>
                      </tr>

					<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                      <!--   <td height="20" align=center>9.</td> -->
                        <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5"><input name="AMCPosition_1_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_1_Tel"]?>"></td></tr>
						</tr>

						<tr>
						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center rowspan="3">9. </td>
                        <td height="20" align="left" class="boxleft5" rowspan="3">����-ʡ�� ������᷹ :<br> <br>���˹� :<br><br>�����Ţ���Ѿ�� : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_2_Name" value="<?=$rs["AMCPosition_2_Name"]?>"><br><input type="text" name="AMCPosition_2" value="<?=$rs["AMCPosition_2"]?>"><br><input name="AMCPosition_2_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_2_Tel"]?>"></td>
                      </tr>
  
						</tr>

                    </table>
					<br>
							<input type="submit" name="Submit" value="�Ѵ�红�����"> 
							<input name="reset" type="submit" id="reset" value="����������">
                    </table>
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