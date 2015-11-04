<?php 
include("../../lib/database.php");

connect();
query("BEGIN TRAN");

// รับข้อมูลปัจจัยการผลิต
$planted = number_format($_POST['planted'],0,'','');   // เนื้อที่เพาะปลูก
$harvested =  number_format($_POST['harvested'],0,'','');  // เนื้อที่เก็บเกี่ยว
$production = number_format($_POST['production'],0,'','');  // ผลผลิต
$yield =  number_format($_POST['yield'],0,'','');  // ผลผลิต ต่อ ไร่
$farm_price =  number_format($_POST['farm_price'],2,'.','');  // ราคาเกษตรกรขายได้
$farm_value =  number_format($_POST['farm_value'],0,'','');  //  มูลค่าของผลผลิตตามราคาเกษตรขายได้

// กรณีเพิ่ม / แก้ไข
if($click=='add' || $click=='edit')
{	
	// ลบข้อมูลก่อน
	$sql = " DELETE FROM AnnProduction  WHERE product_code='$code' AND product_year='$year' ";
	query($sql);
	// เพิ่มข้อมูลใหม่
	$sql = " INSERT INTO AnnProduction(product_code,product_year,planted,harvested,production,yield,farm_price,farm_value) ";
	$sql.=" VALUES('".$code."','".$year."',".$planted.",".$harvested.",".$production.",".$yield.",".$farm_price.",".$farm_value." ) ";
	$result_sql = query($sql);
}
elseif($click=='del')
{
	// ลบข้อมูล
	$sql = " DELETE FROM AnnProduction  WHERE product_code='$code' AND product_year='$year' ";
	$result_sql = query($sql);
} // end if 

if($result_sql)
{	query("COMMIT");
	print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
else
{	query("ROLLBACK");	
	print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

close();
print '<script>window.location.href = "production_list.php?code='.$code.'";</script>';
?>