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
//	if($rdo_CommitteeAMC2=="0"){$rdo_CommitteeAMC=$rdo_CommitteeAMC2;}
	if($list_education=="1" OR $list_education=="2") {$list_degree="0";}
	if($list_CommitteeType<>"01"){$rdo_CommitteeAMC="2";}
	//echo 'list_degree='.$list_degree.'<br>';

	//	echo $CkPersonnel;
		///------------------------> Check Networkmember
		$CkNetworkMember="SELECT * FROM NetworkMemberGroup WHERE MemberID='$txt_user_id' ";
		$exCkNetworkMember=mssql_query($CkNetworkMember);
		$numCkNetworkMember=mssql_num_rows($exCkNetworkMember);
			if($numCkNetworkMember=="0")
					{
					
					//------------------> Check PersonnelGroup
		$CkPersonnel="SELECT * FROM PersonnelGroup WHERE PersonnelID='$txt_user_id' AND PersonnelYear='$year'";
		$exCkPersonnel=mssql_query($CkPersonnel);
		$numCkPersonnel=mssql_num_rows($exCkPersonnel);		
			if($numCkPersonnel=="0" ) // �óբ����ŷ����������� Table PersonneGroup �չ��
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

						$sql="SELECT TOP 1 * FROM CommitteeGroup  WHERE AMCCode='$amc' ORDER BY CommitteeGroup DESC";  // ���� �ӹǹ ������л� �Ѩ�غѹ
						$ex_sql=mssql_query($sql);
						$numrows=mssql_num_rows($ex_sql);
						$data=mssql_fetch_array($ex_sql);
					//	echo $numrows.'<br>';
					//	echo $sql;
					//	$SendYear='2';
					//	echo '�ջѨ�غѹ�ͧ����ͧ �Կ������ͻ� '.$year.'<br>';
					//	echo '����к����֧���ͻ� '.$data['1'].'<br>'; 
					//	settype($data['CommitteeGroup'],"integer");
					//	echo gettype($data['CommitteeGroup']).'<br>';
					//	echo gettype($year).'<br>';
				//	echo $year.'<br>';
			
						if($numrows=="0")
								{
										//echo "aaa<br>";
										if($list_Committeeoccasion=='1' AND $list_CommitteeYear =='1') { $AddYear="1"; $AddCommitteeoccasion="1"; $CommtteeYear="1";}
										if($list_Committeeoccasion=='1' AND $list_CommitteeYear=='2') { $AddYear="2"; $AddCommitteeoccasion="1"; $CommtteeYear="2";}
										if($list_Committeeoccasion=='2' AND $list_CommitteeYear =='1') { $AddYear="3"; $AddCommitteeoccasion="2"; $CommtteeYear="1";}
										if($list_Committeeoccasion=='2' AND $list_CommitteeYear =='2') { $AddYear="4"; $AddCommitteeoccasion="2"; $CommtteeYear="2";}
								}
						if($data['CommitteeGroup']==$year)
								{
										//echo "aaa<br>";
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='1') { $AddYear="1"; $AddCommitteeoccasion="1"; $CommtteeYear="1";}
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='2') { $AddYear="2"; $AddCommitteeoccasion="1"; $CommtteeYear="2";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='1') { $AddYear="3"; $AddCommitteeoccasion="2"; $CommtteeYear="1";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='2') { $AddYear="4"; $AddCommitteeoccasion="2"; $CommtteeYear="2";}
								}
						if($data['CommitteeGroup']<$year )
								{	
										//echo "bbb<br>";
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='1') { $AddYear="2"; $AddCommitteeoccasion="1"; $CommtteeYear="2";}
										if($data['Committeeoccasion'] =='1' AND $data['CommitteeYear'] =='2') { $AddYear="3"; $AddCommitteeoccasion="2"; $CommtteeYear="1";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='1') { $AddYear="4"; $AddCommitteeoccasion="2"; $CommtteeYear="2";}
										if($data['Committeeoccasion'] =='2' AND $data['CommitteeYear'] =='2') { $AddYear="1"; $AddCommitteeoccasion="1"; $CommtteeYear="1";}
								}

						//echo 'addyear '.$AddYear.'<br>';
						//echo 'sendyear '.$SendYear.'<br>';
							if($AddYear==$SendYear) // �óշ�� ������л� �ç�ѹ�Ѻ��� user �����������
								{
								//	$txt_user_id="1409800003520";
									//$amc="�011834";
										// �� ID
										$Ckid=" SELECT * FROM AMCCustomer WHERE MemberID='$txt_user_id' ";
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


														$insert_customer=" INSERT INTO AMCCustomer(MemberID, MemberName, MemberLastname, MemberBirthday, " ;
														$insert_customer.=" MemberWorking, MemberPhone, MemberEducation, MemberDegree, MemberOccu, MemberOccuSecond, ";
														$insert_customer.=" MemberAddress, MemberStatus, MemberRemark) VALUES('$txt_user_id','$txt_name', '$txt_lsname', '$txt_birthday',  ";
														$insert_customer.=" '$list_working', '$txt_phone', '$list_education', '$list_degree', '$list_Occu', '$list_Occusecond', '$area_address',  ";
														$insert_customer.=" '$hid_status', '$area_remark') ";

														$insert_group=" INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID,CommitteeType,CommitteeCategory,CommitteeSocial,CommitteeAMC) VALUES ";
														$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$CommtteeYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory' ,'$CommSocial', '$rdo_CommitteeAMC')";
														//echo $insert_detail.'<br>';
														//echo $insert_group.'<br>';
														mssql_query($insert_customer);
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
																										$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$CommtteeYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
																										//echo $insert_group;
																										mssql_query($insert_group);
																										
																										$up_customer= " UPDATE AMCCustomer SET ";
																										$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
																										$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
																										$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
																										$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
																										$up_customer.=" WHERE MemberID='$txt_user_id' ";
																										//echo $up_customer;
																										mssql_query($up_customer);	
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
																										$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$CommtteeYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
																										mssql_query($insert_group);

																										$up_customer= " UPDATE AMCCustomer SET ";
																										$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
																										$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
																										$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
																										$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
																										$up_customer.=" WHERE MemberID='$txt_user_id' ";
																										//echo $up_customer;
																										mssql_query($up_customer);	
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
																					$insert_group.=" ('$amc', '$year', '$AddCommitteeoccasion', '$CommtteeYear', '$txt_user_id','$list_CommitteeType','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
																					mssql_query($insert_group);

																					$up_customer= " UPDATE AMCCustomer SET ";
																					$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
																					$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
																					$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
																					$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
																					$up_customer.=" WHERE MemberID='$txt_user_id' ";
																					//echo $up_customer;
																					mssql_query($up_customer);	
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
							}
				else /// CkNetworkMemberGroup
							{
									echo '<script>alert(" �������ö�ѹ�֡�������� \n ���ͧ�ҡ���ʻ�ЪҪ� '.$txt_user_id.' �բ��������͢������Ҫԡ����");</script>';
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=committee_add.php">';
							}
?>
</body>
</html>
