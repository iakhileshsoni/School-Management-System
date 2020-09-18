
<?php
	session_start();
	$id = $_SESSION['id']; //It will be used to delete specific student's record who is logged-in
	if(empty($_SESSION['email']))
	{
		header("location:login.php");
	}
?>

<?php

	//extract($_POST);
	if(isset($_POST['submit']))
	{

		$currentPassword = md5($_POST["currentPassword"]);
		$newPassword = md5($_POST["newPassword"]);
		$confirmPassword = md5($_POST['confirmPassword']);

		$conn = mysqli_connect("localhost", "root", "");
		mysqli_select_db($conn, "akhilesh");

		if($conn)
		{
			// SQL Injection Example
			// $sql = " SELECT username,pass FROM users WHERE username = '' OR ''='' AND
			// password = '' OR ''='' LIMIT 0, 1 ";
			$sql = " SELECT * FROM student_tbl WHERE id = '" . $id . "' ";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$count = mysqli_num_rows($result);
			if($count == 1)
			{
				$row = mysqli_fetch_assoc($result);
				$password = $row['password'];
				if($currentPassword == $password)
				{ echo "<li>".$newPassword ."==". $confirmPassword;die();
					 if($newPassword == $confirmPassword)
					{
						// echo "hi this is me";die();
					    $query = "UPDATE student_tbl set password = '" . $newPassword . "' WHERE
					    id = '" . $id . "'";
					    // echo $query;die();
					    $rs = mysqli_query($conn, $query) or die(mysqli_error($conn));
					    if($rs)
					    {
					    	header( "refresh:1; url=display.php" );
					    	echo "<h2> Password has been Changed </h2>";
						}
						else
						{
							echo "Password is not changed";
						}
					}
					else
					{
						echo "Confirm Password Mismatched";
					}
				}
				else
				{
				    $message = "Current Password is not correct";
				}
			}
		}
		else
		{
			echo "Database is not connected";
		}
	}

?>

<html>
	<head>
		<title>Change Password of Student</title>
		<!-- <link rel="stylesheet" type="text/css" href="styles.css" /> -->
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
				height: 750px;
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
				/*padding: 0 0 30px;*/
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

			.cpass {
				background-image: linear-gradient(rgba(150,0,0,0), steelblue, rgba(150,0,0,0));
			}

		</style>
	</head>

	<body>

		<div class="bg-img">

			<form name="frmChange" method="post" action="" onSubmit="return validatePassword()"
				class="container">

				<div class="content">

					<div class="cpass">
						<h2>Change Password</h2>
					</div>

					<div class="input_fields">
						Current Password: <input type="password" id="currentPassword"
						name="currentPassword" class="txtField" />
					</div>
					<div class="input_fields">
						New Password : <input type="password" id="newPassword"
						name="newPassword" class="txtField" />
					</div>
					<div class="input_fields">
						Confirm Password : <input type="password" id="confirmPassword"
						name="confirmPassword" class="txtField "/>
					</div>
					<div class="input_fields">
						<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
					</div>

				</div>

			</form>

		</div>

	</body>

	<script>

		function validatePassword()
		{
			var currentPassword, newPassword, confirmPassword, output = true;

			currentPassword = document.frmChange.currentPassword;
			newPassword = document.frmChange.newPassword;
			confirmPassword = document.frmChange.confirmPassword;

			if(!currentPassword.value)
			{
				currentPassword.focus();
				document.getElementById("currentPassword").innerHTML = "required";
				output = false;

			}
			else if(!newPassword.value)
			{
				newPassword.focus();
				document.getElementById("newPassword").innerHTML = "required";
				output = false;
			}
			else if(!confirmPassword.value)
			{
				confirmPassword.focus();
				document.getElementById("confirmPassword").innerHTML = "required";
				output = false;
			}
			if(newPassword.value != confirmPassword.value)
			{
				//newPassword.value="";
				//confirmPassword.value="";
				newPassword.focus();
				document.getElementById("confirmPassword").innerHTML = "Not Same";
				output = false;
			}
			alert(output);
			return output;
		}
	</script>

</html>
