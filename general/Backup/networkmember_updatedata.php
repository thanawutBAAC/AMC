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
				
							$up_customer= " UPDATE AMCCustomer SET ";
							$up_customer.= " MemberName='$txt_name', MemberLastname='$txt_lsname', MemberBirthday='$txt_brithday',  ";
							$up_customer.= " MemberWorking='$list_working', MemberPhone='$txt_phone', MemberEducation='$list_education',  ";
							$up_customer.= " MemberDegree='$list_degree', MemberOccu='$list_Occu', MemberOccuSecond='$list_Occusecond',  ";
							$up_customer.= " MemberAddress='$area_address', MemberStatus='$hid_status', MemberRemark='$area_remark' ";
							$up_customer.=" WHERE MemberID='$memberid' ";
							//echo $up_customer."++++++";
							mssql_query($up_customer);
				//echo $updatedetail;
				//echo '<br>';
				
				$updategroup="UPDATE NetworkMemberGroup SET MemberHelp='$rdo_help', MemberHelpBranch='$list_branch' ,MemberRemark='$area_remark',MemberUpdate='$today'";
				$updategroup.=" WHERE MemberID='$memberid' AND AMCCode='$amc' AND MemberYear='$memberyear'";
				mssql_query($updategroup);
				//echo $updategroup;
				echo '<script>alert("บันทึกข้อมูล '.$txt_name.' '. $txt_lsname .' แล้ว");window.location.href = "networkmember.php";</script>';

				//echo $updategroup;
							//echo $sql.'<br><br>';
							
							/*$sql=" UPDATE NetworkMember ";
							$sql.=" SET memberhelp='$networkhelp',memberhelpbranch='".$_GET['branch'.$i]."'";
							$sql.=" , memberremark='".$_GET['remark'.$i]."' ";
							$sql.=" WHERE AMCCode='$amc' AND user_id='".$_GET['user_id'.$i]."'"; */
						//	mssql_query($sql);
							//echo $networkhelp;
							//echo $sql;
							//echo '<br>';

					
		//					echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=networkmember.php?SendYear='.$SendYear.'">';
	?>
	
	</td>
  </tr>
</table>
</body>
</html>
