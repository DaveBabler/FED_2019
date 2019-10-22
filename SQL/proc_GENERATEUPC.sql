DELIMITER $$
DROP PROCEDURE IF EXISTS proc_GENERATEUPC();
CREATE PROCEDURE proc_GENERATEUPC()
COMMENT 'This procedure does the insert on the UPC_GENERATOR TABLE \r\n
It then selects out the newly generated UPC to a temporary table \r\n
all within a self contained transaction, thus avoiding issues with \r\n
potentially generating the wrong UPC. -- Dave Babler'

BEGIN #REMINDER THIS STARTS THE TRANSACTION

     /** DECLARE lv_newUPC  BIGINT(14); no declaration actually needed, leaving in case 
        * we end up doing something different with this later and need to know
        * what dataType the UPC is, since BIGINT is a non-traditional datatype. 
        * --Dave Babler */
     #DO THE INSERT
    INSERT INTO UPC_GENERATOR(GENERIC_UPC_ID)
    VALUES(NULL);
     #DO THE SELECT
    SELECT MAX(GENERIC_UPC_ID) AS NewUPC
    FROM UPC_GENERATOR;

    COMMIT;
END$$

DELIMITER ;



