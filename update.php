<?php
	session_start();
	$id = $_SESSION['id']; //It will be used to delete specific student's record that is logged-in
	if(empty($_SESSION['email']))
	{
		header("location:login.php");
	}
?>

<?php

	extract($_POST);

	include "database.php";

	$qry = " SELECT * FROM student_tbl WHERE id = '" . $id . "' ";
	// print_r($qry);die();
	$result = mysqli_query($conn, $qry) or die(mysqli_error($conn));
	$rows = mysqli_fetch_assoc($result);
	$image = $rows['image'];
	// echo $image;die();
	// print_r($rows);die();
	if(isset($_FILES['image']))
	{
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$arr = explode(".", $file_name);
		$ext = strtolower(end($arr));
		$allowed_types = array('jpg', 'jpeg', 'png', 'img', 'webp');
		$res = true;
		if(!in_array($ext, $allowed_types))
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
				
				$conn = mysqli_connect("localhost", "root", "", "akhilesh");
				if(!$conn)
				{
					die('Could not Connect MySql:' . mysqli_error($conn));
				}
				if(count($_POST) > 0) 
				{
					date_default_timezone_set("Asia/Calcutta"); 
					$name = $_POST['name'];
					$uname = $_POST['uname'];
					$email = $_POST['email'];
					$mobile = $_POST['mobile'];
					$dob = $_POST['dob'];
					$updated_date = date('Y-m-d');
					$file_name = "upload/" . $_FILES['image']['name'];
					// $date = date('d-m-Y');
					$upd = "UPDATE student_tbl SET name = '" . $name . "', 
					username = '" . $uname . "', email = '" . $email . "' , mobile = 
					'" . $mobile . "', dob = '" . $dob . "', image = '" . $file_name . "',  
					updated_date = '" . $updated_date . "' WHERE id = '" . $id . "'";
					$rs = mysqli_query($conn, $upd) or die(mysqli_error($conn));
					if($rs)
					{
						echo "Data has been Updated";
						header("location:display.php");
					}
					else
					{
						echo "Sorry Data has not been Updated";
					}
				}
			}
		}
	}		
	
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Update Student Record | School Management System</title>
		<link rel="icon" type="image/ico" href="images/bridge.jpg" />
		<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script>
			$(function()
			{
				$("#datepicker").datepicker();
			});
		</script>

		<style type="text/css">
			* {
				box-sizing: border-box;
			}

			html, body {
				height: 100%;
			}

			body{
				background-color: #f1f1f1;
				text-align: center;
				box-shadow: 0 0 0px 5px rgba(0,0,0,0.1);
			}

			/* Add background image in the form */
			.bg-img {
				background-image: url("images/bridge.jpg");
				height: 850px;
				/* Center and scale the image nicely */
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
			}

			form{
			    padding: 0 0 6px;
			    margin: auto;
			    width: 600px;
			    border-radius: 35px;
			}

			/* Formatting for form */
			.container{
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

			p{
				color: lightgreen;
				font-size: 15px;
			}

			h2{
				color: pink;
				font-size: 35px;
				font-family: Times New Roman;
				text-align: center;
				padding: 20 0 20px;
			}

			.input_fields{
				font-family: Times New Roman;
				font-size: 19px;
				padding: 5px 30px;
				text-align: left;
				text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
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

			#submit{
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

			#submit:hover{
				background-color: green;
			}

			/* For Google Map */
			.mapouter{
			    position: relative;
			    text-align: right;
			    height: 300px;
			    width: 100%;
			}
			        
			.gmap_canvas{
			    overflow: hidden;
			    background: none!important;
			    height: 300px;
			    width: 100%;
			    border: 1px solid green;
			}
		</style>

	</head>

	<body>

		<div class="bg-img">

			<form name="frmUser" method="post" action="" enctype="multipart/form-data"
			class="container" >

				<div class="content">

					<h2> Edit the profile of Student </h2><hr>

					<div class="input_fields">
						Name : <input type="text" name="name" id="name" required="" 
						value="<?php echo $rows['name']; ?>">                       
					</div>

					<div class="input_fields">
						Username : <input type="text" name="uname" id="uname" required="" 
						value="<?php echo $rows['username']; ?>">                       
					</div>

					<div class="input_fields">
						Email : <input type="email" name="email" id="email" required=""
						value="<?php echo $rows['email']; ?>">
					</div>

					<div class="input_fields">
						Mobile : <input type="text" name="mobile" id="mobile" required=""
						value="<?php echo $rows['mobile']; ?>">
					</div>

					<div class="input_fields">
						Image : <img src="<?php echo $image; ?>" height='80px;' width='120px;'><input type="file" name="image" id="image" value="<?php echo $image; ?>">
					</div>

					<div class="input_fields">
						Date of Birth : <input type="text" name="dob" id="datepicker" 
						value="<?php echo $rows['created_date']; ?>">
					</div>

					<div class="input_fields">
						<input type="submit" name="edit" value="Update" id="submit">
					</div>

				</div>

			</form>

		</div>

		<div class="mapouter">
	        <div class="gmap_canvas">
	            <iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=c21%20mall%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
	            </iframe> Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
	        </div>
    	</div>

	</body>

</html>



<!-- <?php
	session_start();
	$conn = mysqli_connect("localhost", "root", "", "akhilesh");
	if(!$conn)
	{
		die('Could not Connect My Sql:' . mysqli_error($conn));
	}
	if (isset($_SESSION['username']))
	{
		$id = $_SESSION['id'];
		$file_name = "upload/" . $_FILES['image']['name'];
		
		if(file_exists($file_name))
		{
			echo "file alredy exists,please rename and upload again";
			$fileUpload=0;
		}
		if($imageType!='jpg' && $imageType!='gif' && $imageType!='png')
		{
			echo "image should be in jpg or gif or png format";
			$fileUpload=0;
		}
		if($fileUpload!=1)
		{
			echo "please try again with valid document";
		}
		else
		{
		    $copied = move_uploaded_file($_FILES['uploads']['tmp_name'], $file_name);
		    if ($copied) 
		    {
		        $sql = mysql_query("UPDATE users SET image='$file_name' WHERE username='$id'");
		       echo "succesfull updated";
		       echo "to go back home page<a href='homeprofile.php'>Click Here</a>";
		    }
		    else 
		    {
		        echo "There are An Errors In Uploading!";
		    }
		}
	}

?>


<?php
session_start();
require('connect.php');
if(isset($_SESSION['username']))
{
	$file_name = "upload/" . $_FILES['image']['name'];
	$fileUpload=1;
	$imageType=pathinfo($file_name,PATHINFO_EXTENSION);
 	$image= addslashes(file_get_contents($_FILES['uploads']['tmp_name']));
  	$image_name = addslashes($_FILES['uploads']['name']);
    $image_size = getimagesize($_FILES['uploads']['tmp_name']);

	if(move_uploaded_file($_FILES['uploads']['tmp_name'], $file_name))
	{
		echo "uploaded succesfully" ;
		echo "<img src='$file_name' width='50px' height='50px'>";

		$querry = "SELECT image FROM users WHERE username = '$username'" or die(mysql_error());
		$result = mysql_query($querry) or die(mysql_error());
		$row = mysql_fetch_assoc($result) or die(mysql_error());

		$oldimage = $row['image'];
		unlink('directory/image/'.$oldimage);
		
		if(!get_magic_quotes_gpc())
		{
		    $fileName = addslashes($file_name);
		}
		$sql = "UPDATE users SET image = '$fileName' WHERE image = '$oldimage'";
		$result = mysql_query($sql) or die(mysql_error());

		if($result)
		{
			echo "created successfully";
			echo "<br>";
			echo "<a href='homeprofile.php'>Go back to home page</a>";
		}
		else
		{
			echo "can't create";
		}
	}
}

?> -->