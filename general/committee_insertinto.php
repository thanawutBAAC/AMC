<? include ("checkuser.php");?>
<html>
<head>
<title>�к��ҹ ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg">
<?
	include ("../lib/ms_database.php");
		$year=$lb_prov;
		$txt_birthday=$ddate.'/'.$dmonth.'/'.$dyear;
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
					/*		$year_1=$year-1;
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
*/								//	$txt_user_id="1409800003520";
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
														$insert_group.=" ('$amc', '$lb_prov', '$list_Committeeoccasion', '$list_CommitteeYear', '$txt_user_id','$lb_tumbon','$hdd_CommitteeCategory' ,'$CommSocial', '$rdo_CommitteeAMC')";
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
														if($numCkgroup=="0") //�óշ������բ����Ť�С������㹡�����չ�� ��ͧ 1 inser ���� �ͧ �Ѿവ �ҵ�����
																{
																										$insert_group=" INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID,CommitteeType,CommitteeCategory,CommitteeSocial,CommitteeAMC) VALUES ";
																										$insert_group.=" ('$amc', '$lb_prov', '$list_Committeeoccasion', '$list_CommitteeYear', '$txt_user_id','$lb_tumbon','$hdd_CommitteeCategory','$CommSocial', '$rdo_CommitteeAMC')";
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



														if($numCkgroup=="1") //�óշ���բ����Ť�С������㹡�����չ������
																{
																	echo '<script>alert("�ѹ�֡����������� ���ͧ�ҡ�բ�����㹻ջѨ�غѹ����");window.location.href = "committee_add.php";</script>';
																}
											
												} // �ͧ $numCkid=="1"
										

				/*				}// �� ����� �����з������ �ç�ѹ


							else  //��� ���� / �շ���������ç�ѹ
								{
									echo '<script>alert(" ���� '.$list_Committeeoccasion.' / �շ�� '.$list_CommitteeYear.' ���ç�Ѻ��������к�");window.location.href = "committee_add.php";</script>';
								}
			*/				}
			
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
