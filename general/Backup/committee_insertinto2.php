<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>ระบบข้อมูล สกต.</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body background="images/bg.jpg">
		<?
			include ("images/lib/ms_database.php");
			$Year=(date('Y')+543);
			//---------------------> committee social
					if($rdo_CommitteeSocial=="1")
						{ $CommSocial=$txt_CommitteeSocial; }
					if($rdo_CommitteeSocial=="0")
						{ $CommSocial="ไม่มี"; }
			// <---------------------------
			

			////---------------------------> เชคตารางของ พนักงาน
				$sql2="SELECT * FROM Personnel WHERE user_id='$txt_user_id' ";
				$exsql=mssql_query($sql2);
				$num_id2=mssql_num_rows($exsql);
					if($num_id2=="0") //กรณี id ไม่ซ้ำกัน
						{

				//-------------------------------------> เชคตาราง Committee
								$sql="SELECT * ";
								$sql.=" FROM COMMITTEEDETAIL ";
								$sql.=" WHERE COMMITTEEID='$txt_user_id' AND AMCCODE='$amc' ";
								$exsql=mssql_query($sql);
								$num_id=mssql_num_rows($exsql);
								//echo $sql;
									if($num_id=="0") //กรณี id ไม่ซ้ำกัน
											{

												$sql_InsertComm="INSERT INTO CommitteeDetail(CommitteeID,AMCCode,CommitteeType,CommitteeCategory, ";
												$sql_InsertComm.=" CommitteeName,CommitteeLastname,CommitteeBirhtDay,CommitteeAddress,CommitteePhone, ";
												$sql_InsertComm.=" CommitteeAMC,CommitteeEdu,CommitteeSocial,CommitteeOccu,CommitteeOccuSecond,CommitteeRemark)";
												$sql_InsertComm.=" VALUES('$txt_user_id', '$amc', '$list_CommitteeType','$hdd_CommitteeCategory', '$txt_name','$txt_lsname', ";
												$sql_InsertComm.=" '$txt_birthday', '$area_address', '$txt_phone', '$rdo_CommitteeAMC', '$list_education', '$CommSocial', '$list_Occu', '$list_Occusecond','$area_remark')";
												mssql_query($sql_InsertComm);
												
												$sql_InsertCommitGroup="INSERT INTO CommitteeGroup(AMCCode, CommitteeGroup, Committeeoccasion, CommitteeYear, CommitteeID, CommitteeStatus) Values";
												$sql_InsertCommitGroup.=" ( '$amc', '$Year', '$list_Committeeoccasion', '$list_CommitteeYear','$txt_user_id','1')";
												mssql_query($sql_InsertCommitGroup);
												//echo $sql_InsertCommitGroup;
												echo '<script>alert(" ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว");window.location.href = "committee_show.php";</script>';
												//echo $sql_InsertComm;

												

											} // if $num_id="0"
										else // กรณีที่มีไอดีที่ซ้ำกันในตาราง CommitteeDetail
											{
												$sql="SELECT * FROM CommitteeGroup WHERE CommitteeID='$txt_user_id'";
												$sql.=" ORDER BY Committeeoccasion DESC, CommitteeYear DESC";


													//echo '<script>alert(" รหัสประชาชน '.$txt_user_id.' มีข้อมูลพนักงาน สกต. หรือ คณะกรรมการ สกต. อยู่แล้ว ");</script>';
													//echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=committee_add.php?alert=YES&user_id='.$txt_user_id.'">';
											}
									}// if บน
						else// พนักงาน
							{
									echo '<script>alert(" รหัสประชาชน '.$txt_user_id.' มีข้อมูลพนักงาน สกต. หรือ คณะกรรมการ สกต. อยู่แล้ว");</script>';
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=committee_add.php?alert=YES&user_id='.$txt_user_id.'">';
							}
		?>
</body>
</html>