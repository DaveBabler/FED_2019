<?php
session_start();
include('db.php');
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/Scripts/DB/function.php');
$queryType = $_POST['queryType'][0];
unset($autoCompleteItem);


//begin search function
$trimmedSearchValue = /*JUSTIN ASSIGN YOUR GET VARIABLE HERE!!!!! AND ONLY HERE */

$leadingZero = 0;
//drop leading zeros
$trimmedSearchValue = strtolower(ltrim($trimmedSearchValue, $leadingZero));
//$trimmedSearchValue = strtolower(preg_replace('/^0/', '', $trimmedSearchValue));  //use ONLY if normal trimmed search ends up causing issues
$sqlSearch = "SELECT UPC, DESCRIPTION, IMAGE, TYPE_ID, QUANTITY
                FROM INVENTORY
                WHERE CAST(UPC AS CHAR) LIKE CONCAT('%',:SEARCHED,'%')
                OR LOWER(DESCRIPTION) LIKE CONCAT('%',:SEARCHED,'%') ";

$searchStmt = $connection->prepare($sqlSearch);
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
	while($row = $searchStmt->fetch()){
    $autoCompleteItem = [
        'autoCompletePopulateUPC' => $queryResult['UPC'], 
        'autoCompletePopulateDescription' => $queryResult['DESCRIPTION'],
        //'autoCompletePopulateImage' => $queryResult['IMAGE'], 
        //'autoCompletePopulateType_ID' => $queryResult['TYPE_ID']
        'autoCompletePopulateQuantity' => $queryResult['QUANTITY'],
        'autoCompleteFlag' => 1
    ];
}
    if($autoCompleteItem['autoCompletePopulateQuantity']==0){
    	$zeroQuantStatement = array();
    	$zeroQuantStatement['autoCompleteFlag'] = 0;
    	$zeroQuantStatement['autoCompletePopulateUPC'] = $autoCompleteItem['autoCompletePopulateUPC'];
    	$zeroQuantStatement['autoCompletePopulateDescription'] = $autoCompleteItem['autoCompletePopulateDescription']." Zero Quantity on Hand!";

    	echo json_encode($zeroQuantStatement);
    }else{
    echo json_encode($autoCompleteItem);
	}	
    //JUSTIN, THE SCRIPT MAY REQUIRE YOU TO USE RETURN OR A SOMETHING ELSE, PLEASE DOUBLE CHECK THE DOCUMENTATION
?>
