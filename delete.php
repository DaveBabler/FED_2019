<?php

require('/home/dbabler/dbabler.yaacotu.com/FED_2020/config.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM `INVENTORY` WHERE `INVENTORY`.`UPC` = :UPC"
	);
	$result = $statement->execute(
		array(
			':UPC'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}

?>