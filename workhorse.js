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
      case "02":
        target_alert = "returned_delete";
        target_box = "delete_succeed_box";
    }
    $(event_origin).click(function(){
     $(target_alert).empty();
     // $(target_box).hide(); currently not needed, but ... leaving it in because
        
    });   
   }
  
  function bounce_up_init_vars(){
    window.scrollTo(0,0);
    console.log(type_of_insertion);
    //reset the variable type
    type_of_insertion = "";
  }
  function getFoodType(numericTypeID){
    let newData;
    $.ajax({
    url:"pdo_select_type.php",
    async: false, 
    method:'POST',
    dataType:'json',
    data: {typeid_in: numericTypeID,
    },

    success: function(result) {
            newData = result;
            console.log(result);
            $("#ajaxresponse").html(result);
    }

    });
  return newData;
  }
  //oberon picture for product testing http://i63.tinypic.com/2wex3z5.jpg oberon upc 740522110657
 
 
  DEBOUNCE = {

    delayedKeyUp: function(){
      let timer = null;
      $('#userEntry').on("input", function(timer) {
        clearTimeout(timer); 
        var dInput = this.value;
        timer = setTimeout(DEBOUNCE.valueDelayedEntry(dInput), 3600);
        //return dInput;
     });
    },

    valueDelayedEntry: function(incomingText){
      //the AJAX call will go here but for now console log will work. 
      console.log(incomingText);
    },


    debounce: function(func, wait, immediate){
      var timeout;
      return function() {
        var context = this, args = arguments;
        var later = function() {
          timeout = null;
          if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    }
    
  }, 
 
    entryTimerStart: function(passedID){
      var timer = null;
      $('#' + passedID).on("input", function(){
        var jeff = null;
        clearTimeout(timer);
        timer = setTimeout(DEBOUNCE.delayedValue.bind(jeff), 1000);
        return jeff;
       
      });
    }, 
    delayedValue: function(){
      var dataToPassEventually = $('#userEntry').val();
      console.log("this is hitting in the namespace " + dataToPassEventually);
      return dataToPassEventually;
    }




  } //end DEBOUNCE namespace 

  


  
