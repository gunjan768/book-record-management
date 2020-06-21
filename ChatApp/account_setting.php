<?php
	
	session_start();
	include("include/connection.php");

	if( !isset($_SESSION['user_email']) )
	header('Location: http://localhost/Projects/ChatApp/signin.php');

?>

<!DOCTYPE html>
<html>
<head> 

	<title>Account Setting</title>

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

	<nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top" role="navigation">
	  	<div class="container">

	    	<div class="navbar-header">
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
	    	</div>

		
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	
		      	<ul class="nav navbar-nav mains" style="position: relative; left: -180px;">
			        <li><a href="http://localhost/Projects/ChatApp/home.php" target="">My Chat</a><li>
			        <li><a href="http://localhost/Projects/ChatApp/account_setting.php" target="">Settings</a><li>	
		      	</ul>
		
				<div class="headButtons" style="position: relative; right: -880px; top: 9px;">
		      		<a class="btn btn-danger" href="#" >Signed in as <?php echo $_SESSION['user_email']; ?></a>
	      		</div>
		      	
		    </div>

		 </div>
	</nav>
	
	<br><br>

	<div class="row">
		
		<br><br>

		<div class="col-sm-2"></div>

		<?php

			$user = $_SESSION['user_email'];
			$get_user = "SELECT *from users where user_email = '$user'";

			$run_user = mysqli_query($conn, $get_user);
			$row_user = mysqli_fetch_assoc($run_user);

			$user_name = $row_user['user_name'];
			$user_profile = $row_user['user_profile'];
			$user_country = $row_user['user_country'];
			$user_gender = $row_user['user_gender'];
			$user_email = $row_user['user_email'];
			$user_pass = $row_user['user_pass'];

		?>

		<div class="col-sm-8">
			
			<form action="" method="post" enctype="multipart/form-data">
				
				<table class="table table-bordered table-hover">
					
					<tr align="center">
						<td colspan="6" class="active"><i class="fa fa-user" aria-hidden="true" style="font-size: 24px;">&nbsp;</i><h2 style="display: inline;">Change Account Settings</h2></td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change your Username</td>
						<td>
							<input type="text" name="name" class="form-control" required value="<?php echo $user_name; ?>">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change your Email</td>
						<td>
							<input type="email" name="email" class="form-control" required value="<?php echo $user_email; ?>">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change your profile picture</td>
						<td>
							<input type="file" name="myfile" id="myfile" onchange="readURL(this);">
							<img id="image" src="#" alt="your image" style="display: none; margin-top: 5px;">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Country</td>
						<td>
							<select class="form-control" name="country">
								<option>India</option>
								<option>America</option>
								<option>Autralia</option>
								<option>Bharat</option>
								<option>Hindustan</option>
							</select>
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Gender</td>
						<td>
							<select class="form-control" name="gender">
								<option>Female</option>
								<option>Male</option>
								<option>Others</option>
							</select>
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change Password</td>
						<td>
							<input class="form-control" type="password" name="password" placeholder="Enter a new password">
						</td>
					</tr>

					<tr align="center">
						<td colspan="6">
							<input type="submit" name="update" value="Update" class="btn btn-info btn-lg">
						</td>
					</tr>

				</table>

			</form>

		</div>

	</div>

	<?php

		if( isset($_POST['update']) )
		{
			$user_name = htmlentities( mysqli_real_escape_string($conn, $_POST['name']) );
			$pass = htmlentities( mysqli_real_escape_string($conn, $_POST['password']) );
			$user_email = htmlentities( mysqli_real_escape_string($conn, $_POST['email']) );
			$user_country = htmlentities( mysqli_real_escape_string($conn, $_POST['country']) );
			$user_gender = htmlentities( mysqli_real_escape_string($conn, $_POST['gender']) );

			$user_password = password_hash($pass, PASSWORD_DEFAULT);

			if( strlen($pass)<8 )  
			{
				echo "<script>alert('Password must be minimum of 8 characters')</script>";
				echo "<script>window.open('account_setting.php','_self')</script>";
				exit();
			}

			$check_email = "SELECT *from users where user_email='$user_email'";
			$run_email = mysqli_query($conn, $check_email);
			$row = mysqli_fetch_assoc($run_email);

			$check_email = $row['user_email'];

			if( $check_email && $check_email!=$user )
			{
				echo "<script>alert('Email already exist')</script>";
				echo "<script>window.open('account_setting.php','_self')</script>";

				exit();
			}

			$files=$_FILES['myfile'];

			$profile_pic = "images/".$files['name'];

			if($files['type']=="image/jpeg")
			{
				move_uploaded_file($files['tmp_name'], $profile_pic);
			}
			else
			{
				echo "<script>alert('Please upload .jpeg file')</script>";
				echo "<script>window.open('account_setting','_self')</script>";
			}

			$sql = "UPDATE users SET user_name = '$user_name', user_email = '$user_email', user_country = '$user_country' , user_gender = '$user_gender' , user_pass = '$user_password' , user_profile = '$profile_pic' where user_email = '$user'";

			$result = mysqli_query($conn, $sql);

			if( $result )
			{
				echo "<script>alert('Congratulations $user_name , your account has been updated successfully')</script>";
				echo "<script>window.open('home.php','_self')</script>";
			}
			else
			{
				echo "<script>alert('Updataion failed, try again')</script>";
				echo "<script>window.open('account_setting.php','_self')</script>";
			}
		}

	?>

	<script type="text/javascript">
		
		function readURL(input)
		{
	        if(input.files && input.files[0]) 
	        {
	            var reader = new FileReader();

	            reader.onload = function(res) 
	            {
	                $('#image')
	                    .attr('src', res.target.result)
	                    .width(250)
	                    .height(200);

	                $('#image').css('display','block');
	            };

	            reader.readAsDataURL(input.files[0]);
	        }
	    }

	</script>

</body>
</html>