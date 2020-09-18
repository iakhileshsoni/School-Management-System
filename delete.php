
<?php
	session_start();
	$id = $_SESSION['id']; //It will be used to delete specific student's record that is logged-in
	if(empty($_SESSION['email']))
	{
		header("location:login.php");
	}
?>

<!DOCTYPE html>
<html>

	<head>
		<title> Delete the Student's Record </title>
	</head>

	<body>
		<h3 style="text-align: center;"> Delete the Student's Record </h3>

		<?php

			session_start();
			$id = $_SESSION['id'];
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_select_db($conn, "akhilesh");
			if($conn)
			{
				date_default_timezone_set("Asia/Calcutta"); 
				$date = date('Y-m-d H:i:s');
				// $sql = " DELETE FROM student_tbl WHERE id = '" . $id . "' " ;
				$sql = " UPDATE student_tbl SET status = '1', deleted_date = '" . $date . "' WHERE 
				id = '" . $id . "' ";
				// echo $sql;die();
				$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				if($result)
				{
					echo "Record is Deleted Successfully";
					header("location:display.php", "refresh");
				}
			}
			else
			{
				echo mysqli_error();
			}
			
		?>

	</body>

</html>



