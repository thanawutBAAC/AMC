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
				$day=date('d-m');
				$today=$day.'-'.$Year;
				
				$sql="SELECT * FROM PersonnelDetail WHERE PersonnelID='$user_id' AND AMCCode='$amc' ";
				$exsql=mssql_query($sql);
				$num_id=mssql_num_rows($exsql);
					if($num_id=="0") //กรณี id ไม่ซ้ำกัน
							{
						//------------------------------>เชคกับตาราง Committee ข้อมูลคณะกรรมการ<----------------------------	
							$sql2="SELECT * ";
							$sql2.=" FROM CommitteeGroup ";
							$sql2.=" WHERE CommitteeID='$txt_user_id' AND AMCCode='$amc' AND CommitteeGroup='$Year' ";
							$exsql2=mssql_query($sql2);
							$num_id2=mssql_num_rows($exsql2);
							//echo $sql;
								if($num_id2=="0") //กรณี id ไม่ซ้ำกัน
										{	

											//------------เช็ค ปี PersonnelGroup
											$Ckgroup=" SELECT * FROM PersonnelGroup WHERE PersonnelID='$txt_user' AND AMCCode='$amc' AND";
											$CKgroup.=" PersonnelYear='$Year' ";
											$exCkgroup=mssql_query($Ckgroup);
											$numCkgroup=mssql_num_rows($exCkgroup);
														if($numCkgroup=="0") // กรณีที่ ยังไม่มีข้อมุลในปีนี้ แต่มีชื่อใน ลิสแล้ว
																{
																	
																		add group;
																		update detail;
	
										


																											
																								$sql=" INSERT INTO Personnel(AMCCode, User_ID, Positions, Name, Lsname, Birthday, Working, Education, Phone,Address, Remark) ";
																								$sql.=" VALUES ( '$amc', '".$_GET['user_id'.$i]."', '".$_GET['positions'.$i]."','".$_GET['name'.$i]."',";
																								$sql.=" '".$_GET['lsname'.$i]." ','".$_GET['birthday'.$i]."','".$_GET['working'.$i]."','".$_GET['education'.$i]."','".$_GET['phone'.$i]."'," ;
																								$sql.=" '".$_GET['address'.$i]."', '".$_GET['remark'.$i]."' )";
																								mssql_query($sql);
																								//echo $sql.'<br><br>';
																						//------------------------------------->INSET / UPDATE PersonelYEAR<-----------------------------------------------------------------------
																								$personnelyear="SELECT * FROM PersonnelYear WHERE AMCCode='$amc' AND CAT_CC='$province'";
																								$ex_personnelyear=mssql_query($personnelyear);
																								$nub_personnelyear=mssql_num_rows($ex_personnelyear);
																						//echo $personnelyear;
																								if($nub_personnelyear=="1")
																									{
																										$update_personnelyear="UPDATE PersonnelYear Set PersonnelYear='$Year'";
																										$update_personnelyear.=" WHERE AMCCode='$amc' AND CAT_CC='$province'";
																										mssql_query($update_personnelyear);
																										//echo $update_personnelyear;
																									}
																								if($nub_personnelyear=="0")
																									{
																										$insert_personnelyear="INSERT INTO PersonnelYear(AMCCode,CAT_CC,PersonnelYear) ";
																										$insert_personnelyear.="Values ('$amc','$province','$Year')";
																										mssql_query($insert_personnelyear);
																										//echo $insert_personnelyear;
																									}
																								
																							//mssql_query($sql2);
																							//echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel.php">';
																								
																							//	--------------------------------->INSET TABLE Networkmember<-------------------------------------------
																								$sql3="INSERT INTO NetworkMember (AMCCode,CAT_CC,User_ID,Memberhelp,MemberHelpBranch,MemberStatus,MemberRemark)";
																								$sql3.=" Values ('$amc', '$province','".$_GET['user_id'.$i]."','0','','1','')";
																								//echo $sql3;
																								mssql_query($sql3);
																								echo '<script>alert(" ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว");window.location.href = "personnel.php";</script>';
											}

									else
											{
													echo '<script>alert(" รหัสประชาชน '.$txt_user_id.' มีข้อมูลพนักงาน สกต. หรือ คณะกรรมการ สกต. อยู่แล้ว ");</script>';
													echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel_add.php?alert=YES&user_id='.$user_id.'">';
											}
									}
				
					else
							{
									echo '<script>alert(" รหัสประชาชน '.$txt_user_id.' มีข้อมูลพนักงาน สกต. หรือ คณะกรรมการ สกต. อยู่แล้ว ");</script>';
									echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=personnel_add.php?alert=YES&user_id='.$user_id.'">';
							}
		?>
</body>
</html>