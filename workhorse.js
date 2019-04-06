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
       var outputVal = null;
        clearTimeout(timer);
        timer = setTimeout(DEBOUNCE.promiseTest,  5000);
        return outputVal;
        
      });
    }, 
    delayedValue: function(){
      var dataToPassEventually = $('#userEntry').val();
      console.log("this is hitting in the namespace " + dataToPassEventually);
      return dataToPassEventually;
    },

    delayedAjax: function(){
      var searchData = $('#userEntry').val();
      $.ajax({
        type: "POST", 
        url: 'checkoutDBLogic.php', 
        data:{'searchData': searchData}, 
        dataType: "json",
        success: function(searchResponse){
          console.log(searchResponse);
        }
      })

    }, 
    promiseTest: function () {
      return new Promise((resolve, reject) => {
          setTimeout(() => {
           
          entry = DEBOUNCE.delayedValue();
          const error = false;
          if(!error){
              resolve(DEBOUNCE.promise2());
          }else{
              reject ('Bad stuff happened and it sucks!');
          }
          }, 1000);
      });
    }, 
   promise2: function() {
      return new Promise ((resolve, reject) => {
          setTimeout(() => {
          const error = false;
          if(!error){
              resolve(console.log("This is the second promise of the value: " + entry));
          }else{
              reject ('A second bad thing happened');
          }
          }, 2000);
      });
    }
  



  } //end DEBOUNCE namespace 

  


  
