//file contains some of the workhorse functions, functions that may get called several times a script, 
function wipe_data(alert_id_num){
    //takes the last two digits of an alert's id concatenates and wipes the text
    //Dave Babler
    var event_origin = "alert-close-" + alert_id_num;
    var target_alert;
    var target_box;
    switch (alert_id_num) {
      case "01":
        target_alert = "returned_update";
        target_box = "insert_succeed_box";
        break;
    }
    $(event_origin).click(function(){
     $(target_alert).empty();
     // $(target_box).hide();
   
       
    });   
   }
  
  function bounce_up_init_vars(){
    window.scrollTo(0,0);
    console.log(type_of_insertion);
    //reset the variable type
    type_of_insertion = "";
  }