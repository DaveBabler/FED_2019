<?php
try {
  $username = 'dbabler';
  $password = 'Db0987591';
  $connection = new PDO( 'mysql:host=mysql.yaacotu.com;dbname=fed_db_daveb', $username, $password );
}
catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


try {
  $username = 'dbabler';
  $password = 'Db0987591';
  $credCon = new PDO( 'mysql:host=mysql.yaacotu.com;dbname=fed_db_creds_daveb', $username, $password );
}
catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



?>
