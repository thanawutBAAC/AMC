<?php 
include("../../lib/database.php");

connect();
query("BEGIN TRAN");

// �Ѻ���������������мš�ô��Թ�ҹ �ͧ�ż�Ե��ѡ������
$temp_month = array("4","5","6","7","8","9","10","11","12","1","2","3");
// �ó����� / ���
if($click=='add' || $click=='edit')
{	
	// ź�����š�͹
	$sql = " DELETE FROM AnnWorks  WHERE works_year='$year' ";
	query($sql);
	$j = 1;
	// ��������������
	for($i=0;$i<12;$i++)
	{
		$temp_rp = number_format($_POST['1x'.$temp_month[$i]],2,'.','');  
		$temp_rv = number_format($_POST['2x'.$temp_month[$i]],2,'.','');  
		$temp_mp = number_format($_POST['3x'.$temp_month[$i]],2,'.','');  
		$temp_mv = number_format($_POST['4x'.$temp_month[$i]],2,'.','');  
		$temp_cp = number_format($_POST['5x'.$temp_month[$i]],2,'.','');  
		$temp_cv =	 number_format($_POST['6x'.$temp_month[$i]],2,'.','');  
		$temp_sp =	number_format($_POST['7x'.$temp_month[$i]],2,'.','');  
		$temp_sv = number_format($_POST['8x'.$temp_month[$i]],2,'.','');  
		$temp_pp = number_format($_POST['9x'.$temp_month[$i]],2,'.','');  
		$temp_pv = number_format($_POST['10x'.$temp_month[$i]],2,'.','');  

		$sql = " INSERT INTO AnnWorks(works_year,works_month,works_month_list,rice_plan,rice_value,maize_plan,maize_value, ";
		$sql.=" cassava_plan,cassava_value, sugarcane_plan,sugarcane_value, para_plan, para_value) ";
		$sql.=" VALUES('".$year."','".$temp_month[$i]."',$j,$temp_rp,$temp_rv,$temp_mp,$temp_mv,$temp_cp,$temp_cv, ";
		$sql.=" $temp_sp, $temp_sv, $temp_pp, $temp_pv) ";
		$result_sql = query($sql);
		$j++;
	}  // end for 
}
elseif($click=='del')
{
	// ź������
	$sql = " DELETE FROM AnnWorks  WHERE year='$year' ";
	$result_sql = query($sql);
} // end if 

if($result_sql)
{	query("COMMIT");
	print '<script>alert(" ��Ѻ��ا�����Ŷ١��ͧ ");</script>';		}
else
{	query("ROLLBACK");	
	print '<script>alert(" �բ�ͼԴ��Ҵ㹡�û�Ѻ��ا������ ");</script>';		}

close();
print '<script>window.location.href = "works_list.php";</script>';
?>