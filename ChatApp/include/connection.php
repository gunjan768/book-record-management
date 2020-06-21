<?php

	// session_start();
	//session_regenerate_id( true );
	$conn = new mysqli('localhost','root','','mychat'); 

	if(!$conn) 
    {
        die("Error connecting to database: " . mysqli_connect_error($conn));
        exit();
    }

?>