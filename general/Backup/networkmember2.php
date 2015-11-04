<? include ("checkuser.php");?>
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
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_member.jpg" width="357" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
			//	echo $username;
			//	echo $password;
			//echo $amc;

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
          <td height="50" colspan="2" align="center" valign="middle"> <legend> 
            </legend> <center>
            </CENTER></td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="post" action="">
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr bgcolor="#BBD0E1" align=center class=font1 style="color:#333333;"> 
                        <td height="19" colspan=10 align=left><b>&nbsp; &nbsp;ข้อมูล 
                          ณ ปี</b></td>
                      </tr>
                      <tr class=font1 align="center" bgcolor="#C8D7E3" style="color:#333333"> 
                        <td width=3%>ลำดับ</td>
                        <td width=10%>หมายเลขบัตรประชาชน</td>
                        <td width="8%" align="center">ชื่อ</td>
                        <td width=8%>นามสกุล</td>
                        <td width="20%">ที่อยู่</td>
                        <td width="8%">เบอร์โทรศัพท์</td>
                        <td width="12%">การช่วยงานธนาคาร</td>
                        <td width="10%"><br>
                          สาขาที่ช่วยงาน <br> <br> </td>
                        <td width="5%">สถานะ</td>
                        <td width="13%">หมายเหต</td>
                      </tr>
                      <?php
								//echo '$amc = '.$amc.'<br>';
								include ("images/lib/ms_database.php");

									$sql="SELECT A.AMCCode, A.user_ID, A.Name, A.Lsname, A.Positions,A.Address, A.Phone, ";
									$sql.=" B.MemberHelp,B.MemberHelpBranch,A.Status, B.MemberRemark ";
									$sql.=" FROM Personnel A ";
									
									$sql.=" LEFT JOIN( ";
									$sql.=" SELECT * ";
									$sql.=" FROM NetworkMember ";
									$sql.=" WHERE AMCCode='ก011834' ";
									$sql.=" )AS B ON A.AMCcode=B.AMCCode  ";
									
									$sql.=" WHERE ";
									$sql.=" A.AMCCode='ก011834' AND A.Status ='0' ";
									$sql.=" ORDER BY A.Status DESC ";								
								
								echo $sql;	
								$exsql=mssql_query($sql);
								$num=mssql_num_rows($exsql);
								$i=1;
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
								{
								
							?>
                      <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                        <td height="19"><?echo $a=$a+1;?></td>
                        <td height="19"><input name="user_id<?=$i?>" type="text" class="AssetSize" value="<?=$rowall[1]?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="name&lt;=$i??&gt;" type="text" class="AssetSize" value="<?=$rowall[2]?>"></td>
                        <td height="19"><input name="lsname<?=$i?>" type="text" class="AssetSize"  value="<?=$rowall[3]?>"> 
                        </td>
                        <td height="19" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="address<?=$i?>" type="text" class="AssetSize"  value="<?=$rowall[5]?>"></td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="phone<?=$i?>" type="text" class="AssetSize"  value="<?=$rowall[6]?>"> 
                        </td>
                        <td> 
                          <?
						$show=$rowall[7];
						if($show=="1"){ $show_ra="checked";}
						if($show=="0"){$show_ra="";}
						?>
                          <input type="radio" name="help<?=$i?>" value="radiobutton" <? echo $show_ra?>>
                          ช่วย 
                          <input type="radio" name="help<?=$i?>" value="radiobutton" <? echo $showa_ra?>>
                          ไม่ช่วย</td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;">
                          <?
							$sql2="SELECT CAT_CC,CAT_AA,CAT_DESC ";
							$sql2.=" FROM DBTP.DBO.CCAATTIS A ";
							$sql2.=" WHERE A.CAT_CC='84'AND CAT_AA <> '00'AND CAT_TT='00'AND CAT_MM='00' AND CAT_DESC not like '%*%' ";
							$sql2.=" ORDER BY CAT_AA ";
							$exsql2=mssql_query($sql2);
							//echo $sql2;
							echo '<select name="select'.$i.'">';
							while($rowall2=mssql_fetch_array($exsql2))
								{
									echo '<option valuse=" '.$rowall2[1].'">'.$rowall2[2].'</option>';
								}
							echo '</select>';
						?>
                        </td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;">
						<??>
						<input type="checkbox" name="checkbox" value="checkbox"> 
                        </td>
                        <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="remark<?=$i?>" type="text" class="AssetRemark"  value="<?=$rowall[10]?>"></td>
                      </tr>
                      <?php
						$i++;			
					  
					  }
						$p=$row-$a;
						if($row>$a)
							{
								for($b=1;$b<=$p;$b++)
								{
									
				?>
                      <?
						$i++;
								} //for
					}//if
					//echo $a;
					//echo $row;
					//echo $i;
				?>
                      <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                        <td height="18" colspan="10" align=left>&nbsp;&nbsp;&nbsp;<a href="networkmember.php?&row=<?echo$a+1;?>">เพิ่มรายการใหม่</a><b> 
                          <input type="hidden" name="row" value="<?=$a;?>">
                          </b></td>
                      </tr>
                    </table>
                    <br>
                    <input type="hidden" name="asset" value="vehicle">
                    <input name="Submit2" type="submit" class="formButton" value="Submit">
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset">
                  </form>
                  <br> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
