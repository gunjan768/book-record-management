<?php
	
	include("include/connection.php");

	$logged_email = $_SESSION['user_email'];

	$user = "SELECT *from users";

	$run_user = mysqli_query($conn, $user);
	
	while ( $row = mysqli_fetch_assoc($run_user) ) 
	{
		$user_id = $row['user_id'];
		$user_name = $row['user_name'];
		$user_profile = $row['user_profile'];
		$login = $row['log_in'];
		$user_email = $row['user_email'];

		if( $logged_email!=$user_email )
		{
			echo "
				<li>
					<div class='chat-left-img'>
						<img src='$user_profile'>
					</div>
					<div class='chat-left-details'>
						<p><a href='home.php?user_name=$user_name'>$user_name</a><p>";

						if($login == 'Online')
						echo "<span  style='color: grey;'><i class = 'fa fa-circle' aria-hidden='true' style='color: rgb(0,255,0);'></i>&nbsp;Online</span>";
						else
					  	echo "<span  style='color: grey;'><i class = 'fa fa-circle-o' aria-hidden='true' ></i>&nbsp;Offline</span>";

					"</div>
				</li>
			";
		}
	}

?>