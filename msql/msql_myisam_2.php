<?
$db = array();

$db['host'] = "localhost";
$db['user'] = "*****";
$db['password'] = "*****";
$db['database'] = "convert";

header('Content-type: text/plain');
 
$mysqli = @new mysqli($db['host'], $db['user'], $db['password'], $db['database']);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
  die(1);
}
$results = $mysqli->query("show tables;");
if ($results === FALSE or $mysqli->connect_errno) {
  echo "MySQL error: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
  die(2);
}
while ($row = $results->fetch_assoc()) {
  $sql = "SHOW TABLE STATUS WHERE Name = '{$row['Tables_in_' . $db['database']]}'";
  $thisTable = $mysqli->query($sql)->fetch_assoc();
  if ($thisTable['Engine'] === 'InnoDB') {
    $sql = "alter table " . $row['Tables_in_' . $db['database']] . " ENGINE = MyISAM;";
    echo "Changing {$row['Tables_in_' . $db['database']]} from {$thisTable['Engine']} to MyISAM.\n";
    $mysqli->query($sql);
  }
  else {
    echo $row['Tables_in_' . $db['database']] . ' is of the Engine Type ' . $thisTable['Engine'] . ".\n";
    echo "Not changing to MyISAM.\n\n";
  }
}
die(0);

?>
