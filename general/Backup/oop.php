<? include ("checkuser.php");?>
	
	<?
		include ("images/lib/ms_database.php");
		$year=(date('Y')+543);

													
												/*	$insert_customer=" INSERT INTO AMCCustomer(AMCCode, MemberID, MemberName, MemberLastname, MemberBirthday, " ;
													$insert_customer.=" MemberWorking, MemberPhone, MemberEducation, MemberDegree, MemberOccu, MemberOccuSecond, ";
													$insert_customer.=" MemberAddress, MemberStatus, MemberRemark) VALUES('$amc', '$txt_user_id','$txt_name', '$txt_lsname', '$txt_birthday',  ";
													$insert_customer.=" '$list_working', '$txt_phone', '$list_education', '$list_degree', '$list_Occu', '$list_Occusecond', '$area_address',  ";
													$insert_customer.=" '$hid_status', '$area_remark') ";
													echo $insert_customer;
													mssql_query($insert_customer);
													*/
													$up_customer= " UPDATE AMCCustomer SET ";
													$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
													$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
													$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
													$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
													$up_customer.=" WHERE MemberID='$txt_user_id' ";
													echo $up_customer;
													mssql_query($up_customer);	
													
?>