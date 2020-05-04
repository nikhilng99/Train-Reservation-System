<?php 
require_once('data/get_origin.php');
require_once('data/get_destination.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Online Ticket Rerservation</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">

	</head>
<body style="background-color: lightblue;">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Train Ticketing Reservation&nbsp&nbsp&nbsp</a>

  
	
    </div>
    <ul class="nav navbar-nav">
      <li class="active">
     </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
	<a class="navbar-brand" href="#">Welcome&nbsp<?php echo $_SESSION['username'];?>&nbsp&nbsp&nbsp</a>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div>
</nav>
</div>

<div class="container-fluid">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
			 <h2>
			 	<center>BOOKING</center>
			 </h2>
				<div class="container-fluid">
					<form class="form-horizontal" role="form" id="form-itinerary">
					  <div class="form-group">
					    <label for="">Origin:</label>
					    <select class="btn btn-default" id="orig-id">
					    <?php foreach($origins as $o): ?>
					    	<option value="<?= $o['origin_id']; ?>"><?= $o['origin_desc']; ?></option>
				    	<?php endforeach; ?>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="">Destination:</label>
					    <select class="btn btn-default" id="dest-id">
				    	<?php foreach($destinations as $d): ?>
					    	<option value="<?= $d['dest_id']; ?>"><?= $d['dest_destination']; ?></option>
				    	<?php endforeach; ?>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="">Departure Date:</label>
					    <input type="date" class="btn btn-default" id="dept-date" name="dateip">
							<!--?php $ndate= date('Y-m-d',strtotime($_POST['dateip']))
							 $d=date('Y-m-d');
							 if($ndate<$d){
								alert('Invalid date!');
								}	?-->
								<!--?php if($d['dest_destination']==$o['origin_desc'])
					  				alert('Choose different origin and destination');?-->
	

					  </div>
					 

					  <button type="submit" class="btn btn-success" >NEXT
					  
					  </button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>

<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).on('submit', '#form-itinerary', function(event) {
		event.preventDefault();
		var validate = "";
		var origin = $('select[id=orig-id]').val();
		var dest = $('select[id=dest-id]').val();
		var dept = $('input[id=dept-date]').val();

		if(dept.length == 0){
			alert('Please Select Departure Date!');
		}
			
		else{
			$.ajax({
					url: 'data/session_itinerary.php',
					type: 'post',
					dataType: 'json',
					data: {
						oid : origin,
						did : dest,
						dd : dept
					},
					success: function (data) {
						console.log(data);
						if(data.valid == true){
							window.location = data.url;
							console.log('sss');
						}
					
					},
					error: function(){
						alert('Error: L161+');
					}
				});
		}


	});

</script>

</body>
</html>