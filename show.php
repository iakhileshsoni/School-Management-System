<?php
	include('checklogin.php');
?>

<?php
	$id = $_SESSION['id']; //It will be used to delete specific student's record that is logged-in
	if(empty($_SESSION['email']))
	{
		header("location:login.php");
	}
?>

<!DOCTYPE html>
<html>

	<head>

		<title> Student Information </title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="icon" type="image/ico" href="images/bridge.jpg" />
	   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	  	<style type="text/css">
	  		
	  		html,body{
				height: 100%;
				margin: 0;
				background: rgb(2,0,36);
	            background: linear-gradient(90deg, skyblue, skyblue, skyblue);
			}
			/*h2{
				color: green;
				text-align: left;
				padding-left: 10px;
			}*/
			th{
				color: red;
			}
			td{
				color: grey;
			}
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
				<p style="color: blue;"> Welcome  <span style="color:blue;"><?php echo ucfirst($_SESSION['name']); ?></span>
				</p>
	        </div>        
	    </div>
		<!-- <h2><?php echo 'Hello ' . $_SESSION['name'];?></h2> -->
		<div class="pull-right" style="padding: 0 15px 10px 0;" >
		    <a class="ovr-button" href="display.php"> Go Back </a>
		</div>

		<table class="table table-hover">
			<tr>
				<th> Name </th>
				<th> Email </th>
				<th> Mobile </th>
				<th> Father </th>
				<th> Date of Birth </th>
			</tr>
			<?php 
				
				include "database.php";
				$sql = " SELECT * FROM student_tbl WHERE id = '" . $id . "' ";
				// echo $sql;exit();
				$result = mysqli_query($conn, $sql);
				if($result)
				{
					$count = mysqli_num_rows($result);
					if($count == 1)
					{
						$row = mysqli_fetch_assoc($result);
						$_SESSION['name'] = $row['name'];
					?>
					<tr>
						<td> <?php echo $row['name']; ?> </td>
						<td> <?php echo $row['email']; ?> </td>
						<td> <?php echo $row['mobile']; ?> </td>
						<td> <?php echo $row['father']; ?> </td>
						<td> <?php echo $row['dob']; ?> </td>
					</tr>
					<?php
					}
				}
			?>
		</table>

	</body>

</html>