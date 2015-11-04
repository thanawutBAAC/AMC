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
			$Year=(date(Y)+543);
			$txt_birthday=$ddate.'/'.$dmonth.'/'.$dyear;
			//echo $Year;
				if($personnelyear==$Year)
					{
							$CkType=" SELECT *  ";
							$CkType.=" FROM PersonnelGroup A ";
							$CkType.=" LEFT JOIN( ";
							$CkType.=" SELECT * FROM PersonnelCode WHERE PersonnelType Between '01' AND '05' ";
							$CkType.=" )AS B ON A.PersonnelType=B.PersonnelType ";
							$CkType.="  WHERE A.PersonnelYear='$personnelyear'AND A.PersonnelType='$list_positions' AND PersonnelID='$PersonnelID'";
							//echo $CkType;
							$exCkType=mssql_query($CkType);
							$numrow=mssql_num_rows($exCkType);
							$data=mssql_fetch_row($exCkType);
							$dataid=$data[1];
							$datatype=$data[2];
							/*echo $dataid.'<br>';
							echo $datatype.'<br>';
							echo $PersonnelID.'<br>';
							echo $list_positions.'<br>';
						*/	
									if($PersonnelID==$dataid AND $list_positions==$datatype)
											{
												//$UpdateDetail=" UPDATE PersonnelDetail SET PersonnelName='$txt_name' , PersonnelLsname='$txt_lsname', PersonnelBrithday='$txt_birthday', ";
												//$UpdateDetail.=" PersonnelWorking='$list_working' , PersonnelEducation='$list_education',PersonnelDegree='$list_degree', PersonnelPhone='$txt_phone' ,PersonnelAddress='$area_address', PersonnelRemark='$area_remark' ";
												//$UpdateDetail.=" WHERE PersonnelID='$PersonnelID' AND AMCCode='$amc'";
												//mssql_query($UpdateDetail);

												$up_customer= " UPDATE AMCCustomer SET ";
												$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
												$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
												$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
												$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
												$up_customer.=" WHERE MemberID='$PersonnelID' ";
												//echo $up_customer;
												mssql_query($up_customer);
											//	echo $UpdateDetail;
												echo '<script>alert("บันทึกข้อมูล '.$txt_name .' '. $txt_lsname .' เรียบร้อยแล้ว");window.location.href = "personnel.php?SendYear='.$personnelyear.'";</script>';

												}
									if($PersonnelID<>$dataid AND $list_positions==$datatype)
												{
													echo '<script>alert("ไม่สามารถบันทึกข้อมูลได้ เนื่องจากมีพนักงานท่านอื่นดำรงตำแหน่งนี้อยู่");window.location.href = "personnel.php?SendYear='.$personnelyear.'";</script>';
												}
									if($numrow=="0")
												{
														$up_customer= " UPDATE AMCCustomer SET ";
														$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
														$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
														$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
														$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
														$up_customer.=" WHERE MemberID='$PersonnelID' ";
													//	echo $up_customer;
														mssql_query($up_customer);
														
														$UpdateGroup="UPDATE PersonnelGroup SET  PersonnelType='$list_positions' WHERE AMCCode='$amc' AND Personnelyear='$personnelyear'";
														$UpdateGroup.=" AND PersonnelID='$PersonnelID'";
														mssql_query($UpdateGroup);
														//cho $UpdateGroup;
											echo '<script>alert("บันทึกข้อมูล '.$txt_name .' '. $txt_lsname .' เรียบร้อยแล้ว");window.location.href = "personnel.php?SendYear='.$personnelyear.'";</script>';
													
											}
					}	
				if($personnelyear<$Year)
					{
					
							$up_customer= " UPDATE AMCCustomer SET ";
							$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
							$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
							$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
							$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
							$up_customer.=" WHERE MemberID='$PersonnelID' ";
							//echo $up_customer."++++++";
							mssql_query($up_customer);
							echo '<script>alert("บันทึกข้อมูล '.$txt_name .' '. $txt_lsname .' เรียบร้อยแล้ว");window.location.href = "personnel.php?SendYear='.$personnelyear.'";</script>';
					
					}		
		?>
</body>
</html>