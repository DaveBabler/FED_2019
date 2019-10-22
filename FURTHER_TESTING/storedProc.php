<?php
session_start();
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/PULL_OUT_TO_SERVER/db.php');
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/Scripts/PHP/function.php');
include('/home/dbabler/dbabler.yaacotu.com/FED_2020/Scripts/PHP/encoding.php');
use ForceUTF8\Encoding;

echo "see me";

     try{
        /**Using a stored procedure were going to output to a temporary table in the database 
         * the inserted newly generated UPC, 
         * this way we do not have to do an INSERT with PHP and then 
         * do a SELECT with php, just let MySQL handle it.
         * Please see the database for documentation on the stored procedure
         * Dave Babler
         */
        $sqlProcedure = "CALL proc_GENERATEUPC()";
        $stmt = $connection->prepare($sqlProcedure);
        //we have to pass a value even if it's just a dummy value or PHP will freak out.
        $stmtExer = $stmt->execute();

         while($row = $stmt -> fetch()){
            /**this really better be only a single row, but we're 
             * going to use a loop anyway just to be safe.
             * Dr. M, for fun if you want to make your students in the future
             * change this into a single select statement that would be a good challenge.
             * --Dave Babler
             */
            /** We are storing a single row into an array, overkill? Perhaps, but
             * this is what JSON and DataTables like, and thus, this is what JSON shall have.
             * --Dave Babler
             */

              $resultData['NewUPC'] = Encoding::toUTF8($row['NewUPC']); //I had to implement this because of a encoding error
              //fun fact $row[NewUPC] is equivalent to $row['NewUPC'] try it!

              $dataHoldingTank[] = $resultData;
         }
        echo json_encode($dataHoldingTank); 

     }catch(PDOException $ex) {
        echo json_encode($ex->getMessage());
    }



?>