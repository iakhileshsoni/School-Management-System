<?php
	session_start();

	if(empty($_SESSION['email']))
	{
		header('location:login.php');
	}
?>


<!DOCTYPE html>
<html>

	<head>
		<title> School Management System </title>
		<link rel="icon" type="image/ico" href="images/bridge.jpg" />

		<style type="text/css">
			h2{
				color: green;
				font-size: 45px;
				font-family: Times New Roman;
				text-align: center;
				padding: 0 0 30px;
			}
			body{
				background-color: #f1f1f1;
				text-align: center;
			}
			#submit{
				font-size: 15px;
				color: blue;
				margin: auto;
				overflow: hidden;
				cursor: pointer;
				padding: 5px 10px;
			}
			#submit:hover{
				background-color: lightgrey;
			}
			.mapouter{
          		position:relative;
          		text-align:right;
          		height:300px;
          		width:100%;
          	}
        	.gmap_canvas{
          		overflow:hidden;
          		background:none!important;
          		height:300px;
          		width:100%;
        	}
		</style>

	</head>

	<body>

		<button class="btn btn-primary" id="submit"><a href="use.php">Logout</a></button>

		<h2> Welcome... You are Logged in successfully </h2>

		<div class="mapouter">
	        <div class="gmap_canvas">
	            <iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=c21%20mall%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
	            </iframe>Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
	        </div>
    	</div>

	</body>

</html>