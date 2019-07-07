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
    <link rel="stylesheet" type="text/css" href="http://dbabler.yaacotu.com/FED_2020/css/interfaceGrid.css">
  <head>
      <style>
          hackBox {
            display: flex;
            align-items: center;
            padding
          }
      </style>

<body>
<div class="grid-container_2">
  <div class="Block_2_01"></div>
  <div class="Block_2_02">
    <div class="container-fluid">
	    <div class="row">
		<div class="col-md-12">
			<div class="row">

				<div class="col-md-8">
					<h3 class="text-info d-inline-block">
						Inventory Management. Click Button to add to inventory.
                    </h3>
            
		             <a id="modal-577590" href="#modal-container-577590" role="button" class="d-inline-block btn active btn-block btn-md btn-info" data-toggle="modal">Add Inventory</a>
    
				</div>
				<div class="col-md-4">
   
                    </div>
            </div>


			
			<div class="modal fade" id="modal-container-577590" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel">
								Modal title
							</h5> 
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-primary">
								Save changes
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
</div>
<div class="Block_2_03"></div>  
<div class="Block_2_04"></div>
  <div class="Block_2_05">
  <div class="container-fluid">
	    <div class="row">
				<div class="col-md-12">
                    Inside Bootstrap Column Inside CSS Grid The Table Goes here!
				</div>
            </div>
        </div>
    </div>
  <div class="Block_2_06"></div>
  <div class="Block_2_07"></div>
  <div class="Block_2_08"></div>
  <div class="Block_2_09"></div>
</div>
</body>
<script>
</script>
</html>
