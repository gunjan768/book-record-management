<?php
	
	session_start();
	include("include/connection.php");

	if( !isset($_SESSION['user_email']) )
	header('Location: http://localhost/Projects/ChatApp/signin.php');

?>

<!DOCTYPE html>
<html>
<head> 

	<title>My Chat - Home</title>
	
	<!-- below meta is used to redirect from this page to the page mentioned in url after every 10 sec ( as mentioned in content ) -->
	<!-- <meta http-equiv="refresh" content="10; URL=home.php"> -->

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->

	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/home.css">

	<script type="text/javascript" src="js/msg.js"></script>

</head>
<body>

	<div class="container main-section">

		<div class="row">
			
			<div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
				
				<div class="input-group searchbox">
					<div class="input-group-btn">
						<center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add new user</button></a></center>
					</div>
				</div>

				<div class="left-chat">
					<ul>
						<?php include("include/get_users_data.php"); ?>
					</ul>
				</div>

			</div>

			<div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
				
				<div class="row">
					
					<!-- getting the user information who is logged in -->

					<?php

						$user = $_SESSION['user_email'];

						$select_user = "SELECT *from users where user_email = '$user'";

						$run_user = mysqli_query($conn, $select_user);
						$row = mysqli_fetch_assoc($run_user);
						
						$user_id = $row['user_id'];
						$user_name = $row['user_name'];

					?>

					<!-- getting the user data on which user clicks -->

					<?php

						$username="";

						if( isset($_GET['user_name']) )
						{
							global $conn;

							$get_username = $_GET['user_name'];
							$get_user = "SELECT *from users where user_name = '$get_username'";

							$run_user = mysqli_query($conn, $get_user);
							$row_user = mysqli_fetch_assoc($run_user);

							$username = $row_user['user_name'];
							$user_profile_image = $row_user['user_profile'];
						}
						else
						{
							$user_profile_image = "https://cdn4.iconfinder.com/data/icons/mii-ui-vol-2/133/messaging-512.png";
						}

						$total_messages = "SELECT *from users_chat where (sender_username='$user_name' and receiver_username='$username') or (sender_username='$username' and receiver_username='$user_name')";

						$run_messages = mysqli_query($conn, $total_messages);
						$total = mysqli_num_rows($run_messages);

					?>

					<div class="col-md-12 right-header">
						
						<div class="right-header-img">
							<img src="<?php echo "$user_profile_image"; ?> ">
						</div>
						
						<div class="right-header-detail">
							
							<form method="post">

								<p><?php echo $username; ?></p>
								<span><?php echo $total; ?> messages</span>&nbsp; &nbsp;

								<button name="logout" class="btn btn-danger btn-sm">Logout</button>

							</form>

							<?php

								if( isset($_POST['logout']) )
								{
									$update_msg = "UPDATE users SET log_in='Offline' where user_name = '$user_name'";
									
									mysqli_query($conn,$update_msg);

									header("Location: logout.php");

									exit();
								}

							?>

						</div>

					</div>

				</div>

				<div class="row">
					<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
						<?php

							$query = "UPDATE users_chat SET msg_status = 'read' where sender_username = '$username' and receiver_username = '$user_name'";
							
							$update_msg = mysqli_query($conn, $query);

							$sel_msg = "SELECT *from users_chat where (sender_username='$user_name' and receiver_username='$username') or (sender_username='$username' and receiver_username='$user_name') ORDER by 1 ASC";

							// order by 1 asc used to sort in ascending order according to 1st column ie msg_id 

							$run_msg = mysqli_query($conn, $sel_msg);
							$total = mysqli_num_rows($run_msg);

							if($total)
							{
								while( $row = mysqli_fetch_assoc($run_msg) ) 
								{
									$sender_username = $row['sender_username'];
									$receiver_username = $row['receiver_username'];
									$msg_content = $row['msg_content'];
									$msg_date = $row['msg_date'];
								
							?>
									<ul>
							<?php

										if( $user_name == $sender_username and $username == $receiver_username )
										{
											$message = "<li>
															<div class='rightside-right-chat' style='position: relative;'>
																<span> You <small>$msg_date</small></span><br><br>
																<p> 
																	$msg_content";

											if( $row['msg_status'] == 'unread' )
											{
												$message.="			<i class='fa fa-check' aria-hidden='true' style='color: black; right: 20px; position: absolute; '></i>
																</p>
															</div>
														</li>";
											}
											else
											{
												$message.="			<i class='fa fa-check' aria-hidden='true' style='color: blue; right: 20px; position: absolute; '></i>
																	<i class='fa fa-check' aria-hidden='true' style='color: blue; right: 30px; position: absolute; '></i>
																</p>
															</div>
														</li>";
											}

											echo $message;
										}

										else if( $user_name == $receiver_username and $username == $sender_username )
										{
											$message = "<li>
															<div class='rightside-left-chat' style='position: relative;'>
																<span> $username <small>$msg_date</small></span><br><br>
																<p> 
																	$msg_content;
																</p>
															</div>
														</li>";

											echo $message;
										}

									?>

									</ul>

							<?php 

								}
							} 

							?>
						
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 right-chat-textbox">
						
						<form method="post" id="myform">
							
							<input type="text" name="msg_content" placeholder="write your message...." autocomplete="off" id="msg_content">
							<input type="hidden" name="username" value="<?php echo $username; ?>">
							<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
							<button class="btn" name="submit" type="submit" id="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>

						</form>

					</div>
				</div>
			
			</div>

		</div>

		<br><br>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger" id="error" style="display: none"></div>
			</div>
		</div>

	</div>

	<script>
		
		$('#scrolling_to_bottom').animate(
		{
			scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight
		},1000);

	</script>

	<script type="text/javascript">
		
		$(document).ready(function()
		{
			var height = $(window).height();
			$('.left-chat').css('height',(height-92)+'px');
			$('.right-header-contentChat').css('height',(height-163)+'px');

		})

	</script>

</body>
</html>