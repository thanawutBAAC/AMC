<? 
//session_start();
$strExcelFileName ="��§ҹ�����ŷ���� ʡ�_$AMCName .xls"; 
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\""); 
header("Content-Disposition: inline; filename=\"$strExcelFileName\""); 
header("Pragma: no-cache")

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<style id="SiXhEaD_Excel_Styles"></style> 
<title>exportexcel</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel"> 
<?

	//session_start();
        include("images/lib/ms_database.php");

		$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where AMCCode = '$AMCCode' ";
//		echo "AMCCode is".$AMCCode.'</b>';
		//echo $AMCCode;
		$result = mssql_query($sql) or die('Query failed: ' . mssql_error());

		$rs = mssql_fetch_assoc($result);
		$Year=(date(Y)+543);
		
//		echo $sql;

		#$result = show_data("AMC");

?>
    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr bgcolor="#92AED1" class="font1">
                        <td height="19" colspan="6" align=left><b>&nbsp; &nbsp;�����ŷ����
							<? if($SendYear==""){ 
									echo "������";
								 }else{	
									echo '� �� '.$SendYear;
								}
							?>
                          </b></td>
                      </tr>
                      <tr align="left" bgcolor="#BBD0E1" style="color:#333333" > 
                        <td height="25" colspan="6" class="boxleft30">
						<? echo '- ʡ�. �ѧ��Ѵ '.$AMCName;?></td>
                      </tr>
                      <tr align=center bgcolor="#F0F0F0" > 
                        <td height="20" align=center >1.</td>
                        <td height="20" align="left" class="boxleft5" colspan="2" >�Ţ����¹ ʡ�.
                          : </td>
                        <td align="left" class="boxleft5" colspan="3"><?=$rs["AMCCode"]?></td>
                      </tr>
						<tr align=center bgcolor="#F0F0F0" >  
                        <td height="20" align=center>2.</td>
                        <td height="20" align="left" class="boxleft5" colspan="2">�ѹ��訴����¹
                          : </td>
                        <td align="left" class="boxleft5" colspan="3"><?=$rs["AMCRegisDate"]?></td>
                      </tr>

						 <tr align=center bgcolor="#F0F0F0" rowspan="2"> 
						<td height="20" align=center rowspan="2">3.</td>
                        <td height="20" align="left" class="boxleft5" colspan="2" rowspan="2">����� ʡ�.
                          : </td>
                        <td align="left" class="boxleft5" colspan="3" rowspan="2"><?=$rs["AMCAddress"]?>
						<?  
							if(rtrim(ltrim($rs["AMCAddress"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCAddress"];}
						?>									
						</td>
						</tr>
						<tr align=center bgcolor="#F0F0F0" > 
                        <td height="20" align=center>&nbsp; &nbsp;</td>
                        <td height="20" align="left" class="boxleft5" colspan="2">&nbsp; &nbsp;</td>
                        <td align="left" class="boxleft5" colspan="3">&nbsp; &nbsp;
						</td></tr>
						<tr align=center bgcolor="#F0F0F0" > 
                        <td height="20" align=center>4.</td>
                        <td height="20" align="left" class="boxleft5" colspan="2">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCTel"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCTel"];}
						?>								
						</td></tr>
                      <tr align=center bgcolor="#F0F0F0" > 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">5. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5" colspan="2">�����Ţ wan
                          : </td>
                        <td width="69%" align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCWan"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCWan"];}
						?>								
						</td>
                      </tr>
					<tr align=center bgcolor="#F0F0F0" > 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">6. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5" colspan="2">Fax.
                          : </td>
                        <td width="69%" align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCFax"]))=="")
										{echo " - ";}
								else
									{ echo $rs["AMCFax"];}
						?>						
						</td>
                      </tr>
					  <tr align=center bgcolor="#F0F0F0"> 
                        <td width="4%" height="20" align=center bgcolor="#F0F0F0">7. 
                        </td>
                        <td width="22%" height="20" align="left" class="boxleft5" colspan="2">Internet �ͧ ʡ�.
                          : </td>
						</td> 
						 <td width="69%" align="left" class="boxleft5" colspan="3">
								<? if($rs["AMCNET"]=="1"){echo"<span class='txtgreen'> ��";}
							else{echo"<span class='txtred'> �����";}
						?>
		</td>
                      </tr>

						<tr align=center bgcolor="#BBD0E1">
						<tr align=center bgcolor="#F0F0F0"> 
                        <td height="20" align=center valign="center" rowspan="3">8. </td>
                        <td height="20" align="left" class="boxleft5" colspan="2">����-ʡ�� : 
                        </td>
                        <td align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCPosition_1_Name"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_1_Name"];}
						?>
							</td>
                      </tr>
  
                      <tr align=center bgcolor="#F0F0F0" > 
                       <!--  <td height="20" align=center >8. </td> -->
                        <td height="20" align="left" class="boxleft5" colspan="2">���˹� : 
                        </td>
                        <td align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCPosition_1"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_1"];}
						?>
						</td>
                      </tr>

					<tr align=center bgcolor="#F0F0F0"> 
                      <!--   <td height="20" align=center>9.</td> -->
                        <td height="20" align="left" class="boxleft5" colspan="2">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCPosition_1_Tel"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_1_Tel"];}
						?>
						</td></tr>
						</tr>

						<tr>
						<tr align=center bgcolor="#F0F0F0" > 
                        <td height="20" align=center rowspan="3">9. </td>

						<td height="20" align="left" class="boxleft5" colspan="2">����-ʡ�� : 
                        </td>
                        <td align="left" class="boxleft5" colspan="3"><?=$rs["AMCPosition_2_Name"]?>
						<?  
							if(rtrim(ltrim($rs["AMCPosition_2_Name"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_2_Name"];}
						?>
						</td>
                      </tr>
  
                      <tr align=center bgcolor="#F0F0F0"> 
                       <!--  <td height="20" align=center >8. </td> -->
                        <td height="20" align="left" class="boxleft5" colspan="2">���˹� : 
                        </td>
                        <td align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCPosition_2"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_2"];}
						?>
						</td>
                      </tr>

					<tr align=center bgcolor="#F0F0F0"> 
                      <!--   <td height="20" align=center>9.</td> -->
                        <td height="20" align="left" class="boxleft5" colspan="2">�����Ţ���Ѿ�� 
                          : </td>
                        <td align="left" class="boxleft5" colspan="3">
						<?  
							if(rtrim(ltrim($rs["AMCPosition_2_Tel"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_2_Tel"];}
						?>
						</td>
					</tr>
				</tr>
				<tr > 
					<td height="2" colspan="6" bgcolor="#C8D7E3"></td>
				</tr>
     <!--       </table> -->


<!-- ####  2. �����Ť�С������ #### -->
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="10" align="center" valign="middle"> 
			 <?
								$sql=" SELECT B.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup, A.Committeeoccasion, ";
								$sql.=" A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType, C.CommitteeCategory, C.CommitteeName, ";
								$sql.=" B.CommitteeName,B.CommitteeLastname, B.CommitteeBirhtDay, B.CommitteeAddress, B.CommitteePhone, A.CommitteeAMC,  ";
								$sql.=" B.CommitteeEdu, B.CommitteeDegree, A.CommitteeSocial, B.CommitteeOccu, B.CommitteeOccuSecond, B.CommitteeRemark  ";
								$sql.=" FROM CommitteeGroup A LEFT JOIN(SELECT * FROM CommitteeDetail)AS B ON A.CommitteeID=B.CommitteeID ";
								$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode) AS C ON A.CommitteeType=C.CommitteeType AND A.CommitteeCategory=C.CommitteeCategory  ";
								$sql.="LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin )AS D ON A.AMCCode=D.AMCCode ";								
								$sql.="WHERE A.AMCCode='$AMCCode' ";
								/*	if($SendYear=="")
									{ $sql.=" AND A.CommitteeGroup='$Year' "; }*/
									if($SendYear<>"")
										{ $sql.=" AND  A.CommitteeGroup='$SendYear'";}
							$sql.="ORDER BY A.CommitteeGroup DESC, C.CommitteeType,A.CommitteeID ";
						//echo $sql.'<br>';
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$P=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
              <form name="form1" method="GET" action="committee_show.php" target="AssetMain">
                <tr bgcolor="#92AED1" class="font1"> 
                  <td height="23" colspan="18" class="boxleft15" ><b>�����Ť�С������&nbsp;</b> 
                    <script language=JAVAScript> 
										for(i=0;i<=(document.form1.SendYear.length-1);i++) {
											if(document.form1.SendYear.options[i].value=="<? echo $SendYear ?>") {
												document.form1.SendYear.options[i].selected = true;
												break;
											}
										}
						</script> 
                  </td>
                </tr>
		 <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td  height="35" rowspan="2">�ӴѺ</td>
          <td rowspan="2" align="center">���˹�</td>
          <td rowspan="2">���ʻ�ЪҪ�</td>
          <td rowspan="2">����</td>
          <td  rowspan="2">���ʡ��</td>
          <td  rowspan="2">����</td>
          <td  rowspan="2">�������</td>
          <td  rowspan="2" align="center" >����<br>
            ���Ѿ��</td>
          <td  rowspan="2" >��</td>
          <td height="20" colspan="2">��ô�ç���˹�</td>
          <td  rowspan="2">�� <br>
            ��.ʡ�.</td>
          <td  rowspan="2">�زԡ���֡��<br>
            �٧�ش</td>
          <td  rowspan="2">�дѺ����֡��</td>
          <td  rowspan="2">ʶҹ�<br>
            �ҧ�ѧ��</td>
          <td  rowspan="2">�Ҫվ��ѡ</td>
          <td  rowspan="2">�Ҫվ�ͧ</td>
          <td  rowspan="2">�����˵�</td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1"> 
          <td  height="18">����</td>
          <td >��</td>
				 <?
					   if($numsql == "0")
							{
						 ?>
					  <tr align=center class=font1><td bgcolor="#F0F0F0" colspan ="18" height="30"  ><div align='center'><span class='txtred'>!!! ����բ����Ţ����Ť�С������
					  		<? if($SendYear==""){ 
									echo "";
								 }else{	
									echo '� �� '.$SendYear;
								}
							?>
					  </span></div></td></tr>	
					  <?
							 }else{
					 ?>
                <?
										if($numsql>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
							while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
											$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
											$Education=array("","��ж�������º���","�Ѹ���֡��"," ͹ػ�ԭ��","��ԭ�ҵ��","�٧���� ��ԭ�ҵ��");
											$Edudegree=array("","��õ�Ҵ","�ѭ��","��������С�èѴ���","�ɵ���ʵ��","�ѧ����ʵ��","����");
											$AMC=array("�����","��");
								?>
  <tr bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align="center"> <?echo $number=$number+1;?> </td>
<!--           <td align="left" class="boxleft5"><?echo $rowall[4]?> </td> -->
          <td align="left" class="boxleft5"> 
            <?
									echo $rowall[12];
									$b1=substr($rowall[9],0,1); 
									$b2=substr($rowall[9],1,4);
									$b3=substr($rowall[9],5,5);
									$b4=substr($rowall[9],10,2);
									$b5=substr($rowall[9],12,13);
									$show_id= $b1.'-'.$b2.'-'.$b3.'-'.$b4.'-'.$b5;
	?>
          </td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" ><?echo $show_id?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" ><?echo $rowall[13]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" ><?echo $rowall[14]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" > 
                  <?
			$a=substr($rowall[15],6,4);
			$bb =(date('Y')+543);
			//echo$rowall[15];
			echo $bb-$a;
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center"  class="boxleft5"><?echo $rowall[16]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" ><?echo $rowall[17]?></td>
              </tr>
            </table></td>
          <td align="center"><?echo $rowall[5]?></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" ><?echo $rowall[6]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" ><?echo $rowall[7]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center" > 
                  <?
		  if($AMC[$rowall[18]]=="�����"){echo '<span class="txtred">'.$AMC[$rowall[18]].'</span>';}
		  else{echo $AMC[$rowall[18]];}
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
			     <td align="left" >
                  <? if($rowall[20]!=""){ echo $Edudegree[$rowall[20]]; } else {echo "����к�";}?>
                </td>
              </tr>
            </table></td>
		<td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left"  class="boxleft5"><?echo $Education[$rowall[19]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center"  class="boxleft5"> 
                  <?
		  		if($rowall[21]=="�����"){echo '<span class="txtred">'.$rowall[21].'</span>';}
				else{echo $rowall[21];}
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center"  class="boxleft5"><?echo $Occu[$rowall[22]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center"  class="boxleft5"><?echo $Occu[$rowall[23]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" >
              <tr> 
                <td align="center"  class="boxleft5"><?echo $rowall[24]?></td>
              </tr>
            </table></td>
        </tr>
                <?
									$P++;
									}	
						 }		
						
							?>
				<tr height="2"> 
					<td height="2" colspan="18" bgcolor="#C8D7E3"></td>
				</tr>
              </form>
            </table>
</table>



<!-- ####  3. �����Ŵ�ҹ�ؤ�ҡ� #### -->
 <?
						$sql=" SELECT A.AMCCode,C.AMCProvince, C.userdetail, C.br_code,C.br_name, A.PersonnelID, A.PersonnelType, A.PersonnelCategory,  ";
								$sql.=" B.PersonnelName, A.PersonnelYear, D.PersonnelName,  ";
								$sql.=" D.PersonnelLsname, D.PersonnelBrithday, D.Personnelworking, D.PersonnelEducation, D.PersonnelDegree, D.PersonnelPhone, D.PersonnelAddress,  ";
								$sql.=" D.PersonnelRemark  ";
								$sql.=" FROM PersonnelGroup A ";
								$sql.=" LEFT JOIN ( SELECT * FROM PersonnelCode )AS B ON A.PersonnelType=B.PersonnelType  ";
								$sql.=" LEFT JOIN ( SELECT * FROM UserLogin ) AS C ON A.AMCCOde=C.AMCCode  ";
								$sql.=" LEFT JOIN ( SELECT * FROM PersonnelDetail)AS D ON A.AMCCode=D.AMCCode AND A.PersonnelID=D.PersonnelID ";
								$sql.=" WHERE A.AMCCode='$AMCCode' ";

									if($SendYear<>"")
											{$sql.=" AND A.PersonnelYear='$SendYear '";}
									$sql.="ORDER BY A.PersonnelYear DESC,  A.PersonnelType,A.PersonnelID ,A.AMCCode";
							
						//echo $sql;
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$P=1;
						?>

        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="personnel.php">
                <td align="center" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan=12 align=left><b>&nbsp; �����ž�ѡ�ҹ 
                          <script language=JAVAScript> 
										for(i=0;i<=(document.form1.SendYear.length-1);i++) {
											if(document.form1.SendYear.options[i].value=="<? echo $SendYear ?>") {
												document.form1.SendYear.options[i].selected = true;
												break;
											}
										}
						</script></b>
                     </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
  						  <td height="25">�ӴѺ</td>
						  <td>���˹�</td>
						  <td  height="25" align="center">���ʻ�ЪҪ�</td>
						  <td height="25" align="center"> ����</td>
						  <td height="25" align="center">���ʡ��</td>
						  <td  height="25"> ����</td>
						  <td >�շ��<br>
							��ҷӧҹ</td>
						  <td  height="25">�زԡ���֡��</td>
						  <td >�дѺ����֡��</td>
						  <td height="25">���Ѿ��</td>
						  <td  height="25">�������</td>
						  <td  height="25">�����˵�</td>
					<?
					 if($SendYear==$Year OR $SendYear=="")
							{
					?>
					<?
							}

						$Position["01"]="���Ѵ���";
								$Position["02"]="�ѡ�ҡ�ü��Ѵ���";
								$Position["03"]="�����¼��Ѵ���";
								$Position["04"]="�ѡ�ҡ�ü����¼��Ѵ���";
								$Position["05"]="�����ѭ��";
								$Position["06"]="���˹�ҷ��ѭ��";
								$Position["07"]="���˹�ҷ�����Թ";
								$Position["08"]="���˹�ҷ���õ�Ҵ";
								$Position["09"]="���˹�ҷ���á��";
								$Position["10"]="�ѡ�������ç";
								$Position["11"]="��ѡ�ҹ�Ѻö";
								
								$Education=array("","����Թ��ж�������º���","�Ѹ���֡��"," ͹ػ�ԭ��","��ԭ�ҵ��","�٧���� ��ԭ�ҵ��");
								$Edudegree=array("","��õ�Ҵ","�ѭ��","��������С�èѴ���","�ɵ���ʵ��","�ѧ����ʵ��","����");
								
								$type=$org_searchtype;
								$page=50;  // ��˹��������ྨ�ʴ���¡�÷����� 40 ��¡��
								
					  			$nums=$page*$pagenum; 
								$allpage = $numrows/$page;
							  	$allpage=ceil($allpage);  // ceil �繡�ûѴ��ɷ���������繨ӹǹ���
								$number=$nums;
					?>
                      </tr>
					   <?
					   if($numsql == "0")
							{
						 ?>
					  <tr align=center class=font1><td bgcolor="#F0F0F0" colspan ="12" height="30"><div align='center'><span class='txtred'>!!! ����բ����ž�ѡ�ҹ 
					  		<? if($SendYear==""){ 
									echo "";
								 }else{	
									echo '� �� '.$SendYear;
								}
							?>					  
					  </span></div></td></tr>	
					  <?
							 }else{
					 ?>
                      <?
												while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
					  ?>
                      <tr align=center bgcolor="#F0F0F0"> 
             <td height="20" align=center> <?echo $number=$number+1;?> </td>
<!--           <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><?echo $rowall[2]?> 
          </td> -->
          <td height="20" align="left" class="boxleft10"><?echo $Position[$rowall[6]];?></td>
          <td height="20" ><?echo $rowall[5]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[10]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[11]?></td>
          <td > 
            <?
			$a=substr($rowall[12],6,4);
			$bb =(date('Y')+543);
				if(($bb-$a)=="0"){ echo "1";}
				else{ 	echo $bb-$a;}

		  ?>
          </td>
          <td ><?echo $rowall[13]?></td>
          <td align="left" class="boxleft5" ><? if($rowall[15]!=""){ echo $Edudegree[$rowall[15]]; } else {echo "����к�";}?></td>
		  <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[14]]?></td>
          <td><?echo $rowall[16]?></td>
          <td align="left" class="boxleft5" >
		  <?
		  		if($rowall[17]=="" OR $rowall[17]==" "){echo "-";}
				else{echo $rowall[17];}
		  ?>
		  </td>
          <td align="left" class="boxleft5" >
		  <?
		  		if($rowall[18]=="" OR $rowall[18]==" "){echo '-';}
				else{echo $rowall[18];}
		  ?>
			</td>
                      </tr>
                      <?
					  			$PP++;
					  		}

						$pp=$row-$a;
						//echo $row;
						//echo $p;						
						if($row>$a)
							{
								for($b=1;$b<=$pp;$b++)
								{
					  ?>
                      <?
								$i++;
					  			}
					  		}
						 }
					  ?>
				<tr > 
					<td height="2" colspan="12" bgcolor="#C8D7E3"></td>
				</tr>





<!-- #### 4. �����Ŵ�ҹ��Ѿ���Թ #### -->
<?
					$sql="SELECT A.AMCCode, A.AssetProvince, B.br_code, B.userdetail, A.AssetType, ";
					$sql.=" A.AssetCategory,C.AssetName, A.AssetSize, A.AssetAmount, A.AssetValues, A.AssetApplying,A.AssetRemark ";
					$sql.=" FROM dbo.AssetDetail A  ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.="  FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince ";
					$sql.="LEFT OUTER JOIN ";
					$sql.=" ( ";
					$sql.="  SELECT *  ";
					$sql.="  FROM AssetCode ";
					$sql.=" )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory" ;
					$sql.=" WHERE A.AMCCode ='$AMCCode'  AND A.AssetAmount <>'' AND A.AssetValues<>''" ;
					if($AssetType <> '')
						{ $sql.=" AND A.AssetType='$AssetType' ";}
					if($div <> '')
						{$sql.=" AND B.br_code='$div' "; }
					if($lis_province <> '')
						{ $sql.="AND A.AssetProvince ='$lis_province' " ;}
						$sql.=" ORDER BY  A.AssetProvince ";
					//echo $sql;
					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
				
		?>
<!-- <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"> -->
  <tr>
    <td align="center" valign="top"> 
     <!--  <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="100%" border="0" class=font1 bgcolor=white> -->
        <tr align="left" bgcolor="#92AED1" class=font1 style="color:#333333"> 
          <td height="19" colspan="7" class="boxleft5"> <b> 
            <?
		  		if($AssetType=="01") {echo "�ʴ������ŷ�Ѿ���Թ���������Թ";}
		  		if($AssetType=="02") {echo "�ʴ������ŷ�Ѿ���Թ��������觻�١���ҧ";}
		  		if($AssetType=="03") {echo "�ʴ������ŷ�Ѿ���Թ��������ҹ��˹�";}
		  		if($AssetType=="04") {echo "�ʴ������ŷ�Ѿ���Թ����������ͧ���ӹѡ�ҹ";}
				if($AssetType==""){  echo "�����Ŵ�ҹ��Ѿ���Թ";}
		  ?>
            </b> </td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" class=font1 style="color:#333333"> 
          <td width=4% height="28"><b>�ӴѺ</b></td>
          <!-- <td width=13%><b>���� ʡ�.</b></td> -->
          <td width="20%"><b> ��������Ѿ���Թ </b></td>
          <td width=10%><b>��Ҵ</b></td>
          <td width="10%" align="center"><b>�ӹǹ</b></td>
          <td width=13%><b>��Ť�һѨ�غѹ</b></td>
          <td width="10%"><b>��������ª��</b></td>
          <td width="27%"><b>�����˵�</b></td>
        </tr>
		  <?
					   if($numrows == "0")
							{
						 ?>
					  <tr align=center class=font1><td bgcolor="#F0F0F0" colspan ="7" height="30"   ><div align='center'><span class='txtred'>!!! ����բ����Ŵ�ҹ��Ѿ���Թ</span></div></td></tr>	
					  <?
							 }else{
					 ?>
        <?		
								$type=$org_searchtype;
								$page=30;  // ��˹��������ྨ�ʴ���¡�÷����� 40 ��¡��
								
					  			$nums=$page*$pagenum; 
								$allpage = $numrows/$page;
							  	$allpage=ceil($allpage);  // ceil �繡�ûѴ��ɷ���������繨ӹǹ���
								$number=$nums;
								//echo $nums;
								
								if($numrows>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
								while($rowall=mssql_fetch_row($exsql)) 
								{
							
						?>
        <tr align=left > 
          <td height="20" align="center" bgcolor="#F0F0F0"><?echo $number=$number+1;?></td>
          <!-- <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft15"><? echo "ʡ�. ".$rowall[3];?></td> -->
          <td bgcolor="#F0F0F0" class="boxleft15" style="border:1px solid #F0F0F0;"><?echo $rowall[6]?></td>
          <td height="20" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[7]?></td>
          <td align="center" bgcolor="#F0F0F0" class="boxleft15" ><?echo $rowall[8];?></td>
          <td height="20" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[9];?></td>
          <td height="20" align="center" bgcolor="#F0F0F0"  > 
            <?
		  if($rowall[10]=="1")
		  		{echo "��";}
			else
				{echo '<span class="txtred">�����</span>';}
		  ?>
          </td>
          <td bgcolor="#F0F0F0" class="boxleft15" > 
            <?
		 if($rowall[11]==''){echo "-";}
		 else{echo $rowall[11];}
		  ?>
          </td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// �͡�ҡ�ٻ���ѵ��ѵ� ����ͤú�������˹�����ٻ
						{  break;	}
							$i++;
						}
						 }
		?>
        <tr > 
          <td height="2" colspan="7" bgcolor="#C8D7E3"></td>
        </tr>
<!--       </table>
  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="font1"> -->
        <tr> 
          <td height="20" colspan="3"> 
   <?
		  	$countA="SELECT ";
		 	$countA.=" Count(A.AssetApplying) As A ";
			$countA.=" FROM dbo.AssetDetail A  ";
			$countA.=" LEFT OUTER JOIN (SELECT * FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince  ";
			$countA.=" LEFT OUTER JOIN ( SELECT * FROM AssetCode )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory  ";
			$countA.=" WHERE A.AMCCode ='$AMCCode' AND A.AssetAmount <>'' AND A.AssetValues<>''AND A.AssetApplying='1' ";
				if($AssetType <> '')
					{ $countA.=" AND A.AssetType='$AssetType' ";}
				if($div <> '')
					{$countA.=" AND B.br_code='$div' "; }
				if($lis_province <> '')
					{ $countA.="AND A.AssetProvince ='$lis_province' " ;}

			$excountA=mssql_query($countA);
			$dataA=mssql_fetch_row($excountA);
			
			//echo $countA.'<br>';
			
			
			$countB="SELECT ";
		 	$countB.=" Count(A.AssetApplying) As A ";
			$countB.=" FROM dbo.AssetDetail A  ";
			$countB.=" LEFT OUTER JOIN (SELECT * FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince  ";
			$countB.=" LEFT OUTER JOIN ( SELECT * FROM AssetCode )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory  ";
			$countB.=" WHERE A.AMCCode ='$AMCCode' AND A.AssetAmount <>'' AND A.AssetValues<>''AND A.AssetApplying='0' ";
				if($AssetType <> '')
					{ $countB.=" AND A.AssetType='$AssetType' ";}
				if($div <> '')
					{$countB.=" AND B.br_code='$div' "; }
				if($lis_province <> '')
					{ $countB.="AND A.AssetProvince ='$lis_province' " ;}
			
			$excountB=mssql_query($countB);
			$dataB=mssql_fetch_row($excountB);
			//echo $countB;

		   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=txtwhite>*** ��¡�÷�Ѿ���Թ�������� <b>'.$numrows.'</b>';
           echo ' ��¡��<br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<img src="images/icon_green.gif" width="6" height="6">  ';
            echo '&nbsp;��Ѿ���Թ����ա����ҹ�ӹǹ<span class=txtred> <b>'.$dataA[0].' </b></span>��¡��<br>';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';
            echo '<img src="images/icon_red.gif" width="6" height="6"> &nbsp;��Ѿ���Թ�������ա����ҹ�ӹǹ<span class =txtred> <b>'.$dataB[0].' </b></span>��¡��';
			
			?>
           </td>
        </tr>

   <!--    </table> -->



<!-- #### 5. ���������͢�����Ҫԡ�����§ҹ ʡ�. #### -->
 <tr> 
          <td height="20"  align="center" valign="middle"> 
            <?
							$sql=" SELECT A.AMCCode, A.MemberHelp,A.MemberHelpBranch,C.CAT_DESC, A.MemberYear,A.MemberID,B.MemberName,  ";
							$sql.=" B.MemberLsname, B.MemberBrithday,B.MemberPhone,B.MemberEdu, B.MemberAddress,A.MemberRemark ";
							$sql.="FROM NetworkMemberGroup A  ";
							$sql.=" LEFT JOIN( SELECT * FROM NetworkMemberDetail )AS B ON A.MemberID=B.MemberID  ";
							$sql.=" AND A.AMCCode=B.AMCCode  ";
							$sql.=" LEFT JOIN (SELECT D.AMCCode,D.amcprovince,E.CAT_AA,E.CAT_DESC FROM userlogin D ";
							$sql.=" LEFT JOIN(SELECT * FROM CCAATTIS WHERE CAT_CC<>'00'AND CAT_AA<>'00' AND CAT_TT='00' AND CAT_MM='00' ";
							$sql.=" AND CAT_DESC NOT LIKE '%*%') ";
							$sql.=" AS E ON D.amcprovince=E.CAT_CC ";
							$sql.=" )AS C ON A.AMCCode=C.AMCCode AND A.MemberHelpBranch=C.CAT_AA ";
							
							$sql.=" WHERE A.AMCCode='$AMCCode' ";
							/*		if($SendYear=="")
										{ $sql.=" AND A.MemberYear='$Year' "; }
									if($SendYear<>"")
										{ $sql.=" AND  A.MemberYear='$SendYear'";}
							*/
							$sql.=" ORDER BY  A.MemberYear DESC, A.MemberID ";
							
							//echo $sql;
							$exsql=mssql_query($sql);
							$numsql=mssql_num_rows($exsql);
							$i=1;
						?>
          </td>
        </tr>
        <tr> 
          <td height="50"  align="center" valign="middle"><!-- <table width="100%" border="0" cellpadding="0" cellspacing="0"> -->
              <tr><form name="form1" method="get" action="networkmember.php">
                <td align="center" valign="top" >
                  <!--   <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white> -->
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="19" colspan="10" align=left><b>&nbsp; ���������͢�����Ҫԡ�����§ҹ ʡ�. </b>
						</td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td  height="25">�ӴѺ</td>
                        <td >�Ңҷ����§ҹ</td>
                        <td  height="25" align="center">���ʻ�ЪҪ�</td>
                        <td  align="center"><br>
                          ����<br> <br> </td>
                        <td align="center">���ʡ��</td>
                        <td >����</td>
                        <td >�زԡ���֡��</td>
						<td height="25">�������</td>
                        <td>���Ѿ��</td>
                        <td >�շ������ҷӧҹ</td>

                      </tr>
					  	<?
								$i=1;
								$Education=array("","����Թ��ж�������º���","�Ѹ���֡��"," ͹ػ�ԭ��","��ԭ�ҵ��","�٧���� ��ԭ�ҵ��");
								$Edudegree=array("","��õ�Ҵ","�ѭ��","��������С�èѴ���","�ɵ���ʵ��","�ѧ����ʵ��","����");
								
								$type=$org_searchtype;
								$page=50;  // ��˹��������ྨ�ʴ���¡�÷����� 40 ��¡��
								
					  			$nums=$page*$pagenum; 
								$allpage = $numrows/$page;
							  	$allpage=ceil($allpage);  // ceil �繡�ûѴ��ɷ���������繨ӹǹ���
								$number=$nums;
								//echo $nums;
								//		mssql_data_seek($exsql,$nums); 			
											$i=1;

					  ?>
					  <?
					   if($numsql == "0")
							{
						 ?>
					  <tr align=center class=font1><td bgcolor="#F0F0F0" colspan ="10" height="30" ><div align='center'><span class='txtred'>!!! ����բ��������͢�����Ҫԡ�����§ҹ ʡ�.</span></div></td></tr>	
					  <?
							 }else{
					 ?>
                      <?
					/*----------------------------------------------- $sql2 �������Ѻ��ʺ��ͤ ------------------------------*/		
							/*	$sql2="SELECT *  ";
								$sql2.=" FROM PersonnelCode ";
								$sql2.=" WHERE PersonnelType <> '01' AND PersonnelType <> '02' AND PersonnelType <> '03' ";
								$sql2.=" AND PersonnelType <> '04' AND PersonnelType <> '05'";
								$exsql2=mssql_query($sql2);
					/*-----------------------------------------------------------------------------------------------------------------*/	
								
						
							
								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
									
											
					  ?>
                      <tr align=center bgcolor="#F0F0F0" > 
                         <td height="20" align=center> <?echo $number=$number+1;?> </td>
						  <td height="20" align="left" class="boxleft10"><?echo $rowall[3];?></td>
						  <td height="20" ><?echo $rowall[5]?></td>
						  <td height="20" align="left" class="boxleft5" ><?echo $rowall[6]?></td>
						  <td height="20" align="left" class="boxleft5" ><?echo $rowall[7]?></td>
						  <td > 
							<?
							$a=substr($rowall[8],6,4);
							$bb =(date('Y')+543);
								if(($bb-$a)=="0"){ echo "1";}
								else{ 	echo $bb-$a;}

						  ?>
						  </td>
						  <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[10]]?></td>
						  <td align="left" class="boxleft5" >
						 <?
								if($rowall[11]=="" OR $rowall[11]==" "){echo '-';}
								else{echo $rowall[11];}
						  ?>	  
						  </td>
						  <td><?echo $rowall[9]?>
						 <?
								if($rowall[9]=="" OR $rowall[9]==" "){echo '-';}
								else{echo $rowall[9];}
						  ?>	 		  
						  </td>
						  <td align="left" class="boxleft5" ><?echo $rowall[4]?></td>
					    
                      </tr>
                      <?
					  		}
						 }
					  ?>
				<tr > 
					<td height="2" colspan="10" bgcolor="#C8D7E3"></td>
				</tr>


<!-- #### 6. ���������͢����Ң� #### -->
<!-- <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"> -->
  <tr> 
    <td align="center" valign="top"><!-- <table width="100%" border="0" cellpadding="0" cellspacing="0"> -->
<!--         <tr> 
          <td height="40" colspan="2" align="center" valign="middle"> </td>
        </tr> -->
        <tr> 
          <td height="50" colspan="2" align="center" valign="middle"><!-- <table width="100%" border="0" cellpadding="0" cellspacing="0"> -->
              <tr> 
                <td align="center" valign="top" ><br>

                  <!--   <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white> -->
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
					    <?
					   if($numrows == "0")
							{
						 ?>
					   <td height="19" colspan=8 align=left><b>&nbsp; &nbsp;������ 
                          ���͢����Ң� &nbsp;</td>
					  <?
							 }else{
					 ?>
                        <td height="19" colspan=8 align=left><b>&nbsp; &nbsp;������ 
                          ���͢����Ң� &nbsp;<? echo '� �� '.$SendYear?></b>&nbsp;<span class="txtred">***˹����繺ҷ</span></td>
					<?
						 }
					?>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="5%" bgcolor="#C8D7E3">�ӴѺ</td>
                        <td width="15%" bgcolor="#C8D7E3">���͢����Ң�</td>
                  <!--      <td height="25" colspan="3" align="center" bgcolor="#D3D1C7">���භ��áԨ</td>
                        <td colspan="3" bgcolor="#DABEB6"> ����ҳ��áԨ</td>  -->
                       <!-- <td width="12%" rowspan="2" bgcolor="#C8D7E3">ź������</td> -->
                     <!-- </tr> -->
                      <!-- <tr align="center" style="color:#333333">  -->
                        <td width="12%" height="23" align="center" bgcolor="#E0DFD6">��áԨ����</td>
						<td width="12%" align="center" valign="middle" bgcolor="#E7D8D8">����ҳ����(�ҷ)</td>
                        <td width="12%" align="center" bgcolor="#E0DFD6">��áԨ���</td>
						<td width="12%" bgcolor="#E7D8D8">����ҳ���(�ҷ)</td>
                        <td width="12%" align="center" bgcolor="#E0DFD6">��áԨ��ԡ��</td>
						<td width="12%" bgcolor="#E7D8D8">����ҳ��ԡ��(�ҷ)</td>
                        
                          
                        
                        
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
						$sql.=" FROM   CCAATTIS ";
						$sql.=" WHERE CAT_AA !='00' AND CAT_TT = '00' AND CAT_MM='00' ";
						$sql.=" )AS A  ";
						$sql.="ON NETWORKBRANCH.CAT_CC = A.CAT_CC AND AMC.DBO.NETWORKBRANCH.CAT_AA  = A.CAT_AA ";
						$sql.=" WHERE AMCCode='$AMCCode'  AND BranchYear='$SendYear'  ORDER BY AMC.DBO.NETWORKBRANCH.CAT_AA "; 


						//$sql="SELECT AMC.DBO.NETWORKBRANCH.AMCCode, AMC.DBO.NETWORKBRANCH.CAT_CC, AMC.DBO.NETWORKBRANCH.CAT_AA, ";
						//$sql.=" A.CAT_DESC, AMC.DBO.NETWORKBRANCH.BranchTypeBuy, ";
						//$sql.=" AMC.DBO.NETWORKBRANCH.Branchtypesell, AMC.DBO.NETWORKBRANCH.BranchTypeservice, ";
						//$sql.=" AMC.DBO.NETWORKBRANCH.BranchValuesBuy, AMC.DBO.NETWORKBRANCH.BranchValuesSell, AMC.DBO.NETWORKBRANCH.BranchValuesService, ";
						//$sql.=" AMC.DBO.NETWORKBRANCH.BranchYear ";
						//$sql.=" FROM AMC.DBO.NETWORKBRANCH ";
						//$sql.=" LEFT JOIN( ";
						//$sql.=" SELECT CAT_CC, CAT_AA, CAT_DESC ";
						//$sql.=" FROM DBTP.DBO.CCAATTIS ";
						//$sql.=" WHERE CAT_AA !='00' AND CAT_TT = '00' AND CAT_MM='00' ";
						//$sql.=" )AS A  ";
						//$sql.="ON AMC.DBO.NETWORKBRANCH.CAT_CC = A.CAT_CC AND AMC.DBO.NETWORKBRANCH.CAT_AA  = A.CAT_AA ";
						//$sql.=" WHERE AMCCode='$AMCCode' AND BranchYear='$Year' ORDER BY AMC.DBO.NETWORKBRANCH.CAT_AA "; 

						//			echo $AMCCode;
								//echo $sql;	
								$exsql=mssql_query($sql);
								$numrow=mssql_num_rows($exsql);
					//		echo $numrow;
								if($numrow>0)
								{
								$i=1;
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
								{
				//					echo $rowall[3];

									if($rowall[3]<>""){
							?>
<!-- 						<tr align=center class=font1 style="color:#666666;"> 
                        <td height="19" colspan=8 align=left><b>&nbsp; &nbsp;������ 
                          ���͢����Ң�</b></td>
                      </tr> -->			  
					
                      <tr align=center class=font1 > 
                        <td width="5%" height="19" bgcolor="#F0F0F0"><?echo $aa=$aa+1;?></td>
                        <td height="19" align="left" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[3];?> 
                          <input type="hidden" name="CAT_AA<?=$i?>" value="<?echo $rowall[2];?>" > 
                          <input type="hidden" name="new<?=$i?>" value="0"> 
                        <td bgcolor="#F0F0F0" > 
                          <?php
			//			  <input type="radio" name="rdo1" value="1" checked OnClick="document.form1.lstBrn.disabled=false;">
					  			$typebuy=$rowall[4];
								if($rowall[7]<>" ")
									{echo"<span class='txtgreen'> ��";}
							else{echo"<span class='txtred'> �����";}
                         ?>
                        </td>
						<td bgcolor="#F0F0F0" >
							<?  if($rowall[7]<>" ")
									{echo $rowall[7];}
							else{echo" - ";}
							?>
                        </td>
                                  <td width="13%" height="19" bgcolor="#F0F0F0"> 
                                    <?php
						  
					  			$typesell=$rowall[5];
								if($rowall[8]<>" ")
										{echo"<span class='txtgreen'> ��";}
								else{echo"<span class='txtred'> �����";}
                         ?>
                                  </td>
								  <td bgcolor="#F0F0F0">
								  <?  if($rowall[8]<>" ")
									{echo $rowall[8];}
							else{echo" - ";}
								?>
									</td>
                        <td height="19" bgcolor="#F0F0F0" > 
                          <?php
					 	 		$typeservice=$rowall[6];
								if($rowall[9]<>" ")
									{echo"<span class='txtgreen'> ��";}
							else{echo"<span class='txtred'> �����";}
						?>			
							</td>
                        <td bgcolor="#F0F0F0" >
							<?  if($rowall[9]<>" ")
									{echo $rowall[9];}
							else{echo" - ";}
							?>
						</td>
                      </tr>

					<? 
						  }
					  ?>

                      <?php
						$i++;			
					  
					  }
				}
					 if($numrow=="0" OR $numrow=="" )
							{
						 ?>
					  <tr align=center class=font1><td bgcolor="#F0F0F0" colspan ="8" height="30" colspan=8  ><div align='center'><span class='txtred'>!!! ����բ��������͢����Ң�</span></div></td></tr>	
					  <?
							 }
						$p=$row-$a;
						if($row>$a)
							{
								for($b=1;$b<=$p;$b++)
								{
									
				?>
                      <tr align=center class=font1> 
                        <td height="20" align=center bgcolor="#F8F1C7"><?echo $a=$a+1;?> 
                        </td>
                        <td height="20" align="left" bgcolor="#F8F1C7" class="boxleft15"> 
                          <?
						$sql="SELECT CAT_CC, CAT_AA, CAT_DESC ";
						$sql.=" FROM  CCAATTIS ";
						$sql.=" WHERE CAT_CC= '$province' AND CAT_AA <> '00' ";
						$sql.=" AND CAT_TT ='00' AND CAT_MM ='00' ";
						$sql.=" AND CAT_DESC NOT LIKE '%*%' ";
						$sql.=" AND CAT_CC+CAT_AA NOT IN ( ";
						$sql.=" SELECT CAT_CC+CAT_AA FROM AMC.DBO.NETWORKBRANCH) ORDER BY CAT_AA ";
						$exsql=mssql_query($sql);
						$nubs=mssql_num_rows($exsql);
					
						//echo $nubs;
						//echo $sql;
						echo	'<select name="CAT_AA'.$i.'" class="txtbox95per" >';
						echo '<option value="">���͡�����</option>';
							while($rowall=mssql_fetch_row($exsql)) 
								{
									echo '<option value='.$rowall[1].'>'.$rowall[2].'</option>';
								}
                         echo  '</select>';
						// echo $i;
				?>
                          <input type="hidden" name="new<?=$i?>" value="1"> </td>
                        <td bgcolor="#F8F1C7" > <input type="radio" name="typebuy<?=$i?>"  value="1" Onclick="document.form1.valuesbuy<?=$i?>.disabled=false;">
                          �� 
                          <input type="radio" name="typebuy<?=$i?>"  value="0" Onclick="document.form1.valuesbuy<?=$i?>.disabled=true;">
                          �����</td>
                        <td height="20" bgcolor="#F8F1C7"> <input type="radio" name="typesell<?=$i?>"  value="1"  Onclick="document.form1.valuessell<?=$i?>.disabled=false;">
                          �� 
                          <input type="radio" name="typesell<?=$i?>"  value="0" Onclick="document.form1.valuessell<?=$i?>.disabled=true;">
                          �����</td>
                        <td height="20" bgcolor="#F8F1C7" > <input type="radio" name="typeservice<?=$i?>"  value="1"  Onclick="document.form1.valuesservice<?=$i?>.disabled=false;">
                          �� 
                          <input type="radio" name="typeservice<?=$i?>"  value="0" Onclick="document.form1.valuesservice<?=$i?>.disabled=true;">
                          �����</td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesbuy<?=$i?>" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7"><input name="valuessell<?=$i?>" type="text" class="Assetsize" style="text-align: right;"></td>
                        <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="valuesservice<?=$i?>" type="text" class="Assetsize" style="text-align: right;"></td>
                        <!-- <td bgcolor="#F8F1C7" style="color:#FF0080;border:1px solid #F0F0F0;">&nbsp;</td>  -->
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
				<tr > 
					<td height="2" colspan="8" bgcolor="#C8D7E3"></td>
				</tr>
              <!--       </table>     -->
				 </td>
              </tr>
      <!--       </table> --></td>
        </tr>
      <!-- </table -->></td>
  </tr>
<!-- </table> -->
				    <?
					  if($numrows == "0" OR $numrow=="" OR $numrow==" ")
							{
						 ?>
					  <tr ></tr>	
					  <?
							 }else{
					 ?>
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="100%" border="0" class=font1 bgcolor=white>
                      <tr align=center class=font1 style="color:#333333;"> 
                        <td height="19" colspan=8 align=left bgcolor="#92AED1"><b>&nbsp; 
                          &nbsp;�ʹ�����áԨ����л�</b></td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="5%" rowspan="2" bgcolor="#C8D7E3">�ӴѺ</td>
                        <td width="15%" rowspan="2" bgcolor="#C8D7E3">�� �.�</td>
                        <td height="25" colspan="6" bgcolor="#DABEB6"> ����ҳ��áԨ</td>
                      </tr>
                      <tr align="center" style="color:#333333"> 
                        <td width="25%" height="20" align="center" valign="middle" bgcolor="#E0DFD6" colspan="2" >�ʹ�����áԨ���� 
                          <br> </td>
                        <td width="25%" bgcolor="#E7D8D8" colspan="2">�ʹ�����áԨ���</td>
                        <td width="30%" bgcolor="#E0DFD6" colspan="2">�ʹ�����áԨ��ԡ��</td>
                      </tr>
                      <?php
								$total=" SELECT BranchYear,SUM(BranchValuesBuy),SUM(BranchValuesSell),SUM(BranchValuesService) ";
								$total.=" FROM Networkbranch where AMCCode='$AMCCode' Group BY BranchYear ORDER BY BranchYear DESC " ;
								$extotal=mssql_query($total);
								while($show=mssql_fetch_array($extotal))
									{
		
							?>
                      <tr align=center class=font1 > 
                        <td height="19" bgcolor="#F0F0F0"><?echo $x=$x+1;?></td>
                        <td height="19" align="left" bgcolor="#F0F0F0" class="boxleft15"><?echo $show[0];?> 
                              <td height="19" align="center" bgcolor="#F0F0F0"  class="txtgreen" colspan="2"><b><?echo $show[1]?></b></td>
                          <span class="txtred"></span> </td>
                              <td height="19" align="center" bgcolor="#F0F0F0"  class="txtgreen" colspan="2"><b><?echo $show[2]?></b> 
                                </span> </td>
                              <td height="19" align="center" bgcolor="#F0F0F0"  class="txtgreen" colspan="2"><b><?echo $show[3]?></b> 
                                </span> </td>
                      </tr>
                      <?
								}
						 }
							
					?>
				<tr > 
					<td height="2" colspan="8" bgcolor="#C8D7E3"></td>
				</tr>
                 <!--    </table> -->
                    </form>
				 </td>
              </tr>
          <!--   </table> --></td>
        </tr>
      </table>
</div>
</body>
</html>
