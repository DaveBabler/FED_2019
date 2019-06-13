<?php

include('/home/dbabler/dbabler.yaacotu.com/FED_2020/PULL_OUT_TO_SERVER/db.php');

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