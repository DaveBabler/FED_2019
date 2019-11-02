<?php
  session_start();
  include('/home/dbabler/dbabler.yaacotu.com/FED_2020/PULL_OUT_TO_SERVER/db.php');
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
    <script type="text/javascript" src="http://dbabler.yaacotu.com/FED_2020/Scripts/string_building.js"></script>
    <script type="text/javascript" src="http://dbabler.yaacotu.com/FED_2020/Scripts/workhorse.js"></script>
    <!-- end our custom scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      body {
          margin:0;
          padding:0;
          background-color:#f1f1f1;
      }

      ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1510 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
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
	<div class="row">
		<div class="col-md-12">
			 <a id="modal-InventoryTextSearchTop" href="#modal-modalInventoryTextSearch" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
			
			<div class="modal fade" id="modal-modalInventoryTextSearch" role="dialog" aria-labelledby="inventoryCheckInTextSearch" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel">
								UPC Invalid! 
                            </h5> 
                            <div class ="modal-header-body"><h6>
                                Please try searching by text.  
                                If you find something in the list that sounds correct choose it to verify!
                                If your choice is correct update the quantity and press submit.
                                If you choose the wrong item, press clear to search again.
                                If you don't find anything, that's OK! 
                                Simply chose the button "Generate UPC". </h6>
                            </div>
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">

                                <!-- Search input-->
                                
                                <div class="form-group">
                                        <label class="col-md-4 control-label" for="inventoryACSearch"></label>
                                        <div class="col-md-8">
                                        <input id="inventoryACSearch" name="inventoryACSearch" type="search" placeholder="e.x. Lenny &amp; Larry protein brownies" class="form-control input-md">
                                        <p class="help-block">Type what you're looking for here, it will start searching immediately.</p>
                                        </div>
                                </div>
                                    
                                    <!-- Prepended text-->
                                        <div class="form-group">
                                            <span><label class="col-md-4 control-label" for="foundACUPC">UPC:</label></span>
                                                <span id="foundACUPC" name="foundACUPC"></span>                                   
                                        </div>
                                    
                                    <!-- Prepended text-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="foundACQuantity"></label>
                                        <div class="col-md-4">
                                         <div class="input-group">
                                            <span class="input-group-addon">Qty.</span>
                                            <input id="foundACQuantity" name="foundACQuantity" class="form-control" placeholder="" type="text">
                                         </div>
                                            <p class="help-block">Add new stock to existing stock, then enter.</p>
                                        </div>
                                    </div>
                                                
						    </div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-primary" id="submitItemByTextSearch" name="submitItemByTextSearch">
								Submit
                            </button> 
                            <button type="button" class="btn btn-primary" id="clearTextSearchModal" name="clearTextSearchModal">
                                    Clear to Search Again
                            </button> 
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
	</div>
</div>
    </body>


<script>
var entry = null;



$(document).ready(function(){
   


}); //end $(document).ready(function)

</script>
