//file contains some of the workhorse functions, functions that may get called several times a script, 
function wipe_data(alert_id_num) {
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
    $(event_origin).click(function() {
        $(target_alert).empty();
        // $(target_box).hide(); currently not needed, but ... leaving it in because

    });
}

function bounce_up_init_vars() {
    window.scrollTo(0, 0);
    console.log(type_of_insertion);
    //reset the variable type
    type_of_insertion = "";
}

function getFoodType(numericTypeID) {
    let newData;
    $.ajax({
        url: "http://dbabler.yaacotu.com/FED_2020/Scripts/DB/pdo_select_type.php",
        async: false,
        method: 'POST',
        dataType: 'json',
        data: {
            typeid_in: numericTypeID,
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


THROTTLE = {

        debounce: function(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
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

        entryTimerStart: function(passedID) {
            var timer = null;
            $('#' + passedID).on("input", function() {
                var outputVal = null;
                clearTimeout(timer);
                timer = setTimeout(THROTTLE.promisedAjax, 1000);
                return outputVal;

            });
        },
        delayedValue: function() {
            var dataToPassEventually = $('#userEntry').val();
            return dataToPassEventually;
        },

        promisedAjax: function() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {

                    entry = THROTTLE.delayedValue();
                    const error = false;
                    if (!error) {
                        resolve(AJAX_TO_DATABASE.ajaxSearch(entry));
                    } else {
                        reject('Bad stuff happened and it sucks!');
                    }
                }, 1000);
            });
        }

    } //end THROTTLE namespace 


AJAX_TO_DATABASE = {
        ajaxSearch: function(searchData) {
            /*This search function is used if an autocomplete is not.  So it's built and ready to go in the event 
            that autocomplete is not desireable for page logic, or stakeholder desires
            --Dave Babler */
            if (searchData === '' || searchData == '' || searchData == null || searchData === undefined) {
                //prevent an emptied field from selecting random data.
                console.log("No data currently selected and/or empty value set");
            } else {
                let queryType = new Array("SEARCH"); //I assume passing it as an array is what will let AJAX take it.
                $.ajax({
                    type: "POST",
                    url: '/FED_2020/Scripts/DB/checkoutDBLogic.php',
                    data: {
                        'searchData': searchData,
                        'queryType': queryType
                    },
                    dataType: "json",
                    success: function(searchResponse) {
                        console.log(searchResponse);
                        if (searchResponse.cartQuantity < 1) {
                            AJAX_TO_DATATABLES.zeroInventory(searchResponse);
                        } else {
                            AJAX_TO_DATATABLES.createRow(searchResponse);
                        }
                    }
                })
            }
        },

        ajaxCheckout: function(cartData) {
            console.log("inside ajaxCheckout");
            let queryType = new Array("CHECKOUT"); //my assumptions in AJAX_TO_DATABASE.ajaxSearch were correct
            $.ajax({
                type: "POST",
                url: '/FED_2020/Scripts/DB/checkoutDBLogic.php',
                data: {
                    'cartData': cartData,
                    'queryType': queryType
                },
                dataType: "text",
                success: function(cartResponse) {
                    console.log("cartResponse should be exactly below this line");
                    console.log(cartResponse);
                    console.log("the only thing above this should be a response from AJAX");
                }
            })
        },

        ajaxInventoryCheckUPC: function() {
            var upcEntry = $("#upcEntry").val();
            $.ajax({
                url: "/FED_2020/Scripts/PHP/upcVerify.php",
                method: "POST",
                data: { upcEntry: upcEntry },
                dataType: "json",
                success: function(upcReturnedInfo) {
                    console.log(JSON.stringify(upcReturnedInfo));
                    /** I am done, DONE, D-O-N-E playing around with how JavaScript deals with
                     * boolean flags, integers, and text, everything that is remotely close to an int
                     * shall now be force-cast as an int! --Dave Babler
                     */
                    let isUPCValid = parseInt(upcReturnedInfo.valid_upc, 10);
                    let doesUPCExist = parseInt(upcReturnedInfo.upc_exists, 10);
                    let wasDataCapturedForUPC = parseInt(upcReturnedInfo.data_captured, 10);
                    if ((isUPCValid) == 1) {
                        /**Checking the flag to see if the upc is valid */
                        if (upcReturnedInfo.upc_exists == 0) {
                            /** If the UPC does not exist in our database then it needs to be added.
                             * so we will run that module.
                             */
                            $("#userModal").modal({
                                show: false
                            });
                            $("#userModal").modal('hide');

                            $("#addFoundExternalUpc").modal({
                                show: true
                            });
                            MODAL_MANIPULATION.foundExternalUPCModalFiller(upcReturnedInfo, upcEntry);


                        }
                    }

                }

            });
        },

        ajaxExternallyFoundUPC: function() {
            let operation = "newAdd";
            $.ajax({
                type: "POST",
                url: '/FED_2020/Scripts/DB/insert.php',
                data: {
                    'operation': operation,
                    'foundExternalUPC': $("#foundExternalUPC").text(),
                    'descriptionExternalUPC': $("#descriptionExternalUPC").val(),
                    'quantityExternalUPC': $("#quantityExternalUPC").val(),
                    'imageLocationExternalUPC': $("#imageLocationExternalUPC").val(),
                    'foodTypeExternalUPC': $("#foodTypeExternalUPC").val(),
                },
                dataType: "json",
                success: function(insertMessage) {
                    console.log("You have successefully inserted: " + insertMessage);
                },
            });

        },
    } //end AJAX_TO_DATABASE namespace


AJAX_TO_DATATABLES = {
        createImg: function(dbImg) {
            let imgOut = '';
            let prefixChunk = '<img src="';
            let middleChunk = dbImg;
            let suffixChunk = '" class="img-thumbnail" style ="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px; object-fit: scale-down;" />';
            return imgOut = prefixChunk + middleChunk + suffixChunk;
        },

        createButton: function(dbUPC) {
            let buttonOut = '';
            let prefixChunk = '<button type="button" class="btn btn-danger delete" id="';
            let middleChunk = dbUPC;
            let suffixChunk = '">Delete from cart</button>';
            return buttonOut = prefixChunk + middleChunk + suffixChunk;
        },


        createRow: function(dbResponse) {
            let imageProper = AJAX_TO_DATATABLES.createImg(dbResponse.cartImage);
            let deleteProper = AJAX_TO_DATATABLES.createButton(dbResponse.cartUPC);
            table.row.add({
                "Image": imageProper,
                "UPC": dbResponse.cartUPC,
                "Description": dbResponse.cartDescription,
                "Delete": deleteProper,
                "TypeID": dbResponse.cartType_ID
            }).draw();
            SESSION_DATATABLES.saveTableInSession();
        },

        zeroInventory: function(dbResponse) {
            //no need for image proper, the string builder will handle that for us. 
            //no need for delete button.
            let bootstrap_warning_string = zero_inventory_checkout_builder(dbResponse.cartUPC, dbResponse.cartDescription, dbResponse.cartImage);
            $("#checkout_zero_inventory_alert").show();
            $("#checkout_zero_inventory").html(bootstrap_warning_string);
        }


    } //end AJAX_TO_DATATABLES namespace


AUTO_COMPLETE = {
    selectWrapper: function(ui) {
        /*wrapper function that goes in the jquery autocomplete select API
          this function wraps up all the misc. functions that need to fire upon selection*/
        console.log("in select logic");
        console.log(ui.item);
        console.log("---------------------");
        console.log(ui.item['cartUPC']);
        if (ui.item['cartQuantity'] < 1) {
            AJAX_TO_DATATABLES.zeroInventory(ui.item);
        } else {
            AJAX_TO_DATATABLES.createRow(ui.item);
        }
        //clear user input
        $('#userEntry').val('');
        return false;
    },


}


SESSION_DATATABLES = {
        rebuildTable: function(sessionTable) {
            table.state(); //CHECK 01 sets the state of the table we might be able to remove this from the function
            table.clear().draw();
            //want all JSON parsing done in function so interfaces don't have to worry about it
            table.rows.add(JSON.parse(sessionTable)); // Add new data
            table.columns.adjust().draw();
        },
        saveTableInSession: function() {
            //again I prefer to have all JSON parsing done in function so interfaces don't have to worry about it
            sessionCart = JSON.stringify($("#cart").DataTable().rows().data().toArray());
            sessionStorage.setItem("savedCart", sessionCart);

        },
        retrieveSessionTable: function() {
            let sessionCart = '';
            sessionCart = sessionStorage.getItem("savedCart");
            return sessionCart;
            //warning it returns JSON data, and thus will need to be dealt with accordingly
        },

        destroyTable: function() {
            //everything else is abstracted, so I'm abstracting this.-- Dave Babler
            //future iterations may require more work to destroy the table so leaving it here is a good idea -- Dave Babler
            table.destroy();
            table.draw();
        }
    } //end SESSION_DATATABLES namespace

SESSION_CLOSING = {
        killPHPSession: function() {
            $.ajax({
                url: "session_kill.php",
                type: 'GET',
                dataType: 'text',
                async: false, //this CANNOT be asynchronous or the series of events will fail. -- Dave Babler
                success: function(result) {
                    console.log(result);
                }
            });
        },
        killHTMLSession: function() {
            sessionStorage.clear();
        },
        sendToLogin: function() {
            //we don't want people using the back button here.
            window.location.replace("index.html");
        }
    } //end SESSION_CLOSING namespace 



INPUT_CONTROLS = {
    upc12Digits: function(digits) {
        /** If the digits are less than 12 show a helper field, 
         * if not then proceed with normal logic
         */
        let lv_digits = parseInt(digits, 10);
        if (lv_digits < 12) {
            $("#upcHelper").show();
            return false;
        } else {
            $("#upcHelper").hide();
            AJAX_TO_DATABASE.ajaxInventoryCheckUPC();

            return true;
        }
    }

}


MODAL_MANIPULATION = {

    foundExternalUPCModalFiller: function(externalData, passedUPC) {
        $("#foundExternalUPC").text(passedUPC);
        $("#descriptionExternalUPC").val(externalData.description);
        $("#quantityExternalUPC").val(externalData.quantity);
        $("#imageLocationExternalUPC").val(externalData.image_location);
        $("#showImageExternalUPC").attr("src", externalData.image_location);
    }

}