<?php 

  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
	// connect to the database
	//$db = mysqli_connect('localhost', 'ecommercegalilei', '', 'my_ecommercegalilei');
	$db = mysqli_connect('localhost', 'root', '', 'sito');
	if ($db->connect_errno) {
		array_push($errors,"Impossibile connettersi al server: " . $conn->connect_error);
    }
	
	$idTok = $_SESSION['id'];
	
	$query = "SELECT * FROM clienti WHERE CredenzialeID = '$idTok'";
	mysqli_query($db, $query)or die(mysqli_error($db));
?>