<?php
try {
  $username = 'dbabler';
  $password = 'Db0987591';
  $pdo = $connection = new PDO( 'mysql:host=mysql.yaacotu.com;dbname=fed_db_daveb', $username, $password );
}
catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>