<? include ("checkuser.php");?>
<html>
<head>
<title>ระบบงาน สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body background="images/bg.jpg">
<?
	include ("images/lib/ms_database.php");
	//echo $committeegroup;
	//echo $list_committeetype;
	
	if($list_education=="1" OR $list_education=="2") {$list_degree="0";}
	if($list_committeetype<>"01"){$rdo_CommitteeAMC="2";}
	
	//	if($rdo_CommitteeAMC2=="0"){$rdo_CommitteeAMC=$rdo_CommitteeAMC2;}

		if($rdo_CommitteeSocial=="1")
				{ 
					if($txt_CommitteeSocial=="")
						{ $CommSocial="ไม่ได้ระบุ";}
					else
						{ $CommSocial=$txt_CommitteeSocial; }
				
				 }
		if($rdo_CommitteeSocial=="0")
				{ $CommSocial="ไม่มี"; }
				
				
			if($committeegroup==$Year)
				{
						$CkType="SELECT *";
						$CkType.="FROM CommitteeGroup A";
						$CkType.=" LEFT JOIN( ";
						$CkType.=" SELECT * FROM CommitteeCode WHERE CommitteeType Between '01' AND '04' ";
						$CkType.=" )AS B ON A.CommitteeType = B.CommitteeType ";
						$CkType.=" WHERE CommitteeGroup ='$committeegroup' AND A.CommitteeType='$list_committeetype' AND AMCCode='$amc'";
						$exCkType=mssql_query($CkType);
						$data=mssql_fetch_row($exCkType);
						$datatype=$data[5];
						$dataid=$data[4];
						$nubrow=mssql_num_rows($exCkType);
					//	echo $year;
					/*echo $CkType.'<br>';
						echo $datatype;
						echo '<br>'.$dataid;
						echo "<br><br>";
						echo $committeeid.'<br>';
						echo $list_committeetype.'<br>';
					*/	if($committeeid==$dataid AND $list_committeetype==$datatype)
								{
										$up_customer= " UPDATE AMCCustomer SET ";
										$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
										$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
										$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
										$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
										$up_customer.=" WHERE MemberID='$committeeid' ";
										//echo $up_customer;
										mssql_query($up_customer);	
										
										$updateGroup="UPDATE CommitteeGroup SET CommitteeAMC='$rdo_CommitteeAMC',CommitteeSocial='$CommSocial'";
										$updateGroup.=" WHERE CommitteeID='$committeeid' AND AMCCode='$amc' AND CommitteeGroup='$committeegroup'";
										mssql_query($updateGroup);
										//echo $updateGroup.'<br>';
										//echo $update;
									
										echo '<script>alert("บันทึกข้อมูล '.$txt_name .' '. $txt_lsname .' เรียบร้อยแล้ว");window.location.href = "committee.php?SendYear='.$committeegroup.'";</script>'; 

									
								}
							if($committeeid<>$dataid AND $list_committeetype==$datatype)
								{
										echo '<script>alert("ไม่สามารถบันทึกข้อมูลได้ เนื่องจากมีคณะกรรมการท่านอื่นดำรงตำแหน่งนี้อยู่");window.location.href = "committee.php?SendYear='.$committeegroup.'";</script>';
								}
							if($nubrow=="0")
								{
										$up_customer= " UPDATE AMCCustomer SET ";
										$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
										$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
										$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
										$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
										$up_customer.=" WHERE MemberID='$committeeid' ";
										//echo $up_customer;
										mssql_query($up_customer);	
										
										$updategroup="UPDATE CommitteeGroup SET CommitteeType='$list_committeetype',CommitteeAMC='$rdo_CommitteeAMC',CommitteeSocial='$CommSocial' ";
										$updategroup.=" WHERE CommitteeID='$committeeid' AND Committeegroup='$committeegroup' AND AMCCode='$amc' AND AMCCode='$amc' AND CommitteeGroup='$committeegroup' ";
										mssql_query($up_customer);
										mssql_query($updategroup);
										//echo $updategroup;
									
										echo '<script>alert("บันทึกข้อมูล '.$txt_name .' '. $txt_lsname .' เรียบร้อยแล้ว");window.location.href = "committee.php?SendYear='.$committeegroup.'";</script>';
							
								}

							}
							
			if($committeegroup<$Year)
							{
										$up_customer= " UPDATE AMCCustomer SET ";
										$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_birthday',  ";
										$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
										$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
										$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
										$up_customer.=" WHERE MemberID='$committeeid' ";
										//echo $up_customer;
										mssql_query($up_customer);	
										
										$updateGroup="UPDATE CommitteeGroup SET CommitteeAMC='$rdo_CommitteeAMC',CommitteeSocial='$CommSocial'";
										$updateGroup.=" WHERE CommitteeID='$committeeid' AND AMCCode='$amc' AND CommitteeGroup='$committeegroup'";
										mssql_query($updateGroup);
										//echo $updateGroup;
										//	echo "กรณีที่ ปีไม่ใช่ปีปัจจุับัน";
									
										echo '<script>alert("บันทึกข้อมูล '.$txt_name .' '. $txt_lsname .' เรียบร้อยแล้ว");window.location.href = "committee.php?SendYear='.$committeegroup.'";</script>';
						
							}
								
								
						//echo $CkType;
						
						
						
							//	if($CommitteeType==)
						//$sql="UPDATE Committeegroup SET ";

?>
</body>
</html>
