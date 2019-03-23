/* 
    This contains self-contained functions for the log-in protocols for the HCC FED database
    Author: Dave Babler 
    Date: 2019-03-23
*/

jQuery.fn.extend({
    buttlert: function (x, y) {
        var user = x;
        var pass = y;
        var buttlertText = '';
        buttlertText = "User is: " + x + " & Password is: " + y;
        alert(buttlertText);
    }
});
