<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	$year = $_GET["year"];
	$year3=$year-3;
	$year2=$year-2;
	$year1=$year-1;
	$sql=" SELECT ";
	$sql.=" ans1 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year3."' AND amccode='".$code_online."' ), ";
	$sql.=" ans2 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year2."' AND amccode='".$code_online."' ), ";
	$sql.=" ans3 = ( SELECT MemSumYear FROM PlanMember WHERE PlanMember_year='".$year1."' AND amccode='".$code_online."' ), ";
	$sql.=" ans4 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year3."' AND amccode='".$code_online."' ), ";
	$sql.=" ans5 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year2."' AND amccode='".$code_online."' ), ";
	$sql.=" ans6 = ( SELECT ShareSumYear FROM PlanMember WHERE PlanMember_year='".$year1."' AND amccode='".$code_online."' ) ";
	$sql.=" FROM PlanMember ";
	//echo $sql;
	$result_member= query($sql);
	if($result_member)
	{	
		if(num_rows($result_member)==0)
		{
			$ans1=0;
			$ans2=0;
			$ans3=0;
			$ans4=0;
			$ans5=0;
			$ans6=0;
		}
		else
		{
			$ans1= number_format(result($result_member,'0','ans1'),0,'','');
			$ans2= number_format(result($result_member,'0','ans2'),0,'','');
			$ans3= number_format(result($result_member,'0','ans3'),0,'','');
			$ans4= number_format(result($result_member,'0','ans4'),0,'','');
			$ans5= number_format(result($result_member,'0','ans5'),0,'','');
			$ans6= number_format(result($result_member,'0','ans6'),0,'','');
		}
		echo $ans1.'#'.$ans2.'#'.$ans3.'#'.$ans4.'#'.$ans5.'#'.$ans6;
	}
	else
	{
		echo "N";	
	}
	free_result($result_member);
	close();
?>