<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	
	connect();
	$year = $_GET["year"];

	$sql = " SELECT member_year  FROM PlanMaster ";
	$sql.="  WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
	$result_member = query($sql);

	if(num_rows($result_member)==0)
	{	echo "0";		}
	else
	{	echo result($result_member,0,"member_year");	}			
	close();
?>