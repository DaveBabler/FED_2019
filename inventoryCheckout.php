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
        <div class="col-md-12">
        <h1 align="center">Checkout</h1>
        </div>
        <div class="col-md-7">
            <input type="text" class ="form-control" name="userEntry" id="userEntry" aria-describedby="userEntry" placeholder="Scan or enter UPC here">
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
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Image
						</th>
						<th>
							UPC
						</th>
						<th>
							Description
						</th>
                        <th>
                            Delete
						</th>
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






$(document).ready(function(){
    //grab the user entry 

/*     $('#userEntry').on("input", function(){

        promiseTest().then(console.log("promises happened?"));

    }); */

 DEBOUNCE.entryTimerStart('userEntry');



  
       

    
}); //end $(document).ready(function)

</script>
