<?php

// date_default_timezone_set("Asia/Calcutta");
// print_r(getdate());die();
	session_start();
	// error_reporting(0); // It will hide all the errors which are coming during execution
	error_reporting(E_ALL); // It will display all the errors which are coming during execution
	extract($_POST);
    if(isset($login))
	{
		include "database.php";
		date_default_timezone_set("Asia/Calcutta");

		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		// $remember = mysqli_real_escape_string($conn, $_POST['remember']);
		$login_date = date('Y-m-d H:i:s');
		$sql = " SELECT * FROM student_tbl WHERE (username = '" . $email . "' OR
		email = '" . $email . "') AND password = '" . md5($password) . "' ";
			// var_dump($sql);die();
			// var_dump will show the query with string count also here is string(110)
			// $sql = " SELECT * FROM student_tbl WHERE email = '$email' AND password = '$password' ";

		$result = mysqli_query($conn, $sql) or mysqli_error($conn);
		$count = mysqli_num_rows($result);
		if($count == 1)
		{
			$row = mysqli_fetch_assoc($result);
			// echo $row['role'];die();
			$_SESSION['id'] = $row['id'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['start'] = time();
		   	$_SESSION['expire'] = $_SESSION['start'] + (600); // Logout after 10 Min automatically

			$qry = " UPDATE student_tbl SET login_date_time = '".$login_date."' ,
			login_num = login_num+1 WHERE id = '" . $_SESSION['id'] . "' ";
			$rs = mysqli_query($conn, $qry) or die(mysqli_error($conn));
			if($row['role'] == 1) // Jump to Admin Page after admin login
			{
	           	header('location:display.php', 'refresh');
			}
	        else // Jump to User Page after user login
	        {
	           	header('location:datatable.php', 'refresh');
	       	}

	    }
	    else
		{
			echo '<h2 style="text-align:center;color:red;"> Invalid Login Credentials </h2>';
		}

	}

?>

<!DOCTYPE html>
<html>

	<head>

		<title> Login Form | School Management System </title>
		<!-- This link will add an image in the title bar -->
		<link rel="icon" type="image/ico" href="images/bridge.jpg" />

		<style type="text/css">

			* {
				box-sizing: border-box;
			}

			html, body {
				height: 100%;
			}

			body {
				background-color: lightgrey;
				text-align: center;
				box-shadow: 0 2px 4px 1px rgba(0,0,0,0.16);
			}

			/* Add background image in the form */
			.bg-img {
				background-image: url("images/listing_8.jpg");
				height: 730px;
				/* Center and scale the image nicely */
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
			}

			h2 {
				color: orchid;
				font-size: 35px;
				font-family: Times New Roman;
				text-align: center;
				padding: 20 0 20px;
			}

			form {
			    padding: 0 0 6px;
			    margin: auto;
			    width: 600px;
			    border-radius: 5px;
			}

			.container {
				position: absolute;
				right: 0;
				margin: 20px;
				position: right;
				padding: 5px;
				max-width: 500px;
			}

			/* Add Transparent functionallity for an image text */
			.content {
				position: absolute;
				color: white;
				/*width: 600px;*/
				border-radius: 15px;
				padding: 20px;
				background: rgb(0, 0, 0);
				background: rgba(0, 0, 0, 0.5);
			}

			input[type=text],
			input[type=password] {
			  	width: 100%;
			  	padding: 10px 30px;
			  	margin: 8px 0;
			  	display: inline-block;
			  	border: 1px solid grey;
			  	border-radius: 4px;
			  	box-sizing: border-box;
			  	font-family: Times New Roman;
				font-size: 19px;
				background-color: #f1f1f1;
			}

			input[type=text]:focus,
			input[type=password]:focus {
			  	/*background-color: #ddd;*/
			  	outline: none;
			  	background-image: linear-gradient(to left, rgba(150,0,0,0), steelblue);
			}

			.input_fields {
				font-family: Times New Roman;
				font-size: 19px;
				padding: 30px 30px;
				text-align: left;
				width: 100%;
				background-image: linear-gradient(to left, rgba(150,0,0,0), cadetblue);
			}

			#submit {
				font-size: 20px;
				color: white;
				margin: 8px 0;
				overflow: hidden;
				cursor: pointer;
				padding: 10px 20px;
				width: 100%;
				font-size: 20px;
				border: none;
				border-radius: 4px;
				background-color: #4CAF50;
			}

			#submit:hover {
				background-color: green;
			}

			.login {
				background-image: linear-gradient(rgba(150,0,0,0), steelblue, rgba(150,0,0,0));
			}

		</style>

	</head>

	<body>

		<div class="bg-img">

			<form method="post" action="" name="form" class="container">

				<div class="content">
					<div class="login">
						<h2> Login Form </h2><hr>
					</div>

					<div class="input_fields">
						<label> Username / Email : </label><input type="text" name="email"
						id="txtEmail" placeholder="Enter Email or Username" required="" >
					</div>
					<div class="input_fields" style="padding-bottom: 10px;">
						<label> Password : </label><input type="password" name="password" id="pass" placeholder="Enter Password" required="">
					</div>
					<div class="input_fields" style="padding-bottom: 10px;">
						<label for="remember">
                            <input type="checkbox" name="remember" id="remember" value="1" /> Remember me
                        </label>
					</div>
					<div class="input_fields">
						<input class="btn btn-primary" type="submit" id="submit" name="login"
						value="Login" onclick="ValidateEmail();">
					</div>

					<p><a href="forgot_pass.php" style="color: pink;">Forgot Password</a></p>

				</div>

			</form>

		</div>

	</body>

	<script type="text/javascript">

		function ValidateEmail()
		{
			var empt = document.form["form"]["email"].value;
			// var pass = document.forms["form"]["pass"].value;
			var email = document.getElementById('txtEmail');
			var mailformat =  /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/ ;
			if (empt === "")
			{
				alert("Please Fill All the Fields First");
				return false;
			}
			else if(!email === "")
			{
				if(!mailformat.test(email.value))
				{
					alert("You have Entered an Invalid Email Address!");
					// email.focus;
					return false;
				}
				else
				{
					return true;
				}
			}
		}
	</script>

</html>
