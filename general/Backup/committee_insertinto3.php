<? include ("checkuser.php");?>
<html>
<head>
<title>�к��ҹ ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg">
<?
	include ("images/lib/ms_database.php");
		$year=(date('Y')+543);
	//	echo "�չ���ͻ� ".$year.'<br><br>';

		//------------------> Check PersonnelGroup
		$CkPersonnel="SELECT * FROM PersonnelGroup WHERE AMCCode='$amc' AND PersonnelID='$txt_user_id' AND PersonnelYear='$year'";
		$exCkPersonnel=mssql_query($CkPersonnel);
		$numCkPersonnel=mssql_num_rows($exCkPersonnel);
	//	echo $CkPersonnel;
			if($numCkPersonnel=="0") // �óբ����ŷ����������� Table PersonneGroup �չ��
					{
						$year_1=$year-1;
						$year_2=$year-2;
						$year_3=$year-3;
						$year_4=$year-4;
					//	echo $year;
						if($list_Committeeoccasion=="1" AND $list_CommitteeYear=="1") { $SendYear='1'; } 
						if($list_Committeeoccasion=="1" AND $list_CommitteeYear=="2") { $SendYear='2'; } 
						if($list_Committeeoccasion=="2" AND $list_CommitteeYear=="1") { $SendYear='3'; } 
						if($list_Committeeoccasion=="2" AND $list_CommitteeYear=="2") { $SendYear='4'; } 

						$sql="SELECT TOP 1 * FROM CommitteeGroup WHERE AMCCode=='$amc' ORDER BY CommitteeGroup DESC ";  // ���� �ӹǹ ������л� �Ѩ�غѹ
						$ex_sql=mssql_query($sql);
						$numrows=mssql_num_rows($ex_sql);
						$data=mssql_fetch_array($ex_sql);
					//	echo $sql;
					//	$SendYear='2';
					//	echo '�ջѨ�غѹ�ͧ����ͧ �Կ������ͻ� '.$year.'<br>';
					//	echo '����к����֧���ͻ� '.$data['1'].'<br>'; 
					//	settype($data['CommitteeGroup'],"integer");
					//	echo gettype($data['CommitteeGroup']).'<br>';
					//	echo gettype($year).'<br>';

						if($data['CommitteeGroup']==$year)
								{
										//echo "aaa<br>";
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='1') { $AddYear="1"; $AddCommitteeoccasion="1"; $CommtteeYear="1";}
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='2') { $AddYear="2"; $AddCommitteeoccasion="1"; $CommtteeYear="2";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='1') { $AddYear="3"; $AddCommitteeoccasion="2"; $CommtteeYear="1";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='2') { $AddYear="4"; $AddCommitteeoccasion="2"; $CommtteeYear="2";}
								}
						if($data['CommitteeGroup']<$year)
								{	
										//echo "bbb<br>";
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='1') { $AddYear="2"; $AddCommitteeoccasion="1"; $CommtteeYear="2";}
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='2') { $AddYear="3"; $AddCommitteeoccasion="2"; $CommtteeYear="1";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='1') { $AddYear="4"; $AddCommitteeoccasion="2"; $CommtteeYear="2";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='2') { $AddYear="1"; $AddCommitteeoccasion="1"; $CommtteeYear="1";}
								}

					//	echo 'addyear '.$AddYear.'<br>';
						//echo 'sendyear '.$SendYear.'<br>';
							if($AddYear==$SendYear) // �óշ�� ������л� �ç�ѹ�Ѻ��� user �����������
								{
								//	$txt_user_id="1409800003520";
								//	$amc="�011834";
										// �� ID
										$Ckid=" SELECT * FROM CommitteeDetail WHERE CommitteeID='$txt_user_id' ";
										$exCkid=mssql_query($Ckid);
										$numCkid=mssql_num_rows($exCkid);
											if($numCkid=="0") //�óշ���� �ʹ�����
												{ 

														if($rdo_CommitteeSocial=="1")
															{ 
																if($txt_CommitteeSocial=="")
																	{ $CommSocial="������к�";}
																else
																	{ $CommSocial=$txt_CommitteeSocial; }
															 }
														if($rdo_CommitteeSocial=="0")
															{ $CommSocial="�����"; }


														$insert_detail=" INSERT INTO CommitteeDetail(CommitteeID,AMCCode,CommitteeName,CommitteeLastname, ";
														$insert_detail.=" CommitteeBirhtday,CommitteeAddress,CommitteePhone,CommitteeEdu,CommitteeDegree,CommitteeOccu,CommitteeOccuSecond, ";
														$insert_detail.=" CommitteeRemark) VALUES ('$txt_user_id','$amc','$txt_name','$txt_lsname','$txt_birthday','$area_address', ";
														$insert_detail.=" '$txt_phone','$list_education','$list_degree','$list_Occu','$list_Occusecond','$area_remark' )";

														$insert_group=" INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID,CommitteeType,CommitteeCategory,CommitteeSocial,CommitteeAMC) VALUES ";
														$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$AddYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory' ,'$CommSocial', '$rdo_CommitteeAMC')";
														//echo $insert_detail.'<br>';
														//echo $insert_group.'<br>';
														mssql_query($insert_detail);
														mssql_query($insert_group);
														echo '<script>alert("�ѹ�֡������ '.$txt_name.' '. $txt_lsname .' ����");window.location.href = "committee.php";</script>';
												} // ���óշ���� �ʹ�����


											if($numCkid=="1") //�óշ�����ʹի�ӡѹ�Դ�����к�
												{
					
													//echo '<b><br><br>A => 2551<br></b>';
													$Ckgroup= " SELECT *  ";
													$Ckgroup.=" FROM CommitteeGroup ";
													$Ckgroup.=" WHERE CommitteeID = '$txt_user_id' AND CommitteeGroup ='$year' ";
													$exCkgroup=mssql_query($Ckgroup);
													$numCkgroup=mssql_num_rows($exCkgroup);
												//	echo $numCkgroup.'<br>';
												//	echo $Ckgroup.'<br>';
														if($numCkgroup=="0") //�óշ������բ����Ť�С������㹡�����չ��
																{
																		$topgroup =" SELECT TOP 1* FROM CommitteeGroup WHERE AMCCode='$amc' ORDER BY CommitteeGroup DESC";
																		$extopgroup=mssql_query($topgroup);
																		//echo $topgroup.'<br><br>';
																		$datatopgroup=mssql_fetch_array($extopgroup);
																		$Committeegroup=$datatopgroup['1'];
																		$Committeeoccasion=$datatopgroup['2'];
																		$Committeeyear=$datatopgroup['3'];
																		//echo "Committeegroup = ".$Committeegroup.'<br>';
																		//echo "Committeeoccasion = ".$Committeeoccasion.'<br>';
																		//echo "Committeeyear = ".$Committeeyear.'<br>';

																		if(($Committeeoccasion=="2" AND $Committeeyear=="2") AND $Committeegroup < $year ) //�óշ�� ��������з�� 2 �շ�� 2 ��� �չ��¡��һջѨ�غѹ �óը�����������㹡��������
																			{
																					$Ckidgroup="SELECT * FROM CommitteeGroup WHERE CommitteeID='$txt_user_id' AND (CommitteeGroup='$year_1' OR CommitteeGroup='$year_2'  OR CommitteeGroup='$year_3' OR CommitteeGroup='$year_4' ) ORDER BY CommitteeGroup DESC";
																					$exCkidgroup=mssql_query($Ckidgroup);
																					$numCkidgroup=mssql_num_rows($exCkidgroup);
																					//echo $Ckidgroup.'<br>';
																						if($numCkidgroup=="0") // ���������������
																							{
																										$insert_group=" INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID,CommitteeType,CommitteeCategory,CommitteeSocial,CommitteeAMC) VALUES ";
																										$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$AddYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
																										//echo $insert_group;
																										mssql_query($insert_group);
																										echo '<script>alert("�ѹ�֡������ '.$txt_name.' '. $txt_lsname .' ����");window.location.href = "committee.php";</script>';
																							}
																						if($numCkidgroup>="1") // �������ö���������������ͧ�ҡ�բ�������͹��ѧ㹪ش����ش
																							{
																									echo '<script>alert("�ѹ�֡����������� ���ͧ�ҡ��Ժѵԧҹ���� 4 �շ������");window.location.href = "committee.php";</script>';
																							}
																			} //���ó� ��������з�� 2 �շ�� 2


																		elseif(($Committeeoccasion=="1" AND $Committeeyear=="1") AND $Committeegroup ==$year) // �óշ����������з�� 1 �շ�� 1 ����繻ջѨ�غѹ ��Ш�����������㹡��������
																			{
																					$Ckidgroup="SELECT * FROM CommitteeGroup WHERE CommitteeID='$txt_user_id' AND (CommitteeGroup='$year_1' OR CommitteeGroup='$year_2'  OR CommitteeGroup='$year_3' OR CommitteeGroup='$year_4' ) ORDER BY CommitteeGroup DESC";
																					$exCkidgroup=mssql_query($Ckidgroup);
																					$numCkidgroup=mssql_num_rows($exCkidgroup);
																					//echo $Ckidgroup.'<br>';
																						if($numCkidgroup=="0") // ���������������
																							{
																										$insert_group=" INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID,CommitteeType,CommitteeCategory,CommitteeSocial,CommitteeAMC) VALUES ";
																										$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$AddYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
																										mssql_query($insert_group);
																										echo '<script>alert("�ѹ�֡������ '.$txt_name.' '. $txt_lsname .' ����");window.location.href = "committee.php";</script>';
																							}
																						if($numCkidgroup>="1") // �������ö���������������ͧ�ҡ�բ�������͹��ѧ㹪ش����ش
																							{
																									echo '<script>alert("�ѹ�֡����������� ���ͧ�ҡ�բ�����㹪ش�������");window.location.href = "committee_add.php";</script>';
																							}
																			} //���ó� ��������з�� 1 �շ�� 1

																		else
																			{
																					$insert_group=" INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID,CommitteeType,CommitteeCategory,CommitteeSocial,CommitteeAMC) VALUES ";
																					$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$AddYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
																					mssql_query($insert_group);
																					echo '<script>alert("�ѹ�֡������ '.$txt_name.' '. $txt_lsname .' ����");window.location.href = "committee.php";</script>';
																			}

																}


														if($numCkgroup=="1") //�óշ���բ����Ť�С������㹡�����չ������
																{
																	echo '<script>alert("�ѹ�֡����������� ���ͧ�ҡ�բ�����㹻ջѨ�غѹ����");window.location.href = "committee_add.php";</script>';
																}
											
												} // �ͧ $numCkid=="1"
										

								}// �� ����� �����з������ �ç�ѹ


							else  //��� ���� / �շ���������ç�ѹ
								{
									echo '<script>alert(" ���� '.$list_Committeeoccasion.' / �շ�� '.$list_CommitteeYear.' ���ç�Ѻ��������к�");window.location.href = "committee_add.php";</script>';
								}
							}
				else
							{
									echo '<script>alert(" �������ö�ѹ�֡�������� ���ͧ�ҡ���ʻ�ЪҪ� '.$txt_user_id.' �բ����ž�ѡ�ҹ㹻չ������");</script>';
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=committee_add.php">';
							}

?>
</body>
</html>
