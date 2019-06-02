<?php
  session_start();
  include('db.php');
?>
<!DOCTYPE html>

<!-- babler notes https://datatables.net/examples/api/add_row.html -->
<html lang="en">
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
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- begin our custom scripts -->
    <script type="text/javascript" src="string_building.js"></script>
    <script type="text/javascript" src="workhorse.js"></script>
    <!-- end our custom scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      body {
          margin:0;
          padding:0;
          background-color:#f1f1f1;
      }
      .box {
          width:90%;
          padding:20px;
          background-color:#fff;
          border:1px solid #ccc;
          border-radius:5px;
          margin-top:25px;
      }
      .horizontal-scroll {
          /*overflow: hidden;
          overflow-x: clear;*/
          clear:  both;
          width: 100%;
      }
      .table-striped {
          min-width: rem-calc(640);
      }
      .add_button_holder {
          max-width: 100px;
          float: right;
      }
      .col-sm-6 {
          max-width: 200px;
      }
      .add_button_holder, .dataTable_filter {
          display: inline-block;
      }
      .add_button_holder{
          height: 30px;
      }
      div.dataTables_wrapper div.dataTables_filter input {
          width: 400px;
      }
    </style>
  </head>
  <body>
  <div class="container-fluid">
  <div class="container box">
    <div class ="row">
        <div class="col-sm-12 col-md-12">
        <h1 align="center">Checkout</h1>
        </div>
        <div class="row">
            <div class ="col-sm-12 col-md-12">
                <div hidden class="alert alert-danger alert-dismissible" id = "checkout_zero_inventory_alert">
                <!--  regarding * data-dismiss="alert" * DO NOT USE THIS that completely destroys the div  -->
                <a href="#" id="alert-close-01" class="close"  aria-label="close">&times;</a>
                <strong>Zero Quantity in Database</strong> 
                <!-- fill in message here -->
                <p id="checkout_zero_inventory"></p>
                </div>
            </div>
        </div>


        <div class="col-md-7">
            <input type="text" class ="form-control" name="userEntry" id="userEntry" aria-describedby="userEntry" placeholder="Scan or enter UPC here" autocomplete="off">
        </div>
        <div class ="col-md-5">
            <div class="add_button_holder" align="right">
                <button type="button" class="btn btn-success" id="buttonCheckout" name="buttonCheckout">Checkout!</button>
            </div>
        </div>    
    </div>
    <div>
        <br>
    </div>
	<div class="row">
    <div class="table-responsive">
		<div class="col-md-12">
            <table id="cart" class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="col-xs-1">Image</th>
						<th class="col-xs-1">UPC</th>
						<th class="col-xs-6">Description</th>
                        <th class="col-xs-3">Delete</th>
                        <th>TypeID</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
        
    </div>
</div>
</div>
</body>
<script>
var entry = null;
//it's not needed to see typeid on checkout so why clutter!
var table = $('#cart').DataTable({
    "ordering": false,
    "bFilter": false,
    "stateSave": true,
    "stateDuration": -1,
    "bstateSave": true,
    "retrieve": true,
    "stateSaveParams": function (settings, data) {
    data.search.search = "";
  }, 
  stateSaveCallback: function(settings,data) {
      localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
    },


    "columnDefs": [
        { "visible": false, "targets": 4 }
    ],
    columns:[
        {"data": 'Image'}, 
        {"data": 'UPC'}, 
        {"data": 'Description'},
        {"data": 'Delete'},
        {"data": 'TypeID'}, 
    ], 
    "ajax": {
    "url": "checkoutUpdateTemp.php",
    "data": {
        "user_id": 451
    }
  }

});

var savedCart;



$(document).ready(function(){

    if(sessionStorage.getItem("savedCart") != null){
        savedCart = SESSION_DATATABLES.retrieveSessionTable();
        console.log(JSON.parse(savedCart));
        SESSION_DATATABLES.rebuildTable(savedCart);
    // Redraw the DataTable
    }


    //grab the user entry 
   // THROTTLE.entryTimerStart('userEntry');

   $('#userEntry').autocomplete({
       source: function (request, response){
           $.ajax({
               type:"POST", 
               //url:"Scripts\\DB\\acLogic.php", 
               url:"acLogic.php",
               data:{term:request.term}, 
               dataType: 'json', 
               minLength: 2,
               delay: 100,
               success: function(data){
                   console.log(data);
                   response(data);
               }

           });
       }, 
       select: function (event, ui) {        
        AUTO_COMPLETE.selectWrapper(ui);
  },
   });

    //close any bootstrap warnings
    $('.alert .close').on('click', function(e){
        $(this).parent().hide();
    });
    //remove row
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        table 
            .row($(this).parents('tr'))
            .remove()
            .draw();
           SESSION_DATATABLES.saveTableInSession();
    });

    $(document).on('click', '#buttonCheckout', function(e){
        e.preventDefault();
        let data = table.rows().data().toArray();
        console.log(JSON.stringify(data));
        console.log("---------- OFF TO AJAX----------------");
        AJAX_TO_DATABASE.ajaxCheckout(data);
        SESSION_DATATABLES.destroyTable();
        SESSION_CLOSING.killHTMLSession();
        SESSION_CLOSING.killPHPSession();
        SESSION_CLOSING.sendToLogin();

    });


  
       

    
}); //end $(document).ready(function)

</script>
