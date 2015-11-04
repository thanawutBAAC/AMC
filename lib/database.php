<?php
$conn;
$db_host = "THANAWUT\SQLEXPRESS";
$db_host1 = "172.18.145.40,1433";
$db_user = "sa";
$db_password = "Baac";
$db_database = "AMC";


function connect_iso(){
	global $conn;
	$conn = mssql_connect("WEBDB\APPLICATION","isousr","iso@123") or die(" ไม่สามารถติดต่อเครื่อง ISO ได้ ");
	mssql_select_db("iso",$conn) or die(" ไม่สามารถติดต่อฐานข้อมูล ISO ได้ ");
}

function connect()  {
			global $conn;
	//	$conn = mssql_connect('172.18.145.40','sa','Baac') or die(" ไม่สามารถติดต่อเครื่อง Server ได้ ");
		$conn = mssql_connect('THANAWUT\SQLEXPRESS','user01','123456') or die(" ไม่สามารถติดต่อเครื่อง Server ได้ ");
	//	$conn = mssql_connect("jewel,1433", "amcusr","baac@123") or die(" ไม่สามารถติดต่อเครื่อง Server ได้ ");
			mssql_select_db("AMC" ,$conn) or die(" ไม่สามารถติดต่อฐานข้อมูลได้ ");
	}

function close() {
		global $conn;
		return mssql_close($conn);
	}

function query($str_sql) {
		global $conn;
		$result_query =  mssql_query($str_sql,$conn) or error();
		return $result_query;
	}

function result($result,$num,$field_name){
		return mssql_result($result,$num,$field_name);
	}
	
function fetch_array($result,$type) {
		return mssql_fetch_array($result,$type);
	}

function free_result($result) {
	return mssql_free_result($result);
	}

function num_rows($result) {
		return mssql_num_rows($result);
	}
function data_seek($result){
		return mssql_data_seek($result, 0);
}

function fetch_row($result){
		return mssql_fetch_row($result);
}

function get_affected_rows() {
		return mssql_affected_rows();
	}

function error() {
		$errdesc = error_reporting(E_ERROR | E_WARNING | E_PARSE);
		$message = "Error Desc : ".$errdesc."\r\n";
		$message.= "Date : ".gmdate("l dS of F Y h:i:s A")."\r\n";
		$message.= "File: http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		echo "<p><textarea rows='10' cols='60'>".htmlspecialchars($message)."</textarea></p>";
		exit();
	}

?>