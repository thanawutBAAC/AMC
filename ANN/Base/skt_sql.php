<?php 
include("../../lib/database.php");

connect();
query("BEGIN TRAN");

// รับข้อมูลพื้นฐานปัจจัยของ สกต ทั้งหมด 
$temp_month = array("4","5","6","7","8","9","10","11","12","1","2","3");
// กรณีเพิ่ม / แก้ไข
if($click=='add' || $click=='edit')
{	
	// ลบข้อมูลก่อน
	$sql = " DELETE FROM AnnSkt  WHERE skt_year='$year' ";
	query($sql);
	$j = 1;
	// เพิ่มข้อมูลใหม่
	for($i=0;$i<12;$i++)
	{
		$temp_branch =	 number_format($_POST['1x'.$temp_month[$i]],0,'','');  
		$temp_member =	number_format($_POST['2x'.$temp_month[$i]],0,'','');  
		$temp_baac = number_format($_POST['3x'.$temp_month[$i]],0,'','');  
		$temp_shop = number_format($_POST['4x'.$temp_month[$i]],0,'','');  
		$temp_share = number_format($_POST['5x'.$temp_month[$i]],0,'','');  

		$sql = " INSERT INTO AnnSkt(skt_year,skt_month,skt_month_list,skt_branch,skt_member,skt_baac,skt_shop,skt_share) ";
		$sql.=" VALUES('".$year."','".$temp_month[$i]."',$j,$temp_branch,$temp_member,$temp_baac,$temp_shop,$temp_share ) ";
		$result_sql = query($sql);
		$j++;
	}  // end for 
}
elseif($click=='del')
{
	// ลบข้อมูล
	$sql = " DELETE FROM AnnSkt  WHERE year='$year' ";
	$result_sql = query($sql);
} // end if 

if($result_sql)
{	query("COMMIT");
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
else
{	query("ROLLBACK");	
	print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

close();
print '<script>window.location.href = "skt_list.php";</script>';
?>