<?php

require('/home/dbabler/dbabler.yaacotu.com/FED_2020/config.php');

$sqlSelect = "DESCRIBE INVENTORY";
$stmt = $connection->prepare($sqlSelect);
$stmt->execute();

$result = $stmt->fetchAll();
foreach($result as $row){
    echo json_encode($row);
}
?>