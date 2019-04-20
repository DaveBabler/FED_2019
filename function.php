<?php

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM INVENTORY");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function is_upc_valid($numberUPC){
    $upc = strval($numberUPC);
    $result = 0;
    if(!(isset($upc[11]))){
        $result = 0;
    }
    else{
        $odd_num=$even_num =0;
        for($i =1; $i<12;++$i){
            if ($i % 2 == 0){
                $even_num += $upc[$i-1];
            }
            else{
                $odd_num += $upc[$i-1];
            }
        }
        $total_sum=$even_num+(3*$odd_num);
        $modulo = $total_sum%10;

        if($modulo==0){
            $check_digit = 0;
        }
        else{
            $check_digit=10-$modulo;
        }
        if($check_digit==$upc[11]){
            $result = 1;
        }
        else 
            $result=0;
    }
    return $result;
}
function does_upc_exist($numberUPC){
    include ('db.php');
    $bool_value = 1;
    $statement = $connection->prepare("SELECT * FROM INVENTORY WHERE UPC = :UPC");
    $statement->execute(
        array(
            ':UPC'  => $numberUPC
        )
                       );
    $result = $statement -> fetchAll();
    $number_rows = $statement ->rowCount();
    if ($number_rows==0){
        $bool_value = 0;
    }
    else{
        $bool_value = 1;
    }
    return $bool_value;
}


class TransactionException extends Exception{
    public function  __construct($message = 'Transaction rolled back significant errors contact DBA!', $code = 0, $previous = null) {
        parent::__construct($message, $code, $previous);
    }
        // custom string representation of object
        public function __toString() {
            return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
        }

}


class SQLException extends Exception{
    protected $typeOfException;
    protected $sqlConstructVariable; //this is the variable you're passing in your sql prepared statement construct such as $updateStmt or $sqlSearch 
    protected $sqlVarName; //this is the actual string name of your variable
    public function __construct($message = null, $code = 0, $previous = null, $typeOfException, $sqlConstructVariable, $sqlVarName){
        //constructor for defining the type of exception
        $this->typeOfException = $typeOfException;
        $this->sqlConstructVariable = $sqlConstructVariable;
        $this->sqlVarName = $sqlVarName;
    }
         // custom string representation of object
    public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function thrownSQL(){
        $outputMessage = '';
        if($this->typeOfException == "prepare"){
            //maybe make this more generic so it can be Select & Insert as well?
        $outputMessage = 'Update failed on var \''.$this->sqlVarName.'\' contact DBA with the following code: ' . htmlspecialchars($this->sqlConstructVariable);
        }elseif ($this->typeOfException == "execute") {
            $outputMessage = "Update failed on execute likely a rowCount() failure " . htmlspecialchars($this->sqlConstructVariable) . "<br>";
        }else{
            $outputMessage = "Unknown SQL Prepared statement error thrown; call DBA carefully write down the exact steps
                             that caused this issue, and then, call the DBA/Programmer immediately.";
        }
        return $outputMessage;
    }
}

//https://stackoverflow.com/questions/23740548/how-to-pass-variables-and-data-from-php-to-javascript
?>