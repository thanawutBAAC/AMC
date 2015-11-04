<?

	$DBTP_server = '172.18.145.40,1433';
	$DBTP_username = "sa";
	$DBTP_password = "Baac";
	$DBTP_database = 'DBTP';
	
	$DBTP_connect=mssql_connect($DBTP_server, $DBTP_username, $DBTP_password) or  die(" ไม่สามารถติดต่อถ้าข้อมูลได้ ");	
	$DBTP_db=mssql_select_db($DBTP_database,$DBTP_connect);
?>