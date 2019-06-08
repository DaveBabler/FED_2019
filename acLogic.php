<?php
session_start();

include('function.php');
$queryType = $_POST['queryType'][0];
unset($autoCompleteItem);


//begin search function
$trimmedSearchValue = $_POST['term']; //see ajax call 

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
        $cartItem[] = array(
            'label' => $row['DESCRIPTION'], //must use these generic terms to get the jquery UI to work ONLY label and value work
            'value' => $row['DESCRIPTION'],
            'cartUPC' => $row['UPC'], 
            'cartDescription' => $row['DESCRIPTION'],
            'cartImage' => $row['IMAGE'], 
            'cartType_ID' => $row['TYPE_ID'], 
            'cartQuantity' => $row['QUANTITY'],
            'autoCompleteFlag' => 1        
        );
}
 
 
     echo json_encode($cartItem);
  
?>
