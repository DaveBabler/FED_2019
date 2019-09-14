<?php
  session_start();
  include('/home/dbabler/dbabler.yaacotu.com/FED_2020/PULL_OUT_TO_SERVER/db.php');
  $query      = "SELECT * FROM INV_TYPE ORDER BY TYPE_DESCRIPTION ASC";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset ="UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FED: Manage Inventory</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script type="text/javascript" src="Credential\credential_workhorse.js"></script>
    <script type="text/javascript" src="http://dbabler.yaacotu.com/FED_2020/Scripts/workhorse.js"></script>
    <script type="text/javascript" src="http://dbabler.yaacotu.com/FED_2020/Scripts/string_building.js"></script>

    <link rel="stylesheet" type="text/css" href="http://dbabler.yaacotu.com/FED_2020/css/interfaceGrid.css">

<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }

    .upcHelper{
    color: #fe019a;
    background-color:black;
    display: none;
    }
  .vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    max-width:inherit; /* For Bootstrap 4 - to avoid the modal window stretching full width */
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
}
</style>
</head>
<div class="grid-container">
  <div class="Block01"></div>
  <div class="Block02"></div>
  <div class="Block03"></div>
  <div class="Block04"></div>
  <div class="Block05">    <div class="container box">
      <h1 align="center">Manage Inventory</h1>
      <div hidden class="alert alert-success alert-dismissible" id = "insert_succeed_box">
      <!--  regarding * data-dismiss="alert" * DO NOT USE THIS that completely destroys the div  -->
        <a href="#" id="alert-close-01" class="close"  aria-label="close">&times;</a>
        <strong>The following has changed:</strong> 
        <!-- fill in message here -->
        <p id="returned_update"></p>
      </div>
      <div hidden class="alert alert-danger alert-dismissible" id = "delete_succeed_box">
      <!--  regarding * data-dismiss="alert" * DO NOT USE THIS that completely destroys the div  -->
        <a href="#" id="alert-close-02" class="close"  aria-label="close">&times;</a>
        <strong>The following has changed:</strong> 
        <!-- fill in message here -->
        <p id="returned_delete"></p>
      </div>


      <div class="table-responsive">

        <br>
        <div class="horizontal-scroll">
          <div class= "add_button_holder" align="right">
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info">Add</button>
          </div>
          <table id="inventory_table" class="table table-striped table-hover">
            <thead>
              <tr>
                <th max-width="5%">Image</th>
                <th max-width="5%">UPC</th>
                <th max-width="15%">Description</th>
                <th max-width = "10%">
                  <select name="category" id="category" class="form-control">
                    <option value = "">Food Type</option>
                    <?php
                        foreach($connection->query($query) as $row){
                        echo '<option value = "'.$row["TYPE_ID"].'">'.$row["TYPE_DESCRIPTION"].'</option>';
                      }
                    ?>
                  </select>
                </th>
                <th max-width="15%">Quantity</th>
                <th max-width="5%" >Edit</th>
                <th max-width="5%">Delete</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div></div>
  <div class="Block06"></div>
  <div class="Block07"></div>
  <div class="Block08"></div>
  <div class="Block09"></div>
</div>

