/* 
    This contains self-contained functions for the log-in protocols for the HCC FED database
    Author: Dave Babler 
    Date: 2019-03-23
*/


CREDENTIAL = {

    buttlert: function (x, y) {
        //create an alert when the button is pressed.
        //this is good for debugging --Dave Babler
        var user = x;
        var pass = y;
        var buttlertText = '';
        buttlertText = "User is: " + x + " & Password is: " + y;
        alert(buttlertText);
    },
    
    sendToRolePage: function (role) {
        
        switch (role) {
            case "1":
                window.location.href = "http://dbabler.yaacotu.com/FED_2019/inventoryMain.php";
                break;
            case "2": 
            //sending both volunteers and admins to inventoryMain until we get a proper admin page.
                window.location.href = "http://dbabler.yaacotu.com/FED_2019/inventoryMain.php";
                break;
            case "3":
                window.location.href = "http://dbabler.yaacotu.com/FED_2019/inventoryMain.php";
                break;
            default:
                alert("Significant error in CREDENTIAL.sendToRolePage function contact webmaster.")
                break;
        }      
    }
}

