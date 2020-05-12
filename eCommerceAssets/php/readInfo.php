<?php 
	// connect to the database
	//$db = mysqli_connect('localhost', 'ecommercegalilei', '', 'my_ecommercegalilei');
	$db = mysqli_connect('localhost', 'root', '', 'sito');
	if ($db->connect_errno) {
		array_push($errors,"Impossibile connettersi al server: " . $conn->connect_error);
    }
?>