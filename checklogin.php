<?php

	session_start();
	$id = $_SESSION['id']; //It will be used to delete specific student's record who is already logged-in
	$now = time();
	if(empty($_SESSION['email']))
	{
		header("location:login.php");
	}
	// elseif($now > $_SESSION['expire'])
	// {
	//     session_destroy();
	//     header("location:login.php", "refresh");
	// }

?>