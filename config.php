<?php
session_start();
define('ROOT_PATH', dirname(__DIR__).'/FED_2020/');
define('PRIV_PATH', ROOT_PATH.'PULL_OUT_TO_SERVER/'); //WHERE LOGINS WILL GO be sure to replace that last concat!!!
include(PRIV_PATH.'db.php');
/*  $included_files = get_included_files();

 foreach ($included_files as $filename) {
     echo $filename."<br>";
     echo "<hr>";
 }
 */


?>

