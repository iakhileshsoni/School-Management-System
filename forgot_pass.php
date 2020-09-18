<?php

	if(!empty($_POST["forgot-password"]))
	{
		$conn = mysqli_connect("localhost", "root", "", "akhilesh");
		
		$condition = "";
		if(!empty($_POST["username"])) 
			$condition = " username = '" . $_POST["username"] . "'";
		if(!empty($_POST["email"])) 
		{
			if(!empty($condition)) 
			{
				$condition = " and ";
			}
			$condition = " email = '" . $_POST["email"] . "'";
		}
		
		if(!empty($condition)) 
		{
			$condition = " where " . $condition;
		}

		$sql = "SELECT * FROM student_tbl " . $condition;
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) 
		{
			require_once("mail_forgot_pass.php");
		} 
		else 
		{
			$error_message = 'No User Found';
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title> Forgot Password | School Management System</title>
	<link href="demo-style.css" rel="stylesheet" type="text/css">
	<script>
	function validate_forgot() 
	{
		if((document.getElementById("username").value == "") && (document.getElementById("email").value == "")) 
		{
			document.getElementById("validation-message").innerHTML = "Login name or Email is required!"
			return false;
		}
		return true
	}
	</script>
</head>
<body>

<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
<h1>Forgot Password?</h1>
	<?php if(!empty($success_message)) { ?>
		<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
		<?php echo $error_message; ?>
		<?php } ?>
	</div>

	<div class="field-group">
		<div><label for="username">Username</label></div>
		<div><input type="text" name="username" id="username" class="input-field"> Or</div>
	</div>
	
	<div class="field-group">
		<div><label for="email">Email</label></div>
		<div><input type="text" name="email" id="email" class="input-field"></div>
	</div>
	
	<div class="field-group">
		<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" 
			class="form-submit-button"></div>
	</div>	
</form>
</body>
</html>