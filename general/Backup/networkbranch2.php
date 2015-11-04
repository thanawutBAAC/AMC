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
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_network.gif" width="211" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
            <? 
								//echo '$amc = '.$amc.'<br>';
				include ("images/lib/ms_database.php");

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
          <td height="40" colspan="2" align="center" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="90%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="networkbranch_insert.php">
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=8 align=left><b>&nbsp; &nbsp;ข้อมูล 
                          ณ ปี</b></td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="5%" rowspan="2" bgcolor="#C8D7E3">ลำดับ</td>
                        <td width="15%" rowspan="2" bgcolor="#C8D7E3">เครือข่ายสาขา</td>
                        <td height="25" colspan="3" align="center" bgcolor="#D3D1C7">ประเถทธุรกิจ</td>
                        <td colspan="3" bgcolor="#DABEB6"> ปริมาณธุรกิจ</td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="13%" height="23" align="center" bgcolor="#E0DFD6">ธุรกิจซื้อ</td>
                        <td width="13%" align="center" bgcolor="#E0DFD6">ธุรกิจขาย</td>
                        <td width="14%" align="center" bgcolor="#E0DFD6">ธุรกิจบริการ</td>
                        <td width="13%" align="center" valign="middle" bgcolor="#E7D8D8">ธุรกิจซื้อ 
                          <br> </td>
                        <td width="13%" bgcolor="#E7D8D8">ธุรกิจขาย</td>
                        <td width="14%" bgcolor="#E7D8D8">ธุรกิจบริการ</td>
                      </tr>
                      <?php
							//	include ("images/lib/ms_database.php");
						$sql="SELECT AMC.DBO.NETWORKBRANCH.AMCCode, AMC.DBO.NETWORKBRANCH.CAT_CC, AMC.DBO.NETWORKBRANCH.CAT_AA, ";
						$sql.=" A.CAT_DESC, AMC.DBO.NETWORKBRANCH.BranchTypeBuy, ";
						$sql.=" AMC.DBO.NETWORKBRANCH.Branchtypesell, AMC.DBO.NETWORKBRANCH.BranchTypeservice, ";
						$sql.=" AMC.DBO.NETWORKBRANCH.BranchValuesBuy, AMC.DBO.NETWORKBRANCH.BranchValuesSell, AMC.DBO.NETWORKBRANCH.BranchValuesService, ";
						$sql.=" AMC.DBO.NETWORKBRANCH.BranchYear ";
						$sql.=" FROM AMC.DBO.NETWORKBRANCH ";
						$sql.=" LEFT JOIN( ";
						$sql.=" SELECT CAT_CC, CAT_AA, CAT_DESC ";
						$sql.=" FROM DBTP.DBO.CCAATTIS ";
						$sql.=" WHERE CAT_AA !='00' AND CAT_TT = '00' AND CAT_MM='00' ";
						$sql.=" )AS A  ";
						$sql.="ON AMC.DBO.NETWORKBRANCH.CAT_CC = A.CAT_CC AND AMC.DBO.NETWORKBRANCH.CAT_AA  = A.CAT_AA ";
						$sql.=" WHERE AMCCode='$amc'  ORDER BY AMC.DBO.NETWORKBRANCH.CAT_AA "; 

								//	echo $amc;
								//echo $sql;	
								$exsql=mssql_query($sql);
								$num=mssql_num_rows($exsql);
								$i=1;
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
								{
							?>
                      <tr align=center class=font1 style="color:#666666;"> 
                        <td width="2%" height="19" bgcolor="#F0F0F0"><?echo $a=$a+1;?></td>
                        <td height="19" align="left" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[3];?> 
                          <input type="hidden" name="CAT_AA[]" value="<?echo $rowall[2];?>" id="CAT_AA<?=$a;?>"> 
                        <td bgcolor="#F0F0F0" > 
                          <?php
					  	$typebuy=$rowall[4];
					  ?>
                          <input type="radio" name="typebuy<?=$i?>"  value="1"<? if($typebuy=="1"){ echo "checked";}?>> 
                          <? if($typebuy=="1"){echo"<span class='txtgreen'>";}?>
                          <? if($typebuy=="1"){$green="</span>";}?>
                          มี <? echo $green;?> <input type="radio" name="typebuy<?=$i?>"  value="0" <? if($typebuy=="0"){echo "checked";}?>> 
                          <? if($typebuy=="0"){echo"<span class='txtred'>";}?>
                          <? if($typebuy=="0"){$red="</span>";}?>
                          ไม่มี<?echo $red;?></td>
                        <td width="10%" height="19" bgcolor="#F0F0F0"> 
                          <?php
						  
					  	$typesell=$rowall[5];
						//echo $typesell;
					  ?>
                          <input type="radio" name="typesell<?=$i?>"  value="1"<? if($typesell=="1"){ echo "checked";}?>> 
                          <? if($typesell=="1"){echo"<span class='txtgreen'>";}?>
                          <? if($typesell=="1"){$green="</span>";}?>
                          มี <? echo $green;?> <input type="radio" name="typesell<?=$i?>"  value="0" <? if($typesell=="0"){echo "checked";}?>> 
                          <? if($typesell=="0"){echo"<span class='txtred'>";}?>
                          <? if($typesell=="0"){$red="</span>";}?>
                          ไม่มี<?echo $red;?></td>
                        <td height="19" bgcolor="#F0F0F0" > 
                          <?php
					  	$typeservice=$rowall[6];
						
					  ?>
                          <input type="radio" name="typeservice<?=$i?>"  value="1"<? if($typeservice=="1"){ echo "checked";}?>> 
                          <? if($typeservice=="1"){echo"<span class='txtgreen'>";}?>
                          <? if($typeservice=="1"){$green="</span>";}?>
                          มี <? echo $green;?> <input type="radio" name="typeservice<?=$i?>"  value="0" <? if($typeservice=="0"){echo "checked";}?>> 
                          <? if($typeservice=="0"){echo"<span class='txtred'>";}?>
                          <? if($typeservice=="0"){$red="</span>";}?>
                          ไม่มี<?echo $red;?></td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy[]" type="text" class="Assetsize" id="valuesbuy[]"style="text-align: right;"> 
                        </td>
                        <td bgcolor="#F0F0F0"><input name="valuessell[]" type="text" class="Assetsize" id="valuessell[]"style="text-align: right;"> 
                        </td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesservice[]" type="text" class="Assetsize" id="valuesservice[]"style="text-align: right;"></td>
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
                      <tr align=center class=font1 style="color:#666666;"> 
                        <td height="20" align=center bgcolor="#F8F1C7"><?echo $a=$a+1;?> 
                        </td>
                        <td height="20" align="left" bgcolor="#F8F1C7" class="boxleft15"> 
                          <?
						$sql="SELECT CAT_CC, CAT_AA, CAT_DESC ";
						$sql.=" FROM DBTP.DBO.CCAATTIS ";
						$sql.=" WHERE CAT_CC= '$province' AND CAT_AA <> '00' ";
						$sql.=" AND CAT_TT ='00' AND CAT_MM ='00' ";
						$sql.=" AND CAT_DESC NOT LIKE '%*%' ";
						$sql.=" AND CAT_CC+CAT_AA NOT IN ( ";
						$sql.=" SELECT CAT_CC+CAT_AA FROM AMC.DBO.NETWORKBRANCH) ORDER BY CAT_AA ";
						$exsql=mssql_query($sql);
						$nubs=mssql_num_rows($exsql);
						//echo $nubs;
						echo	'<select name="CAT_AA[$i]" class="txtbox95per" >';
						echo '<option value="">เลือกอำเภอ</option>';
							while($rowall=mssql_fetch_row($exsql)) 
								{
									echo '<option value='.$rowall[1].'>'.$rowall[2].'</option>';
								}
                         echo  '</select>';
						// echo $i;
				?>
                        </td>
                        <td bgcolor="#F8F1C7" > 
                          <input type="radio" name="typebuy<?=$i?>"  value="1">
                          มี 
                          <input type="radio" name="typebuy<?=$i?>"  value="0" >
                          ไม่มี</td>
                        <td height="20" bgcolor="#F8F1C7"> <input type="radio" name="typesell<?=$i?>"  value="1">
                          มี 
                          <input type="radio" name="typesell<?=$i?>"  value="0" >
                          ไม่มี</td>
                        <td height="20" bgcolor="#F8F1C7" > 
                          <input type="radio" name="typeservice<?=$i?>"  value="1">
                          มี 
                          <input type="radio" name="typeservice<?=$i?>"  value="0" >
                          ไม่มี</td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy[]" type="text" class="Assetsize" id="valuesbuy[]"style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7"><input name="valuessell[]" type="text" class="Assetsize" id="valuessell[]"style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesservice[]" type="text" class="Assetsize" id="valuesservice[]"style="text-align: right;"></td>
                      </tr>
                      <?
						$i++;
								} //for
					}//if
					//echo $a;
					//echo $row;
					//echo $i;
				?>
                      <tr align=center class=font1 style="color:#666666;"> 
                        <td height="18" colspan="8" align=left bgcolor="#F0F0F0">&nbsp;&nbsp;&nbsp;
						<? if($new!="1") { ?>
						<a href="networkbranch.php?row=<?echo $a+1;?>&new=1">เพิ่มรายการใหม่</a>
						<? }?>
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
                  <br> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
