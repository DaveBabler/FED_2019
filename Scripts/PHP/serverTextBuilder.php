<?php
    include_once("Scripts/PHP/customClasses.php");

    if($_REQUEST[alertType] == "insert"){
        $alertType = $_REQUEST[alertType];
        $UPC = $_REQUEST[UPC];
        $description = $_REQUEST[description];
        $quantity = $_REQUEST[quantity];
        $previousQuantity = NULL; //we have nothing for this could pass request null but why?
        $image = $_REQUEST[image];
        $returnedData = NULL;

        $returnedData = FEDBootstrapBuilding::buildAlert($alertType, $UPC, $description, $quantity, $previousQuantity, $image);

        echo $returnedData;
    }


?>