<?php header ("Content-Type: text/html; charset=tis-620"); 
		include ("../lib/ms_database.php");
	$prov = $_GET["prov"];
	$branch = $_GET["branch"];
	$br_type = $_GET["type"];
	//echo "ssdsd";
	if ($br_type == "prov") 
		{ 
			/*	$CAT_CC=substr($prov,0,2);
				$CAT_AA=substr($prov,2,2);
				$CAT_TT=substr($prov,-2);
			*/
				$sql=" SELECT * FROM Assetcode where assettype='$prov'  ";
				//echo $sql;
				$execute=mssql_query($sql);
				$rowss=mssql_num_rows($execute);  
				if($rowss<>"")
					{
					echo '<select name="lb_tumbon" style="padding: 1px;	height: 18px;	width: 120px;	border: 1px solid #7F9DB9;	margin: 1px; font-family: "mS Sans Serif";font-size: 8pt; font-style: normal; color:#000000;">';
							//echo '<option value="00">เลือกสาขา</option>';
							while($data=mssql_fetch_array($execute))
								{
											echo '<option value='.$data[1].'>'.$data[2].'</option>';
								}
						echo  '</select>';
						}
}

?>

