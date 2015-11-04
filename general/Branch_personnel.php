<?php 
session_start();
header ("Content-Type: text/html; charset=tis-620"); 
		include ("../lib/ms_database.php");
	$prov = $_GET["prov"];
	$branch = $_GET["branch"];
	$br_type = $_GET["type"];
	//echo "ssdsd";
	if ($br_type == "prov") 
		{ 
				//$sql=" SELECT * FROM Assetcode where assettype='$prov'  ";
				//echo $sql;
				
				$sql="SELECT PersonnelType, PersonnelName ";
				$sql.=" FROM PersonnelCode ";
				$sql.=" WHERE PersonnelType ";
				$sql.=" NOT IN (SELECT PersonnelType FROM PersonnelGroup WHERE AMCCode='$amc' AND PersonnelType Between '01' AND '05' AND PersonnelYear='$prov') ";
				$sql.=" ORDER BY PersonnelType ";
				//echo $sql;
				$execute=mssql_query($sql);
				$rowss=mssql_num_rows($execute);  

				if($lb_prov<>"00")
					{
					echo '<select name="lb_tumbon" style="padding: 1px;	height: 18px;	width: 120px;	border: 1px solid #7F9DB9;	margin: 1px; font-family: "mS Sans Serif";font-size: 8pt; font-style: normal; color:#000000;">';
							//echo '<option value="00">เลือกสาขา</option>';
							while($data=mssql_fetch_array($execute))
								{
											echo '<option value='.$data[0].'>'.$data[1].'</option>';
								}
						echo  '</select>';
						}
					else
					echo '<select name="lb_tumbon" style="padding: 1px;	height: 18px;	width: 120px;	border: 1px solid #7F9DB9;	margin: 1px; font-family: "mS Sans Serif";font-size: 8pt; font-style: normal; color:#000000;">';
							//echo '<option value="00">เลือกสาขา</option>';
							while($data=mssql_fetch_array($execute))
								{
											echo '<option >เลือกตำแหน่ง</option>';
								}
						echo  '</select>';
				
}

?>

