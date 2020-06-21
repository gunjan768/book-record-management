<?php

	include("connection.php");

	function search_user()
	{
		global $conn;

		if( isset($_GET['search_btn']) )
		{
			$search_query = htmlentities($_GET['search_query']);

			$get_user = "SELECT *from users where user_name like '%$search_query%' or user_country like '%$search_query%'";
		}
		else
		{
			$get_user = "SELECT *from users";
			// $get_user = "SELECT *from users order by user_country , user_name DESC LIMIT 10";
		}


		$run_user = mysqli_query($conn, $get_user);

		while( $row_user = mysqli_fetch_assoc($run_user) ) 
		{
			$user_name = $row_user['user_name'];
			$user_profile = $row_user['user_profile'];
			$user_country = $row_user['user_country'];
			$gender = $row_user['user_gender'];
			
			$email = $row_user['user_email'];
			$loggedInEmail = $_SESSION['user_email'];

			if( $email == $loggedInEmail )
			continue;

			// now displaying all at once

			echo "

				<div class='card'>
					
					<img src='../$user_profile'>
					<h1>$user_name</h1>
					<p class='title'>$user_country</p>
					<p>$gender</p>

					<form method='post'>
						<p><button name='add'>Chat with $user_name</button></p>
					</form>

				</div>

				<br><br>

				";

			if( isset($_POST['add']) )
			{
				echo "<script>window.open('../home.php?user_name=$user_name','_self')</script>";
				// don't give any space between user_name and equals to sign
				// i.e don't write like this '../home.php?user_name = $user_name'
			}
		}
		
	}

?>