<?php
session_start();
include('db.php');
include('function.php');

$trimmedSearchValue = $_POST["searchData"];
//$trimmedSearchValue = '0768280467';
$leadingZero = 0;
//drop leading zeros
$trimmedSearchValue = strtolower(ltrim($trimmedSearchValue, $leadingZero));
//$trimmedSearchValue = strtolower(preg_replace('/^0/', '', $trimmedSearchValue));  //use ONLY if normal trimmed search ends up causing issues
$sql_search = "SELECT UPC, DESCRIPTION, IMAGE, TYPE_ID, QUANTITY
                FROM INVENTORY
                WHERE CAST(UPC AS CHAR) LIKE CONCAT('%',:SEARCHED,'%')
                OR LOWER(DESCRIPTION) LIKE CONCAT('%',:SEARCHED,'%')
                LIMIT 1";

$searchStmt = $connection->prepare($sql_search);
    if(false===$searchStmt){
        die('Prepare Failed on var \'searchStmt\' contact DBA with the following code: ' . htmlspecialchars($searchStmt));
    }
$searchStmtPrepper = $searchStmt->execute(
    array(
        'SEARCHED' => $trimmedSearchValue
    )
);
    if(false===$searchStmtPrepper){
        die('Prepare Failed on var  \'searchStmtPrepper\' contact DBA with the following code: ' . htmlspecialchars($searchStmtPrepper));
    }
$searchResult = $searchStmt->fetch();
    $cartItem = [
        'cartUPC' => $searchResult['UPC'], 
        'cartDescription' => $searchResult['DESCRIPTION'],
        'cartImage' => $searchResult['IMAGE'], 
        'cartType_ID' => $searchResult['TYPE_ID'], 
        'cartQuantity' => $searchResult['QUANTITY']

    ];

    echo json_encode($cartItem);








?>