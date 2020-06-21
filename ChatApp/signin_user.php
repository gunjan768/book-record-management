<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="css/signin.css">

</head>

<?php

	include("include/connection.php");

	session_start();

	if( isset($_POST['sign_in']) )
	{
		
		$pass = htmlentities( mysqli_real_escape_string($conn, $_POST['pass']) );
		$email = htmlentities( mysqli_real_escape_string($conn, $_POST['email']) );

		$select_user = "SELECT *from users where user_email = '$email'";

		$result = mysqli_query($conn, $select_user);
		$row = mysqli_fetch_assoc($result);
		$check_user = mysqli_num_rows($result);

		if( $check_user )
		{
			$hash = $row['user_pass'];
			$res = password_verify($pass,$hash);

			$user_name = $row['user_name'];

			if( $res )
			{
				$_SESSION['user_email'] = $email;

				$update = "UPDATE users SET log_in='Online' where user_email = '$email'";
				$update_msg = mysqli_query($conn, $update);

				echo "<script>window.open('home.php?user_name=$user_name','_self')</script>";
			}

			else
			echo "<div class='alert alert-danger'><strong>Password is wrong</string></div>";
		}

		else
		echo "<div class='alert alert-danger'><strong>You are not registered yet</string></div>";

	}
	
?>