
<?php
 // if(isset($_POST['register']))  OR 
	if(isset($_FILES['image']))
	{
		// echo "Hiiiii";die();
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$arr = explode(".", $file_name); // Array ( [0] => akki [1] => png )
		$ext = strtolower(end($arr)); // png (based on file extension)
		$allowed_types = array('jpg', 'jpeg', 'png', 'img', 'webp', 'gif');
		$res = true;

		if(!in_array($ext, $allowed_types)) // search image extention into array i.e. $allowedtypes
		{
			$res = false;
			echo " Invalid File ";
		}
		if($file_size > 2097152)
		{
			$res = false;
			echo " File should be less than 2MB ";
		}
		if($res)
		{
			
			if(move_uploaded_file($file_tmp, "upload/" . $file_name))
			{
				include "database.php";
				extract($_POST);

				date_default_timezone_set("Asia/Calcutta"); 
				// $name = trim($_POST['name']);
				$role = $_POST['role'];
				$name = mysqli_real_escape_string($conn, $_POST['name']);
				$uname = mysqli_real_escape_string($conn, $_POST['uname']);
				$cities = trim($_POST['cities']);
				// $city = trim($_POST['city']);
				$email = trim($_POST['email']);
				$password = $_POST['password'];
				// $cpassword = $_POST['cpassword'];
				// date coming from registration form
				$dob = $_POST['dob'];
				$timestamp = strtotime($dob);
				$new_dob = date("Y-m-d", $timestamp);

				$gender = $_POST['gender'];
				$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
				$fname = mysqli_real_escape_string($conn, $_POST['fname']);
				$file_name = "upload/" . $_FILES['image']['name'];
				$created_date = $_POST['created_date'];
				$timestamp2 = strtotime($created_date);
				$new_created_date = date("Y-m-d H:i:s", $timestamp2);

				$qry = " SELECT * FROM student_tbl WHERE email = '".$email."' AND 
				name = '".$name."' AND father = '".$fname."' AND dob = '".$dob."' ";
	            $res = mysqli_query($conn, $qry);
	            $count = mysqli_num_rows($res);
	            if($count>0)
	            {
	                echo " <h2> Duplicate Values are not Allowed</h2> ";
	            }
	            else
	            {
					$sql = "INSERT INTO student_tbl(name, username, gender, city, email, password, 
					role, dob, mobile, father, image, created_date) 
					VALUES('$name', '$uname', '$gender', '$cities', '$email', '".md5($password)."', 
					'2', '$new_dob', '$mobile', '$fname', '$file_name', '$new_created_date')";

					$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					if($result)
					{
						echo "<h2> Registration is Successfull </h2>";
					}
					else
					{
						echo " Sorry! There was an error in Query ";
					}
				}
			}
			else
			{
				echo "Image is not moved to the temporary folder for backup";
			}
		}
		else
		{
			echo " Image is not inserted ";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Give the name for title bar -->
		<title> Registration Form | School Management System </title>
		<!-- Put the Ico to the Title Bar -->
		<link rel="icon" type="image/ico" href="images/bridge.jpg" />
		<!-- Add Style for the Registration Form -->
		<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
		<!-- Add the css library for the table tag -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Add the jQuery library for using datepicker -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script>
			$(function()
			{
				$("#datepicker").datepicker();
			});
			$(function()
			{
				$("#dob").datepicker();
			});
		</script>

		<style type="text/css">
			
			* {
				box-sizing: border-box;
			}

			html, body {
				height: 100%;
			}

			body {
				background-color: #f1f1f1;
				text-align: center;
				box-shadow: 0 0 0px 5px rgba(0,0,0,0.1);
			}

			/* Add background image in the form */
			.bg-img {
				background-image: url("images/listing.jpg");
				height: 1800px;
				/* Center and scale the image nicely */
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
			}

			form {
			    padding: 0 0 6px;
			    margin: auto;
			    width: 600px;
			    border-radius: 15px;
			}

			/* Formatting for form */
			.container {
				position: absolute;
				right: 0;
				margin: 13px;
				padding: 3px;
				position: right;
			}

			/* Add Transparent functionallity for an image text */
			.content {
				position: absolute;
				color: white;
				width: 100%;
				padding: 3px;
				background: rgb(0, 0, 0);
				background: rgba(0, 0, 0, 0.4);
				border-radius: 15px;
			}

			p {
				color: lightgreen;
				font-size: 15px;
			}

			h2 {
				color: pink;
				font-size: 35px;
				font-family: Times New Roman;
				text-align: center;
				padding: 20 0 20px;
			}

			.input_fields {
				font-family: Times New Roman;
				font-size: 19px;
				padding: 5px 30px;
				text-align: left;
				text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
				background-image: linear-gradient(to left, rgba(150,0,0,0), cadetblue);
			}

			input[type=text],
			input[type=email],
			input[type=password],
			select {
			  	width: 100%;
			  	padding: 10px 30px;
			  	margin: 8px 0;
			  	display: inline-block;
			  	border: 1px solid grey;
			  	border-radius: 4px;
			  	box-sizing: border-box;
			  	font-family: Times New Roman;
				font-size: 19px;
				background-color: lightgrey;
			}

			input[type=file] {
				width: 100%;
			  	padding: 10px 20px;
			  	margin: 8px 0;
			  	color: green;
			  	display: inline-block;
			  	border: 1px solid grey;
			  	border-radius: 4px;
			  	box-sizing: border-box;
			  	background-color: lightgrey;
			}

			input[type=text]:focus, 
			input[type=email]:focus,
			input[type=file]:focus,
			input[type=password]:focus,select:focus {
			  	/*background-color: #ddd;*/
			  	outline: none;
			  	background-image: linear-gradient(to left, rgba(150,0,0,0), lightblue);
			}

			#submit {
				font-size: 20px;
				color: white;
				margin: 8px 0;
				overflow: hidden;
				cursor: pointer;
				padding: 10px 15px;
				width: 100%;
				border: none;
				border-radius: 4px;
			  	background-color: #4CAF50;
			}

			#submit:hover {
				background-color: green;
			}

			span {
				color: white;
				font-size: 20px;
			}

			#login, a {
				color: grey;
				padding: 10px;
				font-size: 20px;
			}

			a:hover {
				color: green;
			}

			/* For Google Map */
			.mapouter {
			    position: relative;
			    text-align: right;
			    height: 300px;
			    width: 100%;
			}
			        
			.gmap_canvas {
			    overflow: hidden;
			    background: none!important;
			    height: 300px;
			    width: 100%;
			    border: 1px solid green;
			}
			.register {
				background-image: linear-gradient(rgba(150,0,0,0), steelblue, rgba(150,0,0,0));
			}

			.box{
				font-size: 19px;
		        color: grey;
		        /*padding: 20px;*/
		        display: none;
		        /*margin-top: 20px;*/
		    }
		    /*.red{ background: grey; }
		    .green{ background: grey; }
		    .blue{ background: white; }*/

			/*Style for designing of alert box */
			/*#confirm {
            display: none;
            background-color: #F3F5F6;
            color: #000000;
            border: 1px solid #aaa;
            position: fixed;
            width: 300px;
            height: 100px;
            left: 40%;
            top: 40%;
            box-sizing: border-box;
            text-align: center;
         	}
         	#confirm button {

         	   background-color: #FFFFFF;
         	   display: inline-block;
         	   border-radius: 12px;
         	   border: 4px solid #aaa;
         	   padding: 5px;
         	   text-align: center;
         	   width: 60px;
         	   cursor: pointer;
         	}
         	#confirm .message {
         	   text-align: left;
         	}*/

		</style>

	</head>

	<body>
		<!-- Add background image into the Student's Registration Form -->
		<div class="bg-img">
			<!-- container Class for taking the form fields -->
			<form method="post" name="registration" action="" enctype="multipart/form-data" 
				class="container" onsubmit="return validateForm()">

				<div class="content">

					<div class="register">
						<h2> Registration Form of a Student </h2><hr>
						<p> <span style="color: red"> * </span>  Required Field </p>
					</div>

					<div class="input_fields">
						<label for="role"></label><input type="hidden" name="role" id="role">
					</div>

					<div class="input_fields">
						<!-- <i class="fas fa-user-graduate"></i> -->
						Name : <input type="text" name="name" id="name" placeholder="Enter Your Name" pattern="[A-Za-z ]+$" >
					</div><br>

					<div class="input_fields">
						Username : <input type="text" name="uname" id="uname" placeholder=" Enter Username" pattern="[A-Za-z0-9_]+$" >
					</div><br>

					<div class="input_fields">
						<label for="Gender"> Gender : </label>
						<select name="gender" id="gender">
							<option selected=""> Select Gender </option>
							<option> Male </option>
							<option> Female </option>
						</select>
					</div><br>

					<div class="input_fields">
				    	<label for="cities"> City : </label>
				        <select name="cities">
				            <option selected="" name="cities">Choose City</option>
				            <option value="Agra"> Agra </option>
				            <option value="Bangalore"> Bangalore </option>
				            <option value="Bhopal"> Bhopal </option>
				            <option value="Hyderabad"> Hyderabad </option>
				            <option value="Indore"> Indore </option>
				            <option value="Mumbai"> Mumbai </option>
				            <option value="Varanasi"> Varanasi </option>
				            <option>Other</option>
				        </select>
				    </div><br>
				    <div class="input_fields">
				    	Add Other City : <input type="text" class="blue box" name="city">
				    </div><br>		    

					<div class="input_fields">
						Date of Birth : <input type="text" name="dob" id="dob" placeholder="Enter Date of Birth">
					</div><br>

					<div class="input_fields">
						<!-- <i class="fas fa-at"></i> -->
						Email : <input type="email" name="email" id="email" placeholder="Enter Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
					</div><br>

					<div class="input_fields">
						Password : <input type="password" name="password" id="password" placeholder="Create Password" >
					</div><br>

					<div class="input_fields">
						Confirm Password : <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" >
					</div><br>

					<div class="input_fields">
						<!-- <i class="fas fa-phone-square"></i> -->
						Mobile : <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" pattern="[6789][0-9]{9}" >
					</div><br>

					<div class="input_fields">
						Father : <input type="text" name="fname" id="fname" placeholder="Enter Father's Name" pattern="[A-Za-z ]+$" >
					</div><br>

					<div class="input_fields">
						Image : <input type="file" name="image" id="image" placeholder="Choose your image" >
					</div><br>

					<div class="input_fields">
						Date : <input type="text" name="created_date" id="datepicker" placeholder="Enter Date" >
					</div><br>

					<div>
						<input type="submit" name="register" value="Register" id="submit">
					</div>

					<!-- Put designing for alert box -->
					<!-- <div id="confirm">
			         	<div class="message">This is a warning message.</div><br>
			         	<button class="yes">OK</button>
			      	</div>
			      	<input type="button" value="Click Me" onclick="functionAlert();" /> -->


					<p id="login">
						<span> Already have an account ? </span><a href="login.php"  style="color:red; text-decoration: none;"> Login here </a>
					</p>
				</div>
				<!-- To add button <i class="fas fa-plus-circle"></i> -->
				<!-- To remaove <i class="fas fa-trash-alt"></i> -->

			</form>
			
		</div><br><br>

		<!-- Add Google Map to the Website with specified location -->
		<div class="mapouter">
		    <div class="gmap_canvas">
		        <iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=c21%20mall%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
		        </iframe> Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
		    </div>
	    </div>

	</body>

	<!-- Create our own custom alert box with designing -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
       	function functionAlert(msg, myYes) {
       	   	var confirmBox = $("#input_fields");
       	   	confirmBox.find(".message").text(msg);
       	   	confirmBox.find(".yes").unbind().click(function() {
       	   	   confirmBox.hide();
       	   	});
       	   	confirmBox.find(".yes").click(myYes);
       	   	confirmBox.show();
       	}
    </script> -->

