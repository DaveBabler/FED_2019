<?php
include_once("../db.php");
$grantAccess = false;
//sanitize the email first
//$email =  filter_var($_POST['emailUser'], FILTER_SANITIZE_EMAIL);  


$salt = 'FED';

if($_POST['TRIES']<=4){
    /*If less than 5 access attempts (counting zero) use the data entered in to the form*/


    $lv_user = $_POST['emailUser'];  //lv_ is Dave Babler's way of designating local variables.
    $lv_pass = $_POST['passwordUser'];
}else {
    //Use the override user to get into the database.
    $lv_user = '';
    $lv_pass = '0v3rid3';
}

$userPassStmt = $credCon->prepare("SELECT ROLEID 
FROM CREDENTIALS
WHERE USER_NAME = :USER 
    AND PASSWORD = AES_ENCRYPT(:PASS, :SALT) ");

if ( false===$userPassStmt ) {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$statementPrepper1 = $userPassStmt->execute(
    array(
    'USER' => $lv_user, 
    'PASS' => $lv_pass, 
    'SALT' => $salt
    )
);

if ( false===$statementPrepper1 ){
    die('bind_param() failed: ' . htmlspecialchars($userPassStmt->error));
}

$userPassResult = $userPassStmt->fetch();

if($userPassResult['ROLEID'] > 0 && $userPassResult['ROLEID'] <> false){
    //if credentials good let the AJAX call grant access 
    $grantAccess = true;
    $dataOut = [
        'ROLEID' => $userPassResult['ROLEID'], 
        'GRANT_ACCESS' => $grantAccess, 
        ];
    
    echo json_encode($dataOut);
}else{
    $dataOut = [
        'ROLEID' => 0, 
        'GRANT_ACCESS' => $grantAccess, 
    ];
    echo json_encode($dataOut);
}





?>