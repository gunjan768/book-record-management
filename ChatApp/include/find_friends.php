 <?php
	
	session_start();
	
	include("connection.php");
	include("find_friends_function.php");

	if( !isset($_SESSION['user_email']) )
	header('Location: http://localhost/Projects/ChatApp/signin.php');

?>

<!DOCTYPE html>
<html>
<head> 

	<title>Search Friends</title>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->

	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="../css/find_people.css">

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
		
				<div class="headButtons" style="position: relative; right: -820px; top: 9px;">
		      		<a class="btn btn-danger" href="#" >Signed in as <?php echo $_SESSION['user_email']; ?></a>
	      		</div>
		      	
		    </div>

		 </div>
	</nav>
	
	<?php $user = $_SESSION['user_email']; ?>

	<br><br><br><br>

	<div class="row">
		<br>
		<div class="col-sm-4"></div>
		
		<div class="col-sm-4">

			<form class="search_form" method="get">
				<input type="text" name="search_query" placeholder="Search Friends" autocomplete="off"> 
				<button class="btn" type="submit" name="search_btn" style="left: 8px; position: relative;">Search</button>
			</form>

		</div>

		<div class="col-sm-4"></div>

	</div>

	<br><br>	

	<?php search_user(); ?>

</body>
</html> 