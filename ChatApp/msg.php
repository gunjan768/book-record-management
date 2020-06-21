<?php
	
	session_start();
	include("include/connection.php");

	extract($_POST);

	$msg = htmlentities( mysqli_real_escape_string($conn, $_POST['msg_content']) );
			
	if( $msg == "" )
	{
		echo "
			<div class='alert alert-danger'>
				<stong><center>Message was unable to send</center></strong>
			</div>

		";
	}

	else if(strlen( $msg )>100 )
	{
		echo "
			<div class='alert alert-danger'>
				<stong><center>Message is too long. Use upto 100 characters only</center></strong>
			</div>

		";
	}

	else
	{
		$date = date("d-m-y h:i:s A");
		$insert = "INSERT into users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date) values('$user_name', '$username', '$msg', 'unread', '$date')";

		// NOW() function will give you the current time
		
		$run_insert = mysqli_query($conn, $insert);
		if($run_insert)
		echo "string";
		else
		echo "bekar";
	}

?>