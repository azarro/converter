<?
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'cooler';
$dbname = 'convert';

header('Content-type: text/plain');

$dbconn = mysql_connect($dbhost, $dbuser, $dbpass) or die( mysql_error() );
$db = mysql_select_db($dbname) or die( mysql_error() );

$sql = "ALTER DATABASE `".$dbname."` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci";
$result = mysql_query($sql) or die( mysql_error() );
print "Database changed to Windows-1251.\n";

$sql = 'SHOW TABLES';
$result = mysql_query($sql) or die( mysql_error() );

while ( $row = mysql_fetch_row($result) )
{
$table = mysql_real_escape_string($row[0]);
$sql = "ALTER TABLE $table DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci, 
  CONVERT TO CHARACTER SET cp1251 COLLATE cp1251_general_ci";
mysql_query($sql) or die( mysql_error() );
print "$table changed to Windows-1251.\n";
}

mysql_close($dbconn);
?>