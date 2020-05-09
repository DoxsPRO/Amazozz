<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
//$db = mysqli_connect('localhost', 'ecommercegalilei', '', 'my_ecommercegalilei');
$db = mysqli_connect('localhost', 'root', '', 'sito');
if ($db->connect_errno) {
	array_push($errors,"Impossibile connettersi al server: " . $conn->connect_error);
    }
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $token = mysqli_real_escape_string($db, $_POST['token']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username è richiesto"); }
  if (empty($email)) { array_push($errors, "Email è richiesta"); }
  if (empty($password_1)) { array_push($errors, "Password è richiesta"); }
  if ($token != "2O3W7HKjgTIH") { array_push($errors, "Token è richiesto/sbagliato"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Le due password non corrispondono");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
	$sql_u = "SELECT * FROM credenziali WHERE Username='$username'";
  	$sql_e = "SELECT * FROM credenziali WHERE Email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  array_push($errors, "Username esiste già");	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  array_push($errors, "Email esiste già"); 
	}
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO credenziali (Username, Password, Email) 
  			  VALUES('$username', '$password', '$email')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Hai eseguito l'accesso correttamente!";
  	header('location: account.php');
  }
}
	// ... 
	
	if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username è richiesto");
  }
  if (empty($password)) {
  	array_push($errors, "Password è richiesta");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM credenziali WHERE Username='$username' AND Password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Hai eseguito l'accesso correttamente!";
  	  header('location: account.php');
  	}else {
  		array_push($errors, "Username/password sbagliate");
  	}
  }
}

if (isset($_POST['subit_data'])) {
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$cognome = mysqli_real_escape_string($db, $_POST['cognome']);
	$data = mysqli_real_escape_string($db, $_POST['data']);
	$cod_fisc = mysqli_real_escape_string($db, $_POST['cod_fisc']);
	$citta = mysqli_real_escape_string($db, $_POST['citta']);
	$indirizzo = mysqli_real_escape_string($db, $_POST['indirizzo']);
	$cap = mysqli_real_escape_string($db, $_POST['cap']);
	$telefono = mysqli_real_escape_string($db, $_POST['telefono']);
	
	 if (empty($name)) {
  	array_push($errors, "Nome è richiesto");}
	 if (empty($cognome)) {
  	array_push($errors, "Cognome è richiesto");}
		 if (empty($data)) {
  	array_push($errors, "Data di nascita richiesta");}
	 if (empty($cod_fisc)) {
  	array_push($errors, "Codice fiscale è richiesto");}
		 if (empty($citta)) {
  	array_push($errors, "Città è richiesto");}
	 if (empty($indirizzo)) {
  	array_push($errors, "Indirizzo è richiesto");}
		 if (empty($cap)) {
  	array_push($errors, "Cap è richiesto");}
	 if (empty($telefono)) {
  	array_push($errors, "Telefono è richiesto");}
	
	$newDate = date("Y-m-d", strtotime($data));
	
	  if (count($errors) == 0) {
  	$query = "INSERT INTO clienti (Nome, Cognome, Data, CodiceFiscale, Città, Indirizzo, CAP, Telefono) 
  			  VALUES('$name', '$cognome', '$newDate', '$cod_fisc', '$citta', '$indirizzo', '$cap', '$telefono')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Hai inserito tutti i dati correttamente!";
	$_SESSION['name'] = $name;
	$_SESSION['cognome'] = $cognome;
	$_SESSION['data'] = $newDate;
	$_SESSION['cof_fisc'] = $cod_fisc;
	$_SESSION['citta'] = $citta;
	$_SESSION['indirizzo'] = $indirizzo;
	$_SESSION['cap'] = $cap;
	$_SESSION['telefono'] = $telefono;
		  
  	header('location: myinfo.php');
  }
	
  }

?>

<?php
	if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