<div id="userModal" class="modal fade" tabindex="-1" aria-labelledby="upcEntryModalTitle">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <h4 class="modal-title" id="upcEntryModalTitle">Add Item</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                              <form>
                                  <div class="col-md-6">
                                      <div class="form-group form-inline">
                                            <label for="formGroupExampleInput">Example label</label>
                                            <input type="number" class="form-control" id="upcEntry" placeholder="Scan or type upc here">
                                            <div  id="upcHelper" class="upcHelper"> A UPC must have 12 digits, once all 12 are in, search will start. </div>
                                            <!-- Note from babler: rather than mess with arcane javascript regex let's just use HTML 5's "number attribute!" -->
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                    <button type="button" id="manualUPCcheck" name="manualUPCcheck" class="btn btn-success">Button</button>
                                  </div>
                                  <div class="col-md-3">
                                        <button type="button" class="btn btn-warning"  class="close" data-dismiss="modal">Cancel</button>
                                  </div>
                              </form>
                          </div>
                        </div>
                      </div>
                  </div>
            </div> <!-- close modal body -->
            <div class="modal-footer">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="addFoundExternalUpc" class="modal fade"> <!-- Originally the id was "userModal" -->
  <div class="modal-dialog">
    <form method="post" id="user_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">UPC found in external database!</h3><br>
          <span>Please verify all information is correct before clicking "Add".</span>
        </div>
        <div class="modal-body">
          <i class="fas fa-times-circle" style="display:none;"></i>
          <i class="fas fa-check-circle" style="display:none;"></i>
         <span><label>UPC: </label><label name = "foundExternalUPC" id ="foundExternalUPC"></label></span>
          <br />
          <label>Description</label>
          <input type="text" name="descriptionExternalUPC" id="descriptionExternalUPC" class="form-control" autocomplete="off" />
          <span id="valid_description"></span>
          <br />
          <label>Food Type</label>
          <select name = "foodTypeExternalUPC" id="foodTypeExternalUPC" class ="form-control">
            <?php
                        foreach($connection->query($query) as $row){
                          echo '<option value = "'.$row["TYPE_ID"].'">'.$row["TYPE_DESCRIPTION"].'</option>';
                        }
            ?>

          </select>
          <br />
          <label>Quantity</label>
          <input type="text" name="quantityExternalUPC" id="quantityExternalUPC" class="form-control" autocomplete="off"/>
          <span id="valid_quantity"></span>
          <br />
          <label>If the image is incorrect, find one online, and paste over the provided link below.</label>
          <input type="text" name="imageLocationExternalUPC" id="imageLocationExternalUPC" class="form-control" autocomplete="off" />
          <br />
          <img id="showImageExternalUPC" name = "showImageExternalUPC" style ="display: block; margin-left: auto; margin-right: auto; max-width: 150px; max-height: 150px; object-fit: scale-down;">
          <br />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="user_id" id="user_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="submit" name="insertExternalUPC" id="insertExternalUPC" class="btn btn-success" value="Add" />

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>                    

</html>

<script type="text/javascript" language="javascript" >
var inserted_object
 
  

  function load_data (is_category) {
        var dataTable = $('#inventory_table').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:'/FED_2020/Scripts/DB/fetch.php',
            type:"POST",
            data: {is_category:is_category} 
        },
        "columnDefs":[
            {
                "targets":[0, 3, 4, 5, 6],
                "orderable":false,
                "orderable":false,
            },
        ],
        });  
  } 

  $("#insertExternalUPC").on("click", function(e){
          insertedObject =  AJAX_TO_DATABASE.ajaxExternallyFoundUPC();
         let type_of_insertion = "SQL_Insert";
        $("#returned_update").html("<b>fuck you</b>");
        $("#insert_succeed_box").show();
      });
      
  $(document).ready(function(){
    var upcDigitCounter = 0;
    $('#inventory_table').DataTable().destroy();
    load_data();//1

    $("#upcEntry").css({backgroundColor: 'orange'});;
    $("#upcEntry").on('input change keyup', function(event){
      if(event.keyCode == 8 || event.keyCode == 46 ){
          /**I just want to completely ignore any and all backspace
           * and delete presses, and not even accidentally capture them as
           * values.  Dave Babler
           */
            console.log(event); 
            console.log(event.keyCode);
      }else{
        let value = $(this).val();
        let valueLength = value.length;
        console.log("Value length = "+valueLength);
       INPUT_CONTROLS.upc12Digits(valueLength);

      }

    });

    $('.alert .close').on('click', function(e) {
      /** We want things to be able to close */
        $(this).parent().hide();
     });

/* 
    $("#manualUPCcheck").on("click", function(){
             let lv_foundExternalUPC = "0123456879";
            let lv_descriptionExternalUPC = "something";
            let lv_quantityExternalUPC = 3;
            let lv_imageLocationExternalUPC ="http://i67.tinypic.com/vru69u.jpg";

            let inc_insert_obj = {
                        outer_upc_var: user_id.toString(),
                        outer_descript_var: lv_descriptionExternalUPC.toString(),
                        outer_quant_var: lv_quantityExternalUPC.toString(),
                        outer_image_var: lv_imageLocationExternalUPC.toString(),
                    };
            let lv_type_of_insertion = "SQL_Insert";

            let insert_temp = alert_type_summon_arguments(lv_type_of_insertion, inc_insert_obj);

            $("#returned_delete").html(insert_temp);


      $("#userModal").modal('hide');
      $("#delete_succeed_box").show();
      $("#returned_delete").fadeTo(5000, 500).slideUp(500, function() {
                            $("#returned_delete").slideUp(500);
        }); 


    }); */
    
  });


</script>