<!-- Script for Form Validation -->
	<script type="text/javascript">

		function validateForm(){
			var name = document.forms["registration"]["name"].value;
			var uname = document.forms["registration"]["uname"].value;
			var dob = document.forms["registration"]["dob"].value;
			var email = document.forms["registration"]["email"].value;
			var password = document.forms["registration"]["password"].value;
			var cpassword = document.forms["registration"]["cpassword"].value;
			var mobile = document.forms["registration"]["mobile"].value;
			var fname = document.forms["registration"]["fname"].value;
			var image = document.forms["registration"]["image"].value;

			if(name == "")
			{
				// onclickn="return confirm('Are you sure to Delete the Record')";
				confirm("Please fill Name");
				return false;
			}
			else if(uname == "")
			{
				confirm("Please fill Username");
				return false;
			}
			else if(dob == "")
			{
				confirm("Please fill Date of Birth");
				return false;
			}
			else if(email == "")
			{
				confirm("Please fill Email");
				return false;
			}
			else if(password == "")
			{
				confirm("Please fill Password");
				return false;
			}
			else if(cpassword == "")
			{
				confirm("Please fill Confirm Password");
				return false;
			}
			else if(password != cpassword)
			{
				confirm("Please Match Password");
				return false;
			}
			else if(mobile == "")
			{
				confirm("Please fill Mobile");
				return false;
			}
			else if(fname == "")
			{
				confirm("Please fill Father Name");
				return false;
			}
			else if(image == "")
			{
				confirm("Please fill Image");
				return false;
			}
			else
			{
				return true;
			}
		}
		
	</script>

