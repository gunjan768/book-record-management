<!DOCTYPE html>
<html>
<head>
	<title>Create new account</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="css/signup.css">

</head>
<body>

	<div class="signup-form">

		<form action="signup_user.php" method="post" enctype="multipart/form-data">

			<div class="form-header">
				<h2>Sign Up</h2>
				<p>Fill out this to strat chatting up with your friends</p>
			</div>
			
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="user_name" placeholder="write your name" autocomplete="off" required="">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="Password" class="form-control" name="user_pass" placeholder="password" autocomplete="off" required="">
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="user_email" placeholder="someone@site.com" autocomplete="off" required="">
			</div>

			<div class="form-group">
				<label>Profile Picture</label>
				<input type="file" name="myfile" onchange="readURL(this);">
				<img id="image" src="#" alt="your image" style="display: none; margin-top: 5px;">
			</div>

			<div class="form-group">
				<label>Country</label>
				<select class="form-control" name="user_country" required="">
					<option disabled="">Select a country</option>
					<option>India</option>
					<option>America</option>
					<option>Russia</option>
					<option>Australia</option>
					<option>Japan</option>
				</select>
			</div>

			<div class="form-group">
				<label>Gender</label>
				<select class="form-control" name="user_gender" required="">
					<option disabled="">Select your Gender</option>
					<option>Female</option>
					<option>Male</option>
					<option>Others</option>
				</select>
			</div>

			<div class="form-group">
				<label class="checkbox-inline">
					<input type="checkbox" required="">I accept the <a href="#">Terms of use</a> &amp; <a href="#">Privacy Policy </a>
				</label>
			</div>

			<br>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up">Sign up</button>
			</div>

			<!-- <?php include("signup_user.php"); ?> -->

		</form>

		<div class="text-center small" style="color: #674288">Already have an account? <a href="signin.php">Signin here</a></div>

	</div>

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