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
				
				$sql=" SELECT CommitteeType,CommitteeName FROM CommitteeCode  ";
				$sql.=" WHERE CommitteeType NOT IN ( ";
				$sql.=" SELECT CommitteeType FROM CommitteeGroup ";
				//$sql.=" WHERE AMCCode='$amc' ";//AND CommitteeType Between '01' AND '04' AND CommitteeGroup='$Year' ";
				$sql.=" WHERE AMCCode='$amc' AND CommitteeType Between '01' AND '04' AND CommitteeGroup='$prov' ";
				$sql.=" ) ORDER BY CommitteeType  ";
				//echo $sql;
				$execute=mssql_query($sql);
				$rowss=mssql_num_rows($execute);  

				if($lb_prov<>"00")
					{
					echo '<select name="lb_tumbon" style="padding: 1px;	height: 18px;	width: 120px;	border: 1px solid #7F9DB9;	margin: 1px; font-family: "mS Sans Serif";font-size: 8pt; font-style: normal; color:#000000;" onfocus="chkposition(this.value);" onChange="chkposition(this.value);">';
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

