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
          <td height="30" valign="bottom" class="boxleft50"><img src="images/head_network.jpg">&nbsp;</td>
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
          <td height="20" colspan="2" align="center" valign="middle"> </td>
        </tr>
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="90%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="networkbranch_insert.php">
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=9 align=left><b>&nbsp; &nbsp;<? echo 'ข้อมูลณ ปี '.$Year?>&nbsp;&nbsp; </b><span class="txtred">***หน่วยเป็นบาท</span></td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="5%" rowspan="2" bgcolor="#C8D7E3">ลำดับ</td>
                        <td width="15%" rowspan="2" bgcolor="#C8D7E3">เครือข่ายสาขา</td>
                        <td height="25" colspan="3" align="center" bgcolor="#D3D1C7">ประเภทธุรกิจ</td>
                        <td colspan="3" bgcolor="#DABEB6"> ปริมาณธุรกิจ</td>
                        <td width="12%" rowspan="2" bgcolor="#C8D7E3">ลบข้อมูล</td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="12%" height="23" align="center" bgcolor="#E0DFD6">ธุรกิจซื้อ</td>
                        <td width="13%" align="center" bgcolor="#E0DFD6">ธุรกิจขาย</td>
                        <td width="12%" align="center" bgcolor="#E0DFD6">ธุรกิจบริการ</td>
                        <td width="12%" align="center" valign="middle" bgcolor="#E7D8D8">ธุรกิจซื้อ 
                          <span class="txtred">(บาท)</span><br> </td>
                        <td width="12%" bgcolor="#E7D8D8">ธุรกิจขาย<span class="txtred"> 
                          (บาท)</span></td>
                        <td width="12%" bgcolor="#E7D8D8">ธุรกิจบริการ <span class="txtred">(บาท)</span></td>
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
						$sql.=" FROM AMC.DBO.CCAATTIS ";
						$sql.=" WHERE CAT_AA !='00' AND CAT_TT = '00' AND CAT_MM='00' ";
						$sql.=" )AS A  ";
						$sql.="ON AMC.DBO.NETWORKBRANCH.CAT_CC = A.CAT_CC AND AMC.DBO.NETWORKBRANCH.CAT_AA  = A.CAT_AA ";
						$sql.=" WHERE AMCCode='$amc' AND BranchYear='$Year' ORDER BY AMC.DBO.NETWORKBRANCH.CAT_AA "; 

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
                        <td width="5%" height="19" bgcolor="#F0F0F0"><?echo $a=$a+1;?></td>
                        <td height="19" align="left" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[3];?> 
                          <input type="hidden" name="CAT_AA<?=$i?>" value="<?echo $rowall[2];?>" > 
                          <input type="hidden" name="new<?=$i?>" value="0"> 
                        <td bgcolor="#F0F0F0" > 
                          <?php
			//			  <input type="radio" name="rdo1" value="1" checked OnClick="document.form1.lstBrn.disabled=false;">
					  			$typebuy=$rowall[4];
								if($typebuy=="1")
									{ 
										echo '<input type="radio" name="typebuy'.$i.'"  value="1"  checked  Onclick="document.form1.valuesbuy'.$i.'.disabled=false;"><span class="txtgreen" > มี</span>&nbsp;';
										echo '<input type="radio" name="typebuy'.$i.'"  value="0"  Onclick="document.form1.valuesbuy'.$i.'.disabled=true;">ไม่่มี';
									}
								if($typebuy=="0")
									{ 
										echo '<input type="radio" name="typebuy'.$i.'"  value="1" Onclick="document.form1.valuesbuy'.$i.'.disabled=false;">มี &nbsp;';
										echo '<input type="radio" name="typebuy'.$i.'"  value="0"  checked  Onclick="document.form1.valuesbuy'.$i.'.disabled=true;"><span class="txtred" >ไม่มี</span>';
										}
                         ?>
                        </td>
                        <td width="13%" height="19" bgcolor="#F0F0F0"> 
                          <?php
						  
					  			$typesell=$rowall[5];
								if($typesell=="1")
									{ 
										echo '<input type="radio" name="typesell'.$i.'"  value="1"  checked Onclick="document.form1.valuessell'.$i.'.disabled=false;"><span class="txtgreen" > มี</span>&nbsp;';
										echo '<input type="radio" name="typesell'.$i.'"  value="0" Onclick="document.form1.valuessell'.$i.'.disabled=true;">ไม่่มี';
									}
								if($typesell=="0")
									{ 
										echo '<input type="radio" name="typesell'.$i.'"  value="1" Onclick="document.form1.valuessell'.$i.'.disabled=false;" >มี &nbsp;';
										echo '<input type="radio" name="typesell'.$i.'"  value="0"  checked  Onclick="document.form1.valuessell'.$i.'.disabled=true;"><span class="txtred" >ไม่มี</span>';
										}
                         ?>
                        </td>
                        <td height="19" bgcolor="#F0F0F0" > 
                          <?php
					 	 		$typeservice=$rowall[6];
								if($typeservice=="1")
									{ 
										echo '<input type="radio" name="typeservice'.$i.'"  value="1"  checked Onclick="document.form1.valuesservice'.$i.'.disabled=false;"><span class="txtgreen" > มี</span>&nbsp;';
										echo '<input type="radio" name="typeservice'.$i.'"  value="0" Onclick="document.form1.valuesservice'.$i.'.disabled=true;">ไม่่มี';
									}
								if($typeservice=="0")
									{ 
										echo '<input type="radio" name="typeservice'.$i.'"  value="1" Onclick="document.form1.valuesservice'.$i.'.disabled=false;">มี &nbsp;';
										echo '<input type="radio" name="typeservice'.$i.'"  value="0"  checked Onclick="document.form1.valuesservice'.$i.'.disabled=true;"><span class="txtred" >ไม่มี</span>';
										}
                         ?>
                        </td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[7]?>"> 
                        </td>
                        <td bgcolor="#F0F0F0"><input name="valuessell<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[8]?>"> 
                        </td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesservice<?=$i?>" type="text" class="Assetsize" style="text-align: right;" value="<?echo $rowall[9]?>"></td>
                        <td bgcolor="#F0F0F0" ><a class=link_bluesky  href="javascript: if(confirm('ต้องการลบข้อมูลเครื่อข่ายสาขา<?echo $rowall[3]?>')){ window.location='networkbranch_delete.php?AMCCode=<?=$amc?>&CAT_CC=<?=$province?>&CAT_AA=<?echo $rowall[2]?>&year=<?echo $rowall[10]?>';}"><img src="images/bin.gif" width="20" height="12" border="0"></a></td>
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
						$sql.=" FROM AMC.DBO.CCAATTIS ";
						$sql.=" WHERE CAT_CC= '$province' AND CAT_AA <> '00' ";
						$sql.=" AND CAT_TT ='00' AND CAT_MM ='00' ";
						$sql.=" AND CAT_DESC NOT LIKE '%*%' ";
						$sql.=" AND CAT_CC+CAT_AA NOT IN ( ";
						$sql.=" SELECT CAT_CC+CAT_AA FROM AMC.DBO.NETWORKBRANCH WHERE BranchYear='$Year') ORDER BY CAT_AA ";
						$exsql=mssql_query($sql);
						$nubs=mssql_num_rows($exsql);
						//echo $nubs;
						//echo $sql;
						echo	'<select name="CAT_AA'.$i.'" class="txtbox95per" >';
						echo '<option value="">เลือกอำเภอ</option>';
							while($rowall=mssql_fetch_row($exsql)) 
								{
									echo '<option value='.$rowall[1].'>'.$rowall[2].'</option>';
								}
                         echo  '</select>';
						// echo $i;
				?>
                          <input type="hidden" name="new<?=$i?>" value="1"> </td>
                        <td bgcolor="#F8F1C7" > <input type="radio" name="typebuy<?=$i?>"  value="1" Onclick="document.form1.valuesbuy<?=$i?>.disabled=false;">
                          มี 
                          <input type="radio" name="typebuy<?=$i?>"  value="0" Onclick="document.form1.valuesbuy<?=$i?>.disabled=true;">
                          ไม่มี</td>
                        <td height="20" bgcolor="#F8F1C7"> <input type="radio" name="typesell<?=$i?>"  value="1"  Onclick="document.form1.valuessell<?=$i?>.disabled=false;">
                          มี 
                          <input type="radio" name="typesell<?=$i?>"  value="0" Onclick="document.form1.valuessell<?=$i?>.disabled=true;">
                          ไม่มี</td>
                        <td height="20" bgcolor="#F8F1C7" > <input type="radio" name="typeservice<?=$i?>"  value="1"  Onclick="document.form1.valuesservice<?=$i?>.disabled=false;">
                          มี 
                          <input type="radio" name="typeservice<?=$i?>"  value="0" Onclick="document.form1.valuesservice<?=$i?>.disabled=true;">
                          ไม่มี</td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy<?=$i?>" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7"><input name="valuessell<?=$i?>" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesservice<?=$i?>" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;">&nbsp;</td>
                      </tr>
                      <?
						$i++;
								} //for
					}//if
					//echo $a;
					//echo $row;
					//echo $i;
					if($new<>"1"){$bb="20";}
					if($new=="1"){$bb="1";}
				?>
                      <tr align=center class=font1 style="color:#666666;"> 
                        <td colspan="4" align=left bgcolor="#F0F0F0" class="boxleft10" <? echo 'height="'.$bb.'"'?>> 
                          <? if($new!="1") { ?>
                          <a href="networkbranch.php?row=<?echo $a+1;?>&new=1">เพิ่มรายการใหม่</a> 
                          <? }  ?>
                          <b> 
                          <input type="hidden" name="row" value="<?=$a;?>">
                          </b></td>
                        <td height="19" align=right bgcolor="#F0F0F0" class="boxright15" <? echo 'height="'.$bb.'"'?>>รวม 
                          <?
						$sqlsum=" SELECT SUM (BranchValuesBuy)AS buy,SUM(BranchValuesSell)AS Sell,SUM(BranchValuesService)AS servince " ;
						$sqlsum.=" FROM NetworkBranch " ;
						$sqlsum.=" WHERE AMCCode='$amc' AND BranchYear='$Year'";
						$exsqlsum=mssql_query($sqlsum);
						$data=mssql_fetch_row($exsqlsum);
						?>
                        </td>
                        <td <? echo 'height="'.$bb.'"'?> align=center bgcolor="#F0F0F0"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td height="16" align="right" bgcolor="#FFFFCC" class="txtred"><b><?echo $data[0]?></b></td>
                            </tr>
                          </table></td>
                        <td <? echo 'height="'.$bb.'"'?> align=center bgcolor="#F0F0F0"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td height="16" align="right" bgcolor="#FFFFCC" class="boxright5px"><span class="txtred"><b><?echo $data[1]?></b> 
                                </span> </td>
                            </tr>
                          </table></td>
                        <td <? echo 'height="'.$bb.'"'?> align=center bgcolor="#F0F0F0"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td height="16" align="right" bgcolor="#FFFFCC" class="boxright5px"><span class="txtred"><b><?echo $data[2]?></b> 
                                </span> </td>
                            </tr>
                          </table></td>
                        <td <? echo 'height="'.$bb.'"'?> align=left bgcolor="#F0F0F0" class="boxleft10">&nbsp;</td>
                      </tr>
                    </table>
                    <br>
					<?
								$total=" SELECT BranchYear,SUM(BranchValuesBuy),SUM(BranchValuesSell),SUM(BranchValuesService) ";
								$total.=" FROM Networkbranch where AMCCode='$amc' Group BY BranchYear ORDER BY BranchYear DESC " ;
								$extotal=mssql_query($total);
								$numrows=mssql_num_rows($extotal);
								if($numrows<>"0")
									{
					
					?>
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center class=font1 style="color:#333333;"> 
                        <td height="19" colspan=9 align=left bgcolor="#92AED1"><b>&nbsp; 
                          &nbsp;ยอดรวมธุรกิจในแต่ละปี</b></td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="5%" rowspan="2" bgcolor="#C8D7E3">ลำดับ</td>
                        <td width="15%" rowspan="2" bgcolor="#C8D7E3">ปี พ.ศ</td>
                        <td height="25" colspan="3" bgcolor="#DABEB6"> ปริมาณธุรกิจ</td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="25%" height="20" align="center" valign="middle" bgcolor="#E7D8D8">ยอดรวมธุรกิจซื้อ 
                          <br> </td>
                        <td width="25%" bgcolor="#E7D8D8">ยอดรวมธุรกิจขาย</td>
                        <td width="30%" bgcolor="#E7D8D8">ยอดรวมธุรกิจบริการ</td>
                      </tr>
                      <?php

								while($show=mssql_fetch_array($extotal))
									{
		
							?>
                      <tr align=center class=font1 style="color:#666666;"> 
                        <td height="19" bgcolor="#F0F0F0"><?echo $x=$x+1;?></td>
                        <td height="19" align="left" bgcolor="#F0F0F0" class="boxleft15"><?echo $show[0];?> 
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"> 
                          <table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td height="16" align="right" bgcolor="#FFFFCC" class="txtgreen"><b><?echo $show[1]?></b></td>
                            </tr>
                          </table>
                          <span class="txtred"></span> </td>
                        <td bgcolor="#F0F0F0"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td height="16" align="right" bgcolor="#FFFFCC" class="boxright5px"><span class="txtgreen"><b><?echo $show[2]?></b> 
                                </span> </td>
                            </tr>
                          </table></td>
                        <td bgcolor="#F0F0F0" style="color:#FF0080;border:1px solid #F0F0F0;"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="font1">
                            <tr> 
                              <td height="16" align="right" bgcolor="#FFFFCC" class="boxright5px"><span class="txtgreen"><b><?echo $show[3]?></b> 
                                </span> </td>
                            </tr>
                          </table></td>
                      </tr>
                      <?}?>
                      <tr align=center bgcolor="#C8D7E3" style="color:#666666;"> 
                        <td height="3" colspan="5"> </span> </td>
                      </tr>
                    </table>
					<?
						}
					?>
                    <br>
                    <br>
                    <input name="Submit23" type="button" class="formButton" value=" Back " onClick="self.location.href=('amc.php')" onMouseOver="this.style.cursor='hand'" >
                    &nbsp; 
                    <input name="Submit2" type="submit" class="formButton" value="Submit" onClick="javascript: if(confirm('บันทึกข้อมูล')){ window.location='networkbranch_insert.php';}">
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
