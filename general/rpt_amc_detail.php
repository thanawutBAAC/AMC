<?
 session_start();  ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>.:: �к��ҹ������ ʡ�. ::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
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
        include("../lib/ms_database.php");
//	include("function.php");
					if($SendYear==""){$SendYear=(date('Y')+543);}
		$sql =  " Select * ";
		$sql.= " From AMC ";
		$sql.= " Where AMCCode = '$AMCCode' ";
	
		$result=mssql_query($sql);
		
		$rs = mssql_fetch_assoc($result);
		 if($type<>"print"){ $bg= 'background="images/bg.jpg"'; }	 
		 $print=$type;
		 ?>
	

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" <?echo $bg;?>>
<tr>
  <td height="328" align="center" valign="top">
          <td align="left" valign="top"><tr>
        <td align="center" valign="top"><tr>
            <td height="10" align="left">&nbsp;</td>
        </tr>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <form name="form1" method="post" action="rpt_amc_detail.php">

  <tr> 
    <td height="884" valign="top" class="boxleft15"><table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="700" border="0" class=font1 bgcolor=white>
        <tr bgcolor="#92AED1" class="font1"> 
          <td height="19" colspan=3 align=left><b>&nbsp; &nbsp;�����ŷ���� <? echo 'ʡ�.'.$AMCName. '� 
            ��  ';
			if($type<>"print" OR $excel=="exprot"){
										$ShowYear=" SELECT PersonnelYear FROM PersonnelGroup ";
										$ShowYear.=" UNION ";
										$ShowYear.=" SELECT CommitteeGroup FROM CommitteeGroup ";
										$ShowYear.=" ORDER BY PersonnelYear DESC";
										//echo $ShowYear;
										$exShowYear=mssql_query($ShowYear);
											echo '<select name="SendYear">';
											echo '<option value="">���͡��</option>';
											while($rowall=mssql_fetch_array($exShowYear))
												{
													echo '<option value="'.$rowall[0].'">'.$rowall[0].'</option>';
												}							
											echo '</select>';


						//					$Year=(date(Y)+543);
												$Ckgroup="SELECT TOP 1(CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$AMCCode' ORDER BY Committeegroup DESC";
												$exCkgroup=mssql_query($Ckgroup);
												$data=mssql_fetch_array($exCkgroup);
												 if($data['CommitteeGroup']==$Year)
														{
																$sqlyear=" SELECT DISTINCT (CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$AMCCode' ORDER BY CommitteeGroup DESC ";
																$exsqlyear=mssql_query($sqlyear);
															//	echo ' <select name="SendYear">';
															//	echo '<option>������</option>';
																//echo $sqlyear;
															//		while($rowall=mssql_fetch_row($exsqlyear))
															//			{
															//				echo '<option value="'.$rowall[0].'" >'.$rowall[0].'</opton>' ;
															//			}
														
															//	echo '</select>';
														}
					
												if($data['CommitteeGroup']<$Year AND $data['CommitteeGroup']<>"")
													{
															$Cklast="SELECT TOP 1(CommitteeGroup) FROM CommitteeGroup WHERE AMCCode='$AMCCode' ORDER BY Committeegroup ";
															$exCklast=mssql_query($Cklast);
															$datalast=mssql_fetch_array($exCklast);
															//echo $Cklast;
															//echo $datalast['CommitteeGroup'];
														//		echo '<select name="SendYear">';
														//		for($i=$Year; $i>=$datalast['CommitteeGroup']; $i--)
														//				{
														//						echo '<option value="'.$i.'">'.$i.'</option>';
														//				
														//				}
														//		echo '</select>';
													}
													
											/*	if($data['CommitteeGroup']=="")
													{
															echo '<select name="SendYear">';
															echo '<option value="'.$Year.'">'.$Year.'</option>';
															echo '</select>';
													}*/
									?>
            <script language=JAVAScript> 
										for(i=0;i<=(document.form1.SendYear.length-1);i++) {
											if(document.form1.SendYear.options[i].value=="<? echo $SendYear ?>") {
												document.form1.SendYear.options[i].selected = true;
												break;
											}
										}
						</script>
						
						 <input name="SubmitC" type="Submit" class="formButton" value="Submit"  onMouseOver="this.style.cursor='hand'"> 
            &nbsp; <input type="hidden" name="AMCCode<?=$i?>" value="<?echo $AMCCode;?>"> 
            <input type="hidden" name="AMCName<?=$i?>" value="<?echo $AMCName;?>"> 
			<?
			}
			else {echo $SendYear.'</b>';}
			?>
          </td>
        </tr>
        <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
          <td height="25" colspan="3" class="boxleft30"> <? echo '- ʡ�. �ѧ��Ѵ '.$AMCName;?></td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center>1.</td>
          <td height="20" align="left" class="boxleft5">�Ţ����¹ ʡ�. : </td>
          <td align="left" class="boxleft5"> 
            <?=$rs["AMCCode"]?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center>2.</td>
          <td height="20" align="left" class="boxleft5">�ѹ��訴����¹ : </td>
          <td align="left" class="boxleft5"> 
            <?=$rs["AMCRegisDate"]?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center>3.</td>
          <td height="20" align="left" class="boxleft5">����� ʡ�. : </td>
          <td align="left" class="boxleft5"> 
            <?=$rs["AMCAddress"]?>
            <?  
							if(rtrim(ltrim($rs["AMCAddress"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCAddress"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center>4.</td>
          <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� : </td>
          <td align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCTel"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCTel"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td width="4%" height="20" align=center bgcolor="#F0F0F0">5. </td>
          <td width="22%" height="20" align="left" class="boxleft5">�����Ţ wan 
            : </td>
          <td width="69%" align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCWan"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCWan"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td width="4%" height="20" align=center bgcolor="#F0F0F0">6. </td>
          <td width="22%" height="20" align="left" class="boxleft5">Fax. : </td>
          <td width="69%" align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCFax"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCFax"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td width="4%" height="20" align=center bgcolor="#F0F0F0">7. </td>
          <td width="22%" height="20" align="left" class="boxleft5">Internet �ͧ 
            ʡ�. : </td>
          <td width="69%" align="left" class="boxleft5"> 
            <? if($rs["AMCNET"]=="1"){echo"<span class='txtgreen'> ��";}
							else{echo"<span class='txtred'> �����";}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#BBD0E1" style="color:#BBD0E1;"> 
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center rowspan="3">8. </td>
          <td height="20" align="left" class="boxleft5">����-ʡ�� : </td>
          <td align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCPosition_1_Name"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_1_Name"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <!--  <td height="20" align=center >8. </td> -->
          <td height="20" align="left" class="boxleft5">���˹� <br>
            ( ����Ǩ�ͺ�Ԩ���) : </td>
          <td align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCPosition_1"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_1"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <!--   <td height="20" align=center>9.</td> -->
          <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� : </td>
          <td align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCPosition_1_Tel"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_1_Tel"];}
						?>
          </td>
        </tr>
        <tr> 
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center rowspan="3">9. </td>
          <td height="20" align="left" class="boxleft5">����-ʡ�� : </td>
          <td align="left" class="boxleft5"> 
            <?=$rs["AMCPosition_2_Name"]?>
            <?  
							if(rtrim(ltrim($rs["AMCPosition_2_Name"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_2_Name"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <!--  <td height="20" align=center >8. </td> -->
          <td height="20" align="left" class="boxleft5">���˹� <br>
            ( ����֡�ҡԨ��� ʡ�. : </td>
          <td align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCPosition_2"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_2"];}
						?>
          </td>
        </tr>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <!--   <td height="20" align=center>9.</td> -->
          <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� : </td>
          <td align="left" class="boxleft5"> 
            <?  
							if(rtrim(ltrim($rs["AMCPosition_2_Tel"]))=="")
										{echo" - ";}
								else
									{ echo $rs["AMCPosition_2_Tel"];}
						?>
          </td>
        </tr>
        <tr > 
          <td height="2" colspan="8" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
      <br>
      <br>
      <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="700" border="0" class=font1 bgcolor=white>
        <tr align="left" bgcolor="#92AED1" class=font1 style="color:#333333"> 
          <td height="19" colspan="9" class="boxleft5"> <b> 
            <?
					$sql="SELECT A.AMCCode, A.AssetProvince, B.br_code, B.userdetail, A.AssetType, ";
					$sql.=" A.AssetCategory,C.AssetName, A.AssetSize, A.AssetAmount, A.AssetTypeGround, A.AssetValues, A.AssetApplying,A.AssetRemark, A.AssetSize2, A.AssetSize3 ";
					$sql.=" FROM dbo.AssetDetail A  ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.="  FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince ";
					$sql.="LEFT OUTER JOIN ";
					$sql.=" ( ";
					$sql.="  SELECT *  ";
					$sql.="  FROM AssetCode ";
					$sql.=" )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory" ;
					$sql.=" WHERE A.AMCCode ='$AMCCode'  ";  // AND A.AssetAmount <>'' AND A.AssetValues<>''" ;
					if($lb_prov <> '')
						{ $sql.=" AND A.AssetType='$lb_prov' ";}
					if($lb_tumbon<>'' AND $lb_tumbon<>"00")
						{$sql.="AND A.Assetcategory='$lb_tumbon' ";}
					if($div <> '')
						{$sql.=" AND B.br_code='$div' "; }
					if($lis_province <> '')
						{ $sql.="AND A.AssetProvince ='$lis_province' " ;}
						$sql.=" ORDER BY  A.AssetProvince ";
					//echo $sql;
					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
					
								
		  		if($AssetType=="01") {echo "�ʴ������ŷ�Ѿ���Թ���������Թ";}
		  		if($AssetType=="02") {echo "�ʴ������ŷ�Ѿ���Թ��������觻�١���ҧ";}
		  		if($AssetType=="03") {echo "�ʴ������ŷ�Ѿ���Թ��������ҹ��˹�";}
		  		if($AssetType=="04") {echo "�ʴ������ŷ�Ѿ���Թ����������ͧ���ӹѡ�ҹ";}
				if($AssetType==""){  echo "�ʴ������ŷ�Ѿ���Թ�ء������";}
		  ?>
            </b> </td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" class=font1 style="color:#333333"> 
          <td width=4% height="28"><b>�ӴѺ</b></td>
          <td width=13%><b>���� ʡ�.</b></td>
          <td width="20%"><b> ��������Ѿ���Թ </b></td>
          <td width=10%><b>��Ҵ</b></td>
          <td width="5%" align="center"><b>�ӹǹ</b></td>
          <td width="8%" align="center"><b>������</b></td>
          <td width=10%><b>��Ť�һѨ�غѹ</b></td>
          <td width="10%"><b>��������ª��</b></td>
          <td width="27%"><b>�����˵�</b></td>
        </tr>
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
        <tr align=left style="color:#666666;"> 
          <td height="20" align="center" bgcolor="#F0F0F0"><?echo $number=$number+1;?></td>
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft15"><? echo "ʡ�. ".$rowall[3];?></td>
          <td bgcolor="#F0F0F0" class="boxleft15" style="border:1px solid #F0F0F0;"><?echo $rowall[6]?></td>
          <td height="20" align="center" bgcolor="#F0F0F0"> 
            <?
			if($rowall[4]=="01")
				{
					if(trim($rowall[7])<>""){echo $rowall[7].'&nbsp;���&nbsp;';}
					if(trim($rowall[13])<>""){echo $rowall[13].'&nbsp;�ҹ&nbsp;';}
					if(trim($rowall[14])<>""){echo $rowall[14].'&nbsp;���.&nbsp;';}
				}
			else
			{
			 echo $rowall[7];
			}
		  
		  ?>
          </td>
          <td align="center" bgcolor="#F0F0F0" ><? echo $rowall[8];?></td>
          <td align="center" bgcolor="#F0F0F0" > 
            <?
				echo $rowall[9];
		?>
          </td>
          <td height="20" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[10];?></td>
          <td height="20" align="center" bgcolor="#F0F0F0"  > 
            <?
		  if($rowall[11]=="1")
		  		{echo "��";}
			else
				{echo '<span class="txtred">�����</span>';}
		  ?>
          </td>
          <td bgcolor="#F0F0F0" class="boxleft15" > 
            <?
		 if($rowall[12]==''){echo "-";}
		 else{echo $rowall[12];}
		  ?>
          </td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// �͡�ҡ�ٻ���ѵ��ѵ� ����ͤú�������˹�����ٻ
						{  break;	}
							$i++;
						}
		?>
        <tr > 
          <td height="2" colspan="9" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
      <br>
      <br>
      <table width="1600" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="font1">
        <tr bgcolor="#92AED1" class="font1"> 
          <td height="19" colspan="20" class="boxleft5" ><b> 
            <?
								$sql=" SELECT A.AMCCode, D.br_code, D.br_name, D.amcprovince, D.userdetail, A.CommitteeGroup, ";
								$sql.=" A.Committeeoccasion, A.CommitteeYear, A.CommitteeStatus, A.CommitteeID, C.CommitteeType,  ";
								$sql.=" C.CommitteeCategory, C.CommitteeName, B.MemberName,B.MemberLastname, B.MemberBirthDay, ";
								$sql.=" B.MemberAddress, B.MemberPhone, A.CommitteeAMC, B.MemberEducation, B.MemberDegree,  ";
								$sql.=" A.CommitteeSocial, B.MemberOccu, B.MemberOccuSecond, B.MemberRemark  ";

								$sql.=" FROM CommitteeGroup A  ";

								$sql.=" LEFT JOIN(SELECT * FROM AMCCustomer)AS B ON A.CommitteeID=B.MemberID  ";

								$sql.=" LEFT JOiN (SELECT * FROM CommitteeCode) AS C ON A.CommitteeType=C.CommitteeType  ";
								$sql.=" AND A.CommitteeCategory=C.CommitteeCategory  ";
								$sql.=" LEFT JOIN( SELECT amccode,amcprovince,userdetail,br_code,br_name FROM UserLogin ) ";
								$sql.=" AS D ON A.AMCCode=D.AMCCode  ";

									
								if($list_committee<>"")								
											{ $sql.=" AND C.CommitteeType ='$list_committee' "; }
									if($div<>"")
											{ $sql.=" AND D.br_code='$div' ";}
									if($list_province<>"")		
											{ $sql.=" AND D.amcprovince='$list_province' ";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.CommitteeID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND B.MemberName like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND B.MemberLastname like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND B.MemberPhone like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND B.MemberEducation ='$list_education' "; }
									if($list_degree)
											{ $sql.=" AND B.MemberDegree='$list_degree' ";}
									if($txt_address<>"")		
											{ $sql.=" AND B.MemberAddress like '%$txt_address%' ";}
									if($list_year<>"")
											{ $sql.=" AND A.CommitteeGroup='$list_year' ";}
									$sql.="WHERE D.br_code is not null  AND A.AMCCode='$AMCCode' AND committeegroup='$SendYear'";
									$sql.="ORDER BY A.CommitteeGroup DESC, C.CommitteeType,A.CommitteeID ";
									

						//	echo $sql;
							$exsql=mssql_query($sql);		  //		echo $list_year;
							$numrows=mssql_num_rows($exsql);
		  		if($list_year<>"")
					{
							echo  '&nbsp; &nbsp;�����Ť�С������ � �� '.$list_year.'';
					}
				if($list_year=="")
					{
							echo "�ʴ������Ť�С�����÷�����";
					}
		  ?>
            </b></td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="35" rowspan="2">�ӴѺ</td>
          <td width="85" rowspan="2" bgcolor="#BBD0E1">ʡ�.</td>
          <td width="120" rowspan="2" align="center">���˹�</td>
          <td width="130" rowspan="2">���ʻ�ЪҪ�</td>
          <td width="100" rowspan="2">����</td>
          <td width="100" rowspan="2">���ʡ��</td>
          <td width="40" rowspan="2">����</td>
          <td width="200" rowspan="2">�������</td>
          <td width="39" rowspan="2" align="center" >����<br>
            ���Ѿ��</td>
          <td width="40" rowspan="2" >��</td>
          <td height="20" colspan="2">��ô�ç���˹�</td>
          <td width="50" rowspan="2">�� <br>
            ��.ʡ�.</td>
          <td width="150" rowspan="2">�زԡ���֡��<br>
            �٧�ش</td>
          <td width="100" rowspan="2">�дѺ����֡��</td>
          <td width="80" rowspan="2">ʶҹ�<br>
            �ҧ�ѧ��</td>
          <td width="100" rowspan="2">�Ҫվ��ѡ</td>
          <td width="100" rowspan="2">�Ҫվ�ͧ</td>
          <td width="120" rowspan="2">�����˵�</td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1"> 
          <td width="40" height="18">����</td>
          <td width="40">��</td>
        </tr>
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
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											
											$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
											$Education=array("","��ж�������º���","�Ѹ���֡��"," ͹ػ�ԭ��","��ԭ�ҵ��","�٧���� ��ԭ�ҵ��");
											$Edudegree=array("","��õ�Ҵ","�ѭ��","��������С�èѴ���","�ɵ���ʵ��","�ѧ����ʵ��","����");
											$AMC=array("�����","��");
								?>
        <tr bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align="center"> <?echo $number=$number+1;?> </td>
          <td align="left" class="boxleft5"><?echo $rowall[4]?> </td>
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
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF"><?echo $show_id?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[13]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[14]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF"> 
                  <?
			$a=substr(trim($rowall[15]),-4);
			$bb =(date('Y')+543);
			//echo$rowall[15];
			echo $bb-$a;
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left" bgcolor="#FFFFFF" class="boxleft5"><?echo $rowall[16]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF"><?echo $rowall[17]?></td>
              </tr>
            </table></td>
          <td align="center"><?echo $rowall[5]?></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF"><?echo $rowall[6]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF"><?echo $rowall[7]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="center" bgcolor="#FFFFFF"> 
                  <?
		  if($AMC[$rowall[18]]=="�����"){echo '<span class="txtred">'.$AMC[$rowall[18]].'</span>';}
		  else{echo $AMC[$rowall[18]];}
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left"  class="boxleft5"><?echo $Education[$rowall[19]]?></td>
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
                <td align="center"  class="boxleft5"> 
                  <?
		  		if($rowall[21]=="�����"){echo '<span class="txtred">'.$rowall[21].'</span>';}
				else{echo $rowall[21];}
		  ?>
                </td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left"  class="boxleft5"><?echo $Occu[$rowall[22]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left"  class="boxleft5"><?echo $Occu[$rowall[23]]?></td>
              </tr>
            </table></td>
          <td align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="3" class="font1" style="color:#666666;">
              <tr> 
                <td align="left"  class="boxleft5"><?echo $rowall[24]?></td>
              </tr>
            </table></td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// �͡�ҡ�ٻ���ѵ��ѵ� ����ͤú�������˹�����ٻ
						{  break;	}
							$i++;
						}	
				?>
        <tr bgcolor="#C8D7E3" style="color:#666666;"> 
          <td height="2" colspan="20" align="center"></td>
        </tr>
      </table>
<br>
<br>
      <table width="1200" border="0" cellPadding="0" cellSpacing="1" bgcolor=white class=font1 >
        <tr align=center bgcolor="#92AED1" style="color:#333333;"> 
          <td height="19" colspan=18 align=left class="boxleft5"><b> 
            <?
								$sql=" SELECT A.AMCCode,C.AMCProvince, C.userdetail, C.br_code,C.br_name, A.PersonnelID,  ";
								$sql.=" A.PersonnelType, A.PersonnelCategory, B.PersonnelName, A.PersonnelYear, D.MemberName,  ";
								$sql.=" D.MemberLastname, D.MemberBirthday, D.memberworking, D.MemberEducation,  ";
								$sql.=" D.MemberDegree, D.MemberPhone, D.MemberAddress, D.MemberRemark  ";

								$sql.=" FROM PersonnelGroup A  ";
								$sql.=" LEFT JOIN ( SELECT * FROM PersonnelCode )AS B ON A.PersonnelType=B.PersonnelType  ";

								$sql.=" LEFT JOIN ( SELECT * FROM UserLogin ) AS C ON A.AMCCOde=C.AMCCode ";

								$sql.=" LEFT JOIN ( SELECT * FROM AMCCustomer)AS D ON  A.PersonnelID=D.MemberID ";								
								$sql.=" WHERE A.AMCCode='$AMCCode' AND PersonnelYear='$SendYear'";
							
									if($list_personnel<>"")
											{ $sql.=" AND A.PersonnelType ='$list_personnel' "; }
									if($div<>"")
											{ $sql.=" AND C.br_code='$div' ";}
									if($list_province<>"")		
											{ $sql.=" AND C.AMCProvince='$list_province' ";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.PersonnelID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND D.MemberName like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND D.MemberLastname like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND D.MemberPhone like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND D.MemberEducation ='$list_education' "; }
									if($list_degree)
											{ $sql.=" AND D.MemberDegree= '$list_degree'";}
									if($txt_address<>"")		
											{ $sql.=" AND D.MemberAddress like '%$txt_address%' ";}
									$sql.="ORDER BY A.PersonnelYear DESC,  A.PersonnelType,A.PersonnelID ,A.AMCCode";
									$exsql=mssql_query($sql);
									$numrows=mssql_num_rows($exsql);
			
		//	echo $sql;
		  //		echo $list_year;
		  		if($list_year<>"")
					{
							echo  '&nbsp; &nbsp;�����ž�ѡ�ҹ � �� '.$list_year.'';
					}
				if($list_year=="")
					{
							echo "�ʴ������ž�ѡ�ҹ������";
					}
		  ?>
            </b></td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="25">�ӴѺ</td>
          <td width="80" height="25">ʡ�.</td>
          <td width="100">���˹�</td>
          <td width="100" height="25" align="center">���ʻ�ЪҪ�</td>
          <td width="100" height="25" align="center"> ����</td>
          <td width="100" height="25" align="center">���ʡ��</td>
          <td width="30" height="25"> ����</td>
          <td width="50">�շ��<br>
            ��ҷӧҹ</td>
          <td width="80" height="25">�زԡ���֡��</td>
          <td width="80">�дѺ����֡��</td>
          <td width="100" height="25">���Ѿ��</td>
          <td width="140" height="25">�������</td>
          <td width="100" height="25">�����˵�</td>
        </tr>
        <?
								$i=1;
							//	$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
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
								//echo $nums;
								
								if($numrows>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											//$b=$rowall[9];
					  ?>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center> <?echo $number=$number+1;?> </td>
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><?echo $rowall[2]?> 
          </td>
          <td height="20" align="left" class="boxleft10"><?echo $Position[$rowall[6]];?></td>
          <td height="20" ><?echo $rowall[5]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[10]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[11]?></td>
          <td > 
            <?
			if($rowall[12]<>"" AND $rowall[12]<> null)
				{
					$a=substr(trim($rowall[12]),-4);
					$bb =(date('Y')+543);
						if(($bb-$a)=="0"){ echo "1";}
						else{ 	echo $bb-$a;}
					}

		  ?>
          </td>
          <td ><?echo $rowall[13]?></td>
          <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[14]]?></td>
          <td align="left" class="boxleft5" >
            <? if($rowall[15]!=""){ echo $Edudegree[$rowall[15]]; } else {echo "����к�";}?>
          </td>
          <td><?echo $rowall[16]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[17]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[18]?></td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// �͡�ҡ�ٻ���ѵ��ѵ� ����ͤú�������˹�����ٻ
						{  break;	}
							$i++;
						}
		?>
        <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
          <td height="2" colspan="24" bgcolor="#C8D7E3"></td>
        </tr>
      </table> 

      <br>
      <br>
      <table width="98%" border="0" cellPadding="0" cellSpacing="1" bgcolor=white class=font1 >
        <tr align=center bgcolor="#92AED1" style="color:#333333;"> 
          <td height="19" colspan=18 align=left class="boxleft5"><b>���������͢�����Ҫԡ</b>
		  <?
					$sql=" SELECT C.BR_CODE,C.BR_NAME,C.AMCPROVINCE,C.USERDETAIL,C.MEMBERHELPBRANCH,C.CAT_DESC, ";
					$sql.=" C.AMCCODE,A.MEMBERID,A.MEMBERNAME, A.MEMBERLASTNAME,A.MEMBERBIRTHDAY,A.MEMBERPHONE,A.MEMBEREDUCATION, ";
					$sql.=" A.MEMBERADDRESS,C.MEMBERREMARK,C.MEMBERUPDATE  ";
					$sql.=" FROM AMCCustomer A  ";
					$sql.=" LEFT JOIN (  ";
					$sql.=" SELECT A.AMCCODE,B.BR_CODE, B.BR_NAME, A.MEMBERID,A.MEMBERYEAR,A.MEMBERHELP,B.AMCPROVINCE, ";
					$sql.=" B.USERDETAIL, A.MEMBERHELPBRANCH,B.CAT_DESC,A.MEMBERREMARK,A.MEMBERUPDATE  ";
					$sql.=" FROM NETWORKMEMBERGROUP A  ";
					$sql.=" LEFT JOIN ( SELECT * FROM USERLOGIN A  ";
					$sql.=" LEFT JOIN(SELECT *  ";
					$sql.=" FROM CCAATTIS  ";
					$sql.=" WHERE CAT_TT='00'AND CAT_MM='00') ";
					$sql.=" AS B ON A.AMCPROVINCE=B.CAT_CC ) ";
					$sql.=" AS B ON A.AMCCODE=B.AMCCODE AND A.MEMBERHELPBRANCH=B.CAT_AA ) ";
					$sql.=" AS C ON A.MEMBERID=C.MEMBERID  ";

					$sql.=" WHERE C.AMCCODE = '$AMCCode' ";
									if($div<>"")
											{ $sql.=" AND C.BR_CODE ='$div' "; }
									if($list_province<>"")		
											{ $sql.=" AND C.AMCPROVINCE='$list_province' ";}
									if($branch<>"")
											{ $branch2=substr($branch,2,2);	$sql.=" AND C.MEMBERHELPBRANCH='$branch2'";}
									if($txt_user_id<>"")
											{ $sql.=" AND A.MEMBERID like '%$txt_user_id%' ";}
									if($txt_name<>"")		
											{ $sql.=" AND A.MEMBERNAME like '%$txt_name%' " ;}
									if($txt_lastname<>"")		
											{ $sql.=" AND A.MEMBERLASTNAME like '%$txt_lastname%' ";}
									if($txt_phone<>"")
											{ $sql.=" AND A.MEMBERPHONE like '%$txt_phone%' ";}
									if($list_education<>"")		
											{ $sql.=" AND A.MEMBEREDUCATION ='$list_education' "; }
									if($txt_address<>"")		
											{ $sql.=" AND A.MEMBERADDRESS like '%$txt_address%' ";}
									$sql.="ORDER BY  C.BR_CODE, C.AMCProvince,  C.MEMBERHELPBRANCH , A.MEMBERID";
							//echo $province;		
						//	echo $sql;
							$exsql=mssql_query($sql);
							$numrows=mssql_num_rows($exsql);
		  
		  ?>
		  </td>
        </tr>
        <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
          <td width="30" height="25">�ӴѺ</td>
          <td width="80" height="25">ʡ�.</td>
          <td width="100">�Ңҷ����§ҹ</td>
          <td width="100" height="25" align="center">���ʻ�ЪҪ�</td>
          <td width="100" height="25" align="center"> ����</td>
          <td width="100" height="25" align="center">���ʡ��</td>
          <td width="30" height="25"> ����</td>
          <td width="100" height="25">�زԡ���֡��</td>
          <td width="100" height="25">���Ѿ��</td>
          <td width="140" height="25">�������</td>
          <td width="100" height="25">�����˵�</td>
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
								
								if($numrows>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
								while($rowall=mssql_fetch_row($exsql)) 
									{
											if($rowall[0]!=""){$Update='1';}
											if($rowall[0]==""){$Update='0';}
											//$b=$rowall[9];
					  ?>
        <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
          <td height="20" align=center> <?echo $number=$number+1;?> </td>
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft10"><?echo $rowall[3]?> 
          </td>
          <td height="20" align="left" class="boxleft10"><?echo $rowall[5];?></td>
          <td height="20" ><?echo $rowall[7]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[8]?></td>
          <td height="20" align="left" class="boxleft5" ><?echo $rowall[9]?></td>
          <td > 
            <?
			$a=substr(trim($rowall[10]),-4);
			$bb =(date('Y')+543);
				if(($bb-$a)=="0"){ echo "1";}
				else{ 	echo $bb-$a;}

		  ?>
          </td>
          <td align="left" >&nbsp;&nbsp;<?echo $Education[$rowall[12]]?></td>
          <td><?echo $rowall[11]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[13]?></td>
          <td align="left" class="boxleft5" ><?echo $rowall[14]?></td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// �͡�ҡ�ٻ���ѵ��ѵ� ����ͤú�������˹�����ٻ
						{  break;	}
							$i++;
						}
		?>
        <tr align=center bgcolor="#F0F0F0" class=font1 style="color:#666666;"> 
          <td height="2" colspan="24" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
        <br>
		<?
			if($print=="print")
			{
			?>
			      <script language="javascript">
				window.print();
				</SCRIPT>
			<?
			}
			else
			{
		?>
        <input  style="width:130px"type="submit" name="Submit2" value="��ͧ��þ������ǹ���"  onClick="window.open('rpt_amc_detail.php?AMCCode=<?echo $AMCCode;?>&SendYear=<?echo $SendYear?>&type=print')"> 
        &nbsp; <input  style="width:130px"type="submit" name="Submit22" value="�觢������͡�� Excel"  onClick="window.open('rpt_amc_detail_portexcel.php?AMCCode=<?echo $AMCCode;?>&SendYear=<?echo $SendYear?>&excel=export')">
        <?}?>
		<br>
        <br>
    </tr>
	  </form>
  </table>
</body>
</html>

