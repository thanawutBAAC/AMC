<?php 
include("../../lib/database.php");

connect();
query("BEGIN TRAN");

// �Ѻ�����ŻѨ��¡�ü�Ե
$planted = number_format($_POST['planted'],0,'','');   // ���ͷ����л�١
$harvested =  number_format($_POST['harvested'],0,'','');  // ���ͷ���������
$production = number_format($_POST['production'],0,'','');  // �ż�Ե
$yield =  number_format($_POST['yield'],0,'','');  // �ż�Ե ��� ���
$farm_price =  number_format($_POST['farm_price'],2,'.','');  // �Ҥ��ɵáâ����
$farm_value =  number_format($_POST['farm_value'],0,'','');  //  ��Ť�Ңͧ�ż�Ե����Ҥ��ɵâ����

// �ó����� / ���
if($click=='add' || $click=='edit')
{	
	// ź�����š�͹
	$sql = " DELETE FROM AnnProduction  WHERE product_code='$code' AND product_year='$year' ";
	query($sql);
	// ��������������
	$sql = " INSERT INTO AnnProduction(product_code,product_year,planted,harvested,production,yield,farm_price,farm_value) ";
	$sql.=" VALUES('".$code."','".$year."',".$planted.",".$harvested.",".$production.",".$yield.",".$farm_price.",".$farm_value." ) ";
	$result_sql = query($sql);
}
elseif($click=='del')
{
	// ź������
	$sql = " DELETE FROM AnnProduction  WHERE product_code='$code' AND product_year='$year' ";
	$result_sql = query($sql);
} // end if 

if($result_sql)
{	query("COMMIT");
	print '<script>alert(" ��Ѻ��ا�����Ŷ١��ͧ ");</script>';		}
else
{	query("ROLLBACK");	
	print '<script>alert(" �բ�ͼԴ��Ҵ㹡�û�Ѻ��ا������ ");</script>';		}

close();
print '<script>window.location.href = "production_list.php?code='.$code.'";</script>';
?>