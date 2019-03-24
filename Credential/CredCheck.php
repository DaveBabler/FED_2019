<?php
include_once("../db.php");

//sanitize the email first
//$email =  filter_var($_POST['emailUser'], FILTER_SANITIZE_EMAIL);  

$email = 'Emma_Frost@xavierschool.edu';

$pass = 'diamonds';


$salt = 'FED';






$userPassStmt = $credCon->prepare("SELECT ROLEID 
            FROM CREDENTIALS
            WHERE USER_NAME = :USER 
                  AND PASSWORD = AES_ENCRYPT(:PASS, :SALT) ");

// prepare() can fail because of syntax errors, missing privileges, ....
//shoving these little error catchers on a single indent so they stand out
    if ( false===$userPassStmt ) {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

$statementPrepper1 = $userPassStmt->execute(
    array(
        'USER' => $email, 
        'PASS' => $pass, 
        'SALT' => $salt
        )
    );

    if ( false===$statementPrepper1 ){
         echo "<hr><hr><hr>";
        die('bind_param() failed: ' . htmlspecialchars($userPassStmt->error));
    }

    $userPassResult = $userPassStmt->fetch();
    echo "<hr>";
    print_r($userPassResult['ROLEID']);
    echo "<hr>";




?>