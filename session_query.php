<?php
session_start();
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/PULL_OUT_TO_SERVER/db.php');
include('function.php');

echo "<h1>".$_SESSION['QUERY']."</h1>";

?>