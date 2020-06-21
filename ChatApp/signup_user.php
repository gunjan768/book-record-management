<?php

	include("include/connection.php");

	if( isset($_POST['sign_up']) )
	{
		$name = htmlentities( mysqli_real_escape_string($conn, $_POST['user_name']) );
		$pass1 = htmlentities( mysqli_real_escape_string($conn, $_POST['user_pass']) );
		$email = htmlentities( mysqli_real_escape_string($conn, $_POST['user_email']) );
		$country = htmlentities( mysqli_real_escape_string($conn, $_POST['user_country']) );
		$gender = htmlentities( mysqli_real_escape_string($conn, $_POST['user_gender']) );
		
		$files=$_FILES['myfile'];

		$pass = password_hash($pass1, PASSWORD_DEFAULT);

		if( strlen($pass1)<8 )  
		{
			echo "<script>alert('Password must be minimum of 8 characters')</script>";
			echo "<script>window.open('signup.php','_self')</script>";
			exit();
		}

		$check_email = "SELECT *from users where user_email='$email'";
		$run_email = mysqli_query($conn, $check_email);

		$check = mysqli_num_rows($run_email);

		if( $check )
		{
			echo "<script>alert('Email already exist')</script>";
			echo "<script>window.open('signup.php','_self')</script>";

			exit();
		}

		$profile_pic = "images/".$files['name'];

		if($files['type']=="image/jpeg")
		{
			move_uploaded_file($files['tmp_name'], $profile_pic);
		}
		else
		{
			echo "<script>alert('Please upload .jpeg file')</script>";
			echo "<script>window.open('signup.php','_self')</script>";
		}

		$ins = "INSERT into users(user_name,user_pass,user_email,user_profile,user_country,user_gender,forgotten_answer,log_in) values('$name','$pass','$email','$profile_pic','$country','$gender','0','0')";

		$query = mysqli_query($conn, $ins);

		if( $query )
		{
			echo "<script>alert('Congratulations $name , your account has been created successfully')</script>";
			echo "<script>window.open('signin.php','_self')</script>";
		}
		else
		{
			echo "<script>alert('Registration failed, try again')</script>";
			echo "<script>window.open('signup.php','_self')</script>";
		}
	}

?>