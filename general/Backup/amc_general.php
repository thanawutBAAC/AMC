<? 
		session_start();
		include ("checkuser.php");
		$flag=$_GET["flag"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>:: �к��ҹ������ ʡ�. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
input.inpData {
	font-family: Tahoma;
	font-weight: normal;
	font-size: 9pt;
	color: black;
	border:1px solid #dddddd;
	padding-left:2px;
}
-->
</style>
</head>

<?
	//session_start();
        include("images/lib/ms_database.php");

						$sql=" SELECT * ";
						$sql.=" FROM AMC A ";
						$sql.=" LEFT OUTER JOIN ";
						$sql.=" (SELECT * ";
						$sql.=" FROM USERLOGIN)AS B ON A.AMCProvince = B.amcprovince ";

						if($amcstatus=="Y")
							{
									if($div <> '')
										{  
										$sql.=" WHERE A.AMCProvince <>'' AND A.AMCCode <>''  ";
										$sql.=" AND B.br_code='$div' "; 
										$sql.=" AND A.AMCProvince ='$lis_province' " ;
										}
									else
										{
										$sql.=" WHERE A.AMCProvince =' ' AND A.AMCCode =' '  ";
										echo '<script>alert("��س����͡ ʡ�. ������� ���� ��������������"); return false; </script>';
										}

							$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
							
							if(mssql_num_rows($result)=="0")
									{
										$flag = "NEW"; 
									}
								else
									{
										$flag = "EDIT";
									}	
							}	
							else
							{
							$sql.=" WHERE A.AMCProvince <>'' AND A.AMCCode <>''  ";
							$sql.= " AND A.AMCCode = '$amc' ";

							$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
							
										if(mssql_num_rows($result)=="0")
												{
													echo '<script>alert("�ѧ����բ����� ʡ�.");</script>';
												}
											else
												{
													$flag = "EDIT";
												}	
							}

					
			//echo $sql;
					//	$sql.=" ORDER BY  B.userdetail ";

					//		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
					//		if(mssql_num_rows($result)=="0"){
					//			$flag = "NEW"; 
					//		}else{
					//			$flag = "EDIT";
					//	//		document.form1.amccode.disabled= true;
					//		}
						$rs = mssql_fetch_assoc($result);

/*echo  "Hello World";*/
//echo  $username;
//echo  $div;
//echo  $lis_province;
//echo  $amc;
//echo  $userdetail;
//echo $AMCCode;
//echo $flag;
//			}else{
	
//						$sql =  " Select * ";
//							$sql.= " From AMC ";
//							$sql.= " Where AMCCode = '$amc' ";

//						$result = mssql_query($sql) or die('Query failed: ' . mssql_error());
//						$rs = mssql_fetch_assoc($result);

//			}

					


		
/*if (rs.EOF)  {
			echo ("amc_general_add.php");
		}

	else	if (action == "edit")  {
			echo("amc_general_edit.php");
		}*/

/*} catch(Exception $e) {
	echo 'ERROR : ' .$e->getMessage();
}
	*/
//	echo $sql;

		#$result = show_data("AMC");

?>
<!-- <script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script> -->
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<form name="checkForm" method="post" action="amc_general_save_adm.php" onsubmit="return check2();" >
<input name="flag" type="hidden" id="flag" value="<?=$flag?>">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="328" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<!-- 		<td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
				//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");

		  		if($username!="" && $password!="")
				{
					echo "�Թ�յ�͹�Ѻ<b> ʡ�.".$amcname.'</b> | ';
			?>
			<< <a class=link_white href="javascript:history.back();">��Ѻ�˹�ҷ������</a> | 
            <a class=link_red href="javascript: if(confirm('��ͧ��÷����͡�ҡ�к�������� !!')){ window.location='logout.php';}">�͡�ҡ�к�</a> 
            <?
				}	
			?>
            </span></span></td> -->
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
					 
					<?
							if($flag== "NEW"){
			
					?>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="2" class="boxleft30">
								<? echo '- ���������� ʡ�. �ѧ��Ѵ '.$rs["userdetail"]; ?>
						</td>
						 <td height="20" align="left" class="boxleft5" >
						  <?					
								echo '<select  name="list_province" >';
								$province="SELECT CAT_CC, CAT_DESC FROM CCAATTIS
								WHERE CAT_AA='00' AND CAT_TT='00' AND CAT_MM='00'AND CAT_CC<>'00'
								AND CAT_CC NOT IN (SELECT AMCProvince FROM AMC )"; 
								$exprovince=mssql_query($province);
								while($rowall=mssql_fetch_row($exprovince))
									{
										echo '<option value='.$rowall[0].'>'.$rowall[1].'</option>';
									}
										
								echo '</select>';
								?>
								
						</td>
                      </tr>
					<!--   <tr align=center bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="right" class="boxleft5" colspan="2">Usernsme
                          : </td>
                        <td align="left" class="boxleft5"><input name="password" type="text" class="textbox30" maxlength="7"  value="<?=$rs["password"]?>"></td></tr>
					  <tr align=center bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="right" class="boxleft5" colspan="2">Password
                          : </td>
                        <td align="left" class="boxleft5"><input name="password" type="text" class="textbox30" maxlength="6"  value="<?=$rs["password"]?>"></td></tr> -->

                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">�Ţ����¹ ʡ�.
                          : </td>
                        <td align="left" class="boxleft5">

							<?

						/*		$query = " SELECT * ";
								$query. =" FROM AMC A ";
								$query. = " LEFT OUTER JOIN ";
								$query. = " (SELECT * ";
								$query. = " FROM USERLOGIN)AS B ON A.AMCProvince = B.amcprovince ";
								$query. = " WHERE A.AMCCode = '$AMCCode' ";
								$result = mssql_query($query);

										if(mssql_num_rows($result)==0){
											return true;
										}else{
											echo  "�Ţ����¹���������!!!! ��سҡ�͡�Ţ����¹ ʡ�. ����";
											return false;
		
										}*/

								
							?>

						<input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>" maxlength="7"  >			
					
					
					<?
							}else{
					?>
					    <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" class="boxleft30">
						<? echo '- ʡ�. �ѧ��Ѵ '.$rs["userdetail"];?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center>1.</td>
                        <td height="20" align="left" class="boxleft5">�Ţ����¹ ʡ�.
                          : </td>
                        <td align="left" class="boxleft5">
<!-- 						<input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>" maxlength="7"  >		 -->	
						<input type="text" name="amccode"  value="<?=$rs["AMCCode"]?>" maxlength="7" disabled >

					<?
							}
					?>

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

					<input name="list_province" type="hidden" value="<?echo $lis_province;?>">
					<input name="div2" type="hidden" value="<?echo $div;?>">
                      <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">5. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5" >�����Ţ wan
                          : </td>
                        <td width="69%" align="left" class="boxleft5"><input name="amcwan" type="text" class="textbox40" value="<?=$rs["AMCWan"]?>"maxlength="4"></td>
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
								<input type="radio" name="AMCNET"  value="1"<? if($rs["AMCNET"]=="1"){ echo "checked";}?>> 
								<? if($rs["AMCNET"]=="1"){echo"<span class='txtgreen'>";}?>
								<? if($rs["AMCNET"]=="1"){$green="</span>";}?>
								�� <? echo $green;?>
								<input type="radio" name="AMCNET"  value="0" <? if($rs["AMCNET"]<>"1"){echo "checked";}?>> 
								<? if($rs["AMCNET"]<>"1"){echo"<span class='txtred'>";}?>
								<? if($rs["AMCNET"]<>"1"){$red="</span>";}?>
								�����<?echo $red;?>
						</td>
                      </tr>

						<tr align=center bgcolor="#BBD0E1" style="color:#BBD0E1;">
						<tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                        <td height="20" align=center rowspan="3">8. </td>
                        <td height="20" align="left" class="boxleft5">����-ʡ�� : 
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
                        <td height="20" align="left" class="boxleft5" rowspan="3">����-ʡ�� :<br> <br>���˹� :<br><br>�����Ţ���Ѿ�� : 
                        </td>
                        <td align="left" class="boxleft5"><input type="text" name="AMCPosition_2_Name" value="<?=$rs["AMCPosition_2_Name"]?>"><br><input type="text" name="AMCPosition_2" value="<?=$rs["AMCPosition_2"]?>"><br><input name="AMCPosition_2_Tel" type="text" class="textbox30" maxlength="10" value="<?=$rs["AMCPosition_2_Tel"]?>"></td>
                      </tr>
  
						</tr>

                    </table>
					
                    <br>
					
					<?
							if($flag== "NEW"){
			
					?>
							<input type="submit" name="Submit"  value="Submit">
							<input name="reset" type="reset" id="reset" value="Reset">
							<!-- <a href="javascript:history.back();"><img src="images/back.gif" border="0" alt="��Ѻ�˹�ҷ������"></a> -->
					<?
							}else{
					?>
							<input type="submit" name="Submit"  value="Sumbit">
							<input name="reset" type="reset" id="reset" value="Reset">
							<?	if($amcstatus=="Y"){?>
									<input type="button" name="delete" id="delete" value="Delete" onclick="javascript:btnDeleteOnClick(); "/>
						<!-- 	<input type="submit" name="Delete"  value="Delete"> -->
<!-- 								<input type="button" name="button3" id="button3" value="Delete" onclick="window.location.href='amc_general_delete.php?lis_province='.$list_province.'&div='.$div2.''
return confirm ( '�س��ͧ��÷���ź ������� !!!');"/>  -->
									
							<?}?>
							<!-- <a href="javascript:history.back();"><img src="images/back.gif" border="0" alt="��Ѻ�˹�ҷ������"></a> -->

					<?

							}
			//				$rs = mssql_fetch_assoc($result);
					?>
							


                  </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>

<script language="javascript">

function check2() {
//alert("flag="+document.checkForm.flag.value);
if(document.checkForm.amccode.value=="") {
alert(" ��سҡ�͡�Ţ����¹ ʡ�.") ;
document.checkForm.amccode.focus() ;
return false ;
}
else if(document.checkForm.AMCRegisDate.value=="") {
alert(" ��س����͡�ѹ��訴����¹ ") ;
document.checkForm.AMCRegisDate.focus() ;
return false ;
}
else if(document.checkForm.amcaddress.value=="") {
alert(" ��سҡ�͡����� ʡ�. ") ;
document.checkForm.amcaddress.focus() ;
return false ;
}
else if(document.checkForm.amctel.value=="") {
alert(" ��سҡ�͡�����Ţ���Ѿ��ͧ ʡ�. ") ;
document.checkForm.amctel.focus() ;
return false ;

}
/*else if(document.checkForm.amcwan.value=="") {
alert(" ��سҡ�͡�����Ţ wan") ;
document.checkForm.amcwan.focus() ;
return false ;
}
else if(document.checkForm.amcfax.value=="") {
alert(" ��سҡ�͡�����Ţ Fax. ") ;
document.checkForm.amcfax.focus() ;
return false ;
}
else if(document.checkForm.AMCPosition_1_Name.value=="") {
alert("��س��к� ����-ʡ�� ������") ;
document.checkForm.AMCPosition_1_Name.focus() ;
return false ;
}
else if(document.checkForm.AMCPosition_1.value=="") {
alert("��س��кص��˹觢ͧ������") ;
document.checkForm.AMCPosition_1.focus() ;
return false ;
}
else if(document.checkForm.AMCPosition_1_Tel.value=="") {
alert("��س��к������Ţ���Ѿ��ͧ������") ;
document.checkForm.AMCPosition_1_Tel.focus() ;
return false ;
}*/
else {
				if(confirm("��س��׹�ѹ��úѹ�֡������     ")) {
					return true ;
			//		requestInfo();
		//			alert("�ѹ�֡���������º��������     ");
			//		window.location='amc_general1.php';

				}else{
					return false;
				}
			}
return true ;
}

function btnDeleteOnClick() {
		if(confirm("��س��׹�ѹ���ź������  ")) {
			//requestInfo();	
			window.location.href="amc_general_delete.php?lis_province=<?echo $lis_province?>&div=<?echo $div?>"; 
			return true ;	
		}else{
					return false;
				}
	}
</script>
</form>



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

