<?php
session_start();
require('/home/dbabler/dbabler.yaacotu.com/FED_2020/config.php');
include('function.php');

echo "<h1>".$_SESSION['QUERY']."</h1>";

?>