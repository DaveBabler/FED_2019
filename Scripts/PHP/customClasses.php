<?php
class FEDBootstrapBuilding{
    /**This assists in building a bootstrap alert by setting  a little
     * table grid up so it can be easily shown by the DOM
     * Note all the static stuff is because this is a workhorse class 
     * not a class that instantiates unique objects.
     * Dave Babler
     * 2019-09-14
     */
    const START_ALERT_HTML_TABLE = '<div class="table-responsive">
    <table class="table-condensed"
    <tbody
    <tr>';

    const END_ALERT_HTML_TABLE = '</tbody>
    </table>
    </div>';

    private static $image;
    private static $quantity;
    private static $description;
    private static $UPC;
    private static $alertData;

    private static function _setImage($incomingImage){
        $stringOut = '<tr>';
        $stringOut .= '<td>Looks like: </td>';
        $stringOut .= '<td><div><img src="' . $incomingImage . '" class="img-thumbnail" style="display: block; margin-left: none; margin-right: auto; width: 75px; height: 75px; object-fit: scale-down;"></div></td>';
        $stringOut .= '</tr>';
        self::$image = $stringOut;

    }
    private static function _getImage(){
        return self::$image;
    }

    private static function _setQuantity( $typeOfAlert, $incomingQuantity, $previousQuantity = NULL){
        /**The = NULL for previousQuantity signifies it's an OPTIONAL parameter
         * It is obviously required for updates
         * Dave Babler
         */
        if($typeOfAlert == "update"){
            $stringOut = '<tr>';
            $stringOut .= '<td>Previous Quantity: </td>';
            $stringOut .= '<td>' . $previousQuantity . '</td>';
            $stringOut .= '</tr>';
            $stringOut .= '<td>Quantity changed to: </td>';
            $stringOut .= '<td>'. $incomingQuantity . '</td>';
            $stringOut .= '</tr>';
            $stringOut .= '<tr>';
    
        }elseif($typeOfAlert == "insert"){
            $stringOut = '<tr>';
            $stringOut .= '<td>Quantity changed to: </td>';
            $stringOut .= '<td>'. $incomingQuantity . '</td>';
            $stringOut .= '</tr>';
        }elseif($typeOfAlert == "delete" ){
            //consider "incomingQuantity to be the deleted amount for ease of this function
            $stringOut = '<tr>';
            $stringOut .= '<td>Quantity removed: </td>';
            $stringOut .= '<td>'. $incomingQuantity . '</td>';
            $stringOut .= '</tr>';
        }else{
            $stringOut = "Error in class FEDBootstrapBuilding: module _setQuantity";
        }
        self::$quantity = $stringOut;

    }
    private static function _getQuantity(){
        return self::$quantity;
    }

    private static function _setUPC($typeOfAlert, $incomingUPC){
        if($typeOfAlert == "update"){
            $stringOut = '<tr>';
            $stringOut .= '<td>UPC updated: </td>';
            $stringOut .= '<td>'. $incomingUPC . '</td>';
            $stringOut .= '</tr>';

        }elseif($typeOfAlert == "insert"){
            $stringOut = '<tr>';
            $stringOut .= '<td>UPC <i> Added to the database </i>: </td>';
            $stringOut .= '<td>'. $incomingUPC . '</td>';
            $stringOut .= '</tr>';
        }elseif($typeOfAlert == "delete" ){
            $stringOut = '<tr>';
            $stringOut .= '<td>UPC: </td>';
            $stringOut .= '<td>'. $incomingUPC . '<i> has been purged from the database, the only way to undo this, is to copy this data and re-insert </i></td>';
            $stringOut .= '</tr>';
        }else{
            $stringOut = "Error in class FEDBootstrapBuilding: module _setUPC";
        }
        self::$UPC = $stringOut;

    }
    private static function _getUPC(){
        return self::$UPC;
    }

    private static function _setDescription($incomingDescription){
        $stringOut = '<tr>';
        $stringOut .= '<td>Description: </td>';
        $stringOut .= '<td>'. $incomingDescription . '</td>';
        $stringOut .= '</tr>';
        self::$description = $stringOut;
    }
    private static function _getDescription(){
        return self::$description;
    }

    private static function _setAlertData($preppedUPC, $preppedDescription, $preppedQuantity, $preppedImage){
        $preppedURL = START_ALERT_HTML_TABLE . $preppedUPC . $preppedDescription . $preppedQuantity;
        $preppedURL .= $preppedImage . END_ALERT_HTML_TABLE;
        self::$alertData = $preppedURL
    }
    private static function _getAlertData(){
        return self::$alertData;
    }

    public function buildAlert($passedType, $passedUPC, $passedDescription, $passedQuantity, $passedPreviousQuantity, $passedImage){
        //passedType is for the type of alert, Update, Delete, Insert
        self::_setUPC($passedType, $passedUPC);
        self::_setDescription($passedDescription);
        self::_setQuantity($passedType, $passedQuantity, $passedPreviousQuantity);
        self::_setImage($passedImage);
        $lv_UPC = self::_getUPC();
        $lv_description = self::_getDescription();
        $lv_quantity = self::_getQuantity();
        $lv_image = self::_getImage();

        $outGoingData = NULL;

        self::_setAlertData($lv_UPC, $lv_description, $lv_quantity, $lv_image);

        $outGoingData = self::_getAlertData();

        return $outGoingData;    
    }

}


?>