<!-- Script for adding input field for City in Select Box -->
<script type="text/javascript">

	$(document).ready(function()
	{
	    $("select").change(function()
	    {
	        $(this).find("option:selected").each(function()
	        {
	            var optionValue = $(this).attr("value");
	            if(optionValue)
	            {
			        $(".box").not("." + optionValue).hide();
			        $("." + optionValue).show();
			    } 
			    else
		        {
		            $(".box").hide();
				}
			});
		}).change();
	});

</script>

</html>
	<!-- <button onclick="JSalert()">Show an Alert</button>
	<script type="text/javascript">
		function JSalert()
		{
			swal({   title: "Your account will be deleted permanently!",   
		    text: "Are you sure to proceed?",   
		    type: "warning",   
		    showCancelButton: true,   
		    confirmButtonColor: "#DD6B55",   
		    confirmButtonText: "Yes, Remove My Account!",   
		    cancelButtonText: "No, I am not sure!",   
		    closeOnConfirm: false,   
		    closeOnCancel: false }, 
		    function(isConfirm)
		    {   
		        if (isConfirm) 
		    	{   
		        	swal("Account Removed!", "Your account is removed permanently!", "success");   
		        } 
		        else 
		        {     
		            swal("Hurray", "Account is not removed!", "error");   
		        } 
		    });
		}
	</script> -->


