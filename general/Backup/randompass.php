<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body>


	  <?
												$Ckgroup="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear DESC";
												$exCkgroup=mssql_query($Ckgroup);
												$data=mssql_fetch_array($exCkgroup);
												 if($data['PersonnelYear']==$Year)
														{
																$sqlyear=" SELECT DISTINCT (PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear DESC ";
																$exsqlyear=mssql_query($sqlyear);
																echo ' <select name="SendYear">';
																//echo '<option>เลือกปี</option>';
																//echo $sqlyear;
																	while($rowall=mssql_fetch_row($exsqlyear))
																		{
																			echo '<option value="'.$rowall[0].'" >'.$rowall[0].'</opton>' ;
																		}
														
																echo '</select>';
														}
					
												if($data['PersonnelYear']<$Year AND $data['PersonnelYear']<>"")
													{
															$Cklast="SELECT TOP 1(PersonnelYear) FROM PersonnelGroup WHERE AMCCode='$amc' ORDER BY PersonnelYear ";
															$exCklast=mssql_query($Cklast);
															$datalast=mssql_fetch_array($exCklast);
															//echo $Cklast;
															//echo $datalast['CommitteeGroup'];
																echo '<select name="SendYear">';
																for($i=$Year; $i>=$datalast['PersonnelYear']; $i--)
																		{
																				echo '<option value="'.$i.'">'.$i.'</option>';
																		
																		}
																echo '</select>';
													}
													
												if($data['PersonnelYear']=="")
													{
															echo '<select name="SendYear">';
															echo '<option value="'.$Year.'">'.$Year.'</option>';
															echo '</select>';
													}
									?>
                          <script language=JAVAScript> 
										for(i=0;i<=(document.form1.SendYear.length-1);i++) {
											if(document.form1.SendYear.options[i].value=="<? echo $SendYear ?>") {
												document.form1.SendYear.options[i].selected = true;
												break;
											}
										}
						</script>

</body>
</html>
