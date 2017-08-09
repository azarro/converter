<?

$host = 'localhost';
$log = 'root';
$pass = 'cooler';
$db = 'convert';

header('Content-type: text/plain');

mysql_connect($host,$log,$pass);
mysql_select_db($db);

$q = mysql_query("SHOW TABLES");
while ($table = mysql_fetch_array($q))
{
        mysql_query("ALTER TABLE `".$table['Tables_in_'.$db]."` ENGINE = InnoDB");
}

?>