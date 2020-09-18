<?php

	// require_once ('database.php');
	session_start();
	date_default_timezone_set("Asia/Calcutta");

	$logout_date = date('Y-m-d H:i:s');
	$conn = mysqli_connect("localhost", "root", "");
	mysqli_select_db($conn, "akhilesh");
	if(!$conn)
	{
		echo "Sorry Database is not connected";
	}
	$sql = "UPDATE student_tbl SET logout_date_time = '" . $logout_date . "' WHERE	
		id = '" . $_SESSION['id'] . "'";
		echo $sql;
	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if($result)
	{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
	else
	{
		echo "Sorry Logout Date is not Updated";
	}

?>