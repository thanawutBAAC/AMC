<?
  //TEST
	/*$ms_server = '172.18.145.40,1433';
	$ms_username = "sa";
	$ms_password = "Baac";
	$ms_database = 'amc';
	$dbtp_database='DBTP';
	/**/
/*	$ms_server ='172.19.1.27,1433';
	$ms_username = "amcusr";
	$ms_password = "baac@123";
	$ms_database = 'amc';	
*/	
	//JEWEL

	$ms_server ='172.18.145.40,1433';
	$ms_username = "sa";
	$ms_password = "Baac";
	$ms_database = 'amc';
	
	$ms_connect=mssql_connect($ms_server, $ms_username, $ms_password) or  die(" ไม่สามารถติดต่อถ้าข้อมูลได้ ");	
	$ms_db=mssql_select_db($ms_database,$ms_connect);

//	$ms_connect=mssql_connect($ms_server, $ms_username, $ms_password) or  die(" ไม่สามารถติดต่อถ้าข้อมูลได้ ");	
//	$ms_db=mssql_select_db($ms_database,$ms_connect);

	/*		$conn = mssql_connect("jewel,1433", "amcusr","baac@123") or die(" ไม่สามารถติดต่อเครื่อง Server ได้ ");
			mssql_select_db("AMC" ,$conn) or die(" ไม่สามารถติดต่อฐานข้อมูลได้ ");

////

*/

?>