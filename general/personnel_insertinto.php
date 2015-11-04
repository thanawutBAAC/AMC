<?include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body background="images/bg.jpg">
		<?
			include ("../lib/ms_database.php");
			$Year=$lb_prov;
			$txt_birthday=$ddate.'/'.$dmonth.'/'.$dyear;
			$day=date('d-m');
			$today=$day.'-'.$Year;
			if($list_degree==""){$list_degree=="0";}
			//---------------------> Ck CommitteeGroup (Y)
			$CommitteeGroup="SELECT * FROM CommitteeGroup WHERE  CommitteeID='$txt_user_id' ";
			$CommitteeGroup.=" AND CommitteeGroup='$Year' ";
			$exCommitteeGroup=mssql_query($CommitteeGroup);
			$numCommitteeGroup=mssql_num_rows($exCommitteeGroup);
			//echo $CommitteeGroup;
				if($numCommitteeGroup=="0") //กรณีที่ไม่มีใน Table CommitteeGroup
							{
				///------------------------> Check Networkmember
				$CkNetworkMember="SELECT * FROM NetworkMemberGroup WHERE MemberID='$txt_user_id' ";
				$exCkNetworkMember=mssql_query($CkNetworkMember);
				$numCkNetworkMember=mssql_num_rows($exCkNetworkMember);
					if($numCkNetworkMember=="0")
							{				
								//----------------> Check PersonnelDetail
								$CkDetail="SELECT * FROM AMCCustomer WHERE MemberID='$txt_user_id'";
								$exCkDetail=mssql_query($CkDetail);
								$numCkDetail=mssql_num_rows($exCkDetail);
										if($numCkDetail=="0") //กรณีทีไม่มีข้อมูลอยู่ระบบเลย
												{
														// Add PersonnelDetail
													//	$sql=" INSERT INTO PersonnelDetail(AMCCode, PersonnelID, PersonnelName, PersonnelLsname, PersonnelBrithday, PersonnelWorking, PersonnelEducation,PersonnelDegree, PersonnelPhone,PersonnelAddress, PersonnelRemark) ";
													//	$sql.=" VALUES ( '$amc', '$txt_user_id', '$txt_name', '$txt_lsname', '$txt_birthday', '$list_working', '$list_education','$list_degree', '$txt_phone', '$area_address' , '$area_remark' )";
														
														$insert_customer=" INSERT INTO AMCCustomer(MemberID, MemberName, MemberLastname, MemberBirthday, " ;
														$insert_customer.=" MemberWorking, MemberPhone, MemberEducation, MemberDegree, MemberOccu, MemberOccuSecond, ";
														$insert_customer.=" MemberAddress, MemberStatus, MemberRemark) VALUES('$txt_user_id','$txt_name', '$txt_lsname', '$txt_birthday',  ";
														$insert_customer.=" '$list_working', '$txt_phone', '$list_education', '$list_degree', '$list_Occu', '$list_Occusecond', '$area_address',  ";
														$insert_customer.=" '$hid_status', '$area_remark') ";
														mssql_query($insert_customer);
														//echo $sql.'<br>';

														// Add PersonnelGroup			
														$sql2="INSERT INTO PersonnelGroup(AMCCode,PersonnelID,PersonnelType,PersonnelCategory,PersonnelYear,PersonnelUpdate)";
														$sql2.="VALUES('$amc', '$txt_user_id', '$lb_tumbon','00','$lb_prov','$today')";
														//echo $sql2.'<br>';
														mssql_query($sql2);
														echo '<script>alert("บันทึกข้อมูล '.$txt_name . $txt_lsname .' แล้ว");window.location.href = "personnel.php?SendYear='.$Year.'";</script>';
												}
										else // กรณีที่มีข้อมุลใน Detail อยุ่แล้ว
												{
													//----------------------> CheckGroup ว่ามีข้อมุลในชุดปัจจุบันรึยัง
													$CkGroup="SELECT * FROM PersonnelGroup WHERE PersonnelID='$txt_user_id' AND AMCCode='$amc' ";
													$CkGroup.=" AND PersonnelYear='$Year' ";
													$exCkGroup=mssql_query($CkGroup);
													$numCkGroup=mssql_num_rows($exCkGroup);
															if($numCkGroup=="0")//กรณีที่ยังไม่มีข้อมูลปีปัจจุบัน
																	{
																			// Update Detail
																			$up_customer= " UPDATE AMCCustomer SET ";
																			$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
																			$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
																			$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
																			$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
																			$up_customer.=" WHERE MemberID='$txt_user_id' ";
																			//echo $up_customer;
																			mssql_query($up_customer);	

																			//	echo $sql.'<br>';

																			// Add PersonnelGroup			
																			$sql2="INSERT INTO PersonnelGroup(AMCCode,PersonnelID,PersonnelType,PersonnelCategory,PersonnelYear,PersonnelUpdate)";
																			$sql2.="VALUES('$amc', '$txt_user_id', '$lb_tumbon','00','$lb_prov','$today')";
																			//	echo $sql2.'<br>';
																			mssql_query($sql2);
																			echo '<script>alert("บันทึกข้อมูล '.$txt_name . $txt_lsname .' แล้ว");window.location.href = "personnel.php?SendYear='.$Year.'";</script>';
																	}
															else
																	{
																			echo '<script>alert(" รหัสประชาชน '.$txt_user_id.' มีข้อมูลพนักงานในปีปัจจุบันอยู่แล้ว");</script>';
																			echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel_add.php">';
																	}
												}

							}
											else // numCkNetworkMember
							{
									echo '<script>alert(" ไม่สามารถบันทึกข้อมูลได้ \n เนื่องจากรหัสประชาชน '.$txt_user_id.' มีข้อมูลเครือข่ายสามาชิกแล้ว");</script>';
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel_add.php">';
							}
							}
				else //numCommitteeGroup
							{
									echo '<script>alert(" รหัสประชาชน '.$txt_user_id.' มีข้อมูลพนักงาน สกต. หรือ คณะกรรมการ สกต. อยู่แล้ว");</script>';
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel_add.php">';
							}
		?>
</body>
</html>