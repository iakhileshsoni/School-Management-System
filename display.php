
<?php
// session_start();
include('checklogin.php');
?>

<!DOCTYPE html>
<html>

<head>
	<!-- <meta http-equiv="refresh" content="120" > -->
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title> Dashboard | Student Record </title>
  	<!-- Add image/icon for title bar  -->
  	<link rel="icon" type="image/ico" href="images/bridge.jpg" />

  	<!-- Add Bootstrap CDN for Table  -->
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">

  	<!-- Add Datatable CSS File -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- Add CSS Style for Document -->
  	<style type="text/css">

  		html,body{
			height: 100%;
			margin: 0;
			/*background: rgb(2,0,36);
            background: linear-gradient(90deg, dodgerblue, skyblue, dodgerblue);*/
		}
		th{
			color: red;
			font-size: 20px;
		}
		td{
			color: grey;
			font-size: 17px;
		}
		img{
  			height: 80px;
  			width: 120px;
  			border-radius: 5px;
  			font-weight: 10px;
  		}
  		#logout{
  			padding: 6px 20px 6px 20px;
  			font-size: 15px;
  			border-radius: 5px;
  		}
  		/* Style for Buttons : Logout, Change Password, Create New Student */
		a.ovr-button:hover {
		    background-color: transparent!important;
		}
		a.ovr-button {
		    background-color: #06d8a0;
		}
		a:hover, a:active {
		    outline: 0;
		}
		a, a:visited, a:hover, a:active {
		    text-decoration: none;
		}
		.ovr-button {
		    position: relative;
		    display: inline-block;
		    font-size: 14px;
		    line-height: 24px;
		    font-weight: 700;
		    padding: 10px 30px;
		    background-color: #06d8a0;
		    border: 1px solid #06d8a0;
		    color: #fff;
		    -webkit-border-radius: 30px;
		    -moz-border-radius: 30px;
		    -o-border-radius: 30px;
		    border-radius: 30px;
		    -webkit-transition: all 0.3s;
		    -moz-transition: all 0.3s;
		    -ms-transition: all 0.3s;
		    -o-transition: all 0.3s;
		    transition: all 0.3s;
		}
		a {
		    color: #414141;
		    text-decoration: none;
		    outline: none;
		    background-color: transparent;
		    -webkit-transition: all 0.2s linear;
		    -moz-transition: all 0.2s linear;
		    -o-transition: all 0.2s linear;
		    -ms-transition: all 0.2s linear;
		    transition: all 0.2s linear;
		}
		#ProfileOptions{
			color: darkgrey;
			margin: 10px;
			font-weight: 600;
			font-size: 16px;

		}
		#image{
			height: 100px;
			width: 140px;
		}

  	</style>
</head>

<body>

	<div id="LeftCol">
		<div id="ProfileOptions">
			<a href="images/akhil.jpg"><img src="images/akhil.jpg" id="image"></a>
			<p style="color: lightblue;"> Welcome  <span style="color:lightblue;"><?php echo ucfirst($_SESSION['name']); ?></span></p>
        </div>
    </div>

	<div class="bg-img">

		<p style="text-align: center; padding-top: 5px;">
		    <span class="pull-left" style="padding: 0 0 20px 10px">
				<a href="logout.php" class="ovr-button"> Logout </a>
			</span>
		    <span class="pull-right" style="padding-right: 10px;">
		    	<a class="ovr-button" href="upload.php"> Create New Student </a>
		    </span>
		    <span class="pull-right" style="padding-right: 20px;">
		    	<a class="ovr-button" href="change_pass.php"> Change Password </a>
		    </span>
		</p><br>

		<table id="example" class="table table-hover" style="width:100%">

			<thead>
				<tr>
					<th>S.N.</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Father</th>
					<th>Image</th>
					<th>Date</th>
					<th>Action</th>
					<th>Action</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

					include "database.php";
					$id = $_SESSION['id'];
					$sql = " SELECT * FROM student_tbl WHERE id = '" . $id . "' AND status = '0'";
					//  WHERE id = '" . $id . "' AND status = '0'
					// echo $sql;die();
					$result = mysqli_query($conn, $sql) OR die(mysqli_error($conn));
					$count = mysqli_num_rows($result);
					if($count > 0)
					{
						$i = 1;
						while($row = mysqli_fetch_assoc($result))
						{
							// print_r($row);die();
							$_SESSION['id'] = $row['id'];
							$_SESSION['name'] = $row['name'];
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['username'];?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['mobile'];?></td>
								<td><?php echo $row['father'];?></td>
								<td>
									<img src="<?php echo $row['image'];?>" alt="<?php echo
									$row['image'];?>" title="<?php echo	$row['image']; ?>"
									style="height: 80px;width: 100px;">
								</td>
								<td><?php echo $row['created_date'];?></td>
								<td>
									<a href="show.php?id=<?php echo $row['id']; ?>"
									class="ovr-button" style="border: 1px solid lightblue;
									background-color: lightblue;" > Show </a>
								</td>
								<td>
									<a href="delete.php?id=<?php echo $row['id']; ?>"
										onclick="return confirm('Are you sure to Delete the Record'
										)" class="ovr-button" style="border: 0.6px solid red;
										background-color: red;" > Delete </a>
								</td>
								<td>
									<a href="update.php?id=<?php echo $row['id']; ?>"
										class="ovr-button" style="border: 1px solid lightgreen;
										background-color: lightgreen;" > Edit </a>
								</td>

									<!-- <td>
										<input type="image" name="enabled" value="<?php echo $enabled; ?>" src="status-toggle_<?php if ($enabled == '1') { echo 'enabled'; } else {echo 'disabled';}?>.png " />
		      						</td> -->
							</tr>
						<?php
						$i++;
						}
					}
					else
					{
						echo "<b style='color:red; font-size:15px;'> No Record Found... </b>";
					}

				?>
			</tbody>

		</table>

	</div>

</body>

	<!-- Add Datatable Javascript File -->
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#example').DataTable({
	            "columnDefs": [
	                {
	                    "targets": [ 2 ],
	                    "visible": true, // If false, It will hide the 2nd column which is in the database (for this example gender)
	                    "searchable": false
	                },
	                {
	                    "targets": [ 3 ],
	                    "visible": true
	                }
	            ]
	        });
	    });
	</script>

	<script type="text/javascript">
		setTimeout(function() {
		location.reload();
		}, 120000);
	</script>

	<!-- <script>
		$.ajax({
		  	url: 'display.php',
		  	success: function(data) {
		    	if (data == "refresh"){
		      		window.location.reload();
		    	}
		  	}
		});
	</script> -->

</html>
