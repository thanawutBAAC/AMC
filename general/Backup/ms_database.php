<?
 // TEST
	$ms_server = '172.18.145.40,1433';
	$ms_username = "sa";
	$ms_password = "Baac";
	$ms_database = 'amc';

//JEWEL
	/*$ms_server ='172.19.1.27,1433';
	$ms_username = "comu";
	$ms_password = "baac@123";
	$ms_database = 'community';*/

	$ms_connect=mssql_connect($ms_server, $ms_username, $ms_password) or  die(" ไม่สามารถติดต่อถ้าข้อมูลได้ ");	
	$ms_db=mssql_select_db($ms_database,$ms_connect);

?>