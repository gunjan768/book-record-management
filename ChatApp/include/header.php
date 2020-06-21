<nav class="navbar-brand">
		
	<a href="#" class="navbar-brand">
		
		<?php

			$user = $_SESSION['user_email'];
			$get_user = "SELECT *from users where user_email='$user'";

			$run_user = mysqli_query($conn , $get_user);
			$row = mysqli_fetch_array($run_user);

			$user_name = $row['user_name'];

			echo "<a class='navbar-brand' href='../home.php?user_name = $user_name'>My Chat</a>";

		?>

	</a>

	<ul class="navbar-nav">
		<li><a style="color: white; text-decoration: none;font-size: 20px;" href="../account_setting.php?user_email=$user">Setting</a></li>
	</ul>

</nav>

<br>