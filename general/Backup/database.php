<?

$DBhost= '172.18.145.40,1433';
$DBuser="sa";
$DBpassword="Baac";
$DBname="amc";
/*
$DBhost="silo";
$DBuser="jamnian";
$DBpassword="n0lj3m";
$DBname="jamnian";
*/
$MAX_PER_PG=30;
$MINY="2550";
$MAX_PERIOD=24.0;

$connect=mysql_connect($DBhost,$DBuser,$DBpassword) or die('Could not connect: ' . mysql_error());

@mysql_query("SET character_set_results=utf8");
@mysql_query("SET character_set_client=utf8");
@mysql_query("SET character_set_connection=utf8");
@mysql_query("collation_connection=utf8_unicode_ci");
@mysql_query("collation_database=utf8_unicode_ci");
@mysql_query("collation_server=utf8_unicode_ci");

@mysql_query("USE ".$DBname) or die('Query failed: ' . mysql_error());
?>