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
    <td align="center" valign="top">
	<?
				include ("images/lib/ms_database.php");
				$Year=(date('Y')+543);
				$day=date('d-m');
				$today=$day.'-'.$Year;
					// Ck Committee
					$ComID="SELECT * FROM CommitteeGroup WHERE CommitteeID='$txt_user_id' AND CommitteeGroup='$Year' ";
					//echo $ComID;
					$exComID=mssql_query($ComID);
					$numComID=mssql_num_rows($exComID);
						if($numComID=="0")
							{
								///////////// Ck Personnel
								$PersonID="SELECT * FROM PersonnelGroup WHERE PersonnelID='$txt_user_id'  AND PersonnelYear='$Year'";
								$exPersonID=mssql_query($PersonID);
								$numPersonID=mssql_num_rows($exPersonID);
									if($numPersonID=="0")
										{
												///////////Ck NetworkMemberDetail
											$CkDetail="SELECT * FROM AMCCustomer WHERE  MemberID='$txt_user_id' ";
											$exCkDetail=mssql_query($CkDetail);
											$numCkDetail=mssql_num_rows($exCkDetail);
												if($numCkDetail=="0") //ไม่มี add ได้เลย
													{
														//insert detail


														$insert_customer=" INSERT INTO AMCCustomer(MemberID, MemberName, MemberLastname, MemberBirthday, " ;
														$insert_customer.=" MemberWorking, MemberPhone, MemberEducation, MemberDegree, MemberOccu, MemberOccuSecond, ";
														$insert_customer.=" MemberAddress, MemberStatus, MemberRemark) VALUES('$txt_user_id','$txt_name', '$txt_lsname', '$txt_birthday',  ";
														$insert_customer.=" '$list_working', '$txt_phone', '$list_education', '$list_degree', '$list_Occu', '$list_Occusecond', '$area_address',  ";
														$insert_customer.=" '$hid_status', '$area_remark') ";
														mssql_query($insert_customer);
														//echo $INSERTDetail;
														//echo "Insertdetail  /// Insertgroup";
														//insert Group
														$INSERTGroup="INSERT INTO NetworkMemberGroup VALUES ('$amc','$txt_user_id','$Year','$rdo_help','$list_branch','$area_remark','$today')";
														//echo $INSERTGroup;
														mssql_query($INSERTGroup);
														
														echo '<script>alert("บันทึกข้อมูล '.$txt_name.' '. $txt_lsname .' แล้ว");window.location.href = "networkmember.php";</script>';
													}
												else // มีอยู่แล้ว
													{
														///////////Ck NetworkMemberGroup
														$CkGroup="SELECT * FROM NetworkMemberGroup WHERE MemberID='$txt_user_id' AND AMCCode='$amc' AND MemberYear='$Year'";
														$exCkGroup=mssql_query($CkGroup);
														$numCkGroup=mssql_num_rows($exCkGroup);
															if($numCkGroup=="0")
																{
																	$up_customer= " UPDATE AMCCustomer SET ";
																	$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
																	$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
																	$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
																	$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
																	$up_customer.=" WHERE MemberID='$txt_user_id' ";
																	//echo $up_customer;
																	mssql_query($up_customer);	
																	//echo "Updatedetail //// Insertgroup";
																	//insert Group
																	$INSERTGroup="INSERT INTO NetworkMemberGroup VALUES ('$amc','$txt_user_id','$Year','$rdo_help','$list_branch','$area_remark','$today')";
																	mssql_query($INSERTGroup);		
																	echo '<script>alert("บันทึกข้อมูล '.$txt_name.' '. $txt_lsname .' แล้ว");window.location.href = "networkmember.php";</script>';
																}
															else
																{
																	//$UPDATEDetail="UPDATE NetworkMemberDetail SET MemberName='$txt_name', MemberLsname='$txt_lsname', MemberBrithday='$txt_brithday', ";
																	//$UPDATEDetail.="MemberPhone='$txt_phone', MemberEdu='$list_education', MemberAddress='$area_address'";
																	//mssql_query($UPDATEDetail);
																	//echo  " มีข้อมูลอยู่ในปีปัจจุบันแล้ว (ทำการอัพเดต) ";
																	echo '<script>alert("มีข้อมูล '.$txt_user_id.' อยุ่แล้ว");window.location.href = "networkmember.php";</script>';
																}
													}
										}
									else
										{
											echo '<script>alert("มีข้อมูลพนักงานในปีนี้แล้ว ไม่สามารถบันทึกข้อมูลได้");window.location.href = "networkmember_add.php";</script>';
										}
							}
						else
							{
								echo '<script>alert("มีข้อมูลอยู่ในคณะกรรมการปีนี้แล้ว ไม่สามารถบันทึกข้อมูลได้");window.location.href = "networkmember_add.php";</script>';
							}
	?>
	</td>
  </tr>
</table>
</body>
</html>
