<?php
session_start();
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/PULL_OUT_TO_SERVER/db.php');
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/Scripts/PHP/function.php');
/*WARNING WARNING WARNING
THIS SCRIPT WILL BE FOLDED INTO "checkoutDBLogic.php"*/

if(!$_SESSION['POST']) $_SESSION['POST'] = array();

foreach ($_POST as $key => $value) {
    $_SESSION['POST'][$key] = $value;
}

echo json_encode($_SESSION['POST']);








?>